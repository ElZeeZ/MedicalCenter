<!DOCTYPE html>
<html>
<head>
<?php 
  include('db-config/config.php');
  

  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $delete_id = intval($_POST['delete_id']);
    $stmt = $con->prepare("DELETE FROM appointment WHERE appointmentID = ?");
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();
    $stmt->close();
    header("Location: " . $_SERVER['PHP_SELF']);
    
  }

 
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_appointment'])) {
    $appointmentID = intval($_POST['appointmentID']);
    $patientID = intval($_POST['patientID']);
    $billID = intval($_POST['billID']);
    $appointmentDate = $_POST['appointmentDate'];
    
    $stmt = $con->prepare("INSERT INTO appointment (appointmentID, patientID, billID, appointmentDate) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiis", $appointmentID, $patientID, $billID, $appointmentDate);
    $stmt->execute();
    $stmt->close();
    header("Location: " . $_SERVER['PHP_SELF']);
      
  }

  $stmt = $con->prepare("SELECT * FROM `appointment`");
  $stmt->execute();
  $result = $stmt->get_result();
  ?>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="AdminT.css">
  <title> Appointments Database</title>
</head>
<body>
  <?php require "adminsidebar.php" ?> 
  <section class="pointer">
    <div class="item">
      <center>
        <p class="Panel"> Appointments Database </p> <br><br>
      </center>  
    </div>
  </section>
  <table id="userTable">
    <thead>
      <tr>
        <th>appointmentID</th>
        <th>patientID</th>
        <th>billID</th>
        <th>appointmentDate</th>
      </tr>
    </thead>
    <tbody style="text-align: center;">
    <?php
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $selected_user_id = $row['appointmentID'];
          echo "<tr>
                    <td style='display: flex; justify-content: center; align-items: center; gap: 10px;'>
              <form method='POST' action='' style='margin: 0;'>
              <input type='hidden' name='delete_id' value='" . $row['appointmentID'] . "' />
            <button type='submit' style='background: none; border: none; cursor: pointer;'>❌</button>
          </form>
          " . $row['appointmentID'] . "
        </td>
                    <td>" . $row['patientID'] . "</td>
                    <td>" . $row['billID'] . "</td>
                    <td>" . $row['appointmentDate'] . "</td>";
          echo "</tr>";
        }
      } else {
        echo "No Appointments Found.";
      }
      $stmt->close(); 
      ?>
     <tr>
      <form method="POST" action="">
        <td style="display: flex; justify-content: center; align-items: center; gap: 10px;">
          <button type="submit" name="add_appointment" style="background: none; border: none; cursor: pointer;">✅</button>
          <input type="number" name="appointmentID" placeholder="ID" required style="width: 50px;">
        </td>
        <td><input type="number" name="	patientID" placeholder="ID" required style="width: 50px;"></td>
        <td><input type="number" name="billID" placeholder="ID" required style="width: 50px;"></td>
        <td><input type="text" name="appointmentDate" placeholder="Date & Time" required style="width: 5  100px;"></td>
      </form>
    </tr> 
    </tbody>
  </table>
</body>
</html>