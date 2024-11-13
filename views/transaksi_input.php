<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Baru</title>
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
            <h2 class="text-2xl font-bold mb-4">Transaksi Baru</h2>
            
            <form action="index.php?modul=transaksi&fitur=add" method="POST" id="transaksiForm">
                <div class="mb-4">
                    <label for="customer" class="block text-gray-700">Customer</label>
                    <select id="customer" name="customer" class="mt-1 p-2 border border-gray-300 rounded w-1/3" required>
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

                <h3 class="text-xl font-semibold mb-2">Detail Barang</h3>
                <div id="barangContainer">
                    <div class="barang-item mb-4">
                        <div class="grid grid-cols-3 gap-4">
                            <div>
                                <label for="barang[]" class="block text-gray-700">Barang</label>
                                <select name="barang[]" class="mt-1 p-2 border border-gray-300 rounded w-full" required>
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
                                <label for="jumlah[]" class="block text-gray-700">Jumlah</label>
                                <input type="number" name="jumlah[]" class="mt-1 p-2 border border-gray-300 rounded w-full" min="1" required>
                            </div>
                            <div>
                                <button type="button" class="mt-6 bg-red-500 text-white p-2 rounded remove-item">Hapus</button>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" id="addBarangBtn" class="bg-blue-500 text-white p-2 rounded mt-2">Tambah Barang</button>

                <!-- Total Bayar -->
                <div class="mt-6">
                    <label for="total" class="block text-gray-700">Total Bayar</label>
                    <input type="number" id="total" name="total" class="mt-1 p-2 border border-gray-300 rounded w-1/3" readonly>
                </div>

                <!-- Bayar -->
                <div class="mt-4">
                    <label for="bayar" class="block text-gray-700">Bayar</label>
                    <input type="number" id="bayar" name="bayar" class="mt-1 p-2 border border-gray-300 rounded w-1/3" required>
                </div>

                <!-- Kembalian -->
                <div class="mt-4">
                    <label for="kembalian" class="block text-gray-700">Kembalian</label>
                    <input type="number" id="kembalian" name="kembalian" class="mt-1 p-2 border border-gray-300 rounded w-1/3" readonly>
                </div>

                <div class="mt-6">
                    <button type="submit" class="bg-green-500 text-white p-2 rounded">Simpan Transaksi</button>
                </div>
            </form>
        </div>
    </div>

    <script>
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

        // Update input total
        document.getElementById('total').value = total;

        // Hanya update kembalian jika sudah ada nilai di input bayar
        const bayar = parseInt(document.getElementById('bayar').value) || 0;
        if (bayar > 0) {
            const kembalian = bayar - total;
            document.getElementById('kembalian').value = kembalian;
        } else {
            // Reset kembalian jika bayar belum diisi
            document.getElementById('kembalian').value = '';
        }
    }

    // Event Listener untuk update total saat memilih barang atau mengubah jumlah
    function attachEventListeners() {
        const barangSelects = document.querySelectorAll('select[name="barang[]"]');
        const jumlahInputs = document.querySelectorAll('input[name="jumlah[]"]');

        barangSelects.forEach(select => select.addEventListener('change', updateTotal));
        jumlahInputs.forEach(input => input.addEventListener('input', updateTotal));
    }

    // Tambah barang baru
    document.getElementById('addBarangBtn').addEventListener('click', function () {
        const barangContainer = document.getElementById('barangContainer');
        const newBarang = document.querySelector('.barang-item').cloneNode(true);

        // Reset nilai pada barang baru
        newBarang.querySelector('select[name="barang[]"]').value = '';
        newBarang.querySelector('input[name="jumlah[]"]').value = '';

        barangContainer.appendChild(newBarang);
        attachEventListeners();
    });

    // Hapus barang
    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('remove-item')) {
            const barangItems = document.querySelectorAll('.barang-item');
            if (barangItems.length > 1) {
                event.target.closest('.barang-item').remove();
                updateTotal(); // Update total setelah item dihapus
            } else {
                alert('Minimal satu barang harus ada dalam transaksi.');
            }
        }
    });

    // Update kembalian ketika input bayar diisi
    document.getElementById('bayar').addEventListener('input', function () {
        updateTotal();
    });

    // Cek saat submit form
    document.getElementById('transaksiForm').addEventListener('submit', function (event) {
        const total = parseInt(document.getElementById('total').value) || 0;
        const bayar = parseInt(document.getElementById('bayar').value) || 0;
        const kembalian = bayar - total;

        if (kembalian < 0) {
            alert('Uang Anda tidak mencukupi untuk membayar total transaksi!');
            event.preventDefault(); // Mencegah form terkirim
        }
        
    });


    // Initial attach of event listeners
    attachEventListeners();

    </script>

</body>
</html>