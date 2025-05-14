<?php
/**
 * 用户列表模板
 *
 * @package custom
 *
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

$this->need("header.php");
?>

<main>
 <?php
// 获取数据库实例和站点配置
$db = Typecho_Db::get();
$options = Typecho_Widget::widget('Widget_Options');

// 查询用户数据
$users = $db->fetchAll($db->select()->from('table.users'));

if ($users) {
    echo '<table class="user-posts-table">';
    echo '<thead><tr><th>用户昵称</th><th>个人主页</th><th>文章列表</th></tr></thead>';
    echo '<tbody>';
    
    foreach ($users as $user) {
        // 基础信息处理
        $screenName = htmlspecialchars($user['screenName'] ?: $user['name']);
        $profileUrl = htmlspecialchars($user['url']);
        
        // 生成文章列表链接（格式：/author/用户ID/）
        $postsUrl = $options->siteUrl . 'author/' . (int)$user['uid'] . '/';
        
        echo '<tr>';
        // 用户昵称
        echo '<td>' . $screenName . '</td>';
        // 个人主页
        echo '<td>' . ($profileUrl ? '<a class="post-list-link" href="'.$profileUrl.'" target="_blank" rel="nofollow">访问主页</a>' : '暂无') . '</td>';
        // 文章列表
        echo '<td><a href="' . $postsUrl . '" class="post-list-link">查看文章</a></td>';
        echo '</tr>';
    }
    
    echo '</tbody></table>';
} else {
    echo '<p>暂无用户数据</p>';
}
?>
</main>
<?php $this->need("footer.php");
?>