<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/dashboard.css">
  <title>Gym Dashboard</title>
</head>
<body>

  <div class="dashboard">
    <div class="sidebar">
<div class="logo">
      <img src="images/logo.png" width="50px" height="50px">
      <h3>Gym Dashboard</h3>
</div>
      <ul>
        <li><img src="images/member.png" width="20px" height="20px"><a href="#" onclick="showSection('member')">Member</a></li>
        <li><img src="images/plan.png" width="20px" height="20px"><a href="#" onclick="showSection('plan')">Plan</a></li>
        <li><img src="images/trainer.png" width="20px" height="20px"><a href="#" onclick="showSection('trainer')">Trainer</a></li>
        <li><img src="images/package.png" width="20px" height="20px"><a href="#" onclick="showSection('package')">Package</a></li>
        <li><img src="images/schedule.png" width="20px" height="20px"><a href="#" onclick="showSection('schedule')">Schedule</a></li>
        <li><img src="images/payment.png" width="20px" height="20px"><a href="#" onclick="showSection('payment')">Payment</a></li>
      </ul>
    </div>


    <div class="container-fluid">
    <div class="dashboard-content">
      
    <div class="statistic-box">
        <h3>Total Members</h3>
        <p>500</p>
      </div>

      <div class="statistic-box">
        <h3>Total Classes</h3>
        <p>20</p>
      </div>

      <div class="statistic-box">
        <h3>Revenue</h3>
        <p>$10,000</p>
      </div>
      
      <div class="statistic-box">
    <h3>Average Attendance</h3>
    <p>75%</p>
       </div>

      </div>

      <div id="member" class="member">
        <div  id="client" class="client">
        <h2>Member</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">  
        <div class="row form-group">
	   <div class="col-md-4">
        <label>Client_Id:</label><input type="text" name="client_id" required autocomplete="off">
            </div>
          <div class="col-md-4">
        <label>First_Name:</label><input type="text" name="fn" required  autocomplete="off">
          </div>
        <div class="col-md-4">
        <label>Last_Name:</label><input type="text"  name="ln" required  autocomplete="off">
          </div>
</div>
        <div class="row form-group">
        <div class="col-md-4">
      <label for="gender">Gender:</label>
       <select name="gender" id="gender" required>
       <option value="male"></option>
        <option value="male">Male</option>
        <option value="female">Female</option>
        <!-- Add more options as needed -->
    </select>
</div>
        <div class="col-md-4">
        <label>Email:</label><input type="email"  name="email" required  autocomplete="off">
       </div>
        <div class="col-md-4">
        <label>Contact:</label><input type="number" name="contact" required  autocomplete="off">
        </div>
       </div>
           <div class="button-container">
        <button type="submit" class="btn1" name="addClient">Add</button>
        <button type="reset" class="btn2"  name="reset" >RESET</button>
           </div>
         </form>
            </div>
         <div id="client-list" class="client-list"> 
         <?php
// Creating the connection to the database "gym" in the local server
require_once "config.php";
$info = "";

// Inserting The New Client In Table "client".
if (isset($_POST['addClient'])) {
    try {
        $add_query = 'INSERT INTO client (Id, Client_id, First_Name, Last_Name, Gender, Email, Contact, Date_created) VALUES (null, :client_id, :fn, :ln, :gender, :email, :contact, :date_created)';
        $stmt = $conn->prepare($add_query);
        $stmt->bindParam(":client_id", $_POST["client_id"]);
        $stmt->bindParam(":fn", $_POST["fn"]);
        $stmt->bindParam(":ln", $_POST["ln"]);
        $stmt->bindParam(":gender", $_POST["gender"]);
        $stmt->bindParam(":email", $_POST["email"]);
        $stmt->bindParam(":contact", $_POST["contact"]);
        $stmt->bindParam(":date_created", date("Y-m-d H:i:s")); 
        $stmt->execute();
        $info = "New Client Has Been Added Successfully.";
    } catch (PDOException $e) {
        die("<br>Could Not Able To Execute $add_query " . $e->getMessage());
    }
}

// Deleting a ClientFrom Records in Table "client".
if (isset($_GET["delete"]) && !empty($_GET["delete"])){
  $param_id=$_GET["delete"];
  try{
    $del_query = "DELETE FROM client WHERE Id=:id";  
    $res = $conn->prepare($del_query);
    $res->bindParam(":id", $param_id);
    $res->execute();
  } catch(PDOException $e){
      die("ERROR: Could not able to execute $del_query. " . $e->getMessage());
    }
} 
if (isset($_POST["update"]) && !empty($_POST["id"]))
{	
try{
  $update_query = "UPDATE client  SET  Client_id=:client_id, First_Name=:fn, Last_Name=:ln, Gender=:gender,  Email=:email,Contact=:contact,Date_Created=:date_created 
            WHERE Id=:id";

$stmt = $conn->prepare($update_query);
$stmt->bindParam(":id", $_POST["id"]);
$stmt->bindParam(":client_id", $_POST["client_id"]);
$stmt->bindParam(":fn", $_POST["fn"]);
$stmt->bindParam(":ln", $_POST["ln"]);
$stmt->bindParam(":gender", $_POST["gender"]);
$stmt->bindParam(":email", $_POST["email"]);
$stmt->bindParam(":contact", $_POST["contact"]);
$stmt->bindParam(":date_created", date("Y-m-d H:i:s"));
  $stmt->execute();
    $info = "Record Has Been Updated Successfully.";
    header("Location:Dashboard.php");
    exit();
} catch(PDOException $e){
    die("Sorry!, We Can Not Able To Execute $update_query. ".$e->getMessage());
  }
}
?>	
    <fieldset>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
    <h1>List Of Clients</h1>
    </form>
<?php
// Select Query To Display The Database (gym) Table (client).	
try { 
  $query = "SELECT * FROM client";
  $res = $conn->query($query);
  echo '<div class="table-container">';
  echo "<br><table >";
  echo "<tr>";
  echo "<th>Id</th>";
  echo "<th>Client_Id</th>";
  echo "<th>First_Name</th>";
  echo "<th>Last_Name</th>";
  echo "<th>Gender</th>";
  echo "<th>Email</th>";
  echo "<th>Contact</th>";
  echo "<th>Created_Date</th>";
  echo '<th colspan="3">Action</th>';
  echo "</tr>";
  
  if ($res->rowCount() > 0) {
      while ($row = $res->fetch()) {
          echo "<tr>";
          echo "<td>".$row["Id"]."</td>";
          echo "<td>".$row["Client_id"]."</td>";
          echo "<td>".$row["First_Name"]."</td>";
          echo "<td>".$row["Last_Name"]."</td>";
          echo "<td>".$row["Gender"]."</td>";
          echo "<td>".$row["Email"]."</td>";
          echo "<td>".$row["Contact"]."</td>";
          echo "<td>".$row["Date_Created"]."</td>";
          echo '<td colspan="3">
              <a href="Update.php?id='.$row["Id"].'"><img src="images/fill_eye.png" style="width:25px; height:25px"></a><span> &nbsp;&nbsp; </span>
              <a href="'.htmlspecialchars($_SERVER["PHP_SELF"]).'?delete='.$row["Id"].'"><img src="images/fa-trash.png" style="width:25px; height:25px"></a> </td>';
          echo "</tr>";
      }
  } else {
      // If there are no rows, display an empty row
      echo "<tr>";
      echo "<td colspan='9'>No records found.</td>";
      echo "</tr>";
  }
  
  echo "</table>";
  echo '</div>';
  echo '<br><span  style="color:var(--secondary)"><b>'.$info.'</b></span>';
  echo "</fieldset>";
} catch (PDOException $e) {
  die ("<br>Couldn't able to execute (".$query.").<br>  Error: ".$e->getMessage());
}
$conn = NULL;

?>  
</div>
 </div>
       
       <div id="plan">
             <h1></h1>
         </div>
      
      <div id="trainer">
        <h2>Trainer</h2>
      </div>

    <div id="package">
        <h2>Package</h2>
      </div>

    <div id="schedule">
        <h2>Schedule</h2>
      </div>

    <div id="payment">
        <h2>Payment</h2>
      </div>
     </div>
</div>
  <script>
  // Hide all content sections
  function showSection(sectionId) {
    // Hide all content sections
    document.getElementById('dashboard-content').style.display = 'none';
    document.getElementById('member').style.display = 'none';
    document.getElementById('plan').style.display = 'none';
    document.getElementById('trainer').style.display = 'none';
    document.getElementById('package').style.display = 'none';
    document.getElementById('schedule').style.display = 'none';
    document.getElementById('payment').style.display = 'none';

    // Show the selected content section
    document.getElementById(sectionId).style.display = 'block';
  }

</script>
</body>
</html>


