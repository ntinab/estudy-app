<?php

require_once './db-config.php';

function is_ip_blocked()
{
   global $mysqli;
    $ip = $_SERVER['REMOTE_ADDR'];
    $query = "SELECT COUNT(ip) AS ips FROM uni_blacklist WHERE ip LIKE INET_ATON(?)";

    if( $stmt = $mysqli->prepare( $query ) )
    {
        // Bind parameters (s = string, i = int, b = blob, etc)
        $stmt->bind_param('s', $ip);
        $stmt->execute();
        $res = $stmt->get_result();
        $stmt->close();
        $response = $res->fetch_all(MYSQLI_ASSOC);
        $response = $response[0];

        if( $response['ips'] > 0)
        {
            header("HTTP/1.1 400 Bad Request");
            $mysqli->close();
            die();
        }
    }
    else
    {
        echo 'ERROR';
        header("HTTP/1.1 400 Bad Request");
        $mysqli->close();
        die();
    }

    $query = "SELECT ip, attempt_time + INTERVAL 1 HOUR AS time FROM uni_failed_logins WHERE ip LIKE INET_ATON(?) AND now()<attempt_time + INTERVAL 1 HOUR ORDER BY attempt_time ASC";

    if( $stmt = $mysqli->prepare( $query ) )
    {
        // Bind parameters (s = string, i = int, b = blob, etc)
        $stmt->bind_param('s', $ip);
        $stmt->execute();
        $res = $stmt->get_result();
        $stmt->close();
        $ret = $res->fetch_all(MYSQLI_ASSOC);

        $now = date("Y-m-d H:i:s");

        if( count($ret) > 4 && $ret[0]['time'] > $now )
        {
            header("Location: ./blocked.php");
            $mysqli->close();
            die();
        }
    }
    else
    {
        echo 'ERROR';
        header("HTTP/1.1 400 Bad Request");
        $mysqli->close();
        die();
    }
}
