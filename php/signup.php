<?php
 include("connection.php");
$error= "";
if($_POST){
    if(isset($_POST["submit"])){
if(!$_POST["username"]){
    $error.="Username is required.<br>";
}
else{    
$username=$_POST["username"];
}
if(!$_POST["email"]){
    $error.="Email is required.<br>";
}
else{
$email=$_POST["email"];
}
if(!$_POST["password"]){
    $error.="Password is required.<br>";
}
else{
$password=$_POST["password"];
}
if ($_POST["email"] && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)==FALSE) {
    $error.= "Email is invalid";
}
if($error != ""){
    $error = '<div class="alert alert-danger" role="alert"><p><strong>
    There were error(s) in your form:</strong></p>' . $error . '</div>';}
else{
$sql = "INSERT INTO login (Username,Email,Password,ProfileImage)
VALUES ('$username', '$email', '$password','Default.png')";
if (mysqli_query($conn,$sql)) {
    header("Location:mydashboard.php");
}
else {
    $error='<div class="alert alert-danger" role="alert">
    Error: Username is already exist.</div>';}     
}
}
}
mysqli_close($conn);

?>
<!doctype html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Sign Up!</title>
    <link rel="stylesheet" type="text/css" href="../css/signup.css?version=1">        
        
    </head>
  
    <body>
        
        <div class="container">
            <div class="row">    
            <div class="col-md">
                <form onsubmit="return check();"class="signup-container" autocomplete="on" method="POST">
                        <h1 id="h1">Create An Account!</h1>
                        <hr>
                        <div id="error"><?php echo $error; ?></div>
                        <div class="form-group">
                            <label for="exampleInputusername1">Username:</label>
                            <input type="username" name="username" class="form-control" id="exampleInputusername1" placeholder="Enter Username" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password:</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Enter Password" autocomplete="off" pattern=".{8,}" maxlength="15"title="Password must be at least 8 character long" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputrepas1">Retype Password:</label>
                            <input type="password" class="form-control" id="exampleInputrepas1" placeholder="Retype Password" autocomplete="off" maxlength="15" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputemail1">Email:</label>
                            <input type="email" name="email" class="form-control" id="exampleInputemail1" placeholder="Enter Email" required>
                        </div>    
                            <button  id="btn-create" name="submit" type="submit" class="btn btn-outline-dark btn-lg btn-block ">Create</button>    
                </form>
            </div> 
            <div class="col-md"></div>
            </div>
        </div>
        <script>
            function check(){    
            if(document.getElementById("exampleInputPassword1").value != document.getElementById("exampleInputrepas1").value){
               document.getElementById("error").innerHTML='<div class="alert alert-danger" role="alert">Password Does Not Match</div>';
                return false; 
                } 
                }
            </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>