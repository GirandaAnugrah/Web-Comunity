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
        mysqli_query($conn,"INSERT INTO user(username,nama,email,password,foto_profil)  VALUES('$username','$name','$email','$password','NULL')");
        return mysqli_affected_rows($conn);
    }
