<?php

/**
 * Created by PhpStorm.
 * User: tudor
 * Date: 2/11/15
 * Time: 11:41 AM
 */
class HelperLoginAd
{

    //error message const
    const ERROR_NO_LDAP_SETTINGS = 'no ldap settings';
    const ERROR_NOT_CONNECT_LDAP = 'Could not connect to LDAP server.';
    const ERROR_LDAP_SEARCH_FALSE = 'result ldap_search is false.';
    const ERROR_LDAP_BIND_FAILED = 'LDAP bind failed....';

    public static function GetLdapUsers($ad_username, $ad_password, $ldap_setting_id)
    {
        $accounts = array();
        $ldap = LdapSettings::model()->findByPk($ldap_setting_id);
        if ($ldap === null) {
            die(self::ERROR_NO_LDAP_SETTINGS);
        } else {
            $dc_ = explode('.', $ldap->ldap_dc);

            if (!strpos($ad_username, '\\'))
                $username = $dc_[0] . '\\' . $ad_username;

            try {

                // connect to ldap server
                $ldapconn = ldap_connect($ldap->ldap_host, $ldap->ldap_port)
                or die(self::ERROR_NOT_CONNECT_LDAP);

                // Set some ldap options for talking to
                ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
                ldap_set_option($ldapconn, LDAP_OPT_REFERRALS, 0);

                try {
                    if ($ldapconn) {

                        // binding to ldap server
                        $ldapbind = @ldap_bind($ldapconn, $username, $ad_password);

                        // verify binding
                        if ($ldapbind) {
                            $ldap_base_dn = 'DC=' . $dc_[0] . ',DC=' . $dc_[1];
                            $search_filter = "(&(objectClass=user)(objectcategory=user)(memberof=CN={$ldap->ldap_ou},CN=Groups,{$ldap_base_dn}))";
                            //$ldap_base_dn = "OU={$ldap->ldap_ou},DC=" . $dc_[0] . ',DC=' . $dc_[1];
                            //$search_filter = "(&(objectClass=user)(objectcategory=user))";
                            $attributes = array();
                            $attributes[] = 'givenname';
                            $attributes[] = 'mail';
                            $attributes[] = 'samaccountname';
                            $attributes[] = 'sn';
                            $result = @ldap_search($ldapconn, $ldap_base_dn, $search_filter, $attributes);

                            if (FALSE !== $result) {

                                $entries = ldap_get_entries($ldapconn, $result);
                                // die(var_dump('<pre>',$entries,'</pre>'));
                                foreach ($entries as $key => $record) {

                                    $firstName = !is_null(CHtml::value($record, 'givenname.0')) ? trim(CHtml::value($record, 'givenname.0')) : 'Empty';
                                    $lastName = !is_null(CHtml::value($record, 'sn.0')) ? trim(CHtml::value($record, 'sn.0')) : 'Empty';
                                    $login = !is_null(CHtml::value($record, 'samaccountname.0')) ? trim(CHtml::value($record, 'samaccountname.0')) : 'Empty';
                                    $mail = !is_null(CHtml::value($record, 'mail.0')) ? trim(CHtml::value($record, 'mail.0')) : 'Empty';
                                    $accounts[] = array(
                                        'first_name' => $firstName,
                                        'last_name' => $lastName,
                                        'login' => $login,
                                        'mail' => $mail,
                                    );
                                }
                                ldap_unbind($ldapconn); // Clean up after ourselves.
                                return $accounts;
                            } else {
                                //result false
                                return self::ERROR_LDAP_SEARCH_FALSE; //'result ldap_search is false false';
                            }

                        } else {
                            return self::ERROR_LDAP_BIND_FAILED;// 'LDAP bind failed...\n';
                        }

                    } else {
                        die(self::ERROR_NOT_CONNECT_LDAP);
                    }
                } catch (ErrorException $ex) {
                    return Message("Mesaj :" . $ex->getMessage());
                }


            } catch (ErrorException $ex) {
                return Message("Mesaj :" . $ex->getMessage());
            }
        }
    }







//    public static function GetLdapUsers($ad_username,$ad_password,$ldap_setting_id)
//    {
////        $ad_password ='131VBN$$';
////        $ad_users=array();
////        $uldap_relation = UserLdapRelation::model()->findByAttributes(array('user_id' =>  Yii::app()->getUser()->getId()));
////        if($uldap_relation ===null){
////            die('no user ldap relation');
////        }
//        // else {
//        $ldap = LdapSettings::model()->findByPk($ldap_setting_id);
//        if($ldap===null){
//            die('no ldap settings');
//        }
//        else{
//            $dc_ = explode('.', $ldap->ldap_dc);
//
//            if(!strpos($ad_username, '\\'))
//                $username = $dc_[0].'\\'.$ad_username;
//
//            try{
//
//                // connect to ldap server
//                $ldapconn = ldap_connect($ldap->ldap_host,$ldap->ldap_port)
//                or die("Could not connect to LDAP server.");
//
//                // Set some ldap options for talking to
//                ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
//                ldap_set_option($ldapconn, LDAP_OPT_REFERRALS, 0);
//
//                try{
//                    if ($ldapconn) {
//
//                        // binding to ldap server
//                        $ldapbind = @ldap_bind($ldapconn, $username, $ad_password);
//
//                        // verify binding
//                        if ($ldapbind) {
//                            //echo "LDAP bind successful...\n";
//                            // return true;
//                            $ldap_base_dn = 'DC='.$dc_[0].',DC='.$dc_[1];
//                            $search_filter = "(&(objectClass=user)(objectcategory=user)(memberof=CN={$ldap->ldap_ou},CN=Groups,{$ldap_base_dn}))";
//                            //$search_filter = "(&(objectcategory=user)(memberof=CN=InfoSafe,CN=Groups,DC=synapsis-domain,DC=lan))";
//
//                            $attributes = array();
//                            $attributes[] = 'givenname';
//                            $attributes[] = 'mail';
//                            $attributes[] = 'samaccountname';
//                            $attributes[] = 'sn';
//                            //$filter = "(|(cn=" . $uldap_relation->user->ad_username . ")" . "(sn=" . $uldap_relation->user->ad_username ."))";
//                            // $filter = "(&(objectCategory=person)(samaccountname=Tudor.Victor))";
//                            // $fields = array("samaccountname","mail","manager","department","displayname","objectGUID");
//
//                            $result = @ldap_search($ldapconn, $ldap_base_dn, $search_filter, $attributes);
//
//                            if (FALSE !== $result){
//
//                                $entries = ldap_get_entries($ldapconn, $result);
//                                //die(var_dump('<pre>',$entries,'</pre>'));
//                                /*for ($x=0; $x<$entries['count']; $x++){
//                                    if (!empty($entries[$x]['givenname'][0]) &&
//                                        !empty($entries[$x]['mail'][0]) &&
//                                        !empty($entries[$x]['samaccountname'][0]) &&
//                                        !empty($entries[$x]['sn'][0]) &&
//                                        'Shop' !== $entries[$x]['sn'][0] &&
//                                        'Account' !== $entries[$x]['sn'][0]){
//                                        $ad_users[strtoupper(trim($entries[$x]['samaccountname'][0]))] = array('email' => strtolower(trim($entries[$x]['mail'][0])),'first_name' => trim($entries[$x]['givenname'][0]),'last_name' => trim($entries[$x]['sn'][0]));
//                                    }
//                                }*/
//
//                                $accounts = array();
//
//                                foreach($entries as $key => $record)
//                                    if( ($mail = CHtml::value($record,'mail.0')) != null &&
//                                        ($firstName = CHtml::value($record,'givenname.0')) != null &&
//                                        ($lastName = CHtml::value($record,'sn.0')) != null &&
//                                        ($login = CHtml::value($record,'samaccountname.0')) != null
//                                    )
//                                        $accounts[] = array(
//                                            'first_name' => trim($firstName),
//                                            'last_name' => trim($lastName),
//                                            'login' => trim($login),
//                                            'mail' => strtolower(trim($mail)),
//                                        );
//
//                                ldap_unbind($ldapconn); // Clean up after ourselves.
//                                return $accounts;
//                            }
//                            else
//                            {
//                                //result false
//                                die('result false');
//                            }
//
//                            // die(var_dump($accounts));
//                        } else {
//                            //echo "LDAP bind failed...\n";
//                            die('LDAP bind failed...\n');
//                        }
//
//                    }
//                    else
//                    {die('ldap connection failed');}
//                }catch (ErrorException $ex){echo Message("Mesaj :".$ex->getMessage());}
//
//
//            }catch (ErrorException $ex){echo Message("Mesaj :".$ex->getMessage());}
//        }
//    }

    // }
}