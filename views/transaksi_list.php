

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Transaksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Script untuk mengaktifkan dan menutup modal
        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
        }
    </script>
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
                <!-- Transaksi Table -->
                <div class="bg-white shadow-lg rounded-lg overflow-hidden border border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="w-1/12 py-3 px-4 font-semibold text-sm uppercase tracking-wider text-center">ID Transaksi</th>
                            <th class="w-1/4 py-3 px-4 font-semibold text-sm uppercase tracking-wider text-center">Customer</th>
                            <th class="w-1/4 py-3 px-4 font-semibold text-sm uppercase tracking-wider text-center">Kasir</th>
                            <th class="w-1/6 py-3 px-4 font-semibold text-sm uppercase tracking-wider text-center">Total</th>
                            <th class="w-1/6 py-3 px-4 font-semibold text-sm uppercase tracking-wider text-center">Tanggal</th> <!-- Menambahkan kolom Tanggal -->
                            <th class="w-1/6 py-3 px-4 font-semibold text-sm uppercase tracking-wider text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 text-gray-700">
                    <?php if (!empty($transaksiList)) { 
                        foreach ($transaksiList as $transaksi) { 
                            // Menghitung total untuk setiap transaksi
                            $grandTotal = 0;
                            foreach ($transaksi->barangs as $index => $barang) { 
                                $subtotal = $barang->harga * $transaksi->jumlahs[$index];
                                $grandTotal += $subtotal; // Menjumlahkan subtotal
                            }
                            ?>
                            <tr class="text-center hover:bg-gray-100 transition-colors duration-200">
                                <td class="py-3 px-4 text-blue-600 font-medium"><?php echo htmlspecialchars($transaksi->idTransaksi); ?></td>
                                <td class="py-3 px-4"><?php echo htmlspecialchars($transaksi->customer->user_name); ?></td>
                                <td class="py-3 px-4"><?php echo htmlspecialchars($transaksi->kasir->user_name); ?></td>
                                <td class="py-3 px-4">Rp<?php echo number_format($grandTotal, 0, ',', '.'); ?></td>
                                <td class="py-3 px-4"><?php echo htmlspecialchars($transaksi->tanggal); ?></td> <!-- Menampilkan tanggal -->
                                <td class="py-3 px-4">
                                    <button 
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded" 
                                        onclick="openModal('modal-<?php echo $transaksi->idTransaksi; ?>')">
                                        View Details
                                    </button>
                                </td>
                            </tr>
                        <?php } 
                    } else { ?>
                        <tr>
                            <td colspan="6" class="text-center hover:bg-gray-100 transition-colors duration-200">Tidak ada transaksi yang ditemukan.</td>
                        </tr>
                    <?php } ?>
                    </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal untuk detail transaksi -->
    <!-- Modal untuk detail transaksi -->
<?php if (!empty($transaksiList)) {
    foreach ($transaksiList as $transaksi) { ?>
    <div id="modal-<?php echo $transaksi->idTransaksi; ?>" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-1/2 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg font-medium text-gray-900">Detail Transaksi: <?php echo htmlspecialchars($transaksi->idTransaksi); ?></h3>
                <div class="mt-4">
                    <table class="min-w-full bg-white">
                        <thead class="bg-gray-800 text-white">
                            <tr>
                                <th class="w-1/2 py-3 px-4 uppercase font-semibold text-sm">Barang</th>
                                <th class="w-1/4 py-3 px-4 uppercase font-semibold text-sm">Jumlah</th>
                                <th class="w-1/4 py-3 px-4 uppercase font-semibold text-sm">Harga Satuan</th>
                                <th class="w-1/4 py-3 px-4 uppercase font-semibold text-sm">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            <?php 
                            $grandTotal = 0;
                            foreach ($transaksi->barangs as $index => $barang) { 
                                $subtotal = $barang->harga * $transaksi->jumlahs[$index];
                                $grandTotal += $subtotal; ?>
                                <tr class="text-center border-b">
                                    <td class="py-3 px-4"><?php echo htmlspecialchars($barang->nama); ?></td>
                                    <td class="py-3 px-4"><?php echo htmlspecialchars($transaksi->jumlahs[$index]); ?></td>
                                    <td class="py-3 px-4">Rp<?php echo number_format($barang->harga, 0, ',', '.'); ?></td>
                                    <td class="py-3 px-4">Rp<?php echo number_format($subtotal, 0, ',', '.'); ?></td>
                                </tr>
                            <?php } ?>
                            <tr class="text-center font-bold">
                                <td colspan="3" class="py-3 px-4">Total</td>
                                <td class="py-3 px-4">Rp<?php echo number_format($grandTotal, 0, ',', '.'); ?></td>
                            </tr>
                            <!-- Tampilkan informasi Bayar dan Kembalian -->
                            <tr class="text-center font-bold">
                                <td colspan="3" class="py-3 px-4">Bayar</td>
                                <td class="py-3 px-4">Rp<?php echo number_format($transaksi->bayar, 0, ',', '.'); ?></td>
                            </tr>
                            <tr class="text-center font-bold">
                                <td colspan="3" class="py-3 px-4">Kembalian</td>
                                <td class="py-3 px-4">Rp<?php echo number_format($transaksi->kembalian, 0, ',', '.'); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    <button
                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                        onclick="closeModal('modal-<?php echo $transaksi->idTransaksi; ?>')">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php } } ?>


</body>
</html>