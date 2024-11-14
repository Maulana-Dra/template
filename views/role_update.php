<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Role</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-100 to-indigo-200 font-sans leading-normal tracking-normal">

    <!-- Navbar -->
    <?php include 'includes/navbar.php'; ?>

    <!-- Main container -->
    <div class="flex">
        <!-- Sidebar -->
        <?php include 'includes/sidebar.php'; ?>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <!-- Formulir Update Role -->
            <div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-xl border border-gray-200">
                <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Update Role</h2>
                <form action="index.php?modul=role&fitur=update" method="POST">
                    <input type="hidden" name="role_id" value="<?= $roleData->role_id; ?>">

                    <!-- Nama Role -->
                    <div class="mb-4">
                        <label for="role_name" class="block text-gray-700 text-sm font-bold mb-2">Nama Role:</label>
                        <input type="text" id="role_name" name="role_name" class="shadow appearance-none border rounded-lg w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:shadow-lg transition" placeholder="Masukkan Nama Role" required value="<?= $roleData->role_name ?>">
                    </div>

                    <!-- Role Deskripsi -->
                    <div class="mb-4">
                        <label for="role_description" class="block text-gray-700 text-sm font-bold mb-2">Role Deskripsi:</label>
                        <textarea id="role_description" name="role_description" class="shadow appearance-none border rounded-lg w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:shadow-lg transition" placeholder="Masukkan Deskripsi Role" rows="3" required><?= $roleData->role_description ?></textarea>
                    </div>

                    <!-- Role Status -->
                    <div class="mb-6">
                        <label for="role_status" class="block text-gray-700 text-sm font-bold mb-2">Role Status:</label>
                        <select id="role_status" name="role_status" class="shadow appearance-none border rounded-lg w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:shadow-lg transition" required>
                            <option value="1" <?= $roleData->role_status == 1 ? 'selected' : '' ?>>Active</option>
                            <option value="0" <?= $roleData->role_status == 0 ? 'selected' : '' ?>>Inactive</option>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-center">
                        <button type="submit" class="bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-indigo-600 hover:to-blue-500 text-white font-bold py-2 px-8 rounded-lg shadow-lg transform hover:scale-105 transition">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
