<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  <link rel="stylesheet" href="login.css">
</head>
<body>
  <div class="container">
    <form class="login-form" action="loginaction.php" method="POST">
      <h1>Hello Admin</h1>
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Enter Username" required>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter Password" required>
      </div>
      <button class="login-btn">Login</button>
    </form>
  </div>
</body>
</html>