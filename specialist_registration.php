<?php
session_start();
include_once("model/conn.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Specialist Registration</title>

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
      <p class="">Specialist Registration Form</p>

      <form class="form" id="specialist_reg_form0" enctype="multipart/form-data">
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
        <div class="form-group mb-3 col-md-3 col-12">
            <label>Password<span class="text-danger">*</span></label>
            <input type="password" class="form-control" name="password" required placeholder="Type your preffered password">
        </div>
        <div class="form-group mb-3 col-md-3 col-12">
                <label>Medical Facility<span class="text-danger">*</span></label>
            <select class="form-control" required name="facility">
                <option value="">Select Facility</option>
                <?php $select_facility = mysqli_query($conn, "SELECT id,fname FROM facility ORDER BY fname ASC");
                while($rows = mysqli_fetch_array($select_facility)):?>
                  <option value="<?=$rows['id']?>"><?=$rows['fname']?></option>
                <?php endwhile; ?>
            </select>
        </div>
        </div>
            <button type="submit" class="btn btn-primary col-5 my-4" id="specialist_reg_submit">Submit</button>
            <button type="reset" class="btn btn-outline-primary col-2 my-4">Reset</button>
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
<script src="dist/js/adminlte.js?v=1224"></script>
</body>
</html>