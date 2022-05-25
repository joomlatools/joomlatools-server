---
@layout: 
    path: /default
    pageclass: embedded

name: FPM
title: Joomlatools Server FPM
summary: PHP-FPM for Joomlatools Server
visible: true
---

        <section class="max-w-7xl mx-auto py-4 px-5 min-h-screen">
            <div class="flex justify-between items-center border-b border-gray-300">
                <h1 class="text-2xl font-semibold pt-2 pb-6">FPM</h1>
            </div>
            <?= file_get_contents('http://localhost:8080/__info/php-fpm') ?>
        </section>