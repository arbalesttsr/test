<?php

class RemoteCreateDoc extends CWidget
{
    public $model;
    public $modelName;
    public $attrName;
    public $selectExistent = true;
    public $createNew = true;

    public function run()
    {
        $this->render('remoteCreateDoc', array(
            'model' => $this->model,
            'modelName' => $this->modelName,
            'attrName' => $this->attrName,
            'selectExistent' => $this->selectExistent,
            'createNew' => $this->createNew
        ));
    }
}

?>