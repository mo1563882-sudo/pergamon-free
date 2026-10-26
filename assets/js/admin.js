document.addEventListener('DOMContentLoaded', function() {
    // Tabs
    const tabs = document.querySelectorAll('.nav-tab');
    const contents = document.querySelectorAll('.pergamon-tab-content');
    
    tabs.forEach(tab => {
        tab.addEventListener('click', function(e) {
            e.preventDefault();
            tabs.forEach(t => t.classList.remove('nav-tab-active'));
            contents.forEach(c => c.classList.remove('active'));
            
            this.classList.add('nav-tab-active');
            const target = document.getElementById(this.dataset.target);
            if (target) target.classList.add('active');
        });
    });

    // Toggle floating menu settings
    const floatingMenuCheckbox = document.getElementById('enable_floating_menu');
    const floatingMenuSettings = document.getElementById('pergamon-floating-menu-settings');
    if (floatingMenuCheckbox && floatingMenuSettings) {
        floatingMenuCheckbox.addEventListener('change', function() {
            floatingMenuSettings.classList.toggle('pergamon-hidden', !this.checked);
        });
        floatingMenuSettings.classList.toggle('pergamon-hidden', !floatingMenuCheckbox.checked);
    }

    // Repeater
    const container = document.getElementById('pergamon-repeater-container');
    if (!container) return;
    
    const addBtn = document.getElementById('pergamon-add-row');
    const template = document.getElementById('pergamon-row-template').innerHTML;
    let rowIndex = container.querySelectorAll('.pergamon-repeater-row').length;

    if (addBtn) {
        addBtn.addEventListener('click', function() {
            const html = template.replace(/__index__/g, rowIndex);
            const tempDiv = document.createElement('div');
            tempDiv.innerHTML = html;
            container.appendChild(tempDiv.firstElementChild);
            rowIndex++;
        });
    }

    container.addEventListener('click', function(e) {
        const target = e.target;
        const row = target.closest('.pergamon-repeater-row');
        if (!row) return;
        
        if (target.classList.contains('pergamon-remove-row')) {
            row.remove();
        } else if (target.classList.contains('pergamon-move-up')) {
            if (row.previousElementSibling) {
                row.parentNode.insertBefore(row, row.previousElementSibling);
            }
        } else if (target.classList.contains('pergamon-move-down')) {
            if (row.nextElementSibling) {
                row.parentNode.insertBefore(row.nextElementSibling, row);
            }
        }
    });
});
