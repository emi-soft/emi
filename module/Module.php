<?php
/**
 * Created by Maksim Skliarov.
 * Project: emi-cms
 * Company: Emi-Soft <emi.softdeveloper@gmail.com>
 * Date: 05/09/2018
 */

namespace emi\module;

/**
 * This is the model class for table "{{%module}}".
 *
 * @property string       $key
 * @property string       $name
 * @property string       $description
 * @property int          $status
 * @property string       $parent_key
 *
 * @property Module       $parentModule
 * @property Module[]     $childModules
 * @property ModuleParams $params
 */
class Module extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%module}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['key', 'name'], 'required'],
            [['description'], 'string'],
            [['status'], 'integer'],
            [['key', 'name', 'parent_key'], 'string', 'max' => 255],
            [['key'], 'unique'],
            [['key'], 'exist', 'skipOnError' => true, 'targetClass' => ModuleParams::className(), 'targetAttribute' => ['key' => 'module_key']],
            [['parent_key'], 'exist', 'skipOnError' => true, 'targetClass' => Module::className(), 'targetAttribute' => ['parent_key' => 'key']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'key' => 'Key',
            'name' => 'Name',
            'description' => 'Description',
            'status' => 'Status',
            'parent_key' => 'Parent Key',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParentModule()
    {
        return $this->hasOne(Module::className(), ['key' => 'parent_key']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChildModules()
    {
        return $this->hasMany(Module::className(), ['parent_key' => 'key'])->with('params')->indexBy('key');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParams()
    {
        return $this->hasMany(ModuleParams::className(), ['module_key' => 'key'])->indexBy('key');
    }
}
