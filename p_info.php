<?php
include_once("model/conn.php");
session_start();
$get_pat_info = mysqli_query($conn, "SELECT * FROM patient WHERE id={$_GET['id']}");
$row = mysqli_fetch_array($get_pat_info);
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
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
  <!-- <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css"> -->
  <!-- dropzone -->
  <link rel="stylesheet" type="text/css" href="plugins/dropzone/min/dropzone.min.css" />
  <script type="text/javascript" src="plugins/dropzone/min/dropzone.min.js"></script>
  <!-- summernote -->
  <!-- <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css"> -->
  <style>
    /* @media (min-width: 1200px){
    .container-custom {
        max-width: 1200px;
    }
  } */
    .profile-user-img {
      width: 150px;
    }

    /* p.md_info {
      font-size: 20px;
    } */
    table.dataTable tbody td {
      vertical-align: middle !important;
    }

    .dropzone {
      border: 4px dotted rgba(0, 0, 0, .3) !important;
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
              src="<?= $_SESSION['user_photo'] === '' ? 'dist/img/user2-160x160.jpg' : 'uploads/' . $_SESSION['user_photo'] ?>"
              class="img-circle elevation-2" width="30px" alt="<?= $_SESSION['user_lastname'] ?>">
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="#" class="dropdown-item p-3">
              <!-- Message Start -->
              <div class="media flex-column">
                <img
                  src="<?= $_SESSION['user_photo'] === '' ? 'dist/img/user2-160x160.jpg' : 'uploads/' . $_SESSION['user_photo'] ?>"
                  alt="<?= $_SESSION['user_firstname'] ?>" style="width: 70px;" class="img-size-50 mr-3 img-circle">
                <div class="media-body mt-2">
                  <h3 class="dropdown-item-title" style="font-size: 20px;">
                    <?= $_SESSION['user_firstname'] . ' ' . $_SESSION['user_lastname'] ?>
                  </h3>
                  <p class="text-muted my-1"><i class="far fa-envelope mr-1"></i>
                    <?= $_SESSION['user_email'] ?>
                  </p>
                  <?php
                  $post = mysqli_query($conn, "SELECT post FROM post WHERE id='" . $_SESSION['user_postid'] . "'");
                  $postrow = mysqli_fetch_array($post);
                  ?>
                  <p class="text-muted"><i class="far fa-circle mr-1"></i>
                    <?= $postrow['post'] ?>
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

      <!-- content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-3">

              <!-- Profile Image -->
              <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                  <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle"
                      src="<?= $row['photo'] === '' ? 'dist/img/user4-128x128.jpg' : 'uploads/' . $row['photo'] ?>"
                      alt="<?= $row['fname'] ?>">
                  </div>

                  <h3 class="profile-username text-center">
                    <?= $row['fname'] . ' ' . $row['lname'] ?>
                  </h3>

                  <p class="text-muted text-center">ID:
                    <?= $row['id'] ?>
                  </p>

                  <!-- <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Followers</b> <a class="float-right">1,322</a>
                  </li>
                  <li class="list-group-item">
                    <b>Following</b> <a class="float-right">543</a>
                  </li>
                  <li class="list-group-item">
                    <b>Friends</b> <a class="float-right">13,287</a>
                  </li>
                </ul> -->

                  <!-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->

              <!-- About Me Box -->
              <div class="card card-primary">
                <!-- /.card-header -->
                <div class="card-body">
                  <div id="patient_short_table"></div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
              <div class="card">
                <div class="card-header p-2">
                  <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#information" data-toggle="tab">Patient
                        Information</a></li>
                    <li class="nav-item"><a class="nav-link" href="#history" data-toggle="tab">Medical Record</a></li>
                  </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                  <div class="tab-content">
                    <div class="tab-pane active" id="information">
                      <!-- Post -->
                      <div class="post">
                        <p class="font-weight-bold text-dark">Patient Information</p>
                        <div class="row mb-3">
                          <div class="col-12 col-md-3">
                            <p class="mb-0 font-weight-bold small">Date of Birth</p>
                            <p class="text-muted">
                              <?= $row['dob'] ?>
                            </p>
                          </div>
                          <div class="col-12 col-md-3">
                            <p class="small font-weight-bold mb-0">Gender</p>
                            <p class="text-muted">
                              <?= $row['gender'] ?>
                            </p>
                          </div>
                          <div class="col-12 col-md-3">
                            <p class="small mb-0 font-weight-bold">Phone number</p>
                            <p class="text-muted">
                              <?= $row['phone'] ?>
                            </p>
                          </div>
                          <div class="col-12 col-md-3">
                            <p class="small mb-0 font-weight-bold">Email address</p>
                            <p class="text-muted">
                              <?= $row['email'] ?>
                            </p>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <div class="col-12 col-md-6">
                            <p class="small mb-0 font-weight-bold">Residential Address</p>
                            <p class="text-muted">
                              <?= $row['paddress'] ?>
                            </p>
                          </div>
                          <div class="col-12 col-md-3">
                            <p class="small mb-0 font-weight-bold">Postcode</p>
                            <p class="text-muted">
                              <?= $row['postcode'] ?>
                            </p>
                          </div>
                          <div class="col-12 col-md-3">
                            <p class="small mb-0 font-weight-bold">Local Government of residence</p>
                            <p class="text-muted">
                              <?= $row['lga'] ?>
                            </p>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <div class="col-12 col-md-3">
                            <p class="small mb-0 font-weight-bold">City/Town of residence</p>
                            <p class="text-muted">
                              <?= $row['city'] ?>
                            </p>
                          </div>
                          <div class="col-12 col-md-3">
                            <p class="small mb-0 font-weight-bold">State</p>
                            <p class="text-muted">
                              <?= $row['state_res'] ?>
                            </p>
                          </div>
                          <div class="col-12 col-md-3">
                            <p class="small mb-0 font-weight-bold">State of origin</p>
                            <p class="text-muted">
                              <?= $row['state_origin'] ?>
                            </p>
                          </div>
                          <div class="col-12 col-md-3">
                            <p class="small mb-0 font-weight-bold">Local Government of origin</p>
                            <p class="text-muted">
                              <?= $row['lga_origin'] ?>
                            </p>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <div class="col-12 col-md-3">
                            <p class="small mb-0 font-weight-bold">Genotype</p>
                            <p class="text-muted">
                              <?= $row['genotype'] ?>
                            </p>
                          </div>
                          <div class="col-12 col-md-3">
                            <p class="small mb-0 font-weight-bold">Blood Group</p>
                            <p class="text-muted">
                              <?= $row['bloodgroup'] ?>
                            </p>
                          </div>
                          <div class="col-12 col-md-3">
                            <p class="small mb-0 font-weight-bold">Height(cm)</p>
                            <p class="text-muted">
                              <?= $row['height'] ?>
                            </p>
                          </div>
                          <div class="col-12 col-md-3">
                            <p class="small mb-0 font-weight-bold">Weight(kg)</p>
                            <p class="text-muted">
                              <?= $row['pweight'] ?>
                            </p>
                          </div>
                        </div>
                      </div>
                      <!-- /.post -->
                      <div class="post">
                        <p class="font-weight-bold text-dark mt-5">Emergency Contact</p>
                        <div class="row mb-3">
                          <div class="col-12 col-md-3">
                            <p class="mb-0 font-weight-bold small">First Name</p>
                            <p class="text-muted">
                              <?= $row['efname'] ?>
                            </p>
                          </div>
                          <div class="col-12 col-md-3">
                            <p class="small font-weight-bold mb-0">Middle Name</p>
                            <p class="text-muted">
                              <?= $row['emname'] ?>
                            </p>
                          </div>
                          <div class="col-12 col-md-3">
                            <p class="small mb-0 font-weight-bold">Last Name</p>
                            <p class="text-muted">
                              <?= $row['elname'] ?>
                            </p>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <div class="col-12 col-md-3">
                            <p class="mb-0 font-weight-bold small">Date of Birth</p>
                            <p class="text-muted">
                              <?= $row['dob'] ?>
                            </p>
                          </div>
                          <div class="col-12 col-md-3">
                            <p class="small font-weight-bold mb-0">Gender</p>
                            <p class="text-muted">
                              <?= $row['gender'] ?>
                            </p>
                          </div>
                          <div class="col-12 col-md-3">
                            <p class="small mb-0 font-weight-bold">Phone number</p>
                            <p class="text-muted">
                              <?= $row['phone'] ?>
                            </p>
                          </div>
                          <div class="col-12 col-md-3">
                            <p class="small mb-0 font-weight-bold">Email address</p>
                            <p class="text-muted">
                              <?= $row['email'] ?>
                            </p>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <div class="col-12 col-md-6">
                            <p class="small mb-0 font-weight-bold">Residential Address</p>
                            <p class="text-muted">
                              <?= $row['paddress'] ?>
                            </p>
                          </div>
                          <div class="col-12 col-md-3">
                            <p class="small mb-0 font-weight-bold">Postcode</p>
                            <p class="text-muted">
                              <?= $row['postcode'] ?>
                            </p>
                          </div>
                          <div class="col-12 col-md-3">
                            <p class="small mb-0 font-weight-bold">Local Government of residence</p>
                            <p class="text-muted">
                              <?= $row['elga'] ?>
                            </p>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <div class="col-12 col-md-3">
                            <p class="small mb-0 font-weight-bold">City/Town of residence</p>
                            <p class="text-muted">
                              <?= $row['ecity'] ?>
                            </p>
                          </div>
                          <div class="col-12 col-md-3">
                            <p class="small mb-0 font-weight-bold">State</p>
                            <p class="text-muted">
                              <?= $row['estate'] ?>
                            </p>
                          </div>
                          <div class="col-12 col-md-3">
                            <p class="small mb-0 font-weight-bold">State of origin</p>
                            <p class="text-muted">
                              <?= $row['estate_of_origin'] ?>
                            </p>
                          </div>
                          <div class="col-12 col-md-3">
                            <p class="small mb-0 font-weight-bold">Local Government of origin</p>
                            <p class="text-muted">
                              <?= $row['lga_origin'] ?>
                            </p>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <div class="col-12 col-md-3">
                            <p class="small mb-0 font-weight-bold">Relationship</p>
                            <p class="text-muted">
                              <?= $row['erelation'] ?>
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- end post -->


                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="history">

                      <!-- //only registrar cannot see this -->
                      <?php if ($_SESSION['user_postid'] !== '13') { ?>
                        <button type="button" data-toggle="modal" data-target="#add_new_record_modal"
                          class="btn btn-primary mb-4"><i class="fa fa-plus mr-2"></i>Add New Record</button>
                      <?php } ?>

                      <div id="record_table"></div>

                    </div>
                    <!-- /.tab-pane -->
                  </div>
                  <!-- /.tab-content -->
                </div><!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->

          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- end content -->
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
  <div class="modal fade" id="health_info_modal">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-body">
          <div class="row">
            <div class="col-8">
              <h4 class="">
                <?= $row['title'] . ' ' . $row['fname'] . ' ' . $row['mname'] . ' ' . $row['lname'] ?>
              </h4>
              <p class="text-muted md_info" class="">ID:
                <?= $row['id'] ?>
              </p>
            </div>
            <div class="col-4">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          </div>
          <div class="row">
            <div class="col-xl-6">
              <div class="mb-5 mx-0 row">
                <div class="mr-5">
                  <p id="s_date" class="mb-1">Date: 11-12-2020</p>
                  <p id="s_fname" class="mb-1">Medical facility: New Horizon Hospital</p>
                </div>
                <div class="">
                  <p id="s_sname" class="mb-1">Specialist: Segun Oni Ajala</p>
                  <p id="s_spost" class="mb-1">Post: Psychiatrist</p>
                </div>
              </div>
              <div class="mb-4" id="treatment-box" style="background-color: #F5F7FF; padding: 15px;">
                <p class="mb-0 font-weight-bold">Treatment</p>
                <p id="s_treatment">New Horizon</p>
              </div>
              <div class="mb-4" id="presc-box" style="background-color: #F5F7FF; padding: 15px;">
                <p class="font-weight-bold mb-0">Prescription</p>
                <p id="s_prescription">New Horizon</p>
              </div>
              <div class="mb-4" id="diagnosis-box" style="background-color: #F5F7FF; padding: 15px;">
                <p class="font-weight-bold mb-0">Diagnosis</p>
                <p id="s_diagnosis">New Horizon</p>
              </div>
              <div class="mb-4" id="test-box" style="background-color: #F5F7FF; padding: 15px;">
                <p class="font-weight-bold mb-0">Test</p>
                <p id="s_test">New Horizon</p>
              </div>

            </div>
            <!-- <div class="col-xl-6"> -->
            <div class="mb-4 col-xl-6" id="test_file-box">
              <p class="font-weight-bold mb-0">Test file</p>
              <embed id="s_test_file" style="height:100%; width: 100%">
            </div>
            <!-- </div> -->
          </div>


        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="add_new_record_modal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <div class="modal-body">
          <div class="row">
            <div class="col-8">
              <h4 class="">
                <?= $row['fname'] . ' ' . $row['mname'] . ' ' . $row['lname'] ?>
              </h4>
              <p class="text-muted md_info" class="">ID:
                <?= $row['id'] ?>
              </p>
            </div>
            <div class="col-4">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          </div>
          <form class="form" id="record_form" enctype="multipart/form-data">
            <div class="mb-5">
              <label>Diagnosis</label>
              <textarea rows="5" cols="400" name="diagnosis" class="form-control" placeholder="Type here..."></textarea>
            </div>
            <div class="mb-5">
              <label>Treatment</label>
              <textarea rows="5" cols="400" name="treatment" class="form-control" placeholder="Type here..."></textarea>
            </div>
            <div class="mb-3">
              <label>Prescription <i class="font-weight-light">Please note that you can instruct the
                  Specialist-in-charge to make corrections</i></label>
              <textarea rows="5" cols="400"  class="form-control" name="prescription"
                class="form-control" placeholder="Type here..."></textarea>
            </div>
            <div class="form-group">
              <label for="test">Test</label>
              <textarea rows="5" cols="400" class="form-control" name="test"
                placeholder="Type here..."></textarea>
            </div>
            <div class="form-group">
              <div class="btn btn-default btn-file">
                <i class="fas fa-paperclip"></i> Attach Test Result in PDF Format
                <input type="file" accept="image/jpeg,image/png,application/pdf" name="record_file">
              </div>
              <p class="help-block">Max. 10MB</p>
            </div>
            <!-- <div class="mb-3">
              <label for="">Upload Test File</label>
              <input type="file" class="form-control" accept="image/jpeg,image/png,application/pdf" name="record_file">
            </div> -->
            <input type="hidden" name="patid" value="<?= $row['id'] ?>" />
            <input type="hidden" name="action" value="add" />
            <div class="row">
              <div class="col-md-3 col-12 mb-3">
                <button type="submit" class="btn btn-primary w-100" id="record_submit">Submit</button>
              </div>
              <div class="col-md-3 col-12">
                <button type="reset" class="btn btn-outline-primary w-100">Reset</button>
              </div>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>

  <!-- <div class="modal fade" id="edit_record_modal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-body">
        <div class="row">
          <div class="col-8">
        <h4 class=""><=$row['fname'].' '.$row['mname'].' '.$row['lname'] ?></h4>
        <p class="text-muted md_info" class="">ID: <=$row['id'] ?></p>
        </div>
        <div class="col-4">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        </div>
        <form class="form" id="record_edit_form" enctype="multipart/form-data">
        <div class="mb-5">
        <label>Diagnosis</label>
        <textarea rows="5" cols="400" name="diagnosis" class="form-control" id="diagnosis_" placeholder="Type here..."></textarea>
      </div>
      <div class="mb-5">
        <label>Treatment</label>
        <textarea rows="5" cols="400" name="treatment" class="form-control" id="treatment_" placeholder="Type here..."></textarea>
      </div>
      <div class="mb-3">
        <label>Prescription</label>
        <textarea rows="5" cols="400" name="prescription" class="form-control" id="prescription_" placeholder="Type here..."></textarea>
      </div>
      <div class="mb-3">
        <label for="">Test</label>
        <textarea rows="5" cols="400" class="form-control" name="test" id="test_" placeholder="Type here..."></textarea>
      </div>
      <div class="mb-3">
        <label for="">Upload Test File</label>
        <input type="file" class="form-control" id="record_file_" accept="image/*" name="record_file">
      </div>
      <input type="hidden" name = "recordid" id="recordid" />
      <input type="hidden" name = "action" value="update"/>
      <div class="row">
        <div class="col-md-3 col-12 mb-3">
          <button type="submit" class="btn btn-primary w-100" id="record_submit">Submit</button>
        </div>
        <div class="col-md-3 col-12">
          <button type="reset" class="btn btn-outline-primary w-100">Reset</button>
        </div>
      </div>
    </form>  
    </div>
    
    </div>
  </div>
</div> -->
  <!-- modal end -->
  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- DataTables  & Plugins -->
  <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <!-- Summernote -->
  <script src="plugins/summernote/summernote-bs4.min.js"></script>

  <!-- AdminLTE App -->
  <script>
    let patientid = '<?= $row['id'] ?>';
  </script>
  <script src="plugins/toastr/toastr.min.js"></script>
  <script src="dist/js/adminlte.js?v=453"></script>
  <script>
    //Add text editor
    $('#compose-textarea1').summernote()
    $('#compose-textarea2').summernote()
    get_table('record_table', patientid)
    get_table('patient_short_table', '<?= $_SESSION['fa_id'] ?>')
    $(function () {
      $("#patient_short_table_").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": true,
        "buttons": []
      });
    });
  </script>
</body>

</html>