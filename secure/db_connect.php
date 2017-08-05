<?php 

define("HOST", "localhost"); // The host you want to connect to.
define("USER", "root"); // The database username.
define("PASSWORD", "ghHYGb46889.gh"); // The database password. 
define("DATABASE", "delhipolice"); // The database name.
define("PORT", 3306);
 
$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
// If you are connecting via TCP/IP rather than a UNIX socket remember to add the port number as a parameter.


;?>
