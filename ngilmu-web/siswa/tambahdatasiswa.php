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

if (isset($_POST['tambah'])) {
   $email = $_POST['email'];
   $password = $_POST['password'];
   $fullname = $_POST['fullname'];
   $grade = $_POST['grade'];
   $gender = $_POST['gender'];
   $alamat = $_POST['alamat'];

//    $profile = $_FILES['profile']['name'];
//    $ukuranFile = $_FILES['profile']['size'];
//    $error = $_FILES['profile']['error'];
//    $tmp = $_FILES['profile']['tmp_name'];
   
//     //cek tidak ada gambar
//     if($error === 4){
//         echo "<script>alert('Pilih gambar terlebih dahulu');window.location='tambahdatasiswa.php'</script>";
//     }

//     // cek ekstensi gambar
//     $ekstensi = ['jpg','jpeg','png'];
//     $ekstensiGambar = explode('.', $profile);
//     $ekstensiGambar = strtolower(end($ekstensiGambar));
//     if(!in_array($ekstensiGambar, $ekstensi)){
//         echo "<script>alert('Maaf, Tipe gambar yang diupload harus jpg / jpeg / png');window.location='tambahdatasiswa.php'</script>";
//     }

//     // cek ukuran gambar
//     if($ukuranFile > 1000000){
//         echo "<script>alert('Ukuran gambar terlalu besar');window.location='tambahdatasiswa.php'</script>";
//     }

   //berhasil upload
   $profile = $_FILES['profile']['name'];
   $tmp = $_FILES['profile']['tmp_name'];

   move_uploaded_file($tmp, '../images/' . $profile);
   $query = "INSERT INTO user_detail VALUES ('','$email','$password','$fullname','$grade','$gender','$alamat','$profile')";
   $result = mysqli_query($koneksi, $query);
   header('Location: ../datasiswa.php');
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
    <title>Tambah Data Siswa</title>
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

        <div class="col-md-12 p-5 pt-2">
            <h2><i class="bi bi-person"></i></i> TAMBAH DATA SISWA </h2><hr>
            <div class="row mb-5">
                        <div class="col-12">
                            <form action="tambahdatasiswa.php" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Email</label>
                                    <input type="email" class="form-control" name="email" required
                                        placeholder="email">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Password</label>
                                    <input type="text" class="form-control" name="password" required
                                        placeholder="password">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Fullname</label>
                                    <input type="text" class="form-control" name="fullname" required
                                        placeholder="fullname">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Grade</label>
                                    <input type="text" class="form-control" name="grade" required
                                        placeholder="grade">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Gender</label><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="gender" value="Laki-Laki">Laki-Laki
                                        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="gender" value="Perempuan">Perempuan
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Alamat</label>
                                    <textarea class="form-control" name="alamat" rows="3" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Profile</label>
                                    <input type="file" class="form-control" name="profile">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit" name="tambah">Simpan</button>
                                    <a href="../datasiswa.php">
                                        <button class="btn btn-danger" type="button" name="kembali">Kembali</button>
                                    </a>
                                </div>
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