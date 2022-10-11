<?php

$conn = mysqli_connect("Localhost", "root", "", "web-comunity");

    function query($query) {
        global $conn;
        $result = mysqli_query($conn,$query);
        $rows = [];
        while($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }
    function getData($query,$name){
        global $conn;
        $res = mysqli_query($conn, $query);
        return mysqli_fetch_assoc($res)["$name"];
    }

    function signUp($data){
        global $conn;
        $name = htmlspecialchars($data['name']);
        $email = htmlspecialchars($data['email']);
        $username = stripslashes($data['username']);
        $password = mysqli_real_escape_string($conn,$data["password"]);
        $password2 = mysqli_real_escape_string($conn,$data["password2"]);
        $foto = 'default-profile.png';
        $usertype = 'user';
        $res = mysqli_query($conn, "SELECT user FROM user WHERE username = '$username'");
        if(mysqli_fetch_assoc($res)){
            header("Location: profile.php?error-message=Username already used");
            die;
        }
        if($password !== $password2){
            header("Location: profile.php?error-message=password does not match");
            die;
        }
        $password = password_hash($password, PASSWORD_BCRYPT);
        mysqli_query($conn,"INSERT INTO user(username,nama,usertype,email,password,foto_profil)  VALUES('$username','$name','$usertype','$email','$password','$foto')");
        return mysqli_affected_rows($conn);
    }

    function editProfile($data) {
        global$conn;
        $id = $data["id"];
        $username = htmlspecialchars($data["username"]);
        $nama = htmlspecialchars($data["name"]);
        $description = htmlspecialchars($data["description"]);
        $email = htmlspecialchars($data["email"]);
        $query = "UPDATE user SET
                 username = '$username',
                 nama = '$nama',
                 email = '$email',
                 description = '$description'
                 WHERE id = $id;
                 ";
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }

    function changeFotoProfile($data) {
        global $conn;
        $id = $data['id'];
        $namafile = $_FILES["foto_profil"]['name'];
        $tmpName = $_FILES["foto_profil"]["tmp_name"];
        $size = $_FILES["foto_profil"]["size"];
        $eror = $_FILES["foto_profil"]["error"];
        
        $ekstensiGambarValid = ['jpg','jpeg','png'];
        $ekstensigambar = explode('.',$namafile);
        $ekstensigambar = strtolower( end($ekstensigambar));
        $namafile = hash("sha256", $namafile).'.'.$ekstensigambar;
        if(!in_array($ekstensigambar,$ekstensiGambarValid)) {
            echo "<script>
            alert('Yang anda upload bukan gambar')
            </script>";
            return false;
        }
        if($size > 1000000) {
            setcookie('error_message','Username has been used', time()+5);
            return false;
        }
        move_uploaded_file($tmpName,'img/profil/'. $namafile);
        $query = "UPDATE user SET
             foto_profil = '$namafile'
             WHERE id = $id;
             ";
        mysqli_query($conn, $query);
        return $namafile;
    }


    function uploadGambar() {
        if($_FILES["postingan_gambar"]['name'] == NULL){
            return -1;
        }
        $namafile = $_FILES["postingan_gambar"]['name'];
        $tmpName = $_FILES["postingan_gambar"]["tmp_name"];
        $size = $_FILES["postingan_gambar"]["size"];
        $ekstensiGambarValid = ['jpg','jpeg','png'];
        $ekstensigambar = explode('.',$namafile);
        $ekstensigambar = strtolower( end($ekstensigambar));
        $namafile = hash("sha256", $namafile).'.'.$ekstensigambar;
        if(!in_array($ekstensigambar,$ekstensiGambarValid)) {
            echo "<script>
            alert('Yang anda upload bukan gambar')
            </script>";
            return false;
        }
        // if($size > 1000000) {
        //     setcookie('error_message','Username has been used', time()+5);
        //     return false;
        // }
        move_uploaded_file($tmpName,'img/posting/'. $namafile);
        return $namafile;
    }

    function posting($data){
        global $conn;
        $id = $data['id'];
        $text = htmlspecialchars($data['postingan_text']);
        $kategori = $data['kategori'];
        $dateNow = date("Y-m-d");
        $file = $_FILES['postingan_gambar']['name'];
        if($kategori === 'javascript') $forum = 1;
        else if($kategori === 'php') $forum = 2;
        else if($kategori === 'java') $forum = 3;
        else if($kategori === 'golang') $forum = 4;
        else if($kategori === 'ruby') $forum = 5;
        else $forum = 6;
            $file = uploadGambar();
            $query = "INSERT INTO postingan(id_user,id_forum,postingan_gambar,postingan_text,tanggal_posting,kategori)
                      VALUES ('$id','$forum','$file','$text','$dateNow','$kategori')";
        mysqli_query($conn,$query);
        return mysqli_affected_rows($conn);
    }