<?php if (!defined("__TYPECHO_ROOT_DIR__")) {
    exit();
} ?>

<footer style="margin:50px 0px">

<span id="footer-directive">
<nav>
       <a href="<?php $this->options->siteUrl(); ?>"><?php _e("首页"); ?></a>
       <?php \Widget\Contents\Page\Rows::alloc()->to($pages); ?>
       <?php while ($pages->next()): ?>
           <a<?php if (
               $this->is("page", $pages->slug)
           ): ?> <?php endif; ?> href="<?php $pages->permalink(); ?>" title="<?php $pages->title(); ?>"><?php $pages->title(); ?></a>
       <?php endwhile; ?>
<a href="<?php $this->options->adminUrl(); ?>" target="_blank"><?php _e('登录'); ?></a>
</nav>
<?php $this->options->addfoot(); ?>

</span>

<span>
&copy; <?php echo date('Y'); ?> <a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a>
&nbsp
<?php _e('由 <a href="https://typecho.org">Typecho</a> 强力驱动'); ?>.
</span>

</footer>

<?php if ($this->options->themechange === "on") : ?>
<button id="themeBtn" class="theme-toggle">切换主题</button>
<div class="theme-panel">
  <div class="color-grid"></div>
</div>

<style>
/* 主题切换按钮 */
.theme-toggle {
  position: fixed;
  right: 15px;
  top: 20px;
  padding: 8px 8px;
  border-radius: 25px;
  cursor: pointer;
  z-index: 1000;

  border: 1px solid var(--text-color);}

/* 主题面板 */
.theme-panel {
  position: fixed;  
  height: auto;
  max-height: 50%;
  overflow-y: auto;  
  right: -350px;
  top: 60px;
  width: 280px;
  background: rgba(255,255,255,0.95);
  border-radius: 15px;
  padding: 15px;
  box-shadow: 0 10px 30px rgba(0,0,0,0.1);
  transition: right 0.3s ease;
  z-index: 9999;
}

.theme-panel.show {
  right: 15px;
}

/* 颜色网格 */
.color-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 10px;
}

/* 颜色按钮 */
.color-btn {
  aspect-ratio: 1;
  border-radius: 12px;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 12px;
  transition: transform 0.2s ease;
}

.color-btn:hover {
  transform: scale(1.1);
}
</style>

<script>
// 颜色配置库 (可自由扩展)
const colorPresets = [
{ name: '白天', bg: '#f9fafb', text: '#333' }, 
{ name: '夜晚', bg: '#1f2937', text: '#6b7280' },
{ name: '豆沙绿', bg: '#C7EDCC', text: '#3D5A3D' },
{ name: '棕色', bg: '#e5b97a', text: '#000000' }, 
{ name: '浅棕色', bg: '#e5b97a8a', text: '#000000' },
{ name: '象牙白', bg: '#FFFFF0', text: '#2C2C2C' },
  { name: '杏仁黄', bg: '#FAF0E6', text: '#3A3A3A' },
  { name: '天青蓝', bg: '#F0FFFF', text: '#005C5C' },
  { name: '薄荷绿', bg: '#F5FFFA', text: '#228B22' },
  
  // 深色系
 // { name: '石墨黑', bg: '#1A1A1A', text: '#E6E6E6' },
 // { name: '星空蓝', bg: '#1A2833', text: '#A3C4D9' },
 // { name: '森林绿', bg: '#1A2F1A', text: '#B8E0B8' },
 // { name: '酒红', bg: '#2A0A0A', text: '#D9A3A3' },

{ name: '深海雾蓝', bg: '#D0E4F0', text: '#3A566B' },
{ name: '焦糖米棕', bg: '#E8E0D2', text: '#5D5448' },
{ name: '暮光紫灰', bg: '#DCD0E3', text: '#4E4059' },
{ name: '琥珀暖黄', bg: '#F3E8C8', text: '#65573E' },
{ name: '苔原墨绿', bg: '#CDDED6', text: '#40544D' },
{ name: '拿铁咖啡', bg: '#E5D5C3', text: '#594E42' },
{ name: '薄暮烟粉', bg: '#F5D9E1', text: '#6A4A5D' },
{ name: '冰川深灰', bg: '#D6E2E5', text: '#435862' },
{ name: '榛果暖白', bg: '#F5EADE', text: '#5E5142' },
{ name: '玄武岩灰', bg: '#D0D6D5', text: '#455351' },
{ name: '午夜幽蓝', bg: '#B8D4E5', text: '#2E4557' },
{ name: '深岩棕咖', bg: '#D2C4B0', text: '#4A4136' },
{ name: '暗夜紫檀', bg: '#C5B4CF', text: '#3D3248' },
{ name: '琥珀深褐', bg: '#E3D4AB', text: '#544830' },
{ name: '墨松石绿', bg: '#B5CCC2', text: '#334840' },
{ name: '黑巧克力', bg: '#C7B59E', text: '#473E34' },
{ name: '暮色蔷薇', bg: '#E5C4D0', text: '#5B3C4F' },
{ name: '深渊灰蓝', bg: '#BECCD2', text: '#364751' },
{ name: '焙烤榛果', bg: '#E0D1BC', text: '#4D4234' },
{ name: '玄武岩黑', bg: '#B8C0BE', text: '#374342' },
  // 特殊护眼色
  { name: '淡米色', bg: '#FFF2E0', text: '#5C4033' },
{ name: '浅灰蓝', bg: '#E3EFF9', text: '#2F4F4F' }
];

// 初始化面板
function initThemePanel() {
  const grid = document.querySelector('.color-grid');
  
  colorPresets.forEach(preset => {
    const btn = document.createElement('div');
    btn.className = 'color-btn';
    btn.style.background = preset.bg;
    btn.style.color = preset.text;
    btn.innerHTML = preset.name;
    
    btn.addEventListener('click', () => {
      document.documentElement.style.setProperty('--bg-color', preset.bg);
      document.documentElement.style.setProperty('--text-color', preset.text);
      localStorage.setItem('theme', JSON.stringify(preset));
    });
    
    grid.appendChild(btn);
  });
}

// 切换面板显示
 document.getElementById('themeBtn').addEventListener('click', () => {
  document.querySelector('.theme-panel').classList.toggle('show');
 });



    
// 加载保存的主题
window.addEventListener('DOMContentLoaded', () => {
  initThemePanel();
  const saved = localStorage.getItem('theme');
  if (saved) {
    const theme = JSON.parse(saved);
    document.documentElement.style.setProperty('--bg-color', theme.bg);
    document.documentElement.style.setProperty('--text-color', theme.text);
  }
});

// 点击外部关闭面板
 document.addEventListener('click', (e) => {
   const panel = document.querySelector('.theme-panel');
   if (!panel.contains(e.target) && !e.target.matches('.theme-toggle')) {
     panel.classList.remove('show');
   }
 });

</script>
<?php endif; ?>

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
// 修正后的JS代码
function initTabs() {
     document.querySelectorAll('div[tabs]').forEach(tabsContainer => {
        // 创建内容包裹容器
        const contentWrapper = document.createElement('div');
        contentWrapper.className = 'tab-content-wrapper';
        
        // 创建导航栏
        const nav = document.createElement('div');
        nav.className = 'tabs-nav';
        
        const contents = tabsContainer.querySelectorAll('div[tab-title]');
        
        // 移动内容到包裹容器
        contents.forEach(content => {
            contentWrapper.appendChild(content);
            content.classList.add('tab-content');
        });

        // 创建导航按钮
        contents.forEach((content, index) => {
            const title = content.getAttribute('tab-title');
            const button = document.createElement('button');
            button.className = 'tab-title';
            button.textContent = title;

            button.addEventListener('click', () => {
                // 移除所有激活状态
                nav.querySelectorAll('.tab-title').forEach(t => t.classList.remove('active'));
                contents.forEach(c => c.classList.remove('active'));
                
                // 设置当前激活
                button.classList.add('active');
                content.classList.add('active');
                
                // 自动调整容器高度
                contentWrapper.style.minHeight = content.scrollHeight + 'px';
            });

            nav.appendChild(button);
            
            if(index === 0) {
                button.classList.add('active');
                content.classList.add('active');
                // 初始化容器高度
                contentWrapper.style.minHeight = content.scrollHeight + 'px';
            }
        });

        // 组装结构
        tabsContainer.innerHTML = ''; // 清空原始内容
        tabsContainer.appendChild(nav);
        tabsContainer.appendChild(contentWrapper);
    });
}

// 初始化时机保持不变

document.addEventListener('DOMContentLoaded', initTabs);</script>

<?php endif; ?>

<script>
// 页面加载完成后隐藏加载动画
document.addEventListener("readystatechange", function() {
    const loader = document.getElementById('Loadanimation');
    if (loader) {
        // 停留1秒后开始淡出
        setTimeout(function() {
            loader.style.transition = 'opacity 1s';
            loader.style.opacity = '0';
            // 淡出完成后隐藏
            setTimeout(() => {
                loader.style.display = 'none';
            }, 2600); // 等待淡出动画完成
        }, 200); // 停留0.8秒
    }
});
</script>


</body>

</html>
