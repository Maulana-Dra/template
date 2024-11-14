<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Role</title>
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
            <!-- Formulir Input Role -->
            <div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-2xl border border-gray-200">
                <h2 class="text-3xl font-semibold mb-6 text-gray-800 text-center">Input Role</h2>
                <form action="index.php?modul=role&fitur=add" method="POST">
                    <!-- Nama Role -->
                    <div class="mb-6">
                        <label for="role_name" class="block text-gray-700 text-sm font-bold mb-2">Nama Role:</label>
                        <input type="text" id="role_name" name="role_name" class="shadow-md appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-400" autocomplete="off" placeholder="Masukkan Nama Role" required>
                    </div>

                    <!-- Role Deskripsi -->
                    <div class="mb-6">
                        <label for="role_description" class="block text-gray-700 text-sm font-bold mb-2">Role Deskripsi:</label>
                        <textarea id="role_description" name="role_description" class="shadow-md appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-400" placeholder="Masukkan Deskripsi Role" rows="3" required></textarea>
                    </div>

                    <!-- Role Status -->
                    <div class="mb-6">
                        <label for="role_status" class="block text-gray-700 text-sm font-bold mb-2">Role Status:</label>
                        <select id="role_status" name="role_status" class="shadow-md appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
                            <option value="">Pilih Status</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-center">
                        <button type="submit" class="bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-indigo-600 hover:to-indigo-700 text-white font-bold py-3 px-6 rounded-lg shadow-lg transform hover:scale-105 transition duration-300">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
