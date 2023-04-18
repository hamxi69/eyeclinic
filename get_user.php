<?php
session_start();
header('Content-Type: application/json');

require_once("dbconnect.php");  
$sql="SELECT
clinic.clinic_name, 
users.*
FROM
clinic
INNER JOIN
users
ON 
    clinic.id = users.clinic_id";
$result=mysqli_query($conn,$sql);

$data = array(); 

while($row=mysqli_fetch_assoc($result)){
    $id=$row['id'];
    $userfullname=$row['fullname'];
    $useraddress=$row['address'];
    $userclinic_id=$row['clinic_id'];
    $userclinicname=$row['clinic_name'];
    $userrole=$row['role'];
    $useremail=$row['email'];

    $data[] = array(
        'id' => $id,
        'userfullname' => $userfullname,
        'useraddress' => $useraddress,
        'useremail' => $useremail,
        'userrole' => $userrole,
        'userclinic_id' => $userclinic_id,
        'userclinicname' => $userclinicname
    );
}

echo json_encode($data);
?>