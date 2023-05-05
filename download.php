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
<!-- dropzone -->
<link rel="stylesheet" type="text/css" href="plugins/dropzone/min/dropzone.min.css" />
    <script type="text/javascript" src="plugins/dropzone/min/dropzone.min.js"></script>

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
    <h2 class="my-5">Biometric Information</h2>
  </div>
  <div class="d-flex align-items-center">
      <div>
        <div class="panel">
            <div class="image_upload_div">
                <form action="upload.php" enctype="multipart/form-data" class="dropzone" id="my-dropzone">
                    <div class="dz-message">
                        Drop files here or click to upload.<br>
                        <span class="note">(This is for demo purpose. Selected files are not actually
                            uploaded.)</span>
                    </div>
                </form>
                <button id="startUpload">UPLOAD</button>
            </div>
        </div>
      </div>
  </div>

 
  <div class="row justify-content-between">
    <div class="col-12">
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
  });


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
</script>
</body>
</html>