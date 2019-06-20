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
        <google-map
        :center="center"
        :zoom="mapZoom"
        style="width: 100%; height: 100%; display: inline-block">
            <gmap-info-window
            :options="infoOptions"
            :position="infoWindowPos"
            :opened="infoWinOpen"
            @closeclick="infoWinOpen=false">
                <div class='pinPopup'>
                    <h3>{{infoContent}}</h3>
                    <p>ピンのHTML</p>
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

    <section id="panel">
        <!--ジャンル選択パネル-->
        <section id="genre-panel" v-show='panel.activePanel == "genre"'>
            <header>
                <h2>さがす</h2>
            </header>
            <ul>
                <li><button @click='[panel.activeGenre = "restroom",panel.activePanel = "query",getAPI("restroom","init")]'>トイレ</button></li>
                <li><button @click='[panel.activeGenre = "food",panel.activePanel = "query",getAPI("food","init")]'>飲食店</button></li>
                <li><button @click='[panel.activeGenre = "convenience",panel.activePanel = "query",getAPI("convenience","init")]'>コンビニ</button></li>
                <li><button @click='[panel.activeGenre = "amusement",panel.activePanel = "query",getAPI("amusement","init")]'>アミューズメント</button></li>
            </ul>
        </section>

        <!--条件指定パネル-->
        <section id="query-panel" v-show='panel.activePanel == "query"'>
            <header>
                <button class="back" @click='[panel.activePanel = "genre",getAPI("all","init")]'>←</button>
                <h2>条件</h2>
                <button class="check" @click='[panel.activePanel = "list",getAPI(panel.activeGenre,panel.query[panel.activeGenre])]'>✔</button>
            </header>
            <!--ジャンル：トイレ-->
            <section class="restroom" v-show='panel.activeGenre == "restroom"'>
                <h3 class="none">トイレの検索条件</h3>
                <label for="rest-exsample1">exsample1</label><input type="text" id="rest-exsample1" v-model='panel.query.restroom.exsample1'>
            </section>
        </section>

        <!--リストパネル-->
        <section id="list-panel" v-show='panel.activePanel == "list"'>
            <header>
            <button class="back" @click='panel.activePanel = "query"'>←</button>
                <h2>検索結果</h2>
            </header>
            <ul>
                <li
                v-for='pin in markers'
                :class='{ activePin : activePin == pin.name }'
                @click='[center = pin.gps_pos,toggleInfoWindow(pin),activePin = pin.name]'>
                    <h3>{{pin.name}}</h3>
                </li>
            </ul>
        </section>
    </section>
</main>

<?php get_footer()?>
<!--このページ固有のScript-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>
<script src="js/vue-google-maps.js"></script>
<script><?php include('js/home.js');?></script>

<?php wp_footer(); ?>
</body>
</html>