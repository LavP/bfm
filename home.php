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
        :gestureHandling="none"
        style="width: 100%; height: 100%; display: inline-block">
            <gmap-info-window
            :options="infoOptions"
            :position="infoWindowPos"
            :opened="infoWinOpen"
            @closeclick="infoWinOpen=false">
                <div class='pinPopup'>
                    <img :src="infoContent.photo" :alt="infoContent.name">
                    <h3>{{infoContent.name}}</h3>
                    <p class='cost'>{{infoContent.minCost}}〜{{infoContent.maxCost}}円</p>
                    <p class='sougouhyouka'>総合評価 {{infoContent.sougouhyouka}}</p>
                    <p class='dup'>{{infoContent.dup}}</p>
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
                <li>
                    <button
                    @click='[panel.activeGenre = "restroom",panel.activePanel = "query",getAPI("restroom","init")]'>
                        <img src="images/pin/toire-C.svg" alt="">
                        <p>トイレ</p>
                    </button>
                </li>
                <li>
                    <button
                    @click='[panel.activeGenre = "food",panel.activePanel = "query",getAPI("food","init")]'>
                        <img src="images/pin/food-C.svg" alt="">
                        <p>飲食店</p>
                    </button>
                </li>
                <li>
                    <button
                    @click='[panel.activeGenre = "convenience",panel.activePanel = "query",getAPI("convenience","init")]'>
                        <img src="images/pin/store-C.svg" alt="">
                        <p>コンビニ</p>
                    </button>
                </li>
                <li>
                    <button
                    @click='[panel.activeGenre = "amusement",panel.activePanel = "query",getAPI("amusement","init")]'>
                        <img src="images/pin/mic-C.svg" alt="">
                        <p>アミューズメント</p>
                    </button>
                </li>
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
                <p>トイレ未定義</p>
            </section>
            <!--ジャンル：飲食-->
            <section class="food" v-show='panel.activeGenre == "food"'>
                <h3 class="none">飲食の検索条件</h3>
                <p>飲食未定義</p>
            </section>
            <!--ジャンル：アミューズメント-->
            <section class="amusement" v-show='panel.activeGenre == "amusement"'>
                <h3 class="none">アミューズメントの検索条件</h3>
                <p>アミューズメント未定義</p>
            </section>
            <!--ジャンル：コンビニ-->
            <section class="convenience" v-show='panel.activeGenre == "convenience"'>
                <h3 class="none">コンビニの検索条件</h3>
                <p>コンビニ未定義</p>
            </section>
        </section>

        <!--リストパネル-->
        <section id="list-panel" v-show='panel.activePanel == "list"'>
            <header>
                <button class="back" @click='panel.activePanel = "query"'>←</button>
                <h2>検索結果</h2>
            </header>
            <ul>
                <!--アミューズメントと飲食店のリスト項目-->
                <li
                v-if='panel.activeGenre == "food" || panel.activeGenre == "amusement"'
                v-for='pin in markers'
                :class='{ activePin : activePin == pin.name }'
                class="amusement food"
                @click='[center = pin.gps_pos,toggleInfoWindow(pin),activePin = pin.name]'>
                    <div class="header">
                        <p class="genre">{{pin.metas.genre}}</p>
                        <h3>{{pin.name}}</h3>
                    </div>
                    <dl class="metas">
                        <dt class="sougouhyouka">総合評価</dt>
                        <dd class="sougouhyouka">{{pin.metas.sougouhyouka}}</dd>
                        <dd class="cost none">値段</dd>
                        <dt class="cost">
                            {{pin.metas.cost.min}} 〜 {{pin.metas.cost.max}}円
                        </dt>
                    </dl>
                    <img :src="pin.eye" :alt="'写真'+pin.name" class="photo">
                </li>
                <!--トイレのリスト項目-->
                <li
                v-if='panel.activeGenre == "restroom"'
                v-for='pin in markers'
                :class='{ activePin : activePin == pin.name }'
                class="restroom"
                @click='[center = pin.gps_pos,toggleInfoWindow(pin),activePin = pin.name]'>
                    <div class="header">
                        <h3>{{pin.name}}</h3>
                    </div>
                    <dl class="metas">
                        <dt>使いやすさ</dt>
                        <dd>{{pin.metas.tukaiyasusa}}</dd>
                        <dt>美しさ</dt>
                        <dd>{{pin.metas.clean}}</dd>
                        <dt class='none'>使える時間</dt>
                        <dd>
                            <time>{{pin.metas.time[0]}}〜{{pin.metas.time[1]}}</time>
                        </dd>
                    </dl>
                    <img :src="pin.eye" :alt="'写真'+pin.name" class="photo">
                </li>
                <!--コンビニのリスト項目-->
                <li
                v-if='panel.activeGenre == "restroom"'
                v-for='pin in markers'
                :class='{ activePin : activePin == pin.name }'
                class="restroom"
                @click='[center = pin.gps_pos,toggleInfoWindow(pin),activePin = pin.name]'>
                    <div class="header">
                        <h3>{{pin.name}}</h3>
                    </div>
                    <dl class="metas">
                        <dt>使いやすさ</dt>
                        <dd>{{pin.metas.tukaiyasusa}}</dd>
                        <dt>美しさ</dt>
                        <dd>{{pin.metas.clean}}</dd>
                        <dt class='none'>使える時間</dt>
                        <dd>
                            <time>{{pin.metas.time[0]}}〜{{pin.metas.time[1]}}</time>
                        </dd>
                    </dl>
                    <img :src="pin.eye" :alt="'写真'+pin.name" class="photo">
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