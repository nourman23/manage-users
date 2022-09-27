<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="./style.css">
    <title>Admin only</title>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="my-4">Users views </h3>
                <hr />
                <!-- <a href=" create.php"><button class="btn btn-primary"> Insert Record</button></a> -->
                <div class="table-responsive">
                    <table id="mytable" class="table table-bordred table-striped">
                        <thead>
                            <th>#</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>FullName</th>
                            <th>Password</th>
                            <th>Date created </th>
                            <th>Date last login </th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>
                            <?php
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
                            ?>

                            <tr>
                                <td><?php echo htmlentities($cnt); ?></td>
                                <td><?php echo htmlentities($result->Email); ?></td>
                                <td><?php echo htmlentities($result->Mobile); ?></td>
                                <td><?php echo htmlentities($result->FullName); ?></td>
                                <td><?php echo htmlentities($result->Password); ?></td>
                                <td><?php echo htmlentities($result->createdDate); ?></td>
                                <td><?php echo htmlentities($result->logedDate); ?></td>

                                <td><a href="update.php?email=<?php echo htmlentities($result->Email); ?>"><button
                                            class="btn  btn-xs updateBtn">
                                            <span>
                                                <ion-icon name="create-outline"></ion-icon>
                                            </span></button></a></td>
                                <td><a href="delete.php?email=<?php echo htmlentities($result->Email); ?>"><button
                                            class="btn deleteBtn btn-xs"
                                            onClick="return confirm('Do you really want to delete');">
                                            <span>
                                                <ion-icon name="trash-outline"></ion-icon>
                                            </span></button></a></td>
                            </tr>


                            <?php
                                    // for serial number increment
                                    $cnt++;
                                }
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">

    </script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>