<?php
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en-US">
<title>Multi Image upload in php+ajax with progress bar!</title>
<meta charset="utf-8">
<meta name="Keywords" content="Multi Image upload in php and ajax with progress bar">
<meta name="Description" content="Multi Image upload in php and ajax with progress bar">
<body>
<div style="width:60%; margin:0 auto;">
<h3>Multi Image upload in php+ajax with progress bar! <a href="https://github.com/rohit0kumar/php_ajax_multi_file_upload_with_progressbar" target="_blank">Download</a></h3>
<div style="border:1px solid; padding:10px 10px 10px 10px; float:left; width:800px;">
<form enctype="multipart/form-data" id="myform" name="myform">  
   <b>Choose multiple image to upload.</b><br/>
    <input type="file"  name="file[]" id="image" multiple />
    <br>
   <font color=red>Note: Choose only .gif, .jpeg, .jpg, .png images only..!!</font><br/>  
    <input type="button" value="Upload images" class="upload" />
</form>
<div id="progBar" style="display:none;">
 <span id="fname" style="color:red;"></span>
  <progress value="0" max="100" style="width:750px; "></progress><span id="prog" style="font-weight:bold;">0%</span>
</div>
<div id="alertMsg" style="font-size:16px; color:blue; display:none;"></div>
<h3>List of uploaded files</h3>
<table border=1 width=100% id="tb" align="left">
<tr style="display:none;"><td colspan=2 ></td></tr>
<?php 
  $dir = "upload/";
  $i=0;
    foreach(glob($dir."{*.jpg,*.gif,*.png,*.jpeg}", GLOB_BRACE) as $file){ 
             echo "<tr id='row".$i."'><td><a href='".$file."' target='_blank'><img src='".$file."' width=200 height=200></a></td><td><a href='javascript:void(0);' id='delete' rmid='row".$i."' filename='".$file."'>Delete</a></td></tr>";
             $i++;    
}

?>
   </table>
  </div>
 </div>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="js/upload.js"></script>
 </body>
</html>
