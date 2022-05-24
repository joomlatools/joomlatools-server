<!-- NAV -->
<nav class="absolute md:relative w-64 transform -translate-x-full md:translate-x-0 h-screen overflow-y-scroll bg-black transition-all duration-300" :class="{'-translate-x-full': !navOpen}">
    <div class="flex flex-col justify-between h-full">
        <div class="p-4">
            <!-- LOGO -->
            <a class="flex items-center text-white space-x-4" href="">
                <?= partial('logos/joomlatools',[
                    'display_text' => 1, 
                    'display_time' => 0,
                    'icon_size' => '6',
                    'icon_colour' => 'white',
                    'direction' => 'h',
                ]);
                ?>
            </a>

            <!-- SEARCH BAR -->
            <div class="border-gray-700 py-5 text-white border-b rounded">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-2">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <form action="" method="GET">
                        <input type="search" class="w-full py-2 rounded pl-10 bg-gray-800 border-none focus:outline-none focus:ring-0" placeholder="Search">
                    </form>
                </div>
                <!-- SEARCH RESULT -->
            </div>

            <!-- NAV LINKS -->
            <div class="py-4 text-gray-400 space-y-1">
                <!-- BASIC LINK -->
                <a href="http://localhost:8080/dashboard/" class="block py-2.5 px-4 flex items-center space-x-2 bg-gray-800 text-white hover:bg-gray-800 hover:text-white rounded">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    <span>Dashboard</span>
                </a>
                <!-- DROPDOWN LINK -->
                <div class="block" x-data="{open: true}">
                    <div @click="open = !open" class="flex items-center justify-between hover:bg-gray-800 hover:text-white cursor-pointer py-2.5 px-4 rounded">
                        <div class="flex items-center space-x-2">
                            <svg class="h-6 w-6"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><path d="M7 10h3v-3l-3.5 -3.5a6 6 0 0 1 8 8l6 6a2 2 0 0 1 -3 3l-6-6a6 6 0 0 1 -8 -8l3.5 3.5" /></svg>
                            <span>Tools</span>
                        </div>
                        <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>
                        <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>    
                    </div>
                    <div x-show="open" class="text-sm border-l-2 border-gray-800 mx-6 my-2.5 px-2.5 flex flex-col gap-y-1">
                        <a href="http://localhost:8080/dashboard/tools/phpmyadmin" class="block py-2 px-4 hover:bg-gray-800 hover:text-white rounded">
                            phpMyAdmin
                        </a>
                        <a href="#" class="block py-2 px-4 hover:bg-gray-800 hover:text-white rounded">
                            MailCatcher
                        </a>
                        <a href="http://localhost:8080/dashboard/tools/php-fpm" class="block py-2 px-4 hover:bg-gray-800 hover:text-white rounded">
                            PHP-FPM dashboard
                        </a>
                        <a href="http://localhost:8080/dashboard/tools/php-apc" class="block py-2 px-4 hover:bg-gray-800 hover:text-white rounded">
                            APC dashboard
                        </a>
                        <a href="http://localhost:8080/dashboard/tools/php-opcache" class="block py-2 px-4 hover:bg-gray-800 hover:text-white rounded">
                            Opcache
                        </a>
                        <a href="http://localhost:8080/dashboard/tools/php-xdebug" class="block py-2 px-4 hover:bg-gray-800 hover:text-white rounded">
                            Xdebug
                        </a>
                    </div>
                </div>
                <!-- DROPDOWN LINK -->
                <div class="block" x-data="{open: true}">
                    <div @click="open = !open" class="flex items-center justify-between hover:bg-gray-800 hover:text-white cursor-pointer py-2.5 px-4 rounded">
                        <div class="flex items-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                            <span>System</span>
                        </div>
                        <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>
                        <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>    
                    </div>
                    <div x-show="open" class="text-sm border-l-2 border-gray-800 mx-6 my-2.5 px-2.5 flex flex-col gap-y-1">
                        <a href="http://localhost:8080/dashboard/tools/php-info" class="block py-2 px-4 hover:bg-gray-800 hover:text-white rounded">
                            phpinfo
                        </a>
                        <a href="#" class="block py-2 px-4 hover:bg-gray-800 hover:text-white rounded">
                            Log Files
                        </a>
                        <a href="#" class="block py-2 px-4 hover:bg-gray-800 hover:text-white rounded">
                            File Browser
                        </a>
                        <a href="#" class="block py-2 px-4 hover:bg-gray-800 hover:text-white rounded">
                            Terminal
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</nav>
<!-- END OF NAV -->