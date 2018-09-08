<?php
/**
 * Created by Maksim Skliarov.
 * Project: emi-cms
 * Company: Emi-Soft <emi.softdeveloper@gmail.com>
 * Date: 03/09/2018
 */

namespace emi\base;


use yii\base\InvalidConfigException;

/**
 * Class Module
 * @package emi\base
 */
abstract class Module extends \yii\base\Module
{

    /**
     * @var
     */
    public $name;

    /**
     * @throws InvalidConfigException
     */
    public function init()
    {
        $this->setName();
        if(!$this->name){
            throw new InvalidConfigException('The property "name" for the Module is required.');
        }
        parent::init();
//        \Emi::$app->themeManager->run($this);
    }


    /**
     * @return mixed
     */
    abstract protected function setName();

}