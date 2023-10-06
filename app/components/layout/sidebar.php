<div @mouseover="sidebar = !sidebar" class="left-side fixed top-0 left-0 w-8 h-full z-50""></div>
<div x-bind:class="{ '': sidebar, '-translate-x-full': !sidebar }"
  class="overflow-auto fixed left-0 top-0 w-64 h-full bg-gray-900 p-4 z-50 transition-transform -translate-x-full">
  <a class="flex items-center pb-4 border-b border-b-gray-800">
    <img src="app/assets/img/logo.png" class="w-[75%] mx-auto"/>
    <!-- <img src="app/assets/logo.png" alt="" class="w-8 h-8 rounded object-cover"/> -->
    <!-- <span class="text-lg font-bold text-white ml-3">Componenti</span> -->
  </a>
  <ul class="mt-4 flex-1">
    <?php
    $permissionsTitle = array();
    foreach($permissions as $p) { 
      $permissionsTitle[] = $this->model->get('*','permissions', "and id = $p")->title;
    };
    foreach($this->model->list('title,icon','permissions', " and type = 'menu' GROUP BY title ORDER BY sort ASC") as $t) { 
    if (in_array($t->title, $permissionsTitle)) { ?>
      <li class="mb-1 group" x-data="{ dropdown: false}">
        <a 
          href="#" 
          class="flex items-center py-2 px-4 text-gray-300 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100"
          @click="dropdown = !dropdown">
            <?php echo $t->icon ?>
            <span class="text-sm"><?php echo isset($lang[$t->title]) ? $lang[$t->title] : $t->title?></span>
            <i class="ri-arrow-right-s-line ml-auto group-[.selected]:rotate-90"></i>
        </a>
        <ul
          class="pl-7 mt-2 group-[.selected]:block"
          x-show="dropdown"
          @click.away="dropdown = false">
          <?php foreach($this->model->list('id,url,subtitle','permissions'," and type = 'menu' AND title = '$t->title' ORDER BY sort ASC") as $s) {
          if (in_array($s->id, $permissions)) { ?>
            <li class="mb-4">
              <a @click="sidebar = !sidebar" hx-on:htmx:after-request="document.getElementById('title').innerHTML = '<?php echo "$t->title / $s->subtitle" ?>';" hx-get="<?php echo $s->url ?>" hx-target="#content" hx-trigger="click" class="cursor-pointer text-gray-300 text-sm flex items-center hover:text-gray-100 before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3"><?php echo isset($lang[$s->subtitle]) ? $lang[$s->subtitle] : $s->subtitle ?></a>
            </li>
          <?php }} ?>
        </ul>
      </li>
    <?php }} ?>
  </ul>
</div>
<div @mouseover="sidebar = !sidebar" 
  @click="sidebar = !sidebar"
  x-bind:class="{ '': sidebar, '-translate-x-full': !sidebar }" class="fixed top-0 left-0 w-full h-full bg-black/50 z-40">
</div>