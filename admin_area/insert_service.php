<?php
// **********************************************************
// INSERT SERVICE PAGE — Local Service Hub (Admin Dashboard)
// **********************************************************
// Consistent with your new Tailwind dark/light design.
// Features:
// • Secure prepared statements
// • Unique image filenames + safe upload
// • Neumorphic shadows, smooth fade‑in, A11y
// • Dark/Light theme toggle with localStorage persistence
// ----------------------------------------------------------
require_once '../includes/connect.php';

$msg_success = $msg_error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_service'])) {
    // Collect & sanitize input
    $title       = trim($_POST['service_title']);
    $desc        = trim($_POST['description']);
    $address     = trim($_POST['address']);
    $contact     = trim($_POST['contect']);
    $keywords    = trim($_POST['service_keywords']);
    $category_id = (int) $_POST['category_id'];
    $shop_id     = (int) $_POST['shop_id'];
    $cost        = (float) $_POST['service_cost'] ?: 0;
    $status      = 'Succeeded';

    // Validate required fields
    $required = [$title, $desc, $keywords, $category_id, $shop_id, $cost ];
    if (in_array('', $required, true)) {
        $msg_error = 'Please fill all required fields.';
    }

    // Handle images
    $uploads = [];
    if (!$msg_error) {
        $dir = __DIR__ . '/service_images/';
        if (!is_dir($dir)) mkdir($dir, 0755, true);

        foreach (['service_image1', 'service_image2', 'service_image3'] as $idx => $field) {
            if (!isset($_FILES[$field]) || $_FILES[$field]['error'] !== UPLOAD_ERR_OK) {
                $msg_error = 'Please upload all three service images.';
                break;
            }
            $ext = pathinfo($_FILES[$field]['name'], PATHINFO_EXTENSION);
            $safeName = uniqid('svc_', true) . "_{$idx}." . strtolower($ext);
            if (!move_uploaded_file($_FILES[$field]['tmp_name'], $dir . $safeName)) {
                $msg_error = 'Error uploading images. Check folder permissions.';
                break;
            }
            $uploads[] = $safeName;
        }
    }

    // Insert into DB
    if (!$msg_error) {
        $sql = 'INSERT INTO service (service_title, description, address, contect, service_keywords, category_id, shop_id, service_image1, service_image2, service_image3, service_cost, Date, Status)
                VALUES (?,?,?,?,?,?,?,?,?,?,?, NOW(), ?)';
        $stmt = $con->prepare($sql);
        $stmt->bind_param('sssssiisssds', $title, $desc, $address, $contact, $keywords, $category_id, $shop_id, $uploads[0], $uploads[1], $uploads[2], $cost, $status);

        if ($stmt->execute()) {
            $msg_success = 'Service added successfully!';
        } else {
            $msg_error = 'Database error: ' . $con->error;
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en" data-theme="light" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add Service — Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    boxShadow: {
                        neumorph: '8px 8px 15px rgba(0,0,0,0.15), -8px -8px 15px rgba(255,255,255,0.55)',
                        neumorphDark: '8px 8px 15px rgba(0,0,0,0.6), -8px -8px 15px rgba(255,255,255,0.05)',
                    },
                },
            },
        };
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="min-h-screen bg-gray-100 dark:bg-gray-900 transition-colors duration-500 ease-in-out">
    <!-- Theme Toggle -->
    <button id="themeToggle" aria-label="Toggle Dark Mode" class="fixed right-4 top-4 w-12 h-12 flex items-center justify-center rounded-full shadow-neumorph dark:shadow-neumorphDark bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">
        <i class="fa-solid fa-circle-half-stroke text-xl"></i>
    </button>

    <main class="flex flex-col items-center py-12 px-4 animate-fade-in-up">
        <h1 class="text-3xl font-bold mb-8 text-gray-800 dark:text-gray-100">Insert Service</h1>

        <div class="w-full max-w-3xl bg-white dark:bg-gray-800/70 backdrop-blur-lg p-8 rounded-3xl shadow-neumorph dark:shadow-neumorphDark">
            <?php if ($msg_error): ?>
                <p class="mb-4 p-3 rounded-lg bg-red-100 text-red-700 dark:bg-red-800/30 dark:text-red-300">🔴 <?= htmlspecialchars($msg_error) ?></p>
            <?php elseif ($msg_success): ?>
                <p class="mb-4 p-3 rounded-lg bg-green-100 text-green-700 dark:bg-green-800/30 dark:text-green-300">✅ <?= htmlspecialchars($msg_success) ?></p>
            <?php endif; ?>

            <form action="" method="post" enctype="multipart/form-data" class="space-y-6">
                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Title -->
                    <div>
                        <label for="service_title" class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Service Title*</label>
                        <input type="text" name="service_title" id="service_title" required class="w-full px-4 py-2 rounded-xl border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-neumorph dark:shadow-neumorphDark focus:outline-none focus:ring-2 focus:ring-indigo-400" />
                    </div>

                    <!-- Keywords -->
                    <div>
                        <label for="service_keywords" class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Keywords*</label>
                        <input type="text" name="service_keywords" id="service_keywords" required class="w-full px-4 py-2 rounded-xl border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-neumorph dark:shadow-neumorphDark focus:outline-none focus:ring-2 focus:ring-indigo-400" />
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Description*</label>
                    <textarea name="description" id="description" rows="3" required class="w-full px-4 py-2 rounded-xl border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-neumorph dark:shadow-neumorphDark focus:outline-none focus:ring-2 focus:ring-indigo-400"></textarea>
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Address -->
                    <div>
                        <label for="address" class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Address</label>
                        <input type="text" name="address" id="address" class="w-full px-4 py-2 rounded-xl border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-neumorph dark:shadow-neumorphDark focus:outline-none focus:ring-2 focus:ring-indigo-400" />
                    </div>

                    <!-- Contact -->
                    <div>
                        <label for="contect" class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Contact</label>
                        <input type="tel" name="contect" id="contect" class="w-full px-4 py-2 rounded-xl border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-neumorph dark:shadow-neumorphDark focus:outline-none focus:ring-2 focus:ring-indigo-400" />
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Category Selector -->
                    <div>
                        <label for="category_id" class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Category*</label>
                        <select name="category_id" id="category_id" required class="w-full px-4 py-2 rounded-xl border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-neumorph dark:shadow-neumorphDark focus:outline-none focus:ring-2 focus:ring-indigo-400">
                            <option value="">Select a category</option>
                            <?php
                                $q = mysqli_query($con, 'SELECT category_id, category_title FROM categories');
                                while ($r = mysqli_fetch_assoc($q)) {
                                    echo '<option value="'.$r['category_id'].'">'.htmlspecialchars($r['category_title']).'</option>';}
                            ?>
                        </select>
                    </div>
                    <!-- Shop Selector -->
                    <div>
                        <label for="shop_id" class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Shop*</label>
                        <select name="shop_id" id="shop_id" required class="w-full px-4 py-2 rounded-xl border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-neumorph dark:shadow-neumorphDark focus:outline-none focus:ring-2 focus:ring-indigo-400">
                            <option value="">Select a shop</option>
                            <?php
                                $q = mysqli_query($con, 'SELECT shop_id, shop_title FROM shopname');
                                while ($r = mysqli_fetch_assoc($q)) {
                                    echo '<option value="'.$r['shop_id'].'">'.htmlspecialchars($r['shop_title']).'</option>';}
                            ?>
                        </select>
                    </div>
                </div>

                <!-- Images -->
                <div class="grid md:grid-cols-3 gap-6">
                    <?php for ($i=1;$i<=3;$i++): ?>
                        <div>
                            <label for="service_image<?= $i ?>" class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Image <?= $i ?>*</label>
                            <input type="file" name="service_image<?= $i ?>" id="service_image<?= $i ?>" accept="image/*" required class="block w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 dark:file:bg-indigo-900/60 dark:file:text-indigo-300" />
                        </div>
                    <?php endfor; ?>
                </div>

                <!-- Cost -->
                <div>
                    <label for="service_cost" class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Cost (₹)*</label>
                    <input type="number" step="0.01" name="service_cost" id="service_cost" required class="w-full px-4 py-2 rounded-xl border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-neumorph dark:shadow-neumorphDark focus:outline-none focus:ring-2 focus:ring-indigo-400" />
                </div>

                <button type="submit" name="add_service" class="w-full py-3 rounded-xl font-semibold bg-gradient-to-r from-indigo-500 to-purple-600 text-white shadow-neumorph hover:shadow-lg hover:scale-[1.02] active:scale-95 transition transform">Add Service</button>
            </form>
        </div>
    </main>

    <!-- Fade‑in keyframes -->
    <style>
        @keyframes fade-in-up { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        .animate-fade-in-up { animation: fade-in-up 0.8s ease-out both; }
    </style>

    <!-- Theme toggle script -->
    <script>
        const root = document.documentElement;
        const btn = document.getElementById('themeToggle');
        const stored = localStorage.getItem('theme');
        if (stored === 'dark') root.classList.add('dark');
        btn.addEventListener('click', () => {
            root.classList.toggle('dark');
            localStorage.setItem('theme', root.classList.contains('dark') ? 'dark' : 'light');
            btn.classList.toggle('rotate-180');
        });
    </script>
</body>
</html>
