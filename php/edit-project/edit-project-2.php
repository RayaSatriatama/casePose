<?php 
include '../connection.php';

echo $id_project = $_POST["projectId"];

echo $folder_p_picture = "../../asset/users/project/halaman/";
$old_picture = $_POST["old_picture"];
echo $name_file = $_FILES['projectPicture']['name'];
echo $path = $_FILES['projectPicture']['tmp_name'];
echo $file_size = $_FILES['projectPicture']['size'];

echo $projectLink = $_POST["projectLink"];


if (empty($name_file)) {
    if (substr($projectLink, 0, 8) !== "https://") {
        header('Location: ../../after/edit-project/edit-project-2.php?'
        ."pesan=https&idproject=$id_project");
    }else{
        $sql = mysqli_query($conn,"UPDATE project SET projectLink = '$projectLink' WHERE projectId = '$id_project'");

        header('Location: ../../after/edit-project/edit-project-2.php?'
        ."pesan=sukses&idproject=$id_project");
    }
}else{
    // Cek ukuran file (5MB = 5 * 1024 * 1024 bytes)
    if ($file_size > 5 * 1024 * 1024) {
        header('Location: ../../after/edit-project/edit-project-2.php?'
        ."pesan=5mb&idproject=$id_project");
    }else{
        // Cek apakah nama file diakhiri dengan .jpg atau .png
        if (!preg_match('/\.(jpg|jpeg|png)$/i', $name_file)) {
            header('Location: ../../after/edit-project/edit-project-2.php?'
            ."pesan=tipe&idproject=$id_project");
        }else{
            // Cek apakah projectLink diawali dengan https://
            if (substr($projectLink, 0, 8) !== "https://") {
                header('Location: ../../after/edit-project/edit-project-2.php?'
                ."pesan=https&idproject=$id_project");
            }else{
                // Jika validasi lolos, pindahkan file ke folder tujuan
                if (move_uploaded_file($path, $folder_p_picture.$name_file)) {
                
                unlink($folder_p_picture.$old_picture);
                    
                $sql = mysqli_query($conn,"UPDATE project SET projectLink = '$projectLink', 
                projectPicture = '$name_file'
                WHERE projectId = '$id_project'");

                header('Location: ../../after/edit-project/edit-project-2.php?'
                ."pesan=sukses&idproject=$id_project");
                    
                } else {
                    // Redirect jika gagal mengupload file
                    header('Location: ../../after/edit-project/edit-project-2.php?'
                    ."pesan=upload&idproject=$id_project");
                }
            }
        }
    }
}

?>