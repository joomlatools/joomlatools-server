---
@layout: /index
@process:
    prefetch: .navigation
---

    <div class="flex relative" x-data="{navOpen: false}">

        <!-- NAV -->
        <nav class="absolute z-50 md:relative w-64 transform -translate-x-full md:translate-x-0 h-screen overflow-y-scroll bg-gradient-to-tr from-indigo-700 via-indigo-800 to-indigo-900 transition-all duration-300" :class="{'-translate-x-full': !navOpen}">
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

        
        <main class="flex-1 h-screen<?= (page()->name == 'Dashboard') ? ' overflow-y-scroll' : '' ?> overflow-x-hidden">

            <!-- LOGO AND HAMBURGER BUTTON - HIDDEN ON DESKTOP -->
            <div class="md:hidden justify-between items-center bg-gradient-to-b from-indigo-700 via-indigo-800 to-indigo-900 text-white flex">
                <h1 class="px-4">
                    <?= partial('logos/joomlatools',[
                        'display_text' => 1, 
                        'display_time' => 0,
                        'icon_size' => '6',
                        'icon_colour' => 'white',
                        'direction' => 'h',
                    ]);
                    ?>
                </h1>
                <button @click="navOpen = !navOpen" class="btn p-4 focus:outline-none hover:bg-gray-800">
                    <svg class="w-6 h-6 fill-current" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                </button>
            </div>
            <!-- END OF LOGO AND HAMBURGER BUTTON -->

            <!-- PAGE CONTENT -->
            <ktml:content>
            <!-- END OF PAGE CONTENT -->

        </main>
    </div>