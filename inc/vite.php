<?php
declare(strict_types=1);

if ( ! defined( 'AURIEL_VITE_DIST_DIR' ) ) {
	define( 'AURIEL_VITE_DIST_DIR', 'assets/dist' );
}

if ( ! defined( 'AURIEL_VITE_DIST_URI' ) ) {
	define(
		'AURIEL_VITE_DIST_URI',
		trailingslashit( get_template_directory_uri() ) . AURIEL_VITE_DIST_DIR
	);
}

if ( ! defined( 'AURIEL_VITE_DIST_PATH' ) ) {
	define(
		'AURIEL_VITE_DIST_PATH',
		trailingslashit( get_template_directory() ) . AURIEL_VITE_DIST_DIR
	);
}

if ( ! defined( 'AURIEL_VITE_SERVER' ) ) {
	define( 'AURIEL_VITE_SERVER', 'http://localhost:5173' );
}

if ( ! defined( 'AURIEL_VITE_SCRIPT_HANDLE' ) ) {
	define( 'AURIEL_VITE_SCRIPT_HANDLE', 'auriel-main' );
}

if ( ! defined( 'AURIEL_VITE_STYLE_HANDLE' ) ) {
	define( 'AURIEL_VITE_STYLE_HANDLE', 'auriel-main-style' );
}

if ( ! defined( 'AURIEL_VITE_IS_BUILD' ) ) {
	define(
		'AURIEL_VITE_IS_BUILD',
		file_exists( AURIEL_VITE_DIST_PATH . '/.vite/manifest.json' )
	);
}

/**
 * Register and enqueue the Vite-powered assets.
 */
function auriel_enqueue_vite_assets(): void {
	$js_entries    = array( AURIEL_VITE_SCRIPT_HANDLE => 'main.js' );
	$style_entries = array( AURIEL_VITE_STYLE_HANDLE => 'main.scss' );
	$manifest     = array();

	if ( AURIEL_VITE_IS_BUILD ) {
		$manifest_path = AURIEL_VITE_DIST_PATH . '/.vite/manifest.json';
		$manifest      = json_decode( file_get_contents( $manifest_path ), true );

		if ( ! is_array( $manifest ) ) {
			$manifest = array();
		}
	}

	foreach ( $js_entries as $handle => $file ) {
		$dev_uri = sprintf( '%s/assets/src/js/%s', AURIEL_VITE_SERVER, $file );
		$uri     = $dev_uri;

		if ( AURIEL_VITE_IS_BUILD ) {
			$key = sprintf( 'assets/src/js/%s', $file );
			if ( isset( $manifest[ $key ]['file'] ) ) {
				$uri = AURIEL_VITE_DIST_URI . '/' . $manifest[ $key ]['file'];
			}
		}

		wp_enqueue_script( $handle, $uri, array(), null, true );
	}

	foreach ( $style_entries as $handle => $file ) {
		$dev_uri = sprintf( '%s/assets/src/scss/%s', AURIEL_VITE_SERVER, $file );
		$uri     = $dev_uri;

		if ( AURIEL_VITE_IS_BUILD ) {
			$key = sprintf( 'assets/src/scss/%s', $file );
			if ( isset( $manifest[ $key ]['file'] ) ) {
				$uri = AURIEL_VITE_DIST_URI . '/' . $manifest[ $key ]['file'];
			}
		}

		wp_enqueue_style( $handle, $uri, array(), null );
	}
}
add_action( 'wp_enqueue_scripts', 'auriel_enqueue_vite_assets', 100 );

/**
 * Inject the Vite client while running in development mode.
 */
function auriel_vite_client_script(): void {
	if ( AURIEL_VITE_IS_BUILD ) {
		return;
	}

	printf(
		'<script type="module" crossorigin src="%s/@vite/client"></script>' . PHP_EOL,
		esc_url( AURIEL_VITE_SERVER )
	);
}
add_action( 'wp_head', 'auriel_vite_client_script' );

/**
 * Ensure Vite scripts are treated as ES modules during development.
 */
function auriel_vite_module_tag( string $tag, string $handle, string $src ): string {
	if ( AURIEL_VITE_SCRIPT_HANDLE === $handle && ! AURIEL_VITE_IS_BUILD ) {
		return sprintf(
			'<script type="module" src="%s" crossorigin></script>',
			esc_url( $src )
		);
	}

	return $tag;
}

add_filter( 'script_loader_tag', 'auriel_vite_module_tag', 10, 3 );
