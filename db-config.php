<?php

// DB congig
define( 'DB_DBNAME', 'unistdt_db' );
define( 'DB_USER', 'unistdt_db_user' );
define( 'DB_PASSWORD', 'qzoRf#I(xAq-' );
define( 'DB_HOST', 'localhost' );
define( 'DB_PORT', '3306' );

// Salt keys
define( 'AUTH_KEY', 'H80sHI(OU*u89Y&*)%)^*HWyuagd' );


$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_DBNAME );

if ( $mysqli->connect_errno )
{
    die( "Πρόβλημα σύνδεσης στη βάση δεδομένων: " . $mysqli->connect_error );
}

mysqli_set_charset($mysqli, "utf8");
