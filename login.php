<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./style.css" />
    <title>LogIn</title>
</head>

<body class="logBody">
    <div class="loginPage">
        <h2>Login</h2>
        <p>Welcome back ! login with your credentials</p>
        <form action="" class="logF" method="post">
            <!-- <label for="">Email</label> -->

            <input type="text" name="email" value="" id="email" required placeholder="Email" />

            <!-- <label for="">Password</label> -->

            <input type="password" name="pass" value="" id="pass" required placeholder="Password" />

            <a href=""><input type="submit" name="login" value="login" id="logLinkBtn" /></a>
        </form>
        <div>
            Don't have an account ? <b><a href="./signup.html">Sign up</a></b>
        </div>
    </div>

    <?php
  require_once 'conFile.php';
  if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['pass'];



    $sql = "SELECT * FROM `users`";
    //Prepare the query:
    $query = $conn->prepare($sql);
    //Execute the query:
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    // type else cond

    // echo "<pre>";
    foreach ($results as $result) {
      if ("Admin@gmail.com" == $email && "nourman1234" == $password) {

        echo "<script>window.location.href='admin.php?email=$email'</script>";
        break;
      } elseif ($result->Email == $email && $result->Password == $password) {


        $logInDate = date('d-m-y h:i:s');
        $insert = $conn->prepare("UPDATE `users` SET `logedDate` = '$logInDate' WHERE `users`.`Email` = '$email'");
        $insert->execute();

        echo "<script>window.location.href='welcome.php?email=$email'</script>";
        break;
      }
      //  else {
      //   echo "<script>alert('invalid Email or Password');</script>";
      //   // break;
      // }
      // echo "</pre>";
    }
  }
  ?>

    <!-- <script src="login.js"></script> -->
</body>

</html>