<?php
/*
Template name:トップページ
*/

get_header();
?>
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
<main id='mainMain'>
    <section id="googlemap">
        <google-map :center="center" :zoom="mapZoom" style="width: 50%; height: 100vh; display: inline-block">
                
                <gmap-info-window :options="infoOptions" :position="infoWindowPos" :opened="infoWinOpen" @closeclick="infoWinOpen=false">
                        {{infoContent}}
                </gmap-info-window>
                <gmap-marker :key="i" v-for="(m,i) in markers" :position="m.position" :clickable="true" @click="[toggleInfoWindow(m,i),center = m.position,activePin = m.infoText]"></gmap-marker>
            </google-map>
    </section>
</main>

<?php get_footer()?>
<!--このページ固有のScript-->
<script src="js/vue-google-maps.js"></script>
<script><?php include('js/home.js');?></script>

<?php wp_footer(); ?>
</body>
</html>