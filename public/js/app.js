var tab = 1;
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function(){
	$("#phone").mask("+99999999999");

	$('.next-tab').on('click', function(e){
		e.preventDefault();
		$('[data-tab]').hide();
		tab += 1;
		$('[data-tab="' + tab  + '"]').show();
	})	

	$('.prew-tab').on('click', function(e){
		e.preventDefault();
		$('[data-tab]').hide();
		tab -= 1;
		$('[data-tab="' + tab  + '"]').show();
	})

	$('.submit').on('click', function(){
		$('.form-horizontal').submit();
	})


	$('#addform .form-control, #addform [type="radio"]').on('change', function(e){
		var that = $(this);
		var val = that.val();
		var id = that.attr('id');
		$('[data-tab="2"]').find('[for="'+ id +'"].value').text(val);

		if (that.hasClass('select')) {
			var option = $('[id="'+ id +'"]').find('[value="' + val + '"]').text();

			$('[data-tab="2"]').find('[for="'+ id +'"].value').text(option);

		}
		if (that.hasClass('author')) {
			console.log('radio');
			$('[data-tab="2"]').find('[for="author"].value').text($('input[name="author"]:checked').parents('label').text());
		}

		if (that.hasClass('files')) {
			$('[data-tab="2"]').find('[for="files"].value').text(that[0].files.length);

		}
	});

	$('.show-comments').on('click', function(){
		var comment_list = $(this).parents('.review-item').find('.comments-list');
		if (comment_list.is(':visible')) {
			comment_list.hide();
		} else {
			comment_list.show();
		}
	})

	$('.add-comment').on('click', function(){
		var comment_form = $(this).parents('.review-item').find('.new-comment');
		if (comment_form.is(':visible')) {
			comment_form.hide();
		} else {
			comment_form.show();
		}
	})

	$('.mark i, .mark span').on('click', function(){
		var that = $(this);
		$('.mark i, .mark span').hide();
		$('.mark-form').css('display', 'flex');
	});

	$('.mark-form input').on('change', function(){
		var val = $(this).val();
		$('.mark i').text(val);
	})
	$('.mark-form').on('submit', function(e){
		e.preventDefault();

		$(this).hide();
		$('.mark i, .mark span').show();

		// AJAX

	})


	$('#checkbyphone').on('submit', function(e){
		e.preventDefault();
		var phone = $(this).find('#phone').val();
		var length = phone.length;
		if (length == '12') {
			$(this).find('input').removeClass('message');
			$(this).find('.error').hide();
			
			$.ajax({
		        type: 'POST',
		        url: '/checkbyphone',
		        data: {
		            phone: phone,
		        },
		        success: function (response) {
		        	$('.review-block .res-container').html(response.html);

		        	if (response.count) {
		        		$('.review-block').show();
		        	} else {
		        		$('.review-block').show();
		        		$('.nth-found').show();
		        	}
		            console.log(response);

		        }
		    });
		} else {
			$(this).find('.error').show();
			$(this).find('input').addClass('message');

		}
	});	
	$('#checkbyemail').on('submit', function(e){
		e.preventDefault();
		var email = $(this).find('#email').val();
		var length = email.length;
		if (validateEmail(email)) {
			$(this).find('input').removeClass('message');
			$(this).find('.error').hide();

			$.ajax({
		        type: 'POST',
		        url: '/checkbyemail',
		        data: {
		            email: email,
		        },
		        success: function (response) {
		        	$('.review-block .res-container').html(response.html);

		        	if (response.count) {
		        		$('.review-block').show();
		        	} else {
		        		$('.review-block').show();
		        		$('.nth-found').show();
		        	}
		            console.log(response);

		        }
		    });
		} else {
			$(this).find('.error').show();
			$(this).find('input').addClass('message');
		}
	});



})

 function validateEmail(email) 
    {
      var re = /^(?:[a-z0-9!#$%&amp;'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&amp;'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])$/;
      return re.test(email);
    }