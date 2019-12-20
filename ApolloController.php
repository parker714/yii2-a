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
    public $clientIp;

    /**
     * apollo notifications
     *
     * @var array
     */
    public $notifications = ['application'];

    /**
     * apollo config save dir
     *
     * @var string
     */
    public $saveDir;

    /**
     * apollo client
     *
     * @var ApolloClient
     */
    private $client;

    /**
     * init apollo config file save dir
     */
    public function init()
    {
        parent::init();
        if ($this->clientIp === null) {
            $this->clientIp = $_SERVER['SERVER_ADDR'] ?? '';
        }
        if ($this->saveDir === null) {
            $this->saveDir = Yii::$app->getBasePath() . '/config/';
        } else {
            $this->saveDir = Yii::getAlias($this->saveDir);
        }
        $this->client           = new ApolloClient($this->url, $this->appID, $this->notifications);
        $this->client->save_dir = $this->saveDir;
    }

    /**
     * pull apollo config
     *
     * @param $namespaceName
     */
    public function actionPull($namespaceName = 'application')
    {
        if ($this->client->pullConfig($namespaceName)) {
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
        do {
            $error = $this->client->start();
            if ($error) $this->stderr("apollo: watch err $error");
        } while (!$error && $this->client);
    }
}