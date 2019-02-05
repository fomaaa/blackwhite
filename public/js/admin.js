	$('#add_user').on('click', function(){
		$('[name="is_ban"]').parents('.form-group').hide();
		$('[name="created"]').parents('.form-group').hide();
		$('[name="com_count"]').parents('.form-group').hide();
		$('[name="rev_count"]').parents('.form-group').hide();
		$('[name="last_login"]').parents('.form-group').hide();
		$('[for="email_confirmed"]').parents('.form-group').hide();
	})

	$(document).on('submit', '#review_container td form', function(e) {
		e.preventDefault();
		var id = $(this).parents('tr').find('.sorting_1').html();
		var that = $(this);
		$.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		});
		$.ajax({
		        type: 'POST',
		        url: '/destroyReview',
		        data: {
		            id: id,
		        },
		        success: function (response) {
		        	if (response.status == "true") {
		        		var status = true;
		        		$(that).parents('tr').remove();
		        		console.log(response);
		        	}
		        }
		});
	});

		$(document).on('submit', '#comment_container td form', function(e) {
		e.preventDefault();
		var id = $(this).parents('tr').find('.sorting_1').html();
		var that = $(this);
		$.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		});
		$.ajax({
		        type: 'POST',
		        url: '/destroyComment',
		        data: {
		            id: id,
		        },
		        success: function (response) {
		        	if (response.status == "true") {
		        		var status = true;
		        		$(that).parents('tr').remove();
		        		console.log(response);
		        	}
		        }
		});
	});