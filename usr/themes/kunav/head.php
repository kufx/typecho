<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; 

?>




<!-- 新增标题栏 -->


    <div class="header-group">
        <div class="site-title typewriter"><?php $this->options->title(); ?></div>

        <div class="header-tabs">
            <div class="header-tab" data-action="night" onclick="toggleNightMode()">模式</div>
<div class="header-tab" data-action="refresh" onclick="location.reload()">刷新</div>
<a href="<?php $this->options->adminUrl(); ?>" class="header-tab" target="_blank"><?php _e('登录'); ?></a>

<?php \Widget\Contents\Page\Rows::alloc()->to($pages); ?>
  <?php while ($pages->next()): ?>
        <a class="header-tab" href="<?php $pages->permalink(); ?>" title="<?php $pages->title(); ?>"><?php $pages->title(); ?></a>
  <?php endwhile; ?>              </div>
    </div>

<?php if($this->is('index')): ?>
<!-- 新增搜索栏 -->
    <div class="search-group">
        <div class="search-header">
            <div class="search-engine-tabs">
                <div class="engine-tab active" data-engine="internal">Yandex</div>
<div class="engine-tab" data-engine="nami">纳米AI</div>
<div class="engine-tab" data-engine="metaso">秘塔AI</div>

   <div class="engine-tab" data-engine="isou">isou AI</div>
   <div class="engine-tab" data-engine="baiduai">百度AI</div>
   <div class="engine-tab" data-engine="kfind">kFind AI</div>
   <div class="engine-tab" data-engine="phind">Phind AI</div> 
<div class="engine-tab" data-engine="bing">必应</div>            
   <div class="engine-tab" data-engine="baidu">百度</div>
<div class="engine-tab" data-engine="360">360</div>
                <div class="engine-tab" data-engine="toutiao">头条</div>
                <div class="engine-tab" data-engine="sougou">搜狗</div>
            </div>
        </div>
        <div class="search-box">
            <input type="text" class="search-input" placeholder="输入关键词 回车 搜索..." >
            <button class="engine-tab active" onclick="doSearch()" >搜索</button>
        </div>
    </div>
<?php endif; ?>