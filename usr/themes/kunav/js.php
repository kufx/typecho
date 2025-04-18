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


