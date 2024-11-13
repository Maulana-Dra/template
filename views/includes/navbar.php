
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

<nav class="bg-blue-600 p-4 shadow-lg">
    <div class="container mx-auto flex justify-between items-center">
        <div class="text-white font-bold text-xl">
            My Application
        </div>
        <div class="text-white">
            <span class="mr-4"><?= htmlspecialchars($username); ?></span>
            <span class="mr-4"><?= htmlspecialchars($roleName); ?></span>
            <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                <a href="logout.php">Logout</a>
            </button>
        </div>
    </div>
</nav>
