<?php
session_start();

if(!isset($_SESSION['clinicid']))
{
header("Location: login.php");
}else{
  $idpost=$_SESSION['clinicid'];
}
require_once("dbconnect.php");
include_once("header.php");
include_once("sidebar.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Clinic Patient</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.5.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <style>
    .clinic-input {
  position: absolute;
  top: 8px;
  right: 17px;
}






  </style>
</head>

<body>

 
 

  

  <main id="main" class="main">


  <div id="msg"  style="float:right;"></div>



    <div class="pagetitle">
      <h1>Appointment Data</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <div class="container mt-5">
  <div class="card">
      <div class="card-body mt-3">
        <!-- Button trigger modal -->
  <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addClinic">
  Add Appointment
  </button>
  
  <div class="modal fade" id="addClinic" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fs-5 text-dark" style="font-weight: 800" id="exampleModalLabel">Add Appointment</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action ="" method="POST" id="add_patient">

      <div class="modal-body row g-2">
        <div id="detail" ></div>
        <div id="appointid" ></div>
        <div id="newappointment"></div>
        <div class="col-md-2 offset-md-9 clinic-input" >
          <?php
          $sql="SELECT clinic_name,id FROM clinic where id=$idpost";
          $result=$conn->query($sql);
          $user=$result->fetch_assoc();
          ?>
          <input type="hidden" name="clinicid" id="clinicid" value="<?=$user['id']?>">
    <input type="text" class="form-control center"  name="clicnicSelect" id="clicnicSelect" value="<?=$user['clinic_name']?>" data-clinic-name="<?= $user['clinic_name'] ?>" placeholder="Clinic Name" readonly>
    </div>
    <div class="col-md-12">
    <label for="patientName" class="form-label text-dark" style="font-weight: 600">Patient Name</label>
    <input type="text" class="form-control center"  name="patientName" id="patientName" placeholder="Patient Name" required>
    </div>
    <div class="col-md-6">
    <label for="patientContact" class="form-label text-dark" style="font-weight: 600"  >Contact</label>
    <input type="text" class="form-control center"  name="patientContact" id="patientContact" placeholder="Patient Contact" required>
    <div id="contacterr" style="color:red;"></div>  
  </div>
    <div class="col-md-6">
    <label for="patientCnic" class="form-label text-dark" style="font-weight: 600"  >Cnic</label>
    <input type="text" class="form-control center"  name="patientCnic" id="patientCnic" placeholder="Patient Cnic" required>
    <div id="cnicerr" style="color:red;"></div>  
    
  </div>
    <div class="col-md-12">
    <label for="patientAddress" class="form-label text-dark" style="font-weight: 600"  >Address</label>
    <textarea type="text" id="patientAddress" name="patientAddress" class="form-control md-textarea pt-1 py-0 pb-0" placeholder="Patient Address" required></textarea>   
   </div>
    <div class="col-md-6 ">
    <label for="patientAge" class="form-label text-dark" style="font-weight: 600"  >Age</label>
    <input type="text" class="form-control center"  name="patientAge" id="patientAge" placeholder="Patient Age" required>
    </div>
    <div class="col-md-6">
    <div class="row">
    <label for="" class="form-label text-dark" style="font-weight: 600"  >Gender</label>
    
    <div class="col-md-3">
      <input class="form-check-input" type="radio" style="width:20px;height:20px" name="patientradiobtn" id="patientmale" value="Male" required>
      <label class="form-check-label text-dark" style="font-weight:500;font-size:18px;" for="patientmale">Male</label>
      </div>  
      <div class="col-md-5">
     <input class="form-check-input" type="radio" style="width:20px;height:20px" name="patientradiobtn" id="patientfemale" value="Female">
    <label class="form-check-label text-dark" style="font-weight:500;font-size:18px;" for="patientfemale" >Female</label>
   </div>
    </div>
    </div>

  <div id="error"></div>
  <div class="col-md-6">
    <button type="submit" name="patientSubmit" class="btn btn-dark ">Submit</button>
        <button type="reset" name="resetform" id="resetform" class="btn btn-danger ">Reset</button>

  </div>
      </div>
      </form>
      </div>
    </div>
  </div>
  </div>
  <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Appointment Data Table</h5>

              <!-- Default Table -->
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Address</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Cnic</th>                   
                    <th scope="col">Age</th>                   
                    <th scope="col">Gender</th>                  
                    <th scope="col">Appoint Id</th>                  
                    <th scope="col">Action</th>                  
                  </tr>
                </thead>
                <tbody id="table-body">           
              </tbody>
              </table>
              <button type="button" class="btn btn-md btn-danger"><a href="index.php" style='color:white;'>Cancel</a></button>

              <!-- End Default Table Example -->
            </div>
          </div>

      </div>
    </section>

<div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fs-5 text-dark" style="font-weight: 800" id="exampleModalLabel">Edit Clinic </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action ="" method="POST" id="edt_patient">

<div class="modal-body row g-2">
  <input type="hidden" name="editpatientid" id="editpatientid">
  <div id="edtdetail" ></div>
  <div id="edtappointid" ></div>
  <div id="edtnewappointment"></div>
  <div class="col-md-2 offset-md-9 clinic-input" >
<input type="text" class="form-control center"  name="edtclicnicSelect" id="edtclicnicSelect" value="<?=$user['clinic_name']?>" placeholder="Clinic Name" readonly>
</div>
<div class="col-md-12">
<label for="edtpatientName" class="form-label text-dark" style="font-weight: 600">Patient Name</label>
<input type="text" class="form-control center"  name="edtpatientName" id="edtpatientName" placeholder="Patient Name" required>
</div>
<div class="col-md-6">
<label for="edtpatientContact" class="form-label text-dark" style="font-weight: 600"  >Contact</label>
<input type="text" class="form-control center"  name="edtpatientContact" id="edtpatientContact" placeholder="Patient Contact" required>
<div id="edtcontacterr" style="color:red;"></div>
</div>
<div class="col-md-6">
<label for="edtpatientCnic" class="form-label text-dark" style="font-weight: 600"  >Cnic</label>
<input type="text" class="form-control center"  name="edtpatientCnic" id="edtpatientCnic" placeholder="Patient Cnic" required>
<div id="edtcnicerr" style="color:red;"></div>
</div>
<div class="col-md-12">
<label for="edtpatientAddress" class="form-label text-dark" style="font-weight: 600"  >Address</label>
<textarea type="text" id="edtpatientAddress" name="edtpatientAddress" class="form-control md-textarea pt-1 py-0 pb-0" placeholder="Patient Address" required></textarea>   
</div>
<div class="col-md-6 ">
<label for="edtpatientAge" class="form-label text-dark" style="font-weight: 600"  >Age</label>
<input type="text" class="form-control center"  name="edtpatientAge" id="edtpatientAge" placeholder="Patient Age" required>
</div>
<div class="col-md-6">
<div class="row">
<label for="" class="form-label text-dark" style="font-weight: 600"  >Gender</label>

<div class="col-md-3">
<input class="form-check-input" type="radio" style="width:20px;height:20px" name="edtpatientradiobtn" id="edtpatientmale" value="Male" required>
<label class="form-check-label text-dark" style="font-weight:500;font-size:18px;" for="patientmale">Male</label>
</div>  
<div class="col-md-5">
<input class="form-check-input" type="radio" style="width:20px;height:20px" name="edtpatientradiobtn" id="edtpatientfemale" value="Female">
<label class="form-check-label text-dark" style="font-weight:500;font-size:18px;" for="patientfemale" >Female</label>
</div>
</div>
</div>

<div id="error"></div>
<div class="col-md-6">
<button type="submit" name="edtpatientSubmit" class="btn btn-dark ">Submit</button>
  <button type="reset" name="edt" id="resetform1" class="btn btn-danger ">Reset</button>

</div>
</div>
</form>


      </div>
    </div>
  </div>
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
 <?php
 include_once("footer.php");
 ?>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" ></script>
  <script src="appointment.js"></script>

</body>

</html>