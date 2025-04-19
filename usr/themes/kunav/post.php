<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<?php $this->need('head.php'); ?>



    <!-- 文章内容区块 -->
    <div class="category-group">
        <div class="category-header">
            <div class="main-category">文章内容</div>


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
        <div class="article-content" style="padding: 12px;">
 <h1 class="site-title"><?php $this->title() ?></h1>
 
<?php echo getContentTest($this->content); ?>
<div class="tags"><?php $this->tags(' ', true, '暂无标签'); ?></div>
     </div>
    </div>

    
    <!-- 评论占位区块 -->
    <div class="category-group">
        <div class="category-header">
            <div class="main-category">用户评论</div>
        </div>

<?php $this->need('comments.php'); ?>

    </div>
   
<?php $this->need('js.php'); ?>
<?php $this->need('footer.php'); ?>
