<?php
/**
 * Created by Maksim Skliarov.
 * Project: emi-cms
 * Company: Emi-Soft <emi.softdeveloper@gmail.com>
 * Date: 04/09/2018
 */

namespace emi\config;


interface ConfigManagerInterface
{

    /**
     * @inheritDoc Установка параметров Приложения при запуске
     */
    public function run();

    /**
     * @inheritDoc Получение параметра Приложения
     */
    public function getConfig($key);

    /**
     * @inheritDoc Получение всех параметров Приложения
     */
    public function getConfigs();

    /**
     * @inheritDoc Установка параметра Приложения
     *
     * @param array $name
     * @param array $config
     */
    public function setConfig($name, $config);

    /**
     * @inheritDoc Установка параметров Приложения
     *
     * @param array $configs
     */
    public function setConfigs($configs);

    /**
     * @inheritDoc Установка параметров Приложения по умолчанию
     */
    public function setConfigsDefault();

    /**
     * @inheritDoc Установка параметров Компонента
     *
     * @param string $component_name
     * @param array  $update_componentParams
     *
     * @return bool
     */
    public function setConfigComponent($component_name, array $update_componentParams);

}