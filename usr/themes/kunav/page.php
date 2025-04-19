<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<?php $this->need('head.php'); ?>

    <div class="category-group">
                <div class="article-content" style="padding: 12px;">

<h1 class="site-title"><?php $this->title() ?></h1>

<!-- 回复&登录可见 -->
<?php
// 处理密码可见逻辑
if ($this->request->isPost() && $this->request->mm === 'ok') {
    if (strpos($this->content, '{mm') !== false) {
        $this->content = preg_replace_callback('/{mm id="(.+?)"}(.+?){\/mm}/', function($match) {
            return ($this->request->pass === $match[1]) ? $match[2] : $match[0];
        }, $this->content);
    }
}

// 未通过验证时显示密码表单
if (strpos($this->content, '{mm') !== false) {
    $this->content = preg_replace('/{mm id="(.+?)"}(.+?){\/mm}/', 
        '<form action="?mm=ok" class="xm-mm" method="post">
            <div class="xm-mm-input">
                <input type="password" name="pass" placeholder="请输入密码">
            </div>
            <div class="xm-mm-button">
                <button type="submit">提交</button>
            </div>
        </form>', 
    $this->content);
}

// 初始化内容处理
$db = Typecho_Db::get();
$sql = $db->select()->from('table.comments')
       ->where('cid =?', $this->cid)
       ->where('mail =?', $this->remember('mail', true))
       ->where('status =?', 'approved')
       ->limit(1);
$result = $db->fetchAll($sql);

$finalContent = getContentTest($this->content);

// 登录可见处理
$loginPattern = "/$login$(.*?)$\/login$/sm";
if ($this->user->hasLogin()) {
    $finalContent = preg_replace($loginPattern, '<div class="login_reply2view">$1</div>', $finalContent);
} else {
    $finalContent = preg_replace($loginPattern, '<div class="login_reply2view">请<a href="/admin">登录</a>后查看</div>', $finalContent);
}

// 回复可见处理
$hidePattern = "/$hide$(.*?)$\/hide$/sm";
if ($this->user->hasLogin() || $result) {
    $finalContent = preg_replace($hidePattern, '<div class="reply2view">$1</div>', $finalContent);
} else {
    $finalContent = preg_replace($hidePattern, '<div class="reply2view">请<a href="#comments">评论</a>后查看</div>', $finalContent);
}

echo $finalContent;
?>
<!-- 回复&登录可见 -->

                    
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
