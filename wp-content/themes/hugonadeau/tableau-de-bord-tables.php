<?php
/**
 * Plugin Name: Hugonadeau Custom Tables
 * Description: Crée des tables personnalisées pour les Posts, Sujets et Commentaires.
 * Version: 1.0
 * Author: hugon
 */

defined( 'ABSPATH' ) || exit;

register_activation_hook( __FILE__, 'hugonadeau_creer_tables' );

function hugonadeau_creer_tables() {
	global $wpdb;

	$charset_collate = $wpdb->get_charset_collate();

	// Définir les noms des tables avec le préfixe WordPress
	// Noms des tables
	$table_Sujets = $wpdb->prefix . 'hugonadeaubd_lecture';
	$table_Posts = $wpdb->prefix . 'hugonadeaubd_genre';

// Vérifiez si la table des Sujets existe déjà
	if ($wpdb->get_var("SHOW TABLES LIKE '$table_Sujets'") != $table_Sujets) {
		$charset_collate = $wpdb->get_charset_collate();

		// Créez la table des Sujets
		$sql = "CREATE TABLE $table_Sujets (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        nom varchar(255) NOT NULL,
        synopsie text NOT NULL,
        statut varchar(50) NOT NULL,
        genre_id mediumint(9) NOT NULL,
        PRIMARY KEY (id),
        FOREIGN KEY (genre_id) REFERENCES {$table_Posts}(id) ON DELETE CASCADE
    ) $charset_collate;";

		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);
	}

// Vérifiez si la table des Genres existe déjà
	if ($wpdb->get_var("SHOW TABLES LIKE '$table_Posts'") != $table_Posts) {
		$charset_collate = $wpdb->get_charset_collate();

		// Créez la table des Genres
		$sql = "CREATE TABLE $table_Posts (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        genre varchar(255) NOT NULL,
        type varchar(50) NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);
	}



	// Inclure le fichier nécessaire pour dbDelta
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );


	// Vérifier les erreurs SQL
	$erreur_sql = $wpdb->last_error;
	if ( '' !== $erreur_sql ) {
		hugonadeau_log_debug( "Erreur lors de la création des tables : $erreur_sql" );
	} else {
		hugonadeau_log_debug( "Tables créées ou mises à jour avec succès." );
	}
}

// Action après l'activation du thème (si nécessaire)
add_action( "after_switch_theme", "hugonadeau_creer_tables" );

// Fonction de log pour débogage

