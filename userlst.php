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

  <title>Clinic Users</title>
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

  <!-- Template Main CSS File -->
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
  <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addUser">
  Add User
  </button>
  
  <div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fs-5 text-dark" style="font-weight: 800" id="exampleModalLabel">Add User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action ="" method="POST" id="add_user">

      <div class="modal-body row g-2">
    <div class="col-md-12">
    <label for="fullname" class="form-label text-dark" style="font-weight: 500">Full Name</label>
    <input type="text" class="form-control center"  name="fullname" id="fullname" placeholder="Full Name" required>
    </div>
    <div class="col-md-12">
    <label for="useremail" class="form-label text-dark" style="font-weight: 500">Email</label>
    <input type="email" class="form-control center"  name="useremail" id="useremail" placeholder="Email" required>
    <div id="emailerr" style="color:red;"></div>
    </div>
    <div class="col-md-12">
    <label for="useraddress" class="form-label text-dark" style="font-weight: 500"  >Address</label>
    <textarea type="text" id="useraddress" name="useraddress" class="form-control md-textarea pt-1 py-0 pb-0" placeholder="Address" required></textarea>   
   </div>
    <div class="col-md-12">
    <label for="userpassword" class="form-label text-dark" style="font-weight: 500">Password</label>
    <input type="password" class="form-control center"  name="userpassword" id="userpassword" placeholder="Password" required>
    <div id="passworderr"></div>
    </div>
    <div class="col-md-12">
    <label for="clinicselect" class="form-label text-dark" style="font-weight: 500"  >Clinic Name</label>
    <select name="clinicselect" id="clinicselect" class="form-control center">
    <option selected disabled>Please Select Clinic</option>
    <?php 
    $select="SELECT * From clinic";
    $query=$conn->query($select);
    while($user=mysqli_fetch_assoc($query)) {
    ?>
    <option value="<?=$user['id']?>">
        <?=$user['clinic_name']?>
</option>
    <?php
    }
    ?>
    </select>
    <div id="clinicselecterr"></div>
</div>
<div class="col-md-12">
    <label for="roleSelect" class="form-label text-dark" style="font-weight: 500"  >User Role</label>
    <select name="roleSelect" id="roleSelect" class="form-control center">
    <option selected disabled >Please Select Roll</option>
    
    <option value="User">User</option>
    <option value="Admin">Admin</option>
   
    </select>
    <div id="roldeselecterr"></div>
</div>
  <div id="error"></div>
  <div class="col-md-12 ">
    <button type="submit" name="usersubmit" class="btn btn-dark ">Submit</button>
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
              <h5 class="card-title">User Data Table</h5>

              <!-- Default Table -->
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Full Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Address</th>                   
                    <th scope="col">Clinic Name</th>                   
                    <th scope="col">Role</th>                   
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
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fs-5 text-dark" style="font-weight: 800" id="exampleModalLabel">Edit Clinic </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action ="" method="POST" id="edt_user">

<div class="modal-body row g-2">
    <input type="hidden" name="edtuser" id="edtuser">
<div class="col-md-12">
<label for="edtfullname" class="form-label text-dark" style="font-weight: 500">Full Name</label>
<input type="text" class="form-control center"  name="edtfullname" id="edtfullname" placeholder="Full Name" required>
</div>
<div class="col-md-12">
<label for="edtuseremail" class="form-label text-dark" style="font-weight: 500">Email</label>
<input type="email" class="form-control center"  name="edtuseremail" id="edtuseremail" placeholder="Email" required>
<div id="edtemailerr" style="color:red;"></div>
</div>
<div class="col-md-12">
<label for="edtuseraddress" class="form-label text-dark" style="font-weight: 500"  >Address</label>
<textarea type="text" id="edtuseraddress" name="edtuseraddress" class="form-control md-textarea pt-1 py-0 pb-0" placeholder="Address" required></textarea>   
</div>

<div class="col-md-12">
<label for="edtclinicselect" class="form-label text-dark" style="font-weight: 500"  >Clinic Name</label>
<select name="edtclinicselect" id="edtclinicselect" class="form-control center">
<option selected disabled>Please Select Clinic</option>
<?php 
$select="SELECT * From clinic";
$query=$conn->query($select);
while($user=mysqli_fetch_assoc($query)) {
?>
<option value="<?=$user['id']?>">
  <?=$user['clinic_name']?>
</option>
<?php
}
?>
</select>
</div>
<div class="col-md-12">
<label for="edtroleSelect" class="form-label text-dark" style="font-weight: 500"  >User Role</label>
<select name="edtroleSelect" id="edtroleSelect" class="form-control center">
<option selected disabled >Please Select Roll</option>

<option value="User">User</option>
<option value="Admin">Admin</option>

</select>
</div>
<div id="error1"></div>
<div class="col-md-12 ">
<button type="submit" name="edtusersubmit" class="btn btn-dark ">Submit</button>
</div>

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
      $(document).ready(function() {
  $('#clinicselect').on('click', function() {
    $('#clinicselecterr').empty();
  });
});
$(document).ready(function() {
  $('#roleSelect').on('click', function() {
    $('#roldeselecterr').empty();
  });
});
$(document).ready(function() {
  $('#useremail').on('input', function() {
    $('#emailerr').empty();
  });
});
$(document).ready(function() {
  $('#userpassword').on('input', function() {
    $('#passworderr').empty();
  });
});
$(document).ready(function() {
  $('#edtuseremail').on('input', function() {
    $('#edtemailerr').empty();
  });
});
$('#add_user').submit(function(event){
event.preventDefault();

var userfullname = $('#fullname').val();
var useremail    = $('#useremail').val();
var useraddress  = $('#useraddress').val();
var userpassword = $('#userpassword').val();
var userclinic   = $('#clinicselect').val();
var userrole     = $('#roleSelect').val();
var error = false;

if (userclinic === "" || userclinic === null)
{
    //console.log('Unit select is empty!');
    $('#clinicselecterr').html('<div class="text-danger">Please select a unit</div>');
    error= true;
}
if (userrole === "" || userrole === null)
{
    //console.log('Unit select is empty!');
    $('#roldeselecterr').html('<div class="text-danger">Please select a Role</div>');
    error= true;
}

if (userpassword.length < 8 ){
    $('#passworderr').html('<div class="text-danger">Password Must be 8 char long.</div>');
    error= true;
}


if (error)
{
return;
}
$.ajax({
    
  type:'post',
  url:'action.php',
  data: 
  {
    'usersubmit':true,
    'userfullname':userfullname,
    'useremail':useremail,
    'useraddress':useraddress,
    'userpassword':userpassword,
    'userclinic':userclinic,
    'userrole':userrole
  },
  dataType: 'json',
  success:function(response){
    if (response.success) {
      $('#addUser').modal('hide');
        $('#msg').html('<div class="alert alert-success  align-items-center" style="float:right;"><strong>' + response.message + '<strong></div>');
        setTimeout(function(){
          $('#msg').html('');
        }, 3000);
      } else {
        $('#emailerr').text(response.message);
      }
  }
});
});

$(document).ready(function() {
  function getData() {
    $.ajax({
      type: "GET",
      url: "get_user.php",
      dataType: "json",
      success: function(data) {

        $('#table-body').html('');

        data.forEach(function(record) {
          var newRow = '<tr>' +
            '<td>' + record.id + '</td>' +
            '<td>' + record.userfullname + '</td>' +
            '<td>' + record.useremail + '</td>' +
            '<td>' + record.useraddress + '</td>' +
            '<td style="display:none;">' + record.userclinic_id + '</td>' +
            '<td>' + record.userclinicname + '</td>' +
            '<td>' + record.userrole + '</td>' +
            '<td>' +
            '<button class="editbtn btn btn-sm btn-dark tblbtn"  name="edtusersubmit" data-edit-id="'+ record.id +'"><i class="bi bi-pencil-square"></i></button>' +
            '<button class="delete btn btn-sm btn-danger tblbtn" name="deleteuser" data-delete-id="' + record.id + '"><i class="bi bi-trash"></i></button>' +
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
              'deleteuser':true,
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
            $('#edtuser').val(data[0]);
            $('#edtfullname').val(data[1]);
            $('#edtuseremail').val(data[2]);
            $('#edtuseraddress').val(data[3]);
            $('#edtclinicselect').val(data[4]);
            $('#edtroleSelect').val(data[6]);

            $('#edt_user').submit(function(event){
              event.preventDefault();
            var edt_userid       = $('#edtuser').val();
            var edt_fullname     = $('#edtfullname').val();
            var edt_useremail    = $('#edtuseremail').val();
            var edt_useraddress  = $('#edtuseraddress').val();
            var edt_clinicselect = $('#edtclinicselect').val();
            var edt_roleSelect   = $('#edtroleSelect').val();

            $.ajax({
                type:'post',
                url:'action.php',
                data:
                {
                  'edtusersubmit'   : true,
                  'edit-id'         : edt_userid,
                  'edt_fullname'    : edt_fullname,
                  'edt_useremail'   : edt_useremail,
                  'edt_useraddress' : edt_useraddress,
                  'edt_clinicselect': edt_clinicselect,
                  'edt_roleSelect'  : edt_roleSelect
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
            $('#edtemailerr').text(response.message);
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