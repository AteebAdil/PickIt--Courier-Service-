<?php
include("connection.php");
session_start();
$login=$_SESSION["loginuser"];
$userid=$_SESSION["loginid"];
$error="";
$error1="";
// Diplay Profile code
if($login!=""){
  $sql = "SELECT * FROM login, profile WHERE login.User_id=profile.User_id AND login.User_id='$userid'";
  $result = mysqli_query($conn, $sql);
  $total=mysqli_num_rows($result);
  $row = mysqli_fetch_assoc($result);
  if($total==0){
  $sql = "SELECT * FROM login where User_id='$userid'";
  $result = mysqli_query($conn, $sql);
  $total=mysqli_num_rows($result);
  $row = mysqli_fetch_assoc($result);
  $username=$row['Username'];
  $imagesrc=$row['ProfileImage'];
  $reward=0;
  $email=$row['Email'];
  $name="Not Set";
  $city="Not Set";
  $state="Not Set";
  $province="Not Set";
  $address="Not Set";
  $contact="Not Set";
  if($_POST){
    if(isset($_POST["update"])){
      if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $error.= "Email is invalid<br>";
      }
      else{
          $email=$_POST["email"];
      }
      if($error != ""){
        $error = '<div class="alert alert-danger" role="alert"><p><strong>
        There were error(s) in your form:</strong></p>' . $error . '</div>';}
        else{
          $sql = "UPDATE login SET Email='$email' WHERE User_id='$userid'";
          if (mysqli_query($conn, $sql)) {
            $error = '<div class="alert alert-success" role="alert"><p><strong>
          Successfully Updated Your Profile:</strong></p></div>';}
          else {
            $error = '<div class="alert alert-danger" role="alert">'.mysqli_error($conn) . $error . '</div>';
          }
  }
}
  }
}
  else{
  $imagesrc=$row['ProfileImage'];
  $username=$row['Username'];
  $email=$row['Email'];
  $name=$row['Name'];
  $city=$row['City'];
  $state=$row['State'];
  $province=$row['Province'];
  $address=$row['Address'];
  $contact=$row['Contact'];
  $reward=$row['Reward'];
  if($_POST){
    if(isset($_POST["update"])){    
    $name=$_POST["name"];
    $state=$_POST["state"];
    $city=$_POST["city"];
    $province=$_POST["province"];
    $address=$_POST["address"];
    if($_POST["phoneno"]!="" && strlen($_POST["phoneno"])!=10){
        $error.= "Phone number is invalid<br>";
    }
    else{
    $phoneno=$_POST["phoneno"];
    }
    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
      $error.= "Email is invalid<br>";
    }
    else{
        $email=$_POST["email"];
    }
    if($error != ""){
      $error = '<div class="alert alert-danger" role="alert"><p><strong>
      There were error(s) in your form:</strong></p>' . $error . '</div>';}
    else{
      $sql = "UPDATE login , profile  SET Email='$email',Name='$name',City='$city',State='$state',Province='$province',Address='$address',Contact='$phoneno' WHERE login.User_id=profile.User_id AND login.User_id='$userid'";
      if (mysqli_query($conn, $sql)) {
        $error = '<div class="alert alert-success" role="alert"><p><strong>
      Successfully Updated Your Profile:</strong></p></div>';}
      else {
        $error = '<div class="alert alert-danger" role="alert">'.mysqli_error($conn) . $error . '</div>';
      }
           
    }
    }
    }
  
}
// upload profile section
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
                      $error1.= '<div class="alert alert-success" role="alert"><p><strong>
                    Successfully Uploaded Your Image:</strong></p></div>';}
                    else {
                      $error1.= '<div class="alert alert-danger" role="alert">'.mysqli_error($conn) . $error . '</div>';
                    }
                  move_uploaded_file($fileTmpName,$fileDestination);   
                  }
                  else{
                      $error1.= '<div class="alert alert-warning" role="alert"><p><strong>Your Image Is Too Big</strong></p></div>';    
                  }
              }
              else{
                  $error1.= '<div class="alert alert-danger" role="alert"><p><strong>There Was an Errors in Uploading Your Image</strong></p></div>';
              }
      }
      else{
          $error1.= '<div class="alert alert-danger" role="alert"><p><strong>You Cannot Upload This File Type</strong></p></div>';
      }
  }
}
}
else{
  header("Location:login.php");
  exit;
}
mysqli_close($conn);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/mydashboard.css?version=62">
    <link rel="stylesheet" type="text/css" href="../css/profile.css?version=39">
    <title>Profile!</title>
  </head>
  <body>
      
<nav class="navbar fixed-top navbar-expand-lg navbar-dark ">
      <div class="nav-item name">
      <a class="navbar-brand" href="mydashboard.php">Pick It!</a>
      </div>
          <div class="nav-item active ml-auto mr-2 order-lg-last userdiv">
          <a class="nav-link userlink" href="profile.php"><img id="userImage" src="../upload/<?php echo $imagesrc;?>"><?php echo $username;?></a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon "></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
          <ul class="navbar-nav mr-auto mt-2 mt-lg-0 list">
          <li class="nav-item active">
            <a class="nav-link" href="request.php" id="requestform">Request Form<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="cancel.php">Cancel Request</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#contactus" onclick="show()">Contact Us</a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="aboutus.php" >About Us</a>
          </li>
          </ul>
          <button class="btn btn-outline-info mr-lg-3 button" type="button" id="signout">Sign Out</button>        
      </div>
    </nav>
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 leftContainer">
                            <div class="pic">  
                            <form  enctype="multipart/form-data" method="POST">
                            <div class="input-group" id="choose">
                            <div class="custom-file">
                            <input type="file" class="custom-file-input" name="file" id="inputGroupFile04">
                            <label class="custom-file-label" for="inputGroupFile04">Choose Image</label>
                            </div>
                            <div class="input-group-append">
                            <button class="btn btn-outline-info" type="submit" name="submit">Upload</button>
                            </div>
                            </div>      
                            </form>
<!--                            <div id="error1"><?php echo $error1;?></div>  -->
                            <img id="profileImage" class="img-thumbnail" src="../upload/<?php echo $imagesrc;?>">
                            </div>
                            <div class="detail">
                            <h3 id="h3"><?php echo $username?></h3>
                            </div>    
                        </div>
                        <div class="col-md rightContainer">
                          <h2 id="h2">Editable Profile</h2>
                          <form  class="detail-form" autocomplete="off" method="POST">
                          <div id="error"><?php echo $error;?></div>
                            <div class="form-group row" >
                                    <label for="exampleInputName" class="col-sm-2 col-form-label">Name:</label>
                              <div class="col-sm-4">
                                  <?php
                                  if($name=="Not Set"){
                                      ?>
                                    <input type="text" class="form-control" id="exampleInputName"  value="<?php echo $name ?>" readOnly>
                                  <?php
                                  }
                                  else{
                                  ?>
                                  <input type="text" class="form-control" name="name" id="exampleInputName"  value="<?php echo $name ?>">
                                  <?php
                                  }
                                  ?>
                                  </div>
                                  <label for="exampleInputState" class="col-sm-2 col-form-label">State:</label>
                              <div class="col-sm-4">
                              <?php
                                  if($state=="Not Set"){
                                      ?>  
                                  <input type="text" class="form-control"  id="exampleInputState" value="<?php echo $state ?>" readOnly>
                                  <?php
                                  }
                                  else{
                                  ?>
                                  <input type="text" class="form-control" name="state" id="exampleInputState" value="<?php echo $state ?>">
                                  <?php
                                  }
                                  ?>
                                  </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleInputCity" class="col-sm-2 col-form-label">City:</label>
                              <div class="col-sm-4">
                              <?php
                                  if($city=="Not Set"){
                                      ?>
                                    <input type="text" class="form-control" id="exampleInputCity" value="<?php echo $city ?>" readOnly>
                                    <?php
                                  }
                                  else{
                                  ?>
                                  <input type="text" class="form-control" name="city" id="exampleInputCity" value="<?php echo $city ?>">
                                  <?php
                                  }
                                  ?>
                                </div>
                                    <label for="exampleInputProvice" class="col-sm-2 col-form-label">Province:</label>
                              <div class="col-sm-4">
                              <?php
                                  if($province=="Not Set"){
                                      ?>
                                    <input type="text" class="form-control"  id="exampleInputProvince" value="<?php echo $province ?>" readOnly>
                                    <?php
                                  }
                                  else{
                                  ?>
                                  <input type="text" class="form-control" name="province" id="exampleInputProvince" value="<?php echo $province ?>">
                                  <?php
                                  }
                                  ?>
                                  </div>
                                </div>
                                <div class="form-group row">
                                <label for="exampleInputEmail" class="col-sm-2 col-form-label">Email:</label>
                              <div class="col-sm-6">
                                  <input type="email" class="form-control" name="email" id="exampleInputEmail" value="<?php echo $email ?>">
                                  </div>    
                                </div>
                                <div class="form-group row">
                                <label for="exampleInputAddres" class="col-sm-2 col-form-label">Address:</label>
                                <div class="col-sm-8">
                                <?php
                                  if($address=="Not Set"){
                                      ?>
                                    <input type="text" class="form-control" id="exampleInputAddress" value="<?php echo $address ?>" readOnly>
                                    <?php
                                  }
                                  else{
                                  ?>
                                  <input type="text" class="form-control" name="address" id="exampleInputAddress" value="<?php echo $address ?>">
                                  <?php
                                  }
                                  ?>
                                  </div>
                              </div>    
                                <div class="input-group row">
                                  <label for="exampleInputPhno" class="col-sm-3 col-form-label">Phone Number:</label>
                              <div class="input-group-prepend col-sm-6">
                                    <span class="input-group-text" id="phnno">92</span>
                                    <?php
                                  if($contact=="Not Set"){
                                      ?>
                                  <input type="text" class="form-control" id="exampleInputPhno"  pattern="[1-9]{1}[0-9]{9}" title="Kindly follow this Format:92xxxxxxxxxx" value="<?php echo $contact ?>" readOnly>
                                    <?php 
                                }
                                  else{
                                  ?>
                                  <input type="text" class="form-control" name="phoneno" id="exampleInputPhno"  pattern="[1-9]{1}[0-9]{9}" title="Kindly follow this Format:92xxxxxxxxxx" value="<?php echo $contact ?>">
                                  <?php
                                  }
                                  ?>
                                  </div>
                                </div>
                                <button class="btn btn-outline-info btn-md" name="update" type="submit" id="update">Update</button>
                                <div class="form-group reward">
                                <label class="form-label">Reward:</label>
                                <span id="rewardValue"><?php echo $reward; ?></span>
                                <img src="../image/icons8-coins-48.png" id="coins">
                                </div>
                            </form>
                            </div>  
                    </div>
                </div>
                <footer class="page-footer" id="contactus">
      <h1 id="foothead">Contact Us</h1>
      <address>
      Email: <a class="Email" href=https://mail.google.com/mail/?view=cm&fs=1&tf=1&to=Pickitcourierservice@gmail.com>Pickitcourierservice@gmail.com</a><br>
              Phone Number: 0305-3668955,0303-3160090<br>
              UAN Number: 111-90-80-70<br>
              Address: Pickit center,Street-5,F-7/2 Islamabad.<br>
      </address>
</footer >
    <script>
        function show() {
        var x = document.getElementById("contactus");
        if (x.style.display === "none") {
          x.style.display = "block";
          
        } 
        else {
          x.style.display = "none";
              }
          }   
              document.getElementById("signout").onclick=function(){
                location.href="logout.php";
              }
            </script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>