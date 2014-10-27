<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/


/**
 * Returns a human readable filesize
 */
function convert_to_readable_filesize($bytesize) {
  $unit = explode(' ','B KB MB GB TB PB');
  return round($bytesize/pow(1024,($i=floor(log($bytesize,1024)))),2).' '.$unit[$i];
}


/**
 * create a guid
 */
function create_guid() {
  $charid = md5(uniqid(rand(), true));
  $hyphen = chr(45); // "-"
  $uuid = substr($charid, 0, 8) . $hyphen
    . substr($charid, 8, 4) . $hyphen
    . substr($charid, 12, 4) . $hyphen
    . substr($charid, 16, 4) . $hyphen
    . substr($charid, 20, 12);
  return $uuid;
}


/**
 *
 * 记录日志
 * @param <type> $type
 * @param <type> $content
 * @return <type>
 */
function writelog($type="",$content="") {
  $dir= getcwd().DIRECTORY_SEPARATOR.'logs'.DIRECTORY_SEPARATOR;
  if(!is_dir($dir)) {
    if(!mkdir($dir)) {
      return false;
    }
  }
  $filename= $dir.DIRECTORY_SEPARATOR.date("Ymd",time()).'.log';

  $ok = error_log(date('Y-m-d H:i:s').' '.$content.PHP_EOL,3,$filename);
}


/**
 *日志记录，按照"Ymd.log"生成当天日志文件
 * 日志路径为：入口文件所在目录/logs/$type/当天日期.log.php，例如 /logs/error/20120105.log.php
 * @param string $type 日志类型，对应logs目录下的子文件夹名
 * @param string $content 日志内容
 * @return bool true/false 写入成功则返回true
 */
function write_array_log($type="",$content="") {
  if(!$content || !$type) {
    return FALSE;
  }
  $dir= getcwd().DIRECTORY_SEPARATOR.'logs'.DIRECTORY_SEPARATOR.$type;

  if(!is_dir($dir)) {
    if(!mkdir($dir)) {
      return false;
    }
  }
  $filename= $dir.DIRECTORY_SEPARATOR.date("Ymd",time()).'.log';
  $logs=include $filename;
  if($logs && !is_array($logs)) {
    unlink($filename);
    return false;
  }

  $logs[]=array("time"=>date("Y-m-d H:i:s"),"content"=>$content);
  $str="<?php \r\n return ".var_export($logs, true).";";
  if(!$fp=@fopen($filename,"wb")) {
    return false;
  }
  if(!fwrite($fp, $str))return false;
  fclose($fp);
  return true;
}


/**
 * 访问统计
 *
 */
function countphp($type="",$content="") {
//  dblist();
  $countfile="num.txt";
  if(file_exists($countfile)) {
////打开num.txt文件
    $fp=fopen($countfile,"r+");
    while(!feof($fp)) {
      $frow =  fgets($fp) ;
      $array = explode(";", $frow);
//      if(current($arr)=='10') {
//        //  var_export(next($arr));exit;
//      }

      var_dump($array);

      if (isset($array) && is_array($array)) {
        foreach ($array as $k => $v) {
          echo $v . '<br/>';
        }
      }
    }
    exit;
////读取4位数字
    $count=fgets($fp,5);
////浏览次数加一
    $count+=1;
    rewind($fp);
////写入加一后结果
    fputs($fp,$count,5);
////关闭文件
    fclose($fp);
  } else {
    $fp=fopen($countfile,"w");
    $count="1";
    fputs($fp,$count,5);
    fclose($fp);
  };
}


/**
 * 查看文件
 */
function view_file($target_file) {
  if(file_exists($target_file)) {
    $file = fopen($target_file,"r");
    while(!feof($file)) {
      echo fgets($file). "<br />";
    }
    fclose($file);
  }
}


///////////////////////////////////////////////////////////////////////////////////////////////////////


function batchInsert($sql,$paraArray) {
  db_query("BEGIN");
  $isSuccess=true;
  foreach($paraArray as $para) {
    $dnid=$para[0];
    $dvid=$para[1];
    $hnid=$para[2];
    $hvid=$para[3];
    $isSuccess=db_query("INSERT INTO book (dnid, dvid, hnid, hvid) VALUES ('$dnid','$dvid','$hnid','$hvid')");
    if(!$isSuccess) {
      break;
    }
  }
  if($isSuccess) {
    db_query("COMMIT");
  }else {
    db_query("ROLLBACK");
  }
  return $isSuccess;
}


function datebase_file_list() {

  $html = '';
  //header
  $header = array(
    array('data' => t('File name'), 'field' => 'filename', 'sort' => 'asc'),
    array('data' => t('File path'), 'field' => 'filepath', 'sort' => 'asc'),
    array('data' => t('File size'), 'field' => 'filesize', 'sort' => 'desc'),
    array('data' => t('Upload time'), 'field' => 'timestamp', 'sort' => 'asc'),
  );

  $query = pager_query("SELECT * FROM files" . tablesort_sql($header), $limit = 30);

  $rows= array();

  while ($row = db_fetch_array($query)) {
    $rows[] = array(
      $row['filename'], $row['filepath'], $row['filesize'],$row['timestamp']
    );
  }

  $html .= theme('table', $header, $rows);
  $html .= theme('pager');
  return $html;

}



