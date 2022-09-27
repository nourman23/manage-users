<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="./Style.css">

    <title>Update users</title>
</head>

<style>
.updateF {
    width: 900px;
    margin: 30px auto;
}

.updateF input {
    padding: 20px;
    margin: 20px;
    width: 500px;
}

.updateF .btn {
    width: 100px;
    color: white;
    padding: 6px;
    border: none;
}

.updateF .btn {
    background-color: #af7c0f;
    cursor: pointer;
}

.updateF b {
    margin: 40px;
}

.updateF b:nth-child(1) {
    margin: 10px;
}
</style>

<body>



    <?php
    require_once 'conFile.php';
    // Get the userid
    $userEmail = $_GET['email'];
    $sql = "SELECT * from users where Email=:em";
    //Prepare the query:
    $query = $conn->prepare($sql);
    //Bind the parameters
    $query->bindParam(':em', $userEmail, PDO::PARAM_STR);
    //Execute the query:
    $query->execute();
    //Assign the data which you pulled from the database (in the preceding step) to a variable.
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    // For serial number initialization
    $cnt = 1;
    if ($query->rowCount() > 0) {
        //In case that the query returned at least one record, we can echo the records within a foreach loop:
        foreach ($results as $result) {
    ?>
    <form name="insertrecord" method="post" class="updateF">
        <div class="row">
            <div class="col-md-4"><label class="upLabel">Email </label>
                <input type="text" name="email" value="<?php echo htmlentities($result->Email); ?>" class="form-control"
                    required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"><label class="upLabel">Mobile</label>
                <input type="tel" name="mobile" value="<?php echo htmlentities($result->Mobile); ?>"
                    class="form-control" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"><label class="upLabel">Full name</label>
                <input type="text" name="fullName" value="<?php echo htmlentities($result->FullName); ?>"
                    class="form-control" maxlength="10" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"><label class="upLabel">Password</label>
                <input type="password" name="pass" value="<?php echo htmlentities($result->Password); ?>"
                    class="form-control" maxlength="10" required>
            </div>
        </div>
        <?php }
    } ?>
        <div class="row" style="margin-top:1%">
            <div class="col-md-8">
                <input type="submit" name="update" value="Update" class="btn">
            </div>
        </div>
    </form>


    <?php
            // include database connection file
            require_once 'conFile.php';
            if (isset($_POST['update'])) {
                // Get the userid
                $userEmail = $_GET['email'];
                // Poted Values
                $Email = $_POST['email'];
                $Mobile = $_POST['mobile'];
                $FullName = $_POST['fullName'];
                $pass = $_POST['pass'];
                // Query for Updation

                $data = [
                    //     // ':name' => $name,
                    ':usrEml' =>  $userEmail,
                    ':eml' => $Email,
                    ':name' => $FullName,
                    ':mbl' =>  $Mobile,
                    ':pass' => $pass,
                ];
                $update = "UPDATE `users` SET `Email` =:eml , `FullName` =:name , `Mobile` =:mbl , `Password` =:pass WHERE `users`.`Email` = :usrEml;";
                //Prepare Query for Execution
                $update_run = $conn->prepare($update);
                // Query Execution
                $update_run->execute($data);
                // Mesage after updation
                // echo "<script>alert('Record Updated successfully');</script>";
                // Code for redirection
                echo "<script>window.location.href='Admin.php'</script>";
            }
            ?>

</body>

</html>