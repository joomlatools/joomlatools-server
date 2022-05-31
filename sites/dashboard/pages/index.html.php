---
@layout: 
    path: /default


name: Dashboard
title: Joomlatools Server Dashboard
summary: Dashboard for managing Joomlatools Server
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
                                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110 cursor-pointer cursor-pointer has-tooltip">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        <span class="tooltip rounded shadow-lg p-1 bg-gray-800 text-white -mt-12">View site</span>
                                    </div>
                                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110 cursor-pointer cursor-pointer has-tooltip">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                        <span class="tooltip rounded shadow-lg p-1 bg-gray-800 text-white -mt-12">Edit site</span>
                                    </div>
                                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110 cursor-pointer cursor-pointer has-tooltip">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        <span class="tooltip rounded shadow-lg p-1 bg-gray-800 text-white -mt-12">Delete site</span>
                                    </div>
                                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110 cursor-pointer cursor-pointer has-tooltip">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                                        </svg>
                                        <span class="tooltip rounded shadow-lg p-1 bg-gray-800 text-white -mt-12">Download remote site</span>
                                    </div>
                                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110 cursor-pointer cursor-pointer has-tooltip">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                        </svg>
                                        <span class="tooltip rounded shadow-lg p-1 bg-gray-800 text-white -mt-12">Deploy to fly.io</span>
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


<? $pages = collection('pages', ['folder' => $folder ?? '.', 'level' => 3,  'recurse' => 'true']); $menuOpen = 'true';  ?>
<ul x-data="{ isOpen: <?= $menuOpen = $menuOpen ?? 'false'; ?> }" role="navigation" aria-label="Secondary menu" class="submenu border border-gray-300 mb-8 rounded">
    <? foreach ($pages as $page) : ?>
        <? foreach($page->getChildren() as $child): ?>
            <? if (strpos(page()->path, $page->path) === 0): ?>
                <? if ($child->getChildren()): ?>
                    <li class="hover:bg-gray-100 border-t first:border-t-0 first:rounded-t last:rounded-b items-center transition-colors duration-500 ease-in-out p-2 flex flex-row sm:flex-col sm:items-center lg:flex-row justify-between<?= strpos(page()->path, $child->path) === 0 ? ' bg-gray-100 is-active' : '' ?>">
                        <a class="flex-1 focus:outline-none focus:shadow-outline block" href="<?= route($child) ?>"><?= $child->name ?></a>
                        <button
                            @click="isOpen = !isOpen"
                            type="button"
                            class="block px-2 focus:outline-none focus:shadow-outline"
                            :class="{ 'transition transform-180': isOpen }"
                        >
                            <svg
                                class="h-6 w-6 fill-current"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                            >
                                <path style="display:none"
                                    x-show="isOpen"
                                    fill-rule="evenodd"
                                    clip-rule="evenodd"
                                    d="M18.278 16.864a1 1 0 0 1-1.414 1.414l-4.829-4.828-4.828 4.828a1 1 0 0 1-1.414-1.414l4.828-4.829-4.828-4.828a1 1 0 0 1 1.414-1.414l4.829 4.828 4.828-4.828a1 1 0 1 1 1.414 1.414l-4.828 4.829 4.828 4.828z"
                                />
                                <path style="display:none"
                                    x-show="!isOpen"
                                    fill-rule="evenodd"
                                    d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"
                                />
                            </svg>
                        </button>
                    </li>
                    <ul 
                    class="mb- pb-0 bg-lime-100 bg-opacity-25" 
                    x-show.transition="true"
                    :class="{ 'block' : isOpen , 'hidden' : !isOpen}"
                    >
                        <? 
                            foreach($child->getChildren() as $sub):
                        ?>
                            <li class="hover:bg-gray-100 border-t transition-colors duration-500 ease-in-out p-2 pl-6 pr-4<?= strpos(page()->path, $sub->path) === 0 ? ' bg-gray-100 is-active' : '' ?>">
                                <a class="block" href="<?= route($sub) ?>"><?= $sub->name ?></a>
                            </li>
                        <? endforeach; ?>
                    </ul>
                <? else: ?>
                    <li class="hover:bg-gray-100 border-t first:border-t-0 first:rounded-t last:rounded-b transition-colors duration-500 ease-in-out p-2<?= strpos(page()->path, $child->path) === 0 ? ' bg-gray-100 is-active' : '' ?> no-children">
                        <a class="block" href="<?= route($child) ?>"><?= $child->name ?></a>
                    </li>
                <? endif; ?>
            <? endif; ?>
        <? endforeach; ?>
    <? endforeach; ?>
</ul>