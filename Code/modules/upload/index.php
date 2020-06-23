<?php


function upload($par, $dir, $newName, $extensions = ['jpeg', 'jpg', 'png', 'gif', 'svg']) {

    // Store all errors
    $errors = [];


    // Define available file extensions
    $fileExtensions = $extensions;

    if (@$_FILES[$par]['name']) {
        $fileName = $_FILES[$par]['name'];
        $fileTmpName  = $_FILES[$par]['tmp_name'];
        $fileType = $_FILES[$par]['type'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        $n = basename($newName) . '.' . $fileExtension;
        $uploadPath = d($dir) . $n;

        //echo $uploadPath;

        if (isset($fileName)) {
            if (!in_array($fileExtension, $fileExtensions)) {
                $errors[] = "supported extensions: " . implode(', ', $extensions);
            }
            if (empty($errors)) {
                $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
                if ($didUpload) {
                    return ['success' => true, 'dir' => $uploadPath, 'url' => url($dir . $n)];
                } else {
                    return ['error' => true, 'message' => "An error occurred while uploading. Try again."];
                }
            } else {
                $a = '';
                foreach ($errors as $error) {
                    $a .= "The following error occured: " . $error . "\n";
                }
                return ['error' => true, 'message' => $a];
            }
        }
    }
    return true;
}
