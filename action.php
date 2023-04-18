<?php
session_start();
header('Content-Type: application/json');
date_default_timezone_set('Asia/Karachi'); 

require_once("dbconnect.php");  

/////////////////////////////////// clinci insert //////////////////////////////////////////////

if(isset($_POST['clinicSubmit'])){

    $clinic_name=$_POST['clinicName'];
    $clinic_address=$_POST['Clinic_Address'];
    $clinic_contact=$_POST['Clinic_Contact'];
  
      $NEW_ID="";
      $sql_id="SELECT MAX(ID)+1 AS NEWID From clinic";
      $result=mysqli_query($conn, $sql_id);
      while($row=mysqli_fetch_assoc($result)){
        $NEW_ID=$row['NEWID'];
      }
      if($NEW_ID==0){
        $NEW_ID=1;
      }
      $sql = "INSERT INTO clinic (id, clinic_name, address, contactno) VALUES ($NEW_ID, '$clinic_name', '$clinic_address', '$clinic_contact')";
      if ($conn->query($sql) === TRUE) {
          $response = array('success' => true, 'message' => 'Clinic Added.');
      } else {
          $response = array('success' => false, 'message' => 'Error creating Clinic: ' . $conn->error);
      }
      echo json_encode($response);

  }


/////////////////////////////////// clinci update //////////////////////////////////////////////


  if(isset($_POST['edtClinicbtn']))
{
  $edit_clinicid = $_POST['edit-id'];
  $edtclinic_Name= $_POST['edtclinic_Name'];
  $edtclinic_Contact=$_POST['edtclinic_Contact'];
  $edtclinic_Address=$_POST['edtclinic_Address'];


  $sql="UPDATE clinic SET `clinic_name`='$edtclinic_Name', `address`='$edtclinic_Address', `contactno`='$edtclinic_Contact' WHERE ID =$edit_clinicid";

  $result = mysqli_query($conn, $sql);

  if ($result)
  {
      $response = array('success' => true, 'message' => 'Clinic Updated.');
  }
  else
  {
    $response = array('success' => false, 'message' => 'Clinic Not Updated');
  }
  echo json_encode($response);
  
}


/////////////////////////////////// clinci delete //////////////////////////////////////////////




if(isset($_POST['deleteClinic']))
{

  $delete_unitId=$_POST['delete-id'];

  $sql = "DELETE FROM clinic WHERE ID =$delete_unitId";
  
  $result = mysqli_query($conn, $sql);

if ($result)
{
    $response = array('success' => true, 'message' => 'Clinic Deleted.');
}
else
{
  $response = array('success' => false, 'message' => 'Clinic Not Deleted.');
}
echo json_encode($response);

}

/////////////////////////////////// user insert //////////////////////////////////////////////


if(isset($_POST['usersubmit']))
{

$fullname = $_POST['userfullname'];
$email = $_POST['useremail'];
$address = $_POST['useraddress'];
$password = $_POST['userpassword'];
$clinic=$_POST['userclinic'];
$role=$_POST['userrole'];

$hashed_password = password_hash($password, PASSWORD_DEFAULT);


$sql = "SELECT * FROM users WHERE Email = '$email'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $response = array('success' => false, 'message' => 'Email already exists.');
} else {
    $NEW_ID="";
    $sql_id="SELECT MAX(ID)+1 AS NEWID From users";
    $result=mysqli_query($conn, $sql_id);
    while($row=mysqli_fetch_assoc($result)){
      $NEW_ID=$row['NEWID'];
    }
    if($NEW_ID==0){
      $NEW_ID=1;
    }
    $sql = "INSERT INTO users (id, clinic_id, fullname, email, address, password, role) VALUES ($NEW_ID, '$clinic', '$fullname', '$email', '$address', '$hashed_password','$role')";
    if ($conn->query($sql) === TRUE) {
        $response = array('success' => true, 'message' => 'User created successfully.');
    } else {
        $response = array('success' => false, 'message' => 'Error creating user: ' . $conn->error);
    }
}

echo json_encode($response);

}

/////////////////////////////////// user update //////////////////////////////////////////////



if(isset($_POST['edtusersubmit']))
{
  $edit_id=$_POST['edit-id'];
  $edt_fullname=$_POST['edt_fullname'];
  $edt_useremail=$_POST['edt_useremail'];
  $edt_useraddress=$_POST['edt_useraddress'];
  $edt_clinicselect=$_POST['edt_clinicselect'];
  $edt_roleSelect=$_POST['edt_roleSelect'];

  $query = "SELECT COUNT(*) as count FROM users WHERE email='$edt_useremail' AND id != $edit_id";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($result);

  if($row['count'] > 0) {
    $response = array('success' => false, 'message' => 'Email is already in use by another user.');
    echo json_encode($response);
  } else {
    $query = "SELECT * FROM users WHERE id=$edit_id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if($row['email'] == $edt_useremail) {
      $edt_clinicselect=$_POST['edt_clinicselect'];
      $query = "UPDATE users SET clinic_id='$edt_clinicselect', fullname='$edt_fullname', address='$edt_useraddress', role='$edt_roleSelect' WHERE id=$edit_id";
      mysqli_query($conn, $query);

      $response = array('success' => true, 'message'=> 'Updated Successfully');
      echo json_encode($response);
    } else {
      $query = "SELECT COUNT(*) as count FROM users WHERE email='$edt_useremail'  AND id != $edit_id";
      $result = mysqli_query($conn, $query);
      $row = mysqli_fetch_assoc($result);

      if($row['count'] > 0) {
        $response = array('success' => false, 'message'=> 'This email is already in use by another user.');
        echo json_encode($response);
      } else {
        $query = "UPDATE users SET client_id='$edt_clinicselect', fullname='$edt_fullname', email='$edt_useremail', address='$edt_useraddress', role='$edt_roleSelect' WHERE id=$edit_id";
        mysqli_query($conn, $query);

        $response = array('success' => true, 'message'=> 'Updated Successfully');
        echo json_encode($response);
      }
    }
  }
}

/////////////////////////////////// user delete //////////////////////////////////////////////


if(isset($_POST['deleteuser']))
{

  $delete_userid=$_POST['delete-id'];

  $sql = "DELETE FROM users WHERE id =$delete_userid";
  
  $result = mysqli_query($conn, $sql);

if ($result)
{
    $response = array('success' => true, 'message' => 'User Deleted.');
}
else
{
  $response = array('success' => false, 'message' => 'User Not Deleted.');
}
echo json_encode($response);

}

///////////////////////////////////user login //////////////////////////////

if (isset($_POST['login'])) {
  $email = $_POST['Email'];
  $password = $_POST['Password'];

  $sql = "SELECT * FROM users WHERE email='$email'";
  $result = $conn->query($sql);

  if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();
    $_SESSION['tempid']=$user['id'];
    $_SESSION['tempclinicid']=$user['clinic_id'];
    if (password_verify($password, $user['password'])) 
    {
      $_SESSION['uid']=$_SESSION['tempid'];
      $_SESSION['clinicid']=$_SESSION['tempclinicid'];

      $response = array('success' => true, 'message' => 'Login successful!');

    } else 
    {
      $response =  array('success' => false, 'message' => 'Incorrect email or password.');
    }

  } else 
  {
    $response =  array('success' => false, 'message' => 'Incorrect email or password.');
  }
  echo json_encode($response);
}

if(isset($_POST['patientSubmit']))
{

    $patient_name=$_POST['patient_name'];
    $patient_contact=$_POST['patient_contact'];
    $patient_address=$_POST['patient_address'];
    $patient_cnic=$_POST['patient_cnic'];
    $patient_age=$_POST['patient_age'];
    $patient_gender=$_POST['patient_gender'];
    $patient_clinic=$_POST['clinic_name'];
    
    $current_date = date('Y-m-d');

    $sql = "SELECT MAX(appoint_id) as max_appoint_id FROM appointment WHERE clinic_id=$patient_clinic AND date='$current_date'";
    $result=$conn->query($sql);
    $max_appoint_id = 0;
    while($row=$result->fetch_assoc()){
        $max_appoint_id = $row['max_appoint_id'];
    }

    $new_appoint_id = $max_appoint_id + 1;

    $insert="INSERT INTO appointment (clinic_id,patientname,patientaddress,patientcontact,patientcnic,patientage,patientgender,date,appoint_id) 
    VALUES($patient_clinic,'$patient_name','$patient_address','$patient_contact','$patient_cnic','$patient_age','$patient_gender','$current_date',$new_appoint_id)";

    if ($conn->query($insert) === TRUE) {
        $response = array('success' => true, 'message' => 'Appointment Successfull.');
    } else {
        $response = array('success' => false, 'message' => 'Error creating Appointment: ' . $conn->error);
    }

    echo json_encode($response);
}


if(isset($_POST['edtpatientSubmit']))
{
  $edit_patientid = $_POST['edit-id'];
  $edtpatient_name= $_POST['edtpatient_name'];
  $edtpatient_contact=$_POST['edtpatient_contact'];
  $edtpatient_address=$_POST['edtpatient_address'];
  $edtpatient_cnic=$_POST['edtpatient_cnic'];
  $edtpatient_age=$_POST['edtpatient_age'];
  $edtpatient_gender=$_POST['edtpatient_gender'];


  $sql="UPDATE appointment SET `patientname`='$edtpatient_name', `patientaddress`='$edtpatient_address', `patientcontact`='$edtpatient_contact',`patientcnic`='$edtpatient_cnic', `patientage`='$edtpatient_age',`patientgender`='$edtpatient_gender' WHERE id =$edit_patientid";

  $result = mysqli_query($conn, $sql);

  if ($result)
  {
      $response = array('success' => true, 'message' => 'Appointment Updated.');
  }
  else
  {
    $response = array('success' => false, 'message' => 'Appointment Not Updated');
  }
  echo json_encode($response);
  
}


if(isset($_POST['deletepatient']))
{

  $delete_patientId=$_POST['delete-id'];

  $sql = "DELETE FROM appointment WHERE id =$delete_patientId";
  
  $result = mysqli_query($conn, $sql);

if ($result)
{
    $response = array('success' => true, 'message' => 'Appointment Deleted.');
}
else
{
  $response = array('success' => false, 'message' => 'Appointment Not Deleted.');
}
echo json_encode($response);

}




?>