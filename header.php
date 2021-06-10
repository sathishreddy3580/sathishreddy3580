<?php
$activeLinkTopClass = "bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium";
$linkTopClass = "text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium";
if(!isset($activeTopView)){
  $activeTopView = "";
}

?>
<!doctype html>
<html>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
  <!-- ... -->
  <style type="text/css">
  .input-label-div{
    display: inline-block;
  }
  .input-box{
    height: 42px;
    border: 1px dashed #ddd;
    display: inline-flex;
    width: 100%;
  }
  .input-box.h-auto-important{
    height: auto !important;
  }
  </style>
</head>
<body>
  <!-- ... -->
  <!-- This example requires Tailwind CSS v2.0+ -->
<div>
  <nav class="bg-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16">
        <div class="flex items-center">
          <!-- <div class="flex-shrink-0">
            <img class="h-8 w-8" src="https://tailwindui.com/img/logos/workflow-mark-indigo-500.svg" alt="Workflow">
          </div> -->
          <div class="hidden sm:block">
            <div class=" flex items-baseline space-x-4">
              <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
              <a href="pizza.php" class="<?php if($activeTopView == 'baker'){ echo ($activeLinkTopClass); }else{ echo ($linkTopClass); } ?>">Baker</a>
              <a href="index.php" class="<?php if($activeTopView == 'customer'){ echo ($activeLinkTopClass); }else{ echo ($linkTopClass); } ?>">Customer</a>
            </div>
          </div>
        </div>
        <div class="hidden sm:block">
          <div class="ml-4 flex items-center md:ml-6">
            <button class="bg-gray-800 p-1 rounded-full text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
              <span class="sr-only">View notifications</span>
              <!-- Heroicon name: bell -->
              <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
              </svg>
            </button>

            
          </div>
        </div>
      </div>
    </div>
  </nav>