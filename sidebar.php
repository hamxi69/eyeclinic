
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
 
</head>
<body>

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <a class="nav-link collapsed" href="index.php">
      <i class="bi bi-grid"></i>
      <span>Dashboard</span>
    </a>
  </li><!-- End Dashboard Nav -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="userlst.php">
      <i class="bi bi-grid"></i>
      <span>Users</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" href="cliniclst.php">
      <i class="bi bi-grid"></i>
      <span>Clinics</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" href="appointmentlst.php">
      <i class="bi bi-grid"></i>
      <span>Appointments</span>
    </a>
  </li>
  
    
  <li class="nav-item">
    <a class="nav-link " data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-person-circle" ></i><span>User Management</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="tables-nav" class="nav-content collapse show " data-bs-parent="#sidebar-nav">
      <li>
        <a href="#" class="active">
          <i class="bi bi-card-list"></i><span>Registeration</span>
        </a>
      </li>
      <li>
        <a href="#" class="active">
          <i class="bi bi-person"></i><span>Profile</span>
        </a>
      </li>
      <li>
        <a href="logout.php" class="active">
          <i class="bi bi-box-arrow-in-right"></i><span>Logout</span>
        </a>
      </li>
      </li>
    </ul>
  </li><!-- End Tables Nav -->
</ul>

</aside><!-- End Sidebar-->
</body>
</html>