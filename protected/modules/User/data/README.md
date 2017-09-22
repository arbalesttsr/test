User Module
===========

User Module is a module for creating and managing users. It provides 4 different logging methods.

DIRECTORY STRUCTURE
-------------------

      user/                   the base folder of the module
          components/         the components used by the module
              cts/            component for SAML login through CTS.
          config/             main.php - the configuration file for the module
          controllers/     
          data/               
              certificates/   here wil be stored all certificates created by User module
              openssl.cnf     configuration file used by php_openssl extension
              user.sql        MySQL dump for user module
          messages/           translations
              en/
              ro/
              ru/
          models/             
          views/
          UserModule.php      


REQUIREMENTS
------------

This module require the following PHP extensions: 
    [php_ldap](http://www.php.net/manual/en/book.ldap.php) 
    [php_openssl](http://www.php.net/manual/en/book.openssl.php).

It requires to enable URLs in path-format. Enable urlManager.
    In configuration file main.php

    'components' => array(
          ...
          'urlManager'=>array(
              'urlFormat'=>'path',
              'rules'=>array(
                ......
              ),
          ),
          ...
      )



CONFIGURATION
-------------

### Configure the main.php config file.

You must add the following code under 'modules' key section:

'modules'=>array(
        'User'=>array(
            'class' => 'application.modules.user.UserModule',
            
            /**
             * LDAP configuration
             * To work, it requires PHP extension php_ldap. You may load it in php.ini file.
             * @link http://www.php.net/manual/en/book.ldap.php
             */
            'ldap' => array(
                'host' => '', // add your ldap host
                'ou'   => 'organisational-unit', // such as "people" or "users"
                'port' => '389',
                'dc'   => array(),
            ),
            
            /**
             * OPENSSL configuration
             * To work, it requires PHP extension php_openssl. You may load it in php.ini file.
             * @link http://www.php.net/manual/en/book.openssl.php
             */
            
            'openssl' => array(
                // The location where will be store created certificates.
                'certificatesPath' => dirname(__FILE__).'/../modules/user/data/certificates/',
                                
                // Configs used for creating private and public keys pair.
                'configArgs' => array(
                    'config'           => dirname(__FILE__).'/../modules/user/data/openssl.cnf', // Make sure if the file is in that location.
                    'digest_alg'       => 'sha512', // One of the following option: DSA, DSA-SHA, MD2, MD4, MD5, RIPEMD160, SHA, SHA1, SHA224, SHA256, SHA384, SHA512
                    'private_key_bits' => 2048, // Options: 1024, 2048 (recommended), 4096
                    'private_key_type' => OPENSSL_KEYTYPE_RSA, // Options: openssl constants: OPENSSL_KEYTYPE_RSA, OPENSSL_KEYTYPE_DSA
                    //'encrypt_key' => true,
                ),
                'dn' => array(

                    // You may add defaults value

                    'countryName'            => 'AB',
                    'stateOrProvinceName'    => 'Country',
                    'localityName'           => 'City',
                    'organizationName'       => 'Company',
                    'organizationalUnitName' => 'ou',
                    'commonName'             => 'Name',
                    'emailAddress'           => 'mail@mail.com',
                ),
            ),
            
            /**
             * the following are available login methods
             */
            'loginMethods' => array(
                
                // You may comment the method you want te be inaccessible.
                
                '1'=>'Default Login',
                '2'=>'Active Directory Login',
                '3'=>'Certificate Login',
                '4'=>'CTS Login'  
            ),
        ),
    ),

Add loginUrl for user component in configuration.
    In configuration file main.php

    'components' => array(
          ...
          'user'=>array(
              // enable cookie-based authentication
              'allowAutoLogin'=>true,
              'loginUrl' => array('/User/site/login'),
          ),
          ...
      )


INSTALLATION
------------

After proper configuration, you may install the module using integrated installation procedure
Go to: http://yourBaseUrl/user/default/installation
