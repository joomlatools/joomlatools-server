<!-- NAV -->
<nav class="absolute md:relative w-64 transform -translate-x-full md:translate-x-0 h-screen overflow-y-scroll bg-gradient-to-tr from-indigo-700 via-indigo-800 to-indigo-900 transition-all duration-300" :class="{'-translate-x-full': !navOpen}">
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

            <!-- NAV LINKS -->
            <div class="py-5 text-gray-400 space-y-1">

                <?= partial('navigation/mainmenu');?>

            </div>
        </div>

    </div>
</nav>
<!-- END OF NAV -->