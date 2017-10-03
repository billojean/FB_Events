<?php
include("connect.php");

$access_token = "652570001554651|04b7fff996bcb10a9f5e24327d31a95c";
date_default_timezone_set("Europe/Athens");

$link = $_GET['link'];
$last = strrchr($link, '/');
$id = substr($last,1);
if($link =="")
{echo "Δεν έδωσες κάποιο link για εισαγωγή!";
}
else{
$link = "https://graph.facebook.com/{$id}?access_token={$access_token}";
$json = @file_get_contents($link);

$obj = json_decode($json, true);
if($obj == NULL){
  echo "To link που έδωσες για εισαγωγή δεν είναι έγκυρο!";
  //var_dump($obj);
}
else
{
$name = isset($obj['name']) ? $obj['name'] : "";
$id = isset($obj['id']) ? $obj['id'] : "";
$pic =  isset($obj['cover']['source']) ? $obj['cover']['source'] : "";
$address = isset($obj['link']) ? $obj['link'] : "";
mysqli_query($conn, "INSERT INTO `test`.`page` (id , name , pic, address )
       VALUES ('".$id."','".$name."','".$pic."','".$address."')");
}
}
  
  $sql = "SELECT id FROM page WHERE id='$id'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
   
    while($row = mysqli_fetch_assoc($result)) {
        


$until_date = date('2015-12-31');

$since_unix_timestamp = strtotime("now");
$until_unix_timestamp = strtotime($until_date);
$fields="id,name,description,place,start_time,cover,owner"; 

$json_link = "https://graph.facebook.com/v2.3/".$row["id"]."/events?fields={$fields}&access_token={$access_token}&since={$since_unix_timestamp}&until={$until_unix_timestamp}";
$json = file_get_contents($json_link);
$obj = json_decode($json, true);
//var_dump($obj['data']);
if($obj['data']==NULL){
    echo"Δεν υπαρχουν τρεχοντα events απο αυτο το page";
}
   else{
 foreach($obj['data'] as $key){
        
    $datetime = date('Y-m-d H:i:sa', strtotime($key['start_time']));
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
       VALUES ('".$id."','".$row['id']."','".$category."','".$datetime."','".$name."','".$description."','".$pic."','".$owner_name."','".$lat."','".$long."')");
            
            }
            echo "Events from page inserted !";  
        }
    } 
}


?>
