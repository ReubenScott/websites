<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
    <title>�ޱ����ĵ�</title>
    <script type="text/javascript">
      function showText(id){
        if (document.getElementById(id).style.display == "none"){
          document.getElementById(id).style.display="";
          document.getElementById("showButton").value="����";
	  
        }
        else{
          document.getElementById(id).style.display="none";
          document.getElementById("showButton").value="��ʾ";
        }
      }
    </script>
    <style type="text/css">
      #showContent {width:300px; height:auto; border:#ccc 1px solid; padding:10px;}
    </style>
  </head>

  <body>
    <div id="showContent">
      <input id="showButton" value="��ʾ" type="button" onclick="showText('showContentText');" />
      <div id="showContentText" style="display:none;">��Ϣ����</div>

    </div>


    <video controls="" autoplay="" name="media">
      <source src="http://mirror.wicp.net/webfm_send/~WebFM~%E9%80%83%E8%B7%91%E8%AE%A1%E5%88%92%20-%E5%A4%9C%E7%A9%BA%E4%B8%AD%E6%9C%80%E4%BA%AE%E7%9A%84%E6%98%9F.mp3" type="audio/mpeg">
    </video>

  </body>
</html>
