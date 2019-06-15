<?php
/*
Template name:データAPI
*/
if(!isset($_GET['type'])) $_GET['type'] = 'restroom';
if(!isset($_GET['size'])) $_GET['size'] = 5;
if(!isset($_GET['more'])) $_GET['more'] = 0;
?>

[
    <?php
    if($_GET['type'] == 'all') $type = ['restroom','elevator','food','convenience','amusement'];
    else $type = explode(',',$_GET['type']);

    $api_query = new WP_Query(
    array(
        'post_type'      => $type,
        'posts_per_page' => $_GET['size'],
    )
    );
    ?>
    <?php if ( $api_query->have_posts() ) : ?>
    <?php while ( $api_query->have_posts() ) : ?>
        <?php $api_query->the_post();?>
        {
            <?php //共通データ ?>
            "post_type" : "<?php echo get_post_type();?>"
            "url" : "<?php echo the_permalink();?>",
            "name" : "<?php echo get_field('info')['name'];?>",
            "info" : {
                "name" : "<?php echo get_field('info')['name'];?>",
                "dup" : "<?php echo get_field('info')['dup'];?>",
                "start_time" : "<?php echo get_field('info')['start_time'];?>",
                "end_time" : "<?php echo get_field('info')['end_time'];?>",
            }
            "gps_pos" : {
                "lat" : "<?php echo get_field('gps_pos')['lat'];?>",
                "lng" : "<?php echo get_field('gps_pos')['lng'];?>",
                "dup" : "<?php echo get_field('gps_pos')['dup'];?>",
            },
            <?php //トイレ情報 ?>
            <?php if(get_field('post_type') == 'restroom'):?>
                <?php if($_GET['more'] == 1):?>
                "room_breadth" : "<?php echo get_field('metas')['room_breadth'];?>",
                "fold_the_bar" : "<?php echo get_field('metas')['fold_the_bar'];?>",
                "side_space" : "<?php echo get_field('metas')['side_space'];?>",
                "hand_height" : "<?php echo get_field('metas')['hand_height'];?>",
                "benza_height" : "<?php echo get_field('metas')['benza_height'];?>",
                "clean" : "<?php echo get_field('metas')['clean'];?>",
                <?php endif;?>
            <?php endif;?>
        },
    <?php endwhile; ?>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>
]