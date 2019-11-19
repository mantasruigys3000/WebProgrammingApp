<!doctype html>

<html lang="en">
      <head>
        <meta charset="utf-8">

        <title>The HTML5 Herald</title>
        <meta name="description" content="The HTML5 Herald">
        <meta name="author" content="SitePoint">

        <link rel="stylesheet" href="css/styles.css?v=1.0">

      </head>

      <body>
      <h1>Test web server can write to user area</h1>
      
<div>

<?php
$target_dir = "/home/s5112120/public_html/sys_tests/uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$imageinfo = array();
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"],$imageinfo);
    if($check !== false) {
        echo "<br>File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "<br>File is not an image.";
        echo "<pre>";
        print_r($imageinfo);
        echo "</pre>";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "<br>Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 1048576) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if (!($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType != "gif" )){
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "<br>Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        echo "<br>File can be viewed <a href=\"/sys_tests/uploads/".basename($_FILES["fileToUpload"]["name"])."\">here</a>";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>




</body>
</html>