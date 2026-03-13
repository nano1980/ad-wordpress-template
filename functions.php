<?php
/**
 * Aragondental theme functions
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// ── Theme support ──────────────────────────────────────────────────────────────
function aragondental_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ] );
}
add_action( 'after_setup_theme', 'aragondental_setup' );

// ── Enqueue assets ─────────────────────────────────────────────────────────────
function aragondental_assets() {
	// Google Fonts
	wp_enqueue_style(
		'aragondental-fonts',
		'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@600;700;800&display=swap',
		[],
		null
	);

	// Main stylesheet
	wp_enqueue_style(
		'aragondental-style',
		get_template_directory_uri() . '/assets/css/custom.css',
		[ 'aragondental-fonts' ],
		wp_get_theme()->get( 'Version' )
	);

	// Main JS (deferred)
	wp_enqueue_script(
		'aragondental-main',
		get_template_directory_uri() . '/assets/js/main.js',
		[],
		wp_get_theme()->get( 'Version' ),
		[ 'strategy' => 'defer', 'in_footer' => true ]
	);
}
add_action( 'wp_enqueue_scripts', 'aragondental_assets' );

// ── Editor styles ──────────────────────────────────────────────────────────────
function aragondental_editor_assets() {
	wp_enqueue_style(
		'aragondental-editor',
		get_template_directory_uri() . '/assets/css/custom.css',
		[],
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'enqueue_block_editor_assets', 'aragondental_editor_assets' );

// ── Pattern category ───────────────────────────────────────────────────────────
function aragondental_pattern_categories() {
	register_block_pattern_category(
		'aragondental',
		[ 'label' => __( 'Aragondental', 'aragondental' ) ]
	);
}
add_action( 'init', 'aragondental_pattern_categories' );


// ── Excerpt length ─────────────────────────────────────────────────────────────
add_filter( 'excerpt_length', fn() => 25 );
