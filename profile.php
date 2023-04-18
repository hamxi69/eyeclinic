  <?php
  session_start();

  // Check if user is logged in
  // if (!isset($_SESSION['uid'])) {
  //   header("Location:login.php");
  //   exit;
  // }

  require_once("dbconnect.php");
  include_once("sidebar.php");
  include_once("header.php");

 ?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Digital Complain</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="logo.png" rel="icon" style="width:50rem;" >
    <link href="logo.png" rel="icon" style="width:50rem;" >

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
  </head>

  <body>
    <main id="main" class="main">
    


    <div id="msg" class="col-lg-3 mx-auto text-center"></div>


      <div class="pagetitle">
        <h1>Profile</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item">Users</li>
            <li class="breadcrumb-item active">Profile</li>
          </ol>
        </nav>
      </div><!-- End Page Title -->

      <section class="section profile">
        <div class="row">
          <div class="col-xl-4">

            <div class="card">
              <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                <h2 id="profilename"></h2>
                <h3 id="profileCid"></h3>
                <div class="social-links mt-2">
                  <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                  <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                  <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                  <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
            </div>

          </div>

          <div class="col-xl-8">

            <div class="card">
              <div class="card-body pt-3">
                <!-- Bordered Tabs -->
                <ul class="nav nav-tabs nav-tabs-bordered">

                  <li class="nav-item">
                    <button class="nav-link active" id="btn1" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                  </li>

                  <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                  </li>

                  
                  <li class="nav-item">
                    <button class="nav-link" id="btn" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                  </li>

                </ul>
              
                <div class="tab-content pt-2">

                  <div class="tab-pane fade show active profile-overview" id="profile-overview">
                    <h5 class="card-title">About</h5>
                    <p class="small fst-italic">Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</p>

                    <h5 class="card-title">Profile Details</h5>

                    <div class="row">
                      <div class="col-lg-3 col-md-4 label ">Full Name</div>
                      <div class="col-lg-9 col-md-8" id="overviewName"></div>
                    </div>
  
                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Email</div>
                      <div class="col-lg-9 col-md-8" id="overviewEmail"></div>
                    </div>

                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Contact</div>
                      <div class="col-lg-9 col-md-8" id="overviewContact"></div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Address</div>
                      <div class="col-lg-9 col-md-8" id="overviewAddress"></div>
                    </div>

                  </div>

                  <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                  <?php
                $user=$_SESSION['uid'];
                $userData="SELECT * FROM users where ID=$user";
                $hit_query=mysqli_query($conn,$userData);
                $row=mysqli_fetch_assoc($hit_query);
                ?>
                    <!-- Profile Edit Form -->
                    <form action="changeprofile.php" method="Post" id="changeprofile" >
                      

                      <div class="row mb-3"> 
                        
                        <input type="hidden" id="id" name="uid" value="<?=$user?>">
                        <label for="Name" class="col-md-4 col-lg-3 col-form-label">Name</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="Name" type="text" class="form-control" id="Name" value="<?=$row['Name']?>">
                          <div id="Nameerr" style="color:red;"></div>
                        </div>
                      </div>
                      
                      <div class="row mb-3">
                        <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="Email" type="email" class="form-control" id="Email" value="<?=$row['Email']?>">
                          <div id="Emailerr" style="color:red;"></div>
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="Contact" class="col-md-4 col-lg-3 col-form-label">Contact Number</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="Contact" type="text" class="form-control" id="Contact" value="<?=$row['Contact']?>">
                          <div id="Contacterr" style="color:red;"></div>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="Address" type="text" class="form-control" id="Address" value="<?=$row['Address']?>">
                          <div id="Addresserr" style="color:red;"></div>
                        </div>
                      </div>

                      <div id="successMsg" style="text-align:center; font-weight:bold;"></div>
                      <div id="errorMsg" style="text-align:center; color:red;"></div>
        
                      <div class="text-center">
                        <button type="submit" name="update_user"  class="btn btn-primary">Save Changes</button>
                      </div>
                    </form><!-- End Profile Edit Form -->

                  </div>

                  

                  <div class="tab-pane fade pt-3" id="profile-change-password">
                    <!-- Change Password Form -->
                    <form method="POST" id="changePasswordForm">
                            <input type="hidden" name="uid" value="<?=$user?>">
                      <div class="row mb-3">
                        <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="password" type="password" class="form-control" id="currentPassword">
                          <div id="current-error" style="color:red;"></div>
                          <div id="errorMsg1" style="color:red;"></div>

                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="newpassword" type="password" class="form-control" id="newPassword">
                          <div id="newPassword-error" style="color:red;"></div>
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                            <div id="reNew-error" style="color:red;"></div>
                        </div>
                      </div>
                      <div id="errorMsg2" style="color:red;" ></div>
                      <div class="text-center">
                        <button type="submit" name="changepassword" class="btn btn-primary">Change Password</button>
                      </div>

                    </form><!-- End Change Password Form -->
  
                  </div>

                </div><!-- End Bordered Tabs -->

              </div>
            </div>

          </div>
        </div>
      </section>

    </main><!-- End #main -->

    <?php
 include_once("footer.php");
 ?>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="assets/js/user.js"></script>
    <script src="assets/js/main.js"></script>
    <script>
 $('#Name, #Email, #Contact, #Address').keyup(function() {
  var input = $(this);
  var errorEl = $('#' + input.attr('id') + 'err');
  if (input.val() === '') 
  {
    errorEl.addClass('error');
    errorEl.text('Please enter your ' + input.attr('name').toLowerCase());
  } else
   {
    errorEl.removeClass('error');
    errorEl.text('');
    
    if (input.attr('id') === 'Email' && $('#email-error').hasClass('error')) 
    {
      $('#email-error').removeClass('error');
      $('#email-error').text('');
    }
    if (input.attr('id') === 'Contact') 
    {
      var phoneRegex = /^[0-9]{11}$/;
      if (!phoneRegex.test(input.val())) 
      {
        errorEl.addClass('error');
        errorEl.text('Please, Enter valid Format (03452990865)');
      }
    }
  }
});

$('#changeprofile').submit(function(event) {
  event.preventDefault();
  var id        = $('#id').val();
  var name      = $('#Name').val();
  var email     = $('#Email').val();
  var contact   = $('#Contact').val();
  var Address   = $('#Address').val();

  var error = false;

  if (name.trim() == '')
  {
    $('#Nameerr').addClass('error');
    $('#Nameerr').text('Please, Enter Your Name');
     error = true;
  }
  if (email.trim() == '')
  {
    $('#Emailerr').addClass('error');
    $('#Emailerr').text('Please, Enter Your Email');
    error = true;
  }
  if (contact.trim() == '')
  {
    $('#Contacterr').addClass('error');
    $('#Contacterr').text('Please, Enter Your Contact');
    error = true;
  }
  if (Address.trim() == '')
  {
    $('#Addresserr').addClass('error');
    $('#Addresserr').text('Please, Enter Your Address');
    error = true;
  }
  

  if (error)
  {
    return;
  }
   //Send AJAX request
   $.ajax({
    type: 'POST',
    url: 'action.php',
    data: {
        'update_user': true,
        'uid':id,
        'NAME': name,
        'EMAIL': email,
        'CONTACT': contact,
        'ADDRESS': Address
    },
    dataType: 'json',
    success: function(response) {
        if (response.success) {
            $('#msg').html('<div class="alert alert-warning" ><strong>' + response.message + '<strong></div>');
            setTimeout(function()
            {
            $('#msg').html('');
            }, 3000);
          } 
            else {
            // Show error message
            $('#errorMsg').text(response.message);
        }
    },
    error: function(xhr, textStatus, errorThrown) {
        // Show error message
        $('#errorMsg').text('Error updating user information.');
    }
});
});

// Password form 

$('#changePasswordForm').submit(function(event) {
  event.preventDefault();
  var id=$('#id').val();
  var currentPassword = $('#currentPassword').val();
  var newPassword = $('#newPassword').val();
  var confirmPassword = $('#renewPassword').val();
 
  var errors = false;
  if (currentPassword== '') {
    $('#current-error').addClass('error');
    $('#current-error').text('Please Enter Your Current Password');
    errors = true;
  }
  if (newPassword== '') {
    $('#newPassword-error').addClass('error');
    $('#newPassword-error').text('Please Enter Your New Password');
    errors = true;
  } else if (newPassword.length < 8) {
    $('#newPassword-error').addClass('error');
    $('#newPassword-error').text('New Password must be at least 8 characters long');
    errors = true;
  }

  if (confirmPassword== '') {
    $('#reNew-error').addClass('error');
    $('#reNew-error').text('Please Enter Your Confirm Password');
    errors = true;
  } else if (newPassword != confirmPassword) {
    $('#reNew-error').addClass('error');
    $('#reNew-error').text('New Password and Confirm Password do not match');
    errors = true;
  }
  
  if ($('#current-error').text() || $('#newPassword-error').text() || $('#reNew-error').text() ) {
    errors = true;
  }

  if (errors) {
    return;
  }
   $.ajax({
    type: 'POST',
    url: 'action.php',
    data: {
        'changepassword': true,
        'uid': id,
        'password': currentPassword,
        'newpassword': newPassword,
        'renewpassword': confirmPassword      
    },
    dataType: 'json',
    success: function(response) {
        if (response.success) {
            // Show success message
            $('#msg').html('<div class="alert alert-warning" ><strong>' + response.message + '<strong></div>');
            setTimeout(function()
            {
            $('#msg').html('');
            }, 3000);
            $('#currentPassword').val('');
            $('#newPassword').val('');
            $('#renewPassword').val('');
          } else {
            // Show error message
            $('#errorMsg1').text(response.message);
        }
    },
    error: function(xhr, textStatus, errorThrown) {
        // Show error message
        $('#errorMsg2').text('Error updating user information.');
    }
});
});
$('#currentPassword').on('input', function() {
  $('#current-error').text('');
  $('#errorMsg1').text('');
});

$('#newPassword').on('input', function() {
  $('#newPassword-error').text('');
});

$('#renewPassword').on('input', function() {
  $('#reNew-error').text('');
});


    </script>
  
  </body>

  </html>
 