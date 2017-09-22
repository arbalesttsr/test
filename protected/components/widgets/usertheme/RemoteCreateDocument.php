<?php

class RemoteCreateDocument extends CWidget
{
    public $model;
    public $modelName;
    public $realName;
    public $attrName;

    public function run()
    {
        $this->render('remoteCreateDocument', array(
            'model' => $this->model,
            'modelName' => $this->modelName,
            'realName' => $this->realName,
            'attrName' => $this->attrName
        ));
    }
}

?>