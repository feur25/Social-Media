<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     $tmpFile = $_FILES['pic']['tmp_name'];
     $newFile = '/'.$_FILES['pic']['name'];
     $result = move_uploaded_file($tmpFile, $newFile);
     echo $newFile;
     if ($result) {
          echo 'was uploaded <br/>';
     } else {
          echo 'failed to upload <br/>';
     }
}
?>
<form action="" enctype="multipart/form-data" method="POST">
     <input type="file" name="pic" />
     <input type="submit" value="Upload" />
</form>