<?php
include_once("model/conn.php");
$patientid = $_POST['id'];
?>
<table id="health_record_table" class="display nowrap table table-bordered table-striped" style="100%">
<thead>
<tr>
    <th>Date</th>
    <th>Medical Facility</th>
    <th>Test</th>
    <th>Diagnosis</th>
    <th>Prescription</th>
    <th>Treatment</th>
    <th>Specialist in charge</th>
    <th>Post</th>
    <!-- <th>Action</th> -->
</tr>
</thead>
<tbody>
<?php $get_record = mysqli_query($conn, "SELECT r.*, f.fname facility_name,
s.title,s.fname firstname,s.mname middlename,s.lname lastname,p.post FROM 
record r, facility f, specialist s, post p WHERE r.facility=f.id AND 
r.facility=s.facility AND r.createdby=s.id AND r.patient_id='$patientid' AND 
p.id=r.userpost ORDER BY datecreated DESC");
while($rrows = mysqli_fetch_array($get_record)):?>
<tr data-toggle="modal" data-target="#health_info_modal" 
onclick="get_health_info_for_modal('<?=$rrows['datecreated']?>',
'<?=$rrows['facility_name']?>','<?=$rrows['test']?>','<?=$rrows['diagnosis']?>',
'<?=$rrows['prescription']?>','<?=$rrows['treatment']?>','<?=$rrows['test_file']?>',
'<?=$rrows['title']?>','<?=$rrows['firstname']?>','<?=$rrows['middlename']?>','<?=$rrows['lastname']?>','<?=$rrows['post']?>')">
    <td><?=$rrows['datecreated']?></td>
    <td><?=$rrows['facility_name']?></td>
    <td class="t_test"><?=$rrows['test']?></td>
    <td class="t_diagnosis"><?=$rrows['diagnosis']?></td>
    <td class="t_prescription"><?=$rrows['prescription']?></td>
    <td class="t_treatment"><?=$rrows['treatment']?></td>
    <td><?=$rrows['title'].' '.$rrows['firstname'].' '.$rrows['middlename'].' '.$rrows['lastname']?></td>
    <td><?=$rrows['post']?></td>
    <!-- <td><button type="button" class="btn btn-primary mb-2" onclick="open_edit_modal(this,'<?=$rrows['id']?>')">Edit</button></td> -->
</tr>
<?php endwhile;?>
</tbody>
</table>

<script>
function get_health_info_for_modal(date,fname,test,diagnosis,prescription,treatment,testfile,title,sfname,smname,slname,post) {
   $("#s_date").html(`Date: ${date}`)
   $("#s_fname").html(`Facility: ${fname}`)
   $("#s_sname").html(`Specialist: ${title+' '+sfname+' '+smname+' '+slname}`)
   $("#s_spost").html(`Post: ${post}`)
   if(treatment) {
    $("#treatment-box").show()
    $("#s_treatment").html(treatment)
   }
   else {
    $("#treatment-box").hide() 
   }
   if(prescription) {
       $("#presc-box").show()
    $("#s_prescription").html(prescription)
   }
   else {
    $("#presc-box").hide()
   }
   if(diagnosis) {
    $("#diagnosis-box").show()
    $("#s_diagnosis").html(diagnosis)
   }
   else {
    $("#diagnosis-box").hide()
   }
   if(test) {
    $("#test-box").show()
    $("#s_test").html(test)
   }
   else {
    $("#test-box").hide()
   }
   if(testfile) {
    $("#test_file-box").show()
    $("#s_test_file").attr('src',`uploads/${testfile}`)
   }
   else {
    $("#test_file-box").hide()
   }
  
  
//    $("#s_diagnosis").html(diagnosis)
//    $("#s_test").html(test)
//    $("#s_test_file").attr('src',`uploads/${testfile}`)
//    $("#s_test_file").attr('src',`uploads/${testfile}`)
}
$("#health_record_table").DataTable({
      scrollX: true,
    });
</script>
