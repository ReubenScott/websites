

function ajaxFileUpload(fileId){
  $.ajaxFileUpload({
    url: Drupal.settings.basePath + "fileupload/ajaxFileUpload",
    type: 'post',
    secureuri:false,
    fileElementId:fileId,
    dataType: 'json',
    success: function (data) {
      alert(data.msg);
    },
    error: function(data,status,e){
      
    }
  })
  return false;
}


function loadingimage(loadingimgId){
  $("#"+loadingimgId).ajaxStart(function(){
    $(this).show();
  }).ajaxComplete(
    function(){
      $(this).hide();
  });
}