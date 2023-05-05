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
  <title><?=$row['fname'].' '.$row['mname'].' '.$row['lname'] ?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
 
  <style>
    p.md_info {
      font-size: 20px;
    }
    .underline-blue {
      border-bottom: 2px solid var(--primary);
    }
  </style>
</head>
<body class="">
  <div class="container-fluid p-4">
  <!-- <div> -->
    
  <!-- </div> -->

  <div class=" mt-5">
    <div class=" register-card-body">
      <h2 class="mb-5 font-weight-normal">Patient Information</h2>
      <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row  mb-md-5 mb-3">
        <div>
        <img src="uploads/<?=$row['photo']?>" width="180" height="180" style="border-radius: 100%; border: 2px solid #F5F7FF;">
        </div>
        <div class="ml-md-3 mt-4">
          <h3 class="text-dark mb-3"><?=$row['fname'].' '.$row['mname']?><br><?=$row['lname']?></h3>
          <p class="text-muted">ID: <?=$row['id']?></p>
        </div>
      </div>
    <div class="row">
      <div class="col-12 col-md-3">
        <p class="text-dark mb-0 font-weight-bold">Date of Birth</p>
        <p class="text-muted md_info"><?=$row['dob']?></p>
      </div>
      <div class="col-12 col-md-3">
        <p class="text-dark mb-0 font-weight-bold">Gender</p>
        <p class="text-muted md_info"><?=$row['gender']?></p>
      </div>
      <div class="col-12 col-md-3">
        <p class="text-dark mb-0 font-weight-bold">Phone number</p>
        <p class="text-muted md_info"><?=$row['phone']?></p>
      </div>
      <div class="col-12 col-md-3">
        <p class="text-dark mb-0 font-weight-bold">Email address</p>
        <p class="text-muted md_info"><?=$row['email']?></p>
      </div>
    </div>
    <div class="row">
      <div class="col-12 col-md-6">
        <p class="text-dark mb-0 font-weight-bold">Address</p>
        <p class="text-muted md_info"><?=$row['paddress']?></p>
      </div>
      <div class="col-12 col-md-3">
        <p class="text-dark mb-0 font-weight-bold">Postcode</p>
        <p class="text-muted md_info"><?=$row['postcode']?></p>
      </div>
      <div class="col-12 col-md-3">
        <p class="text-dark mb-0 font-weight-bold">Blood group</p>
        <p class="text-muted md_info"><?=$row['bloodgroup']?></p>
      </div>
    </div>
    <div class="row">
      <div class="col-12 col-md-3">
        <p class="text-dark mb-0 font-weight-bold">Genotype</p>
        <p class="text-muted md_info"><?=$row['genotype']?></p>
      </div>
    </div>
    <h3 class="my-md-5 mb-3 mt-5">Emergency Contact</h3>
    <div class="row">
      <div class="col-12 col-md-3">
        <p class="text-dark mb-0 font-weight-bold">Date of Birth</p>
        <p class="text-muted md_info"><?=$row['edob']?></p>
      </div>
      <div class="col-12 col-md-3">
        <p class="text-dark mb-0 font-weight-bold">Gender</p>
        <p class="text-muted md_info"><?=$row['gender']?></p>
      </div>
      <div class="col-12 col-md-3">
        <p class="text-dark mb-0 font-weight-bold">Phone number</p>
        <p class="text-muted md_info"><?=$row['ephone']?></p>
      </div>
      <div class="col-12 col-md-3">
        <p class="text-dark mb-0 font-weight-bold">Email address</p>
        <p class="text-muted md_info"><?=$row['eemail']?></p>
      </div>
    </div>
    <div class="row">
      <div class="col-12 col-md-6">
        <p class="text-dark mb-0 font-weight-bold">Address</p>
        <p class="text-muted md_info"><?=$row['eaddress']?></p>
      </div>
      <div class="col-12 col-md-3">
        <p class="text-dark mb-0 font-weight-bold">Postcode</p>
        <p class="text-muted md_info"><?=$row['epostcode']?></p>
      </div>
      <div class="col-12 col-md-3">
        <p class="text-dark mb-0 font-weight-bold">Relationship</p>
        <p class="text-muted md_info"><?=$row['erelation']?></p>
      </div>
    </div>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
  <div class="">
    <div class="">
      <div class="row text-center">
      <div class="col-12 col-md-6 my-3">
      <h4 class="float-md-left float-left">Medical History</h4>
    </div>
   
    <div class="col-12 col-md-6 my-3">
    <!-- //only registrar cannot see this -->
    <?php if($_SESSION['user_postid'] !== '13') { ?> 
      <button type="button" data-toggle="modal" data-target="#add_new_record_modal" class="btn btn-primary float-md-right float-left"><i class="fa fa-plus mr-2"></i>Add New Record</button>
      <?php } ?>
    </div>  
   
  </div>
  <div id="record_table"></div>
    </div>
  </div>
</div>
<div class="modal fade" id="health_info_modal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row">
          <div class="col-8">
        <h4 class=""><?=$row['title'].' '.$row['fname'].' '.$row['mname'].' '.$row['lname']?></h4>
        <p class="text-muted md_info" class="">ID: <?=$row['id']?></p>
        </div>
        <div class="col-4">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        </div>
        <div class="">
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
      <div class="mb-4" id="test_file-box">
        <p class="font-weight-bold mb-0">Test file</p>
        <embed id="s_test_file" height="700px" style="width: 100%">   
      </div>
        <!-- <div class="mb-5">
        <p>Date</p>
        <p id="s_date">Date: 11-12-2020</p>
          <p>Facility</p>
        <p id="s_fname">New Horizon</p>
      </div>
      <div class="mb-5" id="">
        <p class="underline-blue">Treatment</p>
        <p id="s_treatment">New Horizon</p>      
      </div>
      <div class="mb-3">
        <p class="underline-blue">Prescription</p>
        <p id="s_prescription">New Horizon</p>      
      </div>
      <div class="mb-3">
        <p class="underline-blue">Diagnosis</p>
        <p id="s_diagnosis">New Horizon</p>      
      </div>
      <div class="mb-3">
        <p class="underline-blue">Test</p>
        <p id="s_test">New Horizon</p>      
      </div>
      <div class="mb-3">
        <p>TEST FILE</p>
        <embed id="s_test_file" height="700px" style="width: 100%">   
      </div> -->
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
        <h4 class=""><?=$row['fname'].' '.$row['mname'].' '.$row['lname'] ?></h4>
        <p class="text-muted md_info" class="">ID: <?=$row['id'] ?></p>
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
        <label>Prescription</label>
        <textarea rows="5" cols="400" name="prescription" class="form-control" placeholder="Type here..."></textarea>
      </div>
      <div class="mb-3">
        <label for="">Test</label>
        <textarea rows="5" cols="400" class="form-control" name="test" placeholder="Type here..."></textarea>
      </div>
      <div class="mb-3">
        <label for="">Upload Test File</label>
        <input type="file" class="form-control" accept="image/jpeg,image/png,application/pdf" name="record_file">
      </div>
      <input type="hidden" name = "patid" value="<?=$row['id']?>"/>
      <input type="hidden" name = "action" value="add"/>
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

<div class="modal fade" id="edit_record_modal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-body">
        <div class="row">
          <div class="col-8">
        <h4 class=""><?=$row['fname'].' '.$row['mname'].' '.$row['lname'] ?></h4>
        <p class="text-muted md_info" class="">ID: <?=$row['id'] ?></p>
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
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
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
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script>
let patientid = '<?=$row['id']?>';
</script>
<script src="plugins/toastr/toastr.min.js"></script>
<script src="dist/js/adminlte.js?v=451"></script>
<script>
  get_table('record_table',patientid)
  $(function () {
    $("#record_tab").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": []
    }).buttons().container().appendTo('#record_tab_wrapper .col-md-6:eq(0)');
    // $("#record_tab").DataTable({
    //   "responsive": true, "lengthChange": false, "autoWidth": false,
    //   "buttons": ["pdf", "print"]
    // }).buttons().container().appendTo('#record_tab_wrapper .col-md-6:eq(0)');

  });
</script>
</body>
</html>