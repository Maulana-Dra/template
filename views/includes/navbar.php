
<?php
// Pastikan session sudah dimulai

// Pastikan model User dan Role sudah diimport
require_once $_SERVER['DOCUMENT_ROOT'] . '/TEMPLATE/model/user_model.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/TEMPLATE/model/role_model.php';

// Cek apakah user sudah login
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
$roleName = '';

// Ambil role berdasarkan role_id dari session
if (isset($_SESSION['role_id'])) {
    $roleModel = new Role_model();
    $role = $roleModel->getRoleById($_SESSION['role_id']);
    if ($role) {
        $roleName = $role->role_name;
    }
}
?>

<nav class="bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 p-4 shadow-lg transition-all duration-300">
    <div class="container mx-auto flex justify-between items-center">
        <div class="text-white font-bold text-2xl tracking-wider">
            <i class="fas fa-store mr-2"></i>Market Gacor Abiezzz
        </div>
        <div class="text-white flex items-center space-x-4">
            <span class="text-lg font-semibold transition-transform duration-200 hover:scale-105">
                <i class="fas fa-user mr-1"></i><?= htmlspecialchars($username); ?>
            </span>
            <span class="text-lg font-semibold transition-transform duration-200 hover:scale-105">
                <i class="fas fa-user-tag mr-1"></i><?= htmlspecialchars($roleName); ?>
            </span>
            <a href="logout.php">
                <button class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-full transition-transform duration-200 hover:scale-105 shadow-lg">
                    <i class="fas fa-sign-out-alt mr-1"></i>Logout
                </button>
            </a>
        </div>
    </div>
</nav>

<!-- Pastikan untuk menyertakan Font Awesome untuk ikon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
