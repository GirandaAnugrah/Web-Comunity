<?php 
require 'functions.php';
if(isset($_POST['userid'])){
    if(isset($_POST['liked'])){
        $postid = $_POST['postid'];
        $userid = $_POST['userid'];
        $check = mysqli_query($conn,"SELECT * FROM likes WHERE id_postingan = '$postid' AND id_user = '$userid'");
        $num = mysqli_fetch_assoc($check);
        if(empty($num)){
            $res = mysqli_query($conn, "SELECT * FROM postingan WHERE id=$postid");
            $row = mysqli_fetch_array($res);
            $n = $row['jml_like'];
            mysqli_query($conn, "INSERT INTO likes(id_postingan, id_user, waktu) VALUES ('$postid', '$userid', date('d-m-y h:i:s'))");
    
        }else{
            $query = "DELETE FROM likes WHERE id_postingan = '$postid' AND id_user = '$userid'";
            mysqli_query($conn,$query);
        }
    }
    if(isset($_POST['unliked'])){
        $postid = $_POST['postid'];
        $userid = $_POST['userid'];
        $res = mysqli_query($conn, "SELECT * FROM postingan WHERE id=$postid");
        $row = mysqli_fetch_array($res);
        $n = $row['jml_like'];

        mysqli_query($conn, "DELETE FROM likes WHERE id_postingan = $postid AND id_user = $userid");
    }
}
$like = query("SELECT * FROM likes WHERE id_postingan = '$postid'");
$jml = 0;
foreach($like as $val){
    $jml++;
}
?>

<span><?= $jml; ?></span>