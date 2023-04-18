<?php
require_once("dbconnect.php");


if(isset($_POST['patient_contact'])) {
    $patient_contact = $_POST['patient_contact'];

    $sql = "SELECT appointment.*, clinic.clinic_name 
    FROM appointment 
    INNER JOIN clinic ON appointment.clinic_id = clinic.id 
    WHERE appointment.patientcontact ='".$patient_contact."'
    ORDER BY appointment.date DESC, appointment.appoint_id DESC 
    LIMIT 1";
    
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $patientname= $row['patientname'];
            $patientaddress= $row['patientaddress'];
            $patientcnic= $row['patientcnic'];
            $patientage= $row['patientage'];
            $patientclinic= $row['clinic_name'];
            $patientgender=$row['patientgender'];
            $patientappointid=$row['appoint_id'];
            $patientlastVistDate=$row['date'];
            $data=array(
                'patient_name'=> $patientname,
                'patient_cnic'=> $patientcnic,
                'patient_address'=> $patientaddress,
                'patient_age'=> $patientage,
                'patient_clinic'=>$patientclinic,
                'patient_gender'=>$patientgender,
                'patient_appointid'=>$patientappointid,
                'patient_lastvisit'=>$patientlastVistDate
            );
        }

    } else {
        $data=array(
            'message'=>'New Appointment'
        );
    }
    echo json_encode($data);

}

// if(isset($_POST['patient_cnic'])) {
//     $patient_cnic = $_POST['patient_cnic'];

//     $sql = "SELECT appointment.*, clinic.clinic_name 
//     FROM appointment 
//     INNER JOIN clinic ON appointment.clinic_id = clinic.id 
//     WHERE appointment.patientcnic = '".$patient_cnic."' 
//     ORDER BY appointment.date DESC, appointment.appoint_id DESC 
//     LIMIT 1";
    
//     $result = $conn->query($sql);

//     if ($result->num_rows > 0) {
//         while($row = $result->fetch_assoc()) {
//             $patientname= $row['patientname'];
//             $patientaddress= $row['patientaddress'];
//             $patientcontact= $row['patientcontact'];
//             $patientage= $row['patientage'];
//             $patientclinic= $row['clinic_name'];
//             $patientgender=$row['patientgender'];
//             $patientappointid=$row['appoint_id'];
//             $patientlastVistDate=$row['date'];
//             $data=array(
//                 'patient_name'=> $patientname,
//                 'patient_contact'=> $patientcontact,
//                 'patient_address'=> $patientaddress,
//                 'patient_age'=> $patientage,
//                 'patient_clinic'=>$patientclinic,
//                 'patient_gender'=>$patientgender,
//                 'patient_appointid'=>$patientappointid,
//                 'patient_lastvisit'=>$patientlastVistDate
//             );
      
//         }
        
//     } else {
//         $data=array(
//             'message'=>'New Appointment'
//         );
// }
// echo json_encode($data);

// }

?>