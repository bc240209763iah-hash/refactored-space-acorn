document.addEventListener('DOMContentLoaded', function () {
    const saveStatus = document.getElementById('save-status');
    const notesForm = document.querySelector('.notes-form');

    if (notesForm) {
        notesForm.addEventListener('submit', function () {
            if (saveStatus) {
                saveStatus.textContent = 'Saving...';
            }
        });
    }

    const toggleTheme = document.querySelector('[data-theme-toggle]');
    if (toggleTheme) {
        toggleTheme.addEventListener('click', function () {
            document.body.classList.toggle('dark');
        });
    }

    const fontToggle = document.querySelector('[data-font-size]');
    if (fontToggle) {
        fontToggle.addEventListener('click', function () {
            const current = getComputedStyle(document.documentElement).getPropertyValue('--font-scale');
            const next = Number(current) >= 1.1 ? 1 : 1.1;
            document.documentElement.style.setProperty('--font-scale', next);
        });
    }
});
