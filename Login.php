<!DOCTYPE html>
<html>
    <head>
         <meta charset="UTF-8">
         <link rel="stylesheet" href="css/style.css">
        <title>Login page</title>
        <style type="text/css">
            
html,body{
   margin:0;
   padding:0;
   height: 100%;
 }
 
  .login-image {     
     max-width: 100%; 
     display: block; 
     width: 100%;
     height: 100%;
     object-fit: cover;
     margin:0;
     padding:0;
         }
         

     .login {
    display: flex;
    flex-direction: column;
    align-items: center;
    flex-wrap:wrap;
    position:absolute;
    color: #dedede;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
    margin-top: 40px;
    background:rgba(241,241,241,0.3);
    white-space: nowrap;
         }
         .login h1{
            color:var(--p-color);
            font-size:30px;
            padding: 10px 0;
            margin-bottom: 0;
         }
         .login h3{
            margin-top: 20px;
            color:var(--primary);
            font-size:1.4rem;

         }

         .form-group {
            margin-bottom: 20px;
}

label {
    color:var(--secondary);
    font-weight:bold;
    font-size:20px;
}
input:hover{
border-color:var(--secondary);
        }
button {
     border:2px solid #333;
     padding: 5px 60px;
     outline: none;
     background-color:var(--p-color);
     border-radius: 16px;
     color:var(--lighter-color);
     font-size: 20px;
     cursor: pointer;
     margin:20px 0px 0px;
 }
 button:hover{
border-color:var(--primary);
     }
     .button-group{
        text-align:center;
     }
     .signup-link {
margin-bottom:40px;
     }

.signup-link h3{
    color: var(--secondary); 
    font-size:1.3rem;
}
.signup-link a{
    text-decoration: none;
     color:var(--primary);
     font-size:1.3rem;
}
.error-message{
     position: fixed;
     top:0;
     left:0;
     right:0;
     padding:15px 10px;
     background-color:rgba(241,241,241,0.3); ;
     text-align: center;
     z-index: 1000;
     box-shadow: var(--box-shadow);
     color:var(--primary);
     font-size: 20px;
     text-transform: capitalize;
     cursor:pointer;
}
   .eye-icon{
           position: absolute;
           top: 49%; 
           right: 52px;
           z-index: 1;
           cursor: pointer;
          font-size:1.5rem;
          color:var(--secondary);
} 

@media (min-width:320px) and (max-width:480px) {
    .login {
    top:45%;
         }
         .login h1{
            font-size:1.8px;
           
         }
         .login h3{
            font-size:1.8rem;

         }
         label {
    font-size:2rem;
              }
 input{
    font-size:1rem;
 }
 button{
    font-size:1.5rem;
 }
 .signup-link h3{
    font-size:1.8rem;
 }
.signup-link a{
    font-size:1.8rem;
}
.eye-icon{
    top: 55%;
    right: 65px;
    font-size:1.5rem;
          
} 
}
            </style>
    </head>
    <body>
        <?php
        require_once "config.php";
        session_start();
        $msg = "";

        if (isset($_POST['submit'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            try {
                $sql = "SELECT * FROM users WHERE username = '$username'  AND password= '$password'";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                if ($stmt->rowCount() > 0) {
                    $row = $stmt->fetch();
                    $_SESSION["id"] = $row["id"];
                    $_SESSION["username"] = $row["username"];
                    $_SESSION["pass"] = $row["password"];
                    $_SESSION["created_dt"] = $row["created_dt"];
                    header("Location:Dashboard.php");
                } else {
                    $msg = ('Username or Password is wrong!<br>'
                            );
                }
            } catch (PDOException $e) {
                die("Could Not Able To Execute The Query [ $sql ]" . $e->getMessage());
            }
        }
        unset($stmt);
        ?>
        <?php
        if (isset($msg)) {
            echo '<div class="error-message" onclick="this.remove();">' . $msg . '</div>';
        }
        ?>
       
     <img src="images/log.jpg" class="login-image">
        <div class="login">
                     <h1> Login </h1>
                     <h3>Please fill in your credentials to login.</h3>
                     <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
            <label for="nameInput">Username:</label>
            <input type="text" id="nameInput" name="username" required autocomplete="off">
        </div>
        <div class="form-group">
            <label for="passwordInput">Password:</label>
            <input type="password" id="passwordInput" name="password" required autocomplete="off">
        </div>
        <span class="eye-icon" onclick="togglePasswordVisibility()">&#x1F441;</span>
        <div class="form-group button-group">
            <button type="submit" name="submit">Login</button>
        </div>
        <div class="signup-link">
        <h3>Don't have an account? <a href="Register.php">Sign up.</a></h3>
    </div>
    </form>
           </div> 
                 
<script>
  function togglePasswordVisibility() {
    var passwordInput = document.getElementById("passwordInput");
    passwordInput.type = passwordInput.type === "password" ? "text" : "password";
  }
</script>
                        </body>
                        </html>