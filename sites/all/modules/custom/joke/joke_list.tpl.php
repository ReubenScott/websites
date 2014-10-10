<?php
global $base_url;
?>

<html>
<head>

<style>
</style>
<script type="text/javascript"
	src="<?php print $base_url?>/misc/jquery.js"></script>
</head>
<body>
	<div id="container" class="clear-block">
		<div class="head_and_menu" style='text-align: center;'>
			<div id="logo-floater">

				<a href="<?php print $base_url.'/covidien/home'?>"><img
					src="<?php print $base_url?>/sites/all/themes/covidien_theme/logo.png"
					id="logo" /></a>
			</div>
			<div style='margin-top: 3px; height: 40px'>
				<h1>
					<a href="<?php print $base_url.'/mapping/list'?>">Device
						Type and Hardware Type Mapping</a>
				</h1>
			</div>
		</div>
	</div>
	<input type="hidden" id="mappingUrl" value='<?php echo $base_url.'/mapping/getMapping'?>'/>
	<input type="hidden" id="deviceTypeSelect" value='<?php print $deviceType ?>'/>
	<form action="<?php echo $base_url.'/mapping/save'?>" method="post">
		<div style='margin-top: 10px; height: 20px'>
			Device Type  <select id="deviceId" name="deviceType" style="overflow: auto;">
</select>

                        
<input id="btn_save" class="form-submit" type="button" value="Save" onclick="save()" />
<?php 
 if(isset($save_result)){
?>
<b id="msg" style="font-size: large;color: red">&nbsp;&nbsp;&nbsp;
<?php print $save_result;?>
</b>
<?php }?>
</div>
	<div>
	<div id="loadMapping1" style="margin:auto; opacity:0;filter:alpha(opacity=0);position: absolute;z-index: 9998;display: block;height: 100%;width: 100%;line-height: 200px;background-color: gray;text-align: center;vertical-align: middle;">
	</div>
	<div id="loadMapping2" style="border: 1px solid black;margin:auto; opacity:1;filter:alpha(opacity=100);position: absolute;z-index: 9998;display: block;height: 80px;width: 150px;line-height: 80px;background-color: gray;text-align: center;vertical-align: middle;">
		<div style="font: bold;font-size: xx-large;">Loading...</div>
	</div>
	
	<div style='margin-top: 10px;'>
		Hardware Type   
		<table>
			<tr>
				<th></th>
				<th>Type Name</th>
			</tr>
		</table>
	</div>
	</div>
	<div id="footer"></div>
	</form>
</body>
<script>
$(document).ready(function(){
	$("#deviceId").val($("#deviceTypeSelect").val());
	getMapping();
});
function getMapping(){
	$("#loadMapping1").css("display","block");
	$("#loadMapping2").css("display","block");
	$("[type='checkbox']").each(function(){
		$(this).attr("checked",false);
	});
	$.get($("#mappingUrl").val(),{id:$("#deviceId").val()},function(data){
		var tmp=$(data);
		tmp.find("#hardwareTar").children().each(function(){
			$("[value='"+$(this).val()+"']").attr("checked",true);
			});
		$("#loadMapping1").css("display","none");
		$("#loadMapping2").css("display","none");
		});	
}
function save(){
	if(checkBoxValid()){
		$("form").submit();
	}else{
		alert("No Hardware Type checked!");
	}
}

function checkBoxValid(){
	var flag=false;
	$("[type='checkbox']").each(function(){
		if($(this).attr("checked")){
			flag=true;
			return false;
		}
	});
	return flag;
}

$("[type='checkbox']").change(function(){
	$("#msg").empty();
});
$("#deviceId").change(function(){
	$("#msg").empty();
	getMapping();
});

</script>