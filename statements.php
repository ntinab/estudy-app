<?php

require_once './functions.php';

session_start();

is_ip_blocked();

session_start();

if( !isset($_SESSION['uid']) )
{
    header('Location: index.php');
}

$query = "SELECT courses.semester AS course_semester, courses.code AS code, courses.name AS name, courses.dm AS dm, courses.ects AS ects, courses.type AS type, statement.semester AS statement_semester, statement.year AS statement_year ";
$query .= "FROM uni_statements_meta AS meta INNER JOIN uni_courses AS courses ON meta.course_id=courses.id INNER JOIN uni_statements AS statement ON meta.statement_id=statement.id ";
$query .= "WHERE statement.user_id LIKE ? ORDER BY statement.year, statement.semester, courses.semester, courses.name ASC";

// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if( $stmt = $mysqli->prepare( $query ) )
{
    // Bind parameters (s = string, i = int, b = blob, etc)
    $stmt->bind_param('s', $_SESSION['uid']);
    $stmt->execute();
    $res = $stmt->get_result();
    $stmt->close();
    $response = $res->fetch_all(MYSQLI_ASSOC);
    //$response = $response[0];
}
else
{
    $response = 'ERROR: ' . $mysqli->connect_error;
}

$query = "SELECT semester, year FROM uni_statements WHERE user_id LIKE ? GROUP BY semester ORDER BY semester ASC";

// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if( $stmt = $mysqli->prepare( $query ) )
{
    // Bind parameters (s = string, i = int, b = blob, etc)
    $stmt->bind_param('s', $_SESSION['uid']);
    $stmt->execute();
    $res = $stmt->get_result();
    $stmt->close();
    $sem_result = $res->fetch_all(MYSQLI_ASSOC);
    //$response = $response[0];
}
else
{
    $sem_result = 'ERROR: ' . $mysqli->connect_error;
}

$mysqli->close();

?>
﻿<!DOCTYPE html>
<html lang="el">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Δηλώσεις - UniStudent</title>

  <!-- browser icon-->
  <link rel="icon" href="./img/panepisthmio-dut-attikhs.png" />

  <!-- Normalize browser inconsistencies -->
  <link rel="stylesheet" href="./css/normalize.css">
  <!-- Bootstrap -->
  <link rel="stylesheet" href="./css/bootstrap.min.css">
  <!-- Font Awesome -->
  <script defer src="./js/fontawesome-all.min.js"></script>
  <!-- MD Bootstrap -->
  <link rel="stylesheet" href="./css/mdb.min.css">
  <!-- Custom stylesheet -->
  <link rel="stylesheet" href="./css/styles.css">

  <style>
    .content .card {
      min-width: 900px;
      width: 85%;
    }

    /* Scrollbar styling */

    body::-webkit-scrollbar {
      width: 9px;
    }

    body::-webkit-scrollbar-thumb {
      border-radius: 10px;
      background-image: linear-gradient(40deg, #59c0e6, #0f1435);
    }

    body::-webkit-scrollbar-track {
      background-color: rgb(230, 223, 223);
      border-radius: 10px;
    }
  </style>
</head>

<body>
  <!-- Wrapper stretches to the whole viewport height -->
  <div class="wrapper">

    <!-- Sidebar -->
    <nav id="sidebar" class="navbar sticky-top">
      <div class="navbar-header">
        <img src="./img/panepisthmio-dut-attikhs.png" class="rounded-circle" alt="Profile picture">
        <h5 class="navbar-brand m-1 text-white pl-2">UniStudent </h5>
      </div>

      <!-- Navbar links -->
      <ul class="navbar-nav">

        <li class="nav-item active">
          <a href="./profile.php" class="nav-link btn btn-block btn-lg">
            <i class="fas fa-user-circle fa-lg mr-1"></i>
            <span>Προφιλ</span>
          </a>
        </li>

        <li class="nav-item btn-group">
          <a href="./grades.php" class="nav-link btn btn-block btn-lg">
            <i class="fas fa-graduation-cap fa-lg mr-1"></i>
            <span>Βαθμολογίες</span>
          </a>
	    </li>

       <li class="nav-item">
          <a href="./statements.html" class="nav-link btn btn-block btn-lg">
            <i class="fas fa-file-alt fa-lg mr-1"></i>
            <span>Δηλώσεις</span>
          </a>
        </li>
       </ul>
    </nav>

<!-- Main -->
    <main>

 <!-- Topbar -->
      <nav id="topbar" class="navbar navbar-expand-md sticky-top">


        <!-- sidebar toggle button -->
        <button id="topbar-toggler" class="navbar-toggler" type="button" data-toggle="collapse">
          <span class="fas fa-align-left"></span>
        </button>




        <!-- topbar items toggle button -->
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#topbar-items">
          <span class="fas fa-ellipsis-v"></span>
        </button>

        <!-- topbar items -->
        <div class="navbar-collapse collapse" id="topbar-items">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link waves-effect waves-light" href="logout.php">
                <i class="fas fa-sign-out-alt"></i>
                <span>Αποσύνδεση</span>
              </a>
            </li>
          </ul>
        </div>
      </nav>

      <!-- Content -->
      <div class="content">
        <!-- Card -->
        <article class="card card-cascade narrower">
          <!-- Card heading -->
          <section class="view gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-center align-items-center">
            <span class="white-text mx-3">Δηλώσεις</span>
          </section>

          <div class="dropdown">
  			<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    			Περίοδος Δήλωσης
  			</button>
  			<div class="dropdown-menu" id="statements" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item all" href="#">Όλες οι δηλώσεις</a>
                <?php
                foreach( $sem_result as $statement )
                {
                    echo '<a class="dropdown-item" href="#">' . $statement['semester'] .' ' . $statement['year'] . '</a>';
                }
                ?>
  			</div>
		  </div>

          <!-- Card content -->
          <section class="px-4 pb-5">

            <!-- Table -->
            <section class="table-wrapper">
              <table class="table table-hover mb-0">

                <thead>
                  <tr>
                    <th class="th-md">Κωδικός Μαθήματος</th>
                    <th class="th-md">Μάθημα</th>
                    <th class="th-md">Εξάμηνο</th>
                    <th class="th-md">ECTS</th>
                    <th class="th-md">ΔΜ</th>
                    <th class="th-md">Τύπος</th>
                   </tr>
                </thead>

                <tbody>
                    <?php
                    foreach( $response as $res )
                    {
                        ?>
                        <tr>
                            <td><?php echo $res['code']; ?></td>
                            <td><?php echo $res['name']; ?></td>
                            <td><?php echo $res['course_semester']; ?></td>
                            <td><?php echo $res['ects']; ?></td>
                            <td><?php echo $res['dm']; ?></td>
                            <td><?php echo $res['type']; ?></td>
                            <td><?php echo $res['statement_semester'] . ' ' . $res['statement_year']; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>

              </table>
            </section>
          </section>
        </article>

      </div>
    </main>
  </div>

  <!-- Bootstrap dependencies -->
  <!-- First jQuery, then Popper.js and lastly Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="./js/mdb.min.js"></script>
  <!-- Custom script -->
  <script src="./js/scripts.js"></script>
  <script>
    jQuery(document).ready(function($){
        $('#statements a').on('click', function(){
            var sem = $(this).text();
            $('#dropdownMenuButton').text(sem);
            if( $(this).hasClass('all') )
            {
                $('.table-wrapper table tbody tr').removeClass('d-none');
            }
            else
            {
                $('.table-wrapper table tbody tr').addClass('d-none');
                $('.table-wrapper table tbody tr td:contains(' + sem + ')').parent().removeClass('d-none');
            }
        });
    });
  </script>
</body>

</html>
