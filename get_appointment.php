<?php
session_start();

if(!isset($_SESSION['clinicid']))
{
header("location:login.php");
}else{
  $idpost=$_SESSION['clinicid'];
}
require_once("dbconnect.php");

$sql="SELECT * FROM appointment WHERE DATE(date) = CURDATE() AND clinic_id =$idpost";

$result=mysqli_query($conn,$sql);

$data = array(); 

while($row=mysqli_fetch_assoc($result)){
    $id=$row['id'];
    $name=$row['patientname'];
    $address=$row['patientaddress'];
    $contact=$row['patientcontact'];
    $cnic=$row['patientcnic'];
    $age=$row['patientage'];
    $gender=$row['patientgender'];
    $appoint_id=$row['appoint_id'];
    $data[] = array(
        'id' => $id,
        'patient_name' => $name,
        'patient_address' => $address,
        'patient_contact' => $contact,
        'patient_cnic' => $cnic,
        'patient_age' => $age,
        'patient_gender' => $gender,
        'patient_appoint' => $appoint_id
    );
}

echo json_encode($data);
?>

