<!DOCTYPE HTML>
<html>
<head>
    <title>Update Client Record</title>
    <style>
html{
    background:linear-gradient(100deg,#999,#131313,#999); 
    max-width: 100%; 
     display: block; 
     width: 100%;
     height: 100vh;
     margin:0;
     padding:0;
}
        table {
            width: 400px;
            margin: auto;
        }

        td {
            width: 50px;
            padding: 10px;
        }
        label{
          color: #000;
          font-weight: bold;
        }
        

        input {
            border-radius: 5px;
        }

        h1 {
            text-align: center;
        }

        fieldset {
            width: 500px;
            background:linear-gradient(100deg,#131313,#C9F31D,#131313);
            border: 2px solid #C9F31D;
            border-radius: 25px;
            padding: 10px;
            margin: auto;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        #update_in {
            font-weight: 800;
            border-radius: 10px;
            color:#C9F31D;
            background:#131313;
            border: 1px solid #131313;
            padding: 10px 50px;
            margin: 0 10px;
           
        }
        #back_in{
            font-weight:800;
            border-radius: 10px;
            color:#C9F31D;
            background:#131313;
            border: 1px solid #131313;
            padding: 10px 60px;  
            margin: 0 10px;
           
        }
        #update_in:hover{
            cursor:pointer;
        }
        #back_in:hover{
            cursor:pointer;
        }
        .buttons{
            display: flex;
            flex-direction:row;
            justify-content:center;
            margin:10px 30px;
        }
        select {
            width: 175px; 
            padding: 2px; 
            border: 1px solid #131313; 
            border-radius: 5px;
            box-sizing: border-box; 
}
select:hover{
  border: 1px solid #131313;
}
select option {
  background-color: #fff; 
  color: #131313;
  font-weight:500;
}
.info{
    display: block;
    text-align: center;
}


       
    </style>

</head>
<body>

<?php

require_once "config.php";
$info = "";

// Check existence of "id" parameter got from Dashboard.php file.

if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    $id_Get = $_GET["id"];
    $sql = "SELECT * FROM client WHERE Id = :id";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bindParam(':id', $id_Get);
        if ($stmt->execute()) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $Id = $row["Id"];
            $Client_id = $row["Client_id"];
            $First_Name = $row["First_Name"];
            $Last_Name = $row["Last_Name"];
            $Gender = $row["Gender"];
            $Email = $row["Email"];
            $Contact = $row["Contact"];
            $Date_Created = $row["Date_Created"];
        } else
            $info = "Sorry! Update Failed, Error In Executing SELECT Query. Please Try Again Later.";
    } else
        $info = "Sorry! Update Failed, something went wrong. Please Try Again Later.";
} else
    $info = 'Sorry!, You have made in invalid request. Please <a href="Dashboard.php">GO BACK</a> And Try Again.';

$conn = NULL;

?>

<fieldset>
<form action="Dashboard.php" method="post">
        <h1>Update Client Record</h1>
        <table>
        <tr>
                <td><label>Id</label></td>
                <td><input type="number" name="id" value="<?php echo $Id; ?>" required autocomplete="off"><span
                            style="color:#C9F31D"> * </span></td>
            </tr>
           
            <tr>
                <td><label>Client_Id</label></td>
                <td><input type="text" name="client_id" value="<?php echo $Client_id; ?>" required autocomplete="off"><span
                            style="color:#C9F31D"> * </span></td>
            </tr>
            <tr>
                <td><label>First_Name</label></td>
                <td><input type="text" name="fn" value="<?php echo $First_Name; ?>" required autocomplete="off"><span
                            style="color:#C9F31D"> * </span></td>
            </tr>
            <tr>
                <td><label>Last_Name</label></td>
                <td><input type="text" name="ln" value="<?php echo $Last_Name; ?>" required autocomplete="off"><span
                            style="color:#C9F31D"> * </span></td>
            </tr>
            <tr>
    <td><label for="gender">Gender</label></td>
    <td>
        <select name="gender" id="gender" required>
            <option value="male" <?php echo ($Gender === 'male') ? 'selected' : ''; ?>>Male</option>
            <option value="female" <?php echo ($Gender === 'female') ? 'selected' : ''; ?>>Female</option>
            <!-- Add more options as needed -->
        </select>
        <span style="color:#C9F31D"> * </span>
    </td>
</tr>

            <tr>
                <td><label>Email</label></td>
                <td><input type="text" name="email" value="<?php echo $Email; ?>" required autocomplete="off"><span
                            style="color:#C9F31D"> * </span></td>
            </tr>
            <tr>
                <td><label>Contact</label></td>
                <td><input type="number" name="contact" value="<?php echo $Contact; ?>" required autocomplete="off"><span
                            style="color:#C9F31D"> * </span></td>
                   </tr>
                   <tr>
                <td><label>Date_Created</label></td>
                <td><input type="date" name="date_created" value="<?php echo $Date_Created; ?>" required style="width:170px" autocomplete="off"><span
                            style="color:#C9F31D"> * </span></td>
            </tr>
        </table>
        <br>
        <div class="buttons">
        <a href="#member"><input type="submit" id="update_in" name="update" value="UPDATE"/></a>
        <a href="Dashboard.php"><input type="button" id="back_in" value="BACK"/></a>
        <div>
    </form>
    <br><br>
    <?php
    echo '<span class="info" style="color:#131313">' . $info . '</span>';
    ?>
</fieldset>

</body>
</html>
