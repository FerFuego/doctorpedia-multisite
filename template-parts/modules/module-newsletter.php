<?php
    $icon = get_sub_field('icon');
    $title = get_sub_field('title');
    $copy = get_sub_field('copy');
?>

<section id="js-newsletterModule">
    <div class="m-newsletter">
        <img class="m-newsletter__icon" src="<?php echo $icon['url']; ?>" alt="Newsletter Icon">
        <h2 class="m-newsletter__title"><?php echo $title ?></h2>
        <p class="m-newsletter__copy"><?php echo $copy ?></p>
        <div class="m-newsletter__input-container">
            <!-- Begin Mailchimp Signup Form-->
            <div id="mc_embed_signup">
                <form action="https://doctorpedia.us20.list-manage.com/subscribe/post?u=f85fcca7f131032b9d3ae6e08&amp;id=bfb910e08a" method="post" class="validate" target="_blank" name="newsletter" novalidate>
                    <input type="email" value="" name="EMAIL" class="m-newsletter__input" size="18" id="mce_EMAIL" placeholder="Email Address" required>
                    <input type="hidden" name="b_f85fcca7f131032b9d3ae6e08_bfb910e08a" tabindex="-1" value="">
                    <button class="m-newsletter__submit" id="mc-embedded-subscribe" type="submit" onclick="ValidateEmail(document.newsletter.EMAIL)">Subscribe <img class="m-newsletter__img" src="<?php echo IMAGES .'/modules/webcast/single-right-arrow-white.svg'; ?>"></button>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    $( document ).ready( function() {
        $('#mce_EMAIL').bind('keypress', function(event) {
            var regex = new RegExp("^[a-zA-Z0-9.-_@]+$");
            var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
            if (!regex.test(key)) {
                event.preventDefault();
                return false;
            }
        });

        /**
         * Disable copy-paste
         */
        window.onload = function() {
            var myInput = document.getElementById('mce_EMAIL');
            myInput.onpaste = function(e) {
                e.preventDefault();
                alert("this action is prohibited");
            }
            
            myInput.oncopy = function(e) {
                e.preventDefault();
                alert("this action is prohibited");
            }
        }
        })

        function ValidateEmail(inputText) {
        var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if(inputText.value.match(mailformat)) {
            $('#mce_EMAIL').focus();
            return true;
        } else {
            alert("You have entered an invalid email address!");
            $('#mce_EMAIL').focus();
            $('#mce_EMAIL').val('');
            event.preventDefault();
            return false;
        }
    }
</script>