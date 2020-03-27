$(function() {
	var filter = {artists:[], locations:[]};
	var sort = $("#sort").val();

	function generateEventCards() {
		var data = {};

		filter["artists"].length > 0 || filter["locations"].length > 0 ? data["filter"] = filter : null;        
		sort.length > 0 ? data["sort"] = sort : null;
		
		$.ajax({
			url:"./controller/ajax/eventcards-handler.php",
			method:"POST",
			data:data, // Put filter and sort options here.
			success: function(data) {
				$("#cards").html(data);
			},
			error: function() {
				console.log("There was an error with the 'cards' AJAX call.");
			}
		});
	}

	$(".filter input[type=checkbox]").change(function() {
		if($(this).closest("#filter-artist").length) {
			if(this.checked) {
				filter["artists"].push(this.name);
			} else {
				let index = filter["artists"].indexOf(this.name);
				if(index != -1) {
					filter["artists"].splice(index, 1);
				}
			}
		} else if($(this).closest("#filter-location").length) {
			if(this.checked) {
				filter["locations"].push(this.name);
			} else {
				let index = filter["locations"].indexOf(this.name);
				if(index != -1) {
					filter["locations"].splice(index, 1);
				}
			}
		} else if($(this).closest("#filter-food").length) {
			if(this.checked) {
				filter["food"].push(this.name);
			} else {
				let index = filter["food"].indexOf(this.name);
				if(index != -1) {
					filter["food"].splice(index, 1);
				}
			}
		}

		generateEventCards();
	});

	$("#sort").change(function() {
		sort = this.value;
		generateEventCards();
	});

	generateEventCards();
});