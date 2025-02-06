<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Logo Brand -->
    <a href="br_admin.php" class="brand-link d-flex align-items-center justify-content-center">
        <i class="nav-icon fas fa-user mr-3"></i>
        <span class="brand-text font-weight-light"><?= $_SESSION['level'] ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar" style="overflow-y: auto; max-height: 100vh;">
        <!-- Panel Pengguna -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="../dist/img/nailong.jpg" class="img-circle elevation-2" alt="Foto Pengguna">
            </div>
            <div class="info">
                <a href="profil_adm.php" class="d-block"><?= $_SESSION['username'] ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="br_admin.php" class="nav-link active">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Data Master YANGBUJUURR -->
                <li class="nav-item menu-open">
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="dt_pengguna_adm.php" class="nav-link" data-page="dt_pengguna">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Pengguna</p>
                            </a>
                        </li>
                    </ul>
                </li> 
                <!-- Master Data -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-database"></i>
                        <p>
                            Data Master
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="dt_raperda_adm.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Raperda</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="dt_paripurna_adm.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Jadwal Rapat Paripurna</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="dt_kehadiran_adm.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kehadiran</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="dt_arsip_adm.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Arsip</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="dt_dinas_adm.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Anggota Dinas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="dt_karyawan_adm.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Karyawan</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Laporan -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>
                            Laporan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                    
                        <li class="nav-item">
                            <a href="laporan_kehadiran.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laporan Kehadiran</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="laporan_jadwal.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laporan Jadwal Rapat</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="laporan_hasil.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laporan Anggota Dinas</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="laporan_arsip.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laporan Arsip</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Ulasan -->
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


<script>
    document.addEventListener("DOMContentLoaded", function() {
        const navLinks = document.querySelectorAll(".nav-link");
        const currentPage = window.location.pathname.split("/").pop();

        navLinks.forEach(link => {
            const page = link.getAttribute("data-page");
            if (currentPage.includes(page)) {
                link.classList.add("active");
            } else {
                link.classList.remove("active");
            }
        });
    });
</script>