---
@layout: 
    path: /default
    pageclass: embedded

name: PhpMyAdmin
title: Joomlatools Server PhpMyAdmin
summary: PhpMyAdmin for managing Joomlatools Server
visible: true
---

        <section class="max-w-7xl mx-auto py-4 px-5 min-h-screen">
            <div class="flex justify-between items-center border-b border-gray-300">
                <h1 class="text-2xl font-semibold pt-2 pb-6">PhpMyAdmin</h1>
                <button type="button" class="px-6 py-2.5 bg-jtblue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-jtblue-700 hover:shadow-lg focus:bg-jtblue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-jtblue-800 active:shadow-lg transition duration-150 ease-in-out">
                    Add a database
                </button>
            </div>
            <?= file_get_contents('http://phpmyadmin.localhost/') ?>
        </section>