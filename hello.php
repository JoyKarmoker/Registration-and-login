<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auhentication</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body class="w-50 position-absolute top-50 start-50 translate-middle">
    <?php
        session_start();
        if(isset($_SESSION['authenticated']))
        {
            if(time() - $_SESSION['lasttime'] > 60)
            {
                header("Location: login.php", true, 301);
                exit();
            }

            else
            {
                $_SESSION['lasttime'] = time();
            }
        }

        else
        {
            header("Location: login.php", true, 301);
            exit();
        }

        if(isset($_POST['logout']))
        {
            session_unset();
            session_destroy();
            header("Location: login.php", true, 301);
            exit();
        }
    ?>

    <form action="" method="POST">
        <h1 class="text-center mb-4"> Welcome </h1>
        <div class="d-grid gap-2 col-6 mx-auto">
            <button type="submit" name="logout" class="btn btn-outline-danger">Logout</button>
        </div>
    </form>

     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>