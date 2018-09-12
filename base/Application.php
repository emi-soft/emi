<?php
/**
 * Created by Maksim Skliarov.
 * Project: emi-cms
 * Company: Emi-Soft <emi.softdeveloper@gmail.com>
 * Date: 03/09/2018
 */

namespace emi\base;

use yii\base\InvalidConfigException;
use yii\web\View;

/**
 * Class Application
 * @package emi\base
 *
 *
 * @property \emi\module\ModuleManager $moduleManager The module manager application component.
 * @property \emi\config\ConfigManager $configManager The config manager application component.
 * @property \emi\theme\ThemeManager   $themeManager The config manager application component.
 */
abstract class Application extends \yii\web\Application
{


    public $template = 'basic';
    public $templatePath = '@template';


    public function init()
    {
//        \Emi::setAlias('@emi', '@vendor/emi-soft/emi');
        parent::init();
        $this->checkCoreComponent();
    }

    protected function runCoreComponents()
    {
        if (\Emi::$app->has('configManager')) {
            \Emi::$app->configManager->run();
        }
        if (\Emi::$app->has('moduleManager')) {
            \Emi::$app->moduleManager->run();
        }
        if (\Emi::$app->has('themeManager')) {
            \Emi::$app->themeManager->run();
        }
    }


    /**
     * {@inheritDoc}
     */
    public function coreComponents()
    {
        return array_merge(parent::coreComponents(), [
            'moduleManager' => ['class' => 'emi\module\DbModuleManager'],
            'configManager' => ['class' => 'emi\config\DBConfigManager'],
            'themeManager' => ['class' => 'emi\theme\ThemeManager'],
            'view' => ['class' => View::className(), 'theme' => ['pathMap' => ['@app/views' => '@template/basic', '@app/modules' => '@template/basic/modules', '@app/widgets' => '@template/basic/widgets']]],
        ]);
    }

    /**
     * @throws InvalidConfigException
     */
    public function checkCoreComponent()
    {
        if (!\Emi::$app->has('configManager')) {
            throw new InvalidConfigException('The component "configManager" for the Application is required.');
        }
        if (!\Emi::$app->has('moduleManager')) {
            throw new InvalidConfigException('The component "moduleManager" for the Application is required.');
        }

        $this->runCoreComponents();
    }

    /**
     * Returns the themeManager component.
     * @return \emi\theme\ThemeManager|object
     * @throws InvalidConfigException
     */
    public function getThemeManager()
    {
        return $this->get('themeManager');
    }

    /**
     * Returns the configManager component.
     * @return \emi\config\ConfigManager|object
     * @throws InvalidConfigException
     */
    public function getConfigManager()
    {
        return $this->get('configManager');
    }

    /**
     * Returns the moduleManager component.
     * @return \emi\module\ModuleManager|object
     */
    public function getModuleManager()
    {
        return $this->get('moduleManager');
    }

}