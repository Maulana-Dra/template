<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Role</title>
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
        <!-- Your main content goes here -->
        <div class="container mx-auto">
            <!-- Button to Insert New Role -->
            <div class="mb-4">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    <a href="views/role_input.php">
                        <div class="flex items-center">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.94 18.339L7.51 20.8869C7.26537 21.0782 6.9732 21.1993 6.66487 21.2372C6.35654 21.2751 6.0437 21.2284 5.75995 21.102C5.4762 20.9757 5.23225 20.7745 5.05432 20.5201C4.87638 20.2656 4.77118 19.9676 4.75 19.6579V6.34928C4.78647 5.35977 5.21452 4.42518 5.94014 3.75077C6.66575 3.07636 7.6296 2.71726 8.62 2.75235H15.38C16.3704 2.71726 17.3342 3.07636 18.0599 3.75077C18.7855 4.42518 19.2135 5.35977 19.25 6.34928V19.6579C19.2288 19.9676 19.1236 20.2656 18.9457 20.5201C18.7677 20.7745 18.5238 20.9757 18.24 21.102C17.9563 21.2284 17.6435 21.2751 17.3351 21.2372C17.0268 21.1993 16.7346 21.0782 16.49 20.8869L13.06 18.339C12.7521 18.1149 12.381 17.9941 12 17.9941C11.619 17.9941 11.2479 18.1149 10.94 18.339Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M11.9933 7V13" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"/>
                                <path d="M9 10.0065H15" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"/>
                            </svg>
        
                            <span class="ml-2">Insert New</span>
                        </div>
                    </a>
                </button>
            </div>

            <!-- Roles Table -->
            <div class="bg-white shadow-md rounded my-6">
                <table class="min-w-full bg-white grid-cols-1">
                    <thead class="bg-gray-800 text-white">

                    <tr>
                        <th class="w-1/12 py-3 px-4  font-semibold text-sm">Role ID</th>
                        <th class="w-1/4 py-3 px-4  font-semibold text-sm">Role Name</th>
                        <th class="w-1/3 py-3 px-4  font-semibold text-sm">Role Description</th>
                        <th class="w-1/6 py-3 px-4  font-semibold text-sm">Role Status</th>
                        <th class="w-1/6 py-3 px-4  font-semibold text-sm">Actions</th>
                    </tr>

                    </thead>
                    <tbody class="text-gray-700">
                    <!-- Dynamic Data Rows -->
                     <?php foreach ($roles as $role) { ?>
                     <tr class="text_center">
                        <td class="py-3 px-4 text-blue-600"><?php echo htmlspecialchars($role->role_id) ?></td>
                        <td class="w-1/4 py-3 px-4"><?php echo htmlspecialchars($role->role_name) ?></td>
                        <td class="w-1/3 py-3 px-4"><?php echo htmlspecialchars($role->role_description) ?></td>
                        <td class="w-1/6 py-3 px-4"><?php echo htmlspecialchars($role->role_status)?"Active":"Inactive" ?></td>
                        <td class="w-1/6 py-3 px-4">
                            <!-- Tombol Update -->
                            <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded mr-2">
                                <a href="index.php?modul=role&fitur=edit&id=<?php echo $role->role_id; ?>"class="block">Update</a>
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M19.0906 14.4414V18.8806C19.0906 19.1918 19.0293 19.4999 18.9102 19.7874C18.7912 20.0748 18.6166 20.336 18.3966 20.556C18.1766 20.7761 17.9154 20.9506 17.6279 21.0697C17.3405 21.1887 17.0324 21.25 16.7212 21.25H5.11939C4.80709 21.25 4.49787 21.1883 4.20951 21.0684C3.92116 20.9484 3.65935 20.7727 3.43915 20.5512C3.21896 20.3298 3.04471 20.067 2.92644 19.7779C2.80818 19.4889 2.74821 19.1793 2.75001 18.867V7.27882C2.7482 6.96716 2.80825 6.65824 2.92669 6.36996C3.04512 6.08168 3.21958 5.81976 3.43996 5.59938C3.66034 5.379 3.92225 5.20454 4.21054 5.08611C4.49882 4.96768 4.80774 4.90763 5.11939 4.90943H9.55858" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M6.83519 15.8031V13.638C6.83669 13.2808 6.97852 12.9384 7.23009 12.6848L16.7621 3.15279C16.8887 3.02516 17.0393 2.92386 17.2052 2.85472C17.3712 2.78559 17.5491 2.75 17.7289 2.75C17.9087 2.75 18.0867 2.78559 18.2526 2.85472C18.4185 2.92386 18.5691 3.02516 18.6957 3.15279L20.8472 5.3043C20.9749 5.43089 21.0762 5.5815 21.1453 5.74744C21.2144 5.91337 21.25 6.09136 21.25 6.27112C21.25 6.45088 21.2144 6.62887 21.1453 6.7948C21.0762 6.96074 20.9749 7.11135 20.8472 7.23794L11.3152 16.7699C11.0616 17.0215 10.7193 17.1633 10.362 17.1648H8.1969C7.83576 17.1648 7.4894 17.0214 7.23403 16.766C6.97866 16.5106 6.83519 16.1643 6.83519 15.8031Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M19.0906 8.99454L15.0055 4.90939" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </a>
                            </button>
                            <!-- Tombol Delete -->
                            <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded mr-2">
                                <a href="index.php?modul=role&fitur=delete&id=<?php echo $role->role_id ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus role ini?')">Delete</a>   
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M5.47058 6.01471V18.5294C5.47058 19.251 5.75721 19.943 6.26742 20.4532C6.77763 20.9634 7.46962 21.25 8.19117 21.25H15.8088C16.5304 21.25 17.2224 20.9634 17.7326 20.4532C18.2428 19.943 18.5294 19.251 18.5294 18.5294V6.01471" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M3.29413 6.01471H20.7059" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M8.73529 6.01471V4.38235C8.73529 3.94943 8.90727 3.53423 9.2134 3.2281C9.51952 2.92198 9.93472 2.75 10.3676 2.75H13.6323C14.0653 2.75 14.4805 2.92198 14.7866 3.2281C15.0927 3.53423 15.2647 3.94943 15.2647 4.38235V6.01471" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M9.82352 16.9915V11.5535" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M14.1765 16.9915V11.5535" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </a>                         
                            </button>
                     </td>
                     <?php } ?>
                    </tr>
                    </tbody>
                    <!-- More rows can be added statically here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</body>
</html>
