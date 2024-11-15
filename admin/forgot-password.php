      <?php
        session_start();
        error_reporting(0);
        include('includes/config.php');

        if (isset($_POST['submit'])) {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = md5($_POST['newpassword']);
            $query = mysqli_query($con, "select id from tbladmin where  AdminEmailId='$email' and AdminUserName='$username' ");

            $ret = mysqli_num_rows($query);
            if ($ret > 0) {
                $query1 = mysqli_query($con, "update tbladmin set AdminPassword='$password'  where  AdminEmailId='$email' && AdminUserName='$username' ");
                if ($query1) {
                    echo "<script>alert('Password successfully changed');</script>";
                    echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
                }
            } else {

                echo "<script>alert('Invalid Details. Please try again.');</script>";
            }
        }

        ?>

      <!DOCTYPE html>
      <html lang="en">

      <head>

          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <meta name="description" content="Livr News  Portal.">
          <meta name="author" content="xyz">


          <!-- App title -->
          <title> CPSU BSIT Web Portal | Forgot Password</title>

          <!-- App css -->
          <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
          <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
          <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
          <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
          <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
          <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
          <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />

          <script src="assets/js/modernizr.min.js"></script>
          <script type="text/javascript">
              function checkpass() {
                  if (document.changepassword.newpassword.value != document.changepassword.confirmpassword.value) {
                      alert('New Password and Confirm Password field does not match');
                      document.changepassword.confirmpassword.focus();
                      return false;
                  }
                  return true;
              }
          </script>
      </head>
      <style>
          /* Styling the Form Group */
          .form-group.position-relative {
              position: relative;
              margin-bottom: 20px;
          }

          /* Styling the Input Fields */
          .form-control {
              width: 100%;
              padding: 10px 10px;
              font-size: 16px;
              border: 1px solid #ccc;
              border-radius: 5px;
              outline: none;
              background-color: #fff;
              transition: all 0.3s ease;
          }

          .form-control:focus {
              border-color: #8a2be2;
              box-shadow: 0 0 5px rgba(138, 43, 226, 0.5);
          }

          /* Floating Placeholder Styling */
          .floating-label {
              position: absolute;
              top: 50%;
              left: 10px;
              transform: translateY(-50%);
              font-size: 16px;
              color: #888;
              pointer-events: none;
              transition: all 0.3s ease;
          }

          /* When Input is Focused or Has Content */
          .form-control:focus~.floating-label,
          .form-control:not(:placeholder-shown)~.floating-label {
              top: 0;
              left: 10px;
              transform: translateY(-100%);
              font-size: 12px;
              color: #8a2be2;
          }

          /* Hide Placeholder Text */
          .form-control::placeholder {
              color: transparent;
          }

          /* Link Styling */
          .text-custom {
              color: #8a2be2;
              text-decoration: none;
          }

          .text-custom:hover {
              color: #000000;
              text-decoration: underline;
          }

          /* Button Styling */
          .btn-custom {
              background: linear-gradient(45deg, #000000, #8a2be2);
              color: white;
              border: none;
              border-radius: 5px;
              padding: 10px 20px;
              transition: all 0.3s ease;
          }

          .btn-custom:hover {
              background: linear-gradient(45deg, #8a2be2, #000000);
              color: white;
          }

          .logo {
              display: flex;
              align-items: center;
              justify-content: center;
              flex-wrap: wrap;
          }

          .logo img {
              max-width: 100%;
              height: auto;
          }

          .account-logo-box h2 {
              display: flex;
              justify-content: center;
              align-items: center;
              text-align: center;
          }

          @media (max-width: 767px) {
              .account-logo-box h2 {
                  flex-direction: column;
                  text-align: center;
              }
          }
      </style>


      <body class="bg-transparent">

          <!-- HOME -->
          <section>
              <div class="container-alt">
                  <div class="col-md-">
                      <div class="wrapper-page">
                          <div class="account-pages">
                              <div class="account-logo-box">
                                  <h2 class="text-uppercase">
                                      <div class="logo">
                                          <span class="d-inline-block"><img src="assets/images/bsit_logo.png" alt="" width="100px"></span>
                                          <span class="d-inline-block mr-2"><img src="assets/images/BSIT_name.webp" alt="" width="350px"></span>
                                      </div>
                                  </h2>
                                  <p>Please sign-in to your account and start the adventure</p>
                              </div>



                              <div class="account-content">
                                  <form class="form-horizontal" method="post">

                                      <!-- Username Input -->
                                      <div class="form-group position-relative">
                                          <input
                                              class="form-control"
                                              type="text"
                                              required
                                              name="username"
                                              id="username"
                                              autocomplete="off"
                                              placeholder=" " />
                                          <label for="username" class="floating-label">Username</label>
                                      </div>

                                      <!-- Email Input -->
                                      <div class="form-group position-relative">
                                          <input
                                              class="form-control"
                                              type="text"
                                              required
                                              name="email"
                                              id="email"
                                              autocomplete="off"
                                              placeholder=" " />
                                          <label for="email" class="floating-label">Email</label>
                                      </div>

                                      <!-- Confirm Password Input -->
                                      <div class="form-group position-relative">
                                          <input
                                              type="password"
                                              class="form-control"
                                              id="confirmpassword"
                                              name="confirmpassword"
                                              placeholder=" "
                                              required />
                                          <label for="confirmpassword" class="floating-label">Confirm Password</label>
                                      </div>

                                      <!-- New Password Input -->
                                      <div class="form-group position-relative">
                                          <input
                                              type="password"
                                              class="form-control"
                                              id="newpassword"
                                              name="newpassword"
                                              placeholder=" "
                                              required />
                                          <label for="newpassword" class="floating-label">New Password</label>
                                      </div>

                                      <!-- Reset Button -->
                                      <div class="form-group account-btn text-center m-t-10">
                                          <button
                                              class="btn btn-custom waves-effect waves-light btn-md w-100"
                                              type="submit"
                                              name="submit">
                                              Reset
                                          </button>
                                      </div>
                                  </form>

                                  <div class="clearfix"></div>
                                  <a href="../index.php" class="text-custom"><i class="mdi mdi-home"></i> Back Home</a>
                              </div>
                          </div>
                          <!-- end card-box -->

                      </div>
                      <!-- end wrapper -->

                  </div>
              </div>
              </div>
          </section>
          <!-- END HOME -->

          <!-- Scripts -->
          <script>
              var resizefunc = [];
          </script>

          <!-- jQuery  -->
          <script src="assets/js/jquery.min.js"></script>
          <script src="assets/js/bootstrap.min.js"></script>
          <script src="assets/js/detect.js"></script>
          <script src="assets/js/fastclick.js"></script>
          <script src="assets/js/jquery.blockUI.js"></script>
          <script src="assets/js/waves.js"></script>
          <script src="assets/js/jquery.slimscroll.js"></script>
          <script src="assets/js/jquery.scrollTo.min.js"></script>
          <script src="assets/js/jquery.core.js"></script>
          <script src="assets/js/jquery.app.js"></script>

      </body>