<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="<?php $this->options->charset(); ?>">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">


    <title><?php $this->archiveTitle([
            'category' => _t('分类 %s 下的文章'),
            'search'   => _t('包含关键字 %s 的文章'),
            'tag'      => _t('标签 %s 下的文章'),
            'author'   => _t('%s 发布的文章')
        ], '', ' - '); ?><?php $this->options->title(); ?></title>

    <!-- 使用url函数转换相关路径 -->
      <link rel="stylesheet" href="<?php $this->options->themeUrl('style.css'); ?>">

<link rel="stylesheet" href="https://npm.elemecdn.com/lxgw-wenkai-webfont@1.1.0/lxgwwenkai-regular.css" media="all">

<style>
:root {
--bg: <?php echo $this->options->backgroundColor(); ?>;
}

.link-item:hover {
        background: <?php echo $this->options->hoverColor(); ?>;
        border-color: <?php echo $this->options->hoverColor(); ?>!important;
    }

[data-theme="dark"] .link-item:hover {
        background: <?php echo $this->options->hoverColor(); ?>;
        border-color: <?php echo $this->options->hoverColor(); ?>!important;
    }

[data-theme="dark"] .sub-tab.active,
    [data-theme="dark"] .engine-tab.active {
        background: <?php echo $this->options->backgroundColor(); ?>;
    }

[data-theme="dark"] .page-navigator .current a {
    background: <?php echo $this->options->backgroundColor(); ?>;
}

</style>
    <!-- 通过自有函数输出HTML头部信息 -->
  </head>
<body>
