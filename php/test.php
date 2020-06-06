<?php
//testing for to show you how to select owner
//include connection
include("connection.php");
//ab phlea ap ko main aik parcel pick kr ky phr uski sender aur recciever details nikal kr dkhata hu
$sql = "SELECT * FROM parcel";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
     echo "owner-id:".$row["Sender_id"];  }
} else {
    echo "0 results";
}

?>


