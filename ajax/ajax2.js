$( document ).ready(function() {
$('#button2').click(function(){
	$('#content').html('<img src="images/2.GIF"> Deleting....' );
	var linkd = $('#linkd').val();
		    $.ajax( {
	url: 'delete.php',
	data: 'linkd='+linkd,
	success: function(data){

	$('#content').html(data);
	}
});
           
});
});