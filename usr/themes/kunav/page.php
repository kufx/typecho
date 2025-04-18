<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<?php $this->need('head.php'); ?>

    <div class="category-group">
                <div class="article-content" style="padding: 12px;">

<h1 class="site-title"><?php $this->title() ?></h1>

<?php echo getContentTest($this->content); ?>                </div>
    </div>


   
<?php $this->need('js.php'); ?>
<?php $this->need('footer.php'); ?>