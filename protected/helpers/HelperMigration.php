<?php

class HelperMigration extends CDbMigration
{

    const SQL_COMMAND_DELIMETER = ';';

    public static function executeFile($filePath)
    {

        if (!isset($filePath)) return false;

        self::_infoLine($filePath);
        $time = microtime(true);
        $file = new TXFile(array(
            'path' => $filePath,
        ));

        if (!$file->exists)
            throw new Exception("'$filePath' is not a file");

        try {
            if ($file->open(TXFile::READ) === false)
                throw new Exception("Can't open '$filePath'");

            $total = floor($file->size / 1024);
            $command = '';
            while (!$file->endOfFile()) {
                $line = $file->readLine();
                $line = trim($line);
                // Ignore line if empty line or comment
                if (empty($line) || substr($line, 0, 2) == '--')
                    continue;
                $current = floor($file->tell() / 1024);
                self::_infoLine($filePath, " $current of $total KB");
                $command .= $line . ' ';
                if (strpos($line, self::SQL_COMMAND_DELIMETER)) {
                    $helper = new HelperMigration();
                    $helper->getDbConnection()->createCommand($command)->execute();
                    $command = '';
                }
            }

            $file->close();
        } catch (Exception $e) {
            $file->close();
            throw $e;
        }
        self::_infoLine($filePath, " done (time: " . sprintf('%.3f', microtime(true) - $time) . "s)\n");
    }

    protected static function _infoLine($filePath, $next = null)
    {
        echo "\r    > execute file $filePath ..." . $next;
    }

}