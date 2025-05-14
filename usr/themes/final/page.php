<?php if (!defined("__TYPECHO_ROOT_DIR__")) {
    exit();
} ?>
<?php $this->need("header.php"); ?>
<main>
    <h1><center><?php $this->title(); ?></center></h1>
 <center>   <p>        
            <time datetime="<?php $this->date("c"); ?>">
                <?php $this->date("Y-m-d"); ?>
            </time>       

&nbsp
<a href="#comments">评 <?php $this->commentsNum(); ?></a>

&nbsp
<?php if($this->user->hasLogin()):?>
<?php if ($this->is('post') or $this->is('page')): ?>
<a target="_blank" href="<?php if ($this->is('post')): ?><?php $this->options->adminUrl(); ?>write-post.php?cid=<?php echo $this->cid;?><?php elseif ($this->is('page')): ?><?php $this->options->adminUrl(); ?>write-page.php?cid=<?php echo $this->cid;?><?php endif;?>" style="font-weight:bold"><?php _e
('编辑'); ?></a>
<?php endif; ?>
<?php endif; ?>
    </p>
</center>
    <article>
    <?php if (getContentTest($this->content)): ?>
        

<!-- 回复&登录可见 -->
                <?php
// 处理密码验证（无cookie版）
if ($this->request->isPost() && $this->request->mm === 'ok') {
    $targetID = $this->request->id;
    $inputKey = $this->request->key;

    // 仅处理当前提交的加密块
    $this->content = preg_replace_callback(
        '/{mm id="'.preg_quote($targetID).'" key="(.+?)"}(.+?){\/mm}/s',
        function($match) use ($inputKey) {
            return ($inputKey === $match[1]) 
                ? '<div class="xm-mm xm-unlocked">'.$match[2].'</div>'
                : '<div class="xm-mm xm-mm-error" style=\"font-weight:bold;font-size:1.5em;\">密码错误，请返回重试</div>';
        },
        $this->content
    );
}

// 显示密码表单（始终显示）
$this->content = preg_replace_callback(
    '/{mm id="(.+?)" key="(.+?)"}(.+?){\/mm}/s',
    function($match) {
        // 直接返回表单，不检查任何状态
        return '<form action="" method="post" class="xm-mm">
            <input type="hidden" name="mm" value="ok">
            <input type="hidden" name="id" value="'.$match[1].'">
            <div class="xm-mm-input">
                <input type="password" name="key" class="xm-mm-pass" placeholder="输入密码" required>
            </div>
<div class="xm-mm-button">
            <button type="submit" class="xm-mm-submit">解锁</button>
</div>        </form>';
    },
    $this->content
);



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
                    $finalContent = preg_replace("/\[hide\](.*?)\[\/hide\]/sm",'<div class="reply2view open">$1</div>', $finalContent);
                } else {
                    $finalContent = preg_replace("/\[hide\](.*?)\[\/hide\]/sm",'<div class="reply2view lock">此处内容需要<a href="#comments">评论</a>回复后（审核通过）方可阅读</div>', $finalContent);
                }
                
                echo $finalContent;
                ?>
                <!-- 回复&登录可见 -->

    <?php else: ?>
        <p>此页面内容尚未发布。</p>
    <?php endif; ?>
    </article>

<p style="text-align:right;">更新于：<time><?php echo date('Y-m-d H:i:s' , $this->modified + ($this->options->timezone - idate("Z"))); ?></time></p>

</main>

<?php if ($this->options->commenton === "on" && $this->allow('comment')) : ?>
<?php $this->need('comments.php'); ?>
<?php endif; ?>

<?php $this->need("footer.php"); ?>
