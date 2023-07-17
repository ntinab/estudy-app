<?

require_once './db-config.php';

$ip = $_SERVER['REMOTE_ADDR'];
$query = "SELECT attempt_time + INTERVAL 1 HOUR AS time FROM uni_failed_logins WHERE ip LIKE INET_ATON(?) ORDER BY attempt_time DESC";

if( $stmt = $mysqli->prepare( $query ) )
{
    // Bind parameters (s = string, i = int, b = blob, etc)
    $stmt->bind_param('s', $ip);
    $stmt->execute();
    $res = $stmt->get_result();
    $stmt->close();
    $response = $res->fetch_all(MYSQLI_ASSOC);
    $response = $response[0];

    $time = $response['time'];
    $str_time = strtotime($time);
}
else
{
    echo 'ERROR';
    header("HTTP/1.1 400 Bad Request");
    $mysqli->close();
    die();
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            p {
              text-align: center;
              font-size: 30px;
              margin-top: 0px;
            }
        </style>
    </head>
    <body>

        <p id="demo"></p>

        <script>
            // Set the date we're counting down to
            var countDownDate = new Date(<?php echo '"' . $time  . '"'; ?>).getTime();

            // Update the count down every 1 second
            var x = setInterval(function() {

              // Get today's date and time
              var now = new Date().getTime();

              // Find the distance between now and the count down date
              var distance = countDownDate - now;

              // Time calculations for days, hours, minutes and seconds
              var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
              var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
              var seconds = Math.floor((distance % (1000 * 60)) / 1000);


              document.getElementById("demo").innerHTML = "Ξαναπροσπάθησε σε " + hours + " ώρες "
              + minutes + " λεπτά " + seconds + " δευτερόλεπτα.";

              if(distance < 0)
            {
                clearInterval(x);
                window.location.replace("https://unistudent.eu");
            }

            }, 1000);
        </script>

    </body>
</html>
