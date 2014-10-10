<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/


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


?>



