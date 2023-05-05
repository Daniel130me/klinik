<?php
include_once("model/conn.php");
$facilityid = $_POST['id'];
?>
<table id="patient_info_table_" class="display nowrap table table-bordered" style="width:100%">
      <thead>
      <tr>
        <th>Photo</th>
        <th>Name</th>
        <th>ID</th>
        <th>Date of Birth</th>
        <th>Gender</th>
        <th>Phone number</th>
      </tr>
      </thead>
      <tbody>
      <?php $get_patient = mysqli_query($conn, "SELECT * FROM patient WHERE facility='$facilityid' ORDER BY datecreated DESC");
        while($prows = mysqli_fetch_array($get_patient)):?>
      <tr onclick="navigate('<?=$prows['id']?>')">
        <td><img src="uploads/<?=$prows['photo']?>" style="width: 60px; height: 60px; border: 2px solid #e1f0ff; border-radius: 50%;"></td>
        <td><?=$prows['title'].' '.$prows['fname'].' '.$prows['lname']?></td>
        <td><?=$prows['id']?></td>
        <td><?=$prows['dob']?></td>
        <td><?=$prows['gender']?></td>
        <td><?=$prows['phone']?></td>
      </tr>
      <?php endwhile;?>
      </tbody>
    </table>
    <script>
$("#patient_info_table_").DataTable({
      scrollX: true,
  });
    </script>