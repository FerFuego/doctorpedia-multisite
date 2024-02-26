jQuery(document).ready(function () {

    class Explore {
        constructor(module) {
            this.slider = module.querySelector('.js-explore-slider');
            this.searchWrapper = module.querySelector('.js-search-wrapper');
            this.searchInput = module.querySelector('.js-explore-search');
            this.searchValue = '';
            this.dropdownBtn = module.querySelector('.js-explore-open-close-dropdown');
            this.results = module.querySelector('.js-explore-results');
            this.sliderRun();
            //this.search();  // Not implemented
            this.dropdown();
        }

        sliderRun() {
            $(this.slider).slick({
                infinite: true,
                slidesToShow: 3,
                slidesToScroll: 3,
                responsive: [{
                        breakpoint: 850,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    },
                    {
                        breakpoint: 620,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            centerMode: true,
                            centerPadding: '40px'
                        }
                    }
                ]
            });
        }

        search() {
            new Debounce({
                input: this.searchInput,
                time: 300,
                doneFunction: (value) => {
                    this.searchValue = value;
                    this.ajaxCall();
                }
            })
        }

        ajaxCall() {
            const self = this;

            $.ajax({
                method: "GET",
                url: location.origin + '/wp-json/doctorpedia/v2/channels-taxonomy',
                data: {
                    'search': self.searchValue
                },
                success: function (response) {
                    self.results.innerHTML = response.data;

                    if (self.searchValue != '') {
                        self.searchWrapper.classList.add('open');
                    } else {
                        self.searchWrapper.classList.remove('open');
                    }
                },
                error: function (error) {
                    console.log(error)
                }
            });

        }

        dropdown() {
            const self = this;
            this.searchInput.addEventListener('click', function () {
                self.searchWrapper.classList.toggle('open');
            })
            this.dropdownBtn.addEventListener('click', () => {
                self.searchWrapper.classList.toggle('open');
            });
        }
    }

    const exploreModules = document.querySelectorAll('.js-explore-module');

    exploreModules.forEach(module =>{
        new Explore(module);
    });


});