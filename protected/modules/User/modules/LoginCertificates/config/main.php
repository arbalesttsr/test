<?php
/**
 * Created by PhpStorm.
 * User: tudor
 * Date: 9/30/14
 * Time: 4:48 PM
 */

$module_name = basename(dirname(dirname(__FILE__)));
$module_tree = 'User.modules.LoginCertificates';
return array(
    'import' => array(
        'application.modules..*',
        'application.modules.' . $module_tree . '.models.*',
        'application.modules.' . $module_tree . '.controllers.*',
        'application.modules.' . $module_tree . '.views.*',
        'application.modules.' . $module_tree . '.helpers.*',
        'application.modules.' . $module_tree . '.components.*',
    ),

    'modules' => array(
        'User' => array(

            'modules' => array(
                $module_name => array(
                    /**
                     * OPENSSL configuration
                     * To work, it requires PHP extension php_openssl. You may load it in php.ini file.
                     * @link http://www.php.net/manual/en/book.openssl.php
                     */

                    'openssl' => array(
                        // The location where will be store created certificates.
                        'certificatesPath' => dirname(__FILE__) . '/../../../data/certificates/',

                        // Configs used for creating private and public keys pair.
                        'configArgs' => array(
                            'config' => dirname(__FILE__) . '/../data/openssl.cnf', // Make sure if the file is in that location.
                            'digest_alg' => 'sha512', // One of the following option: DSA, DSA-SHA, MD2, MD4, MD5, RIPEMD160, SHA, SHA1, SHA224, SHA256, SHA384, SHA512
                            'private_key_bits' => 2048, // Options: 1024, 2048 (recommended), 4096
                            'private_key_type' => OPENSSL_KEYTYPE_RSA, // Options: openssl constants: OPENSSL_KEYTYPE_RSA, OPENSSL_KEYTYPE_DSA
                            //'encrypt_key' => true,
                        ),
                        'dn' => array(
                            'countryName' => 'MD',
                            'stateOrProvinceName' => 'Moldova',
                            'localityName' => 'Chisinau',
                            'organizationName' => 'Company',
                            'organizationalUnitName' => 'ou',
                            'commonName' => '',
                            'emailAddress' => 'example@mail.com',
                        ),
                    ),
                    'front_tiles' => array(
                        'icon' => 'group',
                        'color' => 'grape',
                    )
                ),
            ),

        ),
    ),

    'components' => array(

        'urlManager' => array(
            'rules' => array(),
        ),
    ),
);
?>