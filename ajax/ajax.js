$( document ).ready(function() {
$('#button').click(function(){
	$('#content').html('<img src="images/2.GIF"> Inserting....' );
	var link = $('#link').val();
	       $.ajax( {
	url: 'insert.php',
	data: 'link='+link,
	success: function(data){

	$('#content').html(data);
	}
});
           
});
});

	

