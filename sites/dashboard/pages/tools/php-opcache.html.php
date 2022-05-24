---
@layout: 
    path: /default

pageclass: antialiased bg-gray-100
name: Opcache
title: Joomlatools Server Opcache
summary: PHP-Opcache for Joomlatools Server
visible: true
---

        <section class="max-w-7xl mx-auto py-4 px-5 min-h-screen">
            <div class="flex justify-between items-center border-b border-gray-300">
                <h1 class="text-2xl font-semibold pt-2 pb-6">Opcache</h1>
            </div>
            <?= file_get_contents('http://localhost:8080/__info/php-opcache') ?>
        </section>