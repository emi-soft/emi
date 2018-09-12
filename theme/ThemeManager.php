<?php
/**
 * Created by Maksim Skliarov.
 * Project: emi-cms
 * Company: Emi-Soft <emi.softdeveloper@gmail.com>
 * Date: 03/09/2018
 */

namespace emi\theme;


use emi\base\Component;
use emi\helper\FileHelper;

/**
 * Class ThemeManager
 * @package emi\theme
 */
class ThemeManager extends Component implements ThemeManagerInterface
{
    private $_template;
    private $_templatePath;
    private $_moduleName;

    public function run($module = false)
    {
        $this->_moduleName = $module;
        $this->_templatePath = \Emi::getAlias(\Emi::$app->templatePath);
        $this->_template = \Emi::$app->template;
        $this->preSetTemplate();
    }

    public function preSetTemplate()
    {
        if (FileHelper::dirExist("@template/{$this->_template}")) {
            if ($this->_moduleName) {
                $this->setTemplate($this->_template, $this->_moduleName);
            } else {
                $this->setTemplate($this->_template);
            }

        }
    }

    public function getTemplate()
    {
        return $this->_template;
    }

    public function setTemplate($template, $moduleName = false)
    {
        \Emi::setAlias('@theme', "@template/{$template}");
        \Emi::setAlias('@THEME', "@web/web/themes/{$template}/asset");
        \Emi::$app->view->theme->setBaseUrl("@THEME") ;

        \Emi::$app->view->theme->pathMap = [
            '@app/views' => [
                "@template/{$template}",
                "@template/basic"
            ],
            '@app/modules' => [
                "@template/{$template}/modules",
                "@template/basic/modules"

            ],
            '@app/widgets' => [
                "@template/{$template}/widgets",
                "@template/basic/widgets"
            ],
        ];

        /*if ($moduleName) {
            if($moduleName->layoutPath == 'default'){
                $moduleName->setLayoutPath("{$this->_templatePath}/{$template}/layouts");
            } else {
                $moduleName->setLayoutPath("{$this->_templatePath}/{$template}/modules/{$moduleName->name}/{$moduleName->layoutPath}");
            }
            $moduleName->setViewPath("{$this->_templatePath}/{$template}/modules/{$moduleName->name}");

        } else {


//            \Emi::setAlias('@THEME','@web/public/templates/'.$template);


            \Emi::$app->setLayoutPath("{$this->_templatePath}/{$template}/layouts");
            \Emi::$app->setViewPath("{$this->_templatePath}/{$template}");


        }*/

    }

}