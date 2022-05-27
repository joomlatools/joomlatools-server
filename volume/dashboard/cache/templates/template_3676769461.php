<?php extract(array (
  'name' => 'PHP Info',
  'title' => 'Joomlatools Server PHP Info',
  'summary' => 'PHP-PHP Info for Joomlatools Server',
  'visible' => true,
),EXTR_SKIP) ?>
<section class="max-w-7xl mx-auto py-4 px-5 min-h-screen">
            <div class="flex justify-between items-center border-b border-gray-300">
                <h1 class="text-2xl font-semibold pt-2 pb-6">PHP Info</h1>
            </div>
            <?php echo file_get_contents('http://localhost:8080/__info/php-info') ?>
        </section>