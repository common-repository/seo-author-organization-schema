<?php
/*
Plugin Name: SEO Author Organization Schema
Description: Personaliza el esquema de Yoast SEO cambiando el autor a una organización, eliminando el esquema de persona y quitando la meta etiqueta rel="author".
Version: 1.0
Author: Agencia SEO Uruguay - SEO Wilko
Author URI: https://www.seowilko.com
License: GPL2
*/

// Filtro para quitar la meta etiqueta rel="author" generada por Yoast SEO
add_filter( 'wpseo_meta_author', '__return_false' );

// Filtros para cambiar el esquema de Yoast SEO
add_filter( 'wpseo_schema_article', 'saos_change_author_schema_to_organization' );
add_filter( 'wpseo_schema_person', 'saos_remove_person_schema' );

/**
 * Cambia el autor del esquema del artículo a una organización.
 *
 * @param array $data Datos del esquema del artículo.
 * @return array Datos del esquema del artículo modificados.
 */
function saos_change_author_schema_to_organization( $data ) {
    // Obtiene la URL del sitio y le agrega /#organization
    $organization_id = get_home_url() . '/#organization';

    if ( isset( $data['author'] ) ) {
        $data['author'] = [
            '@id' => $organization_id
        ];
    }

    return $data;
}

/**
 * Elimina el esquema de tipo "Person".
 *
 * @param mixed $data Datos del esquema de persona.
 * @return false Elimina la referencia al esquema de tipo "Person".
 */
function saos_remove_person_schema( $data ) {
    return false; // Esto elimina la referencia al esquema de tipo "Person"
}
