<?php

require_once './db-config.php';

$query = "DELETE FROM uni_failed_logins WHERE attempt_time < (NOW() - INTERVAL 6 HOUR)";
    
if( $stmt = $mysqli->prepare( $query ) )
{
    $stmt->execute();
    $stmt->close();
}

$mysqli->close();