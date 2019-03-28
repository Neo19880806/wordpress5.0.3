<?php
    /* JAC MP 2018 */

//    $who = $_GET["who"];
//    $circumstance = $_GET["when"];
//    $considerations = $_GET["considerations"];
//    
//    $information = $_GET["information"];
//    $providers = $_GET["providers"];
  
    $who = "test";
    $circumstance = "test";
    $considerations = "test";
    
    $information = "test";
    $providers = "test";
    
    get_header(); ?>
    
    <div class="wrap">
	    <div class="container main-container">
	        <div class="row">
	            <div class="col-md-offset-2 col-md-8">
    		        <main id="main" class="site-main" role="main">

    
        <?php   
            echo ('<h1>Your search results</h1>');
            
            // set up query from form data
            $category_selections = "";
            
            if ($who != 'unselected') {
                $category_selections .= $who.', ';
            }
            
            if ($circumstance != 'unselected') {
                $category_selections .= $circumstance.', ';
            }
            
            if ($considerations != 'unselected') {
                $category_selections .= $considerations;
            }
                
                
            // create query
            $args = array(
                'category_name' => $category_selections
                );
                
            $posts_query = new WP_Query($args);
        
            // display query results for information
            if($information == 'on') {
                echo ('<h3>The following articles may be of help.</h3>');
                echo '<div class="filler"></div>';
                if ($posts_query->have_posts() && $category_selections != "" && $information == 'on') {
                    while($posts_query->have_posts()) {
                        $posts_query->the_post();
                        $link = get_permalink();
                        echo '<a class="search-result-link" href="'.$link.'"><h4 class="search-result-title">'.get_the_title().'</h4></a><br>';
                        $content = get_the_content();
                        echo '<p>'.wp_trim_words($content, 50, '... <a class="read-more" href="'.$link.'">Read More</a>').'</p>';
                    }
                    wp_reset_postdata();
                } else {
                    echo ('No posts found.<div class="filler"></div>');
                }
            }
            
            // display query results for support providers
            if($providers == 'on') {
                echo ('<h3>Support providers are listed below.</h3>');
                echo '<div class="filler"></div>';
                
                // TODO awaiting list of support providers from client
                echo ('Yet to be implemented...');
            }
            
            // if no checkbox has been selected
            if($information != 'on' && $providers != 'on') {
                echo('<h3>You have not selected anything for searching</h3>');
                echo('<p>To continue, make sure you have selected the check boxes.</p>');
            }
    
            ?>
    
            </main><!-- #main -->
        </div>
    </div>
</div>
    
<?php
    get_footer();
?>