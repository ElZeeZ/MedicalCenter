<!DOCTYPE html>
<html>
<head>
<?php 
include('db-config/config.php');
  

  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $delete_id = intval($_POST['delete_id']);
    $stmt = $con->prepare("DELETE FROM patient WHERE patientID = ?");
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();
    $stmt->close();
    header("Location: " . $_SERVER['PHP_SELF']);
    
  }


  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_patient'])) {
    $patientID = intval($_POST['patientID']);
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $dateOfBirth = $_POST['dateOfBirth'];
    $chiefComplaint = $_POST['chiefComplaint'];
    $gender = intval($_POST['gender']);
    $address = $_POST['address'];
    $phone = intval($_POST['phone']);
    $email = $_POST['email'];
    
    
    $stmt = $con->prepare("INSERT INTO patient (patientID, firstName, lastName, dateOfBirth, chiefComplaint, gender, address, phone, email) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssisis", $patientID, $firstName, $lastName, $dateOfBirth, $chiefComplaint, $gender, $address, $phone, $email);
    $stmt->execute();
    $stmt->close();
    header("Location: " . $_SERVER['PHP_SELF']);
      
  }

  $stmt = $con->prepare("SELECT * FROM `patient`");
  $stmt->execute();
  $result = $stmt->get_result();
  ?>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="AdminT.css">
  <title> Patients Database</title>
</head>
<body>
  <?php require "adminsidebar.php" ?> 
  <section class="pointer">
    <div class="item">
      <center>
        <p class="Panel"> Patients Database </p> <br><br>
      </center>  
    </div>
  </section>
  <table id="userTable">
    <thead>
      <tr>
        <th>patientID</th>
        <th>firstName</th>
        <th>lastName</th>
        <th>dateOfBirth</th>
        <th>chiefComplaint</th>
        <th>gender</th>
        <th>address</th>
        <th>phone</th>
        <th>email</th>
      </tr>
    </thead>
    <tbody style="text-align: center;">
    <?php
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $selected_user_id = $row['patientID'];
          echo "<tr>
                    <td style='display: flex; justify-content: center; align-items: center; gap: 10px;'>
              <form method='POST' action='' style='margin: 0;'>
              <input type='hidden' name='delete_id' value='" . $row['patientID'] . "' />
            <button type='submit' style='background: none; border: none; cursor: pointer;'>❌</button>
          </form>
          " . $row['patientID'] . "
        </td>
                    <td>" . $row['firstName'] . "</td>
                    <td>" . $row['lastName'] . "</td>
                    <td>" . $row['dateOfBirth'] . "</td>
                    <td>" . $row['chiefComplaint'] . "</td>
                    <td>" . $row['gender'] . "</td>
                    <td>" . $row['address'] . "</td>
                    <td>" . $row['phone'] . "</td>
                    <td>" . $row['email'] . "</td>";

          echo "</tr>";
        }
      } else {
        echo "No Patients Found.";
      }
      $stmt->close(); 
      ?>

    <tr>
      <form method="POST" action="">
        <td style="display: flex; justify-content: center; align-items: center; gap: 10px;">
          <button type="submit" name="add_patient" style="background: none; border: none; cursor: pointer;">✅</button>
          <input type="number" name="patientID" placeholder="ID" required style="width: 50px;">
        </td>
        <td><input type="text" name="firstName" placeholder="FirstName" required style="width: 100px;"></td>
        <td><input type="text" name="lastName" placeholder="LastName" required style="width: 100px;"></td>
        <td><input type="text" name="dateOfBirth" placeholder="Date" required style="width: 70px;"></td>
        <td><input type="text" name="chiefComplaint" placeholder="Explain your Issues" required style="width: 180px;"></td>
        <td><input type="number" name="gender" placeholder="M:1,F:0" required style="width: 80px;"></td>
        <td><input type="text" name="address" placeholder="Beirut" required style="width: 100px;"></td>
        <td><input type="number" name="phone" placeholder="Number" required style="width: 100px;"></td>
        <td><input type="text" name="email" placeholder="example@gmail.com" required style="width: 250px;"></td>
      </form>
    </tr>  
    </tbody>
  </table>
</body>
</html>