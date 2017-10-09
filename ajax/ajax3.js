$( document ).ready(function() {
$('#button3').click(function(){
	$('#content').html('<img src="images/2.GIF"> Updating....' );
            $.ajax( {
    url: 'update.php',
    data: {},
    success: function(data){

    $('#content').html(data);
     }
});
           
});
});