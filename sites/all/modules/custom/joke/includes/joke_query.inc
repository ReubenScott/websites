<?php

/**
 * @file
 * Firmware catlog module function SQL placed here.
 */

/**
 * Helper function to query the values for the module functions.
 */
function joke_integrity_query($i = 0) {
  $qry = db_rewrite_sql("select file_integrity_check_value from {firmware} where id=%d");
  return $qry;
}

/**
 * Helper function to query the values for the module functions.
 */
function joke_cron_query($i = 0) {

    echo $i ;
    
  switch ($i) {
    case 0:
      $qry = "UPDATE firmware set file_integrity_check_value='%s' where `nid`=%d";
      break;
    case 1:
      $qry = 'UPDATE files set filepath="%s",filesize="%s" WHERE fid="%d"';
      break;
    case 2:
      $qry = 'select a.nid as firmware_id, b.fid, b.filepath from firmware a, files b where a.file_id = b.fid and a.file_integrity_check_value is null';
      break;
    default:
      $qry = '';
  }
  return $qry;
}
