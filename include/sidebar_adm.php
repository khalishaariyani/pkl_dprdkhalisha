<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Logo Brand -->
    <a href="br_admin.php" class="brand-link d-flex align-items-center justify-content-center">
        <i class="nav-icon fas fa-user mr-3"></i>
        <span class="brand-text font-weight-light"><?= $_SESSION['level'] ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar" style="overflow-y: auto; max-height: 100vh;">
        <!-- Panel Pengguna -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex flex-column align-items-center">
            <div class="image">
                <img src="../dist/img/nailong.jpg" class="img-circle elevation-2 shadow" alt="Foto Pengguna">
            </div>
            <div class="info text-center">
                <a href="profil_adm.php" class="d-block"><?= $_SESSION['username'] ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="br_admin.php" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Data Master -->
                <!-- Data Pengguna (Dipisahkan dari Data Master, di bawah Dashboard) -->
                <li class="nav-item">
                    <a href="dt_pengguna_adm.php" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Data Pengguna</p>
                    </a>
                </li>

                <!-- Data Master -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-database"></i>
                        <p>Data Master <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a href="dt_raperda_adm.php" class="nav-link"><i class="far fa-circle nav-icon"></i> Raperda</a></li>
                        <li class="nav-item"><a href="dt_paripurna_adm.php" class="nav-link"><i class="far fa-circle nav-icon"></i> Jadwal Rapat Paripurna</a></li>
                        <li class="nav-item"><a href="dt_kehadiran_adm.php" class="nav-link"><i class="far fa-circle nav-icon"></i> Kehadiran</a></li>
                        <li class="nav-item"><a href="dt_arsip_adm.php" class="nav-link"><i class="far fa-circle nav-icon"></i> Arsip</a></li>
                        <li class="nav-item"><a href="dt_dinas_adm.php" class="nav-link"><i class="far fa-circle nav-icon"></i> Anggota Dinas</a></li>
                        <li class="nav-item"><a href="dt_karyawan_adm.php" class="nav-link"><i class="far fa-circle nav-icon"></i> Karyawan</a></li>
                    </ul>
                </li>


                <!-- Laporan -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>Laporan <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a href="laporan_kehadiran.php" class="nav-link"><i class="far fa-circle nav-icon"></i> Laporan Kehadiran</a></li>
                        <li class="nav-item"><a href="laporan_jadwal.php" class="nav-link"><i class="far fa-circle nav-icon"></i> Laporan Jadwal Rapat</a></li>
                        <li class="nav-item"><a href="laporan_hasil.php" class="nav-link"><i class="far fa-circle nav-icon"></i> Laporan Anggota Dinas</a></li>
                        <li class="nav-item"><a href="laporan_arsip.php" class="nav-link"><i class="far fa-circle nav-icon"></i> Laporan Arsip</a></li>
                    </ul>
                </li>

                <!-- Informasi Terbaru -->
                <li class="nav-item">
                    <a href="informasi_terbaru.php" class="nav-link">
                        <i class="nav-icon fas fa-comments"></i>
                        <p>Informasi Terbaru</p>
                    </a>
                </li>

                <!-- Logout -->
                <li class="nav-item">
                    <a href="../include/logout.php" class="nav-link bg-danger">
                        <i class="nav-icon fas fa-power-off"></i>
                        <p>Keluar</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>

<!-- CSS Tambahan -->
<style>
    /* Warna latar belakang sidebar */
    .main-sidebar {
        background: linear-gradient(135deg, #002b5e, #003a80);
    }

    /* Warna default menu sidebar */
    .nav-sidebar .nav-link {
        color: rgba(255, 255, 255, 0.8);
        transition: background 0.3s, color 0.3s;
    }

    /* Warna hover saat mouse diarahkan */
    .nav-sidebar .nav-link:hover {
        background: rgba(255, 255, 255, 0.1);
        color: white;
    }

    /* Warna menu yang aktif */
    .nav-sidebar .nav-item.active .nav-link {
        background: #002b5e;
        color: #ffc107;
        font-weight: bold;
        border-left: 5px solid #ffc107;
        transition: background 0.3s, color 0.3s;
    }

    /* Warna ikon menu aktif */
    .nav-sidebar .nav-item.active .nav-icon {
        color: #ffc107;
    }

    /* Warna ikon pada hover */
    .nav-sidebar .nav-link:hover .nav-icon {
        color: #ffc107;
    }

    /* Warna tombol logout */
    .bg-danger {
        background: linear-gradient(135deg, #dc3545, #a71d2a) !important;
    }

    /* Styling untuk foto pengguna */
    .user-panel {
        text-align: center;
        padding: 15px 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    }

    .user-panel .image img {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        border: 3px solid #fff;
        box-shadow: 0px 4px 8px rgba(255, 255, 255, 0.2);
        transition: transform 0.3s ease-in-out;
    }

    .user-panel .image img:hover {
        transform: scale(1.1);
    }

    .user-panel .info a {
        color: #fff;
        font-weight: bold;
        font-size: 16px;
        display: block;
        margin-top: 8px;
    }
</style>

<!-- Script untuk menandai menu aktif -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const navLinks = document.querySelectorAll(".nav-link");
        const currentPage = window.location.pathname.split("/").pop();

        navLinks.forEach(link => {
            if (link.href.includes(currentPage)) {
                link.classList.add("active");
            } else {
                link.classList.remove("active");
            }
        });
    });
</script>