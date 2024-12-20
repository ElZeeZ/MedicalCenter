<!DOCTYPE html>
<html>
<head>
<?php 
include('db-config/config.php');
  

  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $delete_id = intval($_POST['delete_id']);
    $stmt = $con->prepare("DELETE FROM doctor WHERE doctorID = ?");
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();
    $stmt->close();
    header("Location: " . $_SERVER['PHP_SELF']);
    
  }


  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_doctor'])) {
    $doctorID = intval($_POST['doctorID']);
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $availability = $_POST['availability'];
    $phone = intval($_POST['phone']);
    $email = $_POST['email'];
    
    
    $stmt = $con->prepare("INSERT INTO doctor (doctorID, firstName, lastName, availability, phone, email) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssis", $doctorID, $firstName, $lastName, $availability, $phone, $email);
    $stmt->execute();
    $stmt->close();
    header("Location: " . $_SERVER['PHP_SELF']);
      
  }

  $stmt = $con->prepare("SELECT * FROM `doctor`");
  $stmt->execute();
  $result = $stmt->get_result();
  ?>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="AdminT.css">
  <title> Doctors Database</title>
</head>
<body>
  <?php require "adminsidebar.php" ?> 
  <section class="pointer">
    <div class="item">
      <center>
        <p class="Panel"> Doctors Database </p> <br><br>
      </center>  
    </div>
  </section>
  <table id="userTable">
    <thead>
      <tr>
        <th>doctorID</th>
        <th>firstName</th>
        <th>lastName</th>
        <th>availability</th>
        <th>phone</th>
        <th>email</th>
      </tr>
    </thead>
    <tbody style="text-align: center;">
    <?php
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $selected_user_id = $row['doctorID'];
          echo "<tr>
                    <td style='display: flex; justify-content: center; align-items: center; gap: 10px;'>
              <form method='POST' action='' style='margin: 0;'>
              <input type='hidden' name='delete_id' value='" . $row['doctorID'] . "' />
            <button type='submit' style='background: none; border: none; cursor: pointer;'>❌</button>
          </form>
          " . $row['doctorID'] . "
        </td>
                    <td>" . $row['firstName'] . "</td>
                    <td>" . $row['lastName'] . "</td>
                    <td>" . $row['availability'] . "</td>
                    <td>" . $row['phone'] . "</td>
                    <td>" . $row['email'] . "</td>";

          echo "</tr>";
        }
      } else {
        echo "No Doctors Found.";
      }
      $stmt->close(); 
      ?>

`   <tr>
      <form method="POST" action="">
        <td style="display: flex; justify-content: center; align-items: center; gap: 10px;">
          <button type="submit" name="add_doctor" style="background: none; border: none; cursor: pointer;">✅</button>
          <input type="number" name="doctorID" placeholder="ID" required style="width: 50px;">
        </td>
        <td><input type="text" name="firstName" placeholder="FirstName" required style="width: 100px;"></td>
        <td><input type="text" name="lastName" placeholder="LastName" required style="width: 100px;"></td>
        <td><input type="text" name="availability" placeholder="Monday, Tuesday, Wednesday, Thursday, Friday" required style="width: 470px;"></td>
        <td><input type="number" name="phone" placeholder="Number" required style="width: 100px;"></td>
        <td><input type="text" name="email" placeholder="example@gmail.com" required style="width: 250px;"></td>
      </form>
    </tr>  
    </tbody>
  </table>
</body>
</html>