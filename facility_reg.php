<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Health Facility Registration</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">

</head>
<body class="hold-transition register-page">
  
  <div class="container d-flex align-items-center justify-content-center" style="height: 100vh">
    
    <div class="card">
      <div class="card-body register-card-body">
        <h2 class="mb-3">National Medical Record Management System</h2>
      <p class="">Medical Facility Registration Form</p>

      <form class="form" runat="server" id="facility_reg_form" enctype="multipart/form-data">
        <div class="row">
        <div class="form-group mb-3 col-md-6 col-12">
            <label>Facility name<span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="facility_name" placeholder="Facility name" required>
        </div>
        <div class="form-group mb-3 col-md-6 col-12">
            <label>Email<span class="text-danger">*</span></label>
            <input type="email" class="form-control" name="facility_email" placeholder="Email" required>
        </div>
       
        
        </div>
        <div class="row">
            <div class="form-group mb-3 col-md-12 col-12">
                <label>Address<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="facility_address" placeholder="Address" required>
            </div>
            
        </div>
        <div class="row">
            <div class="form-group mb-3 col-md-6 col-12">
                <label>Phone number<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="facility_phone" placeholder="Phone number" required>
            </div>
            <div class="form-group mb-3 col-md-6 col-12">
                <label>Postcode<span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="facility_postcode" placeholder="Postcode" required>
            </div>
        </div>
        <div class="row">
        <div class="form-group mb-3 col-md-3 col-12">
 
                <label>Upload Logo<span class="text-danger">*</span></label>
                <!-- <div class="input-group"> -->
                <img src="" id="flogo_preview" class="d-block" width="150" height="150">
                <input type="file" accept="image/*" class="d-block" name="flogo" id="flogo" placeholder="Upload logo" required style="width: 150px; margin-top: 22px;">
                <!-- </div> -->
            </div>
      </div>
        <!-- <div class="row"> -->
          <button type="submit" class="btn btn-primary col-12 col-md-5 mt-4 my-md-4" id="facility_btn_submit">Submit</button>
            <button type="reset" class="btn btn-outline-primary col-12 col-md-3 mt-2 my-md-4">Reset</button>
        <!-- </div> -->
      </form>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="plugins/toastr/toastr.min.js"></script>
<script src="dist/js/adminlte.js?v=12256789"></script>

</body>
</html>