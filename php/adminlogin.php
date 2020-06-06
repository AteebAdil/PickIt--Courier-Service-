<?php
Session_start();
$error="";
if($_POST){
if(isset($_POST["submit"])){
      if(!$_POST["username"]){
        $error.="Username is required.<br>";
      }
      else{    
      $username=$_POST["username"];
      }
      if(!$_POST["password"]){
      $error.="Password is required.<br>";
      }
      else{
      $password=$_POST["password"];
      }
      if($error != ""){
      $error = '<div class="alert alert-danger" role="alert"><p><strong>
      There were error(s) in your form:</strong></p>' . $error . '</div>';
        }
      else {
        if($username=="admin" && $password=="admin"){
            $_SESSION["admin"]="login";
            header("Location:admin.php");
            exit;
        }
        else
            {
                $error = '<div class="alert alert-danger" role="alert">Invalid Username or Password </div>';
            }
        }
}
}
?>
<!doctype html>
  <html lang="en">  
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Login Form!</title>
    <link rel="stylesheet" type="text/css" href="../css/adminlogin.css?version=11">        
        
    </head>
  
    <body> 
      <div class="container-fluid">
        <div class="row">
        <div class="col-sm"></div>    
        <div class="col-sm"> 
            <form  class="form-container" autocomplete="off" method="POST">
                <h1>Admin</h1>
                <div id="error"><?php echo $error;?></div>
                <div class="form-group">
                      <label for="exampleInputuser1">Username:</label>
                      <input type="username" name="username" class="form-control" id="exampleInputuser1" placeholder="Enter Username" required>
                </div>
                <div class="form-group">
                      <label for="exampleInputPassword1">Password:</label>
                      <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Enter Password" required >
                </div>
                      <button type="submit" name="submit" class="btn btn-outline-info btn-lg btn-block ">Sign In</button>
            </form>
        </div> 
        <div class="col-sm"></div>
        </div>
        </div>
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>