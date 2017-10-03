<?php
include("connect.php");
   $description=$_GET['description'];
   if($description==""){
   	echo "Δεν έδωσες καποιο search query";
    }
   else{

	 $sql="SELECT  id_event, id, category , datetime, name, description, pic, owner FROM events WHERE description LIKE '%$description%' ORDER BY datetime ASC" ;
	
	  $result=mysqli_query($conn,$sql); 
	 
	  if (mysqli_num_rows($result) > 0) {
 
    while($row = mysqli_fetch_assoc($result)) {
      $date = date('d-m-Y ', strtotime($row['datetime']));
      $time = date('g:i a',strtotime($row['datetime']));
	                echo"<p>"; 
      echo"<table>";

   echo "<tr>";
 echo "<td rowspan='5' class ='a'>";
        echo "<img src='".$row['pic']."' class='pic' />";
    echo "</td>";
echo "</tr>";
  
echo "<tr>";
    echo "<td>Όνομα:</td>";
    echo "<td>".$row['name']." </td>";
echo "</tr>";
  
echo "<tr>";
    echo "<td>Ημ/νια και Ώρα:</td>";
    echo "<td>$date στις $time</td>";
echo "</tr>";
  
echo "<tr>";
    echo "<td>Δημιουργός:</td>";
    echo "<td>".$row['owner']."</td>";
echo "</tr>";
echo "<tr>";
    echo "<td>Κατηγορία:</td>";
    echo "<td>".$row['category']."</td>";
echo "</tr>";
  
echo "<tr>";
echo "<td>";
  echo" <a href='details.php?id=".$row['id_event']."'>Λεπτομέρειες</a>";
  echo"</td>";
echo "</tr>";
echo"</p>";

    }
echo"</table>";
    }
else {
    echo "Βρέθηκαν 0 αποτελεσματα";
  }
}
?>