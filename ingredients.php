<?php
session_start();
  include 'includes/conn.php';
  $activeTopView = 'baker';
  include 'includes/header.php';
   $action = '';
   if(isset($_POST['action']) and $_POST['action'] == 'DELETE_INGREDIENTS' and isset($_POST['ingredient']) and $_POST['ingredient'] != '' ){
      $action = "DELETE_INGREDIENTS";
      $sql ="DELETE from ingredients where id =". $_POST['ingredient'] ;
      $retdd = pg_query($db, $sql);
      if(!$retdd) {
          echo pg_last_error($db);
          exit;
       } else {
          $_SESSION['success'] ='Record DELETED Successfully !!';
       }
      
   }
  $ingredients_name='';
  $ingredients_quantity ='';
  $ingredients_price ='';
  $ingredients_location ='';
   if(isset($_GET['action']) and $_GET['action'] == 'EDIT_INGREDIENTS' and isset($_GET['ingredient']) and $_GET['ingredient'] != '' ){
      $action = "EDIT_INGREDIENTS";
      $sql ="SELECT * FROM ingredients where id =". $_GET['ingredient'] ;
      $retd = pg_query($db, $sql);
      while($rowd = pg_fetch_row($retd)) {
        $ingredients_id=$rowd[0];
        $ingredients_name=$rowd[1];
        $ingredients_quantity= $rowd[2];
        $ingredients_price= $rowd[3];
        $ingredients_location= $rowd[4];
        break;
      }
   }

  $sql ="SELECT * from ingredients";
  $ret = pg_query($db, $sql);
   if(!$ret) {
      echo pg_last_error($db);
      exit;
   }
$activeView = "ingredient";
include 'includes/bakerHeader.php';
  ?>
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
  <style type="text/css">
    
  </style>
  <form action="includes/actions.php" method="POST" class="border-4 border-dashed border-gray-200 rounded-lg">
    <div class="shadow sm:rounded-md sm:overflow-hidden">
      <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
        <div class="grid grid-cols-4 gap-6">
          <div class="col-span-1 sm:col-span-2">
            <label for="supplier name" class="block text-sm font-medium text-gray-700 input-label-div">
              Ingredients Name 
            </label>
            <div class="mt-1 flex rounded-md shadow-sm input-box">
              <input type="text" name="ingredients_name" id="ingredients_name" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300 pl-5" value="<?php echo($ingredients_name) ?>">
            </div>
          </div>
          <div class="col-span-1 sm:col-span-2">
            <label for="supplier name" class="block text-sm font-medium text-gray-700 input-label-div">
              Ingredients Quantity 
            </label>
            <div class="mt-1 flex rounded-md shadow-sm input-box">
              <input type="number" name="ingredients_quantity" id="ingredients_quantity" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300 pl-5" value="<?php echo($ingredients_quantity) ?>">
            </div>
          </div>
           <div class="col-span-1 sm:col-span-2">
            <label for="supplier name" class="block text-sm font-medium text-gray-700 input-label-div">
              Ingredients Price
            </label>
            <div class="mt-1 flex rounded-md shadow-sm input-box">
              <input type="number" name="ingredients_price" id="ingredients_price" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300 pl-5" value="<?php echo($ingredients_price) ?>">
            </div>
          </div>
          <div class="col-span-1 sm:col-span-2">
            <label for="supplier name" class="block text-sm font-medium text-gray-700 input-label-div">
              Ingredients Location
            </label>
            <div class="mt-1 flex rounded-md shadow-sm input-box">
              <input type="text" name="ingredients_location" id="ingredients_location" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300 pl-5" value="<?php echo($ingredients_location) ?>">
            </div>
          </div>
        </div>
      </div>
      <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
        <!-- <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" name="ADD_SUPPLIER">
          Save
        </button> -->
        <input class="inline-flex justify-center py-2 px-4 shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" type="submit" name="ADD_INGREDIENTS" value="Add New">
        <?php if($action == 'EDIT_INGREDIENTS' and isset($ingredients_id) and $ingredients_id != ''){ ?> 
          <input type="hidden" name="ingredients_id" value="<?php echo($ingredients_id) ?>">
          <input class="inline-flex justify-center py-2 px-4 shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500" type="submit" name="UPDATE_INGREDIENTS" value="Update">
        <?php } ?>

      </div>
    </div>
  </form>
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
                      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        ID
                      </th>
                      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Name
                      </th>
                      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Location
                      </th>
                      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Quantity
                      </th>
                      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Price
                      </th>
                      
                       
                      <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Operations
                      </th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200">
                    <?php while($row = pg_fetch_row($ret)) { 
                      ?>
      
                    <tr class="<?php if($row[2] <= 0){ echo "bg-red-300";}?>">
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                          <div class="">
                            <div class="text-sm font-medium text-gray-900">
                              <?php echo$row[0]?>
                            </div>
                          </div>
                        </div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900"><?php echo$row[1]?></div>
                        <!-- <div class="text-sm text-gray-500">Optimization</div> -->
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900"><?php echo$row[4]?></div>
                        <!-- <div class="text-sm text-gray-500">Optimization</div> -->
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900"><?php echo$row[2]?></div>
                        <!-- <div class="text-sm text-gray-500">Optimization</div> -->
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900"><?php echo$row[3]?></div>
                        <!-- <div class="text-sm text-gray-500">Optimization</div> -->
                      </td>
                      
                      <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <form method="get" class="inline-block">
                          <input type="hidden" value="EDIT_INGREDIENTS" name="action" />
                          <input type="hidden" value="<?php echo$row[0]?>" name="ingredient" />
                          <input type="submit" class="inline-flex justify-center py-2 px-4 shadow-sm text-sm font-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" value="Edit">
                          <!-- <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a> -->
                        </form>
                      <!-- </td>
                      <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium"> -->
                         <form method="POST" class="inline-block">
                            <input type="hidden" value="DELETE_INGREDIENTS" name="action" />
                            <input type="hidden" value="<?php echo$row[0]?>" name="ingredient" />
                            <input type="submit" class="inline-flex justify-center py-2 px-4 shadow-sm text-sm font-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" value="Delete">
                          </form>
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