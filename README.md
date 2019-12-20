<p align="center">
    <h1 align="center">Apollo Extension for Yii 2</h1>
</p>

This extension provides a [`Apollo`](https://github.com/ctripcorp/apollo) fixture command for the [Yii framework 2.0](http://www.yiiframework.com).

For license information check the [LICENSE](LICENSE.md)-file.

[![Latest Stable Version](https://img.shields.io/packagist/v/parker714/yii2-a.svg)](https://packagist.org/packages/parker714/yii2-a)
[![GitHub license](https://img.shields.io/github/license/parker714/yii2-a)](https://github.com/parker714/yii2-a/blob/master/LICENSE)

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
composer require parker714/yii2-a -vvv
```

Usage
-----

To use this extension,  simply add the following code in your application configuration (console.php):

```php
'controllerMap' => [
    'apollo' => [
        'class' => 'parker714\yii2a\ApolloController',
        'url'   => 'http://127.0.0.1',
        'appID' => 'test',
    ],
],
```
