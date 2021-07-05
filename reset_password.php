<?php 
    $password_update_successful=false;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css">

    <title>Reset Password</title>
</head>

<body>
    <?php
        include 'dbcon.php'; 
        if(isset($_POST['submit'])){
            if(isset($_GET['token'])){
                $token=$_GET['token'];
            
            $newpass=mysqli_real_escape_string($con, $_POST['newpass']);
            $cnewpass=mysqli_real_escape_string($con, $_POST['cnewpass']);
            // Encrypt Password
            $newpassword=password_hash($newpass,PASSWORD_BCRYPT);
            $cnewpassword=password_hash($cnewpass,PASSWORD_BCRYPT);
            // echo "Password= $newpassword";
            if($newpass===$cnewpass){
                $update_query="update users set password='$newpassword' where token='$token'";
                $query=mysqli_query($con,$update_query);

                if($query){
                    ?>
        <script>
            alert("Password updated successfully");
        </script>
        <?php
                }
                else{
                    ?>
            <script>
                alert("Password not updated. Please try again.");
            </script>
            <?php
                }
    
            }
            else{
                ?>
                <script>
                    alert("Passwords donot match");
                </script>
                <?php
            }

           
            
            
            

        }
    }
    ?>
                    <div class="container">
                        <div class="main">
                            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
                                <div class="card">
                                    <h1>Reset Password</h1>

                                    <h3>Enter New Password</h3>
                                    <input type="password" name="newpass" required />
                                    <h3>Confirm New Password</h3>
                                    <input type="password" name="cnewpass" required />
                                    <br />
                                    <button type="submit" class="submit" name="submit">
              Update Password
            </button>
                                </div>
                            </form>
                            <div class="account">
                                Already have account?
                                <a class='link' href='/Login System/login.php'>Login</a>
                            </div>
                            <div class="account">
                                Need an Account?
                                <a class='link' href='/Login System/signup.php'>Sign Up</a>
                            </div>
                        </div>
                        
                        
                    </div>
</body>

</html>