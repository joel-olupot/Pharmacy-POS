<?php
session_start();
  //include("connection.php");
  include("functions.php");

//$user_data = check_login($con); //checks if user is loged in put on all pages
require_once('connection.php');
$query = "select * from sales";
$result = mysqli_query($conn,$query);

$totalSum = 0; // Variable to store the total sum


$rowCount = mysqli_num_rows($result); // Get the number of rows


$totalQuantity = 0; // Variable to store the total quantity

while ($row = mysqli_fetch_assoc($result)) {
    $totalQuantity += $row['quantity'];

    // Calculate the total sales
    $multipliedValue = $row['unit_price'] * $row['quantity'];
    $totalSum += $multipliedValue;

    // Display the other table data
    // ...
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Sales</title>
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
        <a href="#" class="sales active" onclick="selected1();">
          <img src="icons/plus.png">
          <h3>Sales</h3>
        </a>
        <a href="./Inventory.php" class="inventory" onclick="selected();">
          <img src="icons/inventory.png">
          <h3>Inventory</h3>
        </a>
        <a href="./staff.php" class="staff">
          <img src="icons/staff icon.png">
          <h3>Staff</h3>
        </a>
        <!-- <a href="#" class="reports" onclick="selected2();">
          <img src="icons/medicine.png">
          <h3>Reports</h3>
        </a> -->
        <a href="./Logout.php">
          <img src="icons/enter.png">
          <h3>Log out</h3>
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
              <p><h5>Reagan</h5></p>
              <small class="text-muted">Admin</small>
              </div>
              <div>
                <img src="pictures/124-1246857_employee-avatar-transparent-background-png-icone-chef-d.png">
              </div>
            </div>
          </div>
        </div>

        <!-- <div class="date">
          <input type="date">
        </div> -->
        <div class="insights">
          <div class="sales">
            
            <div class="middle">
              <img src="icons/product.png">
              <div class="left">
                <h2>Total Sales</h2>
                <h1>Shs.<?php echo number_format($totalSum); ?></h1>
              </div>
            </div>
            <small class="text-muted">Last 24 Hours</small>
          </div>


          <div class="inventory">
            
            <div class="middle">
              <img src="icons/inventory.png">
              <div class="left">
                <h2>Sales Number</h2>
                <h1><?php echo $rowCount;?></h1>
              </div>
            </div>
            <small class="text-muted">Last week</small>
          </div>
          

          <div class="status">
           
            <div class="middle">
              <img src="icons/medicine.png">
              <div class="left">
                <h2>Inventory Sold</h2>
                <h1><?php echo $totalQuantity;             
                ?></h1>
              </div>
            </div>
            <small class="text-muted">Last 24 Hours</small>
          </div>
        </div>

        <div class="table">
          <h2>Sales</h2>
          <table>
            <thead>
              <tr>
                <th>id</th>
                <th>date</th>
                <th>name</th>
                <th>unit price</th>
                <th>quantity</th>
              </tr>
            </thead>
            <tbody>
              <form action="" method="post">
              <tr>
                <td><input type="text" name="id" value=""></td>
                <td><input type="date" name="date" value="<?php echo date('Y-m-d'); ?>"></td>
                <td><input type="text" id="input" name="name" value="" required></td>
                <td><input type="text" name="unit_price" value=""></td>
                <td><input type="text" name="quantity" value=""></td>
                <td><button type="submit" name="submit"><img src="icons/shopping cart.png"></button></td>
              </tr>
<?php
  require_once('connection.php');
  if(isset($_POST["submit"]))
  {
    $id = $_POST["id"];
    $date = $_POST["date"];
    $name = $_POST["name"];
    $unit_price = $_POST["unit_price"];
    $quantity = $_POST["quantity"];
    
    $queryy = "INSERT INTO sales VALUES('$id','$date','$name','$unit_price','$quantity')";
    
    
    mysqli_query($conn, $queryy);
    
  }

  

?>
 
              <tr>
    <?php 
     mysqli_data_seek($result, 0); // Reset the result pointer to the beginning
    while($row = mysqli_fetch_assoc($result))
    {
    ?>
    <td><?php echo $row['id'];?></td>
    <td><?php echo $row['date'];?></td>
    <td><?php echo $row['name'];?></td>
    <td><?php echo $row['unit_price'];?></td>
    <td><?php echo $row['quantity'];?></td>
    <td><?php echo $row['unit_price'] * $row['quantity'];?></td>
   

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
    const themeToggler = document.querySelector('.theme-toggler');
themeToggler.addEventListener('click', () =>{
  document.body.classList.toggle('dark-theme-variables');
  })
  </script>
</html>