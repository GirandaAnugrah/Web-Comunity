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
        $res = mysqli_query($conn, "SELECT user FROM user WHERE username = '$username'");
        if(mysqli_fetch_assoc($res)){
            echo "<script>
                alert('Username sudah terdaftar')
            </script>";
            return false;
        }
        if($password !== $password2){
            echo "<script>
                alert('Password')
            </script>";
            return false;
        }
        $password = password_hash($password, PASSWORD_BCRYPT);
        mysqli_query($conn,"INSERT INTO user(username,nama,email,password,foto_profil)  VALUES('$username','$name','$email','$password','$foto')");
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
        if(!in_array($ekstensigambar,$ekstensiGambarValid)) {
            echo "<script>
            alert('Yang anda upload bukan gambar')
            </script>";
            return false;
        }
        if($size > 1000000) {
            echo "<script>
            alert('Gambar yang anda input terlalu besar')
            </script>";
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