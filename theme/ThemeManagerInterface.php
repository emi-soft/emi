<?php
/**
 * Created by Maksim Skliarov.
 * Project: emi-cms
 * Company: Emi-Soft <emi.softdeveloper@gmail.com>
 * Date: 05/09/2018
 */

namespace emi\theme;


/**
 * Interface ThemeManagerInterface
 * @package emi\theme
 */
interface ThemeManagerInterface
{

    /**
     * @inheritDoc Подключение темы Приложения при запуске
     */
    public function run($moduleName = false);

    /**
     *
     * @inheritDoc Получение темы Приложения
     *
     * @return mixed
     */
    public function getTemplate();

    /**
     *
     * @inheritDoc Получение всех тем Приложения
     *
     * @return mixed
     */
   // public function getTemplates();

    /**
     *
     * @inheritDoc Установка темы  Приложения
     *
     * @param $name
     *
     * @return mixed
     */
    public function setTemplate($name);

}