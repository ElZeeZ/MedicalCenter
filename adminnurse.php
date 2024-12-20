<!DOCTYPE html>
<html>
<head>
<?php 
include('db-config/config.php');
  

  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $delete_id = intval($_POST['delete_id']);
    $stmt = $con->prepare("DELETE FROM nurse WHERE nurseID = ?");
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();
    $stmt->close();
    header("Location: " . $_SERVER['PHP_SELF']);
    
  }


  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_nurse'])) {
    $nurseID = intval($_POST['nurseID']);
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $phone = intval($_POST['phone']);
    $email = $_POST['email'];
    
    
    $stmt = $con->prepare("INSERT INTO nurse (nurseID, firstName, lastName,phone, email) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issis", $nurseID, $firstName, $lastName,$phone, $email);
    $stmt->execute();
    $stmt->close();
    header("Location: " . $_SERVER['PHP_SELF']);
      
  }

  $stmt = $con->prepare("SELECT * FROM `nurse`");
  $stmt->execute();
  $result = $stmt->get_result();
  ?>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="AdminT.css">
  <title> Nurses Database</title>
</head>
<body>
  <?php require "adminsidebar.php" ?> 
  <section class="pointer">
    <div class="item">
      <center>
        <p class="Panel"> Nurses Database </p> <br><br>
      </center>  
    </div>
  </section>
  <table id="userTable">
    <thead>
      <tr>
        <th>nurseID</th>
        <th>firstName</th>
        <th>lastName</th>
        <th>phone</th>
        <th>email</th>
      </tr>
    </thead>
    <tbody style="text-align: center;">
    <?php
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $selected_user_id = $row['nurseID'];
          echo "<tr>
                    <td style='display: flex; justify-content: center; align-items: center; gap: 10px;'>
              <form method='POST' action='' style='margin: 0;'>
              <input type='hidden' name='delete_id' value='" . $row['nurseID'] . "' />
            <button type='submit' style='background: none; border: none; cursor: pointer;'>❌</button>
          </form>
          " . $row['nurseID'] . "
        </td>
                    <td>" . $row['firstName'] . "</td>
                    <td>" . $row['lastName'] . "</td>
                    <td>" . $row['phone'] . "</td>
                    <td>" . $row['email'] . "</td>";

          echo "</tr>";
        }
      } else {
        echo "No Nurses Found.";
      }
      $stmt->close(); 
      ?>

    <tr>
      <form method="POST" action="">
        <td style="display: flex; justify-content: center; align-items: center; gap: 10px;">
          <button type="submit" name="add_nurse" style="background: none; border: none; cursor: pointer;">✅</button>
          <input type="number" name="nurseID" placeholder="ID" required style="width: 50px;">
        </td>
        <td><input type="text" name="firstName" placeholder="FirstName" required style="width: 110px;"></td>
        <td><input type="text" name="lastName" placeholder="LastName" required style="width: 110px;"></td>
        <td><input type="number" name="phone" placeholder="Number" required style="width: 110px;"></td>
        <td><input type="text" name="email" placeholder="example@gmail.com" required style="width: 250px;"></td>
      </form>
    </tr>   
    </tbody>
  </table>
</body>
</html>