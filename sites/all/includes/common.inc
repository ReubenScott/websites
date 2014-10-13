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



