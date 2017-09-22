<?php

/**
 * Created by PhpStorm.
 * User: birca
 * Date: 11/17/14
 * Time: 10:16 AM
 */
class AuditHttpSession extends CDbHttpSession
{
    public function writeSession($id, $data)
    {
        parent::writeSession($id, $data);
        $id = md5($id);
        $db = $this->getDbConnection();
        $vhost = SiteController::getVHost();
        $vhost_id = empty($vhost) ? 'null' : $vhost->id;
        $user_id = empty(user()->id) ? 'null' : user()->id;
        $remote_addr = self::getRemoteAddr();
        $sql = "UPDATE " . $this->sessionTableName . " SET vhost_id = " . $vhost_id . ", user_id = " . $user_id . ", remote_addr = '" . $_SERVER['REMOTE_ADDR'] . "', updated_at = '" . date('Y-m-d H:i:s') . "' WHERE id = '" . $id . "'";
        $command = $db->createCommand($sql);
        $command->execute();
        return true;
    }

    public function getRemoteAddr()
    {
        if (getenv("HTTP_CLIENT_IP"))
            $ip = getenv("HTTP_CLIENT_IP");
        else if (getenv("HTTP_X_FORWARDED_FOR"))
            $ip = getenv("HTTP_X_FORWARDED_FOR");
        else if (getenv("REMOTE_ADDR"))
            $ip = getenv("REMOTE_ADDR");
        else
            $ip = "UNKNOWN";
        return $ip;
    }
}