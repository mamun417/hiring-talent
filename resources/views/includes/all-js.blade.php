<a href="#" class="Scrool"><i class="fa fa-angle-up"></i></a>

<script>
    const body = document.querySelector("body");
    const navbar = document.querySelector(".navbar");
    const menuBtn = document.querySelector(".menu-btn");
    const cancelBtn = document.querySelector(".cancel-btn");
    menuBtn.onclick = () => {
        navbar.classList.add("show");
        menuBtn.classList.add("hide");
        body.classList.add("disabled");
    }
    cancelBtn.onclick = () => {
        body.classList.remove("disabled");
        navbar.classList.remove("show");
        menuBtn.classList.remove("hide");
    }

</script>

<script>
    jQuery(document).ready(function () {
        jQuery(".Scrool").click(function () {
            jQuery("html").animate({'scrollTop': '0px'}, 1000)
        });
    });

    jQuery(window).scroll(function () {
        var dtn = jQuery(window).scrollTop();
        if (dtn > 100) {
            jQuery(".Scrool").show();
        } else {
            jQuery(".Scrool").hide();
        }
    })

    jQuery(window).scroll(function () {
        var menuTop = jQuery(".main-menu").outerHeight();
        var jtp = jQuery(window).scrollTop();
        if (jtp >= menuTop) {
            jQuery(".main-menu").addClass("fixed");
        } else {
            jQuery(".main-menu").removeClass("fixed");
        }
    })

    jQuery(document).ready(function () {
        jQuery(".main-menu .bar").click(function () {
            jQuery(".main-menu ul").slideToggle(500);
        });

        jQuery(window).resize(function () {
            var screenSize = jQuery(window).width();
            if (screenSize > 776) {
                jQuery(".main-menu ul").removeAttr("style");
            }
        });

        jQuery("main.menu ul li").click(function () {
            jQuery(this).children("ul").slideToggle(1000);
        })

    })
</script>

<!-- Toastr -->
<script src="{{ asset('backend/js/plugins/toastr/toastr.min.js') }}"></script>

<!--Axios-->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    @foreach(['success', 'warning', 'error', 'info'] as $item)
        @if(session($item))
        toastr['{{ $item }}']('{{ session($item) }}');
    @endif
    @endforeach

    $('#loginModal').on('show.bs.modal', function (e) {
        $("#signUpModal").modal('hide');
    })
    $('#signUpModal').on('show.bs.modal', function (e) {
        $("#loginModal").modal('hide');
    })
    $('#forgotPasswordModal').on('show.bs.modal', function (e) {
        $("#loginModal").modal('hide');
    })
</script>
