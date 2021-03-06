var filter_specialChars = "^[a-zA-Z0-9-_@\. ]+$";
var filter_specialChars_date = "^[0-9\/ ]+$";
$(document).ready(function(){

// For Menu Highlight - Covidien Brackets
  var identifier = window.location.pathname;
  var split = identifier.split("/");
  var vTitle = $(this).attr('title').split("|");
  
function check_url($ustring){
return $.inArray($ustring, split)> -1;
}
  
if (vTitle[0]=="User Settings ") {
//anch_user_settings
		$('#anch_user_settings').after("<span class='T10C11'>&nbsp; ]</span>");
		$('#anch_user_settings').before("<span class='T10C11'>[ &nbsp;</span>");
}  
else if  (check_url('node') && check_url('edit') && vTitle[0]!="User Settings ") {
//For edit catalogs
		$('#anch_system_admin').attr('class','active');
		$('#anch_system_admin').after("<span class='T10C2'>&nbsp; ]</span>");
		$('#anch_system_admin').before("<span class='T10C2'>[ &nbsp;</span>");
}  
else if (check_url('covidien') && check_url('home')) {
//anch_home
		$('#content-part').attr('style','border:0');
		$('#anch_home').attr('class','active');
		$('#anch_home').after("<span class='T10C2'>&nbsp; ]</span>");
		$('#anch_home').before("<span class='T10C2'>[ &nbsp;</span>");
}
else if (check_url('covidien') && check_url('device') || check_url('devices')) {
//anch_devices
		if(check_url('device')) { $('#content-part').attr('style','border:0'); }
		$('#anch_devices').attr('class','active');
		$('#anch_devices').after("<span class='T10C2'>&nbsp; ]</span>");
		$('#anch_devices').before("<span class='T10C2'>[ &nbsp;</span>");
} 
else if (check_url('reports') || check_url('report') ) {
//anch_devices
		$('#anch_reports').attr('class','active');
		$('#anch_reports').after("<span class='T10C2'>&nbsp; ]</span>");
		$('#anch_reports').before("<span class='T10C2'>[ &nbsp;</span>");
} 
else if (check_url('covidien') || check_url('activity') || check_url('add') || check_url('add_new') || (check_url('node') && check_url('add'))){
//anch_system_admin
		$('.manage_role').attr('style','border:0');
		$('#anch_system_admin').attr('class','active');
		$('#anch_system_admin').after("<span class='T10C2'>&nbsp; ]</span>");
		$('#anch_system_admin').before("<span class='T10C2'>[ &nbsp;</span>");
} 

// Block enter Key for default submit
$("form input[type='text'],form select,form input[type='button']").bind("keypress", function(e) {
            if (e.keyCode == 13) return false;
      });

			
// Block Special characters in titles	  
$('.oval_search_wraper input').bind('keypress', function (event) {
    var regex = new RegExp(filter_specialChars);
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
       event.preventDefault();
       return false;
    }
});	  

// Login Screen Changes
// For Password Text - !IE 
$('#fpage #edit-pass-clear').show();
$('#fpage #edit-pass').hide();

$('#fpage #edit-pass-clear').focus(function() {
    $('#fpage #edit-pass-clear').hide();
    $('#fpage #edit-pass').show();
    $('#fpage #edit-pass').focus();
});
$('#fpage #edit-pass').blur(function() {
    if($('#fpage #edit-pass').val() == '') {
        $('#fpage #edit-pass-clear').show();
        $('#fpage #edit-pass').hide();
    }
});
$('input[type="text"]').each(function(){
if(this.value.indexOf('Username ') >= 0) {
$(this).attr("title", this.value);
     this.value = $(this).attr('title');
    $(this).addClass('text-label');
    $(this).focus(function(){
        if(this.value == $(this).attr('title')) {
            this.value = '';
            $(this).removeClass('text-label');
        }
    });
    $(this).blur(function(){
        if(this.value == '') {
            this.value = $(this).attr('title');
            $(this).addClass('text-label');
        }
    });
  }	
});

// For Role Popup
$('input[type="text"]').each(function(){
if(this.value.indexOf('Enter role') >= 0) {
$(this).attr("title", this.value);
     this.value = $(this).attr('title');
    $(this).addClass('text-label');
    $(this).focus(function(){
        if(this.value == $(this).attr('title')) {
            this.value = '';
            $(this).removeClass('text-label');
        }
    });
    $(this).blur(function(){
        if(this.value == '') {
            this.value = $(this).attr('title');
            $(this).addClass('text-label');
        }
    });
  }	
});	
  $("select option").each(function(i){
    this.title = this.text;
  });
});

