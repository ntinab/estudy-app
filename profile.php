<?php

require_once './functions.php';

session_start();

is_ip_blocked();

session_start();

if( !isset($_SESSION['uid']) )
{
    header('Location: index.php');
}

$query = "SELECT username, name, surname, aem, department, current_semester, phone, email, street, postal_code, town, country FROM uni_users WHERE id LIKE ?";

// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if( $stmt = $mysqli->prepare( $query ) )
{
    // Bind parameters (s = string, i = int, b = blob, etc)
    $stmt->bind_param('s', $_SESSION['uid']);
    $stmt->execute();
    $res = $stmt->get_result();
    $stmt->close();
    $response = $res->fetch_all(MYSQLI_ASSOC);
    $response = $response[0];
}
else
{
    $response = 'ERROR: ' . $mysqli->connect_error;
}


$mysqli->close();

?>

<!DOCTYPE html>
<html lang="el">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Προφίλ - UniStudent</title>

  <!-- browser icon-->
  <link rel="icon" href="./img/panepisthmio-dut-attikhs.png" />

  <!-- Normalize browser inconsistencies -->
  <link rel="stylesheet" href="./css/normalize.css">
  <!-- Bootstrap -->
  <link rel="stylesheet" href="../css/bootstrap.min.css">
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
    <?php //$pass_hash = password_hash( 'pixie11', PASSWORD_DEFAULT ); //var_dump($pass_hash);?>
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
          <a href="./statements.php" class="nav-link btn btn-block btn-lg">
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

      <div class="content"
        <!-- Card -->
        <article class="card card-cascade narrower">
          <!-- Card heading -->
          <section class="view gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-center align-items-center">
            <span class="white-text mx-3">Στοιχεία</span>
          </section>

          <!-- Card content -->
          <section class="px-4 pb-5">

            <!-- Table -->
            <section class="table-wrapper">
                <div class="row">
                    <div class="col-12">

                        <div class="tab-content ml-1" id="myTabContent">
                            <div class="tab-pane fade show active" id="basicInfo" role="tabpanel" aria-labelledby="basicInfo-tab">

                                <div class="row">
                                    <div class="col-sm-3 col-md-2 col-5">
                                        <label style="font-weight:bold;">Όνομα Χρήστη</label>
                                    </div>
                                    <div class="col-md-8 col-6">
                                        <?php echo $response['username']; ?>
                                    </div>
                                </div>
                                <hr />

                                <div class="row">
                                    <div class="col-sm-3 col-md-2 col-5">
                                        <label style="font-weight:bold;">Όνομα</label>
                                    </div>
                                    <div class="col-md-8 col-6">
                                        <?php echo $response['name']; ?>
                                    </div>
                                </div>
                                <hr />

                                <div class="row">
                                    <div class="col-sm-3 col-md-2 col-5">
                                        <label style="font-weight:bold;">Επίθετο</label>
                                    </div>
                                    <div class="col-md-8 col-6">
                                        <?php echo $response['surname']; ?>
                                    </div>
                                </div>
                                <hr />

                                <div class="row">
                                    <div class="col-sm-3 col-md-2 col-5">
                                        <label style="font-weight:bold;">ΑΕΜ</label>
                                    </div>
                                    <div class="col-md-8 col-6">
                                        <?php echo $response['aem']; ?>
                                    </div>
                                </div>
                                <hr />

                                <div class="row">
                                    <div class="col-sm-3 col-md-2 col-5">
                                        <label style="font-weight:bold;">Τμήμα</label>
                                    </div>
                                    <div class="col-md-8 col-6">
                                        <?php echo $response['department']; ?>
                                    </div>
                                </div>
                                <hr />

                                <div class="row">
                                    <div class="col-sm-3 col-md-2 col-5">
                                        <label style="font-weight:bold;">Εξάμηνο</label>
                                    </div>
                                    <div class="col-md-8 col-6">
                                        <?php echo $response['current_semester']; ?>
                                    </div>
                                </div>
                                <hr />

                                <div class="row">
                                    <div class="col-sm-3 col-md-2 col-5">
                                        <label style="font-weight:bold;">Τηλέφωνο</label>
                                    </div>
                                    <div class="col-md-8 col-6">
                                        <?php echo $response['phone']; ?>
                                    </div>
                                </div>
                                <hr />

                                <div class="row">
                                    <div class="col-sm-3 col-md-2 col-5">
                                        <label style="font-weight:bold;">Email</label>
                                    </div>
                                    <div class="col-md-8 col-6">
                                        <?php echo $response['email']; ?>
                                    </div>
                                </div>
                                <hr />

                                <div class="row pt-5 pb-3">
                                    <div class="col-12">
                                        <h5 style="font-weight:bold;">Διεύθυνση</h5>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-3 col-md-2 col-5">
                                        <label style="font-weight:bold;">Οδός</label>
                                    </div>
                                    <div class="col-md-8 col-6">
                                        <?php echo $response['street']; ?>
                                    </div>
                                </div>
                                <hr />

                                <div class="row">
                                    <div class="col-sm-3 col-md-2 col-5">
                                        <label style="font-weight:bold;">Τ.Κ.</label>
                                    </div>
                                    <div class="col-md-8 col-6">
                                        <?php echo $response['postal_code']; ?>
                                    </div>
                                </div>
                                <hr />

                                <div class="row">
                                    <div class="col-sm-3 col-md-2 col-5">
                                        <label style="font-weight:bold;">Πόλη</label>
                                    </div>
                                    <div class="col-md-8 col-6">
                                        <?php echo $response['town']; ?>
                                    </div>
                                </div>
                                <hr />

                                <div class="row">
                                    <div class="col-sm-3 col-md-2 col-5">
                                        <label style="font-weight:bold;">Χώρα</label>
                                    </div>
                                    <div class="col-md-8 col-6">
                                        <?php echo $response['country']; ?>
                                    </div>
                                </div>
                                <hr />

                            </div>
                        </div>
                    </div>
                </div>
            </section>
          </section>
        </article>

      </div>
   </main>
</div>


  <!-- Bootstrap dependencies -->
  <!-- First jQuery, then Popper.js and lastly Bootstrap JS -->
  <script src="./js/jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>
  <script src="./js/mdb.min.js"></script>
  <!-- Custom script -->
  <script src="./js/scripts.js"></script>
</body>

</html>
