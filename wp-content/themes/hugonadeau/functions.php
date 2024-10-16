<?php
/**
 * user: hugon
 * date: 2024-01-23
 * Time: 16:18
 */
/**
 * Charge les scripts et feuilles de style propres au thème.
 * @author Christiane Lagacé <christiane.lagace@hotmail.com>
 *
 * Utilisation : add_action('wp_enqueue_scripts', 'hugonadeau_charger_css_js_web');
 */
require_once('tableau-de-bord-menus.php');
require_once('tableau-de-bord-tables.php');
require_once('tableau-de-bord-pages.php');
require_once('tableau-de-bord-messages.php');
//require_once('shortcodes.php');
function hugonadeau_charger_css_js_web() {
	wp_enqueue_style( 'css-theme-enfant', get_stylesheet_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'hugonadeau_charger_css_js_web' );

/**
 * Fonction de rappel du hook after_setup_theme, exécutée après que le thème ait été initialisé.
 * @author Christiane Lagacé <christiane.lagace@hotmail.com>
 *
 * Utilisation : add_action( 'after_setup_theme', 'hugonadeau_apres_initialisation_theme' );
 */
function hugonadeau_apres_initialisation_theme() {
	// Retirer la balise <meta name="generator">
	remove_action( 'wp_head', 'wp_generator' );
}

add_action( 'after_setup_theme', 'hugonadeau_apres_initialisation_theme' );

/**
 * Change l'attribut ?ver des .css et des .js pour utiliser celui de la version de style.css.
 * @author Christiane Lagacé <christiane.lagace@hotmail.com>
 *
 * Utilisation : add_filter( 'style_loader_src', 'hugonadeau_attribut_version_style', 9999 );
 *               add_filter( 'script_loader_src', 'hugonadeau_attribut_version_style', 9999 );
 * Suppositions critiques : dans l'entête du fichier style.css du thème enfant, le numéro de version
 *                          à utiliser est inscrit à la ligne Version (ex : Version: ...)
 *
 * @return String Url de la ressource, se terminant par ?ver= suivi du numéro de version lu dans style.css
 *
 */
function hugonadeau_attribut_version_style( $src ) {
	$version = hugonadeau_version_style();
	if ( strpos( $src, 'ver=' . get_bloginfo( 'version' ) ) ) {
		$src = remove_query_arg( 'ver', $src );
		$src = add_query_arg( 'ver', $version, $src );
	}
	return $src;
}

add_filter( 'style_loader_src', 'hugonadeau_attribut_version_style', 9999 );
add_filter( 'script_loader_src', 'hugonadeau_attribut_version_style', 9999 );

/**
 * Retrouve le numéro de version de la feuille de style.
 * @author Christiane Lagacé <christiane.lagace@hotmail.com>
 *
 * Utilisation : $version = hugonadeau_version_style();
 * Suppositions critiques : dans l'entête du fichier style.css du thème enfant, le numéro de version
 *                          à utiliser est inscrit à la ligne Version (ex : Version: ...)
 *
 * @return String Le numéro de version lu dans style.css ou, s'il est absent, le numéro 1.0
 *
 */
function hugonadeau_version_style() {
	$default_headers =  array( 'Version' => 'Version' );
	$fichier = get_stylesheet_directory() . '/style.css';
	$data = get_file_data( $fichier, $default_headers );
	if ( empty( $data['Version'] ) ) {
		return "1.0";
	} else {
		return $data['Version'];
	}

}
/**
 * Enregistre une information de débogage dans le fichier debug.log, seulement si WP_DEBUG est à true.
 * @author Christiane Lagacé <christiane.lagace@hotmail.com>
 * Inspiré de http://wp.smashingmagazine.com/2011/03/08/ten-things-every-wordpress-plugin-developer-should-know/
 *
 * Utilisation : monprefixe_log_debug( 'test' );
 */
function hugonadeau_log_debug( $message ) {
	if ( WP_DEBUG === true ) {
		if ( is_array( $message ) || is_object( $message ) ) {
			error_log( 'Message de débogage: ' . print_r( $message, true ) );
		} else {
			error_log( 'Message de débogage: ' . $message );
		}
	}
}
/**
 * Affiche une information de débogage à l'écran, seulement si WP_DEBUG est à true.
 * @author Christiane Lagacé <christiane.lagace@hotmail.com>
 *
 * Utilisation : monprefixe_echo_debug( 'test' );
 * Suppositions critiques : le style .debug doit définir l'apparence du texte
 */
function hugonadeau_echo_debug( $message ) {
	if ( WP_DEBUG === true ) {
		if ( ! empty( $message ) ) {
			echo '<span class="debug">';
			if ( is_array( $message ) || is_object( $message ) ) {
				echo '<pre>';
				print_r( $message ) ;
				echo '</pre>';
			} else {
				echo $message ;
			}
			echo '</span>';
		}
	}
}
/**
 * Ajouter des balises dans la section <head>.
 * @author Christiane Lagacé <christiane.lagace@hotmail.com>
 *
 * Utilisation : add_action( 'wp_head', 'monprefixe_ajuster_head' );
 *               add_action( 'admin_head','monprefixe_ajuster_head' );
 */
function hugonadeau_ajuster_head() {
	echo '<link rel="icon" href="' . get_site_url() . '/favicon.ico" />';
	echo '<link rel="apple-touch-icon" sizes="180x180" href="' . get_site_url() . '/apple-touch-icon.png">';
echo '<link rel="icon" type="image/png" sizes="32x32" href="' . get_site_url() . '/favicon-32x32.png">';
 echo '<link rel="icon" type="image/png" sizes="16x16" href="' . get_site_url() . '/favicon-16x16.png">';
 echo '<link rel="manifest" href="' . get_site_url() . '/site.webmanifest">';
 echo '<link rel="mask-icon" href="' . get_site_url() . '/safari-pinned-tab.svg" color="#5bbad5">';
 echo '<meta name="msapplication-TileColor" content="#da532c">';
 echo '<meta name="theme-color" content="#ffffff">';
}

add_action( 'wp_head','hugonadeau_ajuster_head' );

add_action( 'admin_head','hugonadeau_ajuster_head' );

/**
 * Avertir l'usager qu'une maintenance du site est prévue prochainement.
 * @author Christiane Lagacé <christiane.lagace@hotmail.com>
 *
 * Utilisation : add_action( 'loop_start', 'monprefixe_avertir_maintenance' );
 */
/*function hugonadeau_avertir_maintenance( $array ) {
	// on pourrait aussi travailler avec la base de données pour savoir quand un message doit être affiché ou non et pour retrouver le message à afficher.
	echo '<div class="messagegeneral">Attention : le 16 juin à 11h, des travaux d\'entretien seront effectués. Le site ne sera pas disponible pendant deux heures.</div>';
};

add_action( 'wp_body_open', 'hugonadeau_avertir_maintenance' );*/
