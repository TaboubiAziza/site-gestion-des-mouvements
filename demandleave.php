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

  <title>Request Leave</title>

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
      <a href="demandleave.php" class="logo"><img src="TUTunisair.png"> <span class="lite">Request Leave</span></a>
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
            <h3 class="page-header"><i class="fa fa fa-bars"></i> Request Leave</h3>

          </div>
        </div>
        <!-- page start-->
        <div class="row">
          <div class="col-lg-12">
            <div id="sendmessage">Your message has been sent. Thank you!</div>
            <div id="errormessage"></div>
            <form action="addleave.php" method="post" enctype="multipart/form-data" role="form" class="contactForm">
              <div class="form-group">
                <select name="id_type_leave" class="form-control" id="type" required>
                  <option value="">Leave Type</option>
                  <option value="1">Annual</option>
                  <option value="2">Medical leave</option>
                  <option value="3">Breavement leave sister/brother</option>
                  <option value="4">Breavement leave parents/children/spouse</option>
                  <option value="5">Maternity leave </option>
                  <option value="6">Paternity leave</option>
                  <option value="7">Marriage leave</option>
                </select>
                </option>
                </select>
                <div class="validation"></div>
              </div>
              <div class="form-group">
                <input type="date" class="form-control" name="from" data-msg="from" id="from" placeholder="From" required />
                <div class="validation"></div>
              </div>
              <script>
                var today = new Date();
                var dd = today.getDate();
                var mm = today.getMonth() + 1; //January is 0 so need to add 1 to make it 1!
                var yyyy = today.getFullYear();
                if (dd < 10) {
                  dd = '0' + dd
                }
                if (mm < 10) {
                  mm = '0' + mm
                }

                today = yyyy + '-' + mm + '-' + dd;
                document.getElementById("from").setAttribute("min", today);
              </script>
              <div class="form-group">
                <input type="date" class="form-control" name="to" data-msg="to" id="to" placeholder="To" required />
                <div class="validation"></div>
              </div>
              <script>
                var today = new Date();
                var dd = today.getDate();
                var mm = today.getMonth() + 1; //January is 0 so need to add 1 to make it 1!
                var yyyy = today.getFullYear();
                if (dd < 10) {
                  dd = '0' + dd
                }
                if (mm < 10) {
                  mm = '0' + mm
                }
 
                today = yyyy + '-' + mm + '-' + dd;
                document.getElementById("to").setAttribute("min", today);
              </script>
              <div class="form-group">
                <textarea class="form-control" name="description" rows="5" data-rule="required" data-msg="Plus de spécifications sur votre demande ." placeholder="More specifications about your demand." required></textarea>
                <div class="validation"></div>
              </div>
              <div class="form-group">
                <label for="justification"><b>Justification</b></label>
                <input type="file" name="justification">
                <div class="validation"></div>
              </div>
              <div class="text-center"><button type="submit" class="btn btn-primary"> Send Request</button></div>
            </form>
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
  <!-- javascripts -->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="assets/datatables/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="assets/datatables/dataTables.bootstrap4.min.js"></script>
  <!--custome script for all page-->
  <script src="js/scripts.js"></script>


</body>

</html>