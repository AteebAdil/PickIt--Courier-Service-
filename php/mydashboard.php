
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/mydashboard.css?version=64">
    <title>Dashboard!</title>
  </head>
  <body>
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark ">
      <div class="nav-item name">
      <a class="navbar-brand" href="mydashboard.php">Pick It!</a>
      </div>

<?php
error_reporting(0);
session_start();
$_SESSION["url"]=$_SERVER['PHP_SELF'];
include("connection.php");
$userid=$_SESSION["loginid"];
if($_SESSION["loginuser"]!=""){
  $sql = "SELECT * FROM login where User_id='$userid'";
            $result = mysqli_query($conn, $sql);
            $total=mysqli_num_rows($result);
            $row = mysqli_fetch_assoc($result);
            $username=$row['Username'];
            $imagesrc=$row['ProfileImage'];
          ?>
          <div class="nav-item active ml-auto mr-2 order-lg-last userdiv">
          <a class="nav-link userlink" href="profile.php"><img id="userImage" src="../upload/<?php echo $imagesrc;?>"><?php echo $username;?></a>
          </div>
          <?php
}
else{
?>
<button class="btn btn-outline-info ml-auto mr-2 order-lg-last button"id="signup1" type="button">Sign Up</button>
          <script>
          document.getElementById("signup1").onclick=function(){
          location.href="signup.php";
        }
        </script>  
<?php 
}
?>
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
        <?php
        if($_SESSION["loginuser"]!=""){
          ?>
          <button class="btn btn-outline-info mr-lg-3 button" type="button" id="signout">Sign Out</button>
          <script>
          document.getElementById("signout").onclick=function(){
                  location.href="logout.php";
                }
          </script>      
          <?php   
        }
        else{
          ?>
          <button class="btn btn-outline-info mr-lg-3 button" type="button" id="signin">Sign In</button>
          <script>
          document.getElementById("signin").onclick=function(){
                  location.href="login.php";
        }
      </script>
        <?php    
        }
        ?>  
      </div>
    </nav>
    <div class="jumbotron dashboardjumbotron">
        <h1 class="display-4" id="h1">
          <blink>Pick It!</blink>
        </h1>
        <p class="message">Aim's To Provide Easiness.</p>
        <br>
        <br>
        <?php
        if($_SESSION["loginuser"]!=""){
          ?>
          <p class="message">We value Your Time!</p>
          <button class="btn btn-lg btn-outline-info mr-lg-3 " id="scroll" type="button">Scroll Down</button>  
          <script>
          document.getElementById("scroll").onclick=function(){
          location.href="#icons";
        }
        </script>
        <?php
        } 
        else{
        ?>
          <p class="message">Signup To Become Our Partner.</p>
        <button class="btn btn-lg btn-outline-info mr-lg-3 " id="signup2" type="button">Sign Up</button>
        <script>
          document.getElementById("signup2").onclick=function(){
          location.href="signup.php";
        }
        </script>
      <?php  
      }
      ?>
        </div>
      <div class="container" >
      <h2 id="facilities">Facilities We Provide:</h2>
      <h4 id="line">--------------X--------------</h4>
      <dl class="row facilities">
      <dt class="col-sm-3">MORE SAVINGS</dt>
      <dd class="col-sm-9"><p>- A cheaper way to send parcels within country.</p></dd>
      <dt class="col-sm-3">HIGHLY SECURITY</dt>
      <dd class="col-sm-9"><p>- Parcel is delivered under admin's supervision.</p></dd>
      <dt class="col-sm-3">TIME SAVING</dt>
      <dd class="col-sm-9"><p>- Ensures fastest and on time delivery all over the coundtry.</p></dd>
      <dt class="col-sm-3 ">WIDE RANGE OF STAFFS</dt>
      <dd class="col-sm-9">
      <P>- We have a wide range of staff distributed in different parts of <br> country to manage on time delivery.</P> 
      </dd>
      <dt class="col-sm-3">HIGHLY EFFICIENT</dt>
      <dd class="col-sm-9">
      <p>- Collects the parcel from sender's doorsteps, increasing customer ease.</p>
      </dd>
      </dl>
      <div class="row">
      <div class="col-sm divicons" id="icons"> 
        <img class="img-thumbnail icons" src="../Image/Doortodoor.png">
        <h5 class="IconLabel">Door To Door </h5>
      </div>
      <div class="col-sm divicons">
        <img class="img-thumbnail icons" src="../Image/outcity.jpg">
        <h5 class="IconLabel">Across The Country</h5>
      </div>
      <div class="col-sm divicons">
        <img class="img-thumbnail icons" src="../Image/Deliver.png">
        <h5 class="IconLabel">Pick And Deliver</h5>
      </div>
      <div class="col-sm divicons">
        <img class="img-thumbnail icons" src="../Image/mail.jpg">
        <h5 class="IconLabel">Confirmation Through Mail</h5>
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
        
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>