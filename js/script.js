$(document).ready(function () {
	$('form').submit(function (event) {
		event.preventDefault();
		var data = $(this).serialize();
		$.ajax({
		  type: "POST",
		  url: 'index.php',
		  data: data,
		  beforeSend: function() {
		    $('#result').html("<img class='gif-default' src='img/default.gif' />");
		  },
		  complete: function() {
		    $('#result img.gif-default').remove();
		  },
		  success: function (result) {
		  	if (result.length > 0) {
		  		result = JSON.parse(result);
		  		if (Object.keys(result).length > 0) {
		  			if (typeof result.error != "undefined") {
		  				alert(result.message);
		  			};
		  			$("#result").html('');
			  		for (var i = 0; i < result.length; i++) {
			  			var encode = $('<div />').text(result[i]).html();
			  			var encodedStr = $("<div />").html(encode).text();
			  			var appendText = '';
			  			if ($('input[name="display-html"]:checked', 'form').val() != 1) {
				  			appendText = encodedStr;
				  		}
				  		else{
				  			appendText = encode;
				  		}
			  			$("#result").append('<code>' + appendText + '</code>');
			  		};
		  		}
		  		else{
			  		alert('The tag element: ' + $("#inputTagElement").val() + ' is not found');
			  	}
		  	}
		  	else{
		  		alert('The tag element: ' + $("#inputTagElement").val() + ' is not found');
		  	}
		  }
		});
	});
})