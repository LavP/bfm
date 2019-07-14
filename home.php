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

    <!--グローバル設定ボタン-->
    <button
    id='global-setting'
    v-show='panel.activePanel == "genre"'
    @click='panel.activePanel = "global-setting"'
    >⚙</button>

    <!--グローバル設定パネル-->
    <section
    id="global-setting-panel"
    v-show='panel.activePanel == "global-setting"'>
        <header>
            <button
            class="back"
            @click='panel.activePanel = "genre"'>⬅</button>
            <h2>車椅子設定</h2>
            <button
            class="diside"
            @click='[
                panel.activePanel = "genre",
                saveGlobalSetting()
            ]'>✅</button>
        </header>
    </section>

    <!--メインパネル-->
    <section
    id="searchPanel"
    v-show='panel.activePanel != "global-setting"'>
        <!--ジャンル選択パネル-->
        <section id="genre-panel" v-show='panel.activePanel == "genre"'>
            <header>
                <h2 class="mdl-button mdl-js-button mdl-js-ripple-effect">さがす</h2>
            </header>
            <ul>
                <li>
                    <button
                    @click='[
                        panel.activeGenre = "restroom",
                        panel.activePanel = "list",
                        getAPI()]'>
                        <img src="images/pin/toire-C.svg" alt="">
                        <p>トイレ</p>
                    </button>
                </li>
                <li>
                    <button
                    @click='[
                        panel.activeGenre = "food",
                        panel.activePanel = "list",
                        getAPI()]'>
                        <img src="images/pin/food-C.svg" alt="">
                        <p>飲食店</p>
                    </button>
                </li>
                <li>
                    <button
                    @click='[panel.activeGenre = "convenience",panel.activePanel = "list",getAPI()]'>
                        <img src="images/pin/store-C.svg" alt="">
                        <p>コンビニ</p>
                    </button>
                </li>
                <li>
                    <button
                    @click='[panel.activeGenre = "amusement",panel.activePanel = "list",getAPI()]'>
                        <img src="images/pin/mic-C.svg" alt="">
                        <p>アミューズメント</p>
                    </button>
                </li>
                <li>
                    <button
                    @click='[panel.activeGenre = "all",panel.activePanel = "list",getAPI()]'>
                        <img src="images/pin/mic-C.svg" alt="">
                        <p>すべて</p>
                    </button>
                </li>
            </ul>
        </section>

        <!--リストパネル-->
        <section id="list-panel" v-show='panel.activePanel == "list"'>
            <header>
                <button
                class="back"
                @click='panel.activePanel = "genre"'>⬅</button>
                <h2>リスト</h2>
                <button
                class="setting"
                @click='panel.activePanel = "setting"'
                v-show='panel.activeGenre != "all" && panel.activeGenre != "amusement"'>⚙</button>
            </header>
            <ul>
                <li
                v-for='pin in markers'
                @click='[
                    center = pin.gps_pos,
                    toggleInfoWindow(pin),
                    activePin = pin.name
                ]'>
                    <!--飲食店のリスト項目-->
                    <div v-if='pin.post_type == "food"' class='food'>
                        <div class="header">
                            <p class="genre">{{pin.metas.genre}}</p>
                            <h3>{{pin.name}}</h3>
                        </div>
                        <dl class="metas">
                            <dt class="sougouhyouka">おいしさ</dt>
                            <dd class="sougouhyouka">
                                <span v-for='n in pin.metas.hyouka'>★</span>
                            </dd>
                            <dd class="cost none">値段</dd>
                            <dt class="cost">
                                {{pin.metas.cost.min}} 〜 {{pin.metas.cost.max}}円
                            </dt>
                        </dl>
                        <img :src="pin.eye" :alt="'写真'+pin.name" class="photo">
                    </div>
                    <!--アミューズメントのリスト項目-->
                    <div v-if='pin.post_type == "amusement"' class='amusement'>
                        <div class="header">
                            <p class="genre">{{pin.metas.genre}}</p>
                            <h3>{{pin.name}}</h3>
                        </div>
                        <dl class="metas">
                        <dt class="sougouhyouka">たのしさ</dt>
                            <dd class="sougouhyouka">
                                <span v-for='n in pin.metas.hyouka'>★</span>
                            </dd>
                            <dd class="cost none">値段</dd>
                            <dt class="cost">
                                {{pin.metas.cost.min}} 〜 {{pin.metas.cost.max}}円
                            </dt>
                        </dl>
                        <img :src="pin.eye" :alt="'写真'+pin.name" class="photo">
                    </div>
                    <!--トイレのリスト項目-->
                    <div v-if='pin.post_type == "restroom"' class='restroom'>
                        <div class="header">
                            <h3>{{pin.name}}</h3>
                        </div>
                        <dl class="metas">
                            <dt>使える時間</dt>
                            <dd>
                                <time>{{pin.metas.time.start}} 〜 {{pin.metas.time.end}}</time>
                            </dd>
                        </dl>
                        <img :src="pin.eye" :alt="'写真'+pin.name" class="photo">
                    </div>
                    <!--コンビニのリスト項目-->
                    <div v-if='pin.post_type == "convenience"' class='convenience'>
                        <div class="header">
                            <p class="genre">{{pin.metas.brand.label}}</p>
                            <h3>{{pin.name}}</h3>
                        </div>
                        <dl class="metas">
                            <dt><img src="" alt="ATM"></dt>
                            <dd>ATM {{isLabel(pin.metas.atm)}}</dd>
                            <dt><img src="" alt="イートイン"></dt>
                            <dd>イートイン {{isLabel(pin.metas.eatin)}}</dd>
                        </dl>
                        <img :src="pin.eye" :alt="'写真'+pin.name" class="photo">
                    </div>
                </li>
            </ul>
        </section>

        <!--条件指定パネル-->
        <section id="query-panel" v-show='panel.activePanel == "setting"'>
            <header>
                <button
                class="back"
                @click='panel.activePanel = "list"'>⬅</button>
                <h2>条件設定</h2>
                <button
                class="check"
                @click='[
                    getAPI(),
                    panel.activePanel = "list"
                ]'>✅</button>
            </header>
            <!--ジャンル：トイレ-->
            <section class="restroom" v-show='panel.activeGenre == "restroom"'>
                <h3 class="none">トイレの検索条件</h3>
                <dl>
                    <dt>道具</dt>
                    <dd>
                        <label for="tool">
                            <input type="checkbox" name="" id="">
                            <span>フォーク</span>
                            <input type="checkbox" name="" id="">
                            <span>スプーン</span>
                        </label>
                        <label for="tool">
                            <input type="checkbox" name="" id="">
                            <span>スプーン</span>
                        </label>
                    </dd>
                </dl>
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
                <dl>
                    <dt>ブランド</dt>
                    <dd>
                        <input type="radio" id="seven" name="brand" value="seven" v-model='panel.query.convenience.brand'>
                        <label for="seven">セブン</label>
                        <input type="radio" id="yamazaki" name="brand" value="yamazaki" v-model='panel.query.convenience.brand'>
                        <label for="yamazaki">デイリー</label>
                        {{panel.query.convenience.brand}}
                    </dd>
                </dl>
            </section>
        </section>
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