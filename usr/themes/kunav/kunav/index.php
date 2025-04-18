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
            <div class="main-category">开发工具</div>
            <div class="subcategory-tabs">
                <div class="sub-tab active" onclick="switchTab(this, 'web-tools')">前端</div>
                <div class="sub-tab" onclick="switchTab(this, 'backend-tools')">后端</div>
                <div class="sub-tab" onclick="switchTab(this, 'db-tools')">数据库</div>

            </div>
        </div>
<div class="content-container">
        <div class="content-grid active" id="web-tools">
            <a href="#" class="link-item">哈哈茶杯狐影视</a>
<a href="#" class="link-item"><span class="color-red">Chrome Dev</span></a>
            
        </div>
        <div class="content-grid" id="backend-tools">
            <a href="#" class="link-item">Postman</a>
            
        </div>
        <div class="content-grid" id="db-tools">
            <a href="#" class="link-item">MySQL</a>
            
        </div>
      </div>
    </div>













   

<!-- 带图标链接容器块 -->
<div class="category-group">
    <div class="category-header">
        <div class="main-category">开发社区</div>
        <div class="subcategory-tabs">
            <div class="sub-tab active" onclick="switchTab(this, 'com-1')">国内</div>
            <div class="sub-tab" onclick="switchTab(this, 'com-2')">国外</div>
        </div>
    </div>
    
    <div class="content-container">
        <!-- 国内社区 -->
        <div class="content-grid active" id="com-1">
            <a href="#" class="icon-link-item">
                <img src="https://bu.dusays.com/2025/01/31/679c9acae2452.webp" class="link-icon">
                <span>Gitee开源</span>
            </a>
            <a href="#" class="icon-link-item">
                <img src="https://bu.dusays.com/2025/01/31/679c9acae2452.webp" class="link-icon">
                <span>掘金社区掘金社区掘金</span>
            </a>
            <a href="#" class="icon-link-item">
                <img src="https://bu.dusays.com/2025/01/31/679c9acae2452.webp" class="link-icon">
                <span>思否问答</span>
            </a>
            <a href="#" class="icon-link-item">
                <img src="https://bu.dusays.com/2025/01/31/679c9acae2452.webp" class="link-icon">
                <span>开源中国</span>
            </a>
<a href="#" class="icon-link-item">
                <img src="https://bu.dusays.com/2025/01/31/679c9acae2452.webp" class="link-icon">
                <span>Gitee开源</span>
            </a>
            <a href="#" class="icon-link-item">
                <img src="https://bu.dusays.com/2025/01/31/679c9acae2452.webp" class="link-icon">
                <span>掘金社区</span>
            </a>
            <a href="#" class="icon-link-item">
                <img src="https://bu.dusays.com/2025/01/31/679c9acae2452.webp" class="link-icon">
                <span>思否问答</span>
            </a>
            <a href="#" class="icon-link-item">
                <img src="https://bu.dusays.com/2025/01/31/679c9acae2452.webp" class="link-icon">
                <span>开源中国</span>
            </a>
<a href="#" class="icon-link-item">
                <img src="https://bu.dusays.com/2025/01/31/679c9acae2452.webp" class="link-icon">
                <span>开源中国</span>
            </a>
        </div>

        <!-- 国外社区 -->
        <div class="content-grid" id="com-2">
            <a href="#" class="icon-link-item">
                <img src="https://bu.dusays.com/2025/01/31/679c9acae2452.webp" class="link-icon">
                <span>GitHub</span>
            </a>
            <a href="#" class="icon-link-item">
                <img src="https://bu.dusays.com/2025/01/31/679c9acae2452.webp" class="link-icon">
                <span>Stack Overflow</span>
            </a>
            <a href="#" class="icon-link-item">
                <img src="https://bu.dusays.com/2025/01/31/679c9acae2452.webp" class="link-icon">
                <span>Medium</span>
            </a>
            <a href="#" class="icon-link-item">
                <img src="icon-devto.png" class="link-icon">
                <span>Dev Community</span>
            </a>
        </div>
    </div>
</div>




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