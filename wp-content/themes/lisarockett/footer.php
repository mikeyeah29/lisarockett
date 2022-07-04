
<?php if(!is_page('book')) { ?>

    <div class="contact-btn">
        <a href="http://<?php echo home_url(); ?>/book">Book Session</a>
    </div>

<?php } ?>

<footer class="shadow-light">

    <div class="container">

        <p class="m-0 font-brand logo">Lisa Rockett</p>

    </div>

</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

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

    });

</script>

</body>
</html>
