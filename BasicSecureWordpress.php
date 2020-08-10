<?php
/*
Plugin Name: Basic Security Wordpress
Description: Plugin con funciones de seguridad básicas para Wordpress.
Version: 1.0
*/

//Desactivar las sugerencias en el login
function no_wordpress_login_errors(){
return 'La web está securizada';
}
add_filter( 'login_errors', 'no_wordpress_login_errors' );


//Ocultar la etiqueta generator de la cabecera
function remove_wp_generator() {
return '';
}
add_filter('the_generator', 'remove_wp_generator');


//Desactivar API//
add_filter('json_enabled', '__return_false');
add_filter('json_jsonp_enabled', '__return_false');


//Actualizaciones automáticas de plugins y themes (OPCIONAL, recomendable actualizar temas manualmente)
add_filter( 'auto_update_plugin', '__return_true' );
add_filter( 'auto_update_theme', '__return_true' );


//Ocultar la versión de WP de los scripts y estilos//

function remove_wp_version_strings( $src ) {
global $wp_version;
parse_str(parse_url($src, PHP_URL_QUERY), $query);
if ( !empty($query['ver']) && $query['ver'] === $wp_version ) {
$src = remove_query_arg('ver', $src);
}
return $src;
}
add_filter( 'script_loader_src', 'remove_wp_version_strings' );
add_filter( 'style_loader_src', 'remove_wp_version_strings' );