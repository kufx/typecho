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
 
<!-- 回复&登录可见 -->
                <?php


// 处理密码可见逻辑
if ($this->request->isPost() && $this->request->mm === 'ok') {
    if (strpos($this->content, '{mm') !== false) {
        $this->content = preg_replace_callback('/{mm id="(.+?)"}(.+?){\/mm}/', function($match) {
            // 添加 xm-unlocked 类名到包裹层
            return ($this->request->pass === $match[1]) 
                ? '<div class="xm-mm xm-unlocked">' . $match[2] . '</div>' 
                : $match[0];
        }, $this->content);
    }
}

// 未通过验证时显示密码表单（保持不变）
if (strpos($this->content, '{mm') !== false) {
    $this->content = preg_replace('/{mm id="(.+?)"}(.+?){\/mm}/', 
        '<form action="?mm=ok" class="xm-mm" method="post">
            <div class="xm-mm-input">
                <input type="password" class="xm-mm-pass" name="pass" placeholder="请输入密码">
            </div>
            <div class="xm-mm-button">
                <button type="submit" class="xm-mm-submit">提交</button>
            </div>
        </form>', 
    $this->content);
}


                $db = Typecho_Db::get();
                $sql = $db->select()->from('table.comments')
                    ->where('cid =?',$this->cid)
                    ->where('mail =?', $this->remember('mail',true))
                    ->where('status =?', 'approved')
                    ->limit(1);
                $result = $db->fetchAll($sql);
                
                $finalContent = getContentTest($this->content);  // 先保存原始内容
                
                if($this->user->hasLogin()) {
                    // 处理登录可见
                    $finalContent = preg_replace("/\[login\](.*?)\[\/login\]/sm",'<div class="login_reply2view jz jc ys">$1</div>', $finalContent);
                } else {
                    $finalContent = preg_replace("/\[login\](.*?)\[\/login\]/sm",'<div class="login_reply2view jz jc ys">此处内容需要<a href="/admin" target="_blank">登录</a>后方可阅读</div>', $finalContent);
                }
                
                if($this->user->hasLogin() || $result) {
                    // 处理回复可见
                    $finalContent = preg_replace("/\[hide\](.*?)\[\/hide\]/sm",'<div class="reply2view jz jc ys">$1</div>', $finalContent);
                } else {
                    $finalContent = preg_replace("/\[hide\](.*?)\[\/hide\]/sm",'<div class="reply2view jz jc ys">此处内容需要<a href="#comments">评论</a>回复后（审核通过）方可阅读</div>', $finalContent);
                }
                
                echo $finalContent;
                ?>
<!-- 回复&登录可见 -->

            
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
