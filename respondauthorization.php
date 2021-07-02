<?php
session_start();

if (!isset($_SESSION["matricule"])) {
  header('Location: login.php');
  exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
  <meta name="author" content="GeeksLabs">
  <meta name="keyword" content="Aziza and Yasmine">
  <link rel="shortcut icon" href="TUTunisair.png">

  <title>Authorization requests</title>

  <!-- Bootstrap CSS -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <!-- bootstrap theme -->

  <!--external css-->
  <!-- font icon -->
  <link href="assets/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <link href="css/elegant-icons-style.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <!-- Custom styles -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet" />
</head>

<body>
  <!-- container section start -->
  <section id="container" class="">
    <!--header start-->
    <header class="header dark-bg">
      <div class="toggle-nav">
        <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="icon_menu"></i></div>
      </div>

      <!--logo start-->
      <a href="index.html" class="logo"><img src="TUTunisair.png"> <span class="lite">Authorization Requests</span></a>
      <!--logo end-->

      <div class="nav search-row" id="top_menu">
        <!--  search form start -->
        <ul class="nav top-menu">
          <li>
            <form class="navbar-form">
              <input class="form-control" placeholder="Search" type="text">
            </form>
          </li>
        </ul>
        <!--  search form end -->
      </div>

      <div class="top-nav notification-row">
        <!-- notificatoin dropdown start-->
        <ul class="nav pull-right top-menu">

          <!-- user login dropdown start-->
          <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
              <span class="profile-ava">
                <img alt="" src="gazelle.png">
              </span>
              <span class="username"><?php echo $_SESSION['matricule'] ?></span>
              <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
              <div class="log-arrow-up"></div>
              <li class="eborder-top">
                <a href="logout.php"><i class="icon_key_alt"></i> Log Out</a>
              </li>
            </ul>
          </li>
          <!-- user login dropdown end -->
        </ul>
        <!-- notificatoin dropdown end-->
      </div>
    </header>
    <!--header end-->

    <!--sidebar start-->
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu">

          <li class="active">
            <a class="" href="Actualities.php">
              <i class="icon_house_alt"></i>
              <span>Actualities</span>
            </a>
          </li>
          <?php if ($_SESSION['role'] == 1) { ?>
            <li class="sub-menu">
              <a href="javascript:;" class="">
                <i class="icon_desktop"></i>
                <span>Administration</span>
                <span class="menu-arrow arrow_carrot-right"></span>
              </a>
              <ul class="sub">
                <li><a class="" href="manageemployees.php">Manage Users</a></li>
                <li><a class="" href="calendar.php"><span>Manage holidays</span></a></li>
                <li><a class="" href="leavetypes.php">Manage Leaves</a></li>
                <li><a class="" href="services.php">Manage Services</a></li>
              </ul>
            </li>
          <?php }; ?>

          <?php if ($_SESSION['role'] == 3) { ?>
            <li class="sub-menu">
              <a class="" href="balances.php">
                <i class="icon_desktop"></i>Manage Balances
              </a>
            </li>
          <?php }; ?>
          <?php if ($_SESSION['role'] == 2) { ?>
            <li class="sub-menu">
              <a href="javascript:;" class="">
                <i class="icon_document_alt"></i>
                <span>Respond</span>
                <span class="menu-arrow arrow_carrot-right"></span>
              </a>
              <ul class="sub">
                <li><a class="" href="respondleaves.php">Leaves</a></li>
                <li><a class="" href="respondauthorization.php">Authorizations</a></li>
              </ul>
            </li>
          <?php }; ?>
          <li class="sub-menu">
            <a href="javascript:;" class="">
              <i class="icon_documents_alt"></i>
              <span> Demands</span>
              <span class="menu-arrow arrow_carrot-right"></span>
            </a>
            <ul class="sub">
              <li><a class="" href="leavedemandhistory.php"> Leaves</a></li>
              <li><a class="" href="authorizationdemandhistory.php"> Authorizations</a></li>
            </ul>
          </li>
          <li>
            <a class="" href="charts.php">
              <i class="icon_piechart"></i>
              <span>Charts</span>

            </a>

          </li>
        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>
    <!--sidebar end-->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-table"></i> Authorization Requests</h3>
          </div>
        </div>

        <!-- page start-->
        <div class="table-responsive">
          <table class="table table-striped  table-advance table-hover" id="table">
            <thead>
              <tr>
                <th> ID</th>
                <th> Sender</th>
                <th> Name</th>
                <th> LastName</th>
                <th> From</th>
                <th> To</th>
                <th> Description</th>
                <th> Status</th>
                <th> Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              include_once 'conn.php';
              $req = "SELECT authorization.id, user.matricule, user.name, user.lastname, authorization.from, authorization.to, authorization.description, authorization.status FROM authorization, user WHERE authorization.matricule = user.matricule AND user.service = '" . $_SESSION["service"] . "'";
              $myquery = mysqli_query($conn, $req);

              while ($row = mysqli_fetch_array($myquery)) {
                $bg_color = "";
                $action = "<div class='dropdown dropleft'>
                <button class='btn btn-primary btn-sm dropdown-toggle' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>options</button>
                <div class='dropdown-menu animated--fade-in' aria-labelledby='dropdownMenuButton' style=''>
                    <a class='dropdown-item btnAccept' href='repondreauth.php?id=" . $row['id'] . "&rep=1&sender=" . $row['matricule'] . "'><i class='fas fa-check-double'></i> Accept</a>
                    <a class='dropdown-item btnReject' href='repondreauth.php?id=" . $row['id'] . "&rep=2'><i class='fas fa-times'></i> Reject</a>
                </div>
                </div>";

                if ($row['status'] == "accepted") {
                  $bg_color = "bg-success";
                  $action = "-";
                } else if ($row['status'] == "rejected") {
                  $bg_color = "bg-danger";
                  $action = "-";
                }
                echo "<tr data-matricule='" . $row['matricule'] . "' data-name='" . $row['name'] . "' data-lastname='" . $row['lastname'] . "'
      data-from='" . $row['from'] . "' data-to='" . $row['to'] . "'
      data-description='" . $row['description'] . "' data-status='" . $row['status'] . "'>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['matricule'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['lastname'] . "</td>";
                echo "<td>" . $row['from'] . "</td>";
                echo "<td>" . $row['to'] . "</td>";
                echo "<td>" . $row['description'] . "</td>";
                echo "<td><div class='badge " . $bg_color . " badge-pill'>" . $row['status'] . "</div></td>"; //
                echo "<td class='text-center'>" . $action . "</td>
                </tr>";
              }
              ?>

            </tbody>
          </table>
        </div>



        <!-- page end-->
      </section>
    </section>
    <!--main content end-->
    <div class="text-right">
      <div class="credits">

      </div>
    </div>
  </section>
  <!-- container section end -->
  <!-- javascripts -->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="assets/datatables/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="assets/datatables/dataTables.bootstrap4.min.js"></script>
  <!--custome script for all page-->
  <script src="js/scripts.js"></script>
  <script>
    $(document).ready(function() {
      $('#table').DataTable();
    });
  </script>
  <script src="js/resauth.js"></script>


</body>

</html>