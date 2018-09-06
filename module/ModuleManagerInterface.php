<?php
/**
 * Created by Maksim Skliarov.
 * Project: emi-cms
 * Company: Emi-Soft <emi.softdeveloper@gmail.com>
 * Date: 05/09/2018
 */

namespace emi\module;


/**
 * Interface ModuleManagerInterface
 * @package emi\module
 */
interface ModuleManagerInterface
{

    /**
     * @inheritDoc Подключение модулей Приложения при запуске
     */
    public function run();

    /**
     *
     * @inheritDoc Получение модуля Приложения
     *
     * @param      $id
     * @param bool $params
     * @param bool $active
     *
     * @return mixed
     */
    public function getModule($id, $params = false, $active = true);

    /**
     *
     * @inheritDoc Получение всех модулей Приложения
     *
     * @param bool $active
     *
     * @return mixed
     */
    public function getModules($active = false);

    /**
     *
     * @inheritDoc Подключение модуля в Приложение
     *
     * @param $id
     * @param $parameters
     *
     * @return mixed
     */
    public function setModule($id, $parameters);

    /**
     *
     * @inheritDoc Подключение масива модулей в Приложение
     *
     * @param $modules
     *
     * @return mixed
     */
    public function setModules($modules);

    /**
     *
     * @inheritDoc Получение всех включенных модулей Приложения
     *
     * @return array|mixed
     */
    public function getEnableModules();

    /**
     *
     * @inheritDoc Получение всех отключеных модулей Приложения
     *
     * @return array|mixed
     */
    public function getDisabledModules();

}