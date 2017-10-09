$( document ).ready(function() {
$('#button2').click(function(){
	var search = $('#description').val();
	       $.ajax( {
	url: 'search_description.php',
	data: 'description='+search,
	success: function(data){

	$('#content').html(data);
	}
});
           
});
});