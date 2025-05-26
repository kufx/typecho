<?php if (!defined("__TYPECHO_ROOT_DIR__")) {
    exit();
} ?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="<?php $this->options->charset(); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5">
    <title><?php
    $this->archiveTitle(
        [
            "category" => _t("分类 %s 下的文章"),
            "search" => _t("包含关键字 %s 的文章"),
            "tag" => _t("标签 %s 下的文章"),
            "author" => _t("%s 发布的文章"),
        ],
        "",
        " - "
    );
    $this->options->title();
    ?></title>
    <link rel="canonical" href="<?php $this->options->siteUrl(); ?>">
    <meta name="title" content="<?php $this->options->title(); ?>">
    <meta name="description" content="<?php echo $this->options->description(); ?>">
    <link rel="alternate" type="application/atom+xml" href="<?php $this->options->siteUrl(); ?>feed/">
    <link rel="shortcut icon" type="image/svg+xml" href="<?php $this->options->logoUrl(); ?>">
    <link rel="stylesheet" href="<?php $this->options->themeUrl(
        "style.css"
    ); ?>">

<?php if ($this->options->commenton === "on" && $this->allow('comment') && $this->is('single')) : ?>
<link rel="stylesheet" href="/usr/themes/final/comments.css">
<?php endif; ?>

<link rel="stylesheet" href="https://npm.elemecdn.com/lxgw-wenkai-webfont@1.1.0/lxgwwenkai-regular.css" media="all">

    <?php if (method_exists($this, "header")): ?>
        <?php $this->header(); ?>
    <?php endif; ?> 

    <?php if ($this->options->addhead): ?> 
        <?php echo $this->options->addhead; ?> 
  <?php endif; ?> 

<!-- <style>
#Loadanimation{
   background-color:var(--bg-color);
   height:100vh; /* 改用视口单位 */
   width:100vw;
   position:fixed;
   z-index:1;
   top:0; 
   left:0; /* 确保全屏覆盖 */
}

#Loadanimation-center{
   width:100%;
   height:100%;
   position:relative;
}

#Loadanimation-center-absolute{
   position:absolute;
   left:50%;
   top:50%;
   transform: translate(-50%, -50%); /* 现代居中方式 */
   width: clamp(150px, 20vw, 200px); /* 动态尺寸 */
   height: clamp(150px, 20vw, 200px); /* 保持宽高比 */
   aspect-ratio: 1/1; /* 新增宽高比锁定 */
}

.xccx_object{
   border-radius:50%;
   position:absolute;
   border-left: clamp(3px, 0.5vw, 5px) solid #87CEFA; /* 动态边框 */
   border-right: clamp(3px, 0.5vw, 5px) solid #FFC0CB;
   border-top: clamp(3px, 0.5vw, 5px) solid transparent;
   border-bottom: clamp(3px, 0.5vw, 5px) solid transparent;
   animation: animate 2.5s infinite;
   left: 50%;  /* 百分比定位 */
   top: 50%;
   transform: translate(-50%, -50%);
}

#xccx_one{
   width: 25%;  /* 百分比尺寸 */
   height: 25%;
}

#xccx_two{
   width: 35%;
   height: 35%;
   animation-delay:0.1s;
}

#xccx_three{
   width: 45%;
   height: 45%;
   animation-delay:0.2s;
}

#xccx_four{
   width: 55%;
   height: 55%;
   animation-delay:0.3s;
}

@keyframes animate{
   50%{ transform: rotate(180deg); }
   100%{ transform: rotate(0deg); }
}}</style>  -->  

</head>
<header>  
</header>
<body class="home">

<!-- <div id="Loadanimation" style="z-index:999999;">
<div id="Loadanimation-center">
   <div id="Loadanimation-center-absolute">
       <div class="xccx_object" id="xccx_four"></div>
       <div class="xccx_object" id="xccx_three"></div>
       <div class="xccx_object" id="xccx_two"></div>
       <div class="xccx_object" id="xccx_one"></div>
   </div>
</div>
</div> -->


    
<div class="headerxgk">
  <div class="avatar content">
        <img src="<?php if ($this->options->logoUrl): ?>
        <?php echo $this->options->logoUrl; ?>
    <?php endif; ?>" alt="Avatar">
    </div>
    <div class="content">
        <div class="username"><a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a></div>
        <div class="level"><?php echo $this->options->description(); ?></div>
    </div>
<!--    <div class="button-container">
        <button class="buttonxgk" id="toggleTheme">护眼</button>
          </div> -->
</div>


<?php if ($this->options->gg === "on") : ?>    
<?php $this->need("announcement.php"); ?>
        <?php endif; ?>
