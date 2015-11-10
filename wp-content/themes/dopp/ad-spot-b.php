<div class="row">
            <div id="ad-b" class="col-sm-12">
                <div class="ad-leaderboard-b">
                    
                    
    <?php 
        $post_id = '4126'; //2917 is DEV, 4126 is live
        $post_status = get_post_status( $post_id ); 
        $featured_img = get_post_thumbnail_id( $post_id );
        $ad_2_img = wp_get_attachment_url( $featured_img );
        $ad_2_link = get_post_meta( $post_id, 'ad_spot_2_link', true ); 

        if ( $post_status == 'publish' ) {
            echo '<a href="'.$ad_2_link.'"><img src="'.$ad_2_img.'" width="100%"></a>';
        }else{
            
            // do nothing
        }
    ?>
                    
                </div>
            </div>
        </div>