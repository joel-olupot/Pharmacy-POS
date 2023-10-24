<?php
session_start();
  include("functions.php");

//$user_data = check_login($con); //checks if user is loged in put on all pages
require_once('connection.php');
$query = "select * from inventory";
$result = mysqli_query($conn,$query);

$totalSum = 0; // Variable to store the total sum for the dashboard

$rowCount = mysqli_num_rows($result); // count the number of rows

$totalQuantity = 0; // Variable to store the total quantity dasboard aswell


while ($row = mysqli_fetch_assoc($result)) {
  $totalQuantity += $row['quantity'];

  // Calculate the total sales
  $multipliedValue = $row['unit_price'] * $row['quantity'];
  $totalSum += $multipliedValue;

}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Inventory</title>
    <link rel="stylesheet" href="dashboard.css">
  </head>
  <body>
    <div class="container">
      <div class="sidebar">
        <div class="top">
          <div class="logo">
            <img src="./icons/drupal.png">
            <h2>phameds</h2>
          </div>
        </div>
        <a href="#" class="active">
          <img src="icons/dashboard (1).png">
          <h3>dashboard</h3>
        </a>
        <a href="./Sales.php" class="sales" onclick="selected1();">
          <img src="icons/plus.png">
          <h3>Sales</h3>
        </a>
        <a href="#" class="inventory active" onclick="selected();">
          <img src="icons/inventory.png">
          <h3>Inventory</h3>
        </a>
        <a href="./staff.php" class="staff" >
          <img src="icons/staff icon.png">
          <h3>Staff</h3>
        </a>
        <a href="./Logout.php">
          <img src="icons/enter.png">
          <h3>Log Out</h3>
        </a>
      </div>
      <!-- ---------END OF SIDEBAR----------------- -->

      <main>
        <div class="main-top">
          <div>
            <h1>Dashboard</h1>
          </div>
          <div class="right-top">
            <div class="theme-toggler">
              <button class="button1 active" onclick="
              changeTheme1();"><img class="toggle" src="icons/moon.png"></button>
              <button class="button2" onclick="
              changeTheme();
              "><img class="toggle" src="icons/brightness.png"></button>
            </div>
            <div class="profile">
              <div>
              <p><h5>reagan</h5></p>
              <small class="text-muted">Admin</small>
              </div>
              <div>
                <img src="pictures/124-1246857_employee-avatar-transparent-background-png-icone-chef-d.png">
              </div>
            </div>
          </div>
        </div>
<!-- -------------------end of HEADER----------------------- -->
        <!-- <div class="date">
          <input type="date">
        </div> -->
        <div class="insights">
          <div class="sales">
            
            <div class="middle">
              <img src="icons/product.png">
              <div class="left">
                <h2>Stock Price</h2>
                <h1>Shs.<?php echo number_format($totalSum); ?></h1>
              </div>
            </div>
            <small class="text-muted">Last 24 Hours</small>
          </div>


          <div class="inventory">
            
            <div class="middle">
              <img src="icons/inventory.png">
              <div class="left">
                <h2>Inventory</h2>
                <h1><?php echo $rowCount; ?></h1>
              </div>
            </div>
            <small class="text-muted">Last week</small>
          </div>


          <div class="status">
           
            <div class="middle">
              <img src="icons/medicine.png">
              <div class="left">
                <h2>Inventory</h2>
                <h1><?php echo $totalQuantity;?></h1>
              </div>
            </div>
            <small class="text-muted">Last 24 Hours</small>
          </div>
        </div>
<!-- ---------------------end of DASHBORD----------------------- -->
        <div class="table">
          <h2>Inventory</h2>
          <table>
            <thead>
              <tr>
                <th>Product</th>
                <th>Product Name</th>
                <th>Unit Price</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Expiry</th>
                <th>Category</th>
                <th>Description</th>
                <th>Add</th>
              </tr>
            </thead>
            <tbody>
              <!-- posts data to the db -->
              <form action="" method="post">
              <tr>
                <td><input type="text" name="id" value=""></td>
                <td><input type="text" id="input" name="name" value="" required></td>
                <td><input type="text" name="unit_price" value=""></td>
                <td><input type="text" name="quantity" value=""></td>
                <td><input type="text" name="price" value=""></td>
                <td><input type="date" name="expiry_date" value=""></td>
                <td><input id="input" type="text" name="category" value=""></td>
                <td><input id="input" type="text" name="description" value=""></td>
                <td><button type="submit" name="submit"><img src="icons/plus.png"></button></td>
              </tr>
                <?php
                  //posts data into the tables
                  require_once("connection.php");
                  if(isset($_POST["submit"]))
                  {
                    $id = $_POST["id"];
                    $name = $_POST["name"];
                    $expiry_date = $_POST["expiry_date"];
                    $unit_price = $_POST["unit_price"];
                    $quantity = $_POST["quantity"];
                    $category = $_POST["category"];
                    $description = $_POST["description"];

                    $queryy = "INSERT INTO inventory VALUES('$id','$name','$expiry_date','$unit_price','$quantity','$category','$description')";
                    
                    
                    mysqli_query($conn, $queryy);
                    
                  }

                ?>
                
              <tr>
                    <?php 
                    //displays data from the db table
                    mysqli_data_seek($result, 0); // Reset the result pointer to the beginning
                    while($row = mysqli_fetch_assoc($result))
                    {
                    ?>
                    <td><?php echo $row['id'];?></td>
                    <td><?php echo $row['name'];?></td>
                    <td><?php echo $row['unit_price'];?></td>
                    <td><?php echo $row['quantity'];?></td>
                    <td><?php echo $row['unit_price'] * $row['quantity'];?></td>
                    <td><?php echo $row['expiry_date'];?></td>
                    <td><?php echo $row['category'];?></td>
                    <td><?php echo $row['description'];?></td>

              </tr>
                  <?php
                    }

                    ?>
             
            </tbody>
          </table>
        </div>
      </main>
    </div>
  </body>
  <script>
    // changes theme
    
   const themeToggler = document.querySelector('.theme-toggler');
   themeToggler.addEventListener('click', () =>{
   document.body.classList.toggle('dark-theme-variables');
    })
  
  
  </script>
</html>
