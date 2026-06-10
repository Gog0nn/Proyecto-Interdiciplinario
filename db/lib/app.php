<?php
/**
 * ============================================================================
 * ARCHIVO: app.php
 * UBICACION: lib/app.php
 * DESCRIPCION: Configuracion base de rutas globales de la aplicacion.
 *              Define las constantes ASSETS_URL y BASE_URL.
 *
 * ARCHIVOS QUE USAN ESTE ARCHIVO:
 *   - ../parciales/templateStart.php -> include_once de app.php
 *   - ../parciales/header.php        -> usa BASE_URL
 *   - ../parciales/aside1.php        -> usa BASE_URL
 * ============================================================================
 */
define('ASSETS_URL', '/assets');

$script_name = $_SERVER['SCRIPT_NAME'];
$parts = explode('/', trim($script_name, '/'));
$base_url = $parts[0] ?? '';
define('BASE_URL', '/' . $base_url);

/**
 * Retorna la clase 'active' si la sección proporcionada coincide con la URL actual.
 * @param string $section Nombre de la carpeta o parte de la ruta (ej: 'jugadores')
 * @return string
 */
function set_active(string $section): string {
    $current_uri = $_SERVER['REQUEST_URI'];
    return (str_contains($current_uri, $section)) ? 'active' : '';
}

?>
