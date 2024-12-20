<!DOCTYPE html>
<html>
<head>
  <?php 
  include('db-config/config.php');
  

  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $delete_id = intval($_POST['delete_id']);
    $stmt = $con->prepare("DELETE FROM consultation WHERE consultationID = ?");
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();
    $stmt->close();
    header("Location: " . $_SERVER['PHP_SELF']);
    
  }


  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_consultation'])) {
    $consultationID = intval($_POST['consultationID']);
    $consultationPrice = floatval($_POST['consultationPrice']);
    $consultationDuration = $_POST['consultationDuration'];
    
    $stmt = $con->prepare("INSERT INTO consultation (consultationID, consultationPrice, consultationDuration) VALUES (?, ?, ?)");
    $stmt->bind_param("ids", $consultationID, $consultationPrice, $consultationDuration);
    $stmt->execute();
    $stmt->close();
    header("Location: " . $_SERVER['PHP_SELF']);
      
  }

  $stmt = $con->prepare("SELECT * FROM `consultation`");
  $stmt->execute();
  $result = $stmt->get_result();
  ?>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="AdminT.css">
  <title> Consultations Database</title>
</head>
<body>
  <?php require "adminsidebar.php"; ?> 
  <section class="pointer">
    <div class="item">
      <center>
        <p class="Panel"> Consultations Database </p> <br><br>
      </center>  
    </div>
  </section>
  <table id="userTable">
    <thead>
      <tr>
        <th>consultationID</th>
        <th>consultationPrice</th>
        <th>consultationDuration</th>
      </tr>
    </thead>
    <tbody style="text-align: center;">
    <?php
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<tr>
            <td style='display: flex; justify-content: center; align-items: center; gap: 10px;'>
              <form method='POST' action='' style='margin: 0;'>
                <input type='hidden' name='delete_id' value='" . $row['consultationID'] . "' />
                <button type='submit' style='background: none; border: none; cursor: pointer;'>❌</button>
              </form>
              " . $row['consultationID'] . "
            </td>
            <td>" . $row['consultationPrice'] . "</td>
            <td>" . $row['consultationDuration'] . "</td>
          </tr>";
        }
      } else {
        echo "No Consultations Found.";
      }
      $stmt->close(); 
    ?>

    <tr>
      <form method="POST" action="">
        <td style="display: flex; justify-content: center; align-items: center; gap: 10px;">
          <button type="submit" name="add_consultation" style="background: none; border: none; cursor: pointer;">✅</button>
          <input type="number" name="consultationID" placeholder="ID" required style="width: 50px;">
        </td>
        <td><input type="number" name="consultationPrice" placeholder="Price" required style="width: 100px;"></td>
        <td><input type="text" name="consultationDuration" placeholder="Duration" required style="width: 100px;"></td>
      </form>
    </tr>
    </tbody>
  </table>
</body>
</html>
