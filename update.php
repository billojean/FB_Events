<?php
include("connect.php");

$sql = "SELECT id FROM page";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
   
    while($row = mysqli_fetch_assoc($result)) {
        

$access_token = "652570001554651|04b7fff996bcb10a9f5e24327d31a95c";

date_default_timezone_set("Europe/Athens");

$until_date = date('2015-12-31');

$since_unix_timestamp = strtotime("now");
$until_unix_timestamp = strtotime($until_date);
$fields="id,name,description,place,timezone,start_time,cover,owner"; 

$json_link = "https://graph.facebook.com/v2.3/".$row["id"]."/events?fields={$fields}&access_token={$access_token}&since={$since_unix_timestamp}&until={$until_unix_timestamp}";
$json = file_get_contents($json_link);
$obj = json_decode($json, true);
   
    foreach($obj['data'] as $key){
       
    $datetime = date('Y-m-d H:i:sa', strtotime($key['start_time']) );
    $pic = isset($key['cover']['source']) ? $key['cover']['source'] : "";
    $id = isset($key['id']) ? $key['id'] : "";
    $name = isset($key['name']) ? $key['name'] : "";
    $description = isset($key['description']) ? $key['description'] : "";
    $owner_name = isset($key['owner']['name']) ? $key['owner']['name'] : "";
    $category = isset($key['owner']['category']) ? $key['owner']['category'] : "";
    $lat = isset($key['place']['location']['latitude']) ? $key['place']['location']['latitude'] : "";
    $long = isset($key['place']['location']['longitude']) ? $key['place']['location']['longitude'] : ""; 
    $description = mysqli_real_escape_string($conn, $description);

mysqli_query($conn, "INSERT INTO `test`.`events` (id_event, id, category , datetime, name, description, pic, owner, event_lat, event_long)
       VALUES ('".$id."','".$row['id']."','".$category."','".$datetime."','".$name."','".$description."','".$pic."','".$owner_name."','".$lat."','".$long."') ON DUPLICATE KEY UPDATE
       id_event='".$id."',id='".$row['id']."',category='".$category."',datetime='".$datetime."',name='".$name."',description='".$description."',pic='".$pic."',owner='".$owner_name."',event_lat='".$lat."',event_long='".$long."'");//update events!
        }  
    }
} 
mysqli_query($conn,"DELETE FROM events WHERE datetime < NOW()");//delete past events!

echo "Updated!";
?>
