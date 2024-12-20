<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nurse Job Application</title>
  <link rel="stylesheet" href="nurseform.css">
</head>
<body>
  <div class="container">
    <form class="job-form" id="jobForm" action="nurseform_action.php" method="POST" enctype="multipart/form-data">
      <h1>Job Application <span>(Nurse)</span></h1>
      <div class="form-row">
        <div class="form-group">
          <label for="firstName">First Name</label>
          <input type="text" id="firstName" name="firstName" placeholder="Enter First Name" required>
        </div>
        <div class="form-group">
          <label for="lastName">Last Name</label>
          <input type="text" id="lastName" name="lastName" placeholder="Enter Last Name" required>
        </div>
      </div>
      <div class="form-group">
        <label for="phone">Phone Number</label>
        <input type="tel" id="phone" name="phone" placeholder="Enter Phone Number" required>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Enter Email" required>
      </div>
      <button type="submit" class="apply-btn">Apply Now</button>
    </form>
  </div>


</body>
</html>
