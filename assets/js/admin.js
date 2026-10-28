(function () {
	'use strict';
	document.addEventListener('DOMContentLoaded', function () {
		/* Tabs */
		var tabs = document.querySelectorAll('.pergamon-settings-page .nav-tab');
		var contents = document.querySelectorAll('.pergamon-tab-content');
		tabs.forEach(function (tab) {
			tab.addEventListener('click', function (e) {
				e.preventDefault();
				tabs.forEach(function (t) { t.classList.remove('nav-tab-active'); });
				contents.forEach(function (c) { c.classList.remove('active'); });
				tab.classList.add('nav-tab-active');
				var target = document.getElementById(tab.getAttribute('data-target'));
				if (target) { target.classList.add('active'); }
			});
		});

		/* إظهار/إخفاء إعدادات القائمة العائمة */
		var fmToggle = document.querySelector('input[name="pergamon_settings[enable_floating_menu]"]');
		var fmBox = document.getElementById('pergamon-floating-menu-settings');
		if (fmToggle && fmBox) {
			var syncFm = function () { fmBox.classList.toggle('pergamon-hidden', !fmToggle.checked); };
			fmToggle.addEventListener('change', syncFm);
			syncFm();
		}

		/* Repeater */
		var container = document.getElementById('pergamon-repeater-container');
		var template = document.getElementById('pergamon-row-template');
		if (!container || !template) { return; }
		var addBtn = document.getElementById('pergamon-add-row');
		var nextIndex = container.querySelectorAll('.pergamon-repeater-row').length;

		if (addBtn) {
			addBtn.addEventListener('click', function () {
				var html = template.innerHTML.replace(/__index__/g, String(nextIndex));
				nextIndex++;
				var wrap = document.createElement('div');
				wrap.innerHTML = html.trim();
				if (wrap.firstElementChild) { container.appendChild(wrap.firstElementChild); }
			});
		}

		container.addEventListener('click', function (e) {
			var target = e.target;
			var row = target.closest('.pergamon-repeater-row');
			if (!row) { return; }
			if (target.classList.contains('pergamon-remove-row')) {
				row.remove();
			} else if (target.classList.contains('pergamon-move-up') && row.previousElementSibling) {
				container.insertBefore(row, row.previousElementSibling);
			} else if (target.classList.contains('pergamon-move-down') && row.nextElementSibling) {
				container.insertBefore(row.nextElementSibling, row);
			}
		});

		/* إعادة فهرسة الصفوف قبل الحفظ لمنع تكرار أو فقدان عناصر بعد الحذف/النقل */
		var form = container.closest('form');
		if (form) {
			form.addEventListener('submit', function () {
				container.querySelectorAll('.pergamon-repeater-row').forEach(function (row, i) {
					row.querySelectorAll('input').forEach(function (input) {
						input.name = input.name.replace(/\[floating_menu_items\]\[\d+\]/, '[floating_menu_items][' + i + ']');
					});
				});
			});
		}
	});
})();
