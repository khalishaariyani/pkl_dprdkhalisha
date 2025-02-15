<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Logo Brand -->
    <a href="br_admin.php" class="brand-link d-flex align-items-center justify-content-center">
        <i class="nav-icon fas fa-user mr-3"></i>
        <span class="brand-text font-weight-light"><?= $_SESSION['level'] ?></span>
    </a>
    <!-- Panel Pengguna -->
    <div class="sidebar" style="overflow-y: auto; max-height: 100vh;">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex flex-column align-items-center">
            <div class="image">
                <img src="<?= htmlspecialchars($user_data['gambar'] ?? '../dist/img/nailong.jpg') ?>"
                    class="img-circle elevation-2 shadow" alt="Foto Pengguna">
            </div>
            <div class="info text-center">
                <a href="profil.php" class="d-block font-weight-bold"><?= $_SESSION['username'] ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="br_member.php" class="nav-link active">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Jadwal Rapat -->
                <li class="nav-item">
                    <a href="jadwal_anggota.php" class="nav-link">
                        <i class="nav-icon fas fa-calendar-alt"></i>
                        <p>Jadwal Rapat</p>
                    </a>
                </li>

                <!-- Informasi Terbaru -->
                <li class="nav-item">
                    <a href="info.php" class="nav-link">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>Informasi Terbaru</p>
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

<!-- CSS untuk Tampilan Seperti Foto yang Anda Berikan -->
<style>
    /* Warna sidebar sesuai dengan gambar */
    .main-sidebar {
        background: linear-gradient(135deg, #001f3f, #003a80);
    }

    /* Panel Pengguna */
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

    /* Warna menu sidebar */
    .nav-sidebar .nav-link {
        color: rgba(255, 255, 255, 0.8);
        transition: background 0.3s, color 0.3s;
        font-weight: bold;
    }

    /* Warna menu aktif (Dashboard, Data Master, dll.) */
    .nav-sidebar .nav-link.active {
        background: #007bff;
        color: white;
        font-weight: bold;
        border-radius: 5px;
    }

    /* Warna hover */
    .nav-sidebar .nav-link:hover {
        background: rgba(255, 255, 255, 0.1);
        color: white;
    }

    /* Warna ikon */
    .nav-sidebar .nav-icon {
        color: rgba(255, 255, 255, 0.8);
    }

    /* Warna ikon aktif */
    .nav-sidebar .nav-item.active .nav-icon {
        color: white;
    }

    /* Warna tombol Logout */
    .bg-danger {
        background: linear-gradient(135deg, #dc3545, #a71d2a) !important;
        font-weight: bold;
    }
</style>

<!-- Script untuk Menandai Menu Aktif -->
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