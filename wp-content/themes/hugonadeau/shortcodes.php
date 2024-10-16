<?php
// Function to display "Ça marche !"
function hugonadeau_test_shortcode() {
    global $wpdb;

    // Noms des tables
    $table_Sujets = $wpdb->prefix . 'hugonadeaubd_lecture';
    $table_Posts = $wpdb->prefix . 'hugonadeaubd_genre';

    // Récupérer les données des lectures
    $lectures = $wpdb->get_results("SELECT l.nom, l.synopsie, l.statut, g.genre FROM $table_Sujets l JOIN $table_Posts g ON l.genre_id = g.id");

    ob_start(); // Commence la mise en tampon de sortie
    ?>
    <table>
        <thead>
        <tr>
            <th><?php _e('Nom', 'votre-theme-enfant'); ?></th>
            <th><?php _e('Synopsie', 'votre-theme-enfant'); ?></th>
            <th><?php _e('Genre', 'votre-theme-enfant'); ?></th>
            <th><?php _e('Statut', 'votre-theme-enfant'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php
        // Affiche les données des lectures
        if (!empty($lectures)) {
            foreach ($lectures as $lecture) {
                ?>
                <tr>
                    <td><?php echo esc_html($lecture->nom); ?></td>
                    <td><?php echo esc_html($lecture->synopsie); ?></td>
                    <td><?php echo esc_html($lecture->genre); ?></td>
                    <td><?php echo esc_html($lecture->statut); ?></td>
                </tr>
                <?php
            }
        } else {
            // Afficher un message si aucune lecture n'est trouvée
            ?>
            <tr>
                <td colspan="4"><?php _e('Aucune lecture trouvée.', 'votre-theme-enfant'); ?></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
    <?php
    return ob_get_clean(); // Retourner le contenu tamponné
}

// Register the shortcode
add_shortcode('afficher_message', 'hugonadeau_test_shortcode');
// Register your shortcode
add_shortcode('afficher_message', 'hugonadeau_test_shortcode');

// Enqueue your stylesheet
function hugonadeau_enqueue_styles() {
    wp_enqueue_style( 'hugonadeau', get_stylesheet_directory_uri() . '/css/shortcodes.css' );
}
add_action( 'wp_enqueue_scripts', 'hugonadeau_enqueue_styles' );
