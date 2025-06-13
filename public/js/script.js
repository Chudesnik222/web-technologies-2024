if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init)
} else {
    init()
}

function init() {
    const parents = document.querySelectorAll('[data-parent]');

    parents.forEach(parent => {
        const open = parent.querySelector('[data-open]');

        open.addEventListener('click', () => {
            parent.classList.toggle('list-item_open');
        });
    });
}