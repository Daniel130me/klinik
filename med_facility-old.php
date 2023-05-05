<?php
include_once("model/conn.php");
session_start();
if(!$_SESSION['userid']) {
  header("Location: login.html");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?=$_SESSION['fa_name']?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatabes-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
 
  <style>
    /* @media (min-width: 1200px){
    .container-custom {
        max-width: 1200px;
    }
  } */
    p.md_info {
      font-size: 20px;
    }
    table.dataTable tbody td {
      vertical-align: middle !important;
    }
    /* textarea {
      background-color: #F5F7FF !important;
    } */
  </style>
</head>
<body class="">
<div class="">
<div class="container mx-auto p-4">
  <!-- <div> -->
    <div class="d-flex align-items-md-center">
      <img class="mr-3" src="uploads/<?=$_SESSION['fa_logo']?>" style="width: 50px; height: 50px;">
    <h2 class="my-5"><?=$_SESSION['fa_name']?></h2>
  </div>
  <div class="d-flex align-items-center">
      <div>
          <form class="form" id="search_patient_form">
              <div class="form-group">
                <input type="text" required name="id" placeholder="Search by ID" style="height: 40px; outline: none; border: 1px solid lightgrey; border-radius: 5px; padding: 0px 10px;">
              <input type="submit" class="btn btn-primary mt-3 mt-md-0" value="Search Patient"/>
                </div>
          </form>
      </div>
  </div>
  <!-- <div class="d-none d-md-flex flex-wrap mt-3">
    
    <div class="mr-0 mr-md-3 mt-3 mt-md-0">
      <a href="" >Upload Biometric Information</button> 
    </div>
    <div class="mr-0 mr-md-3 mt-3 mt-md-0">
      <a href="">Download Biometric Information</a>     
      </div>
      <div class="mt-3 mt-md-0">
        <a href="./?pg=logout">Logout</a>     
      </div>
  </div> -->
  <div class="dropdown d-block d-md-none">
    <a class="" data-toggle="dropdown" href="#" aria-expanded="true">
      <i class="far fa-bell"></i>More actions
    </a>
    <div class="dropdown-menu dropdown-menu-lg">
      <!-- <a href="#" class="dropdown-item">Add New Patient
      </a> -->
      <!-- <div class="dropdown-divider"></div> -->
      <a href="#" class="dropdown-item">Upload Biometric Information
      </a>
      <!-- <div class="dropdown-divider"></div> -->
      <a href="#" class="dropdown-item">Download Biometric Information
      </a>
      <div class="dropdown-divider"></div>
      <a href="#" class="dropdown-item">Logout</a>
    </div>
  </div>
  <div class="row justify-content-between">
    <div class="col-8 flex-grow-2">
  <div class="mt-5">
    <div class="d-flex justify-content-between align-items-center">
      <h4 class="">Patient Info</h4>
      <!-- <a href="#add_patient_modal" data-toggle="modal"><i class="fas fa-plus mr-2"></i>Add New Patient</a> -->
    </div>
    <div id="patient_table"></div>
  </div>
  <div class="mt-5">
    <div class="d-flex justify-content-between align-items-center">
      <h4 class="">Staff Info</h4>
      <!-- <a href="#add_new_user" data-toggle="modal"><i class="fas fa-plus mr-2"></i>Add New Staff</a> -->
    </div>
    <div id="staff_table"></div>
  </div>
  </div>
  <div class="col-3" style="flex-grow-1">
<div class="mt-5" style="background-color: aliceblue; padding: 30px;">
  <div class="mb-4">
  <a href="#add_patient_modal" data-toggle="modal"><i class="fas fa-plus mr-2"></i>Add New Patient</a>
    </div>
    <div class="mb-4">
    <a href="#add_new_user" data-toggle="modal"><i class="fas fa-plus mr-2"></i>Add New Staff</a>
    </div>
  <div class="mb-4">
      <a href="" ><i class="fas fa-plus mr-2"></i>Upload Biometric Information</a> 
    </div>
    <div class="mb-4">
      <a href="./?pg=download"><i class="fas fa-plus mr-2"></i>Download Biometric Information</a>     
      </div>
      <div class="">
        <a href="./?pg=logout"><i class="fas fa-plus mr-2"></i>Logout</a>     
      </div>
  </div>
  </div>
  </div>


</div>
  </div>
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
      <select class="form-control" required name = "title">
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
    <input type="text" class="form-control" required name = "fname" placeholder="First name">
  </div>
  <div class="form-group mb-3 col-md-3 col-12">
      <label>Middle name<span class="text-danger">*</span></label>
      <input type="text" class="form-control" required name = "mname" placeholder="Middle name">
  </div>
  <div class="form-group mb-3 col-md-3 col-12">
      <label>Last name<span class="text-danger">*</span></label>
      <input type="text" class="form-control" required name = "lname"  placeholder="Last name">
  </div>
  </div>
  <div class="row">
      <div class="form-group mb-3 col-md-6 col-12">
          <label>Home address<span class="text-danger">*</span></label>
          <input type="text" class="form-control" required name = "address" placeholder="Home address">
      </div>
      <div class="form-group mb-3 col-md-3 col-12">
          <label>LGA<span class="text-danger">*</span></label>
          <input type="text" class="form-control" required name = "lga" placeholder="LGA">
      </div>
      <div class="form-group mb-3 col-md-3 col-12">
          <label>Email<span class="text-danger">*</span></label>
          <input type="email" class="form-control" required name = "email" placeholder="Email">
      </div>
  </div>
  <div class="row">
      <div class="col-9">
          <div class="row">
              <div class="form-group mb-3 col-md-4 col-12">
                  <label>Gender<span class="text-danger">*</span></label>
                  <select class="form-control" required name = "gender">
                      <option value="">Select options</option>
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                  </select>
              </div>
              <div class="form-group mb-3 col-md-4 col-12">
                  <label>Height(ft)</label>
                  <input type="text" class="form-control" name ="height"  placeholder="Height in ft">
              </div>
              <div class="form-group mb-3 col-md-4 col-12">
                  <label>Weight(kg)</label>
                  <input type="text" class="form-control" name = "weight" placeholder="Weight in kg">
              </div>
          </div>
  <div class="row">
      <div class="form-group mb-3 col-md-4 col-12">
          <label>Phone number<span class="text-danger">*</span></label>
          <input type="text" class="form-control" required name = "phone" placeholder="Phone number">
      </div>
      <div class="form-group mb-3 col-md-4 col-12">
          <label>Postcode</label>
          <input type="number" class="form-control" name ="postcode"  placeholder="Postcode">
      </div>
      <div class="form-group mb-3 col-md-4 col-12">
          <label>State of Origin<span class="text-danger">*</span></label>
          <input type="text" class="form-control" required name = "origin" placeholder="State of Origin">
      </div>
  </div>
  <div class="row">
      <div class="form-group mb-3 col-md-4 col-12">
          <label>Date of birth<span class="text-danger">*</span></label>
          <input type="date" class="form-control" required name = "dob" placeholder="Date of Birth">
      </div>
      <div class="form-group mb-3 col-md-4 col-12">
          <label>Blood Group</label>
          <select class="form-control" name = "blood">
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
          <select class="form-control" name = "genotype">
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
                  <input type="file" accept="image/*" class="" required name="photo" id="specialist_photo_" style="width: 150px; margin-top: 22px;">
              </div>
            </div>
        </div>
  </div>
  <hr>
  <h3 class="my-md-4 mb-3 mt-4">Emergency Contact</h3>
  <div class="row">
      <div class="form-group mb-3 col-md-3 col-12" required name = "etitle">
          <label>Title<span class="text-danger">*</span></label>
      <select class="form-control" required name = "etitle">
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
    <input type="text" class="form-control" required name = "efname" placeholder="First name">
  </div>
  <div class="form-group mb-3 col-md-3 col-12">
      <label>Middle name<span class="text-danger">*</span></label>
      <input type="text" class="form-control" required name = "emname" placeholder="Middle name">
  </div>
  <div class="form-group mb-3 col-md-3 col-12">
      <label>Last name<span class="text-danger">*</span></label>
      <input type="text" class="form-control" required name = "elname" placeholder="Last name">
  </div>
  </div>
  <div class="row">
      <div class="form-group mb-3 col-md-9 col-12">
          <label>Home address<span class="text-danger">*</span></label>
          <input type="text" class="form-control" required name = "eaddress" placeholder="Home address">
      </div>
      <div class="form-group mb-3 col-md-3 col-12">
          <label>Email<span class="text-danger">*</span></label>
          <input type="email" class="form-control" required name = "eemail" placeholder="Email">
      </div>
  </div>
  <div class="row">
      <div class="form-group mb-3 col-md-3 col-12">
          <label>Phone number<span class="text-danger">*</span></label>
          <input type="text" class="form-control" required name = "ephone" placeholder="Phone number">
      </div>
      <div class="form-group mb-3 col-md-3 col-12">
          <label>Postcode</label>
          <input type="number" class="form-control" name = "epcode" placeholder="Postcode">
      </div>
      <div class="form-group mb-3 col-md-3 col-12">
          <label>State of Origin<span class="text-danger">*</span></label>
          <input type="text" class="form-control" required name = "eorigin" placeholder="State of Origin">
      </div>
      <div class="form-group mb-3 col-md-3 col-12">
          <label>LGA<span class="text-danger">*</span></label>
          <input type="text" class="form-control" required name = "elga" placeholder="LGA">
      </div>
  </div>
  <div class="row">
      <div class="form-group mb-3 col-md-3 col-12">
          <label>Date of birth<span class="text-danger">*</span></label>
          <input type="date" class="form-control" required name = "edob" placeholder="Date of Birth">
      </div>
      <div class="form-group mb-3 col-md-3 col-12">
          <label>Relationship<span class="text-danger">*</span></label>
          <input type="text" class="form-control" required name = "erelation" placeholder="Relationship">
      </div>
      <div class="form-group mb-3 col-md-3 col-12">
          <label>Blood Group</label>
          <select class="form-control" name = "eblood">
              <option value="">Select blood group</option>
              <option value="A+">A+</option>
              <option value="A-">A-</option>
              <option value="B+">B+</option>
              <option value="B-">B-</option>
              <option value="0+">0+</option>
              <option value="AB+">AB+</option>
              <option value="AB-">AB-</option>
          </select>            </div>
      <div class="form-group mb-3 col-md-3 col-12">
          <label>Genotype</label>
          <select class="form-control" name = "egenotype">
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
                <img id="specialist_p_preview" src="" width="150" height="150">
                  <input type="file" accept="image/*" class="" required name="photo" id="specialist_photo" style="width: 150px; margin-top: 22px;">
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
                while($rows = mysqli_fetch_array($select_facility)):?>
                  <option value="<?=$rows['id']?>"><?=$rows['post']?></option>
                <?php endwhile; ?>
            </select>
        </div>
       
        <!-- <div class="form-group mb-3 col-md-3 col-12">
          <label>Health Facility<span class="text-danger">*</span></label>
          <select class="form-control" required name="facility">
            <option selected value="">Select Facility</option>
            <php $select_facility = mysqli_query($conn, "SELECT id,fname FROM facility ORDER BY fname ASC");
            while($rows = mysqli_fetch_array($select_facility)):?>
              <option value="<=$rows['id']?>"><=$rows['fname']?></option>
            <php endwhile; ?>
        </select>      
      </div> -->
      <input type="hidden" name="facility" value="<?=$_SESSION['fa_id']?>">
        <div class="form-group mb-3 col-md-3 col-12">
            <label>Password<span class="text-danger">*</span></label>
            <input type="password" class="form-control" name="password" required placeholder="Type your preffered password">
        </div>
        </div>
            <button type="submit" class="btn btn-primary col-5 my-4" id="specialist_reg_submit">Submit</button>
            <button type="reset" class="btn btn-outline-primary col-2 my-4">Reset</button>
      </form>
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
        <h4 class="">Olayinka Oluwagbenga Ajala</h4>
        <p class="text-muted md_info" class="">ID: 123456</p>
        </div>
        <div class="col-4">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        </div>
        <form class="form">
        <div class="mb-5">
        <p>Diagnosis</p>
        <textarea rows="5" cols="400" class="form-control" placeholder="Type here..." style="background-color: #F5F7FF;"></textarea>
      </div>
      <div class="mb-5">
        <p>Treatment</p>
        <textarea rows="5" cols="400" class="form-control" placeholder="Type here..."></textarea>
      </div>
      <div class="mb-3">
        <p>Prescription</p>
        <textarea rows="5" cols="400" class="form-control" placeholder="Type here..."></textarea>
      </div>
      <div class="mb-3">
        <p>Test</p>
        <textarea rows="5" cols="400" class="form-control" placeholder="Type here..."></textarea>
      </div>
      <div class="mb-3">
        <p>Test</p>
        <input type="file" class="form-control" accept="image/*" name="record_file">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
      <button type="reset" class="btn btn-outline-primary">Reset</button>
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
let facilityid = '<?=$_SESSION['fa_id']?>';
</script>
<script src="plugins/toastr/toastr.min.js"></script>
<script src="dist/js/adminlte.js?v=4123"></script>
<script>
get_table('patient_table','<?=$_SESSION['fa_id']?>') 
get_table('staff_table','<?=$_SESSION['fa_id']?>') 

  $(function () {
    $("#patient_info_table").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": []
    }).buttons().container().appendTo('#patient_info_table_wrapper .col-md-6:eq(0)');


    
    // $('#staff_info_table').DataTable({
    //   "paging": true,
    //   "lengthChange": false,
    //   "searching": false,
    //   "ordering": true,
    //   "info": true,
    //   "autoWidth": false,
    //   "responsive": true,
    // });
    // $('#patient_info_table').DataTable({
    //   "paging": true,
    //   "lengthChange": false,
    //   "searching": false,
    //   "ordering": true,
    //   "info": true,
    //   "autoWidth": false,
    //   "responsive": true,
    // });
  });
</script>
</body>
</html>