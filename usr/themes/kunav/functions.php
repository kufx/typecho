<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

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
        'logoUrl',
        null,
        null,
        _t('站点 LOGO 地址'),
        _t('在这里填入一个图片 URL 地址, 以在网站标题前加上一个 LOGO')
    );
    $form->addInput($logoUrl);


$backgroundColor = new \Typecho\Widget\Helper\Form\Element\Text(
        'backgroundColor',
        NULL,
        '#00BFFF',
        _t('页面背景颜色'),
        _t('支持十六进制颜色码或CSS颜色名称，例如：#F5F5F5 或 lightblue')
    );
    $form->addInput($backgroundColor);


$hoverColor = new \Typecho\Widget\Helper\Form\Element\Text(
        'hoverColor',
        NULL,
        '#00BFFF',
        _t('链接hover背景颜色'),
        _t('支持十六进制颜色码或CSS颜色名称，例如：#F5F5F5 或 lightblue')
    );
    $form->addInput($hoverColor);

    $sidebarBlock = new \Typecho\Widget\Helper\Form\Element\Checkbox(
        'sidebarBlock',
        [
            'ShowRecentPosts'    => _t('显示最新文章'),
            'ShowRecentComments' => _t('显示最近回复'),
            'ShowCategory'       => _t('显示分类'),
            'ShowArchive'        => _t('显示归档'),
            'ShowOther'          => _t('显示其它杂项')
        ],
        ['ShowRecentPosts', 'ShowRecentComments', 'ShowCategory', 'ShowArchive', 'ShowOther'],
        _t('侧边栏显示')
    );

$form->addInput($sidebarBlock->multiMode());


$emoji_links = new Typecho_Widget_Helper_Form_Element_Textarea('emoji_links', null, 3, _t('文章行内表情数据'), _t('写法比如：别名|表情链接'));
    $form->addInput($emoji_links);


// 新增导航配置字段
    $navField = new Typecho_Widget_Helper_Form_Element_Textarea(
        'subtab1', // 字段名（后台显示的字段标识）
        NULL,
        NULL,
        _t('导航区块配置'), // 字段标题
        _t('按照以下格式填写：<br>
<strong>一级标题:二级标题1|id1,二级标题2|id2.</strong><br>
<strong>id1:</strong><br>
名称1|链接1<br>
名称2|链接2<br>
<strong>示例：</strong><br>
工具导航:常用工具|tools1,设计资源|tools2.<br>
tools1:<br>
谷歌|https://google.com<br>
GitHub|https://github.com')
    );
    $form->addInput($navField);


// 新增导航配置字段
    $navField1 = new Typecho_Widget_Helper_Form_Element_Textarea(
        'subtab2', // 字段名（后台显示的字段标识）
        NULL,
        NULL,
        _t('导航区块配置'), // 字段标题
        _t('按照以下格式填写：<br>
<strong>一级标题:二级标题1|id1,二级标题2|id2.</strong><br>
<strong>id1:</strong><br>
名称1|链接1<br>
名称2|链接2<br>
<strong>示例：</strong><br>
工具导航:常用工具|tools1,设计资源|tools2.<br>
tools1:<br>
谷歌|https://google.com<br>
GitHub|https://github.com')
    );
    $form->addInput($navField1);


// 新增友情链接配置项
    $friendLinks = new \Typecho\Widget\Helper\Form\Element\Textarea(
        'friendLinks',
        null,
        null,
        _t('友情链接配置'),
        _t('每行格式：网站名称|链接地址，例如：<br>'. 
           htmlspecialchars('谷歌|https://google.com'))
    );
    $form->addInput($friendLinks);


// 新增带图标的链接字段（新增部分）
    $goodLinks = new \Typecho\Widget\Helper\Form\Element\Textarea(
        'goodLinks',
        null,
        null,
        _t('图标友情链接'),
        _t('每行格式：名称|链接|图标地址，例：<br>GitHub|https://github.com|/usr/themes/xxx/img/github.svg')
    );
    $form->addInput($goodLinks);






}



function getFriendLinks() 
{
    $content = Helper::options()->friendLinks;
    if (empty($content)) return '';

    $output = [];
    foreach (explode("\n", trim($content)) as $line) {
        $line = trim($line);
        if (empty($line)) continue;

        $parts = explode('|', $line, 2);
        if (count($parts) === 2) {
            $name = trim($parts[0]);
            $url = trim($parts[1]);
            $output[] = sprintf(
                '<a href="%s" class="link-item" target="_blank">%s</a>',
                htmlspecialchars($url),
                htmlspecialchars($name)
            );
        }
    }

    return implode("\n", $output);
}




/* 新增图标链接处理函数 */
function getGoodLinks() 
{
    $content = Helper::options()->goodLinks;
    if (empty($content)) return '';

    $output = [];
    foreach (explode("\n", trim($content)) as $line) {
        $line = trim($line);
        if (empty($line)) continue;

        $parts = explode('|', $line, 3); // 分割成3部分
        if (count($parts) === 3) {
            [$name, $url, $icon] = array_map('trim', $parts);
            
            $output[] = sprintf(
                '<a href="%s" class="icon-link-item" target="_blank" rel="noopener">
                    <img src="%s" class="link-icon" alt="%s">
                    <span>%s</span>
                </a>',
                htmlspecialchars($url),
                htmlspecialchars($icon),
                htmlspecialchars($name),
                htmlspecialchars($name)
            );
        }
    }

    return implode("\n", $output);
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
        Typecho_Log::log('表情链接格式解析失败', Typecho_Log::DEBUG);

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

return $content;

}




// 链接中转页
function getRedirectUrl($url)
{
    if (!$url) {
        return [
            'hasUrl' => false
        ];
    }

    $options = Widget::widget(Options::class);
    if (str_starts_with($url, $options->siteUrl)) {
        return [
            'hasUrl' => true,
            'url' => $url
        ];
    } else {
        return [
            'hasUrl' => true,
            'url' => $options->siteUrl . '?target=' . urlencode($url)
        ];
    }
}




// 解析导航字段内容
function parseTabField($content) {
    $siteUrl = Helper::options()->siteUrl;
    $content = trim(htmlspecialchars_decode($content));
    if (empty($content)) return '';

    // 分割头部和内容
    $parts = preg_split('/(\n\s*\n+|\r\n)/', $content, 2, PREG_SPLIT_NO_EMPTY);
    if (count($parts) < 2) return '';
    
    list($headerLine, $body) = $parts;
    
    // 解析一级标题和二级导航
    if (!strpos($headerLine, ':')) return '';
    list($mainTitle, $subNavStr) = explode(':', $headerLine, 2);
    
    // 提取跳转类型参数
    $redirectType = 1; // 默认中转页
    $subNavStr = trim($subNavStr);
    if (preg_match('/\.(\d+)\s*$/', $subNavStr, $matches)) {
        $redirectType = intval($matches[1]);
        $subNavStr = substr($subNavStr, 0, -strlen($matches[0]));
    }
    
    // 处理子导航项
    $subNavs = array_map('trim', explode(',', rtrim(trim($subNavStr), '.')));
    
    $navHtml = '';
    $contentHtml = '';
    $isFirstTab = true;
    
    foreach ($subNavs as $subNav) {
        if (!strpos($subNav, '|')) continue;
        list($subTitle, $subId) = explode('|', $subNav, 2);
        $subId = trim($subId);
        
        // 导航标签
        $navHtml .= sprintf(
            '<div class="sub-tab%s" onclick="switchTab(this, \'%s\')">%s</div>',
            $isFirstTab ? ' active' : '',
            htmlspecialchars($subId),
            htmlspecialchars(trim($subTitle))
        );
        
        // 解析对应内容区块
        $pattern = '/^' . preg_quote($subId) . ':[\r\n]+(.*?)(?=^\w+:|\\Z)/ms';
        preg_match($pattern, $body, $matches);
        $linksHtml = '';
        
        if (!empty($matches[1])) {
            $linkLines = explode("\n", trim($matches[1]));
            foreach ($linkLines as $line) {
                $line = trim($line);
                if (empty($line) || !strpos($line, '|')) continue;
                list($name, $url) = explode('|', $line, 2);
                $url = trim($url);
                
                // 根据跳转类型生成链接
                if ($redirectType === 0) {
                    $finalUrl = htmlspecialchars($url);
                } else {
                    $encodedUrl = urlencode($url);
                    $finalUrl = htmlspecialchars($siteUrl . '?target=' . $encodedUrl);
                }
                
                $linksHtml .= sprintf(
                    '<a href="%s" class="link-item" target="_blank" rel="noopener external nofollow noreferrer">%s</a>',
                    $finalUrl,
                    htmlspecialchars(trim($name))
                );
            }
        }
        
        // 内容区块
        $contentHtml .= sprintf(
            '<div class="content-grid%s" id="%s">%s</div>',
            $isFirstTab ? ' active' : '',
            htmlspecialchars($subId),
            $linksHtml
        );
        
        $isFirstTab = false;
    }
    
    // 最终输出结构
    return <<<HTML
<div class="category-group">
    <div class="category-header">
        <div class="main-category">{$mainTitle}</div>
        <div class="subcategory-tabs">{$navHtml}</div>
    </div>
    <div class="content-container">{$contentHtml}</div>
</div>
HTML;
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




function themeContentFilter($content, $widget)
{
    $request = Typecho_Request::getInstance();
    
    // 处理密码验证
    if ($request->isPost() && $request->get('mm') === 'ok') {
        $content = preg_replace_callback(
            '/{mm id="(.+?)"}(.+?){\/mm}/s',
            function ($match) use ($request) {
                if ($request->get('pass') === $match[1]) {
                    // 验证通过时添加包裹容器
                    return '<div class="xm-mm xm-unlocked">'.$match[2].'</div>';
                }
                return $match[0]; // 保持原始代码用于后续处理
            },
            $content
        );
    }

    // 处理未验证内容
    if (strpos($content, '{mm') !== false) {
        $content = preg_replace(
            '/{mm id="(.+?)"}(.+?){\/mm}/s',
            '<form action="?mm=ok" class="xm-mm" method="post">
                <div class="xm-mm-input">
                    <input type="password" 
                           class="xm-mm-pass" 
                           name="pass" 
                           placeholder="请输入密码"
                           required>
                </div>
                <div class="xm-mm-button">
                    <button type="submit" class="xm-mm-submit">提交</button>
                </div>
            </form>',
            $content
        );
    }

    return $content;
}
// 挂载到主题初始化
function themeInit($archive)
{
    Typecho_Plugin::factory('Widget_Abstract_Contents')->contentEx = 'themeContentFilter';
}
