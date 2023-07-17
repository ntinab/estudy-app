<?php

require_once './functions.php';

session_start();

is_ip_blocked();

if( count($_POST) == 3 )
{
    if( isset($_POST['username'], $_POST['password']) && !empty($_POST['username']) && !empty($_POST['password']) && empty($_POST['name']) )
    {
        $username = trim($_POST['username']);
        $pass = trim($_POST['password']);

        if( preg_match("/[^a-zA-Z0-9]+/", $username) || preg_match("/[^a-zA-Z0-9]+/", $pass) )
        {
            $msg = 'Καλή προσπάθεια...';

            $ip = $_SERVER['REMOTE_ADDR'];
            $sql = sprintf("INSERT INTO uni_blacklist SET ip = INET_ATON('%s')", $ip);

            if( $mysqli->query($sql) === TRUE )
            {
                header("Location: ./blocked.php");
                $mysqli->close();
                die();
            }
            else
            {
                echo 'lo ERROR';
                header("HTTP/1.1 400 Bad Request");
                $mysqli->close();
                die();
            }
        }
        else
        {
            $hash = password_hash( $pass, PASSWORD_DEFAULT );

            $query = "SELECT COUNT(username) AS count, id, password FROM uni_users WHERE username LIKE ?";

            // Prepare our SQL, preparing the SQL statement will prevent SQL injection.
            if( $stmt = $mysqli->prepare( $query ) )
            {
                // Bind parameters (s = string, i = int, b = blob, etc)
                $stmt->bind_param('s', $username);
                $stmt->execute();
                $res = $stmt->get_result();
                $stmt->close();
                $response = $res->fetch_all(MYSQLI_ASSOC);
                $response = $response[0];
            }
            else
            {
                echo 'pass ERROR: ' . $mysqli->connect_error;
                header("HTTP/1.1 400 Bad Request");
                $mysqli->close();
                die();
            }

            $ip = $_SERVER['REMOTE_ADDR'];

            if( $response['count'] == 1 && password_verify( $pass, $response['password'] ) )
            {
                $_SESSION['uid'] = $response['id'];
                $sql = sprintf("DELETE FROM uni_failed_logins WHERE ip LIKE INET_ATON('%s')", $ip);

                if( $mysqli->query($sql) === TRUE )
                {
                    $mysqli->close();
                    header( 'Location: ./profile.php' );
                }
                else
                {
                    echo 'end ERROR';
                    header("HTTP/1.1 400 Bad Request");
                    $mysqli->close();
                    die();
                }
            }
            else
            {
                //var_dump($hash);
                $msg = 'Λάθος username ή password.';
                $sql = sprintf("INSERT INTO uni_failed_logins SET ip = INET_ATON('%s'), attempt_time = CURRENT_TIMESTAMP", $ip);

                if( $mysqli->query($sql) === TRUE )
                {
                    $mysqli->close();
                }
                else
                {
                    echo 'newj ERROR';
                    header("HTTP/1.1 400 Bad Request");
                    $mysqli->close();
                    die();
                }
            }
        }
    }
    elseif( isset($_POST['username'], $_POST['password']) && !empty($_POST['name']) )
    {
        $ip = $_SERVER['REMOTE_ADDR'];
        $sql = sprintf("INSERT INTO uni_blacklist SET ip = INET_ATON('%s')", $ip);

        if( $mysqli->query($sql) === TRUE )
        {
            header("Location: ./blocked.php");
            $mysqli->close();
            die();
        }
        else
        {
            echo 'lo ERROR';
            header("HTTP/1.1 400 Bad Request");
            $mysqli->close();
            die();
        }
    }
    elseif( isset($_POST['username'], $_POST['password']) && !empty($_POST['name']) )
    {
        $msg = 'Συμπληρώστε όλα τα πεδία.';
    }
}
else
{
}
