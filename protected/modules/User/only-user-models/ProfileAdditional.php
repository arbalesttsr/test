<?php
Yii::import('system.gii.CCodeModel');

/**
 * This is the model class for table "{{profile_additional}}".
 *
 * The followings are the available columns in table '{{profile_additional}}':
 * @property integer $id
 *
 * The followings are the available model relations:
 * @property User $user
 */
class ProfileAdditional extends CActiveRecord
{
    public $buildRelations = true;
    public $tablePrefix;
    public $tableName;
    public $modelClass;

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Profile the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        /* return array(
         array('user_id', 'numerical', 'integerOnly'=>true),
        ); */
        $rules = $this->generateRules();
        return $rules;
    }

    public function generateRules()
    {
        $table = Yii::app()->db->getSchema()->getTable('adm_profile_additional');

        $rules = array();
        $required = array();
        $integers = array();
        $numerical = array();
        $length = array();
        $safe = array();
        $in = $this->getEnumValues();
        foreach ($table->columns as $column) {
            if ($column->autoIncrement)
                continue;
            $r = !$column->allowNull && $column->defaultValue === null;
            if ($r)
                $required[] = $column->name;
            if ($column->type === 'integer')
                $integers[] = $column->name;
            elseif ($column->type === 'double')
                $numerical[] = $column->name;
            elseif ($column->type === 'string' && $column->size > 0)
                $length[$column->size][] = $column->name;
            elseif (!$column->isPrimaryKey && !$r)
                $safe[] = $column->name;
        }
        if ($required !== array())
            $rules[] = array(implode(', ', $required), 'required');
        if ($integers !== array())
            $rules[] = array(implode(', ', $integers), 'numerical', 'integerOnly' => true);
        if ($numerical !== array())
            $rules[] = array(implode(', ', $numerical), 'numerical');
        if ($length !== array()) {
            foreach ($length as $len => $cols)
                $rules[] = array(implode(', ', $cols), 'length', 'max' => $len);
        }
        if ($safe !== array())
            $rules[] = array(implode(', ', $safe), 'safe');
        if ($in !== array()) {
            foreach ($in as $column => $values)
                $rules[] = array($column, 'in', 'range' => $values);
        }
        return $rules;
    }

    public function getEnumValues()
    {
        $table = Yii::app()->db->getSchema()->getTable($this->tableName());
        $range = array();

        foreach ($table->columns as $column) {
            if (stripos($column->dbType, 'enum') !== false) {
                $values = substr($column->dbType, 5, -1);
                $values = str_replace(array('\''), '', preg_replace('/(?<![A-Z])[A-Z]/', ' \0', $values));
                $values = explode(',', $values);
                $values = array_combine($values, $values);
                $range[$column->name] = $values;
            }
        }

        return $range;
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'adm_profile_additional';
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;
        $table = Yii::app()->db->getSchema()->getTable($this->tableName());
        foreach ($table->columns as $column) {
            /* if ($column->isForeignKey) {
                $criteria->with = $this->attributeLabels()[$column->name];
                $criteria->compare($this->attributeLabels()[$column->name].'.name', $this->nationality_id,true);
            } */
            $criteria->compare($column->name, $this->id);
        }
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function getTableNames()
    {
        $tableNames = Yii::app()->db->getSchema()->getTableNames();
        $tableNames = array_combine($tableNames, $tableNames);
        if (key_exists($this->tableName(), $tableNames)) {
            unset($tableNames[$this->tableName()]);
        }
        return $tableNames;
    }

    public function getColumnAttributes($modelName, $name = 'name')
    {
        $relations = $this->relations();
        $labels = $this->attributeLabels();
        $exclude = array('id', 'user_id');
        $exclude = array_combine($exclude, $exclude);
        $attributes = array_diff_key($labels, $exclude);

        $file = dirname(__FILE__) . '/../data/profile/fields.json';
        if (!file_exists($file)) {
            throw new CHttpException('', 'The fields configuration file not found. Contact the adminsitrator.');
        }
        $fieldsConfig = json_decode(file_get_contents($file), true);

        foreach ($attributes as $attribute => $label) {
            $values[$attribute] = $modelName->$attribute;

            foreach ($relations as $relationName => $params) {
                if ($attribute == $params[2]) {
                    //$name = $this->getSecondColumn($attribute);
                    $name = $fieldsConfig[$attribute]['refColumn'];
                    $values[$attribute] = CHtml::decode((isset($modelName->$relationName->$name)) ? $modelName->$relationName->$name : '');
                }
            }
            $attributes[$attribute] = array(
                'name' => $attribute,
                'label' => Yii::t('UserModule.t', $label),
                'value' => $values[$attribute]
            );
        }
        return $attributes;
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        /* return array(
            'id' => array(self::BELONGS_TO, 'User', 'id'),
        ); */
        $relations = $this->generateRelations();
        return isset($relations[__CLASS__]) ? $relations[__CLASS__] : array();
    }

    public function generateRelations()
    {
        if (!$this->buildRelations)
            return array();

        $schemaName = '';
        if (($pos = strpos($this->tableName, '.')) !== false) {
            $schemaName = substr($this->tableName, 0, $pos);
        }

        $relations = array();
        $table = Yii::app()->db->getSchema()->getTable($this->tableName());
        /*if($this->tablePrefix!='' && strpos($table->name,$this->tablePrefix)!==0) {
            continue;
        }*/
        $tableName = $table->name;

        if ($this->isRelationTable($table)) {
            $pks = $table->primaryKey;
            $fks = $table->foreignKeys;

            $table0 = $fks[$pks[0]][0];
            $table1 = $fks[$pks[1]][0];
            $className0 = $this->generateClassName($table0);
            $className1 = $this->generateClassName($table1);

            $unprefixedTableName = $this->removePrefix($tableName);

            $relationName = $this->generateRelationName($table0, $table1, true);
            $relations[$className0][$relationName] = array(self::MANY_MANY, $className1, $unprefixedTableName($pks[0], $pks[1]));

            $relationName = $this->generateRelationName($table1, $table0, true);

            $i = 1;
            $rawName = $relationName;
            while (isset($relations[$className1][$relationName])) {
                $relationName = $rawName . $i++;
            }

            $relations[$className1][$relationName] = array(self::MANY_MANY, $className0, $unprefixedTableName($pks[1], $pks[0]));
        } else {
            $className = $this->generateClassName($tableName);
            foreach ($table->foreignKeys as $fkName => $fkEntry) {
                // Put table and key name in variables for easier reading
                $refTable = $fkEntry[0]; // Table name that current fk references to
                $refKey = $fkEntry[1];   // Key in that table being referenced
                $refClassName = $this->generateClassName($refTable);

                // Add relation for this table
                $relationName = $this->generateRelationName($tableName, $fkName, false);
                $relations[$className][$relationName] = array(self::BELONGS_TO, $refClassName, $fkName);

                // Add relation for the referenced table
                $relationType = $table->primaryKey === $fkName ? 'HAS_ONE' : 'HAS_MANY';
                $relationName = $this->generateRelationName($refTable, $this->removePrefix($tableName, false), $relationType === 'HAS_MANY');
                $i = 1;
                $rawName = $relationName;
                while (isset($relations[$refClassName][$relationName]))
                    $relationName = $rawName . ($i++);
                $relations[$refClassName][$relationName] = "array(self::$relationType, '$className', '$fkName')";
            }
        }
        return $relations;
    }

    /**
     * Checks if the given table is a "many to many" pivot table.
     * Their PK has 2 fields, and both of those fields are also FK to other separate tables.
     * @param CDbTableSchema table to inspect
     * @return boolean true if table matches description of helpter table.
     */
    protected function isRelationTable($table)
    {
        $pk = $table->primaryKey;
        return (count($pk) === 2 // we want 2 columns
            && isset($table->foreignKeys[$pk[0]]) // pk column 1 is also a foreign key
            && isset($table->foreignKeys[$pk[1]]) // pk column 2 is also a foriegn key
            && $table->foreignKeys[$pk[0]][0] !== $table->foreignKeys[$pk[1]][0]); // and the foreign keys point different tables
    }

    protected function generateClassName($tableName)
    {
        if ($this->tableName === $tableName || ($pos = strrpos($this->tableName, '.')) !== false && substr($this->tableName, $pos + 1) === $tableName)
            return $this->modelClass;

        $tableName = $this->removePrefix($tableName, false);
        if (($pos = strpos($tableName, '.')) !== false) // remove schema part (e.g. remove 'public2.' from 'public2.subsidiary')
            $tableName = substr($tableName, $pos + 1);
        $className = '';
        foreach (explode('_', $tableName) as $name) {
            if ($name !== '')
                $className .= ucfirst($name);
        }
        return $className;
    }

    protected function removePrefix($tableName, $addBrackets = true)
    {
        $prefix = $this->tablePrefix != '' ? $this->tablePrefix : Yii::app()->db->tablePrefix;
        if ($prefix != '') {
            if ($addBrackets && Yii::app()->db->tablePrefix != '') {
                $prefix = Yii::app()->db->tablePrefix;
                $lb = '{{';
                $rb = '}}';
            } else
                $lb = $rb = '';
            if (($pos = strrpos($tableName, '.')) !== false) {
                $schema = substr($tableName, 0, $pos);
                $name = substr($tableName, $pos + 1);
                if (strpos($name, $prefix) === 0)
                    return $schema . '.' . $lb . substr($name, strlen($prefix)) . $rb;
            } elseif (strpos($tableName, $prefix) === 0)
                return $lb . substr($tableName, strlen($prefix)) . $rb;
        } else {
            if (strpos($tableName, '_')) {
                $tableNameElements = explode('_', $tableName);
                unset($tableNameElements[0]);
                $tableName = implode('_', $tableNameElements);
            }
        }
        return $tableName;
    }

    /**
     * Generate a name for use as a relation name (inside relations() function in a model).
     * @param string the name of the table to hold the relation
     * @param string the foreign key name
     * @param boolean whether the relation would contain multiple objects
     * @return string the relation name
     */
    protected function generateRelationName($tableName, $fkName, $multiple)
    {
        if (strcasecmp(substr($fkName, -2), 'id') === 0 && strcasecmp($fkName, 'id'))
            $relationName = rtrim(substr($fkName, 0, -2), '_');
        else
            $relationName = $fkName;
        $relationName[0] = strtolower($relationName);

        if ($multiple)
            $relationName = $this->pluralize($relationName);

        $names = preg_split('/_+/', $relationName, -1, PREG_SPLIT_NO_EMPTY);
        if (empty($names)) return $relationName;  // unlikely
        for ($name = $names[0], $i = 1; $i < count($names); ++$i)
            $name .= ucfirst($names[$i]);

        $rawName = $name;
        $table = Yii::app()->db->schema->getTable($tableName);
        $i = 0;
        while (isset($table->columns[$name]))
            $name = $rawName . ($i++);

        return $name;
    }

    /**
     * Converts a word to its plural form.
     * Note that this is for English only!
     * For example, 'apple' will become 'apples', and 'child' will become 'children'.
     * @param string $name the word to be pluralized
     * @return string the pluralized word
     */
    public function pluralize($name)
    {
        $rules = array(
            '/(m)ove$/i' => '\1oves',
            '/(f)oot$/i' => '\1eet',
            '/(c)hild$/i' => '\1hildren',
            '/(h)uman$/i' => '\1umans',
            '/(m)an$/i' => '\1en',
            '/(s)taff$/i' => '\1taff',
            '/(t)ooth$/i' => '\1eeth',
            '/(p)erson$/i' => '\1eople',
            '/([m|l])ouse$/i' => '\1ice',
            '/(x|ch|ss|sh|us|as|is|os)$/i' => '\1es',
            '/([^aeiouy]|qu)y$/i' => '\1ies',
            '/(?:([^f])fe|([lr])f)$/i' => '\1\2ves',
            '/(shea|lea|loa|thie)f$/i' => '\1ves',
            '/([ti])um$/i' => '\1a',
            '/(tomat|potat|ech|her|vet)o$/i' => '\1oes',
            '/(bu)s$/i' => '\1ses',
            '/(ax|test)is$/i' => '\1es',
            '/s$/' => 's',
        );
        foreach ($rules as $rule => $replacement) {
            if (preg_match($rule, $name))
                return preg_replace($rule, $replacement, $name);
        }
        return $name . 's';
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        $table = Yii::app()->db->getSchema()->getTable($this->tableName());
        $labels = $this->generateLabels($table);
        return $labels;
    }

    public function generateLabels($table)
    {
        $labels = array();
        foreach ($table->columns as $column) {
            $label = ucwords(trim(strtolower(str_replace(array('-', '_'), ' ', preg_replace('/(?<![A-Z])[A-Z]/', ' \0', $column->name)))));
            $label = preg_replace('/\s+/', ' ', $label);
            if (strcasecmp(substr($label, -3), ' id') === 0) {
                $label = substr($label, 0, -3);
            }
            if ($label === 'Id') {
                $label = 'ID';
            }
            $label = str_replace("'", "\\'", $label);
            $labels[$column->name] = Yii::t('UserModule.t', $label);
        }
        return $labels;
    }

    public function getSecondColumn($columnName)
    {
        $foreignKeys = Yii::app()->db->getSchema()->getTable($this->tableName())->foreignKeys;
        $requestedTableName = $foreignKeys[$columnName][0];
        $requestedColumns = Yii::app()->db->getSchema()->getTable($requestedTableName)->columns;
        foreach ($requestedColumns as $column) {
            if ($column->name == 'id')
                continue;
            $requestedColumn = $requestedColumns[$column->name];
            break;
        }
        return $requestedColumn->name;
    }

    public function getValuesFromTable($columnName)
    {
        $connection = Yii::app()->db;
        $schema = $connection->getSchema();
        $table = $schema->getTable($this->tableName);
        $foreignKeys = $table->foreignKeys;
        $column = $table->getColumn($columnName);

        $command = $connection->createCommand()
            ->select($columnName)
            ->from($foreignKeys[$columnName][0]);

        $query = $command->queryAll();
        //var_dump($query);
        $rows = array();
        foreach ($query as $key => $value) {
            foreach ($value as $k => $v) {
                if (!empty($v)) {
                    $rows[] = $v;
                }
            }
        }
        //var_dump($rows);
        $keys = array();
        foreach ($rows as $key => $row) {
            $command = $connection->createCommand()
                ->select('id')
                ->from($foreignKeys[$columnName][0])
                ->where("$columnName=:row", array(':row' => $row));

            $query = $command->queryRow();
            $keys[] = $query;
        }
        //die(var_dump($keys));
        $ids = array();
        foreach ($keys as $key => $value) {
            if (!empty($value)) {
                foreach ($value as $k => $v) {
                    $ids[] = $v;
                }
            }
        }
        //var_dump($ids);

        if (strpos($foreignKeys[$columnName][1], 'id') !== false) {
            $values = array_combine($ids, $rows);
        } else $values = array_combine($rows, $rows);

        return $values;
    }

    protected function beforeSave()
    {
        if (parent::beforeSave()) {
            if ($this->isNewRecord) {
                return true;
            } else {
                if (isset($_GET['id'])) {
                    $profile = Profile::model()->findByPk($_GET['id']);
                    $profile->update_datetime = date('Y-m-d H:i:s');
                    if ($profile->save()) {
                        return true;
                    }
                } else {
                    return true;
                }
            }
        } else
            return false;
    }
}