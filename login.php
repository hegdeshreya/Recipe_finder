
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">
  <title>Signin Template for Bootstrap</title>
  <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sign-in/">
  <!-- Bootstrap core CSS -->
  <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link rel="stylesheet" href="./CSS/signup.css">
</head>

<body class="text-center">
  <div class="bg-image"></div>
  <div class="overlay"></div>
  <div class="container">
    <form class="form-signin" action="login.php" method="post">
      <h1 class="h3 mb-3 font-weight-normal">Please Sign In</h1>
      <label for="email" class="sr-only">Email address</label>
      <input type="email" id="email" name="email" class="form-control" placeholder="Email address" required autofocus>
      <label for="password" class="sr-only">Password</label>
      <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
      <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Sign in</button>
      <!-- <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p> -->
      <a href="register.php" class="text-white">Create Account</a>
    </form>
  </div>
</body>
</html>

<?php 
session_start(); // Start the PHP session

include ('connection/db.php');

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    // Use a prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM user WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $pass);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Authentication successful, retrieve the user's name
        $row = $result->fetch_assoc();
        $_SESSION['email'] = $email;
        $_SESSION['user_name'] = $row['name']; // Store the user's name in session
        header('location: index.php');
        exit();
    } else {
        echo "<script>alert('Email or password is incorrect. Please try again!')</script>";
    }
}
?>


