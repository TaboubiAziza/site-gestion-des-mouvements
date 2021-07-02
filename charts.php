<?php
session_start();

if (!isset($_SESSION["matricule"])) {
    header('Location: login.php');
    exit();
}

include_once 'conn.php';

$count = '';
$months = '';

$req = "SELECT count(*) as nbr_leaves, MONTHNAME(`from`) as month FROM leavee WHERE leavee.status='accepted' GROUP BY month";
$myquery = mysqli_query($conn, $req);
while ($row = mysqli_fetch_array($myquery)) {
    $months .= "'" . $row['month'] . "',";
    $count .= "'" . $row['nbr_leaves'] . "',";
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

    <title>Charts</title>

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
            <a href="demandleave.php" class="logo"><img src="TUTunisair.png"> <span class="lite">CHARTS</span></a>
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
                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
                <div class="row">
                <div class="col-lg-12">
                <h3 class="page-header"> <i class="icon_piechart"> </i>Statistics </h3>
                </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                Number of leaves by month
                            </div>
                            <div class="card-body text-center">
                                <canvas id="bar" width="900" height="380"></canvas>
                            </div>
                            <script>
                                var ctx = document.getElementById("bar");
                                var myChart = new Chart(ctx, {
                                    type: 'bar',
                                    data: {
                                        labels: [<?php echo $months; ?>],
                                        datasets: [{
                                            label: 'Leaves',
                                            data: [<?php echo $count; ?>],
                                            borderWidth: 2,
                                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                            borderColor: 'rgb(54, 162, 235)',
                                        }]
                                    },
                                    options: {
                                        responsive: true,
                                        legend: {
                                            display: false,
                                        },
                                        scales: {
                                            yAxes: [{
                                                ticks: {
                                                    beginAtZero: true
                                                }
                                            }],
                                            xAxes: [{
                                                barPercentage: 0.5
                                            }],
                                        }
                                    }
                                });
                            </script>
                        </div>
                    </div>

                    <div class="col-12 mt-2">
                        <div class="card">
                            <div class="card-header">
                                Pie chart
                            </div>
                            <div class="card-body text-center">
                                <canvas id="pie" width="900" height="380"></canvas>
                            </div>
                            <script>
                                var ctx = document.getElementById("pie");
                                var myChart = new Chart(ctx, {
                                    type: 'pie',
                                    data: {
                                        labels: [<?php echo $months; ?>],
                                        datasets: [{
                                            label: 'Leaves',
                                            data: [<?php echo $count; ?>],
                                            borderWidth: 2,
                                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                            borderColor: 'rgb(54, 162, 235)',
                                        }]
                                    },
                                    options: {
                                        responsive: true,
                                        legend: {
                                            display: false,
                                        },
                                    }
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </section>
        </section>
        <!-- page end-->
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
    <!-- custom chart script for this page only-->
    <script src="js/scripts.js"></script>


</body>

</html>