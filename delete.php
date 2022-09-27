<?php
// include database connection file
require_once 'conFile.php';
// Code for record deletion
if (isset($_REQUEST['email'])) {
    //Get row id
    $userEmail = $_GET['email'];
    //Qyery for deletion
    $sql = "delete from users WHERE  Email=:em";
    // Prepare query for execution
    $query = $conn->prepare($sql);
    // bind the parameters
    $query->bindParam(':em', $userEmail, PDO::PARAM_STR);
    // Query Execution
    $query->execute();
    // Mesage after updation
    // echo "<script>alert('Record Updated successfully');</script>";
    // Code for redirection
    echo "<script>window.location.href='Admin.php'</script>";
}