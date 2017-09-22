<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class HelpersStorage
{
    public static function CheckAndCreateWritableDir($path)
    {
        //die(var_dump($path));

        $path = str_replace("//", "/", $path);
        $dirs = explode("/", $path);
        $currentFolder = '';
        for ($x = 0; $x < count($dirs); $x++) {
            $currentFolder .= $dirs[$x] . '/';
            if (!file_exists($currentFolder)) {
                if (!mkdir($currentFolder, 0777, true)) {
                    die(Yii::t('mess', 'could_not_make') . $currentFolder);
                }
                HelpersStorage::SetFolderPermission($currentFolder, 0777);
                //@chmod($currentFolder, 0777);
            } elseif (!is_writable($currentFolder)) {
                if (!chmod($currentFolder, 0777)) {
                    die(Yii::t('mess', 'could_not_make') . $currentFolder);
                }
            }
        }
    }

    public static function SetFolderPermission($folder, $permission = 777)
    {
        //die(var_dump($folder, $permission));
        chmod($folder, intval($permission, 8));
        return true;
    }

    public static function GetFolderPermission($folder)
    {
        if (!is_dir($folder))
            return 0777;
        return substr(sprintf('%o', fileperms($folder)), -4);
    }

    public static function ListFilePermisions()
    {
        return array(
            '0777' => '777 (RWX RWX RWX)',
            '0775' => '775 (RWX RWX R-X)',
            '0774' => '774 (RWX RWX R--)',
            '0755' => '755 (RWX R-X R-X)',
        );
    }

    public static function UploadFiles($model, $path, $delete = true, $exten = "")
    {
        $path = $path;

        //var_dump($path.$model->id.DIRECTORY_SEPARATOR.$model->file);
        $model->files->saveAs($path . DIRECTORY_SEPARATOR . $model->id . DIRECTORY_SEPARATOR . $model->file);
        $ext = pathinfo($path . DIRECTORY_SEPARATOR . $model->id . DIRECTORY_SEPARATOR . $model->file, PATHINFO_EXTENSION);
        if ($ext === "" and $exten != "")
            $ext = $exten;
        $model->updateByPk($model->id, array('file' => $model->id . DIRECTORY_SEPARATOR . $model->file,
            'fileFormatId' => FileFormat::model()->find('extension=' . "'" . strtolower($ext) . "'")->id));

    }

    public static function RemoveFile($pathSource)
    {
        $pathSource = $pathSource;
        if (file_exists($pathSource)) {
            unlink($pathSource);
        } else {
            throw new CHttpException(500, Yii::t('mess', 'error_500_delete') . "{$pathSource}!!!");
        }
    }

    public static function RemoveDir($pathDir)
    {
        $pathDir = $pathDir;
        if (is_dir($pathDir)) {
            $objects = scandir($pathDir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (filetype($pathDir . "/" . $object) == "dir") rrmdir($pathDir . "/" . $object); else unlink($pathDir . "/" . $object);
                }
            }
            reset($objects);
            rmdir($pathDir);
        } else {
            throw new CHttpException(500, Yii::t('mess', 'error_500_delete') . "{$pathDir}!!!");
        }
    }

    public static function MoveDocFile($model)
    {
        $path = $model->type->category->storageDoc->path . DIRECTORY_SEPARATOR . $model->type->storageRoute->title . DIRECTORY_SEPARATOR . self::getPathId($model->instance_id);
        HelpersStorage::CheckAndCreateDir($path . DIRECTORY_SEPARATOR . $model->id);
        HelpersStorage::MoveFile(HelpersStorage::GetTempPath() . DIRECTORY_SEPARATOR . $model->file, $path . DIRECTORY_SEPARATOR . $model->file);
        $model->updateByPk($model->id, array('file' => self::getPathId($model->instance_id) . DIRECTORY_SEPARATOR . $model->file));
    }

    public static function getPathId($id)
    {

        $nr = array(5 => "0", 4 => "0", 3 => "0", 2 => "0", 1 => "0", 0 => "0");
        $n = strlen($id);
        for ($index = 0; $index < $n; $index++) {
            $nr[5 - $index] = $id[$n - $index - 1];
        }
        return $nr[0] . $nr[1] . $nr[2];
    }

    public static function CheckAndCreateDir($path)
    {
        //die(var_dump($path));

        $path = str_replace("//", "/", $path);
        $dirs = explode("/", $path);
        $currentFolder = '';
        for ($x = 0; $x < count($dirs); $x++) {
            $currentFolder .= $dirs[$x] . '/';
            if (!file_exists($currentFolder)) {
                if (!mkdir($currentFolder, 0777, true)) {
                    die(Yii::t('mess', 'could_not_make') . $currentFolder);
                }
            }
        }
    }

    public static function MoveFile($pathSource, $pathDestination)
    {
        $pathSource = $pathSource;
        $pathDestination = $pathDestination;
        if (file_exists($pathSource)) {
            if (!copy($pathSource, $pathDestination)) {
                echo 'failed to copy' . $pathSource . " ...\n";
            }
        } else {
            throw new CHttpException(500, 'error 500 open' . "{$pathSource}!!!");
        }
    }

    public static function GetTempPath()
    {
        $storages = Storage::model()->findByPk(0);
        return $storages->path;
    }

    public static function MoveFileToOperativ($model)
    {//die(var_dump($model));
        $path = DocumentType::model()->findByPk($model->type_id);
        //die(var_dump(HelpersStorage::GetTempPath().DIRECTORY_SEPARATOR.$model->file));
        HelpersStorage::CheckAndCreateDir(HelpersStorage::GetOperativPath($model->documentType->docCategory->storage) . DIRECTORY_SEPARATOR . $path->storageRoute->title . DIRECTORY_SEPARATOR . self::getPathId($model->instance_id) . DIRECTORY_SEPARATOR . $model->id);
        HelpersStorage::MoveFile(HelpersStorage::GetTempPath() . DIRECTORY_SEPARATOR . $model->file, HelpersStorage::GetOperativPath($model->documentType->docCategory->storage) . DIRECTORY_SEPARATOR . $path->storageRoute->title . DIRECTORY_SEPARATOR . self::getPathId($model->instance_id) . DIRECTORY_SEPARATOR . $model->file);
        $model->updateByPk($model->id, array('file' => self::getPathId($model->instance_id) . DIRECTORY_SEPARATOR . $model->file));
    }

    public static function GetOperativPath($id)
    {
        $storages = Storage::model()->findByPk($id);
        return $storages->path;
    }

    public static function GetFileFormatIdByExtension($ext)
    {
        $format = FileFormat::model()->find('extension=:extension', array(':extension' => strtolower($ext)));
        if (!isset($format))
            throw new CHttpException(500, Yii::t('mess', 'error_format'));
        return $format->id;
    }

    public static function StreamCopyFile($src, $dest)
    {
        $fsrc = fopen($src, 'r');
        $fdest = fopen($dest, 'w+');
        $len = stream_copy_to_stream($fsrc, $fdest);
        fclose($fsrc);
        fclose($fdest);
        return $len;
    }

    public static function deleteDir($dirPath)
    {
        if (!is_dir($dirPath)) {
            throw new InvalidArgumentException($dirPath . Yii::t('mess', 'error_must_be_dir'));
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                self::deleteDir($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dirPath);
    }
}

?>