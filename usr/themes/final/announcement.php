<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

$announcementStyle = $this->options->announcementStyle ? $this->options->announcementStyle : 'style1';
$announcementText = $this->options->announcementText;
$announcementDuration = $this->options->announcementDuration ? $this->options->announcementDuration : '5';
$announcementFrequency = $this->options->announcementFrequency ? $this->options->announcementFrequency : 'always';


if ($announcementText && $announcementFrequency !== 'never'): ?>
<div class="announcement-container <?php echo $announcementStyle; ?>" id="announcement">
    <div class="announcement-content">
        <?php echo $announcementText; ?>
    </div>
    <button class="announcement-close" onclick="closeAnnouncement()">×</button>
</div>

<style>
/* 基础样式 */
.announcement-container {
    position: fixed;
    top: 20px;
    right: -400px;
    width: auto;
height: auto;
    padding: 16px 20px;
    border-radius: 12px;
    background: var(--bg-color);
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
    z-index: 9999;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    border: 1px solid var(--text-color);
    transform: translateY(100px);
    opacity: 0;
box-sizing: border-box;
}

.announcement-container.show {
    right: 18px;
    transform: translateY(0);
    opacity: 1;
}

.announcement-content {
   // margin: 0 0;
    line-height: 1.6;
    color: #333;
    font-size: 14px;
width: auto;
}


.announcement-content img {
width: 100%;

border-radius: 4px;}


.announcement-close {
    position: absolute;
    top: 12px;
    right: 12px;
    width: 24px;
    height: 24px;
    background: none;
    border: none;
    font-size: 18px;
    cursor: pointer;
    color: #999;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: all 0.3s ease;
}

.announcement-close:hover {
    background: rgba(0, 0, 0, 0.05);
    color: #666;
}

/* 样式1：主题色 */
.style1 {
  //  border-left: 3px solid #070707;
}

.style1 .announcement-content {
    color: var(--text-color);
}

/* 样式2：温暖橙 */
.style2 {
  //  border-left: 3px solid #feae51;
}

.style2 .announcement-content {
    color: #d48c3c;
}

/* 样式3：清新绿 */
.style3 {
 //   border-left: 3px solid #4caf50;
}

.style3 .announcement-content {
    color: #3d8b40;
}

/* 样式4：典雅紫 */
.style4 {
  //  border-left: 3px solid #7e57c2;
}

.style4 .announcement-content {
    color: #5e35b1;
}

/* 深色模式适配 */
.dark .announcement-container {
    background: #1f1f1f;
    border-color: rgba(255, 255, 255, 0.1);
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2);
}

.dark .announcement-content {
    color: #e0e0e0;
}

.dark .announcement-close {
    color: #666;
}

.dark .announcement-close:hover {
    background: rgba(255, 255, 255, 0.1);
    color: #999;
}

.dark .style1 .announcement-content {
    color: #64b5f6;
}

.dark .style2 .announcement-content {
    color: #ffb74d;
}

.dark .style3 .announcement-content {
    color: #81c784;
}

.dark .style4 .announcement-content {
    color: #b39ddb;
}

/* 响应式适配 */
@media (max-width: 768px) {
    .announcement-container {
        width: 65%;
height: auto;
        right: -100%;
        top: 20px;
        padding: 8px 16px;
        margin: 0 15px;
box-sizing: border-box;
    }
    
    .announcement-container.show {
        right: 0;
    }
    
    .announcement-content {
        font-size: 13px;
        margin-right: 20px;
    }
    
    .announcement-close {
        top: 10px;
        right: 10px;
        width: 20px;
        height: 20px;
        font-size: 16px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const frequency = '<?php echo $announcementFrequency; ?>';
    const shouldShow = frequency === 'always' || 
                      (frequency === 'once' && !localStorage.getItem('announcementShown'));
    
    if (shouldShow) {
        setTimeout(function() {
            const announcement = document.getElementById('announcement');
            announcement.style.transform = 'translateY(50px)';
            announcement.style.opacity = '0';
            announcement.classList.add('show');
            
            // 添加一个小延迟来触发动画
            requestAnimationFrame(() => {
                announcement.style.transform = 'translateY(0)';
                announcement.style.opacity = '1';
            });

            // 设置自动关闭时间
            setTimeout(function() {
                closeAnnouncement();
            }, <?php echo $announcementDuration; ?> * 1000);
        }, 1000);
    }
});

function closeAnnouncement() {
    const announcement = document.getElementById('announcement');
    announcement.style.transform = 'translateY(50px)';
    announcement.style.opacity = '0';
    
    // 等待动画完成后移除show类
    setTimeout(() => {
        announcement.classList.remove('show');
    }, 400);

    // 如果是"24小时只显示一次"模式，才记录显示状态
    if ('<?php echo $announcementFrequency; ?>' === 'once') {
        localStorage.setItem('announcementShown', 'true');
        // 24小时后重置
        setTimeout(function() {
            localStorage.removeItem('announcementShown');
        }, 24 * 60 * 60 * 1000);
    }
}
</script>
<?php endif; ?> 