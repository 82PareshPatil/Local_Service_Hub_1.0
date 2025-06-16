<?php
//=================================================================
// Modern Admin Dashboard (Tailwind + Alpine.js v3)
// Responsive, dark/light theme, neumorphic cards, accessible
// Fixed + Toggle‑able sidebar that works flawlessly on mobile/desktop.
//=================================================================

include('../includes/connect.php');
include('../function/comman_function.php');
session_start();

// ---------- Helper KPI functions ----------
function get_total($table){
    global $con;
    $res = mysqli_query($con, "SELECT COUNT(*) AS total FROM `$table`");
    if(!$res){ error_log("MySQL error (".$table."): ".mysqli_error($con)); return 0; }
    return mysqli_fetch_assoc($res)['total'] ?? 0;
}
function get_total_services(){    return get_total('service');    }
function get_total_categories(){  return get_total('categories');  }
function get_total_shops(){       return get_total('shopname');   }
function get_total_users(){       return get_total('user_table');  }
?>
<!DOCTYPE html>
<html lang="en"
      x-data="dashboard()"
      :class="{ 'dark': isDark }"
      x-init="init()">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <html lang="en" x-data="themeSwitcher()" :class="{ 'dark': isDark }" x-init="loadTheme()">

    <title>Admin Dashboard</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com/3.4.2"></script>
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

    <style>
        .shadow-neumorphic{box-shadow:8px 8px 16px #c5c5c5,-8px -8px 16px #ffffff}
        .dark .shadow-neumorphic{box-shadow:8px 8px 16px #1c1f24,-8px -8px 16px #2d3138}
        *{transition:background-color .3s ease,color .3s ease,box-shadow .3s ease,transform .3s ease}
        [x-cloak]{display:none !important}
    </style>
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-100 transition-colors duration-300">

<!-- ============== Sidebar Toggle button (always visible) ============== -->
<button @click="toggleSidebar"
        class="fixed top-4 left-4 z-50 p-3 rounded-full bg-white dark:bg-gray-800 shadow-neumorphic focus:outline-none focus:ring"
        :aria-label="sidebarOpen ? 'Close sidebar' : 'Open sidebar'">
    <i :class="sidebarOpen ? 'fas fa-times' : 'fas fa-bars'"></i>
</button>

<div class="flex">
    <!-- ======================= Sidebar ======================= -->
    <aside
        x-cloak
        :class="sidebarOpen ? 'translate-x-0 md:translate-x-0' : '-translate-x-full md:-translate-x-full'"
        class="fixed inset-y-0 left-0 w-64 bg-white dark:bg-gray-800 overflow-y-auto shadow-lg transform md:translate-x-0 transition-transform duration-300 ease-in-out z-40">
        <div class="p-6 flex flex-col items-center space-y-4">
            <img src="../image/logo.png" alt="Logo" class="w-32"/>
            <h2 class="text-lg font-semibold">Welcome
                <?php echo isset($_SESSION['admin_name']) ? htmlspecialchars($_SESSION['admin_name']) : 'Guest'; ?>
            </h2>
            <?php if(isset($_SESSION['admin_name'])){
                $admin_name=$_SESSION['admin_name'];
                $row=mysqli_fetch_assoc(mysqli_query($con,"SELECT admin_image FROM admin_table WHERE admin_name='$admin_name'"));
                if(!empty($row['admin_image'])) echo '<img src="./admin_images/'.htmlspecialchars($row['admin_image']).'" class="w-24 h-24 rounded-full object-cover shadow-neumorphic" alt="avatar">';
            }?>

            <!-- -------- nav links -------- -->
            <nav class="w-full space-y-2 pt-4 text-sm">
                <a href="insert_service.php"                class="nav-link"><i class="fas fa-plus-circle"></i><span>Add Service</span></a>
                <a href="index.php?view_service"         class="nav-link"><i class="fas fa-list"></i><span>View Service</span></a>
                <a href="index.php?insert_category"      class="nav-link"><i class="fas fa-folder-plus"></i><span>Add Categories</span></a>
                <a href="index.php?view_categories"      class="nav-link"><i class="fas fa-folder-open"></i><span>View Categories</span></a>
                <a href="index.php?insert_shopname"      class="nav-link"><i class="fas fa-store"></i><span>Add Shop</span></a>
                <a href="index.php?view_shop"            class="nav-link"><i class="fas fa-store-alt"></i><span>View Shop</span></a>
                <a href="index.php?list_bookings"        class="nav-link"><i class="fas fa-calendar-check"></i><span>All Orders</span></a>
                <a href="index.php?list_payment"         class="nav-link"><i class="fas fa-money-bill-wave"></i><span>All Payments</span></a>
                <a href="index.php?list_users"           class="nav-link"><i class="fas fa-users"></i><span>List Users</span></a>
                <a href="logout.php"                     class="nav-link text-red-600 dark:text-red-400"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a>
            </nav>
        </div>
    </aside>

    <!-- ======================= Main ======================= -->
    <main :class="sidebarOpen ? 'md:ml-64' : 'md:ml-0'" class="flex-1 p-6 transition-all duration-300 ease-in-out">
        <!-- -------- top bar -------- -->
        <div class="flex flex-wrap justify-between items-center mb-8 gap-4">
            <h1 class="text-2xl font-bold">Dashboard</h1>
            <button @click="toggleTheme" class="p-3 rounded-full shadow-neumorphic focus:outline-none" :aria-label="isDark ? 'Switch to light mode' : 'Switch to dark mode'">
                <i :class="isDark ? 'fas fa-sun' : 'fas fa-moon'"></i>
            </button>
        </div>

        <!-- -------- KPI cards -------- -->
        <section class="grid gap-6 grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 mb-12">
            <template x-for="card in kpis" :key="card.label">
                <div class="relative bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-neumorphic transform hover:scale-[1.03] duration-300">
                    <p class="text-sm text-gray-500 dark:text-gray-400" x-text="card.label"></p>
                    <h2 class="text-3xl font-bold mt-2 mb-4" x-text="card.value"></h2>
                    <i :class="card.icon + ' text-4xl absolute right-6 bottom-6 opacity-20'" :style="card.color"></i>
                </div>
            </template>
        </section>

        <!-- -------- dynamic PHP include content -------- -->
        <section class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-neumorphic">
            <?php
            $routes = [
                'insert_category'  => 'add_categories.php',
                'insert_shopname'  => 'add_shopname.php',
                'view_service'     => 'view_service.php',
                'edit_service'     => 'edit_service.php',
                'delete_service'   => 'delete_service.php',
                'view_categories'  => 'view_categories.php',
                'view_shop'        => 'view_shop.php',
                'edit_category'    => 'edit_category.php',
                'delete_category'  => 'delete_category.php',
                'edit_shop'        => 'edit_shop.php',
                'delete_shop'      => 'delete_shop.php',
                'list_bookings'    => 'list_bookings.php',
                'delete_Booking'   => 'delete_Booking.php',
                'list_payment'     => 'list_payment.php',
                'delete_payment'   => 'delete_payment.php',
                'list_users'       => 'list_users.php'
            ];
            foreach($routes as $key=>$file){ if(isset($_GET[$key])){ include $file; break; } }
            ?>
        </section>
    </main>
</div>

<!-- ============== Modal (demo) ============== -->
<div x-data="{open:false}" @keydown.escape.window="open=false">
    <button @click="open=true" class="fixed bottom-8 right-8 p-4 rounded-full bg-indigo-500 text-white shadow-lg focus:outline-none" aria-label="Open modal"><i class="fas fa-plus"></i></button>
    <template x-teleport="body">
        <div x-show="open" x-transition.opacity class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" aria-modal="true" role="dialog">
            <div x-show="open" x-transition.scale class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-neumorphic w-11/12 max-w-md">
                <h3 class="text-xl font-bold mb-4">Interactive Modal</h3>
                <p class="mb-6 text-sm">This is a reusable modal component.</p>
                <div class="flex justify-end gap-2">
                    <button @click="open=false" class="px-4 py-2 rounded-lg shadow-neumorphic bg-gray-200 dark:bg-gray-700">Cancel</button>
                    <button @click="open=false" class="px-4 py-2 rounded-lg shadow-neumorphic bg-indigo-500 text-white">Confirm</button>
                </div>
            </div>
        </div>
    </template>
</div>

<!-- ============== Alpine.js component ============== -->
<script>
function dashboard(){
    return {
        isDark:false,
        sidebarOpen:true,
        kpis:[
            {label:'Total Services',   value:'<?php echo get_total_services();?>',  icon:'fas fa-concierge-bell', color:'color:#818cf8'},
            {label:'Total Categories', value:'<?php echo get_total_categories();?>',icon:'fas fa-layer-group',    color:'color:#34d399'},
            {label:'Total Shops',     value:'<?php echo get_total_shops();?>',    icon:'fas fa-store',          color:'color:#facc15'},
            {label:'Total Users',     value:'<?php echo get_total_users();?>',    icon:'fas fa-users',          color:'color:#f472b6'},
        ],
        init(){
            // Load theme preference
            this.isDark = localStorage.getItem('theme')==='dark'||(!localStorage.getItem('theme')&&window.matchMedia('(prefers-color-scheme: dark)').matches);
        },
        toggleTheme(){
            this.isDark=!this.isDark;localStorage.setItem('theme',this.isDark?'dark':'light');
        },
        toggleSidebar(){
            this.sidebarOpen=!this.sidebarOpen;
        }
    }
}
</script>

<!-- ====== Utility classes for nav links ====== -->
<style>
.nav-link{display:flex;align-items:center;gap:0.75rem;padding:0.5rem 1rem;border-radius:0.5rem;transition:background 0.2s}
.nav-link:hover{background:#e0e7ff}
.dark .nav-link:hover{background:#374151}
</style>
</body>
</html>