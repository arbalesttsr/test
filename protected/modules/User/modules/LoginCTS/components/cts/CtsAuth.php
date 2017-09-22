<?php 
require('xmlseclibs.php');
 
class CtsAuth 
{
    //constants certificates
    const CTS_DEFAULT_KEY = 'default_saml.key';
    const CTS_DEFAULT_CERT = 'default_saml.crt';
    const CTS_DEFAULT_RESPONSE_KEY = 'default_testmpass.pem';
    //constants saml
    const SAML_DEFAULT_ASSERATION_NS = 'urn:oasis:names:tc:SAML:2.0:assertion';
    const SAML_DEFAULT_PREFIX = 'ONELOGIN';
    //constans synapsis callback url
    const SYNAPSIS_DEFAULT_CALLBACK_URL = '/User/site/login'; 
    //constants mpass login and service issuer registered in mpass
    const MPASS_DEFAULT_LOGIN_URL = 'https://testmpass.gov.md/login/saml';
    const MPASS_DEFAULT_LOGOUT_URL = 'https://testmpass.gov.md/logout/saml';
    const MPASS_DEFAULT_ISSUER = 'http://ghiseu.justice.gov.md/';

    //attributes
    private $_key;
    private $_certificate;
    private $_validateResponseKey;
    private $_callbackUrl;
    private $_loginUrl;
    private $_logoutUrl;
    private $_ForceAuthn = false;
    private $_IsPassive = false;
    private $_asserationNS;
    private $_ID ;
    private $_TIME;
    private $_PREFIX;
    private $_Issuer;
    private $_RequestData;
    private $_ResponseData = array();

    private $_error = '';



    public function __construct(){
        $this->init();
    }

    public function init() {

        $this->_ID = $this->_generateUniqueID();
        $this->_TIME = $this->_getTimestamp();
        
        $this->_key = $this->_getDefaultKey();
        $this->_certificate = $this->_getDefaultCertificate();
        $this->_validateResponseKey = $this->_getDefaultResponseKey();

        $this->_IsPassive = $this->_IsPassive ? 'true' : 'false';
        $this->_ForceAuthn = $this->_ForceAuthn ? 'true' : 'false';
        $this->_asserationNS = $this->_getDefaultAsserationNS();
        $this->_PREFIX = self::SAML_DEFAULT_PREFIX;
        
        $this->_callbackUrl =  Yii::app()->request->getBaseUrl(true) . $this->_getDefaultCallbackUrl();
        
        $this->_loginUrl = $this->_getDefaultLoginUrl();
        $this->_logoutUrl = $this->_getDefaultLogoutUrl();
        $this->_Issuer = $this->_getDefaultIssuer();
        
        $this->_prepareCallBack();

        return true;
    }

    public function loginInit(){
        $doc = new DOMDocument();        
        $doc->loadXML( $this->_getXMLContent() );
        $objDSig = new XMLSecurityDSig();
        $objDSig->setCanonicalMethod(XMLSecurityDSig::EXC_C14N);
        $objDSig->addReference(
                $doc,
                XMLSecurityDSig::SHA1,
                array(
                    'http://www.w3.org/2000/09/xmldsig#enveloped-signature',
                    'http://www.w3.org/2001/10/xml-exc-c14n#',
                    ),
                 array(
                     'force_uri' => true,
                     'id_value' => $this->_ID
                     )
                );
        $objKey = new XMLSecurityKey(XMLSecurityKey::RSA_SHA1,
        array('type'=>'private'));
        /* load private key */
        $objKey->loadKey( $this->_key , TRUE);
        $objDSig->sign($objKey);
        /* Add associated public key */
        $objDSig->add509Cert(file_get_contents($this->_certificate));
        $objDSig->appendSignature($doc->documentElement);
        $this->_RequestData = $doc->saveXML();

        return true;
    }

    public function logoutInit(){
        $doc = new DOMDocument();
        $doc->loadXML( $this->_getXMLContentLogout() );

        $objDSig = new XMLSecurityDSig();
        $objDSig->setCanonicalMethod(XMLSecurityDSig::EXC_C14N);
        $objDSig->addReference(
            $doc,
            XMLSecurityDSig::SHA1,
            array(
                'http://www.w3.org/2000/09/xmldsig#enveloped-signature',
                'http://www.w3.org/2001/10/xml-exc-c14n#',
            ),
            array(
                'force_uri' => true,
                'id_value' => $this->_ID
            )
        );
        $objKey = new XMLSecurityKey(XMLSecurityKey::RSA_SHA1,
            array('type'=>'private'));
        /* load private key */
        $objKey->loadKey( $this->_key , TRUE);
        $objDSig->sign($objKey);
        /* Add associated public key */
        $objDSig->add509Cert(file_get_contents($this->_certificate));

        $objDSig->appendSignature($doc->documentElement);
        $this->_RequestData = $doc->saveXML();

        return true;
    }

    public function validateResponse($response){

        $response = base64_decode($response);

        $doc = new DOMDocument();
        $doc->loadXML( $response );

        $objXMLSecDSig = new XMLSecurityDSig();
        $objDSig = $objXMLSecDSig->locateSignature($doc);
        if (! $objDSig) {
                $this->_error = "Cannot locate Signature Node";
                return false;
        }
        $objXMLSecDSig->canonicalizeSignedInfo();
        $objXMLSecDSig->idKeys = array('ID');
        
        $retVal = $objXMLSecDSig->validateReference();

        if (! $retVal) {
                $this->_error = "Reference Validation Failed";
                return false;
        }
        
        $objKey = $objXMLSecDSig->locateKey();
        if (! $objKey ) {
                // throw new Exception("We have no idea about the key");
                $this->_error = "We have no idea about the key";
                return false;

        }
        $key = NULL;
        
        $objKeyInfo = XMLSecEnc::staticLocateKeyInfo($objKey, $objDSig);

        $objKey->loadKey( $this->_validateResponseKey, TRUE);
       
        if ($objXMLSecDSig->verify($objKey)) {
                $this->_parseResponseXML($response);
                return true;
        } else {
                $this->_error = "Validate not check";
                return false;
        }
    }

    public function getResponseData(){
        return $this->_ResponseData;
    }

    public function getError(){
        return $this->_error;
    }

    public function getRequestData($encode = false){
        return $encode ? base64_encode($this->_RequestData) : $this->_RequestData;
    }

    public function getID(){
        return $this->_ID;
    }

    public function getRelay()
    {
        if(Yii::app()->user->isGuest)
            return "Sample AuthnRequest Relay State";
        else
            return "Sample LogoutRequest Relay State";
    }

    public function getLoginUrl(){
        return $this->_loginUrl;
    }

    public function getLogoutUrl(){
        return $this->_logoutUrl;
    }

    public function setLoginUrl($url){
        return $this->_loginUrl = $url;
    }

    public function setCallbackUrl($url){
        return $this->_callbackUrl = $url;
    }

    private function _parseResponseXML($xmlData){
        $dom = new DOMDocument;
        $dom->loadXML($xmlData);

        $element = $dom->getElementsByTagNameNS( $this->_asserationNS ,'*');
        $exist = false;
        foreach ($element as $el)
            switch ($el->nodeName) {
                case 'saml:NameID':
                    $this->_ResponseData['IDNO'] = $el->nodeValue;
                    $exist = true;
                    break;
                case 'saml:Attribute':
                    $this->_ResponseData[$el->getAttribute('Name')] = $el->nodeValue;
                    break;
            }

        if(!$exist && Yii::app()->user->isGuest)
        {
            session_destroy();
            Yii::app()->user->logout();
            Yii::app()->request->redirect('/');
        }

        $searchNode = $dom->getElementsByTagName( "AuthnStatement" );

        foreach( $searchNode as $searchNod )
        {
            $_SESSION['SessionIndex'] = $searchNod->getAttribute('SessionIndex');
        }
        return $this->_ResponseData;


    }

    private function _prepareCallBack(){
        if(strpos($this->_callbackUrl, '?') !== FALSE )
            return $this->_callbackUrl . '&id=' . $this->getID();
        else 
            return $this->_callbackUrl . '?id=' . $this->getID();
    }

    private function _getTimestamp()
    {
        $defaultTimezone = date_default_timezone_get();
        date_default_timezone_set('UTC');
        $timestamp = strftime("%Y-%m-%dT%H:%M:%SZ");
        date_default_timezone_set($defaultTimezone);
        return $timestamp;
    }

    private function _generateUniqueID(){
        return $this->_PREFIX . sha1(uniqid(mt_rand(), TRUE));
    }

    private function _getXMLContent(){
        return <<<TST
        <samlp:AuthnRequest
                    Id="$this->_ID" 
                    Version="2.0" 
                    IssueInstant="$this->_TIME" 
                    Destination="$this->_loginUrl" 
                    ForceAuthn="$this->_ForceAuthn" 
                    IsPassive="$this->_IsPassive" 
                    ProtocolBinding="urn:oasis:names:tc:SAML:2.0:bindings:HTTP-POST" 
                    AssertionConsumerServiceURL="$this->_callbackUrl"
                    xmlns:samlp="urn:oasis:names:tc:SAML:2.0:protocol">
        <saml:Issuer xmlns:saml="$this->_asserationNS">$this->_Issuer</saml:Issuer>
        <samlp:NameIDPolicy AllowCreate="true" Format="2" />
        </samlp:AuthnRequest>
TST;
    }

    private function _getXMLContentLogout(){
        $session_id = $_SESSION['SessionIndex'];
        $nameId = Yii::app()->user->idnp;
        return <<<TST
         <saml2p:LogoutRequest
         xmlns:saml2p="urn:oasis:names:tc:SAML:2.0:protocol"
         xmlns:saml2="urn:oasis:names:tc:SAML:2.0:assertion"
         Destination="$this->_logoutUrl"
         ID="$this->_ID"
         IssueInstant="$this->_TIME"
         Version="2.0">
			   <saml2:Issuer>$this->_Issuer</saml2:Issuer>
			   <saml2:NameID>$nameId</saml2:NameID>
			   <saml2p:SessionIndex>$session_id</saml2p:SessionIndex>
		</saml2p:LogoutRequest>
TST;
    }

    private function _getDefaultKey() {
        
       $path = realpath(__DIR__ . DIRECTORY_SEPARATOR ).DIRECTORY_SEPARATOR.'certificates'.DIRECTORY_SEPARATOR.'keys'.DIRECTORY_SEPARATOR;
        
       $cts_settings = CtsSettings::getCtsSettingDefault();
       if($cts_settings !== '')
       {
           $key_file_name = $cts_settings->key;
           if(file_exists($path.$key_file_name)){
               return $path.$key_file_name;
           }
           else
           {
               return $path.self::CTS_DEFAULT_KEY;
           }
                   
       }
        else {
           return $path.self::CTS_DEFAULT_KEY;
       }
      
    }
    
    private function _getDefaultCertificate() {
        
       $path = realpath(__DIR__ . DIRECTORY_SEPARATOR ).DIRECTORY_SEPARATOR.'certificates'.DIRECTORY_SEPARATOR.'certs'.DIRECTORY_SEPARATOR;
        
       $cts_settings = CtsSettings::getCtsSettingDefault();
       if($cts_settings !== '')
       {
           $key_file_name = $cts_settings->certificate;
           if(file_exists($path.$key_file_name)){
               return $path.$key_file_name;
           }
           else
           {
               return $path.self::CTS_DEFAULT_CERT;
           }
                   
       }
        else {
           return $path.self::CTS_DEFAULT_CERT;
       }
      
    }
    
    private function _getDefaultResponseKey() {
        
       $path = realpath(__DIR__ . DIRECTORY_SEPARATOR ).DIRECTORY_SEPARATOR.'certificates'.DIRECTORY_SEPARATOR.'responsekeys'.DIRECTORY_SEPARATOR;
        
       $cts_settings = CtsSettings::getCtsSettingDefault();
       if($cts_settings !== '')
       {
           $key_file_name = $cts_settings->validate_response_key;
           if(file_exists($path.$key_file_name)){
               return $path.$key_file_name;
           }
           else
           {
               return $path.self::CTS_DEFAULT_RESPONSE_KEY;
           }
                   
       }
        else {
           return $path.self::CTS_DEFAULT_RESPONSE_KEY;
       }
      
    }
    
    private function _getDefaultLoginUrl() {
        
       $cts_settings = CtsSettings::getCtsSettingDefault();
       if($cts_settings !== '')
       {
           $login_url = ($cts_settings->login_url !== '')? $cts_settings->login_url : self::MPASS_DEFAULT_LOGIN_URL; 
           return $login_url;     
       }
        else {
           return self::MPASS_DEFAULT_LOGIN_URL;
       }
      
    }

    private function _getDefaultLogoutUrl() {

        $cts_settings = CtsSettings::getCtsSettingDefault();
        if($cts_settings !== '')
        {
            $login_url = ($cts_settings->logout_url !== '')? $cts_settings->logout_url : self::MPASS_DEFAULT_LOGIN_URL;
            return $login_url;
        }
        else {
            return self::MPASS_DEFAULT_LOGOUT_URL;
        }

    }
    
    private function _getDefaultCallbackUrl() {
        
       $cts_settings = CtsSettings::getCtsSettingDefault();
       if($cts_settings !== '')
       {
           $calback_url = ($cts_settings->callback_url !== '')? $cts_settings->callback_url : self::SYNAPSIS_DEFAULT_CALLBACK_URL;   
           return $calback_url;     
       }
        else {
           return self::SYNAPSIS_DEFAULT_CALLBACK_URL;
       }
      
    }
    
    private function _getDefaultAsserationNS()
    {
       $cts_settings = CtsSettings::getCtsSettingDefault();
       if($cts_settings !== '')
       {
           $asseration = ($cts_settings->asserationNS !== '')? $cts_settings->asserationNS : self::SAML_DEFAULT_ASSERATION_NS;   
           return $asseration;
       }
        else {
           return self::SAML_DEFAULT_ASSERATION_NS;
       }
    }
    
    private function _getDefaultIssuer()
    {
       $cts_settings = CtsSettings::getCtsSettingDefault();
       if($cts_settings !== '')
       {
           $asseration = ($cts_settings->issuer !== '')? trim($cts_settings->issuer) : self::MPASS_DEFAULT_ISSUER;   
           return $asseration;
       }
        else {
           return self::MPASS_DEFAULT_ISSUER;
       }
    }
}