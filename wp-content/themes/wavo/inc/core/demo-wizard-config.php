<?php
/**
 * Merlin WP configuration file.
 *
 * @package   Merlin WP
 * @version   @@pkg.version
 * @link      https://merlinwp.com/
 * @author    Rich Tabor, from ThemeBeans.com & the team at ProteusThemes.com
 * @copyright Copyright (c) 2018, Merlin WP of Inventionn LLC
 * @license   Licensed GPLv3 for Open Source Use
 */

if ( ! class_exists( 'Merlin' ) ) {
	return;
}

/**
 * Set directory locations, text strings, and settings.
 */
$wizard = new Merlin(

	$config = array(
		'directory'            => 'inc/core/merlin', // Location / directory where Merlin WP is placed in your theme.
		'merlin_url'           => 'merlin', // The wp-admin page slug where Merlin WP loads.
		'parent_slug'          => apply_filters( 'ninetheme_parent_slug', 'themes.php' ), // The wp-admin parent page slug for the admin menu item.
		'capability'           => 'manage_options', // The capability required for this menu to be displayed to the user.
		'child_action_btn_url' => 'https://codex.wordpress.org/child_themes', // URL for the 'child-action-link'.
		'dev_mode'             => true, // Enable development mode for testing.
		'license_step'         => true, // EDD license activation step.
		'license_required'     => true, // Require the license activation step.
        'license_help_url'     => 'https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code', // URL for the 'license-tooltip'.
		'edd_remote_api_url'   => '', // EDD_Theme_Updater_Admin remote_api_url.
		'edd_item_name'        => '', // EDD_Theme_Updater_Admin item_name.
		'edd_theme_slug'       => '', // EDD_Theme_Updater_Admin item_slug.
		'ready_big_button_url' => site_url(), // Link for the big button on the ready step.
	),
	$strings = array(
		'admin-menu'               => esc_html__( 'Theme Setup', 'wavo' ),

		/* translators: 1: Title Tag 2: Theme Name 3: Closing Title Tag */
		'title%s%s%s%s'            => esc_html__( '%1$s%2$s Themes &lsaquo; Theme Setup: %3$s%4$s', 'wavo' ),
		'return-to-dashboard'      => esc_html__( 'Return to the dashboard', 'wavo' ),
		'ignore'                   => esc_html__( 'Disable this wizard', 'wavo' ),

		'btn-skip'                 => esc_html__( 'Skip', 'wavo' ),
		'btn-next'                 => esc_html__( 'Next', 'wavo' ),
		'btn-start'                => esc_html__( 'Start', 'wavo' ),
		'btn-no'                   => esc_html__( 'Cancel', 'wavo' ),
		'btn-plugins-install'      => esc_html__( 'Install', 'wavo' ),
		'btn-child-install'        => esc_html__( 'Install', 'wavo' ),
		'btn-content-install'      => esc_html__( 'Install', 'wavo' ),
		'btn-import'               => esc_html__( 'Import', 'wavo' ),
		'btn-license-activate'     => esc_html__( 'Activate', 'wavo' ),
		'btn-license-skip'         => esc_html__( 'Later', 'wavo' ),

		/* translators: Theme Name */
		'license-header%s'         => esc_html__( 'Activate %s', 'wavo' ),
		/* translators: Theme Name */
		'license-header-success%s' => esc_html__( '%s is Activated', 'wavo' ),
		/* translators: Theme Name */
		'license%s'                => esc_html__( 'Enter your license key to enable remote updates and theme support.', 'wavo' ),
		'license-label'            => esc_html__( 'License key', 'wavo' ),
		'license-success%s'        => esc_html__( 'The theme is already registered, so you can go to the next step!', 'wavo' ),
		'license-json-success%s'   => esc_html__( 'Your theme is activated! Remote updates and theme support are enabled.', 'wavo' ),
		'license-tooltip'          => esc_html__( 'Need help?', 'wavo' ),

		/* translators: Theme Name */
		'welcome-header%s'         => esc_html__( 'Welcome to %s', 'wavo' ),
		'welcome-header-success%s' => esc_html__( 'Hi. Welcome back', 'wavo' ),
		'welcome%s'                => esc_html__( 'This wizard will set up your theme, install plugins, and import content. It is optional & should take only a few minutes.', 'wavo' ),
		'welcome-success%s'        => esc_html__( 'You may have already run this theme setup wizard. If you would like to proceed anyway, click on the "Start" button below.', 'wavo' ),

		'child-header'             => esc_html__( 'Install Child Theme', 'wavo' ),
		'child-header-success'     => esc_html__( 'You\'re good to go!', 'wavo' ),
		'child'                    => esc_html__( 'Let\'s build & activate a child theme so you may easily make theme changes.', 'wavo' ),
		'child-success%s'          => esc_html__( 'Your child theme has already been installed and is now activated, if it wasn\'t already.', 'wavo' ),
		'child-action-link'        => esc_html__( 'Learn about child themes', 'wavo' ),
		'child-json-success%s'     => esc_html__( 'Awesome. Your child theme has already been installed and is now activated.', 'wavo' ),
		'child-json-already%s'     => esc_html__( 'Awesome. Your child theme has been created and is now activated.', 'wavo' ),

		'plugins-header'           => esc_html__( 'Install Plugins', 'wavo' ),
		'plugins-header-success'   => esc_html__( 'You\'re up to speed!', 'wavo' ),
		'plugins'                  => esc_html__( 'Let\'s install some essential WordPress plugins to get your site up to speed.', 'wavo' ),
		'plugins-success%s'        => esc_html__( 'The required WordPress plugins are all installed and up to date. Press "Next" to continue the setup wizard.', 'wavo' ),
		'plugins-action-link'      => esc_html__( 'Advanced', 'wavo' ),

		'import-header'            => esc_html__( 'Import Content', 'wavo' ),
		'import'                   => esc_html__( 'Let\'s import content to your website, to help you get familiar with the theme.', 'wavo' ),
		'import-action-link'       => esc_html__( 'Advanced', 'wavo' ),

		'ready-header'             => esc_html__( 'All done. Have fun!', 'wavo' ),

		/* translators: Theme Author */
		'ready%s'                  => esc_html__( 'Your theme has been all set up. Enjoy your new theme by %s.', 'wavo' ),
		'ready-action-link'        => esc_html__( 'Extras', 'wavo' ),
		'ready-big-button'         => esc_html__( 'View your website', 'wavo' ),
		'ready-link-1'             => sprintf( '<a href="%1$s">%2$s</a>', admin_url( 'customize.php' ), esc_html__( 'Start Customizing', 'wavo' ) ),
	)
);
