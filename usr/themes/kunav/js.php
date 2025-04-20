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
<?php endif; ?>
