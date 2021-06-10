<?php 
$activeLinkClass = "bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium";
$linkClass = "text-gray-900 hover:bg-gray-800 hover:text-white px-3 py-2 rounded-md text-sm font-medium";
if(!isset($activeView)){
  $activeView = "";
}

?>

<header class="bg-white shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
      <h1 class="text-3xl font-bold leading-tight text-gray-900 w-20 inline">
        Baker
      </h1>
      <div class="flex items-center w-70" style="display: inline-flex;vertical-align: top;float: right;">
        <div class="hidden sm:block">
          <div class=" flex items-baseline space-x-4">
            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
            <a href="pizza.php" class="<?php if($activeView == 'pizza'){ echo ($activeLinkClass); }else{ echo ($linkClass); } ?>">Pizza</a>
            <a href="ingredients.php" class="<?php if($activeView == 'ingredient'){ echo ($activeLinkClass); }else{ echo ($linkClass); } ?>" >Ingredient</a>
            <a href="supplier.php" class="<?php if($activeView == 'supplier'){ echo ($activeLinkClass); }else{ echo ($linkClass); } ?>" >Supplier</a>
            <a href="orders.php" class="<?php if($activeView == 'order'){ echo ($activeLinkClass); }else{ echo ($linkClass); }  ?>" >Orders</a>
          </div>
        </div>
      </div>
    </div>
</header>