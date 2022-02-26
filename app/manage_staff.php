<?php
include("session.php");

if (isset($_GET['id'])) {
  $staff_id = $_GET['id'];
  $get_staff_query = "SELECT * FROM staff WHERE id = '$staff_id'";
  $get_staff_result = mysqli_query($db, $get_staff_query);
  if (mysqli_num_rows($get_staff_result) == 1) {
    $staff = mysqli_fetch_array($get_staff_result);
    $isUpdate = true;
  } else {
    header("location: staffs.php");
  }
} else {
  $prev_id_query = "SELECT id FROM staff ORDER BY id DESC LIMIT 1";
  $prev_id = mysqli_fetch_array(mysqli_query($db, $prev_id_query));
  $staff_id = "ST" . sprintf("%06d", substr($prev_id['id'], 2) + 1);
  $isUpdate = false;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $type = mysqli_real_escape_string($db, $_POST['type']);
  $first_name = mysqli_real_escape_string($db, $_POST['first_name']);
  $last_name = mysqli_real_escape_string($db, $_POST['last_name']);
  $gender = mysqli_real_escape_string($db, $_POST['gender']);
  $date_of_birth = mysqli_real_escape_string($db, $_POST['date_of_birth']);
  $contact_no = mysqli_real_escape_string($db, $_POST['contact_no']);
  $address = mysqli_real_escape_string($db, $_POST['address']);

  if ($isUpdate) {
      $staff_query = "UPDATE staff SET
        first_name = '$first_name',
        last_name = '$last_name',
        gender = '$gender',
        date_of_birth = '$date_of_birth', 
        contact_no = '$contact_no', 
        address = '$address', 
        type = '$type' 
        WHERE id = '$staff_id'";
  } else {
    $staff_query = "INSERT INTO staff VALUES(
      '$staff_id', 
      '$first_name', 
      '$last_name', 
      '$gender', 
      '$date_of_birth', 
      '$contact_no', 
      '$address', 
      '$type')";
  }

  try {
    $staff_result = mysqli_query($db, $staff_query);
    header("location: staffs.php");
  } catch (Exception) {
    die("Error Occured!");
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    Quarantine Centre Management System
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/b470dbb387.js" crossorigin="anonymous"></script>
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="../assets/css/argon-dashboard.css?v=2.0.0" rel="stylesheet" />
  <link href="../assets/css/custom.css" rel="stylesheet" />
</head>

<body class="g-sidenav-show bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>
  <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/argon-dashboard/example_pages/dashboard.html " target="_blank">
        <img src="../assets/img/logo-ct-dark.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold">Quarantine Centre</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="../example_pages/dashboard.html">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-users-medical text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Staffs</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="#">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-user-group text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Clients</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="#">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-house-chimney-medical text-success text-sm"></i>
            </div>
            <span class="nav-link-text ms-1">Rooms</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="#">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-vial text-success text-sm"></i>
            </div>
            <span class="nav-link-text ms-1">Test Results</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="#">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Inventry</span>
          </a>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="../example_pages/profile.html">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Profile</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Admin Dashboard</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Staffs</li>
          </ol>
          <h6 class="font-weight-bolder text-white mb-0">Update Staff</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                </div>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-lg-8">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Register new Staff</h6>
            </div>
            <div class="card-body pt-0 pb-2">
              <form action="" method="POST">
                <div class="row form-group">
                  <div class="col-md-6">
                    <label>Staff Id</label>
                    <input type="text" class="form-control" name="client_id" value="<?php echo $staff_id ?>" disabled>
                  </div>
                  <div class="col-md-6">
                    <label>Type</label>
                    <select class="form-control" name="type">
                      <option></option>
                      <?php if($isUpdate){?>
                        <option <?php if ( $staff["type"] == "MANAGEMENT") echo "selected";?> > MANAGEMENT </option>
                        <option <?php if ( $staff["type"] == "ACCOUNTING") echo "selected";?> > ACCOUNTING </option>
                        <option <?php if ( $staff["type"] == "LABORATORY") echo "selected";?> > LABORATORY </option>
                        <option <?php if ( $staff["type"] == "CLEANING") echo "selected";?> > CLEANING </option>
                        <option <?php if ( $staff["type"] == "SUPPORTING ") echo "selected";?> > SUPPORTING  </option>
                        <option <?php if ( $staff["type"] == "SECURITY") echo "selected";?> > SECURITY </option>
                      <?php } else { ?>
                        <option>MANAGEMENT</option>
                        <option>ACCOUNTING</option>
                        <option>LABORATORY</option>
                        <option>CLEANING  </option>
                        <option>SUPPORTING</option>
                        <option>SECURITY  </option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-md-6">
                    <label>First Name</label>
                    <input type="text" class="form-control" name="first_name" placeholder="John" <?php if ($isUpdate) echo "value='" . $staff["first_name"] . "'"; ?>>
                  </div>
                  <div class="col-md-6">
                    <label for="last_name">Last Name</label>
                    <input type="text" class="form-control" name="last_name" placeholder="Doe" <?php if ($isUpdate) echo "value='" . $staff["last_name"] . "'"; ?>>
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-md-6">
                    <label>Gender</label>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="gender" value="M" <?php if ($isUpdate && $staff["gender"] == "M") echo 'checked="checked"' ?>>
                      <label class="custom-control-label">Male</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="gender" value="F" <?php if ($isUpdate && $staff["gender"] == "F") echo 'checked="checked"' ?>>
                      <label class="custom-control-label">Female</label>
                    </div>
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-md-6">
                    <label>Date of Birth</label>
                    <input class="form-control" type="date" name="date_of_birth" <?php if ($isUpdate) echo "value='" . $staff["date_of_birth"] . "'"; ?>>
                  </div>
                  <div class="col-md-6">
                    <label>Contact Number</label>
                    <input class="form-control" type="text" placeholder="07XXXXXXXX" name="contact_no" <?php if ($isUpdate) echo "value='" . $staff["contact_no"] . "'"; ?>>
                  </div>
                </div>
                <div class="form-group">
                  <label>Address</label>
                  <textarea class="form-control" name="address" rows="2"><?php if ($isUpdate) echo $staff["address"]; ?></textarea>
                </div>
                <input type="submit" class="btn bg-gradient-primary" value="<?php echo $isUpdate ? "Save" : "Submit" ?>">
              </form>
            </div>
          </div>
        </div>
      </div>
      <footer class="footer pt-3  ">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-start">
                © <script>
                  document.write(new Date().getFullYear())
                </script>,
                made with <i class="fa fa-heart"></i> by
                <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative Tim</a>
                for a better web.
              </div>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </main>
  <div class="dark-mode-plugin">
    <button class="btn btn-round dark-mode-plugin-button text-dark position-fixed px-3 py-2" onclick="darkMode(this)">
      <i class="fa-solid fa-moon py-2"> </i>
    </button>
  </div>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/argon-dashboard.js?v=2.0.0"></script>
</body>

</html>