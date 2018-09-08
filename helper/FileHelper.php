<?php
/**
 * Created by Maksim Skliarov.
 * Project: emi-cms
 * Company: Emi-Soft <emi.softdeveloper@gmail.com>
 * Date: 07/09/2018
 */

namespace emi\helper;



class FileHelper extends \yii\helpers\BaseFileHelper
{

    public static function fileExist($file)
    {
        return file_exists($file);
    }

    public static function dirExist($dir)
    {
        return is_dir(\Emi::getAlias($dir));
    }


}