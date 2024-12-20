<!DOCTYPE html>
<html>
<head>
<?php 
  include('db-config/config.php');
  

  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $delete_id = intval($_POST['delete_id']);
    $stmt = $con->prepare("DELETE FROM diagnosticstudy WHERE diagnosticstudyID = ?");
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();
    $stmt->close();
    header("Location: " . $_SERVER['PHP_SELF']);
    
  }


  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_diagnosticstudy'])) {
    $diagnosticstudyID = intval($_POST['diagnosticstudyID']);
    $diagnosticstudyName = $_POST['diagnosticstudyName'];
    $diagnosticstudyPrice = floatval($_POST['diagnosticstudyPrice']);
    $diagnosticstudyDuration = $_POST['diagnosticstudyDuration'];
    
    $stmt = $con->prepare("INSERT INTO diagnosticstudy (diagnosticstudyID, diagnosticstudyName, diagnosticstudyPrice, diagnosticstudyDuration) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isds", $diagnosticstudyID, $diagnosticstudyName, $diagnosticstudyPrice, $diagnosticstudyDuration);
    $stmt->execute();
    $stmt->close();
    header("Location: " . $_SERVER['PHP_SELF']);
      
  }

  $stmt = $con->prepare("SELECT * FROM `diagnosticstudy`");
  $stmt->execute();
  $result = $stmt->get_result();
  ?>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="AdminT.css">
  <title> Diagnostic Studies Database</title>
</head>
<body>
  <?php require "adminsidebar.php" ?> 
  <section class="pointer">
    <div class="item">
      <center>
        <p class="Panel"> Diagnostic Studies Database </p> <br><br>
      </center>  
    </div>
  </section>
  <table id="userTable">
    <thead>
      <tr>
        <th>diagnosticstudyID</th>
        <th>diagnosticstudyName</th>
        <th>diagnosticstudyPrice</th>
        <th>diagnosticstudyDuration</th>

      </tr>
    </thead>
    <tbody style="text-align: center;">
    <?php
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $selected_user_id = $row['diagnosticstudyID'];
          echo "<tr>
                    <td style='display: flex; justify-content: center; align-items: center; gap: 10px;'>
              <form method='POST' action='' style='margin: 0;'>
              <input type='hidden' name='delete_id' value='" . $row['diagnosticstudyID'] . "' />
            <button type='submit' style='background: none; border: none; cursor: pointer;'>❌</button>
          </form>
          " . $row['diagnosticstudyID'] . "
        </td>
                    <td>" . $row['diagnosticstudyName'] . "</td>
                    <td>" . $row['diagnosticstudyPrice'] . "</td>
                    <td>" . $row['diagnosticstudyDuration'] . "</td>";
          echo "</tr>";
        }
      } else {
        echo "No Diagnostic Studies Found.";
      }
      $stmt->close(); 
      ?>

    <tr>
      <form method="POST" action="">
        <td style="display: flex; justify-content: center; align-items: center; gap: 10px;">
          <button type="submit" name="add_diagnosticstudy" style="background: none; border: none; cursor: pointer;">✅</button>
          <input type="number" name="diagnosticstudyID" placeholder="ID" required style="width: 50px;">
        </td>
        <td><input type="text" name="diagnosticstudyName" placeholder="Name" required style="width: 100px;"></td>
        <td><input type="number" name="diagnosticstudyPrice" placeholder="Price" required style="width: 100px;"></td>
        <td><input type="text" name="diagnosticstudyDuration" placeholder="Duration" required style="width: 100px;"></td>
      </form>
    </tr>
    </tbody>
  </table>
</body>
</html>