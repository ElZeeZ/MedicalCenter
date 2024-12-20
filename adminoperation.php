<!DOCTYPE html>
<html>
<head>
<?php 
  include('db-config/config.php');
  

  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $delete_id = intval($_POST['delete_id']);
    $stmt = $con->prepare("DELETE FROM operation WHERE operationID = ?");
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();
    $stmt->close();
    header("Location: " . $_SERVER['PHP_SELF']);
    
  }


  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_operation'])) {
    $operationID = intval($_POST['operationID']);
    $operationName = $_POST['operationName'];
    $operationPrice = floatval($_POST['operationPrice']);
    $operationDuration = $_POST['operationDuration'];
    
    $stmt = $con->prepare("INSERT INTO operation (operationID, operationName, operationPrice, operationDuration) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isds", $operationID, $operationName, $operationPrice, $operationDuration);
    $stmt->execute();
    $stmt->close();
    header("Location: " . $_SERVER['PHP_SELF']);
      
  }

  $stmt = $con->prepare("SELECT * FROM `operation`");
  $stmt->execute();
  $result = $stmt->get_result();
  ?>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="AdminT.css">
  <title> Operations Database</title>
</head>
<body>
  <?php require "adminsidebar.php" ?> 
  <section class="pointer">
    <div class="item">
      <center>
        <p class="Panel"> Operations Database </p> <br><br>
      </center>  
    </div>
  </section>
  <table id="userTable">
    <thead>
      <tr>
        <th>operationsID</th>
        <th>operationName</th>
        <th>operationPrice</th>
        <th>operationDuration</th>
      </tr>
    </thead>
    <tbody style="text-align: center;">
    <?php
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $selected_user_id = $row['operationID'];
          echo "<tr>
                    <td style='display: flex; justify-content: center; align-items: center; gap: 10px;'>
              <form method='POST' action='' style='margin: 0;'>
              <input type='hidden' name='delete_id' value='" . $row['operationID'] . "' />
            <button type='submit' style='background: none; border: none; cursor: pointer;'>❌</button>
          </form>
          " . $row['operationID'] . "
        </td>
                    <td>" . $row['operationName'] . "</td>
                    <td>" . $row['operationPrice'] . "</td>
                    <td>" . $row['operationDuration'] . "</td>";
          echo "</tr>";
        }
      } else {
        echo "No Operations Found.";
      }
      $stmt->close(); 
      ?>

    <tr>
      <form method="POST" action="">
        <td style="display: flex; justify-content: center; align-items: center; gap: 10px;">
          <button type="submit" name="add_operation" style="background: none; border: none; cursor: pointer;">✅</button>
          <input type="number" name="operationID" placeholder="ID" required style="width: 50px;">
        </td>
        <td><input type="text" name="operationName" placeholder="Name" required style="width: 100px;"></td>
        <td><input type="number" name="operationPrice" placeholder="Price" required style="width: 100px;"></td>
        <td><input type="text" name="operationDuration" placeholder="Duration" required style="width: 100px;"></td>
      </form>
    </tr>
    
    </tbody>
  </table>
</body>
</html>