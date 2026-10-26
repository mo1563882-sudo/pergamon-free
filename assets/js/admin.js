document.addEventListener('DOMContentLoaded', function() {
    // 1. Settings Tabs
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

    // 2. Repeater for Floating Menu
    const container = document.getElementById('pergamon-repeater-container');
    if (container) {
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
            
            if (target.classList.contains('pergamon-remove-row')) row.remove();
            else if (target.classList.contains('pergamon-move-up') && row.previousElementSibling) row.parentNode.insertBefore(row, row.previousElementSibling);
            else if (target.classList.contains('pergamon-move-down') && row.nextElementSibling) row.parentNode.insertBefore(row.nextElementSibling, row);
        });
    }
});
