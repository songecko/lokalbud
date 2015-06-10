function changeToSended()
{
	$('form input, form button').hide();		
	$('.subscribeText').html('You have subscribed successfully to our newsletter');
}

$(document).ready(function()
{
	$("form").validate(
	{
		onkeyup: true,
		onclick: true,
		onfocusout: true,
		errorPlacement: function(error, element) 
		{
		},
		highlight: function(element, errorClass, validClass) 
		{
		    $(element).addClass(errorClass).removeClass(validClass);
		},
		unhighlight: function(element, errorClass, validClass) 
		{
		    $(element).removeClass(errorClass).addClass(validClass);
		},
		invalidHandler: function(event, validator)
		{
		},
		submitHandler: function(form)
		{
			$.ajax({
                type: "POST",
                url: 'processForm.php',
                data: $(form).serialize(),
                success: function(data, textStatus, jqXHR)
                {
                	changeToSended();
                }
			});
		}
	});
});