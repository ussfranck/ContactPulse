<!-- Build Date 5, Mon, 2024 -> 2:10PM -->
<?php 
  session_start();
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register-submit'])) {
    $fullName = $_POST['full-name'];
    $email = $_POST['user_email'];
    $password = $_POST['user_password'];
    $confirmPassword = $_POST['user__c_password'];

    if (empty($fullName) || empty($email) || empty($password) || empty($confirmPassword)) {
      $errorMessage = "All fields must be completed.";
    } elseif ($password !== $confirmPassword) {
      $errorMessage = "The passwords do not match.";
    } else {
      $result = registerUser($fullName, $email, $password);
      if ($result) {
        header("Location: home.php");
        exit();
      } else {
        $errorMessage = $result;
      }
    }
  }

  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login-submit'])) {
    $email = $_POST['login_email'];
    $password = $_POST['login_password'];

    if (empty($email) || empty($password)) {
      $loginErrorMessage = "All fields must be completed.";
    } else {
      $user = logInUser($email, $password);
      if ($user != null) {
        $_SESSION['user'] = $user;
        header("Location: home.php");
          exit();
      } else {
      $loginErrorMessage = "Incorrect login. Please try again.";
      }
    }
  }

  function logInUser($email, $password) {
    $users = json_decode(file_get_contents('../data/users.json'));

    foreach ($users as $user) {
        if ($user['email'] === $email && password_verify($password, $user['password'])) {
            return $user;
        }
    }
    return null;
}

  function registerUser($fullName, $email, $password) {
    $usersPath = "../data/users.json";
    $users = json_decode(file_get_contents($usersPath), true);
    foreach ($users as $user) {
      if ($user['email'] === $email) {
        $errorMessage = "This e-mail is already associated with an account.";
          return false;
          }
      }
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $newUser = array("fullname" => $fullName, "email" => $email, "password" => $hashedPassword);
    $users[] = $newUser;
    file_put_contents($usersPath, json_encode($users, JSON_PRETTY_PRINT));
    return true;
  }
?>
<!DOCTYPE html>
<html lang="en-us" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/styles.css">
  <title>PulseContact • Auth</title>
</head>
<body class="body-auth-screen flex">
  <main class="auth-scene flex" id="swup">
    <h2 class="title">Depending on your case, choose the route <br> that suits you best - it takes 2 minutes in general.</h2>
    <div class="auth-forms-container grid">
      <div>
        <form class="login-form flex" method="POST" action="">
            <h3>Login</h3>
            <?php if (isset($loginErrorMessage)): ?>
        <div class="error-message">
            <?php echo $loginErrorMessage; ?>
        </div>
    <?php endif; ?>
            <div class="input-field flex">
            <label class="label" for="input">Enter Email</label>
              <input required class="input" name="login_email" placeholder="Your Email ID" type="text" />
            </div>
            <div class="input-field flex">
            <label class="label" for="input">Enter Password</label>
              <input required class="input" name="login_password" type="password" placeholder="Password" />
            </div>
            <a>Forgot your password?</a>
            <button class="button primary-btn" name="login-submit">Sign In</button>
          </form>
      </div>
      <div>
      <form class="register-form flex" method="POST" action="">
            <h3>Register</h3>
            <?php if (isset($errorMessage)): ?>
              <div class="error-message">
                  <?php echo $errorMessage; ?>
              </div>
            <?php endif; ?>
            <div class="input-field flex">
            <label class="label" for="input">Full Name</label>
              <input required class="input" name="full-name" placeholder="E.g Franck M." type="text" />
            </div>
            <div class="input-field flex">
            <label class="label" for="input">Email</label>
              <input required class="input" name="user_email" type="email" placeholder="Email" />
            </div>
            <div class="input-field flex">
            <label class="label" for="input">Password</label>
              <input required class="input" name="user_password" type="password" placeholder="Password" />
            </div>
            <div class="input-field flex">
            <label class="label" for="input">Re-type you password</label>
              <input class="input" name="user__c_password" type="password" placeholder="Confirm here" />
            </div>
            <a>Learn more about this software before you usage, your accept these terms when you create you account</a>
            <button class="button primary-btn" type="submit" name="register-submit">Create My Account</button>
        </form>
      </div>
    </div>
  </main>
  <?php include 'footer.php'; ?>
</body>
</html>