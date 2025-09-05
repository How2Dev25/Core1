document.addEventListener('DOMContentLoaded', () => {
    const counters = document.querySelectorAll('.count-up');

    counters.forEach(counter => {
        const updateCount = () => {
            const target = +counter.getAttribute('data-target');
            const speed = 200; // lower is faster
            const increment = Math.ceil(target / speed);
            let count = 0;

            const animate = () => {
                if (count < target) {
                    count += increment;
                    counter.innerText = count > target ? target : count;
                    requestAnimationFrame(animate);
                } else {
                    counter.innerText = target;
                }
            };

            animate();
        };

        updateCount();
    });
});