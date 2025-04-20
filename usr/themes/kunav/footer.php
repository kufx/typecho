<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

    
<footer id="footer" role="contentinfo">
    <?php if($this->options->footer): ?>
<?php echo $this->options->footer(); ?>
<?php endif; ?><br>
    &copy; <?php echo date('Y'); ?> <a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a>.
    <?php _e('由 <a href="https://typecho.org">Typecho</a> 强力驱动'); ?>. 
    
</footer><!-- end #footer -->

</body>
</html>
