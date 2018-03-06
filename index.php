<?php
    $backgroundImage = "img/sea.jpg";
    include 'api/pixabayAPI.php';
    
    if(isset($_GET['layout']))
    {
        if(!$_GET['category']==""){
            $category = $_GET['category'];
            $imageURLs = getImageURLs($_GET['category'], $_GET['layout']);
            $backgroundImage = $imageURLs[array_rand($imageURLs)];
        } 
        else 
        {
            if(isset($_GET['keyword'])){
             $keyword = $_GET['keyword'];
             $imageURLs = getImageURLs($_GET['keyword'],$_GET['layout']);
             $backgroundImage = $imageURLs[array_rand($imageURLs)];
            }
        }
    }
    else{
        if(!$_GET['category']==""){
        $category = $_GET['category'];
        $imageURLs = getImageURLs($_GET['category']);
        $backgroundImage = $imageURLs[array_rand($imageURLs)];
        } else {
            if(isset($_GET['keyword'])){
             $keyword = $_GET['keyword'];
             $imageURLs = getImageURLs($_GET['keyword']);
             $backgroundImage = $imageURLs[array_rand($imageURLs)];
            }   
        
        }   
    
    }
 
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Image Carousel</title>
        <meta charset="utf-8">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">        
        <style>
            @import url("css/styles.css");
            body{
                background-image: url('<?=$backgroundImage ?>');
                background-size: 100% 100%;
                background-attachment: fixed;
            }
        </style>
    </head>
    <body>
        <br/> <br />
        <form>
        <input type="text" name = "keyword" placeholder = "Keyword" value=""/>
        <div id="layoutDiv">
        <input type= "radio" id = "horizontal" name = "layout" value = "horizontal">
        <label for  = "horizontal" ></label><label for = "horizontal">Horizontal</label><br />
        <input type= "radio" id = "vertical" name = "layout" value = "vertical">
        <label for  = "vertical" ></label><label for = "vertical">Vertical</label><br />
        </div>
        <br />
        <select id = "dropdown" name = "category" >
        <option value = "">Select One</option>
            <option value="ocean">Sea</option>
            <option>Forest</option>
            <option>Mountain</option>
            <option>Snow</option>
            <option>Sky</option>
            <option>Otters</option>
    </select><br /><br />
    <input type = "submit" value = "Submit" />
    </form>
    <br /><br />
    <?php
    
        if(!isset($imageURLs)){
            echo "<h2 id='selection'> Type a keyword or select a category to display a slideshow with Random Images from Pixabay.com <br /> ";
        }elseif (empty($_GET['keyword'])&&empty($_GET['category'])) {
            echo "<h2 id='category'> You need to select something or type a keyword. </h2>";
        }
        else{
            
        ?>
    
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
          <!-- Indicators -->
           <ol class="carousel-indicators">
               <?php
               for($i = 0; $i < 7; $i++){
                   echo "<li data-target='#carousel-example-generic' data-slide-to='$i'";
                   echo($i == 0)?"class='active'": "";
                   echo "></li>";
               }
               ?>

          </ol>
          
          <div class="carousel-inner" role="listbox">
        <?php
            for($i = 0; $i < 7; $i++){
                do{
                    $randomIndex = rand(0, count($imageURLs));
                }
                while(!isset($imageURLs[$randomIndex]));
                
                echo '<div class="item ';
                echo ($i==0)?"active":"";
                echo '">';
                echo '<img src = "' . $imageURLs[$randomIndex] . '">';
                echo '</div>';
                unset($imageURLs[$randomIndex]);
            
            }
            
            ?>
            
            </div>
                  <!-- Controls -->
              <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
               <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
                
        <?php
            }
        ?>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        
    <script src = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    </body>
</html>