<?php function threadedComments($comments, $options) {
    $commentClass = '';
    if ($comments->authorId) {
        if ($comments->authorId == $comments->ownerId) {
            $commentClass .= ' comment-by-author';  //如果是文章作者的评论添加 .comment-by-author 样式
        } else {
            $commentClass .= ' comment-by-user';  //如果是评论作者的添加 .comment-by-user 样式
        }
    } 
    $commentLevelClass = $comments->_levels > 0 ? ' comment-child' : ' comment-parent';  //评论层数大于0为子级，否则是父级
?>






<li class="timenode <?php 
if ($comments->_levels > 0) {
    echo ' comment-child';
    $comments->levelsAlt(' comment-level-odd', ' comment-level-even');
} else {
    echo ' comment-parent';
}
$comments->alt(' comment-odd', ' comment-even');
echo $commentClass; 
?>" id="<?php $comments->theId(); ?>"> 
<div class="header">
<div class="user-info"> 
<?php $number=$comments->mail;
if(preg_match('|^[1-9]\d{4,11}@qq\.com$|i',$number)){
echo '<img src="https://q2.qlogo.cn/headimg_dl? bs='.$number.'&dst_uin='.$number.'&dst_uin='.$number.'&;dst_uin='.$number.'&spec=100&url_enc=0&referer=bu_interface&term_type=PC">'; 
}else{
echo '<img src="https://gcore.jsdelivr.net/gh/cdn-x/placeholder@1.0.12/avatar/round/3442075.svg">';
}
?>
<span style="font-weight:bold">


<?php if ($comments->url): ?>
<a href="<?php echo $comments->url ?>" target="_blank" rel="external nofollow">
<?php echo $comments->author ?>
</a>


<?php
//博主样式

$me = md5(strtolower('3111349763@qq.com')); //这里填入自己的邮箱
$rz = md5(strtolower($comments->mail)); //用于判断邮箱
$str =  '<span style="color: #FFF;padding: .1rem .25rem;font-size: .7rem;border-radius: .25rem;background-color:#1ECD97;" >博主</span>';

$str2 =  '<span style="color: #FFF;padding: .1rem .25rem;font-size: .7rem;border-radius: .25rem;background-color:#C0C0C0;" >游客</span>';
//开始判断
if ($comments->authorId) {
        if ($comments->authorId == $comments->ownerId) {echo $str;}}

elseif($me==$rz){echo $str;}

else{echo $str2;}        
?>


<?php else: ?>
<a href="<?php $comments->permalink();?>">
<?php $comments->author(); ?></a>

<?php
$me = md5(strtolower('3111349763@qq.com')); //这里填入自己的邮箱
$rz = md5(strtolower($comments->mail)); //用于判断邮箱
//博主样式
$str =  '<span style="color: #FFF;padding: .1rem .25rem;font-size: .7rem;border-radius: .25rem;background-color:#1ECD97;" >博主</span>';

$str2 =  '<span style="color: #FFF;padding: .1rem .25rem;font-size: .7rem;border-radius: .25rem;background-color:#C0C0C0;" >游客</span>';
//开始判断
if ($comments->authorId) {
        if ($comments->authorId == $comments->ownerId) {echo $str;}}
elseif($me==$rz){echo $str;}
else{echo $str2;}        
?>

<?php endif; ?>
</span>

</div> 
<span>
<?php $comments->date('Y/n/j H:i:s'); ?></span>
&nbsp<span class=cm><b><?php $comments->reply('回复'); ?></b>
</span>
</div>
<div class="body">

<?php $parentMail = get_comment_at($comments->coid)?><?php echo $parentMail;?>

<?php $comments->content(); ?>
<?php if ('waiting' == $comments->status): ?>
<span style="color:#ff0000;font-weight:bold;float:right">评论正在审核中</span>
<?php endif;?>
</div>
</li>



<?php if ($comments->children) { ?>
      <?php $comments->threadedComments($options); ?>
    <?php } ?>
 
<?php } ?>


<div id="comments">
    <?php $this->comments()->to($comments); ?>
    <?php if ($comments->have()): ?>
        <h3><?php $this->commentsNum(_t('暂无评论'), _t('仅有一条评论'), _t('已有 %d 条评论')); ?></h3>
<div class="tag-plugin timeline ds-fcircle">
        <?php $comments->listComments(); ?>
</div>
        <?php $comments->pageNav('&laquo; 前一页', '后一页 &raquo;'); ?>

    <?php endif; ?>

    <?php if ($this->allow('comment')): ?>
        <div id="<?php $this->respondId(); ?>" class="respond">
            <div class="cancel-comment-reply">
                <?php $comments->cancelReply(); ?>
            </div>

            <h3 id="response"><?php _e('添加新评论'); ?></h3>
            <form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form">
                <?php if ($this->user->hasLogin()): ?>
                    <p><?php _e('登录身份: '); ?><a
                            href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a>. <a
                            href="<?php $this->options->logoutUrl(); ?>" title="Logout"><?php _e('退出'); ?> &raquo;</a>
                    </p>
                <?php else: ?>
                    <p>
                        <label for="author" class="required"><?php _e('称呼'); ?></label>
                        <input type="text" name="author" id="author" class="text"
                               value="<?php $this->remember('author'); ?>" required/>
                    </p>
                    <p>
                        <label
                            for="mail"<?php if ($this->options->commentsRequireMail): ?> class="required"<?php endif; ?>><?php _e('Email'); ?></label>
                        <input type="email" name="mail" id="mail" class="text"
                               value="<?php $this->remember('mail'); ?>"<?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?> />
                    </p>
                    <p>
                        <label
                            for="url"<?php if ($this->options->commentsRequireURL): ?> class="required"<?php endif; ?>><?php _e('网站'); ?></label>
                        <input type="url" name="url" id="url" class="text" placeholder="<?php _e('http://'); ?>"
                               value="<?php $this->remember('url'); ?>"<?php if ($this->options->commentsRequireURL): ?> required<?php endif; ?> />
                    </p>
                <?php endif; ?>
                <p>
                    <label for="textarea" class="required"><?php _e('内容'); ?></label>
                    <textarea rows="8" cols="50" name="text" id="textarea" class="textarea"
                              required><?php $this->remember('text'); ?></textarea>
                </p>
                
                    <button type="submit" class="submit link-item"><?php _e('提交评论'); ?></button>

<?php $security = $this->widget('Widget_Security'); ?>
            <input type="hidden" name="_" value="<?php echo $security->getToken($this->request->getReferer())?>">

<script type="text/javascript">
(function () {
    window.TypechoComment = {
        dom : function (id) {
            return document.getElementById(id);
        },

        create : function (tag, attr) {
            var el = document.createElement(tag);

            for (var key in attr) {
                el.setAttribute(key, attr[key]);
            }

            return el;
        },

        reply : function (cid, coid) {
            var comment = this.dom(cid), parent = comment.parentNode,
                response = this.dom('<?php $this->respondId();?>'), input = this.dom('comment-parent'),
                form = 'form' == response.tagName? response : response.getElementsByTagName('form')[0],
                textarea = response.getElementsByTagName('textarea')[0];

            if (null == input) {
                input = this.create('input', {
                    'type' : 'hidden',
                    'name' : 'parent',
                    'id'   : 'comment-parent'
                });

                form.appendChild(input);
            }

            input.setAttribute('value', coid);

            if (null == this.dom('comment-form-place-holder')) {
                var holder = this.create('div', {
                    'id' : 'comment-form-place-holder'
                });

                response.parentNode.insertBefore(holder, response);
            }

            comment.appendChild(response);
            this.dom('cancel-comment-reply-link').style.display = '';

            if (null!= textarea && 'text' == textarea.name) {
                textarea.focus();
            }

            return false;
        },

        cancelReply : function () {
            var response = this.dom('<?php $this->respondId();?>'),
            holder = this.dom('comment-form-place-holder'), input = this.dom('comment-parent');

            if (null!= input) {
                input.parentNode.removeChild(input);
            }

            if (null == holder) {
                return true;
            }

            this.dom('cancel-comment-reply-link').style.display = 'none';
            holder.parentNode.insertBefore(response, holder);
            return false;
        }
    };
})();
</script>
                
            </form>
        </div>
    <?php else: ?>
        <h3><?php _e('评论已关闭'); ?></h3>
    <?php endif; ?>
</div>
