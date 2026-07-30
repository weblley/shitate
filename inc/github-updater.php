<?php
/**
 * GitHub-based theme updates (pre-WordPress.org distribution).
 *
 * While shitate is distributed from GitHub, the Update URI header in
 * style.css routes core's update check to the update_themes_github.com
 * filter below, which answers with the repo's latest release. Core compares
 * versions itself: newer releases show the usual update notice under
 * Appearance → Themes, same-or-older ones are recorded as "no update".
 *
 * REMOVE BEFORE SUBMITTING TO WORDPRESS.ORG — the directory forbids themes
 * that phone home or self-update. Removal checklist: this file, its require
 * in functions.php, the Update URI header in style.css, and the "inc" entry
 * in bin/build-zip.sh.
 *
 * @package shitate
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Fetch the latest GitHub release, cached in a site transient.
 *
 * @return array|null Array with version / url / package keys, or null.
 */
function st_github_latest_release() {
	$cached = get_site_transient( 'st_github_release' );
	if ( is_array( $cached ) ) {
		return empty( $cached ) ? null : $cached; // Empty array = cached failure.
	}

	$response = wp_remote_get(
		'https://api.github.com/repos/weblley/shitate/releases/latest',
		array(
			'timeout' => 10,
			'headers' => array( 'Accept' => 'application/vnd.github+json' ),
		)
	);

	$release = null;
	if ( ! is_wp_error( $response ) && 200 === wp_remote_retrieve_response_code( $response ) ) {
		$body = json_decode( wp_remote_retrieve_body( $response ), true );

		$package = '';
		foreach ( (array) ( isset( $body['assets'] ) ? $body['assets'] : array() ) as $asset ) {
			if ( isset( $asset['name'], $asset['browser_download_url'] ) && 'shitate.zip' === $asset['name'] ) {
				$package = $asset['browser_download_url'];
				break;
			}
		}

		if ( ! empty( $body['tag_name'] ) && $package ) {
			$release = array(
				'version' => ltrim( (string) $body['tag_name'], 'vV' ),
				'url'     => isset( $body['html_url'] ) ? (string) $body['html_url'] : 'https://github.com/weblley/shitate/releases',
				'package' => $package,
			);
		}
	}

	// Cache success for 6 hours; cache failures briefly so a flaky network
	// or rate limit does not hammer the API on every admin load.
	set_site_transient( 'st_github_release', $release ? $release : array(), $release ? 6 * HOUR_IN_SECONDS : HOUR_IN_SECONDS );

	return $release;
}

/**
 * Answer core's update check for themes whose Update URI is on github.com.
 *
 * @param array|false $update           Update data so far (false = none).
 * @param array       $theme_data       Theme headers.
 * @param string      $theme_stylesheet Theme directory name being checked.
 * @param array       $locales          Installed locales (unused).
 * @return array|false
 */
function st_github_theme_update( $update, $theme_data, $theme_stylesheet, $locales ) {
	if ( 'shitate' !== $theme_stylesheet ) {
		return $update;
	}

	$release = st_github_latest_release();
	if ( ! $release ) {
		return $update;
	}

	return array(
		'theme'   => $theme_stylesheet,
		'version' => $release['version'],
		'url'     => $release['url'],
		'package' => $release['package'],
	);
}
add_filter( 'update_themes_github.com', 'st_github_theme_update', 10, 4 );
