<?php

$msg = '';
require './authenticate.php';

?>
<!DOCTYPE html lang="el"/>
<html lang="el">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Σύνδεση - UniStudent</title>  
        <!-- browser icon-->
        <link rel="icon" href="./img/panepisthmio-dut-attikhs.png" />
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link href="./css/login-styles.css" rel="stylesheet" id="login-styles-css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </head>
    <body>
        <div class="wrapper fadeInDown">
          <div id="formContent">
            <!-- Tabs Titles -->

            <!-- Icon -->
            <div class="fadeIn first">
              <img src="./img/panepisthmio-dut-attikhs.png" id="icon" alt="Panepistimio" />
              <div class="notices bg-danger text-light">
                  <?php echo $msg; ?>
              </div>
            </div>

            <!-- Login Form -->
            <form method="post">
              <input type="text" id="login" class="fadeIn second" name="username" placeholder="Όνομα Χρήστη">
              <input type="password" id="password" class="fadeIn third" name="password" placeholder="Κωδικός">
              <input type="text" id="name" class="honeypot" name="name" placeholder="Do not fill if human!" autocomplete="off">
              <input type="submit" class="fadeIn fourth" value="Σύνδεση">
            </form>

            <?php
            /*<!-- Remind Passowrd -->
            <div id="formFooter">
              <a class="underlineHover" href="./password-reminder.php">Ξέχασα τον κωδικό</a>
            </div>
            */
            ?>

          </div>
        </div>
    </body>
</html>
