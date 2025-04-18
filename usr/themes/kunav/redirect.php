<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>


    <?php $target = urldecode($_GET['target']); ?>
 

<div class="category-group">
    <div class="category-header">
        <div class="main-category">跳转提示：<?php _e("离开" . $this->options->title); ?></div>
    </div>
    
    <div class="content-container" style="position: relative; min-height: 120px;">

<p style="margin: 12px 8px; color: #666; font-size: 14px; line-height: 1.6;" ><?php _e("您即将离开<span style=\"color:#f00;font-weight:bold;\"> " . $this->options->title . " </span>，<br>前往外部网站<span style=\"color:#3b82f6;\"> " . $target . " </span>，请注意您的个人隐私和财产安全。") ?></p>
        
        <div style="position: absolute; right: 8px; bottom: 8px;">
            <a href="<?php echo $target; ?>" class="link-item" style="display: inline-block; padding: 6px 20px;font-weight:bold;" rel="noopener noreferrer" target="_blank">
                <?php _e("继续访问"); ?>
            </a>
        </div>
    </div>
</div>


      




                        
           



<?php $this->need('js.php'); ?>
<?php $this->need('footer.php'); ?>
