<?php
/*
Template name:トップページ
*/

get_header();
?>
<link rel="stylesheet" href="style/material.min.css">
<link rel="stylesheet" href="style/home.min.css">
</head>
<body>
<header id="mainHeader">
    <hgroup>
        <h1>バリアフリーマップ</h1>
        <h2>- 蒲田 -</h2>
    </hgroup>
    <p>
        このサイトは日本工学院 蒲田校に入学を検討している車椅子ユーザーのためのWebサイトです。
    </p>
</header>
<script>
 console.log("<?php echo the_field('info')['name'];?>");
</script>
<div style="position:fixed;z-index:10000">
    <?php echo var_dump(the_field('info'));?>
</div>
<main id='mainMain'>
    <section id="googlemap">
        <google-map
        :center="center"
        :zoom="mapZoom"
        :gestureHandling="none"
        style="width: 100%; height: 100%; display: inline-block">
            <gmap-info-window
            :options="infoOptions"
            :position="infoWindowPos"
            :opened="infoWinOpen"
            @closeclick="infoWinOpen=false">
                <div class='pinPopup'>
                    <img :src="infoContent.photo" :alt="infoContent.name">
                    <h4><?php echo the_field('genre');?></h4>
                    <h3><?php echo the_field('info')['name'];?></h3>
                    <p class='cost'><?php echo the_field('cost')['min'];?>~<?php echo the_field('cost')['max'];?>~<?php echo the_field('cost')['max'];?></p>
                    <p class='time'><?php echo the_field('info')['start_time'];?>-<?php echo the_field('info')['end_time'];?></p>
                    <p class='sougouhyouka'>総合評価<?php echo the_field('sougouhyouka');?></p>
                    
                </div>
            </gmap-info-window>
            <gmap-marker
            :key="i"
            v-for="(pin,i) in markers"
            :position="pin.gps_pos"
            :clickable="true"
            :icon='pin.icon'
            @click="[toggleInfoWindow(pin,i),center = pin.gps_pos,activePin = pin.name]">
            </gmap-marker>
        </google-map>
    </section>

	





</main>

<?php get_footer()?>
<!--このページ固有のScript-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>
<script src="js/vue-google-maps.js"></script>
<script><?php include('js/home.js');?></script>
<script defer src="js/material.min.js"></script>

<?php wp_footer(); ?>
</body>
</html>