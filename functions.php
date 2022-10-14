<?php

$conn = mysqli_connect("Localhost", "root", "", "web-uts");

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}
function getData($query, $name)
{
    global $conn;
    $res = mysqli_query($conn, $query);
    return mysqli_fetch_assoc($res)["$name"];
}

function signUp($data)
{
    global $conn;
    $name = htmlspecialchars($data['name']);
    $email = htmlspecialchars($data['email']);
    $username = stripslashes($data['username']);
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);
    $foto = 'default-profile.png';
    $user_type = 'user';

    $stmt = mysqli_prepare($conn, "SELECT username FROM user WHERE username = ?");
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    if (mysqli_fetch_assoc($res)) {
        header("Location: profile.php?error-message=Username already used");
        die;
    }
    if ($password !== $password2) {
        header("Location: profile.php?error-message=password does not match");
        die;
    }
    if (strlen(trim($password)) < 8) {
        header("Location: profile.php?error-message=Use 8 or more character with a mix of letters, number & symbols");
        die;
    }
    $password = password_hash($password, PASSWORD_BCRYPT);

    $stmt = mysqli_prepare($conn, "INSERT INTO user(username,nama,usertype,email,password,foto_profil)  VALUES(?,?,?,?,?,?)");
    mysqli_stmt_bind_param($stmt, "ssssss", $username, $name, $user_type, $email, $password, $foto);
    mysqli_stmt_execute($stmt);

    return mysqli_affected_rows($conn);
}

function editProfile($data)
{
    global $conn;
    $id = $data["id"];
    $username = htmlspecialchars($data["username"]);
    $nama = htmlspecialchars($data["name"]);
    $description = htmlspecialchars($data["description"]);
    $email = htmlspecialchars($data["email"]);

    $stmt = mysqli_prepare($conn, "UPDATE user SET
                                    username = ?,
                                    nama = ?,
                                    email = ?,
                                    description = ?
                                    WHERE id = ?");

    mysqli_stmt_bind_param($stmt, "sssss", $username, $nama, $email, $description, $id);
    mysqli_stmt_execute($stmt);

    return mysqli_affected_rows($conn);
}

function changeFotoProfile($data)
{
    global $conn;
    $id = $data['id'];
    $namafile = $_FILES["foto_profil"]['name'];
    $tmpName = $_FILES["foto_profil"]["tmp_name"];
    $size = $_FILES["foto_profil"]["size"];
    $eror = $_FILES["foto_profil"]["error"];

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensigambar = explode('.', $namafile);
    $ekstensigambar = strtolower(end($ekstensigambar));
    $namafile = hash("sha256", $namafile) . '.' . $ekstensigambar;
    if (!in_array($ekstensigambar, $ekstensiGambarValid)) {
        echo "<script>
            alert('Yang anda upload bukan gambar')
            </script>";
        return false;
    }
    move_uploaded_file($tmpName, 'img/profil/' . $namafile);

    $stmt = mysqli_prepare($conn, "UPDATE user SET foto_profil = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "ss", $namafile, $id);
    mysqli_stmt_execute($stmt);

    return $namafile;
}


function uploadGambar()
{
    if ($_FILES["postingan_gambar"]['name'] == NULL) {
        return -1;
    }
    $namafile = $_FILES["postingan_gambar"]['name'];
    $tmpName = $_FILES["postingan_gambar"]["tmp_name"];
    $size = $_FILES["postingan_gambar"]["size"];
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensigambar = explode('.', $namafile);
    $ekstensigambar = strtolower(end($ekstensigambar));
    $namafile = hash("sha256", $namafile) . '.' . $ekstensigambar;
    if (!in_array($ekstensigambar, $ekstensiGambarValid)) {
        echo "<script>
            alert('Yang anda upload bukan gambar')
            </script>";
        return false;
    }
    move_uploaded_file($tmpName, 'img/posting/' . $namafile);
    return $namafile;
}

function posting($data)
{
    global $conn;
    $id = $data['id'];
    $text = htmlspecialchars($data['postingan_text']);
    $kategori = htmlspecialchars($data['kategori']);
    $dateNow = date("Y-m-d h:i:s");
    $file = $_FILES['postingan_gambar']['name'];
    if ($kategori === 'javascript') $forum = 1;
    else if ($kategori === 'php') $forum = 2;
    else if ($kategori === 'java') $forum = 3;
    else if ($kategori === 'golang') $forum = 4;
    else if ($kategori === 'ruby') $forum = 5;
    else $forum = 6;
    $file = uploadGambar();

    $stmt = mysqli_prepare($conn, "INSERT INTO postingan(id_user,id_forum,postingan_gambar,postingan_text,tanggal_posting,kategori)
                                    VALUES (?,?,?,?,?,?)");
    mysqli_stmt_bind_param($stmt, "ssssss", $id, $forum, $file, $text, $dateNow, $kategori);
    mysqli_stmt_execute($stmt);
    return mysqli_affected_rows($conn);
    return mysqli_affected_rows($conn);
}

function deleteLike($id)
{
    global $conn;
    echo "Like masuk function ";
    $stmt = mysqli_prepare($conn, "DELETE FROM likes WHERE id_user = ?");
    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);

    return mysqli_affected_rows($conn);
}
function deleteComment($id)
{
    global $conn;
    $stmt = mysqli_prepare($conn, "DELETE FROM comment WHERE id_user = ?");
    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);
    return mysqli_affected_rows($conn);
}

function deletePostingan($id)
{
    global $conn;
    echo "Masuk postingan";
    if (deleteLike($id) >= 0) {
        echo "Like masuk";
        if (deleteComment($id) >= 0) {
            echo "Comment masuk";
            mysqli_query($conn, "SET FOREIGN_KEY_CHECKS=0");
            $stmt = mysqli_prepare($conn, "DELETE FROM postingan WHERE id_user = ?");
            mysqli_stmt_bind_param($stmt, "s", $id);
            mysqli_stmt_execute($stmt);
            mysqli_query($conn, "SET FOREIGN_KEY_CHECKS=1");
            return mysqli_affected_rows($conn);
        }
    }
}

function deleteUser($id)
{
    global $conn;
    if (deletePostingan($id) >= 0) {
        $stmt = mysqli_prepare($conn, "DELETE FROM follower WHERE id_user = ? OR id_follower = ?");
        mysqli_stmt_bind_param($stmt, "ss", $id, $id);
        mysqli_stmt_execute($stmt);
        $stmt2 = mysqli_prepare($conn, "DELETE FROM user WHERE id = ?");
        mysqli_stmt_bind_param($stmt2, "s", $id);
        mysqli_stmt_execute($stmt2);
        return mysqli_affected_rows($conn);
    }
}

function banned($data)
{
    global $conn;
    $id = $data['userID'];
    $stmt = mysqli_prepare($conn, "UPDATE user SET status = 'true' WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);
}
function temp_banned($data)
{
    global $conn;
    $id = $data['userID'];
    $date = $data['tmp-date'];
    $time = $data['tmp-time'];
    $dateFull = $date . ' ' . $time;
    $stmt = mysqli_prepare($conn, "UPDATE user SET tmp_bann = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "ss", $dateFull, $id);
    mysqli_stmt_execute($stmt);
}

function unBann_tmp($id)
{
    global $conn;
    $stmt = mysqli_prepare($conn, "UPDATE user SET tmp_bann = NULL WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);
}
function getLike($id)
{
    global $conn;
    $stmt = mysqli_prepare($conn, "SELECT * FROM likes WHERE id_postingan = ?");
    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $jml = 0;
    while ($val = mysqli_fetch_assoc($result)) {

        $jml++;
    }
    return $jml;
}
