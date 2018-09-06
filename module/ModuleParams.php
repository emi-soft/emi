<?php
/**
 * Created by Maksim Skliarov.
 * Project: emi-cms
 * Company: Emi-Soft <emi.softdeveloper@gmail.com>
 * Date: 05/09/2018
 */

namespace emi\module;


/**
 * This is the model class for table "{{%module_params}}".
 *
 * @property int $id
 * @property string $module_key
 * @property int $key
 * @property string $value
 * @property string $default_value
 * @property string $parent_key
 * @property string $title
 * @property string $description
 *
 * @property Module $module
 * @property ModuleParams $parentKey
 * @property ModuleParams[] $moduleParams
 */
class ModuleParams extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%module_params}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['module_key', 'key', 'value', 'default_value', 'title'], 'required'],
            [['key'], 'integer'],
            [['value', 'default_value', 'description'], 'string'],
            [['module_key', 'parent_key', 'title'], 'string', 'max' => 255],
            [['parent_key'], 'exist', 'skipOnError' => true, 'targetClass' => ModuleParams::className(), 'targetAttribute' => ['parent_key' => 'key']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'module_key' => 'Module Key',
            'key' => 'Key',
            'value' => 'Value',
            'default_value' => 'Default Value',
            'parent_key' => 'Parent Key',
            'title' => 'Title',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModule()
    {
        return $this->hasOne(Module::className(), ['key' => 'module_key']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParentKey()
    {
        return $this->hasOne(ModuleParams::className(), ['key' => 'parent_key']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModuleParams()
    {
        return $this->hasMany(ModuleParams::className(), ['parent_key' => 'key']);
    }
}