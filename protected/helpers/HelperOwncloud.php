<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FileWrite
 *
 * @author Administrator
 */
class HelperOwncloud
{

    // Add data, to owncloud post array and then Send the http request for creating a new user
    public static function CreateUser($user_synapsis)
    {
        try {
            if (isset($user_synapsis)) {
                $owncloud_config = OwncloudConfig::model()->findByPk(1);
                if (isset($owncloud_config)) {
                    $ownCloudPOSTArray = [
                        'userid' => $user_synapsis->username,
                        'password' => $user_synapsis->password
                    ];

                    $ch = curl_init($owncloud_config->url . 'ocs/v1.php/cloud/users');

                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $ownCloudPOSTArray);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                    curl_setopt($ch, CURLOPT_USERPWD, $owncloud_config->admin_user . ':' . $owncloud_config->password);
                    curl_exec($ch);
                    curl_close($ch);
                }

            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    // edit data, to owncloud put array and then Send the http request for edit a user
    public static function EditUser($user_id)
    {
        try {
            if (isset($user_id)) {
                $owncloud_config = OwncloudConfig::model()->findByPk(1);
                if (isset($owncloud_config)) {

                    $user_synapsis = User::model()->findByPk($user_id);


                    $ch = curl_init($owncloud_config->url . 'ocs/v1.php/cloud/users/' . $user_synapsis->username);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                    curl_setopt($ch, CURLOPT_USERPWD, $owncloud_config->admin_user . ':' . $owncloud_config->password);
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                    $data = [
                        'key' => 'display',
                        'value' => $user_synapsis->getFull_name(),
                    ];
                    $data_json = http_build_query($data);


                    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded', 'Content-Length: ' . strlen($data_json)));
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);

                    $response = curl_exec($ch);
                    curl_close($ch);

                    /*$ch = curl_init($owncloud_config->url.'ocs/v1.php/cloud/users/'.$user_synapsis->username);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                    curl_setopt($ch, CURLOPT_USERPWD, $owncloud_config->admin_user.':'.$owncloud_config->password);
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                    $data = [
                        'key'=>'password',
                        'value'=>$user_synapsis->password_hash,
                    ];
                    $data_json = http_build_query($data);


                    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded','Content-Length: ' . strlen($data_json)));
                    curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);

                    $response = curl_exec($ch);
                    curl_close($ch);*/

                    $ch = curl_init($owncloud_config->url . 'ocs/v1.php/cloud/users/' . $user_synapsis->username);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                    curl_setopt($ch, CURLOPT_USERPWD, $owncloud_config->admin_user . ':' . $owncloud_config->password);
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $data = [
                        'key' => 'email',
                        'value' => $user_synapsis->profile->email,
                    ];
                    $data_json = http_build_query($data);


                    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded', 'Content-Length: ' . strlen($data_json)));
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);

                    $response = curl_exec($ch);
                    curl_close($ch);
                }

            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    // delete data, to owncloud delete and then Send the http request for delete a user
    public static function DeleteUser($user_name)
    {
        try {
            if (isset($user_name)) {
                $owncloud_config = OwncloudConfig::model()->findByPk(1);
                if (isset($owncloud_config)) {
                    $ch = curl_init($owncloud_config->url . 'ocs/v1.php/cloud/users/' . $user_name);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                    curl_setopt($ch, CURLOPT_USERPWD, $owncloud_config->admin_user . ':' . $owncloud_config->password);
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                    $response = curl_exec($ch);
                    curl_close($ch);
                }

            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    // Share file
    public static function ShareFile($user_id = null, $role = null, $model_id, $rights_list = array())
    {
        try {
            if ((!is_null($user_id) || !is_null($role)) && isset($model_id) && !empty($rights_list)) {
                $owncloud_config = OwncloudConfig::model()->findByPk(1);
                if (isset($owncloud_config)) {
                    if (!is_null($user_id))
                        $user_synapsis = User::model()->findByPk($user_id);
                    else
                        $users_synapsis = Yii::app()->db->createCommand()
                            ->select('userid')
                            ->from("authassignment")
                            ->where('itemname=:role', array(
                                ':role' => $role,))
                            ->queryAll();

                    $modelName = Document::model()->findByPk($model_id)->type->instance_model_name;

                    $model = $modelName::model()->findByAttributes(array('document_id' => $model_id));
                    if (isset($model)) {
                        $doc = DIRECTORY_SEPARATOR . $owncloud_config->default_folder . DIRECTORY_SEPARATOR .
                            $model->document->type->storageRoute->title . DIRECTORY_SEPARATOR . $model->document->file;

                        $ownCloudPOSTArray = [
                            'path' => $doc,

                        ];

                        $ch = curl_init($owncloud_config->url . 'ocs/v1.php/apps/files_sharing/api/v1/shares?' . http_build_query($ownCloudPOSTArray));

                        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                        curl_setopt($ch, CURLOPT_USERPWD, $owncloud_config->admin_user . ':' . $owncloud_config->password);

                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        $response = simplexml_load_string(curl_exec($ch));
                        curl_close($ch);

                        if (isset($users_synapsis)) {
                            foreach ($users_synapsis as $user_synapsis)
                                if (isset(User::model()->findByPk((int)$user_synapsis["userid"])->username)) {
                                    $exist = false;
                                    if (isset($response->data->element))
                                        foreach ($response->data->element as $data) {
                                            $exist = (string)$data->share_with === User::model()->findByPk((int)$user_synapsis["userid"])->username;
                                            if ($exist)
                                                break;
                                        }
                                    if (!$exist)
                                        self::setShare($owncloud_config, $doc, User::model()->findByPk((int)$user_synapsis["userid"])->username, $rights_list);
                                }
                        } elseif (isset($user_synapsis)) {
                            $exist = false;
                            if (isset($response->data->element))
                                foreach ($response->data->element as $data) {
                                    $exist = (string)$data->share_with === $user_synapsis->username;
                                    if ($exist)
                                        break;
                                }
                            if (!$exist)
                                self::setShare($owncloud_config, $doc, $user_synapsis->username, $rights_list);
                        }
                    }

                }
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }


    }

    private static function setShare($owncloud_config, $doc, $user_name, $right)
    {
        try {
            $ch = curl_init($owncloud_config->url . 'ocs/v1.php/apps/files_sharing/api/v1/shares');

            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($ch, CURLOPT_USERPWD, $owncloud_config->admin_user . ':' . $owncloud_config->password);

            $ownCloudPOSTArray = [
                'path' => $doc,
                'shareType' => 0,
                'shareWith' => $user_name,
                //'publicUpload' => false,
                //'password' => '',
                //'permissions' => 2,

            ];


            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $ownCloudPOSTArray);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public static function openDocument($model_id)
    {
        $owncloud_config = OwncloudConfig::model()->findByPk(1);

        if (isset($owncloud_config)) {
            $modelName = Document::model()->findByPk($model_id)->type->instance_model_name;
            $model = $modelName::model()->findByAttributes(array('document_id' => $model_id));

            if (isset($model)) {
                $doc = DIRECTORY_SEPARATOR . $owncloud_config->default_folder . DIRECTORY_SEPARATOR .
                    $model->document->type->storageRoute->title . DIRECTORY_SEPARATOR . $model->document->file;

                $ownCloudPOSTArray = [
                    'path' => $doc,

                ];

                $ch = curl_init($owncloud_config->url . 'ocs/v1.php/apps/files_sharing/api/v1/shares?' . http_build_query($ownCloudPOSTArray));

                curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                curl_setopt($ch, CURLOPT_USERPWD, $owncloud_config->admin_user . ':' . $owncloud_config->password);

                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = simplexml_load_string(curl_exec($ch));
                curl_close($ch);

                header("Location: " . $owncloud_config->url . "/index.php/apps/documents/index#" . (string)$response->data->element->item_source);
            }
        }
    }
}

?>
