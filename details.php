<!doctype html>
<html>
<head>
<meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/style2.css">
</head>
<body> 
  <div class="container">
<?php
include("connect.php");
$id=$_GET['id'];
 
$sql = "SELECT id_event, description, event_lat, event_long FROM events WHERE id_event ='$id' ";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
         echo"<p>";
         echo"<table>";

 echo "<tr>";
    echo "<td>Περιγραφή:</td>";
    echo "<td>".$row['description']."</td>";
echo "</tr>";

echo "<tr>";
    echo "<td>Χάρτης:</td>";
    echo "<td>";
    if ($row['event_lat']&&$row['event_long']){
    echo "<iframe src='http://maps.google.com/?q={$row['event_lat']},{$row['event_long']}&output=embed' class='map'> </iframe>";
  }
  else{
    echo"Δεν είναι διαθεσιμος";
  }
    echo "</td>";
echo "</tr>";
echo"</p>"; 
    }
echo"</table>";
    }
else {
    echo "Δεν βρεθηκαν αποτελεσματα";
}


?>
</div>
</body>
</html>
