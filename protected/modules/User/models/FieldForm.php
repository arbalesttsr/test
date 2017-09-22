<?php

/**
 * FieldForm class.
 * FieldForm is the data structure for keeping
 * user Field form data. It is used by the 'Fields' action of 'ProfileController'.
 */
class FieldForm extends CFormModel
{


    public $fieldType;
    public $name;
    public $type;
    public $length;
    public $values;
    public $defaultValue;
    public $index;
    public $comment;
    public $place;
    public $after;
    public $refTable;
    public $refColumn;
    public $unPrefixedRefTable;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules()
    {
        return array(
            array('name', 'required'),
            array('fieldType', 'in', 'range' => $this->getFieldTypes()),
            array('type', 'in', 'range' => $this->getDbTypes()),
            array('index', 'in', 'range' => $this->getIndexes()),
            array('length', 'numerical', 'integerOnly' => false),
            array('values', 'length', 'max' => 255),
            array('defaultValue,after,place', 'safe'),
            array('refTable', 'in', 'range' => ProfileAdditional::model()->getTableNames()),
            array('refColumn', 'length', 'max' => 255),
        );
    }

    public function getFieldTypes()
    {
        return Yii::app()->getModule('User')->fieldTypes;
    }

    public function getDbTypes()
    {
        return Yii::app()->getModule('User')->dbTypes;
    }

    public function getIndexes()
    {
        return Yii::app()->getModule('User')->indexes;
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
            'fieldType' => Yii::t('UserModule.t', 'FIELD_TYPE'),
            'length' => Yii::t('UserModule.t', 'LENGTH'),
            'defaultValue' => Yii::t('UserModule.t', 'DEFAULT_VALUE'),
            'refTable' => Yii::t('UserModule.t', 'REFERNCES_TABLE'),
            'refColumn' => Yii::t('UserModule.t', 'REFERENCES_COLUMN'),
            'values' => Yii::t('UserModule.t', 'VALUES'),
            'name' => Yii::t('UserModule.t', 'NAME'),
            'type' => Yii::t('UserModule.t', 'TYPE'),
            'place' => Yii::t('UserModule.t', 'PLACE'),
            'after' => Yii::t('UserModule.t', 'AFTER'),
        );
    }

    public function addField()
    {
        if ($this->addColumn()) {
            if ($this->saveFieldData())
                return true;
        } else {
            throw new CHttpException('', 'The field was not created.');
        }
    }

    public function addColumn()
    {

        $connection = Yii::app()->db;
        $sql = $this->buildSql();

        $transaction = $connection->beginTransaction();
        try {
            $command = $connection->createCommand($sql);
            $command->execute();
            if ($this->refTable) {
                $this->addForeignkey();
            }
            $transaction->commit();
            return true;
        } catch (Exception $e) {
            $transaction->rollback();
            return false;

            if (YII_DEBUG) {
                throw $e;
            } else
                throw new CHttpException('', 'The column was not created.');
        }
    }

    private function buildSql()
    {
        $connection = Yii::app()->db;
        $schema = $connection->getSchema();

        $tableName = $schema->getTable(ProfileAdditional::model()->tableName())->name;
        $quotedTableName = $schema->quoteTableName($tableName);

        $columnName = strtolower($this->name);
        $columnName = str_replace(array(' '), '_', preg_replace('/(?<![A-Z])[A-Z]/', ' \0', $columnName));
        $this->name = $columnName;
        $quotedColumnName = $schema->quoteColumnName($columnName);

        // Define the MySQL data type of the column.
        if (!empty($this->refTable) && !empty($this->refColumn)) {
            $table = $schema->getTable($this->refTable);
            $column = $table->getColumn('id');
            $type = $column->dbType;
        } else $type = $this->type;

        // Define the length of the type.
        $length = (!empty($this->length)) ? '(' . $this->length . ')' : '';
        $length = str_replace(".", ",", $length);

        // Define the values if the column type is ENUM.
        $values = '';
        if (!empty($this->values)) {
            $this->values = trim($this->values);
            $this->values = preg_replace(array('/[^ \w]+/', '/ +/'), array(' ', ' '), $this->values);
            $this->values = explode(' ', $this->values);
            $this->values = array_unique($this->values);
            $this->values = "('" . implode("','", $this->values) . "')";
            $values = $this->values;
        }

        $reservedValues = array('NULL', 'CURRENT_TIMESTAMP', 'null', 'current_timestamp');
        $defaultValue = '';
        if (!empty($this->defaultValue)) {
            if (in_array($this->defaultValue, $reservedValues)) {
                $defaultValue = ' DEFAULT ' . $this->defaultValue;
            } else $defaultValue = ' DEFAULT \'' . $this->defaultValue . '\'';
        }

        //$comment = ' COMMENT \''.$this->comment.'\'';

        $afterColumnName = $schema->quoteColumnName($this->after);
        $place = '';
        if ($this->place == 'FIRST') {
            $place = ' ' . $this->place;
        } elseif ($this->place == 'AFTER') {
            $place = ' ' . $this->place . ' ' . $afterColumnName;
        }

        $index = (!empty($this->index)) ? ', ADD ' . $this->index . '(' . $quotedColumnName . ')' : '';

        $sql = 'ALTER TABLE ' . $quotedTableName . ' ADD ' . $quotedColumnName . ' ' . $type . $length . $values . ' NULL' . $defaultValue . $place . $index;
        return $sql;
    }

    public function addForeignkey()
    {
        if ($this->refTable) {
            $refTable = $this->refTable;
            $unPrefixedRefTable = $this->removePrefix($refTable);
            $name = 'fk_profile_additional_' . $unPrefixedRefTable;
            $table = ProfileAdditional::model()->tableName();
            $newColumnName = $unPrefixedRefTable . '_id';

            $refColumns = 'id';
            $delete = 'CASCADE';
            $update = 'NO ACTION';

            $connection = Yii::app()->db;
            $command = $connection->createCommand();
            $command->renameColumn($table, $this->name, $newColumnName);
            $query = $command->addForeignKey($name, $table, $newColumnName, $refTable, $refColumns, $delete, $update);
            $this->name = $newColumnName;
        }
    }

    public function removePrefix($tableName)
    {
        if (!strpos($tableName, '_'))
            return $tableName;
        else {
            $tableNameElements = explode('_', $tableName);
            unset($tableNameElements[0]);
            return implode('_', $tableNameElements);
        }
    }

    public function saveFieldData()
    {

        $file = dirname(__FILE__) . '/../data/profile/fields.json';
        if (!file_exists($file)) {
            throw new CHttpException('', 'The fields configuration file not found. Contact the adminsitrator.');
        }
        $fieldsConfig = json_decode(file_get_contents($file), true);
        if ($fieldsConfig === null)
            $fieldsConfig = array();
        if ($this->refTable) {
            $fieldsConfig[$this->name] = array('fieldType' => $this->fieldType, 'refTable' => $this->refTable, 'refColumn' => $this->refColumn);
        } else
            $fieldsConfig[$this->name] = array('fieldType' => $this->fieldType);

        if (file_put_contents($file, json_encode($fieldsConfig))) {
            return true;
        } else
            return false;
    }

    public function deleteField()
    {
        $connection = Yii::app()->db;
        $schema = $connection->getSchema();
        $command = $connection->createCommand();
        $table = $schema->getTable(ProfileAdditional::model()->tableName());
        $column = $table->getColumn($this->name);
        $unSufixedColumn = $this->removeSufix($column->name);
        $foreignKeyName = 'fk_profile_additional_' . $unSufixedColumn;

        $transaction = $connection->beginTransaction();
        try {
            if ($column->isForeignKey) {
                $command->dropForeignKey($foreignKeyName, $table->name);
            }
            $command->dropColumn($table->name, $column->name);
            $transaction->commit();
            $this->removeFieldData();
            return true;
        } catch (Exception $e) {
            $transaction->rollback();
            if (YII_DEBUG) {
                throw $e;
            } else
                throw new CHttpException('', 'The field was not deleted.');
        }
        return true;
    }

    public function removeSufix($columnName)
    {
        if (!strpos($columnName, '_'))
            return $columnName;
        else {
            $columnNameElements = explode('_', $columnName);
            $lastElement = array_pop($columnNameElements);
            return implode('_', $columnNameElements);
        }
    }

    public function removeFieldData()
    {

        $file = dirname(__FILE__) . '/../data/profile/fields.json';
        if (!file_exists($file)) {
            throw new CHttpException('', 'The fields configuration file not found. Contact the adminsitrator.');
        }
        $fieldsConfig = json_decode(file_get_contents($file), true);
        if ($fieldsConfig[$this->name]) {
            unset($fieldsConfig[$this->name]);
            file_put_contents($file, json_encode($fieldsConfig));
        }
        return true;
    }
}
