---
@layout: 
    path: /default
    pageclass: embedded


name: Information
title: Joomlatools Server PHP Info
summary: PHP-PHP Info for Joomlatools Server
visible: true
---

        <section class="max-w-7xl mx-auto py-4 px-5">
            <?= file_get_contents('http://localhost/__info/php-info') ?>
        </section>