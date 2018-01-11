<?php
class upload
{

    public $error;
    public function upload_file()
    {
        global $data;
        $target_dir = "uploads";
        $target_file   = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk      = 1;
        $audioFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if (file_exists($target_file)) {
            $uploadOk = 0;
            $error    = "File already exist";
        } else if ($_FILES["fileToUpload"]["size"] > 500000) {
            $error    = "Sorry, your file is too large.";
            $uploadOk = 0;
        } else if ($audioFileType != "m4a" && $audioFileType != "ogg" && $audioFileType != "acc" && $audioFileType != "wav") {
            $error    = "Sorry, only Voice recordings are allowed.";
            $uploadOk = 0;
        }
        if ($uploadOk == 0) {
            return $error;
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                return "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
            } else {
                return "Sorry, there was an error uploading your file.";
            }
        }
    }
}
?>
