<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<?php $this->need('head.php'); ?>

<!-- 网站详情主内容 -->
    <div class="category-group">
        <div class="category-header">
            <div class="main-category">网站详情</div>
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
        
        <div class="detail-content">
            
            <div class="meta-info">
                <h1 class="site-title"><?php $this->title() ?></h1>
                <p class="site-desc">谷歌浏览器内置的网页开发调试工具，提供DOM检查、JavaScript调试、性能分析等强大功能。</p>
                
                <div class="stats">
                    <span>访问次数：12.8万</span>
                    <span><?php _e('分类: '); ?><?php $this->category(','); ?></span>
                    <span>发布时间：<?php $this->date(); ?></span>
                </div>
                
               


<div class="tags"><?php $this->tags(' ', true, '暂无标签'); ?></div>                            
                <a href="https://developer.chrome.com" 
                   class="link-item" 
                   target="_blank" 
                   style="max-width: 120px; margin-top: 12px;">
                   立即访问
                </a>
            </div>
        </div>
    </div>

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

    <!-- 相关网站区块 -->
    <div class="category-group">
        <div class="category-header">
            <div class="main-category">相关网站</div>
        </div>
        <div class="content-grid active" style="grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));">
            <a href="#" class="link-item">Firefox DevTools</a>
            <a href="#" class="link-item">Safari Develop</a>
            <a href="#" class="link-item">Edge DevTools</a>
            <a href="#" class="link-item">Webkit Inspector</a>
        </div>
    </div>

    <!-- 评论占位区块 -->
    <div class="category-group">
        <div class="category-header">
            <div class="main-category">用户评论</div>
        </div>
        <div style="padding: 20px; text-align: center; color: #666;">
            评论功能开发中，敬请期待...
        </div>

<?php $this->need('comments.php'); ?>

<ul class="post-near">
        <li>上一篇: <?php $this->thePrev('%s', '没有了'); ?></li>
        <li>下一篇: <?php $this->theNext('%s', '没有了'); ?></li>
    </ul>

    </div>
   
<?php $this->need('js.php'); ?>
<?php $this->need('footer.php'); ?>