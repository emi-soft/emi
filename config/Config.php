<?php
/**
 * Created by Maksim Skliarov.
 * Project: emi-cms
 * Company: Emi-Soft <emi.softdeveloper@gmail.com>
 * Date: 04/09/2018
 */

namespace emi\config;


use yii\base\BaseObject;
use yii\db\ActiveRecord;

/**
 * Class Config
 * @package emi\config
 *
 * This is the model class for table "config".
 *
 * @property string $key
 * @property string $value
 * @property string $default_value
 * @property string $group
 * @property string $title
 * @property string $description
 */
class Config extends ActiveRecord
{

    public static function tableName()
    {
        return '{{%config}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['key', 'value', 'title', 'description','group'], 'required'],
            [['description'], 'string'],
            [['key', 'value','default_value', 'title','group'], 'string', 'max' => 255],
            [['key'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
           /* 'key' => \Emi::t('emi', 'Key'),
            'value' => \Emi::t('emi', 'Value'),
            'title' => \Emi::t('emi', 'Title'),
            'description' => \Emi::t('emi', 'Description'),*/
            'key' => 'Key',
            'value' => 'Value',
            'default_value' => 'Default Value',
            'group' => 'Group',
            'title' => 'Title',
            'description' => 'Description'
        ];
    }
}