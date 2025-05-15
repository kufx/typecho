<?php


use Typecho\Common;
use Typecho\Widget\Helper\Form\Element\Checkbox;
use Typecho\Widget\Helper\Form\Element\Text;
use Typecho\Widget\Helper\Form\Element\Textarea;
use Typecho\Widget\Helper\Form\Element\Radio;
use Utils\Helper;
use Widget\Notice;
use Widget\Options;
if (!defined("__TYPECHO_ROOT_DIR__")) {
    exit();
}

function themeConfig($form)
{


$str1 = explode('/themes/', Helper::options()->themeUrl);
$str2 = explode('/', $str1[1]);
$name=$str2[0];
$db = Typecho_Db::get();
$sjdq=$db->fetchRow($db->select()->from ('table.options')->where ('name = ?', 'theme:'.$name));
$ysj = $sjdq['value'];
if(isset($_POST['type']))
{ 
if($_POST["type"]=="备份模板设置数据"){
if($db->fetchRow($db->select()->from ('table.options')->where ('name = ?', 'theme:'.$name.'bf'))){
$update = $db->update('table.options')->rows(array('value'=>$ysj))->where('name = ?', 'theme:'.$name.'bf');
$updateRows= $db->query($update);
echo '<div class="tongzhi col-mb-12 home">备份已更新，请等待自动刷新！如果等不到请点击';
?>    
<a href="<?php Helper::options()->adminUrl('options-theme.php'); ?>">这里</a></div>
<script language="JavaScript">window.setTimeout("location=\'<?php Helper::options()->adminUrl('options-theme.php'); ?>\'", 2500);</script>
<?php
}else{
if($ysj){
     $insert = $db->insert('table.options')
    ->rows(array('name' => 'theme:'.$name.'bf','user' => '0','value' => $ysj));
     $insertId = $db->query($insert);
echo '<div class="tongzhi col-mb-12 home">备份完成，请等待自动刷新！如果等不到请点击';
?>    
<a href="<?php Helper::options()->adminUrl('options-theme.php'); ?>">这里</a></div>
<script language="JavaScript">window.setTimeout("location=\'<?php Helper::options()->adminUrl('options-theme.php'); ?>\'", 2500);</script>
<?php
}
}
        }
if($_POST["type"]=="还原模板设置数据"){
if($db->fetchRow($db->select()->from ('table.options')->where ('name = ?', 'theme:'.$name.'bf'))){
$sjdub=$db->fetchRow($db->select()->from ('table.options')->where ('name = ?', 'theme:'.$name.'bf'));
$bsj = $sjdub['value'];
$update = $db->update('table.options')->rows(array('value'=>$bsj))->where('name = ?', 'theme:'.$name);
$updateRows= $db->query($update);
echo '<div class="tongzhi col-mb-12 home">检测到模板备份数据，恢复完成，请等待自动刷新！如果等不到请点击';
?>    
<a href="<?php Helper::options()->adminUrl('options-theme.php'); ?>">这里</a></div>
<script language="JavaScript">window.setTimeout("location=\'<?php Helper::options()->adminUrl('options-theme.php'); ?>\'", 2000);</script>
<?php
}else{
echo '<div class="tongzhi col-mb-12 home">没有模板备份数据，恢复不了哦！</div>';
}
}
if($_POST["type"]=="删除备份数据"){
if($db->fetchRow($db->select()->from ('table.options')->where ('name = ?', 'theme:'.$name.'bf'))){
$delete = $db->delete('table.options')->where ('name = ?', 'theme:'.$name.'bf');
$deletedRows = $db->query($delete);
echo '<div class="tongzhi col-mb-12 home">删除成功，请等待自动刷新，如果等不到请点击';
?>    
<a href="<?php Helper::options()->adminUrl('options-theme.php'); ?>">这里</a></div>
<script language="JavaScript">window.setTimeout("location=\'<?php Helper::options()->adminUrl('options-theme.php'); ?>\'", 2500);</script>
<?php
}else{
echo '<div class="tongzhi col-mb-12 home">不用删了！备份不存在！！！</div>';
}
}
    }
echo '<form class="protected home col-mb-12" action="?'.$name.'bf" method="post">
<input type="submit" name="type" class="btn btn-s" value="备份模板设置数据" />  <input type="submit" name="type" class="btn btn-s" value="还原模板设置数据" />  <input type="submit" name="type" class="btn btn-s" value="删除备份数据" /></form>';


    $logoUrl = new \Typecho\Widget\Helper\Form\Element\Text(
        "logoUrl",
        null,
        "default-logo.png",
        _t("站点 LOGO 地址"),
        _t("在这里填入一个图片 URL 地址")
    );
    $form->addInput($logoUrl);


$zd = new \Typecho\Widget\Helper\Form\Element\Text(
        'zd',
        null,
        null,
        _t('置顶文章'),
        _t('这里写要置顶的文章cid')
    );
    $form->addInput($zd);


$emoji_links = new Typecho_Widget_Helper_Form_Element_Textarea('emoji_links', null, null, _t('文章行内表情数据'), _t('写法比如：别名|表情链接'));
$form->addInput($emoji_links);


$commenton = new Typecho_Widget_Helper_Form_Element_Radio('commenton', array(
    'on' => '显示评论',
    'off' => '关闭评论'
), 'null', _t('全站评论显示控制'), _t('默认显示评论'));
$form->addInput($commenton -> multiMode());

$themechange = new Typecho_Widget_Helper_Form_Element_Radio('themechange', array(
    'on' => '开启切换按钮',
    'off' => '关闭切换按钮'
), 'off', _t('全站评论显示控制'), _t('默认关闭切换按钮'));
$form->addInput($themechange -> multiMode());    

$sliderGroup = new Typecho_Widget_Helper_Form_Element_Radio(
    'sliderGroup',
    array(
      'show' => _t('显示'),
      'hide' => _t('隐藏')
    ),
    'hide',
    _t('首页轮播图'),
    _t('是否显示首页轮播图')
  );
  $form->addInput($sliderGroup);

  $sliderItems = new Typecho_Widget_Helper_Form_Element_Textarea(
    'sliderItems',
    NULL,
    NULL,
    _t('轮播图设置'),
    _t('按照格式填写轮播图信息，每行一个，格式: 图片URL|标题|链接URL')
  );
  $form->addInput($sliderItems);

  $sliderHeight = new Typecho_Widget_Helper_Form_Element_Text(
    'sliderHeight',
    NULL,
    '300',
    _t('轮播图高度'),
    _t('轮播图显示的高度，单位为px，默认300')
  );
  $form->addInput($sliderHeight);
$announcementText = new Textarea(
    "announcementText",
    null,
    null,
    "公告内容",
    "填写公告内容，支持HTML标签。留空则不显示公告。"
  );
  $form->addInput($announcementText);

  $announcementStyle = new Radio(
    "announcementStyle",
    [
      "style1" => _t("主题色"),
      "style2" => _t("温暖橙"),
      "style3" => _t("清新绿"),
      "style4" => _t("典雅紫"),
    ],
    "style1",
    _t("公告样式"),
    _t("选择公告显示的样式")
  );
  $announcementStyle->setAttribute('class', 'jasmine-ann-style');
  $form->addInput($announcementStyle);

  $announcementDuration = new Text(
    "announcementDuration",
    null,
    "5",
    _t("公告显示时间"),
    _t("公告自动关闭的时间（秒），默认5秒")
  );
  $form->addInput($announcementDuration);

  $announcementFrequency = new Radio(
    "announcementFrequency",
    [
      "always" => _t("每次访问都显示"),
      "once" => _t("24小时内只显示一次"),
      "never" => _t("暂时关闭公告"),
    ],
    "always",
    _t("公告显示频率"),
    _t("设置公告的显示频率")
  );
  $form->addInput($announcementFrequency);

    $addhead = new \Typecho\Widget\Helper\Form\Element\Textarea(
        "addhead",
        null,
        null,
        _t("头部代码"),
        _t("可填写自定义 CSS、JS 代码等")
    );
    $form->addInput($addhead);

    $addfoot = new \Typecho\Widget\Helper\Form\Element\Textarea(
        "addfoot",
        null,
        null,
        _t("页脚代码"),
        _t("支持 HTML，可填写备案、统计等信息")
    );
    $form->addInput($addfoot);
}


// 从主题自定义字段获取数据的函数
function get_emoji_links() {
    // 移除全局变量，改用 Typecho 标准方法获取配置
    $options = Typecho_Widget::widget('Widget_Options');
    
    // 直接获取字段值（合并原有两个判断逻辑）
    $customFieldValue = ($options && isset($options->emoji_links)) ? $options->emoji_links : '';

    if (empty($customFieldValue)) { 
        // 保持原始错误提示逻辑
       // echo "自定义字段 emoji_links 为空";

        return []; 
    }

    // 保持原有分割和处理逻辑
    $lines = explode("\n", $customFieldValue);
    $emoji_links = []; 
    
    foreach ($lines as $line) { 
        $parts = explode('|', $line); 
        if (count($parts) === 2) { 
            $alias = trim($parts[0]); 
            $link = trim($parts[1]); 
            $emoji_links[$alias] = $link; 
        }
    }


if (empty($emoji_links)) {
        
// 关键修复：强制返回空数组
    return array();

    }

    return $emoji_links; 
}



function getContentTest($content) {

$emoji_links = get_emoji_links();

if (empty($emoji_links)) {
        return $content;
    }

    $pattern = '/\[emoji\s*"([^"]+)"\]/';
    $replacement = function ($matches) use ($emoji_links) {
        $alias = $matches[1];
        if (isset($emoji_links[$alias])) {
            return '<img class="emoji-inline" src="'. $emoji_links[$alias]. '" ></img>';
        } else {
            // 如果不是别名而是直接的链接
            if (filter_var($alias, FILTER_VALIDATE_URL)) {
                return '<img class="emoji-inline" src="'. $alias. '" ></img>';
            }
            return $matches[0]; 
        }
    };

    $content = preg_replace_callback($pattern, $replacement, $content);



$pattern = '/\[searchtb\]/';
    $replacement = '<center>  <span id="rowCountMessage">此页面表格共 <span id="rowCount">?</span> 行</span><body onclick="handleClickOutsideSearch()"><input type="text" style="background:var(--card);color:var(--text);font-family:inherit" id="searchInput" oninput="searchTables()" onfocus="expandSearchInput
()" onmousedown="expandSearchInput()" ontouchstart="expandSearchInput()" 
placeholder="输入【关键词】搜索..."><span id="resultInfo"></span> </center>';
    $content = preg_replace($pattern, $replacement, $content);


return $content;

}




function get_comment_at($coid){
    $db   = Typecho_Db::get();
    $prow = $db->fetchRow($db->select('parent,status')->from('table.comments')
        ->where('coid = ?', $coid));//当前评论
    $mail = "";
    $parent = @$prow['parent'];
    if ($parent != "0") {//子评论
        $arow = $db->fetchRow($db->select('author,status,mail')->from('table.comments')
            ->where('coid = ?', $parent));//查询该条评论的父评论的信息
        @$author = @$arow['author'];//作者名称
        $mail = @$arow['mail'];


        if(@$author && $arow['status'] == "approved"){//父评论作者存在且父评论已经审核通过

            if (@$prow['status'] == "waiting"){                echo '<p class="commentReview">（评论正在审核中）</p>';
            }
            echo '<a href="#comment-' . $parent . '">@' . $author . '</a>';
        }else{//父评论作者不存在或者父评论没有审核通过
            if (@$prow['status'] == "waiting"){
                echo '<p class="commentReview">（评论正在审核中）</p>';
            }else{
                echo '';
            }
        }

    } else {//母评论，无需输出锚点链接
        if (@$prow['status'] == "waiting"){
            echo '<p class="commentReview">（评论正在审核中）</p>';
        }else{
            echo '';
        }
    }
    }


   

function checkUserType($mail) {
    // 强制初始化用户组件
    Typecho_Widget::widget('Widget_User')->to($user);
    
    // 获取当前用户邮箱（登录状态优先）

    // 未登录时获取默认博主邮箱
            $db = Typecho_Db::get();
        $authorMail = $db->fetchRow($db->select('mail')
            ->from('table.users')
            ->where('uid = ?', 1) // 假设默认博主uid=1
            ->limit(1))['mail'];
        $authorMail = strtolower(trim($authorMail));
    
    // 处理输入邮箱
    $inputMail = strtolower(trim($mail));

    // 增加空值保护
    if (empty($authorMail) || empty($inputMail)) {
        return false;
    }

    // 精确对比
    return $inputMail === $authorMail;
}





// 回复可见
Typecho_Plugin::factory('Widget_Abstract_Contents')->excerptEx = array('z97hide','one');
Typecho_Plugin::factory('Widget_Abstract_Contents')->contentEx = array('z97hide','one');
class z97hide {
    public static function one($con,$obj,$text)
    {
      $text = empty($text)?$con:$text;
      if(!$obj->is('single')){
      $text = preg_replace("/\[hide\](.*?)\[\/hide\]/sm",'',$text);
      }
      
               return $text;
}
}
// 登录可见
Typecho_Plugin::factory('Widget_Abstract_Contents')->excerptEx = array('z97login','one');
Typecho_Plugin::factory('Widget_Abstract_Contents')->contentEx = array('z97login','one');
class z97login {
    public static function one($con,$obj,$text)
    {
      $text = empty($text)?$con:$text;
      if(!$obj->is('single')){
      $text = preg_replace("/\[login\](.*?)\[\/login\]/sm",'',$text);
      }
      return $text;
    }
}


