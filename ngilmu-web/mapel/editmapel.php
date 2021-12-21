<?php
require('../koneksi.php');

session_start();

if(!isset($_SESSION['id_admin'])) {
    $_SESSION['msg'] = 'anda harus login untuk mengakses halaman ini';
    header('Location: index.php');
}
$sesID = $_SESSION['id_admin'];
$sesName = $_SESSION['email'];  

if (isset($_POST['update'])) {
//    $id = $_POST['id_tutor'];
    $idtutor = $_POST['id_tutor'];
    $mapel = $_POST['mata_pelajaran'];
    $jenjang = $_POST['jenjang'];
   $query = "UPDATE tabel_mapel VALUES ('','$idtutor','$mapel','$jenjang')";
   $result = mysqli_query($koneksi, $query);
   header('Location: ../datamapel.php');
}

    $id_mapel = $_GET['id_mapel'];
    $query = "SELECT * FROM tabel_mapel WHERE id_mapel='$id_mapel'";
    $result = mysqli_query($koneksi, $query) or die (mysql_error());
    $no = 1;
    while ($row = mysqli_fetch_array($result)){
        $idtutor = $row['id_tutor'];
        $mapel = $row['mata_pelajaran'];
        $jenjang = $row['jenjang'];

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Data Mapel</title>
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
            <button class="dropdown-toggle btn btn-sm " type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?php echo $_SESSION['email'] ?>   
            <!-- Profile -->
            </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <li><a class="dropdown-item" href="editprofile.php">Edit Profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="logout.php" onclick="return confirm('Anda yakin mau logout ?')">Logout</a></li>
                </ul>
            </div>
            <!-- userImg -->
            <div class="user">
                <img src="../images/img1.jpg">
            </div>
        </div>

        <div class="col-md-12 p-5 pt-2">
            <h2><i class="bi bi-person"></i></i> EDIT DATA MAPEL </h2><hr>
            <!-- <a href="siswa/editdatamapel.php" class="btn btn-primary mb-3"><i class="fas fa-plus-square mr-2"></i>TAMBAH DATA SISWA</a> -->
            <div class="col-12">
                <form id="form_validation" method="POST">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">ID Tutor</label>
                                    <input type="text" class="form-control" name="id_tutor" value="<?php echo $idtutor;?>" required>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Mapel</label>
                                    <input type="text" class="form-control" name="mata_pelajaran" value="<?php echo $mapel;?>" required>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Jenjang</label>
                                    <input type="text" class="form-control" name="jenjang" value="<?php echo $jenjang;?>" required>
                                </div>
                            <button class="btn btn-primary" type="submit" name="update">Simpan Perubahan</button>
                            <a href="../datamapel.php">
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