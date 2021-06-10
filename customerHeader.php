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
        Customer
      </h1>
      <div class="flex items-center w-70" style="display: inline-flex;vertical-align: top;float: right;">
        <div class="hidden sm:block">
          <div class=" flex items-baseline space-x-4">
            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
            <a href="index.php" class="<?php if($activeView == 'home'){ echo ($activeLinkClass); }else{ echo ($linkClass); } ?>">Home</a>
            <a href="purchases.php" class="<?php if($activeView == 'purchase'){ echo ($activeLinkClass); }else{ echo ($linkClass); }  ?>" >Purchases</a>
          </div>
        </div>
      </div>
    </div>
</header>