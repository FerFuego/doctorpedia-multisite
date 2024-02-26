jQuery(document).ready(function () {
    /**
     * Video Gallery
     */
    class VideoGalleryHero {
        constructor() {
            try{
                this.videoGallery = document.querySelector('.js-search-video-gallery');
                this.videos = document.querySelectorAll('.js-video-slide');
                this.videoModal = document.querySelector('.js-video-modal');
                this.loader = this.videoModal.querySelector('.js-loader');
                this.videoModalContainer = this.videoModal.querySelector('.js-container');
                this.videoModalInfoContainer = this.videoModal.querySelector('.video-info');
                this.currentSlide = 0;
                this.modalBtns = {
                    prev: this.videoModal.querySelector('.js-prev-video'),
                    next: this.videoModal.querySelector('.js-next-video')
                };
                this.videoSlider();
                this.videoFunctons();
                this.modalActions();
            }catch{}
        }

        videoSlider() {
            this.videosEnterAnimation();

            $(this.videoGallery).slick({
                cssEase: 'linear',
                slidesToShow: 5,
                slidesToScroll: 1,
                centerMode: true,
                pauseOnFocus: false,
                pauseOnHover: false,
                speed: 7000,
                autoplay: true,
                autoplaySpeed: 0,
                arrows: false,
                responsive: [{
                        breakpoint: 1980,
                        settings: {
                            slidesToShow: 7.8
                        }
                    },
                    {
                        breakpoint: 1441,
                        settings: {
                            slidesToShow: 5
                        }
                    },
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 4
                        }
                    },
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 2,
                            centerMode: true,
                            centerPadding: '40px',
                            variableWidth: true
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            speed: 300,
                            autoplay: false,
                            autoplaySpeed: 0,
                            slidesToShow: 1,
                            centerMode: true,
                            centerPadding: '40px',
                            variableWidth: true,
                            speed: 300
                        }
                    }
                ]

            });

            //this.videosSliderController();
        }

        videosEnterAnimation() {
            $(this.videoGallery).on('init', function () {
                const animation = new Animations();
                animation.staggered();
            });
        }

        videosSliderController() {
            if (window.innerWidth > 600) {
                const self = this;
                const sliderWidth = this.videoGallery.clientWidth;
                const tolerance = 200;
                this.videoGallery.onmousemove = function (e) {
                    const coordinates = self.getRelativeCoordinates(e, self.videoGallery);
                    if (coordinates.x >= 0 && coordinates.x <= tolerance) {
                        //Prev Slide
                        $(self.videoGallery).slick('slickPrev');
                    }

                    if (coordinates.x <= sliderWidth && coordinates.x >= sliderWidth - tolerance) {
                        //Next Slide
                        $(self.videoGallery).slick('slickNext');
                    }
                }
            }
        }

        getRelativeCoordinates(event, referenceElement) {

            const position = {
                x: event.pageX,
                y: event.pageY
            };

            const offset = {
                left: referenceElement.offsetLeft,
                top: referenceElement.offsetTop
            };

            let reference = referenceElement.offsetParent;

            while (reference) {
                offset.left += reference.offsetLeft;
                offset.top += reference.offsetTop;
                reference = reference.offsetParent;
            }

            return {
                x: position.x - offset.left,
                y: position.y - offset.top,
            };

        }

        videoFunctons() {
            const self = this;
            this.videos.forEach(video => {
                const videoUrl = video.getAttribute('url');
                const videoInfo = video.querySelector('.video-info')

                video.addEventListener('click', () => {
                    self.currentSlide = parseInt(video.getAttribute('slide'));
                    self.fillModal(videoInfo, videoUrl);
                    this.openCloseModal();
                })
            })
        }

        videoApiLoader(sectionToPrint, videoUrl) {
            try {
                sectionToPrint.querySelector('.vimeo-iframe-load').remove();
            } catch {}

            const videoIframe = document.createElement('div');
            videoIframe.classList.add('vimeo-iframe-load');
            videoIframe.classList.add('video-info__iframe');

            const options = {
                id: videoUrl,
                loop: false,
                responsive: true
            };
            const player = new Vimeo.Player(videoIframe, options);
            player.play();

            this.resizeModalWithVideoResolution(player);

            sectionToPrint.appendChild(videoIframe);
        }

        fillModal(videoInfo, videoUrl) {
            this.videoModalInfoContainer.innerHTML = videoInfo.innerHTML;
            this.videoApiLoader(this.videoModalInfoContainer, videoUrl);
        }

        resizeModalWithVideoResolution(player) {
            const self = this;
            player.on('loaded', function () {
                player.getVideoHeight().then(function (height) {
                    player.getVideoWidth().then(function (width) {
                        if (height > width) {
                            self.videoModalInfoContainer.style.width = '300px';
                            self.videoModalContainer.style.width = '';
                        } else {
                            self.videoModalInfoContainer.style.width = '';
                            self.videoModalContainer.style.width = '100%'
                        }
                        self.loaderOnOff(false)
                    })
                });
            });
        }

        openCloseModal() {
            this.videoModal.classList.toggle('open');
            this.loaderOnOff(true)

            if (!this.videoModal.classList.contains('open')) {
                this.videoModal.querySelector('.vimeo-iframe-load').remove();
            }
        }

        modalActions() {
            const self = this;

            //Prev Video
            this.modalBtns.prev.addEventListener('click', () => {
                const prevVideo = [...self.videos].filter(video => parseInt(video.getAttribute('slide')) == self.currentSlide - 1);

                if (prevVideo.length > 0) {
                    self.currentSlide--;
                    const videoUrl = prevVideo[0].getAttribute('url');
                    const videoInfo = prevVideo[0].querySelector('.video-info')
                    self.fillModal(videoInfo, videoUrl);
                    self.loaderOnOff(true)
                }
            });

            //Next Video
            this.modalBtns.next.addEventListener('click', () => {
                const nextVideo = [...self.videos].filter(video => parseInt(video.getAttribute('slide')) == self.currentSlide + 1);

                if (nextVideo.length > 0) {
                    self.currentSlide++;
                    const videoUrl = nextVideo[0].getAttribute('url');
                    const videoInfo = nextVideo[0].querySelector('.video-info')
                    self.fillModal(videoInfo, videoUrl);
                    self.loaderOnOff(true)
                }
            });

            //Close Video
            this.videoModal.addEventListener('click', ({
                target
            }) => {

                if (target.classList.contains('js-video-modal') || target.classList.contains('js-close-modal')) {
                    self.openCloseModal();
                }
            });
        }

        loaderOnOff(loader = true) {
            if (loader) {
                this.videoModalContainer.classList.remove('loaded');
                this.loader.classList.remove('hide');
            } else {
                this.videoModalContainer.classList.add('loaded');
                this.loader.classList.add('hide');
            }
        }
    }

    new VideoGalleryHero();

    /**
     * Search new functions
     */
    class SearchHero {
        constructor() {
            try{
                this.searchModal = document.querySelector('#js-discover-search-resources');
                this.closeSearch = document.querySelector('.js-close-dropdown');
                this.gallery = document.querySelector('.js-search-video-gallery');
                this.buttonSearch = document.querySelector('#js-discover-health');
                this.inputSearch = document.querySelector('#js-search-condition');
                this.allowedCPT = document.querySelector('#js-sr-form-discover-health').getAttribute('post-types');
                this.resultsFoundMessage = document.querySelector('#js-var-to-search');
                this.loadMoreButtons = document.querySelectorAll('.js-load-more-posts');
                this.searchValue = '';
                this.closeOpenSearch();
                this.inputActions();
                this.loadMoreResults();
            }catch{}
        }

        closeOpenSearch() {
            const self = this;
            this.closeSearch.addEventListener('click', () => {
                self.searchModal.classList.toggle('d-none');
                if (window.innerWidth > 767) {
                    self.gallery.classList.toggle('hide');
                }
            })
        }

        inputActions() {
            const self = this;

            //Button submit
            this.buttonSearch.addEventListener('click', ({
                target
            }) => {
                if (self.inputSearch.value == '') {
                    self.inputSearch.classList.add('invalid');
                    return;
                } else {
                    self.inputSearch.classList.remove('invalid');
                }

                self.searchBehaviorsToggler(true);
                self.searchPosts();
            });

            //Input Events
            this.inputSearch.addEventListener('keydown', (e) => {
                self.searchValue = e.target.value;

                if (self.inputSearch.value == '') {
                    self.inputSearch.classList.add('invalid');
                    return;
                } else {
                    self.inputSearch.classList.remove('invalid');
                }

                if (e.key == 'Enter' && e.key != '') {

                    self.searchPosts();
                    self.searchBehaviorsToggler(true);
                }
            })

            this.inputSearch.addEventListener('keyup', () => {
                if (self.inputSearch.value == '') {
                    self.inputSearch.classList.add('invalid');
                    return;
                } else {
                    self.inputSearch.classList.remove('invalid');
                }
            })
        }

        searchBehaviorsToggler(search = false) {
            if (search) {
                this.buttonSearch.classList.add('loading', 'hiddenBtn');
                this.buttonSearch.classList.remove('done');
                this.gallery.classList.remove('hide');
                this.searchModal.classList.add('d-none');
            } else {
                this.buttonSearch.classList.remove('loading', 'hiddenBtn');
                this.buttonSearch.classList.add('done');
                this.gallery.classList.add('hide');
                this.searchModal.classList.remove('d-none');
            }
        }

        searchPosts() {
            const self = this;
            this.resetHTMLContainers();
            this.searchValue = this.inputSearch.value;
            $.ajax({
                url: window.location.origin + '/wp-json/doctorpedia/v2/search',
                data: {
                    s: this.searchValue.replace(/\s+/g, ' ').trim(),
                    postTypes: this.allowedCPT
                }
            }).done(function (data) {
                self.searchBehaviorsToggler();
                self.printPostsOnHTML(data.results)
                self.totalPostFound(data)
            });
        }

        totalPostFound(data) {
            this.resultsFoundMessage.innerHTML = data.total_results_message;

            if (data.total_results == 0) {
                this.searchModal.classList.add('no-results')
            } else {
                this.searchModal.classList.remove('no-results')
            }
        }

        printPostsOnHTML(data) {

            data.forEach((cptData) => {
                let domPosition = '';
                switch (cptData.posttype) {
                    case 'post':
                        domPosition = 'articles';
                        break;
                    case 'categories':
                        domPosition = 'channels';
                        break;
                    case 'videos':
                        domPosition = 'videos';
                        break;
                }

                if (cptData.postsdata.postsfound != 0) {

                    const wrapper = document.querySelector(`#js-${domPosition}`).parentNode
                    wrapper.classList.remove('d-none');
                    const loadMoreButton = wrapper.querySelector('.js-load-more-posts');
                    loadMoreButton.setAttribute('page', '1');
                    loadMoreButton.setAttribute('total_pages', cptData.postsdata.pages);

                    if (cptData.postsdata.pages == 1) {
                        loadMoreButton.classList.add('disabled')
                    } else {
                        loadMoreButton.classList.remove('disabled')
                    }
                    document.querySelector(`#js-count-${domPosition}`).innerHTML = cptData.postsdata.postsfound;
                    document.querySelector(`#js-${domPosition}`).innerHTML = cptData.postsdata.html;

                }

            })

        }

        resetHTMLContainers() {
            const allContainers = document.querySelectorAll('.m-search__results-posts');
            allContainers.forEach(container => {
                container.innerHTML = '';
                const parent = container.parentNode;
                parent.classList.add('d-none');
                parent.querySelector('h4 > span').innerHTML = '';
                this.searchModal.classList.add('d-none');
            })
        }

        loadMoreResults() {
            const self = this;
            this.loadMoreButtons.forEach(button => {
                button.addEventListener('click', ({
                    target
                }) => {
                    const page = parseInt(target.getAttribute('page'));
                    const totalPages = parseInt(target.getAttribute('total_pages'));
                    const postType = target.getAttribute('post_type');

                    if (page < totalPages) {
                        self.pagedSearchPostType(postType, page + 1, target.parentNode.querySelector('.m-search__results-posts'));
                        target.setAttribute('page', page + 1)

                        if (page + 1 == totalPages) {
                            target.classList.add('disabled');
                        }
                    } else {
                        target.classList.add('disabled');
                    }
                });
            })
        }

        pagedSearchPostType(postType, page, container) {
            $.ajax({
                url: window.location.origin + '/wp-json/doctorpedia/v2/search',
                data: {
                    s: this.searchValue.replace(/\s+/g, ' ').trim(),
                    postTypes: postType,
                    page: page
                }
            }).done(function (data) {
                container.innerHTML = container.innerHTML + data.results[0].postsdata.html;
            });
        }

    }

    new SearchHero();

});