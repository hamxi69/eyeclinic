<?php
session_start();
header('Content-Type: application/json');

require_once("dbconnect.php");  
$sql="SELECT * FROM clinic";
$result=mysqli_query($conn,$sql);

$data = array(); 

while($row=mysqli_fetch_assoc($result)){
    $id=$row['id'];
    $clinicname=$row['clinic_name'];
    $clinciaddress=$row['address'];
    $clinicContact=$row['contactno'];

    $data[] = array(
        'ID' => $id,
        'clinic_name' => $clinicname,
        'clinic_contact' => $clinicContact,
        'clinic_address' => $clinciaddress
    );
}

echo json_encode($data);
?>