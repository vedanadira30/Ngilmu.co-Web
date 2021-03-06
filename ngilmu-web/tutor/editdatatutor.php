<?php
require('../koneksi.php');

session_start();

if(!isset($_SESSION['id_admin'])) {
    $_SESSION['msg'] = 'anda harus login untuk mengakses halaman ini';
    header('Location: index.php');
}
$sesID = $_SESSION['id_admin'];
$sesName = $_SESSION['email'];
$uName = $_SESSION['nama_lengkap'];
$path = '../images/';

if (isset($_POST['update'])) {
//    $id = $_POST['id_tutor'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $fullname = $_POST['fullname_tutor'];
    $instansi = $_POST['instansi'];
    $notelp = $_POST['no_telp'];
    $gender = $_POST['gender'];
    $alamat = $_POST['alamat'];
    $tgllahir = $_POST['tgl_lahir'];
    $profilelama = $_POST['profile_lama'];

   //proses upload file
   $pict = $_FILES['profile']['name'];
   $tmp = $_FILES['profile']['tmp_name'];

   if ($pict == '') {
    $query = "UPDATE user_tutor SET password='$password', fullname_tutor='$fullname',
            instansi='$instansi',no_telp='$notelp', gender='$gender', alamat='$alamat', tgl_lahir='$tgllahir' where email='$email'";
   $result = mysqli_query($koneksi, $query);
   header('Location: ../datatutor.php');
} else {
    unlink('../images/'.$profilelama);

    move_uploaded_file($tmp, "../images/".$pict);

    $query = "UPDATE user_tutor SET password='$password', fullname_tutor='$fullname',
            instansi='$instansi',no_telp='$notelp', gender='$gender', alamat='$alamat', tgl_lahir='$tgllahir', profile='$pict' where email='$email'";
   $result = mysqli_query($koneksi, $query);
   header('Location: ../datatutor.php');
    }
}

    $id = $_GET['id_tutor'];
    $query = "SELECT * FROM user_tutor WHERE id_tutor='$id'";
    $result = mysqli_query($koneksi, $query) or die (mysql_error());
    $no = 1;
    while ($row = mysqli_fetch_array($result)){
        $idtutor = $row['id_tutor'];
        $email = $row['email'];
        $password = $row['password'];
        $fullname = $row['fullname_tutor'];
        $instansi = $row['instansi'];
        $notelp = $row['no_telp'];
        $gender = $row['gender'];
        $alamat = $row['alamat'];
        $tgllahir = $row['tgl_lahir'];
        $profile = $row['profile'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <link rel="shortcut icon" href="../images/ngilmu2.png">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Data Tutor</title>
</head>
<body>
    <div class="container-dash">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <span class="icon"><img src="../images/ngilmu4.png"></span>
                        <span class="title">Ngilmu.co</span>
                    </a>
                </li>
                <li>
                    <a href="../dashboard.php">
                        <span class="icon"><i class="bi bi-house-door"></i></span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="../datasiswa.php">
                        <span class="icon"><i class="bi bi-person"></i></span>
                        <span class="title">Data Siswa</span>
                    </a>
                </li>
                <li>
                    <a href="../datatutor.php">
                        <span class="icon"><i class="bi bi-people"></i></span>
                        <span class="title">Data Tutor</span>
                    </a>
                </li>
                <li>
                    <a href="../datamapel.php">
                        <span class="icon"><i class="bi bi-book"></i></span>
                        <span class="title">Mata Pelajaran</span>
                    </a>
                </li>
                <li>
                    <a href="../riwayatpemesanan.php">
                        <span class="icon"><i class="bi bi-clock-history"></i></span>
                        <span class="title">Riwayat Pemesanan</span>
                    </a>
                </li>
                <li>
                    <a href="../pendapatantutor.php">
                        <span class="icon"><i class="bi bi-wallet2"></i></span>
                        <span class="title">Pendapatan Tutor</span>
                    </a>
                </li>
            </ul>
        </div>

    <!-- main -->
    <div class="main">
        <div class="topbar">
            <div class="toggle">
                <i class="bi bi-list"></i>
            </div>
            <!-- search -->
            <div class="search">
                <label>
                    <input type="search" placeholder="Search Here">
                    <i class="bi bi-search"></i>
                </label>
            </div>
             <!-- dropdown -->
             <div class="dropdown">
            <a href="profile.php" class="btn btn-sm"><?php echo $_SESSION['nama_lengkap'] ?></a>
            </div>
            <!-- userImg -->
            <div class="user">
                <img src="../images/tutor_male2.png">
            </div>
        </div>

        <!-- form edit data tutor -->
        <div class="col-md-12 p-5 pt-2">
            <h2><i class="bi bi-people"></i></i> EDIT DATA TUTOR </h2><hr>
            <div class="col-12">
                <form id="form_validation" method="POST" enctype="multipart/form-data">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" value="<?php echo $email;?>" required>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Password</label>
                                    <input type="text" class="form-control" name="password" value="<?php echo $password;?>" required>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Fullname</label>
                                    <input type="text" class="form-control" name="fullname_tutor" value="<?php echo $fullname;?>" required>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Instansi</label>
                                    <input type="text" class="form-control" name="instansi" value="<?php echo $instansi;?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">No HP</label>
                                <input type="number" class="form-control" name="no_telp" value="<?php echo $notelp; ?>" required>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Gender</label><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="gender" value="Laki-Laki"<?php if($gender=='Laki-Laki') echo 'checked'?>>Laki-Laki
                                        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="gender" value="Perempuan"<?php if($gender=='Perempuan') echo 'checked'?>>Perempuan
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Alamat</label>
                                <textarea class="form-control" name="alamat" rows="3"><?= $alamat; ?></textarea>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control" name="tgl_lahir" value="<?php echo $tgllahir;?>" required>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Profile</label>
                                    <div>
                                        <img src="<?php echo $path.$profile;?>" style="width: 80px; height:80px;">
                                    </div><br>
                                    <input type="file" class="form-control" name="profile">
                                    <input type="hidden" class="form-control" name="profile_lama" value="<?php echo $profile;?>">
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit" name="update">Simpan Perubahan</button>
                            <a href="../datatutor.php">
                                <button class="btn btn-danger" type="button" name="kembali">Kembali</button>
                            </a>
                        </form>
                    </div>
                  </tbody>
            </table>

    </div>

    </div>

<script>
    //menuToogle
    let toggle = document.querySelector('.toggle');
    let navigation = document.querySelector('.navigation');
    let main = document.querySelector('.main');

    toggle.onclick = function(){
        navigation.classList.toggle('active');
        main.classList.toggle('active');
    }

    //membuat hovered
    let list = document.querySelectorAll('.navigation li');
    function activeLink(){
        list.forEach((item) =>
        item.classList.remove('hovered'));
        this.classList.add('hovered');
    }
    list.forEach((item) =>
    item.addEventListener('mouseover', activeLink));
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>