# yii2-article
适用于Yii2的article

[![Latest Stable Version](https://poser.pugx.org/yuncms/yii2-article/v/stable.png)](https://packagist.org/packages/yuncms/yii2-article)
[![Total Downloads](https://poser.pugx.org/yuncms/yii2-article/downloads.png)](https://packagist.org/packages/yuncms/yii2-article)
[![Reference Status](https://www.versioneye.com/php/yuncms:yii2-article/reference_badge.svg)](https://www.versioneye.com/php/yuncms:yii2-article/references)
[![Build Status](https://img.shields.io/travis/yiisoft/yii2-article.svg)](http://travis-ci.org/yuncms/yii2-article)
[![Dependency Status](https://www.versioneye.com/php/yuncms:yii2-article/dev-master/badge.png)](https://www.versioneye.com/php/yuncms:yii2-article/dev-master)
[![License](https://poser.pugx.org/yuncms/yii2-article/license.svg)](https://packagist.org/packages/yuncms/yii2-article)

## 安装

使用 Composer 安装:

```
composer require "yuncms/yii2-article:~1.0"
```
## 使用

前台模块

yuncms\article\frontend\Module

后台模块

yuncms\article\backend\Module

###Url规则
````
'article'=>'article/article/index',
'article/<uuid:[\w+]+>' => 'article/article/view',
````



# License

BSD-3-Clause