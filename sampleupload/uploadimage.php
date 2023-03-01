
<!DOCTYPE html>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

	    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    
    </head>
    <body>
        <!-- // 1- HTML form with file upload -->
        <form action="" method="post" enctype="multipart/form-data">
            <label class="form-label">Select image to upload:</label>
            <input type="file" name="fileToUpload" id="fileToUpload" >
            <input type="submit" value="Upload Image" name="submit" >
        </form>

    </body>

</html>

<?php
    if(isset($_POST['submit'])){  //prevent from getting an error when file selected is null

        // 2- Read the uploaded file and move it to the target location

        // Specify where the uploaded file will be placed
        $target_dir = "uploads/";

        // Specify the name of the uploaded file
        $target_file = $target_dir . basename($_FILES['fileToUpload']["name"]);
            // basename = returns the name of the file without the path

        // Move uploaded file to target location
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
    }

?>