<?php 
$error="";
include("connection.php");
session_start();
$_SESSION["url"]=$_SERVER['PHP_SELF'];
$userid=$_SESSION["loginid"];
if($userid!= ""){
  $sqluser = "SELECT * FROM login where User_id='$userid'";
            $resultuser = mysqli_query($conn, $sqluser);
            $total=mysqli_num_rows($resultuser);
            $row = mysqli_fetch_assoc($resultuser);
            $username=$row['Username'];
            $imagesrc=$row['ProfileImage'];
if($_POST){
  if(isset($_POST["submit"])){
    $parcelno=implode($_POST);
  $sql = "UPDATE parcel SET Parcel_status='Canceled' WHERE Parcel_no='$parcelno'";
  if (mysqli_query($conn, $sql)) {
    $error = '<div class="alert alert-success" role="alert"><P><strong>
  Your Parcel Has Been Successfully Cancelled</strong></p></div>';}
  else {
    $error = '<div class="alert alert-danger" role="alert">'.mysqli_error($conn) . '</div>';
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
    <link rel="stylesheet" type="text/css" href="../css/mydashboard.css?version=61">
    <link rel="stylesheet" type="text/css" href="../css/cancel.css?version=51">
    <title>Cancel!</title>
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
    <div class="col-md">
    <h3 id="h3">Parcels Info:</h3>
    <div id="error"><?php echo $error; ?></div>
    <table class="table table-lg tabel-responsive table-bordered">
    <thead class="tablehead">
    <tr>  
        <th scope="col">Parcel(No)</th>
        <th scope="col">Parcel(Type)</th>
        <th scope="col">Parcel(Weight)</th>
        <th scope="col">Parcel(Date)</th>
        <th scope="col">Parcel(Status)</th>
        <th scope="col">Cancel</th>
        </tr>
        </thead>
        <?php
        $sql = "SELECT * FROM parcel,customer Where parcel.Sender_id=customer.Cust_id AND customer.User_id='$userid' AND parcel.Parcel_status!='Canceled' " ;
        $result = mysqli_query($conn, $sql);
        if ( mysqli_num_rows($result)> 0) {
        while($row= mysqli_fetch_assoc($result)) {
               ?> 
        <tbody class="tablebody">
        <tr>       
        <th scope="row"><?php echo $row["Parcel_no"]; ?></th>
        <td><?php echo $row["Parcel_type"]; ?></td>
        <td><?php echo $row["Parcel_weight"]; ?></td>
        <td><?php echo $row["Parcel_pickupdate"]; ?></td>
        <td><?php echo $row["Parcel_status"]; ?></td>
        <?php
        if($row["Parcel_status"]=="Pending"){
        ?>
          <form method="POST">
        <td><button class="btn btn-outline-dark " name="submit" value="<?php echo $row["Parcel_no"]?>" type="submit">Cancel</button></td>
        </form>
        <?php
        }
        ?>  
        </tr>
        </tbody>

    <?php
    }
        }
    }
    else{
        header("Location:login.php");
        exit;}
        mysqli_close($conn);
        
        ?>
       </table>
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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>





