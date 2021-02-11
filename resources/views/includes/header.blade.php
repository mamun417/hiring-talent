@if (getCurrentRoute() == 'home')
    <div class="header-section" style="
        background-image: url({{ isset($bg_image->image) ? $bg_image->image->url : asset('frontend/img/brown-wooden-texture-flooring-background.png') }});
        background-repeat: no-repeat;
        background-size: 100% 100%;
        ">
        @include('includes.menu')
    </div>

    <!--slider script-->
    @push('script')
        <script>
            var slides = document.querySelectorAll('.slide');
            var btns = document.querySelectorAll('.btn');
            let currentSlide = 1;

            //Javascript for image slider manual navigation
            var manualNav = function (manual) {
                slides.forEach((slide) => {
                    slide.classList.remove('active');

                    btns.forEach((btn) => {
                        btn.classList.remove('active');
                    });
                });

                slides[manual].classList.add('active');
                btns[manual].classList.add('active');
            }

            btns.forEach((btn, i) => {
                btn.addEventListener("click", () => {
                    manualNav(i);
                    currentSlide = i;
                });
            });

            //Javascript for image slider autoplay navigation
            var repeat = function (activeClass) {
                let active = document.getElementsByClassName('active');
                let i = 1;
                var repeater = () => {
                    setTimeout(function () {
                        [...active].forEach((activeSlide) => {
                            activeSlide.classList.remove('active');
                        });

                        slides[i].classList.add('active');
                        btns[i].classList.add('active');
                        i++;

                        if (slides.length == i) {
                            i = 0;
                        }
                        if (i >= slides.length) {
                            return;
                        }
                        repeater();
                    }, 10000);
                }
                repeater();
            }
            repeat();
        </script>
    @endpush
@else
    <div class="w-100 black-page kill-ovr">
        @include('includes.menu')
    </div>
@endif
