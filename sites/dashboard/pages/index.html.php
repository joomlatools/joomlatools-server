---
@layout: 
    path: /default

pageclass: antialiased bg-gray-100
name: Dashboard
title: Joomlatools Server Dashboard
summary: Dashboard for managing Joomlatools Server
visible: false
---

            <section class="max-w-7xl mx-auto py-4 px-5">
                <div class="flex justify-between items-center border-b border-gray-300">
                    <h1 class="text-2xl font-semibold pt-2 pb-6">Sites running on this server</h1>
                    <button type="button" class="px-6 py-2.5 bg-jtblue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-jtblue-700 hover:shadow-lg focus:bg-jtblue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-jtblue-800 active:shadow-lg transition duration-150 ease-in-out">
                        Add a site
                    </button>
                </div>
                
                <!-- TABLE -->
                <div class="bg-white shadow rounded-sm my-2.5 overflow-x-auto">
                    <table class="min-w-max w-full table-auto">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">#</th>
                                <th class="py-3 px-6 text-left">Site</th>
                                <th class="py-3 px-6 text-center">Platform</th>
                                <th class="py-3 px-6 text-center">Version</th>
                                <th class="py-3 px-6 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm">
                            <? $id = 1; foreach(data('sites') as $site) : ?>
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                        <?= $id ?>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-left">
                                    <span><a href="#" class="underline text-jtblue-900"><?= $site->name ?></a></span>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <span class="bg-<?= $site->platform_bg_color ?> text-<?= $site->platform_text_color ?> py-1 px-3 rounded-full text-xs"><?= $site->platform_name ?></span>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <?= $site->platform_version ?>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex item-center justify-center">
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110 cursor-pointer cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </div>
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110 cursor-pointer cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </div>
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110 cursor-pointer cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <? $id++; endforeach ?>
                        </tbody>
                    </table>
                </div>
                <!-- END OF TABLE -->

                
            </section>