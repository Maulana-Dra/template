<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Baru</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-100 to-indigo-200 font-sans leading-normal tracking-normal text-gray-900">

    <!-- Navbar -->
    <?php include 'includes/navbar.php'; ?>

    <!-- Main container -->
    <div class="flex">
        <!-- Sidebar -->
        <?php include 'includes/sidebar.php'; ?>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <h2 class="text-3xl font-bold mb-6 text-center text-indigo-800">Transaksi Baru</h2>
            
            <form action="index.php?modul=transaksi&fitur=add" method="POST" id="transaksiForm" class="bg-white p-6 rounded-lg shadow-lg max-w-2xl mx-auto">
                <!-- Customer Selection -->
                <div class="mb-4">
                    <label for="customer" class="block font-semibold text-gray-700">Customer</label>
                    <select id="customer" name="customer" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:ring-2 focus:ring-indigo-500" required>
                        <option value="" disabled selected>Pilih Customer</option>
                        <?php
                        if (!empty($customers)) {
                            foreach ($customers as $customer) {
                                echo "<option value='{$customer->user_id}'>{$customer->user_name}</option>";
                            }
                        } else {
                            echo "<option value='' disabled>Tidak ada customer tersedia</option>";
                        }
                        ?>
                    </select>
                </div>

                <!-- Detail Barang -->
                <h3 class="text-xl font-semibold mb-4 text-indigo-700">Detail Barang</h3>
                <div id="barangContainer">
                    <div class="barang-item mb-4 bg-gray-100 p-4 rounded-lg shadow-sm">
                        <div class="grid grid-cols-3 gap-4">
                            <div>
                                <label for="barang[]" class="block font-semibold text-gray-700">Barang</label>
                                <select name="barang[]" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:ring-2 focus:ring-indigo-500" required>
                                    <option value="" disabled selected>Pilih Barang</option>
                                    <?php
                                    if (!empty($barangs)) {
                                        foreach ($barangs as $barang) {
                                            echo "<option value='{$barang->id}'>{$barang->nama} - Rp{$barang->harga}</option>";
                                        }
                                    } else {
                                        echo "<option value='' disabled>Tidak ada barang tersedia</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div>
                                <label for="jumlah[]" class="block font-semibold text-gray-700">Jumlah</label>
                                <input type="number" name="jumlah[]" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:ring-2 focus:ring-indigo-500" min="1" required>
                            </div>
                            <div class="flex items-center">
                                <button type="button" class="mt-5 bg-red-500 text-white p-2 rounded-lg shadow-md remove-item hover:bg-red-700 transition">Hapus</button>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" id="addBarangBtn" class="bg-blue-500 text-white p-3 rounded-lg mt-4 shadow-md hover:bg-blue-700 transition w-full">Tambah Barang</button>

                <!-- Total Bayar -->
                <div class="mt-6">
                    <label for="total" class="block font-semibold text-gray-700">Total Bayar</label>
                    <input type="number" id="total" name="total" class="mt-2 p-3 border border-gray-300 rounded-lg w-full bg-gray-100" readonly>
                </div>

                <!-- Bayar -->
                <div class="mt-4">
                    <label for="bayar" class="block font-semibold text-gray-700">Bayar</label>
                    <input type="number" id="bayar" name="bayar" class="mt-2 p-3 border border-gray-300 rounded-lg w-full focus:ring-2 focus:ring-indigo-500" required>
                </div>

                <!-- Kembalian -->
                <div class="mt-4">
                    <label for="kembalian" class="block font-semibold text-gray-700">Kembalian</label>
                    <input type="number" id="kembalian" name="kembalian" class="mt-2 p-3 border border-gray-300 rounded-lg w-full bg-gray-100" readonly>
                </div>

                <!-- Submit Button -->
                <div class="mt-6 text-center">
                    <button type="submit" class="bg-green-500 text-white font-bold py-3 px-6 rounded-lg shadow-lg hover:bg-green-700 transition w-full">Simpan Transaksi</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Functionality remains the same as in your script
        function updateTotal() {
            let total = 0;
            const barangSelects = document.querySelectorAll('select[name="barang[]"]');
            const jumlahInputs = document.querySelectorAll('input[name="jumlah[]"]');

            barangSelects.forEach((select, index) => {
                const selectedOption = select.options[select.selectedIndex];
                const harga = selectedOption.text.includes('- Rp') ? parseInt(selectedOption.text.split('- Rp')[1]) : 0;
                const jumlah = parseInt(jumlahInputs[index].value) || 0;
                total += harga * jumlah;
            });

            document.getElementById('total').value = total;

            const bayar = parseInt(document.getElementById('bayar').value) || 0;
            if (bayar > 0) {
                const kembalian = bayar - total;
                document.getElementById('kembalian').value = kembalian;
            } else {
                document.getElementById('kembalian').value = '';
            }
        }

        function attachEventListeners() {
            const barangSelects = document.querySelectorAll('select[name="barang[]"]');
            const jumlahInputs = document.querySelectorAll('input[name="jumlah[]"]');

            barangSelects.forEach(select => select.addEventListener('change', updateTotal));
            jumlahInputs.forEach(input => input.addEventListener('input', updateTotal));
        }

        document.getElementById('addBarangBtn').addEventListener('click', function () {
            const barangContainer = document.getElementById('barangContainer');
            const newBarang = document.querySelector('.barang-item').cloneNode(true);

            newBarang.querySelector('select[name="barang[]"]').value = '';
            newBarang.querySelector('input[name="jumlah[]"]').value = '';

            barangContainer.appendChild(newBarang);
            attachEventListeners();
        });

        document.addEventListener('click', function (event) {
            if (event.target.classList.contains('remove-item')) {
                const barangItems = document.querySelectorAll('.barang-item');
                if (barangItems.length > 1) {
                    event.target.closest('.barang-item').remove();
                    updateTotal();
                } else {
                    alert('Minimal satu barang harus ada dalam transaksi.');
                }
            }
        });

        document.getElementById('bayar').addEventListener('input', function () {
            updateTotal();
        });

        document.getElementById('transaksiForm').addEventListener('submit', function (event) {
            const total = parseInt(document.getElementById('total').value) || 0;
            const bayar = parseInt(document.getElementById('bayar').value) || 0;
            const kembalian = bayar - total;

            if (kembalian < 0) {
                alert('Uang Anda tidak mencukupi untuk membayar total transaksi!');
                event.preventDefault();
            }
        });

        attachEventListeners();
    </script>

</body>
</html>
