<?php
session_start();
require_once("dbconnect.php");
include_once("header.php");
include_once("sidebar.php");


?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Tables / General - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">

  <link href="assets/css/style.css" rel="stylesheet">

 
</head>

<body>

 

  <main id="main" class="main">


  <div id="msg"  style="float:right;"></div>



    <div class="pagetitle">
      <h1>Clinic Data</h1>
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
  Add Clinic
  </button>
  
  <div class="modal fade" id="addClinic" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fs-5 text-dark" style="font-weight: 800" id="exampleModalLabel">Add Clinic</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action ="" method="POST" id="add_clinic">

      <div class="modal-body row g-2">
    <div class="col-md-12">
    <label for="clinicname" class="form-label text-dark" style="font-weight: 500">Clinic Name</label>
    <input type="text" class="form-control center"  name="clinicname" id="clinicname" placeholder="Clinic Name" required>
    </div>
    <div class="col-md-12">
    <label for="clinicaddress" class="form-label text-dark" style="font-weight: 500"  >Clinic Address</label>
    <textarea type="text" id="clinicaddress" name="clinicaddress" class="form-control md-textarea pt-1 py-0 pb-0" placeholder="Clinic Address" required></textarea>   
   </div>
    <div class="col-md-12">
    <label for="clinicContact" class="form-label text-dark" style="font-weight: 500"  >Clinic Contact</label>
    <input type="text" class="form-control center"  name="clinicContact" id="clinicContact" placeholder="Clinic Contact" required>
    </div>
  <div id="error"></div>
  <div class="col-md-12 ">
    <button type="submit" name="clinicSubmit" class="btn btn-dark ">Submit</button>
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
              <h5 class="card-title">Unit Data Table</h5>

              <!-- Default Table -->
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Clinic Name</th>
                    <th scope="col">Clinic Address</th>
                    <th scope="col">Clinic Contact</th>
                    <th scope="col">ACTION</th>                   
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
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fs-5 text-dark" style="font-weight: 800" id="exampleModalLabel">Edit Clinic </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action ="" method="POST" id="edtform">

      <div class="modal-body row g-2">
        <input type="hidden" name="editid" id="editclinicid">
    <div class="col-md-12">
    <label  class="form-label text-dark" style="font-weight: 500" for="edtClinicName">Clinic Name</label>
    <input type="text" class="form-control"  name="edtClinicName" id="edtClinicName" placeholder="Clinic Name" required>
  </div>
  <div class="col-md-12">
    <label  class="form-label text-dark" style="font-weight: 500" for="edtclinicaddress">Clinic Address</label>
    <textarea type="text" id="edtclinicaddress" name="edtclinicaddress" class="form-control md-textarea pt-1 py-0 pb-0" placeholder="Clinic Address" required></textarea>   
  </div>
  <div class="col-md-12">
    <label  class="form-label text-dark" style="font-weight: 500" for="edtclinicContact">Clinic Contact</label>
    <input type="text" class="form-control"  name="edtclinicContact" id="edtclinicContact" placeholder="Clinic Address" required>
  </div>
  <div id="erroredit"></div>
  <div class="col-md-6">
    <button type="submit" name="edtClinicbtn" class="btn btn-dark ">Submit</button>
  </div>
      </form>


      </div>
    </div>
  </div>
  </main><!-- End #main -->

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
<script>
$('#add_clinic').submit(function(event){
event.preventDefault();

var clinic_name   = $('#clinicname').val();
var clinic_address= $('#clinicaddress').val();
var clinic_Contact= $('#clinicContact').val();
$.ajax({
    
  type:'post',
  url:'action.php',
  data: 
  {
    'clinicSubmit':true,
    'clinicName':clinic_name,
    'Clinic_Contact':clinic_Contact,
    'Clinic_Address':clinic_address
  },
  dataType: 'json',
  success:function(response){
    if (response.success) {
      $('#addClinic').modal('hide');
        $('#msg').html('<div class="alert alert-success  align-items-center" style="float:right;"><strong>' + response.message + '<strong></div>');
        setTimeout(function(){
          $('#msg').html('');
        }, 3000);
      } else {
        $('#error').text(response.message);
      }
  }
});
});

$(document).ready(function() {
  function getData() {
    $.ajax({
      type: "GET",
      url: "get_clinic.php",
      dataType: "json",
      success: function(data) {

        $('#table-body').html('');

        data.forEach(function(record) {
          var newRow = '<tr>' +
            '<td>' + record.ID + '</td>' +
            '<td>' + record.clinic_name + '</td>' +
            '<td>' + record.clinic_address + '</td>' +
            '<td>' + record.clinic_contact + '</td>' +
            '<td>' +
            '<button class="editbtn btn btn-sm btn-dark tblbtn"  name="edtClinicbtn" data-edit-id="'+ record.ID +'"><i class="bi bi-pencil-square"></i></button>' +
            '<button class="delete btn btn-sm btn-danger tblbtn" name="deleteClinic" data-delete-id="' + record.ID + '"><i class="bi bi-trash"></i></button>' +
            '</td>' +
            '</tr>';

          $('#table-body').append(newRow);
        }
        );
        $('.delete').on('click', function (){

          var delete_unitId = $(this).data('delete-id');
           // console.log(id);
          
          $.ajax({
            type :'post',
            url  :'action.php',
            data :
            {
              'deleteClinic':true,
              'delete-id':delete_unitId
            },
            dataType: 'json',
            success:function(response)
            {
            if (response.success)
             {
             $('#msg').html('<div class="alert alert-danger  align-items-center" style="float:right;"><strong>' + response.message + '<strong></div>');
            setTimeout(function()
            {
            $('#msg').html('');
            }, 3000);
           } 
            else 
           {
            $('#error').text(response.message);
          }
          }
          });

        });
        $('.editbtn').on('click', function(){
            $('#editmodal').modal('show');
            var edit = $(this).data('edit-id');

            $tr=$(this).closest('tr');
            var data= $tr.children("td").map(function(){
              return $(this).text();
            }).get();
            $('#editclinicid').val(data[0]);
            $('#edtClinicName').val(data[1]);
            $('#edtclinicaddress').val(data[2]);
            $('#edtclinicContact').val(data[3]);

            $('#edtform').submit(function(event){
              event.preventDefault();
            var edit_clinicid     = $('#editclinicid').val();
            var edtClinic_Name    = $('#edtClinicName').val();
            var edtClinic_Address = $('#edtclinicaddress').val();
            var edtClinic_contact = $('#edtclinicContact').val();

            $.ajax({
                type:'post',
                url:'action.php',
                data:
                {
                  'edtClinicbtn'      : true,
                  'edit-id'           : edit_clinicid,
                  'edtclinic_Name'    : edtClinic_Name,
                  'edtclinic_Contact' : edtClinic_contact,
                  'edtclinic_Address' : edtClinic_Address
                },
                dataType: 'json',
                success:function(response)
            {
            if (response.success)
             {
              $('#editmodal').modal('hide');

             $('#msg').html('<div class="alert alert-warning  align-items-center" style="float:right;"><strong>' + response.message + '<strong></div>');
            setTimeout(function()
            {
            $('#msg').html('');
            }, 3000);
           } 
            else 
           {
            $('#erroredit').text(response.message);
          }
          
        }
            });
              
            });

          });

      },
      complete: function() {
        setTimeout(getData, 2000);
      }
    });
  }

  getData();
});


</script>
</body>

</html>