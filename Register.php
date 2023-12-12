<!Doctype html>

<head>
    <title>Registration Form Page</title>
    <link rel="stylesheet" href="css/style.css">
    <meta charset="utf-8">
    <style type="text/css">
                body{
            margin:0;
            padding:0;
            background:#32373a;
}
       .sign p span{
  color:var(--main);
                 }
           .Usr-error{
             color:var(--p-color);
             font-size: 20px;
             position: absolute;
             top:44%; 
             left:55%;
             height: 20px; 
             white-space:nowrap;
             box-shadow: 0 0 10px #C9F31D;
                        }
        .Cfp-error{
             color:var(--p-color);
             font-size: 20px;
             position: absolute;
             top:68%; 
             left:55%;
             height: 20px; /* Set a fixed height */
             overflow: hidden; /* Hide any overflow content */
             box-shadow: 0 0 10px #C9F31D;
             white-space: nowrap;
                         }

.note{ 
                position: fixed;
                top:0;
                left:0;
                right:0;
                padding:15px 10px;
                background-color:transparent;
                text-align: center;
                z-index: 1000;
                box-shadow: var(--box-shadow);
                color:var(--p-color);
                font-size: 20px;
                text-transform: capitalize;
                cursor:pointer;
        }

        
       
        .sign{
            color:white;
            width:400px;
            position:absolute;
            top:50px;
            left:50px;
            margin:25px;
            border-radius: 10px;
            background: repeating-linear-gradient(45deg, gray,transparent, transparent , gray );

        }


       .sign h2{ 
        background: linear-gradient(100deg,var(--p-color),var(--main));
    -webkit-text-fill-color: transparent;
    -webkit-background-clip: text;
    margin-left:10px;
       }


        .sign p{
            margin-left:10px;
             color:var(--primary);
             font-size:25px;
         }

         .please-line {
           background:linear-gradient(75deg,var(--main),var(--primary),var(--p-color));
           -webkit-text-fill-color:transparent;
           -webkit-background-clip:text;
            font-size: 20px;
            font-weight:bold;
            margin-left:10px;
        }
        label{
           background:linear-gradient(100deg,var(--primary),var(--main),var(--p-color));
           -webkit-text-fill-color:transparent;
           -webkit-background-clip:text;
           font-size:20px;
           font-weight:bold;
           margin-left:10px;
        }

       .login-link h3{
        background:linear-gradient(75deg,var(--main),var(--p-color));
           -webkit-text-fill-color:transparent;
           -webkit-background-clip:text;
             font-size: 20px;  
             margin-left:10px; 
        }

        .login-link a{
            background:linear-gradient(75deg,var(--main),var(--primary),var(--p-color));
           -webkit-text-fill-color:transparent;
           -webkit-background-clip:text;
            text-decoration: none;
            border-bottom: none;
        }

             
  .login-link a:hover{
text-decoration: underline;
border-bottom:  1px solid var(--p-color);
                    }
                    input[type="text"],  input[type="password"]{
                        margin-left:10px;
                    }

        
     input[type="text"]:hover{
     border-color:var(--secondary);

              }
       input[type="password"]:hover{
     border-color:var(--secondary);
              }

          ::placeholder {
    color: var(gray);
    opacity: 0.7;
    font-size: 14px; 
}
.container{
            margin-top: 30px;
        }
          .btn-btn1, .btn-btn2{
           font-weight:bolder;
            border: 2px solid var(--p-color);
            border-radius: 15px;
            font-size: 20px;
            padding: 10px 20px;
            font-family: "montserrat";
            margin:  20px 10px 0px;
            color:var(--secondary);
            background: repeating-linear-gradient(45deg, white, transparent 100px);
        }
           .btn-btn1:hover{
             cursor:pointer;
             border-color:var(--primary);
                 }
                 .btn-btn2:hover{
             cursor:pointer;
             border-color:var(--primary);
                 }
                 .sign::before {
  content: "SPORT";
  position: absolute;
  bottom: 18rem;
  left: 90%;
  font-size: 10rem;
  font-weight: 700;
  line-height: 7rem;
  color: var(--white);
  opacity: 0.05;
  z-index: -1;
 
}
.sign::after {
  content: "HEALTH";
  position: absolute;
  bottom: 1rem;
  left: 100%;
  font-size: 10rem;
  font-weight: 700;
  line-height: 7rem;
  color: var(--white);
  opacity: 0.05;
  z-index: -2;
  text-shadow: 10px 10px 10px #C9F31D ;
}

@media screen and (max-width: 768px) {
  .sign{
    top:20%;
  }
}
@media screen and (max-width: 480px) {
.sign{
    width:90%;
}
.sign p{
    font-size: 4rem;
    white-space: nowrap;
}
.sign h2{
    font-size: 4rem;
}
.please-line{
    white-space: nowrap;
    font-size: 3rem;}
label{
    font-size: 3rem;
}
 input[type="text"]{
    font-size: 2rem;
 }
input[type="password"]{
    font-size: 2rem;
}

.btn-btn1{
padding: 10px 50px;
}

.btn-btn2{
padding: 10px 60px ;
}

 .login-link h3{
    font-size: 2rem;
    white-space: nowrap;
 }
 .login-link a{
    font-size: 3rem;
    white-space: nowrap;
 }
 ::placeholder {
    font-size: 1.5rem; 
}


    
    </style>
</head>

<?php
session_start();
// Creating the connection to the database "users" in local server
require_once "config.php";

// define variables and set to empty values
$usernameErr = $passwordErr = $confirmpasswordErr = $note = "";
if (isset($_POST["submit"])) {
    $name = $_POST['username'];
    $pass = $_POST['password'];
    $cpass = $_POST['confirmpassword'];

    $dt = date("y-m-d");
    $sql = "SELECT * FROM users WHERE username = '$name' ";
    $result = $conn->query($sql);
    $num = $result->rowCount();
    if ($num == 0) {
        if ($pass == $cpass) {
            try {
                $query = 'INSERT INTO users (id,username,password, created_dt) VALUES (null,:username,:password, :created_dt)';

                $stmt = $conn->prepare($query);

                $stmt->bindParam(":username", $name);
                $stmt->bindParam(":password", $pass);
                $stmt->bindParam(":created_dt", $dt);
                $stmt->execute();
                $note = "Registration Successfully.New User Created";
            } catch (PDOException $e) {
                die("<br> Coudn Not Able To Execute Insert Query ( $query ):" . $e->getMessage());
            }
        } else {
            $confirmpasswordErr = "Password does not match .";
        }
    } else {
        $usernameErr = "This username taken by another user! ";
    }
}
?>
<?php
        if (isset($note)) {
    
            echo '<div class="note" id="submit-note" onclick="this.remove();">' . $note . '</div>';
        }
        ?>
 
<div class="sign">
    <p>Gym <span>Online Registration.</span></p>
    <h2> Sign Up Now</h2>
    <p><span class="error"></span></p>
    <h3 class="please-line">Please fill this form to create an account</h3>

    <form method="post" action="register.php" >  

    <div class="form-group">
    <label for="usernameInput">Username</label> <br><br>
    <input type="text" name="username" id="usernameInput" required autocomplete="off" placeholder="Enter a username" ><br>
    <span class="Usr-error"> <?php echo $usernameErr; ?></span>
          </div>

      <div class="form-group">
    <label for="passwordInput">Password</label> <br><br> 
    <input type="password" name="password" id="passwordInput" required autocomplete="off" placeholder="Enter a password"><br>
    <span class="error"> <?php echo $passwordErr; ?></span>
       </div>

        <div class="form-group">
    <label for="confirmpasswordInput">Confirm password</label> <br><br> 
    <input type="password" name="confirmpassword" id="confirmpasswordInput" required autocomplete="off" placeholder="Confirm Password"><br>
    <span class="Cfp-error"><?php echo $confirmpasswordErr; ?></span>
         </div>

        <div class="click-button">
            <input type="submit" class="btn-btn1" name="submit" value="Submit">
            <input type="reset" class="btn-btn2" name="reset" value="Reset">
         </div>

             <div class="login-link">
         <h3>Already have an account? <a href="Login.php" >Login here.</a></h3>
                </div>
           
    </form>
</div>

</body>
</html>
