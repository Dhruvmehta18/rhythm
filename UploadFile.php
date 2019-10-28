<?php
//allowed file types

session_start();
$email=$_SESSION['email'];
 function makeDir($str){
    if (!file_exists($str)) {
        mkdir($str, 0777);
    }
 }
if ($_FILES['fileToUpload']['type']==NULL||$_FILES['fileToUpload']['type']=='') {
    echo json_encode(['type'=>'error','message'=>'File Extension is not valid']);
    return;
}
$dir="image";
if (!file_exists($dir)) {
    mkdir($dir, 0777);
}
$currentYear = date("Y");
$target_dir = "$dir/$currentYear";
makeDir($target_dir);
$today = date('z');
$target_dir = "$target_dir/Day_$today/";
makeDir($target_dir);
$status =['type'=>'error','message'=>''];
$uploadOk = 1;
$fileType = strtolower(pathinfo($_FILES["fileToUpload"]["name"],PATHINFO_EXTENSION));
$fileName = basename($_FILES["fileToUpload"]["name"]);
$temp = explode(".", $fileName);
$name='';
for ($i=0; $i < count($temp)-1; $i++) { 
    $name=$name.$temp[$i];
}
$time = round(microtime(true)).'';
$shaFile = sha1($time);
$newFilename = $name.'_'.$shaFile.'.'.$fileType;
$target_file = $target_dir . $newFilename;
$file_size = $_FILES["fileToUpload"]["size"];
// Check file size
if ($file_size > ) {
    $status['message']="Sorry, your file is too large."; 
    echo json_encode($status);
    $uploadOk = 0;
    return;
}
// Check if file already exists
if (file_exists($target_file)) {
    $status['message']="Sorry, file already exists."; 
    echo json_encode($status);
    $uploadOk = 0;
    return;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $status['message']="Sorry, your file was not uploaded.";
    echo json_encode($status);
    return;
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        include 'connection.php';
        $status['type']='success';
        $status['data']=$target_file;
        $query="UPDATE users SET userPic='$target_file' where email like '$email'";
        $data= mysqli_query($conn,$query);
        echo json_encode($status);
    } else {
        $status['message']="Sorry, there was an error uploading your file.". $target_file ;
        echo json_encode($status);
    }
}
die();
?>