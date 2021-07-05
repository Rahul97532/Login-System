<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>
    <?php
        include 'dbcon.php'; 
        if(isset($_POST['submit'])){
            $username=mysqli_real_escape_string($con, $_POST['username']);
            $email=mysqli_real_escape_string($con, $_POST['email']);
            $pass=mysqli_real_escape_string($con, $_POST['pass']);
            $cpass=mysqli_real_escape_string($con, $_POST['cpass']);
            // Encrypt Password
            $password=password_hash($pass,PASSWORD_BCRYPT);
            $cpassword=password_hash($cpass,PASSWORD_BCRYPT);
            $token=bin2hex(random_bytes(15));
            $email_verify="Select * from users where email='$email'";
            $query=mysqli_query($con,$email_verify);

            if(mysqli_num_rows($query)){
                ?>
                    <script>
                        alert('Sorry, this email is already taken');
                    </script>
                    <?php
            }
            else{
                if($pass===$cpass){
                    $user_add="insert into users(name,email,password,token) values('$username','$email','$password','$token')";
                    $i_query=mysqli_query($con,$user_add);
                    ?>
                    <script>
                        alert('You registered successfully!!');
                    </script>
                    <?php
                }
                else{
                    ?>
                    <script>
                        alert('Passwords donot match');
                    </script>
                    <?php
                }
            }

        }
    ?>
        <div class="container">
            <div class="main">
                <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method='POST'>
                    <div class="card">
                        <h1>Signup</h1>

                        <!-- <form action="signup.php" method='POST'> -->
                            <h3>Enter Name</h3>
                            <input type="text" name="username" required />
                            <h3>Enter Email</h3>
                            <input type="mail" name="email" required />
                            <h3>Enter Password</h3>
                            <input type="password" name="pass" required />
                            <h3>Confirm Password</h3>
                            <input type="password" name="cpass" required />
                            <br />
                            <button type="submit" class="submit" name="submit">Signup</button>
                        <!-- </form> -->
                    </div>
                </form>
                <div class="account">
                    Already have account?
                    <a class='link' href='/Login System/login.php'>Login</a>
                </div>
            </div>
        </div>
</body>

</html>