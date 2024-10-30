<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Barang</title>
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
            <!-- Container Utama -->
            <div class="container mx-auto">
                <!-- Button untuk menambahkan Barang baru -->
                <div class="mb-4">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        <a href="views/barang_input.php">Insert New Barang</a>
                    </button>
                </div>

                <!-- Tabel Barang -->
                <div class="bg-white shadow-md rounded my-6">
                    <table class="min-w-full bg-white">
                        <thead class="bg-gray-800 text-white">
                            <tr>
                                <th class="w-1/12 py-3 px-4 uppercase font-semibold text-sm">ID</th>
                                <th class="w-1/4 py-3 px-4 uppercase font-semibold text-sm">Nama</th>
                                <th class="w-1/4 py-3 px-4 uppercase font-semibold text-sm">Harga</th>
                                <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Stok</th>
                                <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            <?php foreach($barangs as $barang) { ?>
                                <tr class="text-center">
                                    <td class="py-3 px-4 text-blue-600"><?php echo htmlspecialchars($barang->id) ?></td>
                                    <td class="w-1/4 py-3 px-4"><?php echo htmlspecialchars($barang->nama) ?></td>
                                    <td class="w-1/4 py-3 px-4"><?php echo htmlspecialchars(number_format($barang->harga, 0, ',', '.')) ?></td>
                                    <td class="w-1/6 py-3 px-4"><?php echo htmlspecialchars($barang->stok) ?></td>
                                    <td class="w-1/6 py-3 px-4">
                                        <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded mr-2">
                                            <a href="index.php?modul=barang&fitur=edit&id=<?php echo $barang->id ?>">Update</a>
                                        </button>
                                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded mr-2">
                                            <a href="index.php?modul=barang&fitur=delete&id=<?php echo $barang->id ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?')">Delete</a>
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