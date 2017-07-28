# yii2-article
适用于Yii2的article

[![Latest Stable Version](https://poser.pugx.org/yuncms/yii2-article/v/stable.png)](https://packagist.org/packages/yuncms/yii2-article)
[![Total Downloads](https://poser.pugx.org/yuncms/yii2-article/downloads.png)](https://packagist.org/packages/yuncms/yii2-article)
[![Reference Status](https://www.versioneye.com/php/yuncms:yii2-article/reference_badge.svg)](https://www.versioneye.com/php/yuncms:yii2-article/references)
[![Build Status](https://img.shields.io/travis/yiisoft/yii2-article.svg)](http://travis-ci.org/yuncms/yii2-article)
[![Dependency Status](https://www.versioneye.com/php/yuncms:yii2-article/dev-master/badge.png)](https://www.versioneye.com/php/yuncms:yii2-article/dev-master)
[![License](https://poser.pugx.org/yuncms/yii2-article/license.svg)](https://packagist.org/packages/yuncms/yii2-article)


Installation
------------

Next steps will guide you through the process of installing yii2-admin using [composer](http://getcomposer.org/download/). Installation is a quick and easy three-step process.

### Step 1: Install component via composer

Either run

```
composer require --prefer-dist yuncms/yii2-article
```

or add

```json
"yuncms/yii2-article": "~2.0.0"
```

to the `require` section of your composer.json.

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



## License

This is released under the MIT License. See the bundled [LICENSE.md](LICENSE.md)
for details.