<?php
require ("koneksi.php");

session_start();

if(!isset($_SESSION['id_admin'])) {
  $_SESSION['msg'] = 'anda harus login untuk mengakses halaman ini';
  header('Location: index.php');

}
$sesID = $_SESSION['id_admin'];
$sesName = $_SESSION['email'];
$uName = $_SESSION['nama_lengkap'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="images/ngilmu2.png">
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
                        <span class="icon"><img src="images/ngilmu4.png"></span>
                        <span class="title">Ngilmu.co</span>
                    </a>
                </li>
                <li>
                    <a href="dashboard.php">
                        <span class="icon"><i class="bi bi-house-door"></i></span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="datasiswa.php">
                        <span class="icon"><i class="bi bi-person"></i></span>
                        <span class="title">Data Siswa</span>
                    </a>
                </li>
                <li>
                    <a href="datatutor.php">
                        <span class="icon"><i class="bi bi-people"></i></span>
                        <span class="title">Data Tutor</span>
                    </a>
                </li>
                <li>
                    <a href="datamapel.php">
                        <span class="icon"><i class="bi bi-book"></i></span>
                        <span class="title">Mata Pelajaran</span>
                    </a>
                </li>
                <li>
                    <a href="riwayatpemesanan.php">
                        <span class="icon"><i class="bi bi-clock-history"></i></span>
                        <span class="title">Riwayat Pemesanan</span>
                    </a>
                </li>
                <li>
                    <a href="pendapatantutor.php">
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
                <img src="images/tutor_male2.png">
            </div>
        </div>

        <!-- menampilkan data tutor -->
        <div class="col-md-12 p-5 pt-2">
            <h2><i class="bi bi-people"></i></i> DATA TUTOR </h2><hr>
            <a href="tutor/tambahdatatutor.php" class="btn btn-primary mb-3"><i class="fas fa-plus-square mr-2"></i>TAMBAH DATA TUTOR</a>
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th scope="col">NO</th>
                  <th scope="col">EMAIL</th>
                  <th scope="col">PASSWORD</th>
                  <th scope="col">NAMA</th>
                  <th scope="col">INSTANSI</th>
                  <th scope="col">NO HP</th>
                  <th scope="col">GENDER</th>
                  <th scope="col">ALAMAT</th>
                  <th scope="col">TGL LAHIR</th>
                  <th scope="col">PROFILE</th>
                  <th colspan="2" scope="col">AKSI</th>
                </tr>
              </thead>
              <tbody>
              <?php
                 $no = 1;
                 $query = "SELECT * FROM user_tutor";
                 $result = mysqli_query($koneksi, $query) or die (mysqli_error($koneksi));

                 while($row = mysqli_fetch_array($result)){ 
                        $id = $row['id_tutor'];
                        $email = $row['email'];
                        $password = $row['password'];
                        $fullname = $row['fullname_tutor'];
                        $instansi = $row['instansi'];
                        $notelp = $row['no_telp'];
                        $gender = $row['gender'];
                        $alamat = $row['alamat'];
                        $tgllahir = $row['tgl_lahir'];
                        $profile = $row['profile'];
                    ?>
                    <tr>
                        <td><?=$no++?></td>
                        <td><?php echo $email; ?></td>
                        <td><?php echo $password; ?></td>
                        <td><?php echo $fullname; ?></td>
                        <td><?php echo $instansi; ?></td>
                        <td><?php echo $notelp; ?></td>
                        <td><?php echo $gender; ?></td>
                        <td><?php echo $alamat; ?></td>
                        <td><?php echo $tgllahir; ?></td>
                        <td><img src="images/<?php echo $profile;?>" style="width: 80px; height:80px;"></td>
                        <td><a href="tutor/editdatatutor.php?id_tutor=<?php echo $row['id_tutor']; ?>" class="btn btn-success">Edit</a></td>
                        <td><a href="tutor/deletedatatutor.php?id_tutor=<?php echo $row['id_tutor']; ?>" onclick="return confirm('Anda yakin mau menghapus item ini ?')" class="btn btn-danger">Delete</a></td>
                    </tr>
                <?php
                 } ?>
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