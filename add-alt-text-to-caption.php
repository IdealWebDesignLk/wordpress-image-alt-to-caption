//note:
// these code add for all the 
    add_action('wp', 'how_we_do_it_meta');

    function how_we_do_it_meta()
    {
        $args = array(
            'post_type' => 'attachment',
            'posts_per_page' => -1,
        );
        $query = new WP_Query($args);


        $attachments = get_posts($args);
        if ($attachments) {
            foreach ($attachments as $post) {

                $caption = $post->post_excerpt;
                $alt_text = get_post_meta($post->ID, '_wp_attachment_image_alt', true);


                if ($caption == "") {
                    if ($alt_text != "") {
                        $attachment_post = array(
                            'ID' => $post->ID,
                            'post_excerpt' => $alt_text
                        );
                        $err =  wp_update_post($attachment_post);
                    }
                }
            }
        }
    }
