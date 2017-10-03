<?php

include("connect.php");

$access_token = "652570001554651|04b7fff996bcb10a9f5e24327d31a95c";
$linkd = $_GET['linkd'];
$last = strrchr($linkd, '/');
$id = substr($last,1);
if($linkd=="")
{echo"Δεν έδωσες καποιο link για διαγραφή!";}
else{
$link = "https://graph.facebook.com/{$id}?access_token={$access_token}";
$json = @file_get_contents($link);

$obj = json_decode($json, true);
if($obj == NULL){
  echo "To link που έδωσες για διαγραφη δεν είναι έγκυρο!";
}

else{
$id= isset($obj['id']) ? $obj['id'] : "";	
$sql = "DELETE FROM page WHERE id='$id'";
$sql2 = "DELETE FROM events WHERE id='$id'";
mysqli_query($conn, $sql);
mysqli_query($conn, $sql2);
echo"Events and page deleted!";

}		
}
?>