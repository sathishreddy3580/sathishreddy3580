<?php
session_start();
  include 'includes/conn.php';
  $activeTopView = 'customer';
  include 'includes/header.php';
  $sql ="SELECT o.id,p.name as pizza ,o.order_quantity,o.order_price,s.name as supplier,o.order_activity,o.status,o.have_ingredients,p.size from orders o LEFT JOIN pizza p on p.id = o.pizza_id LEFT JOIN suppliers s on s.id = o.supplier_id order by o.id desc ";
  $ret = pg_query($db, $sql);
   if(!$ret) {
      echo pg_last_error($db);
      exit;
   }
  $activeView = "purchase";
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
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">

  <?php
    if(isset($_SESSION['error']) and $_SESSION['error'] != ''){
  ?>
        <div class="bg-red-200 relative text-red-500 py-3 px-3 rounded-lg mb-6">
          <?php echo $_SESSION['error']; ?>
        </div>
  <?php
      $_SESSION['error'] ='';
    }
  ?>
  <?php
    if(isset($_SESSION['success']) and $_SESSION['success'] != ''){
  ?>
        <div class="bg-green-200 relative text-green-500 py-3 px-3 rounded-lg mb-6">
          <?php echo $_SESSION['success']; ?>
        </div>
  <?php
      $_SESSION['success'] ='';
    }
  ?>
  <!-- Replace with your content -->
  <div class="px-4 py-6 sm:px-0">
    <div class="border-4 border-dashed border-gray-200 rounded-lg">
       <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="flex flex-col">
          <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
              <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                  <thead class="bg-gray-50">
                    <tr>
                      <!-- <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        ID
                      </th> -->
                      <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Pizza
                      </th>
                      <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Ingredients
                      </th>
                      <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Quantity
                      </th>
                      <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Price
                      </th>
                      
                      <!-- <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Supplier
                      </th> -->
                      <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Ordered on
                      </th>
                       
                      <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Status
                      </th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200">
                    <?php while($row = pg_fetch_row($ret)) { 
                        $class = "";
                        if($row[6] == 'P'){
                            // pending
                            $class = "bg-yellow-200";
                          }else if($row[6] == 'C'){
                            // completed
                            $class = "bg-green-500";
                          }else if($row[6] == 'S'){
                            // in progress
                            $class = "bg-blue-200";
                          }
                          else{
                            // cancel D
                            $class = "bg-red-200";
                          }

                      ?>
      
                    <tr class="<?php echo $class;?>">
                      <td class="px-6 py-4 whitespace-nowrap text-center">
                        <div class="text-sm text-gray-900"><?php echo$row[1]?> <br> Size: <?php echo$row[8]?></div>
                        <!-- <div class="text-sm text-gray-500">Optimization</div> -->
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap text-center">
                        <div class="text-sm text-gray-900">
                            <?php
                              if($row[7] == '1'){
                                $sql ="select i.name from order_ingredient oi Left join ingredients i on i.id = oi.ingredient_id where oi.order_id = $row[0]";
                                $ingredients_ret = pg_query($db, $sql);
                                if(!$ingredients_ret) {
                                    echo pg_last_error($db);
                                    exit;
                                }
                                while($ingredient_name = pg_fetch_row($ingredients_ret)) {
                                  // echo $ingredient_name[0];
                                  echo "<span class='flex flex-wrap bg-gray-100 p-1 text-xs font-xs ml-1 mb-1 justify-center rounded shadow'>$ingredient_name[0]</span>";
                                }
                              
                              }
                              else{
                                echo "No Ingredients";
                              }

                            ?>
                        </div>
                        <!-- <div class="text-sm text-gray-500">Optimization</div> -->
                      </td>
                      <td class="px-6 py-2 whitespace-nowrap text-center">
                        <div class="text-sm text-gray-900"><?php echo$row[2]?></div>
                        <!-- <div class="text-sm text-gray-500">Optimization</div> -->
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap text-center">
                        <div class="text-sm text-gray-900">$<?php echo$row[3]?></div>
                        <!-- <div class="text-sm text-gray-500">Optimization</div> -->
                      </td>

                      <td class="px-6 py-4 whitespace-nowrap text-center">
                        <div class="text-sm text-gray-900"><?php echo$row[5]?></div>
                        <!-- <div class="text-sm text-gray-500">Optimization</div> -->
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                          <?php
                          if($row[6] == 'P'){
                            // pending
                            echo "<span class='flex flex-wrap text-white bg-yellow-700 p-1 text-xs font-xs ml-1 mb-1 justify-center rounded shadow'>Pending</span>";
                          }else if($row[6] == 'S'){
                            // in progress
                            echo "<span class='flex flex-wrap text-white bg-blue-700 p-1 text-xs font-xs ml-1 mb-1 justify-center rounded shadow'>In Progress</span>";
                          }else if($row[6] == 'D'){
                            echo "<span class='flex flex-wrap text-white bg-red-700 p-1 text-xs font-xs ml-1 mb-1 justify-center rounded shadow'>Canceled</span>";
                          }else{
                            echo "<span class='flex flex-wrap text-white bg-green-700 p-1 text-xs font-xs ml-1 mb-1 justify-center rounded shadow'>Completed</span>";
                          }
                          ?>
                      </td>
                    </tr>
                    <?php } ?>

                    <!-- More items... -->
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

    </div>
  </div>
  <!-- /End replace -->

</div>



<?php
  include 'includes/footer.php';
?>