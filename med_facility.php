<?php
include_once("model/conn.php");
session_start();
if (!$_SESSION['userid']) {
  header("Location: login.html");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>
    <?= $_SESSION['fa_name'] ?>
  </title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.css">
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
  <!-- DataTables -->
  <!-- <link rel="stylesheet" href="plugins/datatabes-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css"> -->
  <!-- DataTables -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

  <!-- dropzone -->
  <link rel="stylesheet" type="text/css" href="plugins/dropzone/min/dropzone.min.css" />
  <script type="text/javascript" src="plugins/dropzone/min/dropzone.min.js"></script>

  <style>
    /* @media (min-width: 1200px){
    .container-custom {
        max-width: 1200px;
    }
  } */
    /* p.md_info {
      font-size: 20px;
    } */
    .profile-user-img {
      width: 150px;
    }

    /* table.dataTable tbody td {
      vertical-align: middle !important;
    } */
    .dropzone {
      border: 4px dotted rgba(0, 0, 0, .3) !important;
    }

    div.dataTables_wrapper {
      width: 100%;
      margin: 0 auto;
    }

    /* textarea {
      background-color: #F5F7FF !important;
    } */
  </style>
</head>

<body class="hold-transition sidebar-mini layout-navbar-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light ml-0">
      <!-- Left navbar links -->
      <ul class="navbar-nav">

        <li class="nav-item">
          <a href="./?pg=med_facility">
            <img class="mr-3" src="uploads/<?= $_SESSION['fa_logo'] ?>" style="width: 50px; height: 50px;">
          </a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="./?pg=med_facility">
            <p class="nav-link font-weight-bold mb-0" style="font-size: 23px;">
              <?= $_SESSION['fa_name'] ?>
            </p>
          </a>
        </li>

      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">


        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown">
            <i class="mr-2">
              <?= $_SESSION['user_lastname'] ?>
            </i>
            <img
              src="<?=$_SESSION['user_photo'] === '' ? 'dist/img/user2-160x160.jpg' : 'uploads/' . $_SESSION['user_photo'] ?>"
              class="img-circle elevation-2" width="30px" alt="<?= $_SESSION['user_lastname'] ?>">
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="#" class="dropdown-item p-3">
              <!-- Message Start -->
              <div class="media flex-column">
                <img src="<?=$_SESSION['user_photo'] === '' ? 'dist/img/user2-160x160.jpg' : 'uploads/' . $_SESSION['user_photo'] ?>" alt="<?=$_SESSION['user_firstname']?>" style="width: 70px;" class="img-size-50 mr-3 img-circle">
                <div class="media-body mt-2">
                  <h3 class="dropdown-item-title" style="font-size: 20px;">
                    <?= $_SESSION['user_firstname'] . ' ' . $_SESSION['user_lastname'] ?>
                  </h3>
                  <p class="text-muted my-1"><i class="far fa-envelope mr-1"></i>
                    <?= $_SESSION['user_email'] ?>
                  </p>
                  <?php
                  $post = mysqli_query($conn, "SELECT post FROM post WHERE id='" . $_SESSION['user_postid'] . "'");
                  $row = mysqli_fetch_array($post);
                  ?>
                  <p class="text-muted"><i class="far fa-circle mr-1"></i>
                    <?= $row['post'] ?>
                  </p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="./?pg=logout" class="dropdown-item dropdown-footer">Logout</a>
          </div>
        </li>

      </ul>
    </nav>
    <!-- /.navbar -->


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper ml-0">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="d-flex my-3">

            <form class="form" id="search_patient_form">
              <div class="form-group">
                <input type="text" required name="id" placeholder="Search by ID"
                  style="margin-right:9px; float-left; height: 40px; outline: none; border: 1px solid lightgrey; border-radius: 5px; padding: 0px 10px;">
                <input type="submit" style="margin-top: 2px;" class="btn btn-primary float-right"
                  value="Search Patient" />
              </div>
            </form>

          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-8">
              <div class="card card-primary card-outline mb-5">
                <div class="card-body">
                  <div class="card-header mb-4">
                    <h5 class="m-0 float-left">Patient Table</h5>
                    <a href="#add_patient_modal" class="float-right" data-toggle="modal"><i
                        class="fas fa-plus mr-2"></i>Add New Patient</a>
                  </div>
                  <div id="patient_table"></div>
                </div>
              </div>

              <div class="card card-primary card-outline mb-5">
                <div class="card-body">
                  <div class="card-header mb-4">
                    <h5 class="m-0 float-left">Staff Table</h5>
                    <a href="#add_new_user" class="float-right" data-toggle="modal"><i class="fas fa-plus mr-2"></i>Add
                      New Staff</a>
                  </div>

                  <div id="staff_table"></div>
                </div>
              </div><!-- /.card -->
            </div>
            <!-- /.col-md-6 -->
            <div class="col-lg-4">
              <div class="card card-primary mb-5">
                <div class="card-header">
                  <h5 class="m-0">Upload Biometric Data</h5>
                </div>
                <div class="card-body">
                  <div class="panel">
                    <div class="image_upload_div">
                      <form action="controller/biometric_controller.php" enctype="multipart/form-data" class="dropzone"
                        id="my-dropzone">
                        <div class="dz-message">
                          Drop file here or click to upload.<br>
                        </div>
                      </form>
                      <button id="startUpload" class="btn btn-primary mt-3">Upload Biometric File</button>
                    </div>
                  </div>
                </div>
              </div>

              <div class="card card-primary">
                <div class="card-header">
                  <h5 class="m-0">Download Biometric Data</h5>
                </div>
                <div class="card-body">
                  <div id="biometric_table"></div>
                </div>
              </div>
            </div>
            <!-- /.col-md-6 -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- ./wrapper -->
  <!-- modals -->
  <div class="modal fade" id="preview_patient_modal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-body p-0" id="pat_preview_modal_body">
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="add_patient_modal">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <p class="modal-title">Register a New Patient</p>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <form class="form" id="patient_form" enctype="multipart/form-data">
            <div class="row">
              <div class="form-group mb-3 col-md-3 col-12">
                <label>Title<span class="text-danger">*</span></label>
                <select class="form-control" required name="title">
                  <option value="">Select options</option>
                  <option value="Mr.">Mr.</option>
                  <option value="Mrs.">Mrs.</option>
                  <option value="Ms.">Ms.</option>
                  <option value="Dr.">Dr.</option>
                  <option value="Prof.">Prof.</option>
                </select>
              </div>
              <div class="form-group mb-3 col-md-3 col-12">
                <label>First name<span class="text-danger">*</span></label>
                <input type="text" class="form-control" required name="fname" placeholder="First name">
              </div>
              <div class="form-group mb-3 col-md-3 col-12">
                <label>Middle name<span class="text-danger">*</span></label>
                <input type="text" class="form-control" required name="mname" placeholder="Middle name">
              </div>
              <div class="form-group mb-3 col-md-3 col-12">
                <label>Last name<span class="text-danger">*</span></label>
                <input type="text" class="form-control" required name="lname" placeholder="Last name">
              </div>
            </div>
            <div class="row">
              <div class="form-group mb-9 col-md-9 col-12">
                <label>Home address<span class="text-danger">*</span></label>
                <input type="text" class="form-control" required name="address" placeholder="Home address">
              </div>
              <div class="form-group mb-3 col-md-3 col-12">
                <label>LGA(residence)<span class="text-danger">*</span></label>
                <input type="text" class="form-control" required name="lga" placeholder="LGA">
              </div>
              
            </div>
            <div class="row">
            <div class="form-group mb-3 col-md-3 col-12">
                <label>City/Town(residence)<span class="text-danger">*</span></label>
                <input type="text" class="form-control" required name="city" placeholder="City">
              </div>
              <div class="form-group mb-3 col-md-3 col-12">
                <label>State<span class="text-danger">*</span></label>
                <input type="text" class="form-control" required name="state_res" placeholder="State">
              </div>
              <div class="form-group mb-3 col-md-3 col-12">
                <label>State of Origin<span class="text-danger">*</span></label>
                <input type="text" class="form-control" required name="state_origin" placeholder="State of Origin">
              </div>
              <div class="form-group mb-3 col-md-3 col-12">
                <label>LGA(origin)<span class="text-danger">*</span></label>
                <input type="text" class="form-control" required name="lga_origin" placeholder="LGA(origin)">
              </div>
            </div>
            
            <div class="row">
              <div class="col-9">
              <div class="row">
              <div class="form-group mb-3 col-md-4 col-12">
                <label>Phone number<span class="text-danger">*</span></label>
                <input type="text" class="form-control" required name="phone" placeholder="Phone number">
              </div>
              <div class="form-group mb-3 col-md-4 col-12">
                <label>Postcode</label>
                <input type="number" class="form-control" name="postcode" placeholder="Postcode">
              </div>
              <div class="form-group mb-3 col-md-4 col-12">
                <label>Email<span class="text-danger">*</span></label>
                <input type="email" class="form-control" required name="email" placeholder="Email">
              </div>
            </div>
                <div class="row">
                  <div class="form-group mb-3 col-md-4 col-12">
                    <label>Gender<span class="text-danger">*</span></label>
                    <select class="form-control" required name="gender">
                      <option value="">Select options</option>
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                    </select>
                  </div>
                  <div class="form-group mb-3 col-md-4 col-12">
                    <label>Height(ft)</label>
                    <input type="text" class="form-control" name="height" placeholder="Height in ft">
                  </div>
                  <div class="form-group mb-3 col-md-4 col-12">
                    <label>Weight(kg)</label>
                    <input type="text" class="form-control" name="weight" placeholder="Weight in kg">
                  </div>
                </div>

                <div class="row">
                  <div class="form-group mb-3 col-md-4 col-12">
                    <label>Date of birth<span class="text-danger">*</span></label>
                    <input type="date" class="form-control" required name="dob" placeholder="Date of Birth">
                  </div>
                  <div class="form-group mb-3 col-md-4 col-12">
                    <label>Blood Group</label>
                    <select class="form-control" name="blood">
                      <option value="">Select blood group</option>
                      <option value="A+">A+</option>
                      <option value="A-">A-</option>
                      <option value="B+">B+</option>
                      <option value="B-">B-</option>
                      <option value="0+">0+</option>
                      <option value="AB+">AB+</option>
                      <option value="AB-">AB-</option>
                    </select>
                  </div>
                  <div class="form-group mb-3 col-md-4 col-12">
                    <label>Genotype</label>
                    <select class="form-control" name="genotype">
                      <option value="">Select genotype</option>
                      <option value="AA">AA</option>
                      <option value="AS">AS</option>
                      <option value="AC">AC</option>
                      <option value="SS">SS</option>
                      <option value="SC">SC</option>
                      <option value="CC">CC</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                  <label>Upload picture<span class="text-danger">*</span></label>
                  <div class="input-group flex-column">
                    <img id="specialist_p_preview_" src="" width="150" height="150">
                    <input type="file" accept="image/*" class="" required name="photo" id="specialist_photo_"
                      style="width: 150px; margin-top: 22px;">
                  </div>
                </div>
              </div>
            </div>
            <hr>
            <h3 class="my-md-4 mb-3 mt-4">Emergency Contact</h3>
            <div class="row">
              <div class="form-group mb-3 col-md-3 col-12" required name="etitle">
                <label>Title<span class="text-danger">*</span></label>
                <select class="form-control" required name="etitle">
                  <option value="">Select options</option>
                  <option value="Mr.">Mr.</option>
                  <option value="Mrs.">Mrs.</option>
                  <option value="Ms.">Ms.</option>
                  <option value="Dr.">Dr.</option>
                  <option value="Prof.">Prof.</option>
                </select>
              </div>
              <div class="form-group mb-3 col-md-3 col-12">
                <label>First name<span class="text-danger">*</span></label>
                <input type="text" class="form-control" required name="efname" placeholder="First name">
              </div>
              <div class="form-group mb-3 col-md-3 col-12">
                <label>Middle name<span class="text-danger">*</span></label>
                <input type="text" class="form-control" required name="emname" placeholder="Middle name">
              </div>
              <div class="form-group mb-3 col-md-3 col-12">
                <label>Last name<span class="text-danger">*</span></label>
                <input type="text" class="form-control" required name="elname" placeholder="Last name">
              </div>
            </div>
            <div class="row">
              <div class="form-group mb-3 col-md-9 col-12">
                <label>Home address<span class="text-danger">*</span></label>
                <input type="text" class="form-control" required name="eaddress" placeholder="Home address">
              </div>
              <div class="form-group mb-3 col-md-3 col-12">
                <label>Email<span class="text-danger">*</span></label>
                <input type="email" class="form-control" required name="eemail" placeholder="Email">
              </div>
            </div>
            <div class="row">
              <div class="form-group mb-3 col-md-3 col-12">
                <label>Phone number<span class="text-danger">*</span></label>
                <input type="text" class="form-control" required name="ephone" placeholder="Phone number">
              </div>
              <div class="form-group mb-3 col-md-3 col-12">
                <label>Postcode</label>
                <input type="number" class="form-control" name="epcode" placeholder="Postcode">
              </div>
             
              <div class="form-group mb-3 col-md-3 col-12">
                <label>LGA<span class="text-danger">*</span></label>
                <input type="text" class="form-control" required name="elga" placeholder="LGA">
              </div>
              <div class="form-group mb-3 col-md-3 col-12">
                <label>City(residence)<span class="text-danger">*</span></label>
                <input type="text" class="form-control" required name="ecity" placeholder="City">
              </div>
            </div>
            <div class="row">
              <div class="form-group mb-3 col-md-3 col-12">
                <label>State<span class="text-danger">*</span></label>
                <input type="text" class="form-control" required name="estate" placeholder="State">
              </div>
              <div class="form-group mb-3 col-md-3 col-12">
                <label>LGA(origin)<span class="text-danger">*</span></label>
                <input type="text" class="form-control" required name="elga_origin" placeholder="LGA">
              </div>
              <div class="form-group mb-3 col-md-3 col-12">
                <label>State of Origin<span class="text-danger">*</span></label>
                <input type="text" class="form-control" required name="estate_of_origin" placeholder="State of Origin">
              </div>
              <div class="form-group mb-3 col-md-3 col-12">
                <label>Date of birth<span class="text-danger">*</span></label>
                <input type="date" class="form-control" required name="edob" placeholder="Date of Birth">
              </div>
            </div>
            <div class="row">
              
              <div class="form-group mb-3 col-md-3 col-12">
                <label>Relationship<span class="text-danger">*</span></label>
                <input type="text" class="form-control" required name="erelation" placeholder="Relationship">
              </div>
              <div class="form-group mb-3 col-md-3 col-12">
                <label>Blood Group</label>
                <select class="form-control" name="eblood">
                  <option value="">Select blood group</option>
                  <option value="A+">A+</option>
                  <option value="A-">A-</option>
                  <option value="B+">B+</option>
                  <option value="B-">B-</option>
                  <option value="0+">0+</option>
                  <option value="AB+">AB+</option>
                  <option value="AB-">AB-</option>
                </select>
              </div>
              <div class="form-group mb-3 col-md-3 col-12">
                <label>Genotype</label>
                <select class="form-control" name="egenotype">
                  <option value="">Select genotype</option>
                  <option value="AA">AA</option>
                  <option value="AS">AS</option>
                  <option value="AC">AC</option>
                  <option value="SS">SS</option>
                  <option value="SC">SC</option>
                  <option value="CC">CC</option>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3 col-12 my-md-4 mb-3">
                <button type="submit" class="btn btn-primary w-100" id="patient_form_submit">Submit</button>
              </div>
              <div class="col-md-3 col-12 my-md-4">
                <button type="reset" class="btn btn-outline-primary w-100">Reset</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="add_new_user">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <p class="modal-title">Register a New Staff</p>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <form class="form" id="specialist_reg_form" enctype="multipart/form-data">
            <div class="row">
              <div class="mb-3 col-md-3 col-12">
                <div class="form-group">
                  <label>Upload picture<span class="text-danger">*</span></label>
                  <!-- <div class="input-group"> -->
                  <img id="specialist_p_preview" class="d-block" src="" width="150" height="150">
                  <input type="file" accept="image/*" class="" required name="photo" id="specialist_photo"
                    style="width: 150px; margin-top: 22px;">
                  <!-- </div> -->
                </div>
              </div>
              <div class="mb-3 col-md-9 col-12">
                <div class="row">
                  <div class="form-group mb-3 col-md-6 col-12">
                    <label>Title<span class="text-danger">*</span></label>
                    <select class="form-control" name="title" required>
                      <option selected value="">Select options</option>
                      <option value="Mr.">Mr.</option>
                      <option value="Mrs.">Mrs.</option>
                      <option value="Miss.">Miss.</option>
                      <option value="Dr.">Dr.</option>
                      <option value="Prof.">Prof.</option>
                    </select>
                  </div>
                  <div class="form-group mb-3 col-md-6 col-12">
                    <label>First name<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="fname" placeholder="First name" required>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group mb-3 col-md-6 col-12">
                    <label>Middle name<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="mdname" placeholder="Middle name" required>
                  </div>
                  <div class="form-group mb-3 col-md-6 col-12">
                    <label>Last name<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="lname" required placeholder="Last name">
                  </div>
                </div>
                <div class="row">
                  <div class="form-group mb-3 col-12">
                    <label>Home address<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" required name="address" placeholder="Home address">
                  </div>
                </div>
              </div>
            </div>


            <div class="row">
              <div class="form-group mb-3 col-md-3 col-12">
                <label>Email<span class="text-danger">*</span></label>
                <input type="email" class="form-control" required name="email" placeholder="Email">
              </div>
              <div class="form-group mb-3 col-md-3 col-12">
                <label>Phone number<span class="text-danger">*</span></label>
                <input type="text" class="form-control" required name="phone" placeholder="Phone number">
              </div>
              <div class="form-group mb-3 col-md-3 col-12">
                <label>Postcode</label>
                <input type="number" class="form-control" name="pcode" placeholder="Postcode">
              </div>
              <div class="form-group mb-3 col-md-3 col-12">
                <label>Date of birth<span class="text-danger">*</span></label>
                <input type="date" class="form-control" required name="dob" placeholder="Date of Birth">
              </div>
            </div>
            <div class="row">
              <div class="form-group mb-3 col-md-3 col-12">
                <label>Post<span class="text-danger">*</span></label>
                <select class="form-control" required name="post">
                  <option value="">Select post</option>
                  <?php $select_facility = mysqli_query($conn, "SELECT id,post FROM post ORDER BY post ASC");
                  while ($rows = mysqli_fetch_array($select_facility)): ?>
                    <option value="<?= $rows['id'] ?>"><?= $rows['post'] ?></option>
                  <?php endwhile; ?>
                </select>
              </div>
              <input type="hidden" name="facility" value="<?= $_SESSION['fa_id'] ?>">
              <div class="form-group mb-3 col-md-3 col-12">
                <label>Password<span class="text-danger">*</span></label>
                <input type="password" class="form-control" name="password" required
                  placeholder="Type your preffered password">
              </div>
            </div>
            <button type="submit" class="btn btn-primary col-5 my-4" id="specialist_reg_submit">Submit</button>
            <button type="reset" class="btn btn-outline-primary col-2 my-4">Reset</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- modal end -->
  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- DataTables  & Plugins -->
  <!-- <script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script> -->
  <!-- AdminLTE App -->
  <!-- DataTables  & Plugins -->
  <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

  <script>
    let facilityid = '<?= $_SESSION['fa_id'] ?>';
  </script>
  <script src="plugins/toastr/toastr.min.js"></script>
  <script src="dist/js/adminlte.js?v=4124"></script>
  <script>
    get_table('patient_table', '<?= $_SESSION['fa_id'] ?>')
    get_table('staff_table', '<?= $_SESSION['fa_id'] ?>')
    get_table('biometric_table', '<?= $_SESSION['fa_id'] ?>')
    // alert(document.getElementById("startUpload").innerHTML)

    // Dropzone.options.myDropzone = { // The camelized version of the ID of the form element

    //   // The configuration we've talked about above
    //   autoProcessQueue: false,
    //   uploadMultiple: true,
    //   parallelUploads: 100,
    //   maxFiles: 100,

    //   // The setting up of the dropzone
    //   init: function () {
    //     var myDropzone = this;

    //     // First change the button to actually tell Dropzone to process the queue.
    //     this.element.getElementById("startUpload").addEventListener("click", function (e) {
    //       // Make sure that the form isn't actually being sent.
    //       e.preventDefault();
    //       e.stopPropagation();
    //       myDropzone.processQueue();
    //     });
    //     this.on("addedfile", function (file) {
    //       var removeButton = Dropzone.createElement(
    //         "<button class='btn btn-danger'>Remove</button>");

    //       var _this = this;

    //       removeButton.addEventListener("click", function (e) {
    //         e.preventDefault();
    //         e.stopPropagation();

    //         _this.removeFile(file);
    //       })
    //       file.previewElement.appendChild(removeButton);
    //     })

    //     // Listen to the sendingmultiple event. In this case, it's the sendingmultiple event instead
    //     // of the sending event because uploadMultiple is set to true.
    //     this.on("sendingmultiple", function () {
    //       alert('sending')
    //       // Gets triggered when the form is actually being sent.
    //       // Hide the success button or the complete form.
    //     });
    //     this.on("successmultiple", function (files, response) {
    //       alert('sent')
    //       // Gets triggered when the files have successfully been sent.
    //       // Redirect user or notify of success.
    //     });
    //     this.on("errormultiple", function (files, response) {
    //       alert('error')
    //       // Gets triggered when there was an error sending the files.
    //       // Maybe show form again, and notify user of error
    //     });
    //   }

    // }


    //Disabling autoDiscover
    Dropzone.autoDiscover = false;
    Dropzone.options.myDropzone = {
      init: function () {
        this.on("addedfile", function (file) {
          var removeButton = Dropzone.createElement(
            "<button class='btn btn-danger' id='remove_uploaded'>Remove</button>");

          var _this = this;

          removeButton.addEventListener("click", function (e) {
            e.preventDefault();
            e.stopPropagation();

            _this.removeFile(file);
          })
          file.previewElement.appendChild(removeButton);
        })
        this.on("sending", function (file, xhr, formData) {
          formData.append('action', 'upload_biofile')
          $("#startUpload").attr("disabled", true)
          // Gets triggered when the form is actually being sent.
          // Hide the success button or the complete form.
        });
        this.on("success", function (file, responseText) {
          // console.log(responseText)

          responseText = responseText.trim()
          if (responseText == 'Successfully uploaded') {
            toastr.info(responseText)
            $("#remove_uploaded").click()
            $("#startUpload").attr("disabled", false)
            get_table('biometric_table', '<?= $_SESSION['fa_id'] ?>')
          }
          // file.previewTemplate.appendChild(document.createTextNode(responseText))
        })
      }
    }

    // $(function() {
    //Dropzone class
    var myDropzone = new Dropzone(".dropzone", {
      // url: "controller/biometric_controller.php",
      paramName: "file",
      autoProcessQueue: false,
      // uploadMultiple: true,
      // parallelUploads: 100,
      maxFiles: 1,
    });


    $('#startUpload').click(function () {
      myDropzone.processQueue();
    });
    // });
  </script>
</body>

</html>


<!-- $(function () {
    // $("#biometric_table").DataTable({
    //   "responsive": true, "lengthChange": false, "autoWidth": false,
    //   "buttons": []
    // }).buttons().container().appendTo('#biometric_table_wrapper .col-md-6:eq(0)');

    // $("#biometric_table").DataTable({
    //   "responsive": true, "lengthChange": false, "autoWidth": false,
    //   "buttons": []
    // }).buttons().container().appendTo('#biometric_table_wrapper .col-md-6:eq(0)');

    Dropzone.autoDiscover = false;
    Dropzone.options.myDropzone = {
        init: function() {
            this.on("addedfile", function(file) {
                var removeButton = Dropzone.createElement(
                    "<button class='btn btn-danger'>Remove</button>");

                var _this = this;

                removeButton.addEventListener("click", function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    _this.removeFile(file);
                })
                file.previewElement.appendChild(removeButton);
            })
            this.on("success", function(file, responseText) {
                console.log(responseText)
                responseText = responseText.trim()
                if(responseText == 'yes') {
                    alert(responseText)
                }
                // file.previewTemplate.appendChild(document.createTextNode(responseText))
            })
        }
    }
  $(function() {
        //Dropzone class
        var myDropzone = new Dropzone(".dropzone", {
            url: "upload.php",
            paramName: "file",
            maxFilesize: 2,
            maxFiles: 100,
            // uploadMultiple: true,
            parallelUploads: 100,
            acceptedFiles: "image/*,application/pdf",
            autoProcessQueue: false
        });


        $('#startUpload').click(function() {
            myDropzone.processQueue();
        });
    });
  }); -->