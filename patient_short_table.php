<?php
include_once("model/conn.php");
$facilityid = $_POST['id'];
?>
<table id="patient_short_table_" class="table display table-bordered table-hover">
      <thead>
      <tr>
        <th>Photo</th>
        <th>Name</th>
        <th>ID</th>
      </tr>
      </thead>
      <tbody>
      <?php $get_patient = mysqli_query($conn, "SELECT * FROM patient WHERE facility='$facilityid' ORDER BY datecreated DESC");
        while($prows = mysqli_fetch_array($get_patient)):?>
      <tr onclick="navigate('<?=$prows['id']?>')">
        <td><img src="uploads/<?=$prows['photo']?>" style="width: 50px; height: 50px; border: 2px solid #e1f0ff; border-radius: 50%;"></td>
        <td><?=$prows['title'].' '.$prows['fname'].' '.$prows['lname']?></td>
        <td><?=$prows['id']?></td>
      </tr>
      <?php endwhile;?>
      </tbody>
    </table>