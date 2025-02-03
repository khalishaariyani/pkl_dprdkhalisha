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
                <img src="<?= htmlspecialchars($user_data['gambar'] ?? '../dist/img/nailong.jpg') ?>" 
                    class="img-circle elevation-2" alt="Foto Pengguna">
            </div>
            <div class="info">
                <a href="profil.php" class="d-block"><?= $_SESSION['username'] ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="br_member.php" class="nav-link" data-page="br_member.php">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Pengajuan Berkas -->
                <li class="nav-item">
                    <a href="#" class="nav-link" data-page="data_master">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Manajemen Anggota
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="br_absensi_rapat.php" class="nav-link" data-page="br_absensi_rapat.php">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Absesi Rapat </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="status_kehadiran.php" class="nav-link" data-page="status_kehadiran.php">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Status Kehadiran</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="dokumen_rapat.php" class="nav-link" data-page="dokumen_rapat.php">
                                <i class="far fa-circle nav-icon"></i>
                                <p> Dokumen Rapat</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Survey -->
                <li class="nav-item">
                    <a href="survey.php" class="nav-link" data-page="survey.php">
                        <i class="nav-icon fas fa-comments"></i>
                        <p>Tautan untuk Aksi Lainnya</p>
                    </a>
                </li>

                <!-- Logout -->
                <li class="nav-item">
                    <a href="../include/logout.php" class="nav-link bg-danger" onclick="return confirmLogout();">
                        <i class="nav-icon fas fa-power-off"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const currentPage = window.location.pathname.split("/").pop();
        const navItems = document.querySelectorAll(".nav-item");

        navItems.forEach(item => {
            const subLinks = item.querySelectorAll("a[data-page]");
            subLinks.forEach(subLink => {
                if (subLink.getAttribute("data-page") === currentPage) {
                    subLink.classList.add("active");
                    item.classList.add("menu-open");
                }
            });
        });
    });

    function confirmLogout() {
        return confirm("Apakah Anda yakin ingin keluar?");
    }
</script>
