$(function() {

// call click event
 $(".upload").click(function() {
 var fl= document.getElementById('image');
 if(fl.files.length==0) {
   flashMsg("Please choose image to upload."); 
   return false;
 }
  $(this).attr('disabled','disabled');
  sendRequest(0,fl);
 });

// Send request to server
function sendRequest(i,fl){
    var ln= fl.files.length;
      if(i<ln) {
	var curFileName = fl.files.item(i).name;
	$("#fname").html(curFileName);
	$("#progBar").show();
	 var formData = new FormData();
	 var fileD = document.getElementById('image').files[i];
	 formData.append('file', fileD);
	   $.ajax({
	      url: 'upload.php',
	      type: 'POST',
	      data: formData,
	      processData: false, 
	      contentType: false,
	      dataType: 'json',
	      xhr: function() {
		            var myXhr = $.ajaxSettings.xhr();
		            if(myXhr.upload){
		                myXhr.upload.addEventListener('progress',progress, false);
		            }
		            return myXhr;
		        },
	      success: function(res) {
	      if(res.type=='success') {
	      var count = $("table#tb tr").length;
	      var file = res.fileName;
		$("table#tb tr:first").before("<tr id='row"+count+"'><td><a href='upload/"+file+"' target='_blank'><img src='upload/"+file+"' width=200 height=200></a></td><td><a href='javascript:void(0);' id='delete' rmid='row"+count+"' filename='upload/"+file+"'>Delete</td></tr>");
		} 
		flashMsg(res.msg); 
		$("#progBar").hide();
		resetProgressBar();
		 i++;
	      sendRequest(i,fl)
	      },
	      error: function(e) {
		 alert(e.status+" error occurred to upload image!");
		window.location.href=window.location.href;
	      }    
	   }); 	  
     } else {
       $("#myform")[0].reset();
       $(".upload").removeAttr('disabled');
   }
}
 
 // Proress bar
 function progress(e){
        if(e.lengthComputable){
            $('progress').attr({value:e.loaded,max:e.total});
            var percentage = (e.loaded / e.total) * 100;
            $('#prog').html(percentage.toFixed(0)+'%');
        }
    }
    
  //Reset progress bar
    function resetProgressBar() {
        $('#prog').html('0%');
        $('progress').attr({value:0,max:100});
    }
    
// Flash message 
 function flashMsg(msg) {
        $("#alertMsg").fadeIn().html(msg).fadeOut(2000);
 }
 
 // Delete function
$(document).on('click','#delete',function() {
    $(this).attr('href','javascript:void(0)');
    var filePath = $(this).attr('fileName');
    var rmid = $(this).attr('rmid');
    $(this).html("deleting..");
    $.ajax({
        url:'upload.php',
        type:'POST',
        dataType: 'json',
        data:{del:1,filePath:filePath},
        success:function(res){
                if(res.type=='success') {
                  $("table#tb tr#"+rmid).remove();
                  }
                  flashMsg(res.msg);
                },
        error: function(e) {
                alert(e.status+" error occurred to delete image!");
                window.location.href=window.location.href;
               } 
    });
});

});
