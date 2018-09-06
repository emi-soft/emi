<?php
/**
 * Created by Maksim Skliarov.
 * Project: emi-cms
 * Company: Emi-Soft <emi.softdeveloper@gmail.com>
 * Date: 03/09/2018
 */

namespace emi\base;



class Module extends \yii\base\Module
{

    public function init()
    {
        parent::init();
        $this->setLayoutPath('@template/basic/layouts');
        $this->setViewPath('@template/basic/modules/' . $this->name);
    }

}