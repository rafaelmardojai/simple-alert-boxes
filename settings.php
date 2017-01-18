<?php
/**
 * Simple Alert Boxes Plugin Settings
 *
 * @package  simple-alert-boxes
 */

/**
 * Settings register
 *
 * @since 1.4.0
 */
function sab_settings_init() {
    register_setting( 'sab', 'sab_options' );

    add_settings_section(
        'sab_section_style',
        __( 'Styles', 'sab' ),
        'sab_section_styles_cb',
        'sab'
    );

    add_settings_field(
        'sab_field_theme',
        __( 'Theme', 'sab' ),
        'sab_field_theme_cb',
        'sab',
        'sab_section_style',
        [
            'label_for'       => 'sab_field_theme',
            'class'           => 'sab_row',
            'sab_custom_data' => 'custom',
        ]
    );

    add_settings_field(
        'sab_field_icons',
        __( 'Icons', 'sab' ),
        'sab_field_icons_cb',
        'sab',
        'sab_section_style',
        [
            'label_for'       => 'sab_field_icons',
            'class'           => 'sab_row',
            'sab_custom_data' => 'custom',
        ]
    );
}
add_action( 'admin_init', 'sab_settings_init' );

function sab_section_styles_cb( $args ) {
    ?>
    <p id="<?= esc_attr( $args['id'] ); ?>"><?= esc_html__( 'Style options for the alert boxes.', 'sab' ); ?></p>
    <?php
}

function sab_field_theme_cb( $args ) {
    $options = get_option( 'sab_options' );

    ?>
    <select id="<?= esc_attr($args['label_for']); ?>"
            data-custom="<?= esc_attr($args['sab_custom_data']); ?>"
            name="sab_options[<?= esc_attr($args['label_for']); ?>]"
    >
        <option value="default" <?= isset($options[$args['label_for']]) ? (selected($options[$args['label_for']], 'default', false)) : (''); ?>>
            <?= esc_html( 'Default', 'sab' ); ?>
        </option>
        <option value="wordpress" <?= isset($options[$args['label_for']]) ? (selected($options[$args['label_for']], 'wordpress', false)) : (''); ?>>
            <?= esc_html( 'Wordpress', 'sab' ); ?>
        </option>
    </select>
    <p class="description"><?= esc_html( 'Select the theme you want to use.', 'sab' ); ?></p>

    <?php
}

function sab_field_icons_cb( $args ) {
    $options = get_option( 'sab_options' );

    ?>
    <select id="<?= esc_attr($args['label_for']); ?>"
            data-custom="<?= esc_attr($args['sab_custom_data']); ?>"
            name="sab_options[<?= esc_attr($args['label_for']); ?>]"
    >
        <option value="dashicons" <?= isset($options[$args['label_for']]) ? (selected($options[$args['label_for']], 'dashicons', false)) : (''); ?>>
            <?= esc_html( 'Dashicons', 'sab' ); ?>
        </option>
        <option value="fontawesome" <?= isset($options[$args['label_for']]) ? (selected($options[$args['label_for']], 'fontawesome', false)) : (''); ?>>
            <?= esc_html( 'FontAwesome', 'sab' ); ?>
        </option>
    </select>
    <p class="description"><?= esc_html( 'Select the icon theme you want to use.', 'sab' ); ?></p>

    <?php
}

/**
 * Options page menu
 *
 * @since 1.4.0
 */
function sab_options_page_create() {
    add_submenu_page(
		'options-general.php',
		'Simple Alert Boxes',
		'Simple Alert Boxes',
		'manage_options',
		'sab',
		'sab_options_page_display'
	);
}
add_action( 'admin_menu', 'sab_options_page_create' );

/**
 * Options page display
 *
 * @since 1.4.0
 */
function sab_options_page_display() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    if ( isset( $_GET['settings-updated'] ) ) {
        add_settings_error( 'sab_messages', 'sab_message', __( 'Settings Saved', 'sab' ), 'updated' );
    }

    ?>
    <div class="wrap">
        <h1><?= esc_html( get_admin_page_title() ); ?></h1>
        <form action="options.php" method="post">
            <?php
            settings_fields( 'sab' );

            do_settings_sections( 'sab' );

            submit_button( 'Save Settings' );
            ?>
        </form>
    </div>
    <?php
}
