<!-- Channel Contact cta Template Part -->
<?php
    $icon = get_sub_field('m-channels__icon');
    $title = get_sub_field('m-channels__title');
    $copy = get_sub_field('m-channels__copy');
    $cta = get_sub_field('m-channels__cta');
    $email = get_sub_field('m-channels__email_send_to');
?>
<div class="channel-contact-cta">
    <div class="channel-contact-cta__container">
        <img class="channel-contact-cta__icon" src="<?php echo $icon['url']; ?>" alt="Newsletter Icon">
        <h2 class="channel-contact-cta__title"><?php echo $title ?></h2>
        <p class="channel-contact-cta__copy"><?php echo $copy ?></p>
        <button class="channel-contact-cta__cta js-form-contact"><?php echo $cta; ?></button>
    </div>
</div>

<!-- Modal -->
<div class="c-modal wow animate__animated animate__fadeIn animate__delay-02s">
    <div class="c-modal__container">
        <div class="c-modal__content">
            <img class="c-modal__close" src="<?php echo get_template_directory_uri() . '/img/modules/channels/close-modal-icon.svg'; ?>" alt="close">
            <div class="c-modal__header">
                <h3 class="c-modal__title">Suggestion Mailbox</h3>
            </div>
            <div class="c-modal__body">
                <?php echo do_shortcode('[gravityform id="8" title="false" description="false" ajax="true" tabindex="49"]'); ?>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#input_8_4').val("<?php echo $email; ?>");
    })
</script>
<!-- End Channel Contact cta Template Part -->