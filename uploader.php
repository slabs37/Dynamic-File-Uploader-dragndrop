<?php
   if(isset($_FILES['file'])){
      $errors= array();
      if(isset($_POST['name'])){
        $file_name = $_POST['name'];
      } else {
        $file_name = $_FILES['file']['name'];   
      }
      $file_size =$_FILES['file']['size'];
      $file_tmp =$_FILES['file']['tmp_name'];
      $file_type=$_FILES['file']['type'];
      
      // Upload destination, feel free to change
      $dir_path = "uploads";
      $file_path = $dir_path."/".$file_name;

     
      if($file_size < 1){
         $errors ='PROBLEM, TRY AGAIN';
      }
      
      if(empty($errors)==true){
         if(!file_exists($dir_path)){
            mkdir($dir_path, 0777, true);
            if(file_exists($dir_path) && !file_exists($file_path)){

               if(move_uploaded_file($file_tmp,$dir_path."/".$file_name)){
                  echo "File : <a href='$dir_path/$file_name'>$file_name</a>";
               }else{
                  echo $errors;
               }
            
            }else{
               echo $errors;
            }
         }else{
            move_uploaded_file($file_tmp,$dir_path."/".$file_name);
            echo "File : <a href='$dir_path/$file_name'>$file_name</a>";
         }
      }else{
         print_r($errors);
      }
      die();
   }
?>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="description" content="Dynamic File Uploader to upload file with real time upload progress, total size of file etc.">
	<meta name="keywords" content="dynamic, uploader, upload, file, realtime, progress, procces, size, etc.">
	<meta name="author" content="Md. Saifur Rahman and Shakil Ahmed and slabs37">
	<meta property="og:image" content="https://i.ibb.co/HtqRhv3/logo.png">
	<title>Dynamic File Uploader</title>
	<link rel="shortcut icon" href="https://i.ibb.co/k6ZrV5t/icons8-upload-64.png" type="image/x-icon">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@400;700&display=swap">

	<style>
	

	body {
		background: linear-gradient(65deg, #686de0, #6c5ce7) no-repeat;
		min-height: calc(100vh - 16px);
		-webkit-box-sizing: border-box;
		box-sizing: border-box;
		font-family: 'Comfortaa', cursive;
		line-height: 1.5;
		letter-spacing: 2px;
	}

	.container {
		width: 70%;
		margin: 0 auto;
	}

	a {
		color: #bdc3c7;
		text-decoration: none;
		-webkit-transition: ease all 0.3s;
		transition: ease all 0.3s;
	}

	a:hover {
		color: #ecf0f1;
	}

	.section {
		display: -webkit-box;
		display: -ms-flexbox;
		display: flex;
		-webkit-box-pack: center;
		-ms-flex-pack: center;
		justify-content: center;
		-webkit-box-align: center;
		-ms-flex-align: center;
		align-items: center;
		text-align: center;
		-webkit-box-orient: vertical;
		-webkit-box-direction: normal;
		-ms-flex-direction: column;
		flex-direction: column;
	}

	.section .title {
		color: #ecf0f1;
		text-transform: capitalize;
		font-weight: 700;
	}

	.section .white {
		color: #ecf0f1;
	}

	.section form {
		display: -webkit-box;
		display: -ms-flexbox;
		display: flex;
		min-height: 65vh;
		overflow: hidden;
		-webkit-box-pack: center;
		-ms-flex-pack: center;
		justify-content: center;
		-webkit-box-align: center;
		-ms-flex-align: center;
		align-items: center;
		-webkit-box-orient: vertical;
		-webkit-box-direction: normal;
		-ms-flex-direction: column;
		flex-direction: column;
	}

	.section form span.label {
		color: #ecf0f1;
		margin: 10px 0;
		display: -webkit-box;
		display: -ms-flexbox;
		display: flex;
		text-transform: capitalize;
	}

	.section form label.file{
		cursor: pointer;
	}

	.section form label.file .fas {
		color: #ecf0f1;
	}

	.section form label.file .block {
		display: block;
		margin: 10px 0;
	}

	.section form .preview {
		height: auto;
		width: 10vw;
		margin: 5px 0;
	}

	.section form input[type=file] {
		visibility: hidden;
	}

	.section form .submit {
		border: 1px solid #ecf0f1;
		background: transparent;
		color: #ecf0f1;
		padding: 10px 20px;
		font-size: 17px;
		letter-spacing: 2px;
		-webkit-transition: ease all 0.3s;
		transition: ease all 0.3s;
		margin: 20px 0;
		cursor: pointer;
		outline: none;
	}

	.section form .submit:hover {
		background: #ecf0f1;
		border: 1px solid transparent;
		color: #2c3e50;
	}

	.section form .show {
		visibility: visible;
	}

	.section form .hide {
		visibility: hidden;
	}

	.section form #pass{
		width: 70%;
	}

	@-webkit-keyframes progress-bar-stripes {
		from {
			background-position: 40px 0;
		}

		to {
			background-position: 0 0;
		}
	}

	@keyframes progress-bar-stripes {
		from {
			background-position: 40px 0;
		}

		to {
			background-position: 0 0;
		}
	}

	.section form div .progress {
		width: 100%;
		min-height: 20px;
		overflow: hidden;
		background: #f5f5f5;
		-webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
		box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
	}

	.section form div .progress-bar {
		width: 70%;
		height: 100%;
		font-size: 16px;
		padding: 5px 0;
		color: #fff;
		text-align: center;
		background-color: #a29bfe;
		-webkit-box-shadow: inset 0 -1px 0 rgba(0, 0, 0, 0.15);
		box-shadow: inset 0 -1px 0 rgba(0, 0, 0, 0.15);
		-webkit-transition: width .6s ease;
		transition: width .6s ease;
	}

	.section form div .progress-bar-striped,
	.section form div .progress-striped .progress-bar {
		background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
		background-size: 40px 40px;
	}

	.section form div .progress-bar.active,
	.section form div .progress.active .progress-bar {
		-webkit-animation: progress-bar-stripes 2s linear infinite;
		animation: progress-bar-stripes 2s linear infinite;
	}

	.section form div .progress-bar-success {
		background-color: #5cb85c !important;
	}

	.section form div .progress-striped .progress-bar-success {
		background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
	}

	.section .credit {
		height: 10vh;
		display: -webkit-box;
		display: -ms-flexbox;
		display: flex;
		-webkit-box-align: end;
		-ms-flex-align: end;
		align-items: flex-end;
		-webkit-box-pack: center;
		-ms-flex-pack: center;
		justify-content: center;
		overflow: hidden;
	}

	.section .credit span {
		color: #ecf0f1;
		text-transform: capitalize;
	}

	</style>
</head>
<body>

	<div class="section" ondrop="dropHandler(event);" ondragover="dragOverHandler(event);">
		<div class="container">
			<h1 class="title">dynamic file uploader</h1>

			<form method="POST" id="upload_form" enctype="multipart/form-data">
				<span class="label">tap the plus icon to choose file</span>
				<input type="file" name="file[]" id="file" class="file" data-multiple-caption="{count} files are selected" multiple>
				

				<label for="file" class="file">
					<span class="block white">No file is chosen</span>
					<i class="fas fa-plus-circle fa-2x"></i>
				</label>


				<img id="uploadPreview" class="preview" id="preview">

				<button type="button" value="Upload" class="submit" id="submit">Upload</button>
                
				<div id="pass">
				
				</div>
				<input type="hidden" id="name" name="name" value="">
			</form>
			
			<div class="credit">
				<span>Created by shakilofficial0, Improved by slabs37</span>
			</div>			
			

		</div>
	</div>

	<script>
	    var filenameset;
		// Files Counter
		(function (document, window, index) {
			var inputs = document.querySelectorAll('.file');
			Array.prototype.forEach.call(inputs, function (input) {
				var label = input.nextElementSibling,
					labelVal = label.innerHTML;

				input.addEventListener('change', function (e) {
					var fileName = '';
					filenameset = '';
					if (this.files && this.files.length > 1)
						fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}',
							this.files.length);
					else
						fileName = e.target.value.split('\\').pop();
					if (fileName) {
					    if (document.getElementById('name').value !== '') {
					        fileName = document.getElementById('name').value;
					        document.getElementById('name').value = '';
					        filenameset = fileName;
					    }
					    label.querySelector('span').innerHTML = fileName;
					} else {
						label.innerHTML = labelVal;
					}
				});

				// Firefox bug fix
				input.addEventListener('focus', function () {
					input.classList.add('has-focus');
				});
				input.addEventListener('blur', function () {
					input.classList.remove('has-focus');
				});
			});
		}(document, window, 0));


	// Image Preview Only For Screenshots
	
	document.getElementById("file").addEventListener("change", function(){
	    document.getElementById("uploadPreview").hidden = true;
	})

	 function scPreview() {
	 	var oFReader = new FileReader();
	 	oFReader.readAsDataURL(document.getElementById("file").files[0]);

	 	oFReader.onload = function (oFREvent) {
     		document.getElementById("uploadPreview").src = oFREvent.target.result;
     		document.getElementById("uploadPreview").hidden = false;
	 	};
	 }

	// Progress Bar

	document.getElementById("submit").addEventListener("click", function () {
		document.getElementById("pass").innerHTML = ""
		
        var input = document.getElementById('file');
        console.log(input.files.length);
        for (var i = 0; i < input.files.length; ++i) {
            document.querySelector("#pass").insertAdjacentHTML("beforeend","<div class=\"progress\" id=\"progress-bar-sh-"+i+"\"><div id=\"myBar-"+i+"\" class=\"progress-bar progress-bar-striped active\" style=\"width:0%\">0%</div></div><div id=\"stats-"+i+"\" class=\"white\"><h3 id=\"status-"+i+"\"></h3><p id=\"loaded_n_total-"+i+"\"></p><p id=\"shakil-"+i+"\">Uploaded: <span id=\"n_loaded-"+i+"\"></span> / <span></span><span id=\"n_total-"+i+"\"></span><span id=\"n_per-"+i+"\"></span></p></div>");
	
            		var file = document.getElementById("file").files[i];
		 //alert(file.name+" | "+file.size+" | "+file.type);
		var formdata = new FormData();
		formdata.append("file", file);
		if (filenameset !== '') {
		    formdata.append("name", filenameset);
		}
		var ajax = new XMLHttpRequest();
		ajax.upload.addEventListener("progress", progressHandler.bind(null, i), false);
		ajax.addEventListener("load", completeHandler.bind(null, i), false);
		ajax.addEventListener("error", errorHandler.bind(null, i), false);
		ajax.addEventListener("abort", abortHandler.bind(null, i), false);
		ajax.open("POST", "<?php echo $_SERVER['PHP_SELF'];?>");
		ajax.send(formdata);    
		
           }

	});
	
	function progressHandler(num,event) {
	    	var link = document.getElementById("status-"+num);
		var elem = document.getElementById("myBar-"+num);
		
		var percent = (event.loaded / event.total) * 100;
		var width = Math.round(percent);

		var frame = Math.round(percent);
		var id = setInterval(frame, 100);

		elem.style.width = width + '%';
		elem.innerHTML = width * 1 + '%';


		var load = (event.loaded / (1024 * 1024));
		var loaded = Math.round(load);

		var total = (event.total / (1024 * 1024));
		var totalr = Math.round(total);
		
		document.getElementById("n_total-"+num).innerHTML = +totalr + " MB";
		document.getElementById("n_loaded-"+num).innerHTML = +loaded + " MB";
		document.getElementById("n_per-"+num).innerHTML = " (" + width + "%)";
		if(width == 100){
			elem.classList.add("progress-bar-success");
			elem.innerHTML = "Complete";
			link.classList.remove("hide");
			link.classList.add("show");
		}
	}

	document.getElementById("file").addEventListener("click",function() {
  
		document.querySelector("#pass").innerHTML = "";
}
);

	function completeHandler(num,event) {
  
	    document.querySelector("#progress-bar-sh-"+num).hidden = true;
	     document.querySelector("#loaded_n_total-"+num).hidden = true;
	     document.querySelector("#shakil-"+num).hidden = true;
		document.querySelector("#status-"+num).innerHTML = event.target.responseText;
		// document.getElementById("progressBar").value = 0;
}


	function errorHandler(num,event) {
  
	    //document.querySelector("#progress-bar-sh-"+num).hidden = true;
	     //document.querySelector("#loaded_n_total-"+num).hidden = true;
	     //document.querySelector("#shakil-"+num).hidden = true;
		document.querySelector("#status-"+num).innerHTML = "Upload Failed";
}


	function abortHandler(num,event) {
  
	    document.querySelector("#progress-bar-sh-"+num).hidden = true;
	     document.querySelector("#loaded_n_total-"+num).hidden = true;
	     document.querySelector("#shakil-"+num).hidden = true;
		document.querySelector("#status-"+num).innerHTML = "Upload Aborted";
}

    //Drag And Drop Support
    
    function dropHandler(event) {
      console.log("File(s) dropped");
      
      var files=event.target.files||event.dataTransfer.files
    
      // Prevent default behavior (Prevent file from being opened)
      event.preventDefault();
    
      document.getElementById('file').files = files;
      var vent = new Event('change');
    
      document.getElementById('file').dispatchEvent(vent);
    }
    function dragOverHandler(event) {
      console.log("File(s) in drop zone");
    
      // Prevent default behavior (Prevent file from being opened)
      event.preventDefault();
    }

    // File Paste Support
    
    window.addEventListener('paste', e => {
        if (e.clipboardData.files[0]['name'] == "image.png") {
            
            let date = new Date();
            let newFileName = window.prompt("File Name","Screenshot".concat(date.toISOString().replaceAll('-', '_').replaceAll(':', '_').replaceAll('Z', '.png').replaceAll('T', '_')));
            if (newFileName.indexOf(".png") == -1 && newFileName.indexOf(".jpg") == -1 ) {
                newFileName = newFileName + ".png";
            }
            document.getElementById('name').value = newFileName;
        }
        
        document.getElementById('file').files = e.clipboardData.files;
        console.log(e.clipboardData.files);
        var vent = new Event('change');
        document.getElementById('file').dispatchEvent(vent);
        if (e.clipboardData.files[0]['name'] == "image.png") { scPreview(); }
    });

    // Press enter to upload
    
    window.addEventListener("keypress", e => {
      if (e.key === "Enter") {
        document.getElementById("submit").click();
      }
    });

	</script>
	<script src="https://kit.fontawesome.com/6b46e3b6bd.js" crossorigin="anonymous"></script>
</body>
</html>
