const cards = document.querySelectorAll('.emotion-card');
let current = 0;

function updateCarousel() {
    cards.forEach(card => {
        card.classList.remove('active','ecard1','ecard2','ecard3','ecard4','ecard5');
    });
    for (let i = -2; i <= 2; i++) {
        const index = (current + i + cards.length) % cards.length;
        const ecard = i + 3;
        cards[index].classList.add('active', `ecard${ecard}`);
        }
    }

    document.querySelector('.right').onclick = () => {
        current = (current - 1 + cards.length) % cards.length;
        updateCarousel();
    };
    document.querySelector('.left').onclick = () => {
        current = (current + 1) % cards.length;
        updateCarousel();
    };
    
    updateCarousel();
    