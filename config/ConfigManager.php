<?php
/**
 * Created by Maksim Skliarov.
 * Project: emi-cms
 * Company: Emi-Soft <emi.softdeveloper@gmail.com>
 * Date: 04/09/2018
 */

namespace emi\config;

use emi\base\Component;
use yii\base\BootstrapInterface;
use yii\di\ServiceLocator;
use yii\helpers\ArrayHelper;


/**
 * Class ConfigManager
 * @package emi\config
 *
 *
 * @method array $Configs Конфигурация приложения
 */
abstract class ConfigManager extends Component implements ConfigManagerInterface
{

    public function run()
    {
        \Emi::$app->configManager->setConfigComponent('urlManager', ['enablePrettyUrl' => true, 'showScriptName' => false, 'rules' => []]);
    }

    /**
     *
     * @see ConfigManagerInterface::getConfig()
     *
     * @param $key
     *
     * @return mixed
     */
    abstract public function getConfig($key);


    /**
     * @see ConfigManagerInterface::getConfigs()
     * @return mixed
     */
    abstract public function getConfigs();

    /**
     * @param array $name
     * @param array $config
     */
    public function setConfig($name, $config)
    {
        if (!is_array($config)) {
            \Emi::$app->$name = $config;
        }
    }

    /**
     * @inheritDoc Установка параметров Приложения
     *
     * @param string $component_name
     * @param array  $configs
     */
    public function setConfigs($configs)
    {
        foreach ($configs as $name => $config) {
            $this->setConfig($name, $config);
        }
    }

    /**
     * @inheritDoc Установка параметров Приложения полученых из DB
     *
     * @param string $component_name
     * @param array  $configs
     */
    public function setConfigsDefault(){
        foreach ($configs as $name => $config) {
            $this->setConfig($name, $config);
        }
    }

    /**
     * @inheritDoc Установка параметров Компонента
     *
     * @param string $component_name
     * @param array  $update_componentParams
     *
     * @return bool
     */
    public function setConfigComponent($component_name, array $update_componentParams)
    {
        $old_componentParams = [];
        if(\Emi::$app->has($component_name)){
            $old_componentParams = \Emi::$app->components[$component_name];
        }
        $old_componentParams = \Emi::$app->components[$component_name];
        $new_componentParams[$component_name] = ArrayHelper::merge($old_componentParams, $update_componentParams);

        if (\Emi::$app->setComponents($new_componentParams)) {
            return true;
        }
        return false;
    }


}