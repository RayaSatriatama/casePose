<?php
include '../connection.php';
session_start();
$userId = $_SESSION["userId"];

$old = $_POST["old-pw"];
$new = $_POST["new-pw"];
$confirm_new = $_POST["confirm-pw"];

$sql = mysqli_query($conn, "SELECT password FROM user WHERE userId = '$userId'");
$result = mysqli_fetch_assoc($sql);

if(empty($new) || empty($old) || empty($confirm_new)){
    header("Location: ../../after/edit profil/edit_profil_password.php?pesan=kosong");
}else{
    if($old != $result["password"]) {
    header("Location: ../../after/edit profil/edit_profil_password.php?pesan=wrong_pw");
    }else{
        if($new != $confirm_new){
            header("Location: ../../after/edit profil/edit_profil_password.php?pesan=pw_tdk_sama");
        }else {
            $update = mysqli_query($conn,"UPDATE user SET password = '$new' WHERE userId = '$userId'");
            header("Location: ../../after/edit profil/edit_profil_password.php?pesan=pw_berhasil_diubah");        
        }
    }
}

?>