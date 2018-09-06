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
 * Class Application
 * @package emi\base
 *
 *
 * @property \emi\module\ModuleManager $moduleManager The module manager application component.
 * @property \emi\config\ConfigManager $configManager The config manager application component.
 */
abstract class Application extends \yii\web\Application
{


    public $controllerNamespace = 'engine\\controllers';


    /**
     * {@inheritDoc}
     * @throws InvalidConfigException
     */
    protected function bootstrap()
    {

        $this->checkCoreComponent();
        $this->setVendorPath(dirname(dirname(dirname(__DIR__))));
        \Emi::setAlias('@engine', dirname(\Emi::getAlias('@vendor')));
        \Emi::setAlias('@emi', '@vendor/emi-soft/emi');
        $this->setLayoutPath('@template/basic/layouts');
        $this->setViewPath('@template/basic');


        parent::bootstrap();

    }

    private $_vendorPath;

    /**
     * Sets the directory that stores vendor files.
     * @param string $path the directory that stores vendor files.
     */
    public function setVendorPath($path)
    {
        $this->_vendorPath = \Emi::getAlias($path);
        \Emi::setAlias('@vendor', $this->_vendorPath);
        \Emi::setAlias('@bower', $this->_vendorPath . DIRECTORY_SEPARATOR . 'bower-asset');
        \Emi::setAlias('@npm', $this->_vendorPath . DIRECTORY_SEPARATOR . 'npm-asset');
    }


    /**
     * {@inheritDoc}
     */
    public function coreComponents()
    {
        return array_merge(parent::coreComponents(), [
            'moduleManager' => ['class' => 'emi\module\DbModuleManager'],
            'configManager' => ['class' => 'emi\config\DBConfigManager'],
        ]);
    }


    /**
     * @throws InvalidConfigException
     */
    public function checkCoreComponent()
    {
        if (!\Emi::$app->has('configManager')) {
            throw new InvalidConfigException('The component "configManager" for the Application is required.');
        } else {
            \Emi::$app->configManager->run();
        }
        if (!\Emi::$app->has('moduleManager')) {
            throw new InvalidConfigException('The component "moduleManager" for the Application is required.');
        } else {
            \Emi::$app->moduleManager->run();
        }
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