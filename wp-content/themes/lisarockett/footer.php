
<?php if(!is_page('contact')) { ?>

    <div class="contact-btn contact-btn--floating">
        <a href="<?php echo home_url(); ?>/book">Book Session</a>
    </div>

<?php } ?>

<footer class="shadow-light">

    <div class="container">
        <div class="row align-content-center">
            <div class="col">
                <p class="m-0 font-brand logo">Lisa Rockett</p>
            </div>
            <div class="col d-flex justify-content-end align-items-center">
                <p class="text-end">Lisa Rockett &copy; <?php echo Date('Y'); ?>. All rights reserved.</p>
            </div>
        </div>
    </div>

</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri().'/js/slick.min.js'; ?>"></script>

<script type="text/javascript">

    $('document').ready(function(){

        var burger = $('.burger');
        var menu = $('.menu');

        burger.on('click', function() {
            if(burger.hasClass('is-open')) {
                burger.removeClass('is-open');
                menu.removeClass('is-open');
            }else{
                burger.addClass('is-open');
                menu.addClass('is-open');
            }
        });

        // contact btn

        window.addEventListener('scroll', function() {
            var contactBtn = document.querySelector('.contact-btn--floating');
            var scrollPosition = window.scrollY;

            // Change the value below to adjust the scroll position at which the element appears
            var threshold = 500;

            if (scrollPosition >= threshold) {
                contactBtn.style.opacity = '1';
                contactBtn.style.visibility = 'visible';
            } else {
                contactBtn.style.opacity = '0';
                contactBtn.style.visibility = 'hidden';
            }
        });

        // testimonials

        jQuery('#testimonials').slick({
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: false,
            autoplaySpeed: 4000,
            pauseOnHover: false,
            dots: true,
            arrows: false,
            responsive: [
                {
                  breakpoint: 1024,
                  settings: {
                    slidesToShow: 3
                  }
                },
                {
                  breakpoint: 600,
                  settings: {
                    slidesToShow: 2
                  }
                },
                {
                  breakpoint: 480,
                  settings: {
                    slidesToShow: 1
                  }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
              ]
        });

    });

    /* new nav */
  //   (function($) { "use strict";
  //
  // $(function() {
  //   var header = $(".start-style");
  //   $(window).scroll(function() {
  //     var scroll = $(window).scrollTop();
  //
  //     if (scroll >= 10) {
  //       header.removeClass('start-style').addClass("scroll-on");
  //     } else {
  //       header.removeClass("scroll-on").addClass('start-style');
  //     }
  //   });
  // });
  //
  // //Animation
  //
  // $(document).ready(function() {
  //   $('body.hero-anime').removeClass('hero-anime');
  // });
  //
  // //Menu On Hover
  //
  // $('body').on('mouseenter mouseleave','.nav-item',function(e){
  //     if ($(window).width() > 750) {
  //       var _d=$(e.target).closest('.nav-item');_d.addClass('show');
  //       setTimeout(function(){
  //       _d[_d.is(':hover')?'addClass':'removeClass']('show');
  //       },1);
  //     }
  // });
  //
  // })(jQuery);

</script>

</body>
</html>
