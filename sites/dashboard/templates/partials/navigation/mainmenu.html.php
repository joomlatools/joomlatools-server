<? $pages = collection('pages', ['path' => $path ?? '/', 'level' => 3,  'recurse' => 'true', 'filter' => ['visible' => 'neq:false']])  ?>
<ul role="navigation" aria-label="Main menu" class="navigation mb-8">
	<? foreach ($pages as $page) : ?>

		<li class="p-2 no-children">
			<a class="block hover:text-gray-100 transition-colors duration-500 ease-in-out<?= strpos(page()->path, $page->path) === 0 ? ' text-gray-100 is-active' : '' ?>" href="<?= route($page) ?>"><?= $page->name ?></a>
		</li>

		<? foreach($page->getChildren() as $child): ?>
			<? if (strpos(page()->path, $page->path) === 0): ?>
				
				<? if ($child->getChildren()): ?>
					<li x-data="{ isOpen: <?= $menuOpen = $menuOpen ?? 'false'; ?> }" class="p-2">
						<div class="flex flex-row justify-between items-center">
							<a class="flex-1 focus:outline-none focus:shadow-outline block transition-colors duration-500 ease-in-out hover:text-gray-100<?= strpos(page()->path, $child->path) === 0 ? ' text-gray-100 is-active' : '' ?>" href="<?= route($child) ?>"><?= $child->name ?></a>
							<button
								@click="isOpen = !isOpen"
								type="button"
								class="block px-2 focus:outline-none focus:shadow-outline"
								:class="{ 'transition transform-180': <?= (strpos(page()->path, $child->path) === 0 ? 'isOpen' : '!isOpen') ?> }"
							>
								<svg
									class="h-6 w-6 fill-current"
									xmlns="http://www.w3.org/2000/svg"
									viewBox="0 0 24 24"
								>
									<path style="display:none"
										x-show="<?= (strpos(page()->path, $child->path) === 0 ? '!isOpen' : 'isOpen') ?>"
										fill-rule="evenodd"
										clip-rule="evenodd"
										d="M18.278 16.864a1 1 0 0 1-1.414 1.414l-4.829-4.828-4.828 4.828a1 1 0 0 1-1.414-1.414l4.828-4.829-4.828-4.828a1 1 0 0 1 1.414-1.414l4.829 4.828 4.828-4.828a1 1 0 1 1 1.414 1.414l-4.828 4.829 4.828 4.828z"
									/>
									<path style="display:none"
										x-show="<?= (strpos(page()->path, $child->path) === 0 ? 'isOpen' : '!isOpen') ?>"
										fill-rule="evenodd"
										d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"
									/>
								</svg>
							</button>
						</div>
						<ul 
						class="mt-2" 
	        			x-show.transition="true"
						:class="<?= (strpos(page()->path, $child->path) === 0 ? "{ 'block' : !isOpen, 'hidden' : isOpen }" : "{ 'block' : isOpen , 'hidden' : !isOpen}") ?>"
						>
							<? 
								foreach($child->getChildren() as $sub):
							?>
								<li class="flex flex-row p-2 pl-0">
									<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6<?= strpos(page()->path, $sub->path) === 0 ? ' text-gray-100' : '' ?>" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
									  <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
									</svg>
									<a class="flex-1 transition-colors duration-500 ease-in-out hover:text-gray-100<?= strpos(page()->path, $sub->path) === 0 ? ' text-gray-100 is-active' : '' ?>" href="<?= route($sub) ?>"><?= $sub->name ?></a>
								</li>
							<? endforeach; ?>
						</ul>
					</li>
				
				<? else: ?>

					<li class="p-2 no-children">
						<a class="block transition-colors duration-500 ease-in-out hover:text-gray-100<?= strpos(page()->path, $child->path) === 0 ? ' text-gray-100 is-active' : '' ?>" href="<?= route($child) ?>"><?= $child->name ?></a>
					</li>

				<? endif; ?>
			<? endif; ?>
		<? endforeach; ?>
	<? endforeach; ?>
</ul>