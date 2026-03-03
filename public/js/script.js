    const showBtn = document.getElementById('showFormBtn');
    const closeBtn = document.getElementById('closeFormBtn');
    const overlay = document.getElementById('overlay');

    showBtn.addEventListener('click', () => {
        overlay.style.display = 'flex';
    });

    closeBtn.addEventListener('click', () => {
        overlay.style.display = 'none';
    });

    overlay.addEventListener('click', (e) => {
        if (e.target === overlay) {
            overlay.style.display = 'none';
        }
    });