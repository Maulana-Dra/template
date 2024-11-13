<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List User</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <!-- Navbar -->
    <?php include 'includes/navbar.php'; ?>

    <!-- Main container -->
    <div class="flex">
        <!-- Sidebar -->
        <?php include 'includes/sidebar.php'; ?>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <div class="container mx-auto">
                <!-- Button to Insert New User -->
                <div class="mb-4">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        <a href="index.php?modul=user&fitur=input">Insert New User</a>
                    </button>
                </div>

                <!-- Users Table -->
                <div class="bg-white shadow-md rounded my-6">
                    <table class="min-w-full bg-white">
                        <thead class="bg-gray-800 text-white">
                            <tr>
                                <th class="w-1/12 py-3 px-4 uppercase font-semibold text-sm">User  ID</th>
                                <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Username</th>
                                <th class="w-1/4 py-3 px-4 uppercase font-semibold text-sm">Role Name</th>
                                <th class="w-1/3 py-3 px-4 uppercase font-semibold text-sm">Status</th>
                                <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            <?php 
                            // Inisialisasi RoleModel
                            $roleModel = new Role_model(); // Pastikan RoleModel diinisialisasi

                            foreach ($users as $user) { 
                                // Mengambil role berdasarkan role_id
                                $role = $roleModel->getRoleById($user->role_id); // Pastikan $roleModel diinisialisasi sebelumnya
                            ?>
                                <tr class="text-center">
                                    <td class="py-3 px-4 text-blue-600"><?php echo htmlspecialchars($user->user_id); ?></td>
                                    <td class="py-3 px-4"><?php echo htmlspecialchars($user->user_name); ?></td>
                                    <td class="py-3 px-4"><?php echo htmlspecialchars($role ? $role->role_name : 'Unknown Role'); ?></td>
                                    <td class="py-3 px-4"><?php echo $role ? ($role->role_status ? 'Active' : 'Inactive') : 'Unknown Status'; ?></td>
                                    <td class="py-3 px-4">
                                        <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded mr-2">
                                            <a href="index.php?modul=user&fitur=edit&id=<?php echo $user->user_id; ?>">Update</a>
                                        </button>
                                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded mr-2">
                                            <a href="index.php?modul=user&fitur=delete&id=<?php echo $user->user_id; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">Delete</a>
                                        </button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>