<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>






<!-- 插入在<body标签之后 -->
<button class="sidebar-toggle" onclick="toggleSidebar()">侧</button>
<div class="sidebar-mask" onclick="toggleSidebar()"></div>
<aside class="sidebar">
    <div class="category-group">
        <div class="category-header">
            <div class="main-category">全部分类</div>
        </div>
        
        <div class="content-container">
            <!-- 开发工具分类 -->
            <div class="category-item">
                <div class="category-title" onclick="toggleSub(this)">
                    <span>开发工具</span>
                    <div class="toggle-icon">卍</div>
                </div>
                <div class="sub-category">
                    <a href="#" class="link-item">前端开发</a>
                    <a href="#" class="link-item">后端框架</a>
                    <a href="#" class="link-item">数据库</a>
                </div>
            </div>
            
            <!-- 设计资源分类 -->
            <div class="category-item">
                <div class="category-title" onclick="toggleSub(this)">
                    <span>设计资源</span>
                    <div class="toggle-icon">卍</div>
                </div>
                <div class="sub-category">
                    <a href="#" class="link-item">UI素材</a>
                    <a href="#" class="link-item">图标库</a>
                    <a href="#" class="link-item">设计模板</a>
                </div>
            </div>
        </div>
    </div>
</aside>