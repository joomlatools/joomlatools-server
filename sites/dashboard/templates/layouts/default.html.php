---
@layout: /index
@process:
    prefetch: .navigation
---

    <div class="flex relative" x-data="{navOpen: false}">

        <?= partial('navigation/main',[]);?>

        
        <main class="flex-1 h-screen<?= (page()->name == 'Dashboard') ? ' overflow-y-scroll' : '' ?> overflow-x-hidden">

            <!-- LOGO AND HAMBURGER BUTTON - HIDDEN ON DESKTOP -->
            <div class="md:hidden justify-between items-center bg-black text-white flex">
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