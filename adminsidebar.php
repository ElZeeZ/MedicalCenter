<html>
    <link rel="stylesheet" href="sidebar.css">
    <?php session_start(); ?>
<body>
    <nav class="nav-max">
        <header>
          <a class="nav-link">
          <h1> Welcome <?php echo $_SESSION['username'];?></h1>
        </header>
        
        <br>
        <hr>
        <ul class="menu">
        <li>
            <a class="nav-link" href="adminhome.php">
              <span>View Patients Database</span>
            </a>
        </li>
        <li>
            <a class="nav-link" href="admindoctor.php">
              <span>View Doctors Database</span>
            </a>
        </li>
        <li>
            <a class="nav-link" href="adminnurse.php">
              <span>View Nurse Database</span>
            </a>
        </li>
        <li>
            <a class="nav-link" href="adminstaff.php">
              <span>View Staff Database</span>
            </a>
        </li>
        <li>
            <a class="nav-link" href="adminappointment.php">
              <span>View App. Database</span>
            </a>
        </li>
        <li>
            <a class="nav-link" href="adminconsul.php">
              <span>View Consul Database</span>
            </a>
        </li>
        <li>
            <a class="nav-link" href="admindiag.php">
              <span>View Diag-Study Database</span>
            </a>
        </li>
        <li>
            <a class="nav-link" href="adminoperation.php">
              <span>View Operations Database</span>
            </a>
        </li>
        <li>
          <a class="nav-link" href="logoutaction.php">
          <span> Logout </span>
          </a>
        </li>
    </nav>
</body>
</html>