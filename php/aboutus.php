<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/aboutus.css?version=39">
    <link rel="stylesheet" type="text/css" href="../css/mydashboard.css?version=72">
    <title>About Us!</title>
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
    <div class="container">
        <div class="row">
            <div class="col-lg aboutus">
            <h1 id="abouthead">About Us!</h1>
               <hr id="abouthr">
            <p id="aboutpara">In the world of technology where efficiency is the first priority of every Business or Firm, PickIt provides you with the most efficient and trustworthy courier service at your doorsteps. It is a countrywide service which will collect the parcel from sender’s place to deliver it at receiver’s end, in your desired time.
<br>PickIt courier service was established in July 2019, by undergraduates of MUET University for facilitating their customers. The key idea behind development of this courier service is to save sender’s time by collecting the parcel from sender’s doorsteps.<br> Our website has a user friendly interface for the ease of our customers. Additionally, PickIt facilitates you to send your parcels on special events, by allowing you to enter specific dates for delivery. We promise you satisfactory services, including security service and on-time delivery service. <br>However, we are also awarding Reward Points for our valuable customers, which offers them special discounts.</p>
               
            </div>
            <div class="col-lg imageContainer">   
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
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>