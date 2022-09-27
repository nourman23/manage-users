<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Welcome</title>
</head>

<body class="welBody">
    <?php
    $userEmail = $_GET["email"];
    require_once 'conFile.php';

    $sql = "SELECT * from users";
    //Prepare the query:
    $query = $conn->prepare($sql);
    //Execute the query:
    $query->execute();
    //Assign the data which you pulled from the database (in the preceding step) to a variable.
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    // For serial number initialization
    $cnt = 1;
    if ($query->rowCount() > 0) {
        //In case that the query returned at least one record, we can echo the records within a foreach loop:
        foreach ($results as $result) {
            if ($result->Email == $userEmail) {
    ?>

    <div class="welcomePag">

        <div class="imgC"><img src="uploads/<?php echo htmlentities($result->file_name); ?>" alt=""></div>
        <h1>Welcome <?php echo htmlentities($result->FullName); ?></h1>

        <p>Your email : <?php echo htmlentities($result->Email); ?> </p>
        <p>Your phone number : <?php echo htmlentities($result->Mobile); ?></p>
        <input type="submit" name="" value="Lets Go !" id="">
    </div>
    <?php
            }
        }
    } ?>
</body>

</html>