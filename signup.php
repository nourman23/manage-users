<?php
require_once 'conFile.php';
$email = $_POST['email'];
$password = $_POST['password'];
$fullName = $_POST['fullName'];
$mobile = $_POST['mobile'];
$birthday = $_POST['birthday'];
$file = $_POST['image'];

$createdDate = date('d-m-y h:i:s');
// echo $_POST['email'] . $_POST['password'] . $_POST['fullName'] . $_POST['mobile'] . $_POST['birthday'] .  $createdDate;
$statusMsg = '';

// File upload path
$targetDir = "uploads/";
$fileName = basename($file);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);


if (!empty($file)) {
    // Allow certain file formats
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
    if (in_array($fileType, $allowTypes)) {
        // Upload file to server
        // if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
        // Insert image file name into database
        // $insert = $conn->prepare("INSERT into users (file_name) VALUES ('$fileName ')");

        // $insert->execute();
        echo "doneeeeeeee";
        $insertR = $conn->prepare("INSERT INTO users (`Email`, `Mobile`, `FullName`, `file_name`, `Password`, `Birth`, `createdDate`) VALUES ('$email','$mobile','$fullName','$fileName','$password','$birthday','$createdDate')");
        $insertR->execute();
        if ($insertR) {
            $statusMsg = "The file " . $fileName . " has been uploaded successfully.";
        } else {
            $statusMsg = "File upload failed, please try again.";
        }
        // } 
        // else {
        //     $statusMsg = "Sorry, there was an error uploading your file.";
        // }
    } else {
        $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
    }
} else {
    $statusMsg = 'Please select a file to upload.';
}

// Display status message
echo $statusMsg;


// echo "<script>window.location.href='welcome.php?email=$email'</script>";
// header('Location: ' . 'http://localhost/task/welcome.php?email=' . $email);