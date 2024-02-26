class Animations {
    staggered() {
        const elements = document.querySelectorAll('.js-staggered');
        elements.forEach(element => {
            element.waypoint = new Waypoint({
                element: element,
                handler: function (direction) {
                    anime({
                        targets: element.querySelectorAll('.js-staggered-item'),
                        translateY: [-220, 0],
                        opacity: [0, 1],
                        easing: 'easeInOutQuad',
                        duration: 500,
                        delay: anime.stagger(300, {
                            start: 500
                        })
                    });
                    this.destroy()
                },
                horizontal: false,
                offset: '90%',
            });
        })

    }
}