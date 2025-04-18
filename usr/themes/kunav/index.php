<?php
/**
 * Default theme for Typecho
 *
 * @package Typecho Replica Theme
 * @author Typecho Team
 * @version 1.2
 * @link http://typecho.org
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;


if (isset($_GET['target'])) {
$this->need('redirect.php');
exit;
}
$this->need('header.php');
$this->need('head.php');
?>


<?php echo parseTabField(Helper::options()->subtab1); ?>

<?php echo parseTabField(Helper::options()->subtab2); ?>

<div class="category-group">
    <div class="category-header">
        <div class="main-category">带图标块</div>
    </div>    
    <div class="content-container">
        <div class="content-grid always-show">
<?php if ($iconLinks = getGoodLinks()): ?>
<?php echo $iconLinks; ?>
<?php endif; ?>          
        </div>
    </div>
</div>


<!-- 修正后的文章列表区块 -->
<div class="category-group">
    <div class="category-header">
        <div class="main-category">本站文章</div>
        <div class="subcategory-tabs">
            <div class="sub-tab active" onclick="switchTab(this, 'latest-articles')">最新</div>
            <div class="sub-tab" onclick="switchTab(this, 'popular-articles')">热门</div>
            <div class="sub-tab" onclick="switchTab(this, 'recommend-articles')">推荐</div>
        </div>
    </div>
    
    <!-- 内容区域需要包裹在统一的容器中 -->
    <div class="content-container">
        <div class="article-list active" id="latest-articles">
            <!-- 内容项 -->
<?php while($this->next()): ?>
<a class="article-item" href="<?php $this->permalink() ?>">
  <span class="time"><?php $this->date(); ?></span>
            <span class="title"><?php $this->title(); ?></span>
</a>
<?php endwhile; ?>
  
<?php $this->pageNav('«', '»', 1, '...', array('wrapTag' => 'ol', 'wrapClass' => 'page-navigator', 'itemTag' => 'li', 'textTag' => 'span', 'currentClass' => 'current', 'prevClass' => 'prev', 'nextClass' => 'next',)); ?>

 
        </div>
        <div class="article-list" id="popular-articles">
            <!-- 内容项 -->
<a class="article-item" href="#">
            <span class="time">06-15</span>
            <span class="title">2前端性能优化实战指南</span>
        </a>
     
        <a class="article-item" href="#">
            <span class="time">06-13</span>
            <span class="title">微前端架构深度解析</span>
        </a>
        </div>
        <div class="article-list" id="recommend-articles">
            <!-- 内容项 -->
<a class="article-item" href="#">
            <span class="time">06-15</span>
            <span class="title">1前端性能优化实战指南</span>
        </a>
        </div>
    </div>
</div>





<div class="category-group">
    <div class="category-header">
        <div class="main-category">友情链接</div>
    </div>    
    <div class="content-container">
        <div class="content-grid always-show">

<?php if ($links = getFriendLinks()): ?>
<?php echo $links; ?>
<?php endif; ?>

            
        </div>
    </div>
</div>
       

<?php $this->need('js.php'); ?>
<?php $this->need('footer.php'); ?>
