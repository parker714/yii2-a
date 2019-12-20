<?php

namespace parker714\yii2a;

use Yii;
use yii\console\Controller;
use Org\Multilinguals\Apollo\Client\ApolloClient;

class ApolloController extends Controller
{
    /**
     * apollo server url
     *
     * @var string
     */
    public $url;

    /**
     * apollo app id
     *
     * @var string
     */
    public $appID;

    /**
     * apollo cluster
     *
     * @var string
     */
    public $cluster = 'default';

    /**
     * client ip address
     *
     * @var string
     */
    public $clientIp = '127.0.0.1';

    /**
     * apollo notifications
     *
     * @var array
     */
    public $notifications = [];

    /**
     * apollo config save dir
     *
     * @var string
     */
    public $saveDir;

    /**
     * init apollo config file save dir
     */
    public function init()
    {
        parent::init();
        if ($this->saveDir === null) {
            $this->saveDir = Yii::$app->getBasePath();
        } else {
            $this->saveDir = Yii::getAlias($this->saveDir);
        }
    }

    /**
     * pull apollo config
     *
     * @param $namespaceName
     */
    public function actionPull($namespaceName)
    {
        $client = new ApolloClient($this->url, $this->appID, $this->notifications);
        if ($client->pullConfig($namespaceName)) {
            $this->stdout("apollo: pull succeed");
        } else {
            $this->stderr("apollo: pull failed");
        }
    }

    /**
     * watch apollo config
     */
    public function actionWatch()
    {
        $client = new ApolloClient($this->url, $this->appID, $this->notifications);
        do {
            $error = $client->start();
            if ($error) $this->stderr("apollo: watch err $error");
        } while ($error && $client);
    }
}