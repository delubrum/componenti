<!DOCTYPE html>
<html lang="en">
  <head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Componenti</title>
		<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
		<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.1/dist/cdn.min.js"></script>
		<script src="https://unpkg.com/htmx.org@1.9.6" integrity="sha384-FhXw7b6AlE/jyjlZH5iHa/tTe9EpJ1Y55RjcgPbjeWMskSxZt1v9qkxLJWNJaGni" crossorigin="anonymous"></script>
		<script src="https://cdn.tailwindcss.com"></script>
		<link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
		<link href="app/assets/css/styles.css" rel="stylesheet">
	</head>
  <body>
		<div id="loading">
		</div>
    <div>
			<div class="left-side fixed top-0 left-0 w-10 h-full z-50""></div>
			<div class="overflow-hidden fixed left-0 top-0 w-64 h-full bg-gray-900 p-4 z-50 sidebar-menu transition-transform -translate-x-full">
				<a href="?c=Home&a=Index" class="flex items-center pb-4 border-b border-b-gray-800">
					<img src="app/assets/img/logo.png" class="w-full"/>
					<!-- <img src="app/assets/logo.png" alt="" class="w-8 h-8 rounded object-cover"/> -->
					<!-- <span class="text-lg font-bold text-white ml-3">Componenti</span> -->
				</a>
				<ul class="mt-4 flex-1 overflow-y-auto">
					<?php 
					$permissionsTitle = array();
					foreach($permissions as $p) { 
						$permissionsTitle[] = $this->model->get('*','permissions', "and id = $p")->title;
					};
					foreach($this->model->list('id, title, c, icon','permissions', " and type = 'menu' GROUP BY title ORDER BY sortm ASC") as $t) { 
					if (in_array($t->title, $permissionsTitle)) { ?>
						<li class="mb-1 group" x-data="{ isOpen: false}">
							<a 
								href="#" 
								class="flex items-center py-2 px-4 text-gray-300 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100"
								@click="isOpen = !isOpen"
								>
									<?php echo $t->icon ?>
									<span class="text-sm"><?php echo isset($lang[$t->title]) ? $lang[$t->title] : $t->title?></span>
									<i class="ri-arrow-right-s-line ml-auto group-[.selected]:rotate-90"></i>
							</a>
							<ul
								class="pl-7 mt-2 group-[.selected]:block"
								x-show="isOpen"
								@click.away="isOpen = false"
								>
								<?php foreach($this->model->list('*','permissions'," and type = 'menu' AND title = '$t->title' ORDER BY sort ASC") as $s) {
								if (in_array($s->id, $permissions)) { ?>
									<li class="mb-4">
										<a href="?c=<?php echo $s->c ?>&a=<?php echo $s->a ?>" <?php echo $s->attributes ?> class="text-gray-300 text-sm flex items-center hover:text-gray-100 before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3"><?php echo isset($lang[$s->subtitle]) ? $lang[$s->subtitle] : $s->subtitle ?></a>
									</li>
								<?php }} ?>
							</ul>
						</li>
					<?php }} ?>
				</ul>
			</div>
			<div class="fixed top-0 left-0 w-full h-full bg-black/50 z-40 hidden sidebar-overlay"></div>
			<main class="w-full bg-gray-100 min-h-screen transition-all main active" style="background-image: url('app/assets/img/bubbles.png');background-repeat: no-repeat;background-size:450px;">
				<div class="py-2 px-6 bg-white flex items-center shadow-md shadow-black/5 sticky top-0 left-0 z-30">
					<button type="button" class="text-lg text-gray-600 sidebar-toggle mr-4">
					<i class="ri-menu-line"></i>
					</button>
					<ul class="flex items-center text-sm">
						<li class="mr-2">
							<a href="#" class="text-gray-400 hover:text-gray-600 font-medium">Dashboard</a>
						</li>
						<li class="text-gray-600 mr-2 font-medium">/</li>
						<li class="text-gray-600 mr-2 font-medium">Analytics</li>
					</ul>
					<ul class="ml-auto flex items-center">
						<?php require_once "alerts.php" ?>
						<li class="dropdown" x-data="{ isOpen: false}">
							<button type="button" 
								class="text-gray-400 w-8 h-8 rounded flex items-center justify-center hover:bg-gray-50 hover:text-gray-600"
								@click="isOpen = !isOpen" 
							>
								<i class="ri-user-line"></i>
							</button>
							<ul 
								class="my-2 shadow-md shadow-black/5 z-30 py-1.5 rounded-md bg-white border border-gray-100 w-full max-w-[140px]" 
								style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate3d(-24px, 48px, 0px);"
								x-show="isOpen"
								@click.away="isOpen = false"
							>
								<li>
									<a href="#" class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">Profile</a>
								</li>
								<li>
									<a href="?c=Home&a=Logout" class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">Logout</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
      	<script src="app/assets/js/script.js"></script>