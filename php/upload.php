<?php
include('connection.php');
Session_start();
$error="";
$userid=$_SESSION["loginid"];
if($_POST){
    if(isset($_POST['submit'])){
        $file=$_FILES['file'];
        $fileName=$_FILES['file']['name'];
        $fileTmpName=$_FILES['file']['tmp_name'];
        $fileSize=$_FILES['file']['size'];
        $fileError=$_FILES['file']['error'];
        $fileType=$_FILES['file']['type'];
        
        $fileExt= explode('.',$fileName);
        $fileActualExt= strtolower(end($fileExt));
        $allowed = array('jpg','jpeg','png');
        if(in_array($fileActualExt,$allowed)){
                if($fileError===0){
                    if($fileSize<1000000){
                    $fileDestination= '../upload/'.$fileName;
                    $sql1 = "SELECT ProfileImage FROM login where User_id='$userid'";
                    
                    $result1 = mysqli_query($conn, $sql1);
                    if(mysqli_num_rows($result1)>0)
                    {
                        $row = mysqli_fetch_assoc($result1);
                        if($row["ProfileImage"]!="Default.png"){
                            $filenameol=$row["ProfileImage"];
                            $fileDestinationold= '../upload/'.$filenameol;
                            unlink($fileDestinationold);
                        }
                    }
                    $sql="UPDATE login SET ProfileImage='$fileName' WHERE User_id='$userid'";
                    if (mysqli_query($conn, $sql)) {
                        $error = '<div class="alert alert-success" role="alert"><p><strong>
                      Successfully Uploaded Your Image:</strong></p></div>';}
                      else {
                        $error = '<div class="alert alert-danger" role="alert">'.mysqli_error($conn) . $error . '</div>';
                      }
                    move_uploaded_file($fileTmpName,$fileDestination);
                    header("Location:profile.php");   
                    }
                    else{
                        $error = '<div class="alert alert-warning" role="alert"><p><strong>Your Image Is Too Big</strong></p></div>';    
                    }
                }
                else{
                    $error = '<div class="alert alert-danger" role="alert"><p><strong>There Was an Errors in Uploading Your Image</strong></p></div>';
                }
        }
        else{
            $error = '<div class="alert alert-danger" role="alert"><p><strong>You Cannot Upload This File Type</strong></p></div>';
        }
    }
}








?>