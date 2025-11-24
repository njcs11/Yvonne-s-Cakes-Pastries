<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <title>@yield('title', 'Admin')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-white">
    <div class="flex min-h-screen">
        <!-- Admin Sidebar -->
        <aside class="w-70 bg-white border-r border-pink-200">
            @include('partials.admin-sidebar')
        </aside>

        
         <div class="flex-1 flex flex-col">
            <!-- Admin Header -->
            <header class="">
                @include('partials.admin-header')
            </header>
            <!-- Main Content -->
            <main class="flex-1">
                @yield('content')
            </main>
         </div>       
    </div>
</body>
</html>
