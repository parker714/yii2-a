<?php

namespace parker714\yii2a;

use yii\base\Application;
use yii\base\BootstrapInterface;

/**
 * Class Bootstrap
 *
 * @package parker714\yii2a
 */
class Bootstrap implements BootstrapInterface
{
    /**
     * @param Application $app
     */
    public function bootstrap($app)
    {
        if ($app instanceof \yii\console\Application) {
        }
    }
}