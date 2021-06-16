<!-- Admin panel option page -->
<div class="wrap">
    <h2  class="dashicons-before dashicons-arrow-right-alt2"><?php echo EFBREADCRUMB_NAMETITLE; ?>
        <span class="dashicons-before dashicons-arrow-right-alt2">Setting </span><span class="dashicons-before dashicons-arrow-right-alt2">Page </span></h2>
    <?php settings_errors(); ?>
    <form method="POST" action="options.php">
        <?php
        settings_fields( 'efbreadcrumb_og' );
        do_settings_sections( 'efbreadcrumb_og' );
        ?>
        <?php submit_button(); ?>
    </form>
    <h2> Note : Use [EFBreadcrumb] shortcode on your post page to display the breadcumb menu </h2>
</div>
