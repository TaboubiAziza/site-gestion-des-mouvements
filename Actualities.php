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
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
  <link rel="icon" href="TUTunisair.png">

  <title>Actualities</title>

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

  <!-- full calendar css-->
  <link href="assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" />
  <link href="assets/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" />
  <!-- easy pie chart-->
  <link href="assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen" />
  <!-- owl carousel -->
  <link rel="stylesheet" href="css/owl.carousel.css" type="text/css">
  <link href="css/jquery-jvectormap-1.2.2.css" rel="stylesheet">
</head>

<body>
  <!-- container section start -->
  <section id="container" class="">


    <header class="header dark-bg">
      <div class="toggle-nav">
        <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="icon_menu"></i></div>
      </div>

      <!--logo start-->
      <a href="Acceuil.php" class="logo"><img src="TUTunisair.png"> <span class="lite">Actualities</span></a>
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

        <!--overview start-->
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><img src="TUTunisair.png"></i> Tunisair's website for tracking movements</h3>

          </div>
        </div>
        <br><br>
        <div class="row">
          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <img src=plane0.jpg height="70%" width="100%">
          </div>
          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <img src=plane1.jpg height="70%" width="100%">
          </div>
          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <img src=plane2.jpg height="70%" width="100%">
          </div>
          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <img src=plane4.jpg height="70%" width="100%">
          </div>
        </div>
        <!--/.row-->

        <div class="row">
          <div class="col-md-12 portlets">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h2><strong>Calendar</strong></h2>
                <div class="panel-actions">
                  <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a>
                  <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                </div>

              </div><br><br><br>
              <div class="panel-body">
                <!-- Widget content -->
                <div class="col-lg-12 col-md-12">
                  <!-- Below line produces calendar. I am using FullCalendar plugin. -->
                  <div id="calendar"></div>

                </div>

              </div>
              <br> <br>



              <div class="panel panel-default">
                <div class="panel-heading">
                  <h2><i class="fa fa-map-marker red"></i><strong>Countries</strong></h2>
                  <div class="panel-actions">
                    <a href="index.html#" class="btn-setting"><i class="fa fa-rotate-right"></i></a>
                    <a href="index.html#" class="btn-minimize"><i class="fa fa-chevron-up"></i></a>
                    <a href="index.html#" class="btn-close"><i class="fa fa-times"></i></a>
                  </div>
                </div>
                <div class="panel-body-map">
                  <div id="map" style="height:380px;"></div>
                </div>

              </div>
            </div>












            <div class="col-lg-8">

            </div>
          </div><br><br>






          <div class="widget-foot">
            <!-- Footer goes here -->
          </div>
        </div>
        </div>

        </div>

        </div>
        <!-- project team & activity end -->

      </section>

    </section>
    <!--main content end-->
  </section>
  <!-- container section start -->

  <!-- javascripts -->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <!-- nice scroll -->
  <script src="js/jquery.scrollTo.min.js"></script>
  <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
  <!-- charts scripts -->
  <script src="assets/jquery-knob/js/jquery.knob.js"></script>
  <script src="js/jquery.sparkline.js" type="text/javascript"></script>
  <script src="assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
  <script src="js/owl.carousel.js"></script>
  <!-- jQuery full calendar -->
  <<script src="js/fullcalendar.min.js">
    </script>
    <!-- Full Google Calendar - Calendar -->
    <script src="assets/fullcalendar/fullcalendar/fullcalendar.js"></script>
    <!--script for this page only-->
    <script src="js/calendar-custom.js"></script>
    <script src="js/jquery.rateit.min.js"></script>
    <!-- custom select -->
    <script src="js/jquery.customSelect.min.js"></script>
    <script src="assets/chart-master/Chart.js"></script>

    <!--custome script for all page-->
    <script src="js/scripts.js"></script>
    <!-- custom script for this page-->
    <script src="js/sparkline-chart.js"></script>
    <script src="js/easy-pie-chart.js"></script>
    <script src="js/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="js/jquery-jvectormap-world-mill-en.js"></script>
    <script src="js/xcharts.min.js"></script>
    <script src="js/jquery.autosize.min.js"></script>
    <script src="js/jquery.placeholder.min.js"></script>
    <script src="js/gdp-data.js"></script>
    <script src="js/morris.min.js"></script>
    <script src="js/sparklines.js"></script>
    <script src="js/charts.js"></script>
    <script src="js/jquery.slimscroll.min.js"></script>
    <script>
      //knob
      $(function() {
        $(".knob").knob({
          'draw': function() {
            $(this.i).val(this.cv + '%')
          }
        })
      });

      //carousel
      $(document).ready(function() {
        $("#owl-slider").owlCarousel({
          navigation: true,
          slideSpeed: 300,
          paginationSpeed: 400,
          singleItem: true

        });
      });

      //custom select box

      $(function() {
        $('select.styled').customSelect();
      });

      /* ---------- Map ---------- */
      $(function() {
        $('#map').vectorMap({
          map: 'world_mill_en',
          series: {
            regions: [{
              values: gdpData,
              scale: ['#000', '#000'],
              normalizeFunction: 'polynomial'
            }]
          },
          backgroundColor: '#eef3f7',
          onLabelShow: function(e, el, code) {
            el.html(el.html() + ' (GDP - ' + gdpData[code] + ')');
          }
        });
      });
    </script>

</body>

</html>