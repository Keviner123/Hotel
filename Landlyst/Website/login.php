<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</head>
<body>
      <h2>Opret bruger</h2>

    <div style="width:50%">
  <form method="post" action="signup.php">
     <div class="input-group">
        <input class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" type="text" name="username" placeholder="Enter username" value="<?php echo $username; ?>">
      </div>
      <div class="input-group">
        <input class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" type="email" name="email" placeholder="Enter email" value="<?php echo $email; ?>">
      </div>
      <div class="input-group">
        <input class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" type="password" name="password" placeholder="Enter password">
      </div>
      <div class="input-group">
        <button type="submit" class="btn btn-primary" name="reg_user">Opret</button>
      </div>
    </form>
      <h2>Test login</h2>

  <form method="post" action="checkaccount.php">
     <div class="input-group">
        <input class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" type="text" name="username" placeholder="Enter username" value="<?php echo $username; ?>">
      </div>

      <div class="input-group">
        <input class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" type="password" name="password_1" placeholder="Enter password">
      </div>

      <div class="input-group">
        <button type="submit" class="btn btn-primary" name="reg_user">Login</button>
      </div>
    </form>
  </div>
</body>
</html>