<?php
/**
 * 或许是你的最终选择，接下来请专心写作吧。
 * Your final choice. Please focus on writing next.
 *
 * @package final
 * @author HoytZhang
 * @version 1.6
 * @link https://banzhuanriji.com
 */
if (!defined("__TYPECHO_ROOT_DIR__")) {
    exit();
}


$path = $_SERVER["REQUEST_URI"];
$tmp_file = "/tmp/".md5($path).".html";
if(file_exists($tmp_file) && is_readable($tmp_file)){
    $content = file_get_contents($tmp_file);
    echo $content;
    die();
}
ob_start();


/** 文章置顶 */
$sticky = $this->options->zd; //置顶的文章id，多个用|隔开
if($sticky){
    $sticky_cids = explode('|',$sticky); //分割文本
    $sticky_html = "<span style='color:#fff;padding: .1rem .25rem;font-size:inherit;border-radius: .25rem;background-color:#f00;'>置顶</span>&nbsp"; //置顶标题的 html

    $db = Typecho_Db::get();
    $pageSize = $this->options->pageSize;
    $select1 = $this->select()->where('type = ?', 'post');
    $select2 = $this->select()->where('type = ? && status = ? && created < ?', 'post','publish',time());

    //清空原有文章的列队
    $this->row = [];
    $this->stack = [];
    $this->length = 0;

    $order = '';
    foreach($sticky_cids as $i => $cid) {
        if($i == 0) $select1->where('cid = ?', $cid);
        else $select1->orWhere('cid = ?', $cid);
        $order .= " when $cid then $i";
        $select2->where('table.contents.cid != ?', $cid); //避免重复
    }
    if ($order) $select1->order('', "(case cid$order end)"); //置顶文章的顺序 按 $sticky 中 文章ID顺序
    if (($this->_currentPage || $this->currentPage) == 1) foreach($db->fetchAll($select1) as $sticky_post){ //首页第一页才显示
        $sticky_post['sticky'] = $sticky_html;
        $this->push($sticky_post); //压入列队
    }
    if($this->user->hasLogin()){
    $uid = $this->user->uid; //登录时，显示用户各自的私密文章
    if($uid) $select2->orWhere('authorId = ? && status = ?', $uid, 'private');
    }
    $sticky_posts = $db->fetchAll($select2->order('table.contents.created', Typecho_Db::SORT_DESC)->page($this->_currentPage, $this->parameter->pageSize));
    foreach($sticky_posts as $sticky_post) $this->push($sticky_post); //压入列队
    $this->setTotal($this->getTotal()-count($sticky_cids)); //置顶文章不计算在所有文章内
}

$this->need("header.php");
?>
<main>

<?php $this->need("slider.php"); ?>


<?php if ($this->have()): ?>
<?php while ($this->next()): ?>
    <div class="post-item">
    <a href="<?php $this->permalink(); ?>"><?php $this->sticky(); $this->title(); ?></a><time datetime="<?php $this->date(
    "c"
); ?>" itemprop="datePublished"><?php $this->date(); ?></time>
    </div>
<?php endwhile; ?>

<?php if ($this->is("archive") || $this->is("index")) { ?>
<div class="post-pagination">
<?php $this->pageNav("&nbsp;←&nbsp;", "&nbsp;→&nbsp;", "5", "…"); ?>
</div>
<?php } ?>
<?php else: ?><article><em>空空如也 ...</em></article><?php endif; ?>

</main>
<?php $this->need("footer.php"); ?>
