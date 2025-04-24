<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>


<script>
function switchTab(clickedTab, targetId) {
    const tabGroup = clickedTab.parentElement;
    const contentContainer = tabGroup.closest('.category-group').querySelector('.content-container');
    
    // 切换标签状态
    Array.from(tabGroup.children).forEach(tab => tab.classList.remove('active'));
    clickedTab.classList.add('active');
    
    // 切换内容区域
    Array.from(contentContainer.children).forEach(content => {
        const isActive = content.id === targetId;
        content.classList.toggle('active', isActive);
        content.style.display = isActive ? 
            (content.classList.contains('article-list') ? 'block' : 'grid') : 
            'none';
    });
}




        // 滚动条检测
        document.querySelectorAll('.subcategory-tabs').forEach(container => {
            const checkScroll = () => {
                container.style.scrollbarColor = 
                    container.scrollWidth > container.clientWidth 
                    ? '#ccc transparent' 
                    : 'transparent transparent';
            }
            container.addEventListener('scroll', checkScroll);
            checkScroll();
        });
    </script>

<script>
        // 新增搜索引擎配置
        const searchEngines = {
            internal: "https://www.yandex.com/search/touch/?text={query}",
            metaso: "https://metaso.cn?q={query}",
nami: "https://www.n.cn/?q={query}",
phind: "https://phind-ai.com/zh/search?q={query}",
baiduai: "https://chat.baidu.com/search?word={query}",
kfind: "https://kfind.kmind.com/search?q={query}",

isou: "https://isou.chat/search?q={query}",            baidu: "https://www.baidu.com/s?wd={query}",
            google: "https://www.google.com/search?q={query}",
            bing: "https://cn.bing.com/search?q={query}",
            360: "https://m.so.com/s?ie=utf-8&fr=none&ssid=&q={query}",

toutiao: "https://so.toutiao.com/search?keyword={query}",
sougou: "https://wap.sogou.com/web/sl?keyword={query}",            yandex: "https://www.yandex.com/search/touch/?text={query}"
        };

        // 切换搜索引擎
        document.querySelectorAll('.engine-tab').forEach(tab => {
            tab.addEventListener('click', function() {
                document.querySelectorAll('.engine-tab').forEach(t => t.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // 执行搜索
        function doSearch() {
            const input = document.querySelector('.search-input');
            const activeEngine = document.querySelector('.engine-tab.active').dataset.engine;
            const query = encodeURIComponent(input.value.trim());
            
            if(query) {
                const url = searchEngines[activeEngine].replace('{query}', query);
                window.open(url, '_blank');
            }
        }

        // 回车搜索
        document.querySelector('.search-input').addEventListener('keypress', e => {
            if(e.key === 'Enter') doSearch();
        });
    </script>
<script>
function toggleNightMode() {
    const body = document.body;
    const isDark = body.getAttribute('data-theme') === 'dark';
    body.setAttribute('data-theme', isDark ? 'light' : 'dark');
    localStorage.setItem('theme', isDark ? 'light' : 'dark');
}

// 初始化
const savedTheme = localStorage.getItem('theme') || 'light';
document.body.setAttribute('data-theme', savedTheme);




</script>



<script>
// 侧边栏开关
function toggleSidebar() {
    document.querySelector('.sidebar').classList.toggle('active');
    document.querySelector('.sidebar-mask').classList.toggle('active');
}

// 子分类切换
function toggleSub(element) {
    const subCategory = element.nextElementSibling;
    subCategory.classList.toggle('active');
    element.classList.toggle('active');
}

// 点击外部关闭
document.querySelector('.sidebar-mask').addEventListener('click', () => {
    toggleSidebar();
});
</script>


<?php if ($this->is('single')) : ?>
<script>
function searchTables() {

      var input, filter, allTables, allRows, i, j;

      input = document.getElementById("searchInput");

      filter = input.value.toUpperCase();



      allTables = document.getElementsByTagName('table');



      var foundCount = 0;



      for (var table of allTables) {

        allRows = table.getElementsByTagName('tr');



        for (i = 1; i < allRows.length; i++) {

          var found = false;

          var cells = allRows[i].getElementsByTagName('td');

          for (j = 0; j < cells.length; j++) {

            if (cells[j]) {

              var txtValue = cells[j].textContent.toUpperCase();

              if (txtValue.indexOf(filter) > -1) {

                found = true;

                foundCount++;

                break;

              }

            }

          }

          if (found || filter === '') {

            allRows[i].style.display = "";

          } else {
            allRows[i].style.display = "none";
          }
        }
      }



      if (filter!== '') {
        if (foundCount > 0) {
          input.style.borderColor = "#4CAF50";
        } else {
          input.style.borderColor = "red";

        }

        var resultInfo = document.getElementById("resultInfo");
        resultInfo.style.display = "block";
        resultInfo.innerHTML = "搜索结果为 <span style='color:#FF0000;'>" + foundCount + "</span> 条";
      } else {
        input.style.borderColor = "#808080";
        var resultInfo = document.getElementById("resultInfo");
        resultInfo.style.display = "none";
      }
    }

    function expandSearchInput() {
      var input = document.getElementById("searchInput");
      input.style.width = "80%";
    }

    function handleClickOutsideSearch() {
      var input = document.getElementById("searchInput");
      if (!input.contains(event.target) && input.value === '') {
        input.style.width = "50%";
        input.style.borderColor = "#808080";

      }
    }

    // 这里统计表格总数

    function countRows() {
      var tables = document.getElementsByTagName('table');
      var totalRows = 0;

      for (var i = 0; i < tables.length; i++) {
        var rows = tables[i].rows;
        for (var j = 1; j < rows.length; j++) {  // 从第二行开始计算
          totalRows++;
        }
      }


      var rowCountElement = document.getElementById('rowCount');

      rowCountElement.innerHTML = totalRows;

      rowCountElement.style.fontSize = '20px';

      rowCountElement.style.color ='#1E90FF';  // 浅红色
 rowCountElement.style.fontWeight = 'bold';

      var rowCountMessage = document.getElementById('rowCountMessage');      rowCountMessage.style.fontWeight = 'bold';
    }
    // 在页面加载完成后执行计数函数
    window.onload = countRows;
</script>
<script>
        let observer;
        let isManualScroll = false;
        let lastClickTime = 0;

        // 初始化目录
        function initToc() {
            const headings = document.querySelectorAll('.article-content h1, .article-content h2, .article-content h3, .article-content h4, .article-content h5, .article-content h6');
            const tocList = document.getElementById('tocList');
            
            // 生成目录项
            headings.forEach((heading, index) => {
                const level = heading.tagName.slice(1);
                const listItem = document.createElement('li');
                
                listItem.className = 'toc-item';
                listItem.dataset.level = level;
                listItem.textContent = heading.textContent;
                heading.id = `heading-${index}`;
                listItem.dataset.target = heading.id;

                // 目录项点击处理
                listItem.addEventListener('click', (e) => {
                    e.stopPropagation();
                    if (Date.now() - lastClickTime < 500) return;
                    lastClickTime = Date.now();
                    
                    isManualScroll = true;
                    smoothScroll(heading, 600);
                    setTimeout(() => toggleToc(false), 500);
                });

                tocList.appendChild(listItem);
            });

            setupObserver();
            initEventListeners();
        }

        // 初始化事件监听
        function initEventListeners() {
            // 触发按钮
            document.querySelector('.toc-trigger').addEventListener('click', () => toggleToc(true));
            
            // 遮罩层点击
            document.querySelector('.toc-mask').addEventListener('click', () => toggleToc(false));
            
            // 全局点击检测
            document.addEventListener('click', (e) => {
                const tocContainer = document.querySelector('.toc-container');
                const tocTrigger = document.querySelector('.toc-trigger');
                
                if (!tocContainer.contains(e.target) && 
                    !tocTrigger.contains(e.target) &&
                    tocContainer.classList.contains('active')) {
                    toggleToc(false);
                }
            });
        }

        // 切换目录状态
        function toggleToc(show) {
            const container = document.querySelector('.toc-container');
            const mask = document.querySelector('.toc-mask');
            
            if (show) {
                container.classList.add('active');
                mask.classList.add('active');
            } else {
                container.classList.remove('active');
                mask.classList.remove('active');
            }
        }

        // 平滑滚动
        function smoothScroll(target, duration) {
            if (!target) return;
            
            const startPos = window.pageYOffset;
            const targetPos = target.getBoundingClientRect().top + startPos - 0;
            const distance = targetPos - startPos;
            let startTime = null;

            function animate(currentTime) {
                if (!startTime) startTime = currentTime;
                const elapsed = currentTime - startTime;
                const progress = Math.min(elapsed / duration, 1);
                
                window.scrollTo(0, startPos + distance * easeOutQuad(progress));
                
                if (elapsed < duration) {
                    requestAnimationFrame(animate);
                } else {
                    isManualScroll = false;
                }
            }

            requestAnimationFrame(animate);
        }

        // 缓动函数
        function easeOutQuad(t) {
            return t * (2 - t);
        }

        // 设置观察器
        function setupObserver() {
            const headings = document.querySelectorAll('h1, h2, h3, h4, h5, h6');
            const tocItems = document.querySelectorAll('.toc-item');
            let activeItem = null;

            observer = new IntersectionObserver(entries => {
                if (isManualScroll) return;

                entries.forEach(entry => {
                    const targetId = entry.target.id;
                    const tocItem = document.querySelector(`[data-target="${targetId}"]`);
                    
                    if (entry.isIntersecting && entry.intersectionRatio >= 0.5) {
                        if (activeItem) activeItem.classList.remove('active');
                        tocItem.classList.add('active');
                        activeItem = tocItem;
                        autoScroll(tocItem);
                    }
                });
            }, {
                rootMargin: '-80px 0px -30% 0px',
                threshold: 0.5
            });

            headings.forEach(heading => observer.observe(heading));
        }

        // 自动滚动目录
        // 优化版目录高亮方案
let activeHeadingId = null;

// 使用节流函数优化性能
const scrollHandler = throttle(() => {
    const headings = Array.from(document.querySelectorAll('h1, h2, h3, h4, h5, h6'));
    const viewportHeight = window.innerHeight;
    let closestHeading = null;
    let minDistance = Infinity;

    // 智能查找最佳匹配标题
    headings.forEach((heading, index) => {
        const rect = heading.getBoundingClientRect();
        const distanceFromTop = rect.top;
        const distanceFromBottom = rect.bottom;
        
        // 当标题顶部进入视口或底部未完全离开视口
        if (distanceFromTop <= viewportHeight * 0 && distanceFromBottom >= viewportHeight * 0) {
            const currentDistance = Math.abs(distanceFromTop);
            if (currentDistance < minDistance) {
                minDistance = currentDistance;
                closestHeading = heading;
            }
        }
    });

    // 更新激活状态
    if (closestHeading && closestHeading.id !== activeHeadingId) {
        activeHeadingId = closestHeading.id;
        updateActiveTocItem(activeHeadingId);
    }
}, 100);

// 更新目录项状态
function updateActiveTocItem(targetId) {
    document.querySelectorAll('.toc-item').forEach(item => {
        item.classList.toggle('active', item.dataset.target === targetId);
    });

    // 自动滚动目录容器
    const activeItem = document.querySelector(`.toc-item[data-target="${targetId}"]`);
    if (activeItem) {
        const container = document.querySelector('.toc-container');
        const itemTop = activeItem.offsetTop;
        const itemHeight = activeItem.offsetHeight;
        const containerHeight = container.clientHeight;
        
        // 保持激活项在可视区域中部
        const targetScrollTop = itemTop - containerHeight/2 + itemHeight/2;
        container.scrollTo({
            top: targetScrollTop,
            behavior: 'smooth'
        });
    }
}

// 节流函数
function throttle(fn, delay) {
    let lastCall = 0;
    return function(...args) {
        const now = Date.now();
        if (now - lastCall >= delay) {
            lastCall = now;
            return fn.apply(this, args);
        }
    }
}

// 初始化事件监听
window.addEventListener('scroll', scrollHandler);
window.addEventListener('resize', scrollHandler);        // 初始化执行
        window.addEventListener('DOMContentLoaded', initToc);
    </script>


<?php endif; ?>

<script>
// 增强版JavaScript
document.addEventListener('DOMContentLoaded', function() {
  const topBtn = document.createElement('button');
  topBtn.className = 'top-btn';
  topBtn.innerHTML = '↑';
  document.body.appendChild(topBtn);

  // 滚动监听
  window.addEventListener('scroll', function() {
    const showHeight = 200;
    topBtn.style.opacity = (window.scrollY > showHeight) ? '1' : '0';
  });

  // 点击事件
  topBtn.addEventListener('click', function() {
    try {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    } catch (e) {
      window.scrollTo(0, 0); // 兼容异常处理
    }
  });
});</script>


<script>
	    let rafId;
	    let lastCall = 0;
	    function throttle(func, limit) {
	        return function() {
	            const now = new Date().getTime();
	            if (now - lastCall < limit) {
	                return;
	            }
	            lastCall = now;
	            return func.apply(this, arguments);
	        };
	    }
	    function updateProgress() {
	        // 计算进度条高度
	        const scrollTop = document.body.scrollTop || document.documentElement.scrollTop;
	        const scrollHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
	        const progress = Math.floor((scrollTop / scrollHeight) * 100); // 使用 Math.floor 取整
	        const progressBar = document.querySelector('.progress');
	        progressBar.style.height = `${progress}%`;
	        // 当网页向下滑动 20px 出现"返回顶部" 按钮
	        if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 20) {
	            document.getElementById("myBtn").classList.add('active');
	        } else {
	            document.getElementById("myBtn").classList.remove('active');
	        }
	        rafId = window.requestAnimationFrame(updateProgress);
	    }
	    function startScrollListener() {
	        updateProgress();
	    }
	    function stopScrollListener() {
	        window.cancelAnimationFrame(rafId);
	    }
	    // 点击按钮，返回顶部
	    function topFunction() {
	        const startY = window.scrollY || document.documentElement.scrollTop || document.body.scrollTop;
	        const startTime = performance.now();
	        const duration = 500; // 滚动持续时间，单位为毫秒，可根据需要调整
	        function scrollToTop(currentTime) {
	            const elapsed = currentTime - startTime;
	            const progress = Math.min(elapsed / duration, 1);
	            const ease = easeInOutCubic(progress); // 使用缓动函数
	            const newY = startY * (1 - ease);
	            document.body.scrollTop = newY;
	            document.documentElement.scrollTop = newY;
	            if (progress < 1) {
	                window.requestAnimationFrame(scrollToTop);
	            } else {
	                stopScrollListener();
	            }
	        }
	        window.requestAnimationFrame(scrollToTop);
	    }
	    // 缓动函数，这里使用的是 easeInOutCubic 函数，可以根据需要替换为其他缓动函数
	    function easeInOutCubic(t) {
	        return t < 0.5? 4 * t * t * t : (t - 1) * (2 * t - 2) * (2 * t - 2) + 1;
	    }
	    // 使用 throttle 函数对 updateProgress 进行节流
	    const throttledUpdateProgress = throttle(updateProgress, 10);
	    // 开始监听滚动事件
	    window.addEventListener('scroll', throttledUpdateProgress);
	    // 监听触摸事件，使在触摸设备上也能正常工作
	    document.addEventListener('touchstart', function (e) {
	        startScrollListener();
	    });
	    document.addEventListener('touchmove', function (e) {
	        throttledUpdateProgress();
	    });
	    document.addEventListener('touchend', function (e) {
	        stopScrollListener();
	    });
</script>
