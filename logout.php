<?php
session_start();
unset($_SESSION['uid']);
session_destroy();
header('Refresh: 2; URL = index.php');
?>
<!DOCTYPE html>
<html lang="el">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Βαθμολογίες - UniStudent</title>

  <!-- browser icon-->
  <link rel="icon" href="./img/panepisthmio-dut-attikhs.png" />
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <link href="./css/login-styles.css" rel="stylesheet" id="login-styles-css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
    <body>
        <div class="wrapper">
            <h5>Αποσυνδεθήκατε επιτυχώς.</h5>
        </div>
</body>
