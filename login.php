<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Smart Diagnosis</title>
  <link rel="icon" href="Group 10.png" />
  <link rel="stylesheet" href="assets/css/style.css" />
  <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
</head>

<body>
  <div class="all">
    <div class="log">
      <img
        src="assets/images/Group 10.png"
        class="img-fluid w-50 logo"
        alt="" />
    </div>
    <section id="login" class="d-flex justify-content-between">
      <div class="info">
        <h1>Welcome to login system</h1>
        <h5>Sign in byentering the information below</h5>


        <!-- form -->
        <form action="dev/login/handel_login.php" method="POST">
        <?php if (isset($_SESSION["user"])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $_SESSION["user"]; ?>
                </div>
                <?php }
        unset($_SESSION["user"])
        ?>
          <div class="d-flex flex-column">
            <label for="name"><i class="fa-solid fa-user"></i></label>
            <input type="text" name="Email" placeholder="Email" />
          </div>
          <div class="d-flex flex-column">
            <label for="password"><i class="fa-solid fa-lock"></i></label>
            <input type="text" name="Password" placeholder="*********" />
          </div>

          <div class="d-flex justify-content-around buttons">
            <button type="submit" name="add" class="submit">Login</button>
            <a href="register.php" class="reg">Register</a>
          </div>
        </form>
        <!-- end form -->

      </div>
      <div>
        <img src="assets/images/image (5) .png" class="doctor" alt="" />
      </div>
    </section>
  </div>
</body>

</html>