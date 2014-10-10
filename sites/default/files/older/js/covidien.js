var selected_value_temp = 0;
$(document).ready(function() {
	$('input[type=text]').focus(function() {
		var arr = [ "First Name", "Last Name", "Email address", "Enter user name" ];
		var val = $(this).val();
		if($.inArray(val, arr) != -1) { $(this).val(''); }
	});
	$("input[type=password]").bind("keydown", function(e) {
            if (e.keyCode == 32) return false;
      });
	$("input[type=password]").bind("paste", function() {
			idval = $(this).attr('id'); 
			setTimeout(
				function setvalue(){ 
					var regex = new RegExp("^[a-zA-Z0-9-_@\.]+$");
					var isValid = regex.test($('#'+idval).val());
					if(!isValid){ $('#'+idval).val(''); return false;} 
				}, 100); 
	});
	$('#edit-name').change(function() {
		$('#edit-mail').val($(this).val());
	});

	var radios = $('input[type="radio"]:checked').val();

	if(radios != "1") { 
		$(".register_form").css("display","none");
		$("#covidien-"+radios).css("display","");
	}

	$("input[type='radio']").click(function () {
		this.blur();  
		this.focus(); 
		if($(this).attr("name") == "field_covidien_employee[value]") {
			$(".register_form").css("display","none");
			$("#covidien-"+$(this).val()).css("display","");
		}
	});
	for(var i=0; i<15;i++) {
		if (!$(".white_background input[@name='options"+i+"']:checked").val()) {
		   $('.white_background input[@name="options'+i+'"]:first').attr('checked', true);
		}
	}

	
	$('select').ajaxStop(function(){
		$('select option:nth-child(2n+1)').addClass('color_options');
	});
});

function redirect(path,obj) {
	var id = obj.options[obj.selectedIndex].value;
	window.location = path + id;
}



function covidien_customer_acl(filter,id,url) {

  // Get the url from the child autocomplete hidden form element
  var arg = $('#'+filter).val();
  if(arg=='') {arg = 'all';}
  // Alter it according to parent value  
  var arg = '/'+arg;
  url = Drupal.settings.basePath+"covidien/admin/user/"+url+"/filter"+arg;
  // Recreate autocomplete behaviour for the child textfield
  var input = $('#'+id).attr('autocomplete', 'OFF')[0];
  covidien_username_recreateACR(input, url);
}
function covidien_username_recreateACR(input, url) {
	$(input).unbind();
	Drupal.attachBehaviors();
	var acdb = new Drupal.ACDB(url);
	$(input.form).submit(Drupal.autocompleteSubmit);
	new Drupal.jsAC(input, acdb);
}