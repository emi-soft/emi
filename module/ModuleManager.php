<?php
/**
 * Created by Maksim Skliarov.
 * Project: emi-cms
 * Company: Emi-Soft <emi.softdeveloper@gmail.com>
 * Date: 03/09/2018
 */

namespace emi\module;

use emi\base\Component;

/**
 * Class ModuleManager
 * @package emi\module
 * @method  $enableActiveModules Включение активных модулей.
 * @method  $enableModules
 */
abstract class ModuleManager extends Component implements ModuleManagerInterface
{


    /**
     * @inheritDoc Подключение модулей Приложения при запуске
     */
    public function run()
    {
    }

    /**
     * @see ModuleManagerInterface::getModule()
     *
     * @param      $id
     * @param bool $params
     * @param bool $active
     *
     * @return mixed
     */
    abstract public function getModule($id, $params = false, $active = true);

    /**
     * @see ModuleManagerInterface::getModules()
     *
     * @param bool $active
     *
     * @return mixed
     */
    abstract public function getModules($active = false);


    /**
     * @see ModuleManagerInterface::setModule()
     *
     * @param $id
     * @param $parameters
     *
     * @return mixed|void
     */
    public function setModule($id, $parameters)
    {
        $parameters = $this->preSetModule($parameters);

        \Emi::$app->setModule($id, $parameters);

    }


    /**
     * @inheritdoc Проверка параметров модуля перед подключение
     *
     * @param $id
     * @param $parameters
     *
     * @return mixed|void
     */
    private function preSetModule($parameters)
    {
        if (!isset($parameters['viewPath'])) {
            if (!empty(get_class_vars($parameters['class'])['name'])) {
                $parameters['viewPath'] = '@template/basic/modules/' . get_class_vars($parameters['class'])['name'];
            }
        }
        if (!isset($parameters['layoutPath'])) {
            if (!empty(get_class_vars($parameters['class'])['name'])) {
                $parameters['layoutPath'] = '@template/basic/layouts';
            }
        }

        return $parameters;
    }

    /**
     * @see ModuleManagerInterface::setModules()
     *
     * @param $modules
     *
     * @return mixed|void
     */
    public function setModules($modules)
    {
        foreach ($modules as $id => $parameters) {
            $this->setModule($id, $parameters);
        }
    }

    /**
     *
     * @inheritDoc Получение всех включенных модулей Приложения
     *
     * @return array|mixed
     */
    public function getEnableModules()
    {
        $modules = $this->getModules(true);
        return $modules ? $modules : [];
    }

    /**
     *
     * @inheritDoc Получение всех отключеных модулей Приложения
     *
     * @return array|mixed
     */
    public function getDisabledModules()
    {
        $modules = $this->getModules(false);
        return $modules ? $modules : [];
    }


}