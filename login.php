<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrstion and login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $db="users_test";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $db);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
          }

        //If connection successfull alert
        /*if ($conn) {
            ?>
                <script>
                    alert("Connection Successfull");
                </script>
            <?php
        }else{
            ?>
            <script>
                alert("No Connection");
            </script>
        <?php
        }*/
    ?>
</head>
  
  <body class="w-50 position-absolute top-50 start-50 translate-middle">

    <?php
        if(isset($_POST['submit'])){
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $password = mysqli_real_escape_string($conn, $_POST['password']);

            $searchQuery = "SELECT * FROM registered_user WHERE email = '$email'";
            $result = mysqli_query($conn, $searchQuery);
            $userCount = mysqli_num_rows($result);

            if ($userCount === 1) {
                while($row = mysqli_fetch_array($result)) {
                    $hash =  $row['password'];
                }

                if (password_verify( $password, $hash)) {
                    
                    session_start();
                    $_SESSION['authenticated'] = true;
                    $_SESSION['lasttime'] = time();
                    
                    header("Location: hello.php", true, 301);
                    exit();
                    //echo "Logged In";
                } else {
                    header("Location: registraionfailed.php", true, 301);
                    exit();
                    //echo "Login Failed";
                }
                
            }else{
                header("Location: registraionfailed.php", true, 301);
                exit();
                //echo "Login Failed";
            
            }
            
        }

    ?>

    <h1 class="text-center">Login</h1>
    <form action="" method="POST">
        <div class="mb-3">
            <label for="exampleInputEmail1"  class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" required>
        </div>
        
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" required>
        </div>
        <div class="d-grid gap-2 col-6 mx-auto">
            <button type="submit" name="submit" class="btn btn-outline-success">Login</button>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>