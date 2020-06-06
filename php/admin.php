


<!doctype html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Admin!</title>
    </head>
    <body>
    <h3>Sender Details</h3>
    <table class="table table-bordered table-lg">
    <thead class="table-dark">
    <tr>
        <th scope="col">Sender(ID)</th>  
        <th scope="col">Sender(Name)</th>
        <th scope="col">Sender(Address)</th>
        <th scope="col">Sender(City)</th>
        <th scope="col">Sender(Province)</th>
        <th scope="col">Sender(State)</th>
        <th scope="col">Sender(Contact)</th>
        <th scope="col">Sender(Email)</th>
        <th scope="col">Aproved</th>
        <th scope="col">Reject</th>
    </tr>
    </thead>
        <?php
        include("connection.php");
        session_start();
        if($_SESSION["admin"]=="login"){
        $sql = "SELECT * FROM login, customer WHERE login.User_id=customer.User_id AND customer.Status='Sender'" ;
        $result = mysqli_query($conn, $sql);
        if ( mysqli_num_rows($result)> 0) {
        while($row= mysqli_fetch_assoc($result)) {
               ?> 
        <tbody>
        <tr>       
        <th scope="row"><?php echo $row["Cust_id"] ?></th>
        <td><?php echo $row["Cust_name"] ?></td>
        <td><?php echo $row["Cust_address"] ?></td>
        <td><?php echo $row["Cust_city"] ?></td>
        <td><?php echo $row["Cust_province"] ?></td>
        <td><?php echo $row["Cust_state"] ?></td>
        <td><?php echo "0".$row["Cust_contact"] ?></td>
        <td><?php echo $row["Email"] ?></td>
        <form method="POST">
        <td><button class="btn btn-outline-info ml-auto mr-3 order-lg-last button" type="submit" name="Yes" value="<?php echo $row["Cust_id"];?>">Yes</button></td>
        <td><button class="btn btn-outline-info ml-auto mr-3 order-lg-last button" type="submit" name="No" value="<?php echo $row["Cust_id"];?>">NO</button></td>
        </form>
        </tr>
        </tbody>
        
<?php
    }
        } 
        if($_POST){
        if(isset($_POST["Yes"])){
        $custid=implode($_POST);
        $sql = "SELECT * FROM login l INNER JOIN customer c ON l.User_id=c.User_id INNER JOIN parcel p ON p.Sender_id=c.Cust_id Where c.Cust_id='$custid'" ;
        $result = mysqli_query($conn, $sql);
        if ( mysqli_num_rows($result)> 0) {
        $row= mysqli_fetch_assoc($result);
        $parcelno=$row["Parcel_no"];
        $to=$row["Email"];
        $subject="Confirmation of Request";
        $message="Hello!\r\nDear ".$row['Cust_name'].", Your request for the ".$row['Parcel_type']." has been approved!. Your ".$row['Parcel_type']." will be delivered at ".$row['Cust_address']."On ".$row['Parcel_pickupdate']."\r\nThanks for using our Service.\r\nTeam Pickit.";
        $headers="From: Pick It Courier Service";
        if(mail($to,$subject,$message,$headers)){
            $sql = "UPDATE parcel SET Parcel_status='Aproved' WHERE Parcel_no='$parcelno'";
            if (mysqli_query($conn, $sql)) {
                echo 'parcel updated successfully';
            }
        else {
            echo "error:".mysqli_error($conn);
                }
            echo "mail is successfully sent";
        }
        else{
            echo "mail can not  sent";
        }
        }
        else{
            echo "error";
        }
    }
    if(isset($_POST["No"])){
        $custid=implode($_POST);
        $sql1 = "SELECT * FROM login l INNER JOIN customer c ON l.User_id=c.User_id INNER JOIN parcel p ON p.Sender_id=c.Cust_id Where c.Cust_id='$custid'" ;
        $result1 = mysqli_query($conn, $sql1);
        if ( mysqli_num_rows($result1)> 0) {
        $row= mysqli_fetch_assoc($result1);
        $parcelno=$row["Parcel_no"];
        $to=$row["Email"];
        $subject="Rejection of Request";
        $message="Hello!\r\nDear ".$row['Cust_name'].", Your request for the ".$row['Parcel_type']." has been rejected! Due To System Error.Kindly try again letter.\r\nThanks for using our Service.\r\nTeam Pickit.";
        $headers="From: Pick It Courier Service";
        if(mail($to,$subject,$message,$headers)){
            $sql2= "UPDATE parcel SET Parcel_status='Rejected' WHERE Parcel_no='$parcelno'";
            if (mysqli_query($conn, $sql2)) {
                
            }
        else {
            echo "error:".mysqli_error($conn);
                }
            echo "mail is successfully sent";
        }
        else{
            echo "mail can not  sent";
        }
        }
        else{
            echo "error";
        }
    }

    
}
        }
    else{
        header("Location:adminlogin.php");
        exit;
    }
    
    
        mysqli_close($conn);
        ?>
        </table>
    
    
    <h3>Reciever Details</h3>
    <table class="table table-lg table-bordered" >  
    <thead class="table-dark">
    <tr>
        <th scope="col">Reciever(ID)</th>  
        <th scope="col">Reciever(Name)</th>
        <th scope="col">Reciever(Address)</th>
        <th scope="col">Reciever(City)</th>
        <th scope="col">Reciever(Province)</th>
        <th scope="col">Reciever(State)</th>
        <th scope="col">Reciever(Contact)</th>
    </tr>
    </thead>
    <?php
        include("connection.php");
        if($_SESSION["admin"]=="login"){
        $sql = "SELECT * FROM customer WHERE customer.Status='Reciever'" ;
        $result = mysqli_query($conn, $sql);
        if ( mysqli_num_rows($result)> 0) {
        while($row= mysqli_fetch_assoc($result)) {
               ?> 
        <tbody>
        <tr>       
        <th scope="row"><?php echo $row["Cust_id"] ?></th>
        <td><?php echo $row["Cust_name"] ?></td>
        <td><?php echo $row["Cust_address"] ?></td>
        <td><?php echo $row["Cust_city"] ?></td>
        <td><?php echo $row["Cust_province"] ?></td>
        <td><?php echo $row["Cust_state"] ?></td>
        <td><?php echo "0".$row["Cust_contact"] ?></td>
        </tr>
        </tbody>
        
    <?php
    }
        }
    }
    else{
        header("Location:adminlogin.php");
        exit; }
        mysqli_close($conn);
        ?>
    </table>
    <h3>Parcel Details</h3>
    <table class="table table-lg table-bordered">
    <thead class="table-dark">
    <tr>  
        <th scope="col">Parcel(No)</th>
        <th scope="col">Parcel(Type)</th>
        <th scope="col">Parcel(Weight)</th>
        <th scope="col">Parcel(Date)</th>
        <th scope="col">Parcel(Status)</th>
        <th scope="col">Sender(ID)</th>
        <th scope="col">Reciever(ID)</th>
    </tr>
    </thead>
    <?php

        include("connection.php");
        if($_SESSION["admin"]=="login"){
        $sql = "SELECT * FROM parcel " ;
        $result = mysqli_query($conn, $sql);
        if ( mysqli_num_rows($result)> 0) {
        while($row= mysqli_fetch_assoc($result)) {
               ?> 
        <tbody>
        <tr>       
        <th scope="row"><?php echo $row["Parcel_no"] ?></th>
        <td><?php echo $row["Parcel_type"] ?></td>
        <td><?php echo $row["Parcel_weight"] ?></td>
        <td><?php echo $row["Parcel_pickupdate"] ?></td>
        <td><?php echo $row["Parcel_status"] ?></td>
        <td><?php echo $row["Sender_id"] ?></td>
        <td><?php echo $row["Reciever_id"] ?></td>
        </tr>
        </tbody>
        
    <?php
    }
        }
    }
    else{
        header("Location:adminlogin.php");
        exit;} 
        mysqli_close($conn);
        ?>
        </table>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>





