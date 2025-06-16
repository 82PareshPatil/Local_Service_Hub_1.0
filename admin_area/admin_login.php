<?php
// **********************************************
// Admin Login Page — Modern Tailwind + DarkMode
// **********************************************
// Mirrors the design language of admin_registration.php
// with neumorphic accents, theme toggle, accessibility, and
// secure login using prepared statements.
//----------------------------------------------------------
require_once '../includes/connect.php';
session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['admin_login'])) {
    $admin_name     = trim($_POST['admin_name']);
    $admin_password = $_POST['admin_password'];

    // Validate credentials
    $stmt = $con->prepare('SELECT admin_password FROM admin_table WHERE admin_name = ? LIMIT 1');
    $stmt->bind_param('s', $admin_name);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows) {
        $stmt->bind_result($hash);
        $stmt->fetch();
        if (password_verify($admin_password, $hash)) {
            $_SESSION['admin_name'] = $admin_name;
            header('Location: index.php');
            exit;
        } else {
            $error = 'Incorrect password!';
        }
    } else {
        $error = 'Admin not found. Please register.';
    }
}
?>
<!DOCTYPE html>
<html lang="en" data-theme="light" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Login</title>

    <!-- TailwindCSS CDN -->
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
    <!-- Theme Toggle Button -->
    <button id="themeToggle" aria-label="Toggle Dark Mode" class="fixed right-4 top-4 w-12 h-12 rounded-full flex items-center justify-center shadow-neumorph dark:shadow-neumorphDark bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100 transition focus:outline-none focus:ring-2 focus:ring-indigo-400">
        <i class="fa-solid fa-circle-half-stroke text-xl"></i>
    </button>

    <main class="flex flex-col lg:flex-row items-center justify-center gap-10 py-12 px-4">
        <!-- Illustration -->
        <div class="max-w-sm animate-fade-in-up">
            <img src="../image/login.jpg" alt="Admin Login Illustration" class="rounded-2xl shadow-neumorph dark:shadow-neumorphDark" />
        </div>

        <!-- Login Card -->
        <div class="w-full max-w-lg bg-white dark:bg-gray-800/70 backdrop-blur-lg p-8 rounded-3xl shadow-neumorph dark:shadow-neumorphDark animate-fade-in-up transition">
            <h1 class="text-3xl font-semibold text-center mb-6 text-gray-800 dark:text-gray-100">Admin Login</h1>

            <?php if ($error): ?>
                <p class="mb-4 p-3 rounded-lg bg-red-100 text-red-700 dark:bg-red-800/30 dark:text-red-300">🔴 <?= htmlspecialchars($error) ?></p>
            <?php endif; ?>

            <form action="" method="post" class="space-y-5" novalidate>
                <div>
                    <label for="admin_name" class="block mb-1 font-medium text-gray-700 dark:text-gray-300">User Name</label>
                    <input type="text" name="admin_name" id="admin_name" required placeholder="Enter your name" class="w-full px-4 py-2 rounded-xl border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-neumorph dark:shadow-neumorphDark focus:outline-none focus:ring-2 focus:ring-indigo-400 transition" />
                </div>
                <div>
                    <label for="admin_password" class="block mb-1 font-medium text-gray-700 dark:text-gray-300">Password</label>
                    <input type="password" name="admin_password" id="admin_password" required placeholder="Password" class="w-full px-4 py-2 rounded-xl border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-neumorph dark:shadow-neumorphDark focus:outline-none focus:ring-2 focus:ring-indigo-400 transition" />
                </div>
                <button type="submit" name="admin_login" class="w-full py-3 rounded-xl font-semibold bg-gradient-to-r from-indigo-500 to-purple-600 text-white shadow-neumorph hover:shadow-lg hover:scale-[1.02] active:scale-95 transition transform">
                    Login
                </button>
                <p class="text-sm text-center text-gray-600 dark:text-gray-400">
                    Don't have an account?
                    <a href="admin_registration.php" class="text-indigo-600 dark:text-indigo-400 hover:underline">Register</a>
                </p>
            </form>
        </div>
    </main>

    <!-- Fade‑in animation keyframes -->
    <style>
        @keyframes fade-in-up { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        .animate-fade-in-up { animation: fade-in-up 0.8s ease-out both; }
    </style>

    <!-- Theme Toggle Logic -->
    <script>
        const root = document.documentElement;
        const toggleBtn = document.getElementById('themeToggle');
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme === 'dark') root.classList.add('dark');

        toggleBtn.addEventListener('click', () => {
            root.classList.toggle('dark');
            localStorage.setItem('theme', root.classList.contains('dark') ? 'dark' : 'light');
            toggleBtn.classList.toggle('rotate-180');
        });
    </script>
</body>
</html>
