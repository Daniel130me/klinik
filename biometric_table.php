<?php
include_once("model/conn.php");
$facilityid = $_POST['id'];
?>
<table id="biometric_tablep" class="display nowrap" style="width:100%">
      <thead>
      <tr>
        <th>Date</th>
        <th>Action</th>
      </tr>
      </thead>
      <tbody>
      <?php 
       $select_dates = mysqli_query($conn, "SELECT dateuploaded, facility_id FROM bio_file GROUP BY dateuploaded");
       while($daterows = mysqli_fetch_array($select_dates)) {
       
        $data = array();
        $select_files = mysqli_query($conn, "SELECT filebio FROM bio_file WHERE dateuploaded = '".$daterows['dateuploaded']."'");
        while($file_rows = mysqli_fetch_array($select_files)) {
            $data[] = $file_rows['filebio'];
    
        }
        $jsondata = json_encode($data);
        ?>
        <tr>
          <td><?=$daterows['dateuploaded']?></td>
          <td><button type="button" class="btn btn-primary" onclick='download_files(<?=$jsondata?>)'>Download</button></td>
        </tr>
        <?php
       }?>
      </tbody>
    </table>
    <script>
     function download_files(data) {
        console.log(data)

      // return false
      var file = data
      for (var i=file.length - 1; i>=0; i--) {
        var a = document.createElement("a")
        a.target="_blank";
        a.download=file[i];
        a.href="biometric_uploads/"+file[i]
        a.click()
      }
     }

      $("#biometric_tablep").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": []
    });

    </script>