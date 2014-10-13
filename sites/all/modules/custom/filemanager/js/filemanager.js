

function loadingImage(loadingimgId){
  $("#"+loadingimgId).ajaxStart(function(){
    $(this).show();
  }).ajaxComplete(
    function(){
      $(this).hide();
  });
}

function ajaxFileUpload(fileId){
  $('#uploadmsg').html("");
  $.ajaxFileUpload({
    url: Drupal.settings.basePath + "filemanager/ajaxupload",
    type: 'post',
    secureuri:false,
    fileElementId:fileId,
    dataType: 'text',
    success: function (data) {
      $('#uploadmsg').html(data);
    },
    error: function(data,status,e){
      
    }
  })
  return false;
}
