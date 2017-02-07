<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;

/*
 * @var yii\web\View $this
 */

$this->title = Yii::t('article', 'Articles');
$this->params['breadcrumbs'][] = $this->title;
?>
<h1>
    <i class="glyphicon glyphicon-tags"></i> <?= Html::encode($this->title) ?><br>
    <small>标签不仅能组织和归类你的内容，还能关联相似的内容。正确的使用标签可让你更容易的找到需要的源代码。</small>
</h1>
<div class="row">
    <div class="col-xs-12 col-md-9 main">
        <?= ListView::widget([
            'options' => [
                'tag' => 'ul',
                'class' => 'media-list'
            ],
            'itemOptions' => ['tag' => 'li', 'class' => 'media'],
            'layout' => '{items} <div class="text-center">{pager}</div>',
            'pager' => [
                'maxButtonCount' => 10,
                'nextPageLabel' => Yii::t('app', 'Next page'),
                'prevPageLabel' => Yii::t('app', 'Previous page'),
            ],
            'dataProvider' => $dataProvider,
            'itemView' => '_item'
        ]);
        ?>
    </div><!-- /.main -->

    <div class="col-xs-12 col-md-3 side">
        <div class="panel panel-default">
            <div class="panel-heading">
                热门Git        </div>
            <div class="panel-body">
                <ul class="post-list">
                    <li><a href="/19.html">Git 版本控制入门</a></li>
                    <li><a href="/8.html">常用 Git 命令清单</a></li>
                    <li><a href="/30.html">上个命令各个参数的表示方法</a></li>
                    <li><a href="/58.html">Git 在团队中的最佳实践--如何正确使用Git Flow</a></li>
                    <li><a href="/68.html">Linux 新手必知必会的 10 条 Linux 基本命令</a></li>
                    <li><a href="/55.html">Linux/UNIX 定时任务 cron 详解</a></li>
                    <li><a href="/104.html">Linux下apache日志分析与状态查看方法</a></li>
                </ul>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title">热门标签</h2>
            </div>
            <div class="panel-body">
                <a class="tag" href="/code?tag=yii2">yii2</a><a class="tag" href="/code?tag=yii">yii</a><a class="tag" href="/code?tag=GridView">GridView</a><a class="tag" href="/code?tag=%E5%88%86%E9%A1%B5">分页</a><a class="tag" href="/code?tag=CGridView">CGridView</a><a class="tag" href="/code?tag=yii2.0">yii2.0</a><a class="tag" href="/code?tag=AJAX">AJAX</a><a class="tag" href="/code?tag=php">php</a><a class="tag" href="/code?tag=RBAC">RBAC</a><a class="tag" href="/code?tag=%E6%95%99%E7%A8%8B">教程</a><a class="tag" href="/code?tag=jQuery">jQuery</a><a class="tag" href="/code?tag=api">api</a><a class="tag" href="/code?tag=%E9%AA%8C%E8%AF%81%E7%A0%81">验证码</a><a class="tag" href="/code?tag=url">url</a><a class="tag" href="/code?tag=mongodb">mongodb</a><a class="tag" href="/code?tag=cms">cms</a><a class="tag" href="/code?tag=%E6%89%A9%E5%B1%95">扩展</a><a class="tag" href="/code?tag=%E5%9B%BE%E7%89%87%E4%B8%8A%E4%BC%A0">图片上传</a><a class="tag" href="/code?tag=%E6%9B%B4%E6%96%B0">更新</a><a class="tag" href="/code?tag=%E7%99%BB%E5%BD%95">登录</a><a class="tag" href="/code?tag=ar">ar</a><a class="tag" href="/code?tag=update">update</a><a class="tag" href="/code?tag=view">view</a><a class="tag" href="/code?tag=%E5%8F%91%E5%B8%83">发布</a><a class="tag" href="/code?tag=%E4%B9%B1%E7%A0%81">乱码</a><a class="tag" href="/code?tag=pagination">pagination</a><a class="tag" href="/code?tag=%E7%BC%96%E8%BE%91%E5%99%A8">编辑器</a><a class="tag" href="/code?tag=%E7%99%BB%E9%99%86">登陆</a><a class="tag" href="/code?tag=%E8%87%AA%E5%AE%9A%E4%B9%89">自定义</a><a class="tag" href="/code?tag=sql">sql</a><a class="tag" href="/code?tag=composer">composer</a><a class="tag" href="/code?tag=model">model</a><a class="tag" href="/code?tag=%E9%87%87%E9%9B%86">采集</a><a class="tag" href="/code?tag=urlManager">urlManager</a><a class="tag" href="/code?tag=CTreeView">CTreeView</a><a class="tag" href="/code?tag=%E6%8F%92%E4%BB%B6">插件</a><a class="tag" href="/code?tag=restful">restful</a><a class="tag" href="/code?tag=form">form</a><a class="tag" href="/code?tag=%E5%BC%80%E6%BA%90">开源</a><a class="tag" href="/code?tag=controller">controller</a><a class="tag" href="/code?tag=blog">blog</a><a class="tag" href="/code?tag=ueditor">ueditor</a><a class="tag" href="/code?tag=%E5%8F%98%E9%87%8F">变量</a><a class="tag" href="/code?tag=server">server</a><a class="tag" href="/code?tag=action">action</a><a class="tag" href="/code?tag=%E9%9D%92%E5%B2%9B">青岛</a><a class="tag" href="/code?tag=Nestedset">Nestedset</a><a class="tag" href="/code?tag=bootstrap">bootstrap</a><a class="tag" href="/code?tag=rest">rest</a><a class="tag" href="/code?tag=%E5%AD%97%E6%AE%B5%E5%86%B2%E7%AA%81">字段冲突</a>            </div>
        </div>
    </div><!-- /.side -->
</div>


