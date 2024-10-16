<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>Login</title>
  <!-- MDB icon -->
  <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
  <!-- MDB -->
  <link rel="stylesheet" href="css/bootstrap-login-form.min.css" />
</head>

<body>
  <!-- Start your project here-->

  <style>
    .divider:after,
    .divider:before {
      content: "";
      flex: 1;
      height: 1px;
      background: #eee;
    }
    .h-custom {
      height: calc(100% - 73px);
    }
    @media (max-width: 450px) {
      .h-custom {
        height: 100%;
      }
    }
    
    .form-group input{
        width: 100%;
        padding: 10px;
        box-sizing: border-box;
        border: none;
        border-bottom: 2px solid #ecf0f1;
        background-color: transparent;
        outline: none;
        color: #ecf0f1;
        font-size: 16px;
        transition: border-color 0.3s ease-in-out, color 0.3s ease-in-out;
    }
  </style>
  <section class="vh-100">
    <div class="container-fluid h-custom">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-9 col-lg-6 col-xl-5">
          <img src="img/logo.png" class="img-fluid" alt="Sample image" width="250" style="margin-bottom: 40px;margin-top:-50px; display: block; margin-left: auto; margin-right: auto;">
          <img src="img/Component 3.png" class="img-fluid" alt="Sample image" width="500">
        </div>
        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1" style="margin-top: -100px;">
          <form action="pro_login_karyawan.php" method="post">
                <!-- Email input -->
               <div class="form-group" style="margin-bottom:10px">
                <input type="text" class="form-control" name="username" id="exampleInputEmail1" placeholder="Enter Username">
                </div>
                
            <!-- Password input -->
            <div class="form-group" style="margin-bottom:10px">
             <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
             </div>

            <div class="d-flex justify-content-between align-items-center">
              <!-- Checkbox -->
              <div class="form-check mb-0">
                <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                <label class="form-check-label" for="form2Example3">
                  Remember me
                </label>
              </div>
              <a href="#!" class="text-body">Forgot password?</a>
            </div>

            <div class="text-center text-lg-start mt-4 pt-2">
              <button type="submit" value="Login" class="btn btn-primary btn-lg"
                style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
            </div>

          </form>
        </div>
      </div>
    </div>
    <div class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-m-5 bg-primary" style="height: 67px;">
      <!-- Copyright -->
      <div class="text-white mb-3 mb-md-0">
        Copyright © GBI Cibubur Raya 2024.
      </div>
      <!-- Copyright -->
    </div>
  </section>
  <!-- End your project here-->

  <!-- MDB -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <!-- Custom scripts -->
  <script type="text/javascript"></script>
</body>

</html>