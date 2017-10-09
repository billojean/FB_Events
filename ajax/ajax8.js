$( document ).ready(function() {
$('#button1').click(function(){
	var search = $('#name').val();
	       $.ajax( {
	url: 'search_name.php',
	data: 'name='+search,
	success: function(data){

	$('#content').html(data);
	}
});
           
});
});