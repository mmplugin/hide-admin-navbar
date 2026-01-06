<?php

function hide_admin_navbar_load_textdomain() {

    load_plugin_textdomain( 'hide-admin-navbar', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
}

function hide_admin_navbar_main() {

    return false;
}

/**
 * Display persistent migration notice
 */
function han_show_migration_notice() {
    // Only show if new plugin is not active
    if (is_plugin_active('daisy-admin-bar/daisy-admin-bar.php')) {
        return;
    }
    
    // Get install/activate URLs
    $install_url = wp_nonce_url(
        add_query_arg([
            'action' => 'install-plugin',
            'plugin' => 'daisy-admin-bar'
        ], admin_url('update.php')),
        'install-plugin_daisy-admin-bar'
    );
    
    $activate_url = '';
    if (file_exists(WP_PLUGIN_DIR . '/daisy-admin-bar/daisy-admin-bar.php')) {
        $activate_url = wp_nonce_url(
            add_query_arg([
                'action' => 'activate',
                'plugin' => 'daisy-admin-bar/daisy-admin-bar.php'
            ], admin_url('plugins.php')),
            'activate-plugin_daisy-admin-bar/daisy-admin-bar.php'
        );
    }
    ?>
    <div class="notice notice-error">
        <h4><?php esc_html_e('Important Notice About Hide Admin Navbar', 'hide-admin-navbar'); ?></h4>
        <p>
            <?php _e('This plugin is no longer maintained. Please migrate to our new improved plugin <b style="color: blue;">"Daisy Admin Bar"</b> for continued support, new features, and future updates.', 'hide-admin-navbar'); ?>
        </p>
        <p>
            <?php if ($activate_url) : ?>
                <a href="<?php echo esc_url($activate_url); ?>" class="button button-primary">
                    <?php esc_html_e('Activate Daisy Admin Bar Now', 'hide-admin-navbar'); ?>
                </a>
            <?php else : ?>
                <a href="<?php echo esc_url($install_url); ?>" class="button button-primary">
                    <?php esc_html_e('Migrate to Daisy Admin Bar Now', 'hide-admin-navbar'); ?>
                </a>
            <?php endif; ?>
        </p>
    </div>
    <?php
}