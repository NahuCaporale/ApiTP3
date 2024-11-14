<?php
// Configuración de la base de datos
define('MYSQL_HOST', 'localhost');  // Host de la base de datos
define('MYSQL_USER', 'root');       // Usuario de la base de datos
define('MYSQL_PASS', '');           // Contraseña de la base de datos (puedes poner la tuya aquí)
define('MYSQL_DB', 'ratenew');   // Nombre de la base de datos

if (!defined('MYSQL_USER')) {
    define('MYSQL_USER', 'tu_usuario');
}

if (!defined('MYSQL_PASS')) {
    define('MYSQL_PASS', 'tu_contraseña');
}

if (!defined('MYSQL_DB')) {
    define('MYSQL_DB', 'nombre_base_de_datos');
}

if (!defined('MYSQL_HOST')) {
    define('MYSQL_HOST', 'localhost'); // O la dirección de tu servidor MySQL
}
