<?php

/**
 * This component will install the User Module
 * @author Victor Martin
 */
class UserModuleInstall
{
    protected static $dbOptions = 'ENGINE=InnoDB CHARSET=utf8';
    protected static $userTableName = 'adm_user';
    protected static $profileTableName = 'adm_profile';
    protected static $profileAdditionalTableName = 'adm_profile_additional';

    protected static $userTableColumns = array(
        'id' => 'bigint(20) NOT NULL AUTO_INCREMENT PRIMARY KEY',
        'username' => 'string NOT NULL',
        'password_hash' => 'string NOT NULL',
        'ad_username' => 'varchar(45) DEFAULT NULL',
        'idnp' => 'bigint(13) DEFAULT NULL',
        'certificate_path' => 'string DEFAULT NULL',
        'create_user_id' => 'bigint(20) NOT NULL',
        'create_datetime' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP',
        'update_user_id' => 'bigint(20) DEFAULT NULL',
        'update_datetime' => 'datetime DEFAULT NULL',
    );

    protected static $profileTableColumns = array(
        'id' => 'bigint(20) NOT NULL AUTO_INCREMENT PRIMARY KEY',
        'email' => 'varchar(64) DEFAULT NULL',
        'firstname' => 'varchar(45) DEFAULT NULL',
        'lastname' => 'varchar(45) DEFAULT NULL',
        'gender' => "enum('m','f') DEFAULT NULL",
        'birthday' => 'date DEFAULT NULL',
        'about' => 'tinytext DEFAULT NULL',
        'update_datetime' => 'datetime DEFAULT NULL',
    );

    protected static $profileAdditionalTableColumns = array(
        'id' => 'bigint(20) NOT NULL AUTO_INCREMENT PRIMARY KEY',
    );

    public static function install()
    {
        self::_dropTables();
        if (self::_createTables() !== false)
            return true;
    }

    private static function _dropTables()
    {
        $connection = Yii::app()->db;
        $command = $connection->createCommand();

        $transaction = $connection->beginTransaction();
        try {
            // Dropping profile table
            $command->dropTable(self::$profileTableName);

            // Dropping profile Additional table
            $command->dropTable(self::$profileAdditionalTableName);

            // Dropping users table
            $command->dropTable(self::$userTableName);

            $transaction->commit();
        } catch (Exception $e) {
            echo "Exception: " . $e->getMessage() . "\n";
            $transaction->rollback();
            return false;
        }
    }

    private static function _createTables()
    {
        $connection = Yii::app()->db;
        $command = $connection->createCommand();

        $transaction = $connection->beginTransaction();
        try {
            // Create users table
            $command->createTable(self::$userTableName, self::$userTableColumns, self::$dbOptions);
            $command->insert(self::$userTableName, array(
                'id' => '1',
                'username' => 'admin',
                'password_hash' => '$2a$13$hUjtMwR9BNTyjGXw7vOByeoC2d1dnuuAwfu4QP5lckP55KMACXtru',
            ));

            // Creating profile table
            $command->createTable(self::$profileTableName, self::$profileTableColumns, self::$dbOptions);
            $command->insert(self::$profileTableName, array(
                'id' => '1',
            ));

            // Creating profile Additional table
            $command->createTable(self::$profileAdditionalTableName, self::$profileAdditionalTableColumns, self::$dbOptions);
            $command->insert(self::$profileAdditionalTableName, array(
                'id' => '1',
            ));

            $command->addForeignKey('fk_profile_user', self::$profileTableName, 'id', self::$userTableName, 'id', 'CASCADE', 'NO ACTION');
            $command->addForeignKey('fk_profile_additional_user', self::$profileAdditionalTableName, 'id', self::$userTableName, 'id', 'CASCADE', 'NO ACTION');

            $transaction->commit();
        } catch (Exception $e) {
            echo "Exception: " . $e->getMessage() . "\n";
            $transaction->rollback();
            return false;
        }
    }
}