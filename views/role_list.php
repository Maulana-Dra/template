<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Role</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-indigo-100 to-blue-200 font-sans leading-normal tracking-normal">

<!-- Navbar -->
<?php include 'includes/navbar.php'; ?>

<!-- Main container -->
<div class="flex">
    <!-- Sidebar -->
    <?php include 'includes/sidebar.php'; ?>

    <!-- Main Content -->
    <div class="flex-1 p-8">
        <div class="container mx-auto">
            <!-- Button to Insert New Role -->
            <div class="flex justify-end mb-4">
                <button class="bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-indigo-600 hover:to-blue-500 text-white font-bold py-2 px-6 rounded-lg shadow-lg transform hover:scale-105 transition duration-300">
                    <a href="index.php?modul=role&fitur=input">Insert New Role</a>
                </button>
            </div>

            <!-- Roles Table -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden border border-gray-200">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="w-1/12 py-3 px-4 font-semibold text-sm uppercase tracking-wider text-center">Role ID</th>
                            <th class="w-1/4 py-3 px-4 font-semibold text-sm uppercase tracking-wider text-center">Role Name</th>
                            <th class="w-1/3 py-3 px-4 font-semibold text-sm uppercase tracking-wider text-center">Role Description</th>
                            <th class="w-1/6 py-3 px-4 font-semibold text-sm uppercase tracking-wider text-center">Role Status</th>
                            <th class="w-1/6 py-3 px-4 font-semibold text-sm uppercase tracking-wider text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 text-gray-700">
                        <?php foreach($roles as $role) { ?>
                            <tr class="text-center hover:bg-gray-100 transition-colors duration-200">
                                <td class="py-3 px-4 text-blue-600 font-medium"><?php echo htmlspecialchars($role->role_id) ?></td>
                                <td class="py-3 px-4"><?php echo htmlspecialchars($role->role_name) ?></td>
                                <td class="py-3 px-4"><?php echo htmlspecialchars($role->role_description) ?></td>
                                <td class="py-3 px-4"><?php echo htmlspecialchars($role->role_status == 1 ? 'Active' : 'Inactive') ?></td>
                                <td class="py-3 px-4">
                                    <button class="bg-green-500 hover:bg-green-600 text-white font-bold py-1 px-3 rounded-lg shadow-sm transition transform hover:scale-105 transition-transform duration-200">
                                        <a href="index.php?modul=role&fitur=edit&id=<?php echo $role->role_id ?>">Update</a>
                                    </button>
                                    <button class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded-lg shadow-sm transition transform hover:scale-105 transition-transform duration-200">
                                        <a href="index.php?modul=role&fitur=delete&id=<?php echo $role->role_id ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus role ini?')">Delete</a>
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
