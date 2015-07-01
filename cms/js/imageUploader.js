$(document).ready(function() {
  bindFile();
  
  $('.clear').unbind().click(function(e){
    clearForm();
    e.preventDefault();
    return false;
  });
});

function bindFile() {
  $(".imageUpload").change(function(){
    console.log("changed");
    file = this.files[0];
    var reader = new FileReader();
    if(reader instanceof FileReader) {
      console.log("Reader Ready");
      reader.readAsDataURL(file);
      reader.onload = (function(kak) {
        return function(e) {  
          console.log("making it happen");        
          if(e.target.result.length>5) {
            $('#newImageContainer').html("<img src='"+e.target.result+"' style='max-width:200px;'/>");
            $('#imageSource').val(e.target.result);
          }
        }
      })(file);      
    }
  });
}

function clearForm() {
  $('#newImageContainer').empty();
  $('#imageSource').val('');
  $('#uploader').html($('#uploader').html());
  bindFile();
}