<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Barang</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-gray-100 to-gray-200 font-sans leading-normal tracking-normal">

    <!-- Navbar -->
    <?php include 'includes/navbar.php'; ?>

    <!-- Main container -->
    <div class="flex">
        <!-- Sidebar -->
        <?php include 'includes/sidebar.php'; ?>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <!-- Formulir Update Barang -->
            <div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-xl border border-gray-200">
                <h2 class="text-3xl font-semibold mb-6 text-gray-800 text-center">Update Barang</h2>
                <form action="index.php?modul=barang&fitur=update" method="POST">
                    <input type="hidden" name="id" value="<?= $barang->id; ?>">
                    
                    <!-- Nama Barang -->
                    <div class="mb-6">
                        <label for="nama" class="block text-gray-700 text-sm font-bold mb-2">Nama Barang:</label>
                        <input type="text" id="nama" name="nama" class="shadow-md appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan Nama Barang" required value="<?= $barang->nama ?>">
                    </div>

                    <!-- Harga Barang -->
                    <div class="mb-6">
                        <label for="harga" class="block text-gray-700 text-sm font-bold mb-2">Harga Barang:</label>
                        <input type="number" id="harga" name="harga" class="shadow-md appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan Harga Barang" required value="<?= $barang->harga ?>">
                    </div>

                    <!-- Stok Barang -->
                    <div class="mb-6">
                        <label for="stok" class="block text-gray-700 text-sm font-bold mb-2">Stok Barang:</label>
                        <input type="number" id="stok" name="stok" class="shadow-md appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 bg-gray-100 leading-tight focus:outline-none focus:shadow-outline" placeholder="Masukkan Stok Barang" required value="<?= $barang->stok ?>" readonly>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-center">
                        <button type="submit" class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-bold py-3 px-6 rounded-lg shadow-lg transform hover:scale-105 transition duration-300">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
