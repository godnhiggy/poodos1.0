<?php
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");


echo $_POST["ocrImage"];

if(isset($_POST["ocrImageSubmit"])){




  // PHP program to delete all
  // file from a folder

  // Folder path to be flushed
  $folder_path = "../ocrImages";

  // List of name of files inside
  // specified folder
  $files = glob($folder_path.'/*');

  // Deleting all the files in the list
  foreach($files as $file) {

      if(is_file($file))

          // Delete the given file
          unlink($file);
  }




$target_dir = "../ocrImages/";
$target_file = $target_dir . basename($_FILES["ocrImage"]["name"]);

$target_file = "../ocrImages/".time().".jpeg";
//echo $target_file;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["ocrImage"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
//if (file_exists($target_file)) {
//  echo "Sorry, file already exists.";
//  $uploadOk = 0;
//}

// Check file size
if ($_FILES["ocrImage"]["size"] > 10000000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["ocrImage"]["tmp_name"], $target_file)) {
    //echo "The file ". htmlspecialchars( basename( $_FILES["fileToUploadBlockFour"]["name"])). " has been uploaded.";
    header("Location: ocr1.php");
  } else {
    echo "Sorry, there was an error uploading your file.";
    echo "<br>".$target_file;
  }
}

}
?>
