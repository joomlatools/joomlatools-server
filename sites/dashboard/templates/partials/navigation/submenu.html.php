<? $pages = collection('pages', ['folder' => $folder ?? '.', 'level' => 3,  'recurse' => 'true', 'filter' => ['visible' => 'neq:false']])  ?>
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