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

  <title>Users</title>

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
      <a href="index.html" class="logo"><img src="TUTunisair.png"> <span class="lite">Users</span></a>
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
            <h3 class="page-header"><i class="fa fa-table"></i> Users</h3>
            <p style="text-align: left;">
              <a class="user" style="text-align: left;">
                <button data-toggle="modal" data-target="#ajout" type="button" class="btn btn-success" id="myBtn" title='Add' href="#"> <i class="fas fa-user-plus"></i></button>
              </a>
            </p>
            <div class="table-responsive">
            <table class="table table-striped table-advance table-hover" id="table">

              <thead>
                <tr>
                  <th>Matricule</th>
                  <th>Cin</th>
                  <th><i class="icon_profile"></i>Name</th>
                  <th><i class="icon_profile"></i>LastName</th>
                  <th> Employment</th>
                  <th> Service</th>
                  <th> Place</th>
                  <th> EntryDate</th>
                  <th> Action </th>
                </tr>
              </thead>
              <tbody>

                <?php
                include_once 'conn.php';

                $myquery = mysqli_query($conn,  "SELECT * FROM " . USERS_TBL . " WHERE role!=1");

                while ($row = mysqli_fetch_array($myquery)) {
                  echo "<tr data-cin='" . $row['cin'] . "' data-role='" . $row['role'] . "' data-email='" . $row['email'] . "' 
                  data-employment='" . $row['employment'] . "' data-password='" . $row['password'] . "' data-name='" . $row['name'] . "' data-lastname='" . $row['lastname'] . "' data-cnsscnpsnum='" . $row['cnsscnpsnum'] . "'
                  data-gender='" . $row['gender'] . "' data-birthdate='" . $row['birthdate'] . "' data-position='" . $row['position'] . "' data-corps='" . $row['corps'] . "'
                  data-status='" . $row['status'] . "' data-direction='" . $row['direction'] . "' data-entity='" . $row['entity'] . "'  data-affiliate='" . $row['affiliate'] . "'
                  data-leavebalance='" . $row['leavebalance'] . "' data-authorizationbalance='" . $row['authorizationbalance'] . "'
                  data-service='" . $row['service'] . "' data-place='" . $row['place'] . "' data-entrydate='" . $row['entrydate'] . "'>";
                  echo "<td>" . $row['matricule'] . "</td>";
                  echo "<td>" . $row['cin'] . "</td>";
                  echo "<td>" . $row['name'] . "</td>";
                  echo "<td>" . $row['lastname'] . "</td>";
                  echo "<td>" . $row['employment'] . "</td>";
                  echo "<td>" . $row['service'] . "</td>";
                  echo "<td>" . $row['place'] . "</td>";
                  echo "<td>" . $row['entrydate'] . "</td>";
                  echo "<td>  <div class='btn-group'>
<a data-id='" . $row['matricule'] . "' class='mr-2 btnEdit'>
  <button type='button' class='btn btn-success' title='Edit'>
   <i class='fas fa-edit'></i>
  </button>
</a>
<a class='btnDelete' href='del.php?matricule=" . $row['matricule'] . "'>  
  <button type='button' class='btn btn-danger' title='Delete' id='myBtn2' >
   <i class='fas fa-user-times'></i>
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
                    <h5 class="modal-title">Add User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>

                  <form action="insert.php" method="POST">
                    <div class="modal-body">
                      <div class="row">
                        <div class="form-group col-6">
                          <label for="matricule "><b>Matricule </b></label>
                          <input class="form-control" type="text" name="matricule" required>
                        </div>
                        <div class="form-group col-6">
                          <label for="cin"><b>Cin</b></label>
                          <input class="form-control" type="text" name="cin" required>
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-6">
                          <label for="email"><b>Email</b></label>
                          <input class="form-control" type="text" name="email" required>
                        </div>
                        <div class="form-group col-6">
                          <label for="password"><b>Password</b></label>
                          <input class="form-control" type="text" name="password">
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-6">
                          <label for="name"><b>Name</b></label>
                          <input class="form-control" type="text" name="name">
                        </div>
                        <div class="form-group col-6">
                          <label for="lastname"><b>Last Name</b></label>
                          <input class="form-control" type="text" name="lastname">
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-6">
                          <label for="role"><b>Role</b></label>
                          <select class="form-control" name="role" id="role">
                            <option value="">Select option</option>
                            <option value="0">employee</option>
                            <option value="1">administrator</option>
                            <option value="2">superior</option>
                            <option value="3">RH manager</option>
                          </select>
                        </div>

                        <div class="form-group col-6">
                          <label for="cnsscnpsnum"><b>cnss/cnps Number</b></label>
                          <input class="form-control" type="text" name="cnsscnpsnum">
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-6">
                          <label for="gender"><b>gender</b></label>
                          <select class="form-control" name="gender" id="gender">
                            <option value="">Select option</option>
                            <option value="male">male</option>
                            <option value="female">female</option>
                          </select>
                        </div>
                        <div class="form-group col-6">
                          <label for="birthdate"><b>Birthdate</b></label>
                          <input class="form-control" type="date" name="birthdate">
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-6">
                          <label for="entrydate"><b>Entrydate</b></label>
                          <input class="form-control" type="date" name="entrydate">
                        </div>
                        <div class="form-group col-6">
                          <label for="position"><b>Position</b></label>
                          <select class="form-control" name="position" id="position">
                            <option value="">Select option</option>
                            <option value="active">active</option>
                            <option value="parttime">parttime</option>
                            <option value="onholiday">onholiday</option>
                            <option value="suspended">suspended</option>
                          </select>
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-6">
                          <label for="employment"><b>Employement</b></label>
                          <select class="form-control" name="employment" id="employment">
                            <option value="">Select option</option>
                            <option value="employee">employee</option>
                            <option value="director">director</option>
                            <option value="administrator">administrator</option>
                            <option value="pdg">pdg</option>
                          </select>
                        </div>
                        <div class="form-group col-6">
                          <label for="corps"><b>Corps</b></label>
                          <select class="form-control" name="corps" id="corps">
                            <option value="">Select option</option>
                            <option value="pss">pss</option>
                            <option value="pst">pst</option>
                            <option value="pse">pse</option>
                            <option value="pnc">pnc</option>
                            <option value="pnt">pnt</option>
                            <option value="ple">ple</option>
                          </select>
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-6">
                          <label for="status"><b>status</b></label>
                          <select class="form-control" name="status" id="status">
                            <option value="">Select option</option>
                            <option value="ca">CA</option>
                            <option value="st">ST</option>
                            <option value="cf">CF</option>
                            <option value="cs">CS</option>
                            <option value="so">SO</option>
                            <option value="dm">DM</option>
                            <option value="do">DO</option>
                            <option value="du">DU</option>
                            <option value="ss">SS</option>
                          </select>
                        </div>
                        <div class="form-group col-6">
                          <label for="direction"><b>Direction</b></label>
                          <select class="form-control" name="direction" id="direction">
                            <option value="">Select option</option>
                            <option value="central">central</option>
                            <option value="central">central</option>
                          </select>
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group col-6">
                          <label for="entity"><b>Entity</b></label>
                          <select class="form-control" name="entity" id="entity">
                            <option value="">Select option</option>
                            <option value="sol">sol</option>
                            <option value="navigant">navigant</option>
                          </select>
                        </div>
                        <div class="form-group col-6">
                          <label for="place"><b>Place</b></label>
                          <select class="form-control" name="place" id="place">
                            <option value="">Select option</option>
                            <option value="siege">siege</option>
                            <option value="tunis">tunis</option>
                            <option value="sfax">sfax</option>
                          </select>
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-6">
                          <label for="service "><b>Service </b></label>
                          <select class="form-control" name="service" id="service">
                            <option value="">Select option</option>
                            <option value="informatique">informatique</option>
                            <option value="ressourceshumaines">ressourceshumaines</option>
                            <option value="centremedical">centremedical</option>
                          </select>

                        </div>
                        <div class="form-group col-6">
                          <label for="affiliate"><b>Affiliate</b></label>
                          <select class="form-control" name="affiliate" id="affiliate">
                            <option value="">Select option</option>
                            <option value="Tunisair-Express">Tunisair-Express</option>
                            <option value="Tunisair-Catering">Tunisair-Catering</option>
                            <option value="Tunisair-Handling">Tunisair-Handling</option>
                            <option value="Tunisair-Techniques">Tunisair-Techniques</option>
                          </select>
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-6">
                          <label for="leavebalance "><b>Leave Balance</b></label>
                          <input class="form-control" type="text" name="leavebalance">
                        </div>
                        <div class="form-group col-6">
                          <label for="authorizationbalance"><b>Authorization Balance</b></label>
                          <input class="form-control" type="text" name="authorizationbalance">
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
          </div>
        </div>


        <!-- Edit user modal -->
        <div id="edit" class="modal" tabindex="-1" role="dialog">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form id="editForm" action="edit.php" method="POST">
                <div class="modal-body">
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="matricule"><b>Matricule </b></label>
                      <input class="form-control" name="matricule-disabled" type="text" disabled>
                    </div>
                    <div class="form-group col-6">
                      <label for="cin"><b>Cin</b></label>
                      <input class="form-control" type="text" name="cin" required>
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-6">
                      <label for="email"><b>Email</b></label>
                      <input class="form-control" type="text" name="email" required>
                    </div>
                    <div class="form-group col-6">
                      <label for="password"><b>Password</b></label>
                      <input class="form-control" type="text" name="password">
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="name"><b>Name</b></label>
                      <input class="form-control" type="text" name="name">
                    </div>
                    <div class="form-group col-6">
                      <label for="lastname"><b>Last Name</b></label>
                      <input class="form-control" type="text" name="lastname">
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-6">
                      <label for="role"><b>Role</b></label>
                      <select class="form-control" name="role" id="role">
                        <option value="0">employee</option>
                        <option value="1">administrator</option>
                        <option value="2">superior</option>
                        <option value="3">RH manager</option>
                      </select>
                    </div>

                    <div class="form-group col-6">
                      <label for="cnsscnpsnum"><b>cnss/cnps Number</b></label>
                      <input class="form-control" type="text" name="cnsscnpsnum">
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-6">
                      <label for="gender"><b>gender</b></label>
                      <select class="form-control" name="gender" id="gender">
                        <option value="male">male</option>
                        <option value="female">female</option>
                      </select>
                    </div>
                    <div class="form-group col-6">
                      <label for="birthdate"><b>Birthdate</b></label>
                      <input class="form-control" type="date" name="birthdate">
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-6">
                      <label for="entrydate"><b>Entrydate</b></label>
                      <input class="form-control" type="date" name="entrydate">
                    </div>
                    <div class="form-group col-6">
                      <label for="position"><b>Position</b></label>
                      <select class="form-control" name="position" id="position">

                        <option value="active">active</option>
                        <option value="parttime">parttime</option>
                        <option value="onholiday">onholiday</option>
                        <option value="suspended">suspended</option>
                      </select>
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-6">
                      <label for="employment"><b>Employement</b></label>
                      <select class="form-control" name="employment" id="employment">

                        <option value="employee">employee</option>
                        <option value="director">director</option>
                        <option value="administrator">administrator</option>
                        <option value="pdg">pdg</option>
                      </select>
                    </div>
                    <div class="form-group col-6">
                      <label for="corps"><b>Corps</b></label>
                      <select class="form-control" name="corps" id="corps">

                        <option value="pss">pss</option>
                        <option value="pst">pst</option>
                        <option value="pse">pse</option>
                        <option value="pnc">pnc</option>
                        <option value="pnt">pnt</option>
                        <option value="ple">ple</option>
                      </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="status"><b>status</b></label>
                      <select class="form-control" name="status" id="status">

                        <option value="ca">CA</option>
                        <option value="st">ST</option>
                        <option value="cf">CF</option>
                        <option value="cs">CS</option>
                        <option value="so">SO</option>
                        <option value="dm">DM</option>
                        <option value="do">DO</option>
                        <option value="du">DU</option>
                        <option value="ss">SS</option>
                      </select>
                    </div>
                    <div class="form-group col-6">
                      <label for="direction"><b>Direction</b></label>
                      <select class="form-control" name="direction" id="direction">

                        <option value="central">central</option>
                        <option value="central">central</option>
                      </select>
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-6">
                      <label for="entity"><b>Entity</b></label>
                      <select class="form-control" name="entity" id="entity">
                        <option value="sol">sol</option>
                        <option value="navigant">navigant</option>
                      </select>
                    </div>
                    <div class="form-group col-6">
                      <label for="place"><b>Place</b></label>
                      <select class="form-control" name="place" id="place">
                        <option value="siege">siege</option>
                        <option value="tunis">tunis</option>
                        <option value="sfax">sfax</option>
                      </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="service "><b>Service </b></label>
                      <select class="form-control" name="service" id="service">
                        <option value="informatique">informatique</option>
                        <option value="ressourceshumaines">ressourceshumaines</option>
                        <option value="centremedical">centremedical</option>
                      </select>

                    </div>
                    <div class="form-group col-6">
                      <label for="affiliate"><b>Affiliate</b></label>
                      <select class="form-control" name="affiliate" id="affiliate">

                        <option value="Tunisair-Express">Tunisair-Express</option>
                        <option value="Tunisair-Catering">Tunisair-Catering</option>
                        <option value="Tunisair-Handling">Tunisair-Handling</option>
                        <option value="Tunisair-Techniques">Tunisair-Techniques</option>
                      </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="leavebalance "><b>Leave Balance</b></label>
                      <input class="form-control" type="text" name="leavebalance">
                    </div>
                    <div class="form-group col-6">
                      <label for="authorizationbalance"><b>Authorization Balance</b></label>
                      <input class="form-control" type="text" name="authorizationbalance">
                    </div>
                  </div>
                  <input class="form-control" type="text" name="matricule" hidden>
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
  <script src="js/users.js"></script>
</body>

</html>