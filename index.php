<?php
session_start();
  include 'includes/conn.php';
    $activeTopView = 'customer';
  include 'includes/header.php';

  $sql ="SELECT * from pizza";
  $pizzaRet = pg_query($db, $sql);
   if(!$pizzaRet) {
      echo pg_last_error($db);
      exit;
   }
  $sql ="SELECT * from ingredients where quantity::numeric > 0";
  $ingredientsRet = pg_query($db, $sql);
  if(!$ingredientsRet) {
      echo pg_last_error($db);
      exit;
  }
  $ingredients = "";
  while($ingredient = pg_fetch_row($ingredientsRet)) { 
    $ingredients .= $ingredient[1].' • '; 
  } 
    $ingredients = rtrim($ingredients," • "); 
  $activeView = "home";
  include 'includes/customerHeader.php';
  ?>
<div class="w-full m-0 p-0 bg-cover bg-bottom " style="background-image:url('img/banner2.jpg'); height: 200px; max-height:460px;">
    <div class="container max-w-4xl mx-auto pt-16 text-center break-normal">
      <!--Title-->
      <<!-- p class="text-purple-400 shadow-2xl font-extrabold text-3xl md:text-5xl">
        Our Pizza Shop
      </p> -->
    </div>
  </div>
<main>
<div class="antialiased bg-gray-200 font-sans pt-10">
    <div class="max-w-6xl mx-auto ">
        <div class="flex items-center justify-center">
            <div class="w-full py-6 px-3">
                <div class="grid grid-cols-3 gap-4">
                    <!-- PIZZA LIST ITEMS  -->
                  <?php 
                  $count = 0;
                  while($row = pg_fetch_row($pizzaRet)) { 
                    $count++;
                    if($count>5){ $count =1;}
                    ?>
                    <a class="cursor-pointer" href="pizza_detail.php?pizza=<?php echo $row[0]; ?>&count=<?php echo $count; ?>">
                        <div class="bg-white shadow-xl rounded-lg overflow-hidden">
                            <div class="bg-cover bg-center h-56 p-4" style="background-image: url('img/<?php echo $count; ?>.jpg')">
                                <div class="flex justify-end">
                                    <svg class="h-6 w-6 text-white fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path d="M12.76 3.76a6 6 0 0 1 8.48 8.48l-8.53 8.54a1 1 0 0 1-1.42 0l-8.53-8.54a6 6 0 0 1 8.48-8.48l.76.75.76-.75zm7.07 7.07a4 4 0 1 0-5.66-5.66l-1.46 1.47a1 1 0 0 1-1.42 0L9.83 5.17a4 4 0 1 0-5.66 5.66L12 18.66l7.83-7.83z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="p-4">
                                <p class="uppercase tracking-wide text-sm font-bold text-gray-700"><?php echo $row[1]; ?>  • <?php echo$row[4]?></p>
                                <p class="text-3xl text-gray-900">$<?php echo$row[3]?></p>
                                <p class="text-gray-700"><?php echo$row[2]?></p>
                            </div>
                            <div class="px-4 pt-3 pb-4 border-t border-gray-300 bg-gray-100">
                                <div class="text-sm uppercase font-bold  text-gray-600 tracking-wide">Ingredients Avaiable</div>
                                <div class="flex items-center pt-2">
                                    <!-- <div class="bg-cover bg-center w-10 h-10 rounded-full mr-3" style="background-image: url(https://images.unsplash.com/photo-1500522144261-ea64433bbe27?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=751&q=80)">
                                    </div> -->
                                    <div>
                                        <p class="text-xs text-gray-800">
                                          <?php echo $ingredients; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <!-- PIZZA LIST ITEMS  -->
                  <?php } ?>
                </div>
                
            </div>
        </div>
    </div>

</div>



<?php
  include 'includes/footer.php';
?>