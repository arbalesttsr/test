<?php

class RemoteCreateClasificator extends CWidget
{
    public $model;
    public $modelName;
    public $modelAttr;
    public $attrName;
    public $selectExistent = true;
    public $createNew = true;
    public $dependsAttribute = false;
    public $dependsRemoteAttribute = false;

    public function run()
    {
        $this->render('remoteCreateClasificator', array(
            'model' => $this->model,
            'modelName' => $this->modelName,
            'modelAttr' => $this->modelAttr,
            'attrName' => $this->attrName,
            'selectExistent' => $this->selectExistent,
            'createNew' => $this->createNew,
            'dependsAttribute' => $this->dependsAttribute,
            'dependsRemoteAttribute' => $this->dependsRemoteAttribute,
        ));
    }
}

?>