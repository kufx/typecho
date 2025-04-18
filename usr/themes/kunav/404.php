<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<?php $this->need('head.php'); ?>
<div class="category-group" style="min-height:200px">
        <div class="category-header">
            <div class="main-category">温馨提示</div>

<div class="breadcrumb-nav">
                <a href="<?php $this->options->siteUrl(); ?>">首页</a> &raquo;
	<?php if ($this->is('index')): ?><!-- 页面为首页时 -->
		<span>Latest Post</span>
	<?php elseif ($this->is('post')): ?><!-- 页面为文章单页时 -->
		<?php $this->category(); ?> &raquo; <span><?php $this->title() ?></span>
	<?php else: ?><!-- 页面为其他页时 -->
		<?php $this->archiveTitle(' &raquo; ','',''); ?>
	<?php endif; ?>            </div>

        </div>
        <div style="padding: 20px; text-align: center; color: #666;">
            恭喜你，来到了404页面！...
        </div>
  </div>   
<?php $this->need('js.php'); ?>
<?php $this->need('footer.php'); ?>
