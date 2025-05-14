<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php if ($this->options->sliderGroup == 'show'): ?>
    <?php
    $sliderItems = $this->options->sliderItems;
    $sliderHeight = $this->options->sliderHeight ? $this->options->sliderHeight : '300';
    $mobileHeight = intval($sliderHeight * 0.7);
    if ($sliderItems) {
        $items = explode("\n", $sliderItems);
        if (count($items) > 0):
    ?>
    <div class="slider-container">
        <div class="slider-wrapper">
            <div class="slider">
                <?php foreach ($items as $item):
                    $parts = explode('|', trim($item));
                    if (count($parts) >= 3):
                        $image = $parts[0];
                        $title = $parts[1];
                        $url = $parts[2];
                ?>
                <div class="slider-item">
                    <a href="<?php echo $url; ?>" class="block">
                        <div class="img-wrapper">
                            <img src="<?php echo $image; ?>" 
                                 alt="<?php echo $title; ?>" 
                                 class="slider-image"
                                 loading="lazy">
                            <div class="title-wrapper">
                                <h3 class="slider-title">
                                    <?php echo $title; ?>
                                </h3>
                            </div>
                        </div>
                    </a>
                </div>
                <?php endif; 
                endforeach; ?>
            </div>

            <!-- 导航按钮 -->
            <button class="slider-nav prev">←
                
            </button>
            <button class="slider-nav next">→
              
            </button>

            <!-- 指示器 -->
            <div class="slider-indicators">
                <?php foreach ($items as $index => $item): ?>
                <button class="indicator <?php echo $index === 0 ? 'active' : ''; ?>"
                        data-index="<?php echo $index; ?>">
                </button>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <style>
    /* 基础容器样式 */
    .slider-container {
        opacity: 0;
        animation: fadeIn 0.5s ease-out forwards;
        padding-bottom: 10px;
    }

    .slider-wrapper {
        position: relative;
        overflow: hidden;
        border-radius: 1rem;
        box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
    }

    /* 轮播图主体样式 */
    .slider {
        display: flex;
        transition: transform 0.5s;
        width: 100%;
    }

    .slider-item {
        flex: 0 0 100%;
        width: 100%;
    }

    /* 图片容器和图片样式 */
    .img-wrapper {
        position: relative;
        height: <?php echo $sliderHeight; ?>px;
        overflow: hidden;
    }

    .slider-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    /* 标题样式 */
    .title-wrapper {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.6), transparent);
    }

    .slider-title {
        color: white;
        font-weight: 500;
        padding: 0 0.75rem;
        font-size: 0.875rem;
        line-height: 1.25rem;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;    }

    /* 导航按钮样式 */
    .slider-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 3rem;
        height: 3rem;
        border-radius: 9999px;
        background: rgba(240,240,240,0.2);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background-color 0.3s;
border: 1px solid rgba(215, 245, 255, 0.5);
    }

    .slider-nav:hover {
        background: rgba(240,240,240,0.5);
    }

    .slider-nav.prev { left: 0.5rem; }
    .slider-nav.next { right: 0.5rem; }

    /* 指示器样式 */
    .slider-indicators {
        position: absolute;
        bottom: 0.25rem;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 0.375rem;
justify-content: center;
    }

    .indicator {
        width: 0.375rem;
        height: 0.375rem;
        border-radius: 9999px;
        background: rgba(255,255,255,0.5);
        transition: all 0.3s;
    }

    .indicator:hover {
        background: rgba(255,255,255,0.8);
    }

    .indicator.active {
        background: white;
        width: 0.75rem;
    }

    /* 动画效果 */
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    /* 响应式调整 */
    @media (min-width: 640px) {
        .slider-title {
            padding: 0 1rem;
            font-size: 1rem;
        }
        .slider-indicators { bottom: 1rem; }
        .indicator.active { width: 1rem; }
        .slider-container {
            padding-bottom: 10px;
        }
    }

    @media (min-width: 1024px) {
        .slider-container {
            padding-bottom: 10px;
        }
    }

    @media (max-width: 768px) {
        .img-wrapper { 
            height: <?php echo $mobileHeight; ?>px;
        }
    }

    @media (max-width: 480px) {
        .img-wrapper { 
            height: <?php echo intval($mobileHeight * 0.8); ?>px;
        }
    }

    /* 深色模式 */
    .dark .slider-wrapper {
        box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.3);
    }

    /* 悬停效果 */
    .slider-item:hover .slider-image {
        transform: scale(1.05);
    }
    </style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const slider = document.querySelector('.slider');
        const items = document.querySelectorAll('.slider-item');
        const indicators = document.querySelectorAll('.indicator');
        const prevBtn = document.querySelector('.slider-nav.prev');
        const nextBtn = document.querySelector('.slider-nav.next');
        
        let currentIndex = 0;
        let autoplayInterval;
        const itemCount = items.length;
        let startX = 0;
        let isDragging = false;
        let threshold = 50; // 滑动阈值（像素）

        // 新增：处理触摸/鼠标拖动逻辑
        function handleDragStart(e) {
            isDragging = true;
            startX = e.clientX || e.touches[0].clientX;
            slider.style.transition = 'none';
        }

        function handleDragMove(e) {
            if (!isDragging) return;
            
            const currentX = e.clientX || e.touches[0].clientX;
            const diffX = currentX - startX;
            
            // 实时跟随拖动
            slider.style.transform = `translateX(calc(-${currentIndex * 100}% + ${diffX}px))`;
        }

        function handleDragEnd(e) {
            if (!isDragging) return;
            
            isDragging = false;
            slider.style.transition = '';
            
            const endX = e.clientX || e.changedTouches[0].clientX;
            const diffX = endX - startX;
            
            if (Math.abs(diffX) > threshold) {
                if (diffX > 0) {
                    // 向右滑动
                    updateSlider((currentIndex - 1 + itemCount) % itemCount);
                } else {
                    // 向左滑动
                    updateSlider((currentIndex + 1) % itemCount);
                }
                stopAutoplay();
                startAutoplay();
            } else {
                // 未达到阈值时回到原位
                updateSlider(currentIndex);
            }
        }

        // 原有功能
        function updateSlider(index) {
            currentIndex = index;
            slider.style.transform = `translateX(-${currentIndex * 100}%)`;
            
            indicators.forEach((indicator, i) => {
                indicator.classList.toggle('active', i === currentIndex);
            });
        }

        function startAutoplay() {
            autoplayInterval = setInterval(() => {
                updateSlider((currentIndex + 1) % itemCount);
            }, 4000);
        }

        function stopAutoplay() {
            clearInterval(autoplayInterval);
        }

        // 事件监听
        slider.addEventListener('touchstart', handleDragStart);
        slider.addEventListener('touchmove', handleDragMove);
        slider.addEventListener('touchend', handleDragEnd);
        
        // 桌面端鼠标拖动支持
        slider.addEventListener('mousedown', handleDragStart);
        slider.addEventListener('mousemove', handleDragMove);
        slider.addEventListener('mouseup', handleDragEnd);
        slider.addEventListener('mouseleave', handleDragEnd);

        // 原有事件监听
        prevBtn?.addEventListener('click', () => {
            updateSlider((currentIndex - 1 + itemCount) % itemCount);
            stopAutoplay();
            startAutoplay();
        });

        nextBtn?.addEventListener('click', () => {
            updateSlider((currentIndex + 1) % itemCount);
            stopAutoplay();
            startAutoplay();
        });

        indicators.forEach((indicator, index) => {
            indicator.addEventListener('click', () => {
                updateSlider(index);
                stopAutoplay();
                startAutoplay();
            });
        });

        slider.parentElement.addEventListener('mouseenter', stopAutoplay);
        slider.parentElement.addEventListener('mouseleave', startAutoplay);

        startAutoplay();
    });
</script>    <?php 
        endif;
    }
    ?>
<?php endif; ?> 