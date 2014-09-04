
<?php
/*
* Author: Rohit Patel
* Date: 12-08-2014
* App Name: Ajax file uploader
* Description: PHP + Ajax file uploader with progress bar
*/

if(($_POST['del'] == 1) && (isset($_POST['del']))) {
  if (file_exists($_POST['filePath'])) {
   unlink($_POST['filePath']);
   $data = json_encode(array('type'=>'success', 'msg'=>'File deleted successfully.')); 
  } else {
   $data = json_encode(array('type'=>'error', 'msg'=>'Can not delete, File not exist.'));
  }
  echo $data;
  exit;
} else {
    $allowFile = array('image/png','image/jpeg','image/gif','image/jpg');
    if(in_array($_FILES["file"]["type"],$allowFile)) {
      if ($_FILES["file"]["error"] > 0) {
        $data =  json_encode(array('type'=>'error', 'msg'=>"Return Code: " . $_FILES["file"]["error"])); 
      } else {
        if (file_exists("upload/" . $_FILES["file"]["name"])) {
          $data = json_encode(array('type'=>'error', 'msg'=>$_FILES["file"]["name"] . " already exists. ")); 
        } else {
          move_uploaded_file($_FILES["file"]["tmp_name"],
          "upload/" . $_FILES["file"]["name"]);
          $data = json_encode(array('fileName'=>$_FILES["file"]["name"],'msg'=>$_FILES["file"]["name"] . " uploaded successfully.", 'type'=>'success')); 
        }
      }
    } else {
    $data = json_encode(array('type'=>'error','msg'=>"Oh! Oh! Oh! Bad file type."));
    }
    echo $data;
} 
 
?> 
