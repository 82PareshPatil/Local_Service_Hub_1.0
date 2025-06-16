<?php
// *******************************************************
// Admin Registration Page — Modern, Responsive, Dark/Light
// *******************************************************
// Paresh, this version keeps your original PHP logic but
// refactors it for security (prepared statements) and a
// clean Tailwind‑powered UI with a dark/light toggle, smooth
// transitions, and subtle neumorphic buttons.
// -------------------------------------------------------
require_once '../includes/connect.php';
require_once '../function/comman_function.php';

$success = $error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['admin_registration'])) {
    // ----------- Server‑side validation & insertion -----------
    $admin_name  = trim($_POST['admin_name']);
    $admin_email = trim($_POST['admin_email']);
    $admin_password = $_POST['admin_password'];
    $confirm_admin_password = $_POST['confirm_admin_password'];
    $admin_image = $_FILES['admin_image'] ?? null;

    if ($admin_password !== $confirm_admin_password) {
        $error = 'Password and Confirm‑Password do not match!';
    } else {
        // Check for duplicate name or email (prepared stmt)
        $dup = $con->prepare('SELECT 1 FROM admin_table WHERE admin_name = ? OR admin_email = ? LIMIT 1');
        $dup->bind_param('ss', $admin_name, $admin_email);
        $dup->execute();
        $dup->store_result();

        if ($dup->num_rows) {
            $error = 'Username or Email already exists!';
        } else {
            // Hash password & move image
            $hash_password = password_hash($admin_password, PASSWORD_DEFAULT);
            $image_name = '';
            if ($admin_image && $admin_image['error'] === UPLOAD_ERR_OK) {
                $image_name = time() . '_' . preg_replace('/[^A-Za-z0-9_.-]/', '', $admin_image['name']);
                move_uploaded_file($admin_image['tmp_name'], __DIR__ . "/admin_images/{$image_name}");
            }

            $ins = $con->prepare('INSERT INTO admin_table (admin_name, admin_email, admin_password, admin_image) VALUES (?,?,?,?)');
            $ins->bind_param('ssss', $admin_name, $admin_email, $hash_password, $image_name);
            if ($ins->execute()) {
                $success = 'Registration successful!';
            } else {
                $error = 'Database error, please try again.';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth" data-theme="light">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Registration</title>

    <!-- Tailwind CDN (with dark mode support via class) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Tailwind config tweaks for neumorphism shadow classes
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
    <!-- ===== Theme Toggle ===== -->
    <button id="themeToggle" aria-label="Toggle Dark Mode"
        class="fixed right-4 top-4 w-12 h-12 rounded-full flex items-center justify-center shadow-neumorph dark:shadow-neumorphDark bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100 transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-indigo-400">
        <i class="fa-solid fa-circle-half-stroke text-xl"></i>
    </button>

    <main class="flex flex-col lg:flex-row items-center justify-center gap-10 py-12 px-4">
        <!-- Illustration -->
        <div class="max-w-sm animate-fade-in-up">
            <img src="../image/logo.png" alt="Admin Registration Illustration" class="rounded-2xl shadow-neumorph dark:shadow-neumorphDark" />
        </div>

        <!-- Registration Card -->
        <div class="w-full max-w-lg bg-white dark:bg-gray-800/70 backdrop-blur-lg p-8 rounded-3xl shadow-neumorph dark:shadow-neumorphDark animate-fade-in-up transition">
            <h1 class="text-3xl font-semibold text-center mb-6 text-gray-800 dark:text-gray-100">
                Admin Registration
            </h1>

            <?php if ($error): ?>
                <p class="mb-4 p-3 rounded-lg bg-red-100 text-red-700 dark:bg-red-800/30 dark:text-red-300">🔴 <?= htmlspecialchars($error) ?></p>
            <?php elseif ($success): ?>
                <p class="mb-4 p-3 rounded-lg bg-green-100 text-green-700 dark:bg-green-800/30 dark:text-green-300">✅ <?= htmlspecialchars($success) ?></p>
            <?php endif; ?>

            <form action="" method="post" enctype="multipart/form-data" class="space-y-5" novalidate>
                <div>
                    <label for="admin_name" class="block mb-1 font-medium text-gray-700 dark:text-gray-300">User Name</label>
                    <input type="text" name="admin_name" id="admin_name" required placeholder="Enter your name" class="w-full px-4 py-2 rounded-xl border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-neumorph dark:shadow-neumorphDark focus:outline-none focus:ring-2 focus:ring-indigo-400 transition" />
                </div>

                <div>
                    <label for="admin_email" class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Email</label>
                    <input type="email" name="admin_email" id="admin_email" required placeholder="Enter your email" class="w-full px-4 py-2 rounded-xl border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-neumorph dark:shadow-neumorphDark focus:outline-none focus:ring-2 focus:ring-indigo-400 transition" />
                </div>

                <div>
                    <label for="admin_image" class="block mb-1 font-medium text-gray-700 dark:text-gray-300">User Image</label>
                    <input type="file" name="admin_image" id="admin_image" accept="image/*" required class="block w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 dark:file:bg-indigo-900/60 dark:file:text-indigo-300" />
                </div>

                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label for="admin_password" class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Password</label>
                        <input type="password" name="admin_password" id="admin_password" required placeholder="Password" class="w-full px-4 py-2 rounded-xl border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-neumorph dark:shadow-neumorphDark focus:outline-none focus:ring-2 focus:ring-indigo-400 transition" />
                    </div>
                    <div>
                        <label for="confirm_admin_password" class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Confirm Password</label>
                        <input type="password" name="confirm_admin_password" id="confirm_admin_password" required placeholder="Confirm" class="w-full px-4 py-2 rounded-xl border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-neumorph dark:shadow-neumorphDark focus:outline-none focus:ring-2 focus:ring-indigo-400 transition" />
                    </div>
                </div>

                <button type="submit" name="admin_registration" class="w-full py-3 rounded-xl font-semibold bg-gradient-to-r from-indigo-500 to-purple-600 text-white shadow-neumorph hover:shadow-lg hover:scale-[1.02] active:scale-95 transition transform">
                    Register
                </button>
                <p class="text-sm text-center text-gray-600 dark:text-gray-400">
                    Already have an account?
                    <a href="admin_login.php" class="text-indigo-600 dark:text-indigo-400 hover:underline">Login</a>
                </p>
            </form>
        </div>
    </main>

    <!-- Smooth fade‑in keyframes -->
    <style>
        @keyframes fade-in-up { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        .animate-fade-in-up { animation: fade-in-up 0.8s ease-out both; }
    </style>

    <!-- ===== JS: Theme persistence & toggle ===== -->
    <script>
        const root = document.documentElement;
        const themeToggleBtn = document.getElementById('themeToggle');
        const storedTheme = localStorage.getItem('theme');
        if (storedTheme === 'dark') root.classList.add('dark');

        themeToggleBtn.addEventListener('click', () => {
            root.classList.toggle('dark');
            localStorage.setItem('theme', root.classList.contains('dark') ? 'dark' : 'light');
            themeToggleBtn.classList.toggle('rotate-180');
        });
    </script>
</body>
</html>
