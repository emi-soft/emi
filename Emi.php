<?php
/**
 * Created by Maksim Skliarov.
 * Project: emi-cms
 * Company: Emi-Soft <emi.softdeveloper@gmail.com>
 * Date: 03/09/2018
 */


class Emi extends \yii\BaseYii
{

    /**
     * @var \yii\base\Application|\emi\web\Application the application instance
     */
    public static $app;

    public static function powered()
    {
        return \Yii::t('yii', 'Powered by {yii}', [
                'yii' => '<a href="http://www.yiiframework.com/" rel="external">' . \Yii::t('yii',
                        'Yii Framework') . '</a>',
            ]).' add-on <a href="http://www.yiiframework.com/" rel="external">Emi</a>';
    }
}


spl_autoload_register(['Emi', 'autoload'], true, true);
Emi::$classMap = require dirname(dirname(__DIR__)).'/yiisoft/yii2/classes.php';
Emi::$container = new yii\di\Container();

