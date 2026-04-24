<?php 
// Archivo frontend

//configuracion inicial

switch ($uri)  {
    case '/':
        include '/views/home.php';
        break;
    case '/jugadores':
        include __DIR__.'/views/jugadores.php';
        break;
    case '/tutores':
        include __DIR__.'/views/tutores.php';
        break;
    case 'categorias':
        include __DIR__.'/views/categorias.php';
        break;
    default:
        http_response_code(404);
        include __DIR__.'/views/404.php';
        break;
}

?>