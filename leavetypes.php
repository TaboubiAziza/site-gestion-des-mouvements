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
  <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
  <link rel="shortcut icon" href="TUTunisair.png">

  <title>Leave Types</title>

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
      <a href="index.html" class="logo"><img src="TUTunisair.png"> <span class="lite">Leave Types</span></a>
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
              <span class="username"> <?php echo $_SESSION["matricule"]; ?></span>
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
                    <?php if ($_SESSION['role']==1){ ?>
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

                    <?php if ($_SESSION['role']==3){ ?>
                    <li class="sub-menu">
                          <a class="" href="balances.php">
                           <i class="icon_desktop"></i>Manage Balances
                         </a>
                    </li>
                    <?php }; ?>
                    <?php if ($_SESSION['role']==2){ ?>
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
            <h3 class="page-header"><i class="fa fa-table"></i>Leave Types</h3>
            <p style="text-align: left;">
              <a class="user" style="text-align: right;">

                <button data-toggle="modal" data-target="#ajout" type="button" class="btn btn-success" href="#"> <i class="fas fa-plus-circle"></i></button>

              </a>
            </p>
            <div class="table-responsive">
            <table class="table table-striped table-advance table-hover" id="table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Leave Type</th>
                  <th>Number of days given </th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                include_once 'conn.php';

                $myquery = mysqli_query($conn,  "SELECT * FROM type_leave");

                while ($row = mysqli_fetch_array($myquery)) {
                  echo "<tr data-type='" . $row['type'] . "' data-max_nbr_day='" . $row['max_nbr_day'] . "'>";
                  echo "<td>" . $row['id_type_leave'] . "</td>";
                  echo "<td>" . $row['type'] . "</td>";
                  echo "<td>" . $row['max_nbr_day'] . "</td>";
                  echo "<td>  <div class='btn-group'>
      <a data-id='" . $row['id_type_leave'] . "' class='mr-2 btnEdit'>  
       <button type='button' class='btn btn-success' title='Update' >
        <i class='fas fa-edit'></i>
       </button>
      </a>
      <a class='btnDelete' href='delco.php?id_type_leave=" . $row['id_type_leave'] . "'> 
      <button type='button' class='btn btn-danger' title='Delete'>
       <i class='fas fa-minus-circle'></i>
       </button>
      </a>
      </div>
      </td>
      </tr>";
                }

                ?>
              </tbody>
            </table>
            </div>
            <!-- Ajout modal -->
            <div id="ajout" class="modal" tabindex="-1" role="dialog">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Add leave</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>

                  <form action="insertco.php" method="POST">
                    <div class="modal-body">
                      <div class="row">
                        <div class="form-group col-6">
                          <label for="type"><b>Type </b></label>
                          <input class="form-control" type="text" name="type" required>
                        </div>
                        <div class="form-group col-6">
                          <label for="max_nbr_day"><b>Number of days given</b></label>
                          <input class="form-control" type="text" name="max_nbr_day" required>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- Edit user modal -->
            <div id="edit" class="modal" tabindex="-1" role="dialog">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Edit leave</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form id="editForm" action="editleave.php" method="POST">
                    <div class="modal-body">
                      <div class="row">
                        <div class="form-group col-6">
                          <label for="type"><b>Type </b></label>
                          <input class="form-control" name="type" type="text" required>
                        </div>
                        <div class="form-group col-6">
                          <label for="max_nbr_day"><b>Number of days given</b></label>
                          <input class="form-control" type="text" name="max_nbr_day" required>
                          <input type="text" name="id_type_leave" hidden>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                      </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- page end-->
      </section>
    </section>
    <!--main content end-->
    <div class="text-right">
      <div class="credits">
        <!--
            All the links in the footer should remain intact.
            You can delete the links only if you purchased the pro version.
            Licensing information: https://bootstrapmade.com/license/
            Purchase the pro version form: https://bootstrapmade.com/buy/?theme=NiceAdmin
          -->

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
  <script src="js/leavetypes.js"></script>

</body>

</html>