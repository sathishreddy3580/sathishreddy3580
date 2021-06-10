<?php
  session_start();
  include 'includes/conn.php';
  $activeTopView = 'customer';
  include 'includes/header.php';
   $sql ="SELECT * from ingredients where quantity::numeric > 0";
  $ingredientsRet = pg_query($db, $sql);
  if(!$ingredientsRet) {
      echo pg_last_error($db);
      exit;
  }
  $image = 1;
  if(isset($_GET['count'])){
    $image = $_GET['count'];
  }
  if(isset($_GET['pizza'])){
    $pizza = $_GET['pizza'];
    $sql ="SELECT * from pizza where id = $pizza limit 1";
    $pizzaRet = pg_query($db, $sql);
    if(!$pizzaRet) {
        echo pg_last_error($db);
        exit;
    }
    if(pg_num_rows($pizzaRet)>0){
      while($rowd = pg_fetch_row($pizzaRet)) {
        $pizza_deails = $rowd;
        break;
      }
    }
    else
    {
      header("Location: index.php");
    }
  }
  else{
    header("Location: index.php");
  }
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
<div class="antialiased bg-gray-200 font-sans">
    <div class="max-w-8xl mx-auto ">
        <div class="flex items-center justify-center">
          <div class="container mx-auto p-10">
            <form action="includes/actions.php" method="post" id="form">
              <div class="grid grid-cols-3 gap-3">
                <div class="bg-white rounded shadow p-8 col-span-2 ">
                  <!-- Order Summary  -->
                  <div>
                    <h3 class="text-xl mt-4 font-bold">Order Summary</h3>
                    <!--     BOX     -->
                    <div class="border w-full rounded mt-5 flex p-4 justify-between flex-wrap">
                      <img src="img/<?php echo $image; ?>.jpg" class="w-1/6 rounded shadow" style="max-height: 145px;">
                      <div class="w-2/3 ">
                        <h3 class="text-lg font-medium"><?php echo $pizza_deails[1] ?> • <?php echo$pizza_deails[4]?></h3>
                        <p class="text-gray-600 text-xs"><?php echo$pizza_deails[2]?></p>
                        <h4 class="text-red-700 text-xs font-bold mt-1">Ingridients</h4>
                        <div class="flex flex-col mt-1">
                          <?php while($ingredient = pg_fetch_row($ingredientsRet)) { ?>
                            <label class="inline-flex items-center mt-1">
                                <input type="checkbox" class="form-checkbox h-3 w-3 text-gray-600 order_ingredient_class" name="order_ingredient[]" value="<?php echo $ingredient[0]; ?>" data-price="<?php echo$ingredient[3]?>">
                                <span class="ml-2 text-gray-700 text-xs"><?php echo $ingredient[1]; ?> (<?php echo$ingredient[2]?> available) • $<?php echo$ingredient[3]?></span>
                            </label>
                          <?php  } ?>
                        </div>
                      </div>
                      <div class="text-right">
                        <h4 class="text-3xl font-medium"><sup class="text-lg text-purple-800">$</sup><span id="basicVal"><?php echo$pizza_deails[3]?></span></h4>
                        <h5 class="text-sm font-bold text-purple-800">Base Price</h5>
                        <div class="w-full flex justify-right mt-4">
                          <label class="block uppercase tracking-wide text-gray-700" for="grid-first-name">
                            QTY
                            <select id="ingredients_quantity_select" class="ml-3 text-sm bg-purple-700 border border-purple-200 text-white p-2 rounded leading-tight" id="grid-state" name="order_quantity">
                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                              <option value="4">4</option>
                              <option value="5">5</option>
                              <option value="6">6</option>
                              <option value="7">7</option>
                              <option value="8">8</option>
                              <option value="9">9</option>
                            </select>
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="flex justify-between flex-wrap w-full">
                  <div class="bg-white rounded shadow p-2 w-full">
                    <div class="w-full bg-orange-200 px-8 py-6">
                      <h3 class="text-2xl mt-4 font-bold">Price Breakdown</h3>
                      <div class="flex justify-between mt-3">
                        <div class="text-lg text-orange-900 font-bold">Amount</div>
                        <div class='text-lg text-right font-bold'>$<span id="total_ammount"><?php echo$pizza_deails[3]?></span></div>
                      </div>
                      <div class="flex justify-between mt-3">
                        <div class="text-lg text-orange-900 font-bold">Ingredients</div>
                        <div class='text-lg text-right font-bold'>$<span id="ingredient_price_field">0</span></div>
                      </div>
                      <div class="bg-orange-300 h-1 w-full mt-3"></div>
                      <div class="flex justify-between mt-3">
                        <div class="text-lg text-orange-900 font-bold">Total Amount</div>
                        <div class="text-2xl text-orange-900 font-bold">$<span id="total_price_field"><?php echo$pizza_deails[3]?></span></div>
                      </div>
                      <input type="hidden" name="pizza_id" value="<?php echo$pizza_deails[0]?>">
                      <input type="hidden" name="order_price" id="total_price_input" value="<?php echo$pizza_deails[3]?>">

                      <input type="submit" name="CHECKOUT" value="CHECKOUT" class="px-4 py-4 bg-purple-700 text-white w-full mt-3 rounded shadow font-bold hover:bg-purple- 900" />
                    </div>
                  </div>
                  <!-- <div class="bg-white rounded shadow px-10 py-6 w-full mt-4 flex flex-wrap justify-center">
                    <div class="pr-8">
                    <h3 class="text-2xl mt-4 font-bold text-purple-900">Thank You, Alex</h3>
                    <h4 class="text-sm text-gray-600 font-bold">ORDER #5624</h4>
                    </div>
                    <img src="https://image.flaticon.com/icons/svg/1611/1611768.svg" alt="" class="w-24">
                  </div> -->
                </div>
              </div>
            </form>
          </div>
        </div>
    </div>

</div>


<?php
  include 'includes/footer.php';
?>

<script type="text/javascript">
  
  $(".order_ingredient_class").change(function() {
      var newPrice = 0;
      $('.order_ingredient_class:checked').each(function() {
          newPrice += parseInt($(this).data('price'),10);
      });
      $('#ingredient_price_field').html(newPrice);
      var total_price = parseInt($("#total_ammount").text()) + parseInt($("#ingredient_price_field").text());
      $("#total_price_field").html(total_price);
      $("#total_price_input").val(total_price);
  });
  $("#ingredients_quantity_select").change(function() {
        var val = parseInt($(this).val());
        var basVal = parseInt($("#basicVal").text());
        var total_ammount = basVal * val;
        $("#total_ammount").html(total_ammount);
        var total_price = parseInt($("#total_ammount").text()) + parseInt($("#ingredient_price_field").text());
        $("#total_price_field").html(total_price);
        $("#total_price_input").val(total_price);
});

</script>