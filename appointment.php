<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book an Appointment</title>
  <link rel="stylesheet" href="appointmentform.css">
</head>
<body>
  <div class="container">
    <form class="appointment-form" id="appointmentForm" action="appointment_action.php" method="POST">
      <h1>Book an Appointment</h1>
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
        <label for="dob">Date of Birth</label>
        <input type="date" id="dob" name="dob" required>
      </div>
      <div class="form-group">
        <label for="gender">Gender</label>
        <select id="gender" name="gender" required>
          <option value="">Select Gender</option>
          <option value="male">Male</option>
          <option value="female">Female</option>
        </select>
      </div>
      <div class="form-group">
        <label for="city">City</label>
        <input type="text" id="city" name="city" placeholder="Enter City" required>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label for="phone">Phone Number</label>
          <input type="tel" id="phone" name="phone" placeholder="Enter Phone Number" required>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" placeholder="Enter Email" required>
        </div>
      </div>
      <div class="form-group">
        <label for="complaint">Complaint</label>
        <textarea id="complaint" name="complaint" placeholder="Express your symptoms and concerns" rows="4" required></textarea>
      </div>
      <button type="submit" class="submit-btn">Submit Appointment</button>
    </form>
  </div>

  
</body>
</html>
