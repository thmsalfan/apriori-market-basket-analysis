<?php
include_once "database.php";
include_once "koneksi.php";
include_once "fungsi.php";

$nama = $_SESSION['apriori_nama'];
$level = $_SESSION['apriori_level']; // Diasumsikan ini menyimpan level pengguna

$menu_active = '';
if (isset($_GET['menu'])) {
    $menu_active = $_GET['menu'];
}
?>


<div id="sidebar" class="sidebar responsive ace-save-state">
    <script type="text/javascript">
        try {
            ace.settings.loadState('sidebar');
        } catch (e) {}
    </script>
    <ul class="nav nav-list">
        <li <?php echo ($menu_active == 'akun_split') ? "class='active'" : ""; ?>>
            <a href="index.php?menu=akun_split">
                <i class="menu-icon fa fa-user"></i>
                <span class="menu-text"> Hi, <?php echo "$nama" ?> </span>
            </a>
            <b class="arrow"></b>
        </li>

        <li <?php echo ($menu_active == '') ? "class='active'" : ""; ?>>
            <a href="index.php">
                <i class="menu-icon fa fa-home"></i>
                <span class="menu-text"> Beranda </span>
            </a>
            <b class="arrow"></b>
        </li>

        <?php if ($level == 2): // Menu untuk pengguna biasa ?>
            <li <?php echo ($menu_active == 'hasil_split') ? "class='active'" : ""; ?>>
                <a href="index.php?menu=hasil_split">
                    <i class="menu-icon fa fa-book"></i>
                    <span class="menu-text"> Hasil </span>
                </a>
                <b class="arrow"></b>
            </li>

        <?php elseif ($level == 1): // Menu untuk admin ?>
            <li <?php echo ($menu_active == 'data_transaksi') ? "class='active'" : ""; ?>>
                <a href="index.php?menu=data_transaksi">
                    <i class="menu-icon fa fa-database"></i>
                    <span class="menu-text"> Data </span>
                </a>
                <b class="arrow"></b>
            </li>

            <li <?php echo ($menu_active == 'proses_apriori') ? "class='active'" : ""; ?>>
                <a href="index.php?menu=proses_apriori">
                    <i class="menu-icon fa fa-cogs"></i>
                    <span class="menu-text"> Proses </span>
                </a>
                <b class="arrow"></b>
            </li>

            <li <?php echo ($menu_active == 'hasil_split') ? "class='active'" : ""; ?>>
                <a href="index.php?menu=hasil_split">
                    <i class="menu-icon fa fa-book"></i>
                    <span class="menu-text"> Hasil </span>
                </a>
                <b class="arrow"></b>
            </li>
        <?php endif; ?>

        <li class="signout" onclick="return confirm('Apakah anda yakin ingin keluar?')">
            <a href="logout.php">
                <i class="menu-icon fa fa-sign-out"></i>
                <span class="menu-text">Logout</span>
            </a>
            <b class="arrow"></b>
        </li>
    </ul>

    <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
        <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" 
           data-icon1="ace-icon fa fa-angle-double-left" 
           data-icon2="ace-icon fa fa-angle-double-right"></i>
    </div>
</div>
