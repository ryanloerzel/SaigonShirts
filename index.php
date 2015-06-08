<?php 

require_once("config.php");

/*Controller Logic*/
include(ROOT_PATH . "/inc/products.php"); 
$recent = get_products_recent();

$pageTitle = "Saigon Shirts";
$section ="home";
include(ROOT_PATH . "/inc/header.php"); ?>
                          
        <div class="banner">
            <img src="<?php echo BASE_URL; ?>img/sunburst.png" id="sunburst">
            <div class="container">
                <img src="<?php echo BASE_URL; ?>img/suns_out.svg" id="slogan">
               <!--  <h2>SUNS OUT.<br>GUNS OUT.</h2> -->
                <img src="<?php echo BASE_URL; ?>img/girl2.png" id="girl">
            </div>
        </div>

        <div class="latest_shirts">
            <div class="container">
                <h1>Featured Shirts</h1>
          
                <ul class="products">
                    <?php 
                        $list_view_html = "";
                        foreach($recent as $product){                    
                            $list_view_html =  get_list_view_html($product) . $list_view_html;   
                        } 
                        echo $list_view_html;
                     ?>
                </ul>
            </div>
        </div>

<?php include(ROOT_PATH . "/inc/footer.php"); ?> 