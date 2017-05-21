<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */
namespace yuncms\article\assets;

use yii\web\AssetBundle;

/**
 * ArticleAsset
 */
class ArticleAsset extends AssetBundle
{
    public $sourcePath = '@vendor/yuncms/yii2-article/views/assets';

    /**
     * @var array
     */
    public $css = [
        'css/article.css'
    ];

    /**
     * @var array
     */
    public $depends = [
        'yii\bootstrap\BootstrapAsset',
    ];
}