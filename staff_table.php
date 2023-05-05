<?php
include_once("model/conn.php");
$facilityid = $_POST['id'];
?>
<table id="staff_info_table" class="display nowrap table table-bordered" style="width:100%">
      <thead>
      <tr>
        <th>Photo</th>
        <th>Name</th>
        <th>Post/Level</th>
        <th>Email</th>
        <th>Phone number</th>
      </tr>
      </thead>
      <tbody>
      <?php $get_spe = mysqli_query($conn, "SELECT s.id,s.title,s.fname,s.lname,p.post post,s.email,s.phone,s.photo, s.facility FROM specialist s, post p WHERE p.id= s.post AND s.facility='$facilityid' ORDER BY datecreated DESC");
        while($prows = mysqli_fetch_array($get_spe)):?>
      <tr>
        <td><img src="uploads/<?=$prows['photo']?>" style="width: 60px; height:60px; border: 2px solid #e1f0ff; border-radius: 50%;"></td>
        <td><?=$prows['title'].' '.$prows['fname'].' '.$prows['lname']?></td>
        <td><?=$prows['post']?></td>
        <td><?=$prows['email']?></td>
        <td><?=$prows['phone']?></td>
      </tr>
      <?php endwhile;?>
      </tbody>
    </table>
    <script>
    $("#staff_info_table").DataTable({
      scrollX: true,
    });
    </script>