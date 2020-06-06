<?php
 include("connection.php");
session_start();
$_SESSION["url"]=$_SERVER['PHP_SELF'];
$userid=$_SESSION["loginid"];
$error= "";
$error1= "";
$error2= "";
$reward=0;
if($_SESSION["loginuser"]!= ""){
  $sqluser = "SELECT * FROM login where User_id='$userid'";
            $resultuser = mysqli_query($conn, $sqluser);
            $total=mysqli_num_rows($resultuser);
            $row = mysqli_fetch_assoc($resultuser);
            $username=$row['Username'];
            $imagesrc=$row['ProfileImage'];
if($_POST){
    if(isset($_POST["submit"])){
if(!$_POST["custname"]){
    $error.="Customer name is required.<br>";
}
else{
$custname=$_POST["custname"];
}
if(!$_POST["custaddress"]){
    $error.="Customer address is required.<br>";
}
else{
$custaddress=$_POST["custaddress"];
}
if(!$_POST["custcity"]){
    $error.="Customer city is required.<br>";
}
else{
$custcity=$_POST["custcity"];
}
if(!$_POST["custprovince"]){
    $error.="Customer province is required.<br>";
}
else{
$custprovince=$_POST["custprovince"];
}
if(!$_POST["custstate"]){
    $error.="Customer state is required.<br>";
}
else{
$custstate=$_POST["custstate"];
}
if(!$_POST["custphoneno"]){
    $error.="Customer phone number is required.<br>";
}
else{
$custphoneno=$_POST["custphoneno"];

}
if(!$_POST["recname"]){
    $error1.="Reciever name is required.<br>";
}
else{
$recname=$_POST["recname"];
}
if(!$_POST["recaddress"]){
    $error1.="Reciever address is required.<br>";
}
else{
$recaddress=$_POST["recaddress"];
}
if(!$_POST["reccity"]){
    $error1.="Reciever city is required.<br>";
}
else{
$reccity=$_POST["reccity"];
}
if(!$_POST["recprovince"]){
    $error1.="Reciever province is required.<br>";
}
else{
$recprovince=$_POST["recprovince"];
}
if(!$_POST["recstate"]){
    $error1.="Reciever state is required.<br>";
}
else{
$recstate=$_POST["recstate"];
}
if(!$_POST["recphoneno"]){
    $error1.="Reciever phone number is required.<br>";
}
else{
$recphoneno=$_POST["recphoneno"];
}
if(!$_POST["parceltype"]){
    $error2.="Parcel Type is required.<br>";
}
else{
$parceltype=$_POST["parceltype"];
}
$parcelweight=$_POST["parcelweight"];
if(!$_POST["parceldate"]){
    $error2.="Parcel Date number is required.<br>";
}
else{
$parceldate=$_POST["parceldate"];
}
if($error != ""){
    $error = '<div class="alert alert-danger" role="alert"><p><strong>
    There were error(s) in your form:</strong></p>' . $error . '</div>';}
else if($error1 != ""){
    $error1 = '<div class="alert alert-danger" role="alert"><p><strong>
    There were error(s) in your form:</strong></p>' . $error1 . '</div>';}
else if($error2 != ""){
    $error2 = '<div class="alert alert-danger" role="alert"><p><strong>
    There were error(s) in your form:</strong></p>' . $error2 . '</div>';}
else{
  $sql= "SELECT * FROM profile where User_id='$userid'";
$result = mysqli_query($conn, $sql);
$total=mysqli_num_rows($result);
if ($total==0) {
  $sql1 = "INSERT INTO profile (Name,City,State,Province,Address,Contact,Reward,User_id)
VALUES ('$custname','$custcity','$custstate','$custprovince','$custaddress','$custphoneno','$reward','$userid')";
$result0=mysqli_query($conn, $sql1);
}
$sql2 = "INSERT INTO customer (Cust_name, Cust_address, Cust_city, Cust_province, Cust_state, Cust_contact,User_id)
VALUES ('$custname', '$custaddress', '$custcity','$custprovince','$custstate','$custphoneno','$userid')";
if(mysqli_query($conn,$sql2)){
  $sqlprofile = "SELECT * From profile WHERE User_id='$userid'";
  $resultprofile = mysqli_query($conn, $sqlprofile);
  $totalprofile=mysqli_num_rows($resultprofile);
  $rowprofile = mysqli_fetch_assoc($resultprofile);
  if ($totalprofile>0) {
    $rewardupdate=$rowprofile['Reward'];
    $rewardupdate+=5;
  $sqlreward="UPDATE profile SET Reward='$rewardupdate' WHERE User_id='$userid'";
                  if (mysqli_query($conn, $sqlreward)) {

                  }
                    else {

                    }
    }
    /*
  $sql3 = "SELECT Cust_id FROM customer WHERE Status='Sender' ORDER BY Cust_id DESC LIMIT 1";
  $result1 = mysqli_query($conn, $sql3);
  if (mysqli_num_rows($result1) > 0) {
    $row = mysqli_fetch_assoc($result1);
    $Senderid=$row['Cust_id'];
}*/
}
$sqlcust = "SELECT * FROM customer where User_id='$userid' Order By Cust_id desc limit 1";
          $resultcust = mysqli_query($conn, $sqlcust);
          if (mysqli_num_rows($resultcust) > 0){
            $rowcust = mysqli_fetch_assoc($resultcust);
            $Customerid=$rowcust['Cust_id'];
          }

$sql4= "INSERT INTO receiver (Rec_name, Rec_address, Rec_city, Rec_province, Rec_state, Rec_contact,Cust_id)
VALUES ('$recname', '$recaddress', '$reccity','$recprovince','$recstate','$recphoneno','$Customerid')";
if(mysqli_query($conn,$sql4)){
  $sql5 = "SELECT * FROM receiver WHERE Cust_id='$Customerid'";
  $result2 = mysqli_query($conn, $sql5);
  if (mysqli_num_rows($result2) > 0) {
    $row = mysqli_fetch_assoc($result2);
    $Recieverid=$row['Rec_id'];
}}
$sql6= "INSERT INTO parcel(Parcel_type,Parcel_weight,Parcel_pickupdate,Parcel_status,Cust_id,Rec_id)
VALUES ('$parceltype', '$parcelweight', '$parceldate','Pending','$Customerid','$Recieverid')";
if (mysqli_query($conn,$sql6)) {
    header("Location:mydashboard.php");
    exit;
}
else {
    $error='<div class="alert alert-danger" role="alert">
    Error: ' . $sql . '<br>' . mysqli_error($conn).'</div>';}
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

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/request.css?version=29">
    <link rel="stylesheet" type="text/css" href="../css/mydashboard.css?version=63">
    <title>Request!</title>
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
     <h1>Request Form!</h1>
        <form autocomplete="on" method="POST">
        <div class="row">
        <div class="col-lg customer">
                        <h4 class="heading">Customer Form</h4>
                        <div id="error"><?php echo $error;?></div>
                        <div class="form-group">
                                <label for="exampleInputName1">Customer Name:</label>
                                <input type="text" name="custname" class="form-control  border-0 " id="exampleInputName1" placeholder="Enter Name" required>
                                <hr>
                        </div>
                        <div class="form-group">
                                <label for="exampleInputadd1">Customer address:</label>
                                <input type="text" name="custaddress" class="form-control border-0" id="exampleInputadd1" placeholder="Enter Postal address" required>
                                <hr>
                        </div>
                        <div class="form-group">
                                <label for="exampleInputcity1">Customer City:</label>
                                <input type="text" name="custcity"  class="form-control border-0" id="exampleInputcity1" placeholder="Enter City" required>
                                <hr>
                        </div>
                        <div class="form-group">
                                <label for="exampleInputprovince1">Customer Province:</label>
                                <input type="text" name="custprovince" class="form-control border-0" id="exampleInputprovince1" placeholder="Enter Province" required>
                                <hr>
                        </div>
                        <div class="form-group">
                                <label for="exampleInputstate1">Customer State:</label>
                                <input type="text" name="custstate"  class="form-control border-0" id="exampleInputstate1" placeholder="Enter State" required>
                                <hr>
                        </div>
                        <label for="exampleInputpno1">Customer Phone Number:</label>
                        <div class="input-group mb-3">
                                <div class="input-group-prepend ">
                                        <span class="input-group-text border-0">92</span>
                                </div>
                                <input type="text" name="custphoneno" class="form-control border-0" id="exampleInputpno1" placeholder="Enter Phone Number" required pattern="[1-9]{1}[0-9]{9}" maxlength="10" title="Kindly follow this Format:92xxxxxxxxxx">
                                <hr>
                        </div>

        </div>
        <div class="col-lg reciever">
                        <h4 class="heading">Reciever Form</h4>
                        <div id="error1"><?php echo $error1;?></div>
                        <div class="form-group">
                                <label for="exampleInputName1">Reciever Name:</label>
                                <input type="text" name="recname" class="form-control  border-0 " id="exampleInputName1" placeholder="Enter Name" required>
                                <hr>
                         </div>
                        <div class="form-group">
                                <label for="exampleInputadd1">Reciever address:</label>
                                <input type="text" name="recaddress" class="form-control border-0" id="exampleInputadd1" placeholder="Enter Postal address" required>
                                <hr>
                        </div>
                        <div class="form-group">
                                <label for="exampleInputcity1">Reciever City:</label>
                                <input type="text" name="reccity" class="form-control border-0" id="exampleInputcity1" placeholder="Enter City" required>
                                <hr>
                        </div>
                        <div class="form-group">
                                <label for="exampleInputprovince1">Reciever Province:</label>
                                <input type="text" name="recprovince" class="form-control border-0" id="exampleInputprovince1" placeholder="Enter Province" required>
                                <hr>
                        </div>
                        <div class="form-group">
                                <label for="exampleInputstate1">Reciever State:</label>
                                <input type="text" name="recstate" class="form-control border-0" id="exampleInputstate1" placeholder="Enter State" required>
                                <hr>
                        </div>
                                <label for="exampleInputpno1">Reciever Phone Number:</label>
                        <div class="input-group mb-3">
                                <div class="input-group-prepend ">
                                        <span class="input-group-text border-0">92</span>
                                </div>
                                 <input type="text" name="recphoneno"class="form-control border-0" id="exampleInputpno1" placeholder="Enter Phone Number" pattern="[1-9]{1}[0-9]{9}" required title="Kindly follow this Format:92xxxxxxxxxx">
                                <hr>
                        </div>


            </div>
        </div>
        <div class="row">
        <div class="col-lg parcel">
                        <h4 class="heading">Parcel Form</h4>
                        <div id="error2"><?php echo $error2;?></div>
                        <div class="form-group">
                                <label for="exampleInputtype1">Parcel Type:</label>
                                <input type="text" name="parceltype"class="form-control  border-0 " id="exampleInputtype1" placeholder="Enter Type" required>
                                <hr>
                        </div>
                        <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1" onclick="check()">
                                <label class="form-check-label" for="exampleCheck1">Optional:</label>
                        </div>

                        <div class="form-group" id="weight">
                                <label for="exampleInputweight1">Parcel Weight:</label>
                                <input type="text" name="parcelweight" class="form-control border-0" id="exampleInputweight1" placeholder="Enter Weight">
                                <small class="text-muted">Weight should be declared in kg</small>
                                <hr>
                        </div>
                        <div class="form-group">
                                <label for="exampleInputdate1">Parcel Pick up Date:</label>
                                <input type="date" name="parceldate"class="form-control border-0" id="exampleInputate1" required>
                                <hr>
                        </div>

        </div>
        </div>
                        <button type="submit" name="submit" class="btn btn-outline-dark ">Submit</button>
                        <p></p>
                </form>

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
          function check(){
            var y=document.getElementById("exampleCheck1");
          if(y.checked==true){
            document.getElementById("weight").style.display="block";
          }
          else{
            document.getElementById("weight").style.display="none";
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
