<?php

session_start();
  // include("connection.php");
  include("functions.php");
  include("connection.php");


   if($_SERVER['REQUEST_METHOD'] == "POST")
     {
      //SMTHG POSTED
      $user_name = $_POST['user_name'];
      $password = $_POST['password'];

      if(!empty($user_name) && !empty($password) && !is_numeric($user_name) )
      {
          //read from db 
          $query = "select * from users where user_name = '$user_name' limit 1";

          $result = mysqli_query($conn, $query);

        if($result)
        {
          if($result && mysqli_num_rows($result) > 0)
            {
              $user_data = mysqli_fetch_assoc($result);
              
              if($user_data['password'] === $password)
              {
                $_SESSION['user_id'] = $user_data['user_id'];
                header("Location: sales.php");
                die;
              }
            }
        }
        echo "wrong username or password!!!";
      }else{
        echo "enter valid information!!!";
      }
     }
?>
<!DOCTYPE html>
<html>
  <head>
    <title>login</title>
    <link rel="stylesheet" href="general.css">
    <link rel="stylesheet" href="login.css">
  </head>
  <body>
    <div class="page">
      
      <div class="container">
        <div class="switch">
          <div id="toggle"></div>
          <button class="btn" onclick="staff()">Staff</button>
          <button class="btn" onclick="admin()">Admin</button>
        </div>
       <form method="post" id="staff" class="input-group">
        <input type="text" class="input" name="user_name"  required>
        <label  class="input-label1">Username</label>
        <input type="password" class="input" name="password"   required>
        <label  class="input-label2">Enter password</label>
        
        <button class="submit">submit</button>
        
        
       </form>
       <form method="post" id="admin" class="input-group">
        <input type="text" class="input" name="user_name" placeholder="Admin">
        <input type="password" class="input" placeholder="Pin" name="password" required>
        
        <button type="submit" class="submit">Login</button>
        
        
       </form>


      </div>
    </div>
    <script>
      let x = document.getElementById('staff');
      let y = document.getElementById('admin');
      let z = document.getElementById('toggle');

      function staff(){
        x.style.left = "50px";
        y.style.left = "420px";
        z.style.left = "0px";

      }
      function admin(){
        x.style.left = '-365px';
        y.style.left = '50px';
        z.style.left = "110px";

      }
    </script>
  </body>
</html>