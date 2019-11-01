$(document).ready(function() {

    
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.ppic').attr('src', e.target.result);
            }
    
            reader.readAsDataURL(input.files[0]);
        }
    }
    

    $(".file-upload").on('change', function(){
        readURL(this);
    });

  $("#save-button").on('click', function (event) {
    event.preventDefault();
         let ajax = false;
         if (window.XMLHttpRequest) {
           ajax = new XMLHttpRequest();
         } else if (window.ActiveXObject) {
           ajax = new ActiveXObject('Microsoft.XMLHTTP');
         }
         if (ajax) {
           const file_data = $('#file-upload').prop('files')[0];
           if (file_data != undefined) {
             const form_data = new FormData();
             form_data.append('fileToUpload', file_data);
             ajax.upload.addEventListener('progress', progressHandler, false);
             ajax.addEventListener('load', (event) => completeHandler(event), false);
             ajax.addEventListener('error', errorHandler, false);
             ajax.addEventListener('abort', abortHandler, false);
             ajax.open('POST', 'UploadFile.php');
             // use UploadFile.php from above url
             ajax.send(form_data);
             $('#file-upload').val('');
           }
         } else {
           alert('ajax is not supported in your browser');
           $('#file-upload').val('');
         }
         function myFunction(message) {
          // Get the snackbar DIV
          var x = document.getElementById("snackbar");
        
          // Add the "show" class to DIV
          x.className = "show";
          x.innerHTML=message;
          // After 3 seconds, remove the show class from DIV
          setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
        }
        function completeHandler(event) {
            data = event.target.responseText;
            data = JSON.parse(data);
            
          if (data.type == 'success') {
            $('.ppic').attr('src', data.data);
          }
          else {
            console.log(data.message);
          }
          myFunction(data.message);
        }
        
  function progressHandler(event) {
    console.log(event.loaded);
  }
  function errorHandler(event) {

  }
  
  function abortHandler(event) {
  }
    });


});