<?php
// Definir constantes para la Base de Datos

define('DB_HOST', 'localhost');
define('DB_NAME', 'datatables');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_OPTIONS', array(
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
));
