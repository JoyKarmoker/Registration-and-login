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

            $pass = password_hash($password, PASSWORD_BCRYPT);

            $emailQuery = "SELECT * FROM registered_user WHERE email = '$email' ";
            $query = mysqli_query($conn, $emailQuery);

            $emailCount = mysqli_num_rows($query);

            if($emailCount>0){
                header("Location: registraionfailed.php", true, 301);
                exit();
            }else{
                $insertQuery = "INSERT INTO registered_user VALUES('$email', '$pass')";
                $iquery = mysqli_query($conn, $insertQuery);

                if ($iquery) {
                    header("Location: hello.php", true, 301);
                exit();
                }else{
                    header("Location: registraionfailed.php", true, 301);
                exit();
                
                }
            }
        }

    ?>

    <h1 class="text-center">Registraion Form</h1>
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
            <button type="submit" name="submit" class="btn btn-outline-success">Register</button>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>