
<script>
// Call datatables, and return the API to the variable for use in our code
// Binds datatables to all elements with a class of datatable
var dtable = $("#dataTableBuilder").dataTable().api();

var searchWait = 0;
var searchWaitInterval;
// Grab the datatables input box and alter how it is bound to events
$(".dataTables_filter input")
	.unbind() // Unbind previous default bindings
	.bind("input", function(e) { // Bind our desired behavior
		var item = $(this);
		searchWait = 0;
		clearInterval(searchWaitInterval);
		searchWaitInterval = '';

		if(!searchWaitInterval) searchWaitInterval = setInterval(function(){
			searchTerm = $(item).val();
			// if(searchTerm.length >= 3 || e.keyCode == 13) {
				clearInterval(searchWaitInterval);
				searchWaitInterval = '';
				// Call the API search function
				dtable.search(searchTerm).draw();
				searchWait = 0;
			// }
			searchWait++;
		}, 900);
		return;
	});
</script>

