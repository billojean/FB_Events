$( document ).ready(function() {
$.ajax( {
	url: 'events.php',
	data: {},
	success: function(data){
	$('#content').html(data);
}
});
});