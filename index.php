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
		:options="{
			zoomControl: false,
			mapTypeControl: false,
			scaleControl: false,
			streetViewControl: false,
			rotateControl: false,
			fullscreenControl: false,
			disableDefaultUi: false
		}"
		style="width: 100%; height: 100%; display: inline-block">
			<gmap-info-window
			:options="infoOptions"
			:position="infoWindowPos"
			:opened="infoWinOpen"
			@closeclick="infoWinOpen=false">
				<div class='pinPopup' v-if='thePostData.type == "food"'>
					<img :src="thePostData.acf.eye.sizes.thumbnail" :alt="thePostData.acf.eye.sizes.thumbnail">
					<p class='genre'>{{thePostData.acf.foods.genre}}</p>
					<h3>{{thePostData.acf.info.name}}</h3>
					<p class='cost'>{{thePostData.acf.foods.cost.min}}&mdash;{{thePostData.acf.foods.cost.max}}円</p>
					<p class='time'>{{thePostData.acf.info.start_time}}&mdash;{{thePostData.acf.info.end_time}}</p>
					<p class='sougouhyouka'>総合評価<br>
					<i class="material-icons" v-if='thePostData.acf.foods.oisii == 0'>
					<img src="images/star_border.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv"></i>
					<i class="material-icons" v-if='thePostData.acf.foods.oisii == 0.5'>
					<img src="images/star_half.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv"></i>
					<i class="material-icons" v-if='thePostData.acf.foods.oisii == 1'>
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv"></i>
					<i class="material-icons" v-if='thePostData.acf.foods.oisii == 1.5'>
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star_half.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv"></i>
					<i class="material-icons" v-if='thePostData.acf.metas.tukaiyasusa == 2'>
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv"></i>
					<i class="material-icons" v-if='thePostData.acf.metas.tukaiyasusa == 2.5'>
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star_half.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv"></i>
					<i class="material-icons" v-if='thePostData.acf.metas.tukaiyasusa == 3'>
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv"></i>
					<i class="material-icons" v-if='thePostData.acf.foods.oisiiaku == 3.5'>
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star_half.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv"></i>
					<i class="material-icons" v-if='thePostData.acf.foods.oisii == 4'>
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv"></i>
					<i class="material-icons" v-if='thePostData.acf.foods.oisii == 4.5'>
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star_half.svg" alt="★" class="star_lv"></i>
					<i class="material-icons" v-if='thePostData.acf.foods.oisii == 5'>
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star.svg" alt="★" class="star_lv"></i>
					</p>
					<button @click='[panel.activeGlobalPanel = "search-panel",infoWinOpen = false]'>もどる</button>
				</div>
				<div class='pinPopup' v-if='thePostData.type == "restroom"'>
					<img :src="thePostData.acf.eye.sizes.thumbnail" :alt="thePostData.acf.eye.sizes.thumbnail">
					<h3>{{thePostData.acf.info.name}}</h3>
					<p class='time'>{{thePostData.acf.info.start_time}}&mdash;{{thePostData.acf.info.end_time}}</p>
					<p class='sougouhyouka'>総合評価<br>
					<i class="material-icons" v-if='thePostData.acf.metas.tukaiyasusa == 0'>
					<img src="images/star_border.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv"></i>
					<i class="material-icons" v-if='thePostData.acf.metas.tukaiyasusa == 0.5'>
					<img src="images/star_half.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv"></i>
					<i class="material-icons" v-if='thePostData.acf.metas.tukaiyasusa == 1'>
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv"></i>
					<i class="material-icons" v-if='thePostData.acf.metas.tukaiyasusa == 1.5'>
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star_half.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv"></i>
					<i class="material-icons" v-if='thePostData.acf.metas.tukaiyasusa == 2'>
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv"></i>
					<i class="material-icons" v-if='thePostData.acf.metas.tukaiyasusa == 2.5'>
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star_half.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv"></i>
					<i class="material-icons" v-if='thePostData.acf.metas.tukaiyasusa == 3'>
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv"></i>
					<i class="material-icons" v-if='thePostData.acf.metas.tukaiyasusaaku == 3.5'>
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star_half.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv"></i>
					<i class="material-icons" v-if='thePostData.acf.metas.tukaiyasusa == 4'>
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv"></i>
					<i class="material-icons" v-if='thePostData.acf.metas.tukaiyasusa == 4.5'>
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star_half.svg" alt="★" class="star_lv"></i>
					<i class="material-icons" v-if='thePostData.acf.metas.tukaiyasusa == 5'>
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star.svg" alt="★" class="star_lv"></i>
					</p>
					<button @click='[panel.activeGlobalPanel = "search-panel",infoWinOpen = false]'>もどる</button>
				</div>
				<div class='pinPopup' v-if='thePostData.type == "convenience"'>
					<img :src="thePostData.acf.eye.sizes.thumbnail" :alt="thePostData.acf.eye.sizes.thumbnail">
					<p class='genre'>{{thePostData.acf.metas.type.label}}</p>
					<h3>{{thePostData.acf.info.name}}</h3>
					<p class='time'>{{thePostData.acf.info.start_time}}&mdash;{{thePostData.acf.info.end_time}}</p>
					<button @click='[panel.activeGlobalPanel = "search-panel",infoWinOpen = false]'>もどる</button>
				</div>
				<div class='pinPopup' v-if='thePostData.type == "amusement"'>
					<img :src="thePostData.acf.eye.sizes.thumbnail" :alt="thePostData.acf.eye.sizes.thumbnail">
					<p class='genre'>{{thePostData.acf.genre[0]}}</p>
					<h3>{{thePostData.acf.info.name}}</h3>
					<p class='time'>{{thePostData.acf.info.start_time}}&mdash;{{thePostData.acf.info.end_time}}</p>
					<p class='cost'>{{thePostData.acf.cost.min}}&mdash;{{thePostData.acf.cost.max}}円</p>
					<p class='sougouhyouka'>総合評価<br>
					<i class="material-icons" v-if='thePostData.acf.sougouhyouka == 0'>
					<img src="images/star_border.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv"></i>
					<i class="material-icons" v-if='thePostData.acf.sougouhyouka == 0.5'>
					<img src="images/star_half.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv"></i>
					<i class="material-icons" v-if='thePostData.acf.sougouhyouka == 1'>
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv"></i>
					<i class="material-icons" v-if='thePostData.acf.sougouhyouka == 1.5'>
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star_half.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv"></i>
					<i class="material-icons" v-if='thePostData.acf.sougouhyouka == 2'>
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv"></i>
					<i class="material-icons" v-if='thePostData.acf.sougouhyouka == 2.5'>
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star_half.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv"></i>
					<i class="material-icons" v-if='thePostData.acf.sougouhyouka == 3'>
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv"></i>
					<i class="material-icons" v-if='thePostData.acf.setubi.sekkyaku == 3.5'>
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star_half.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv"></i>
					<i class="material-icons" v-if='thePostData.acf.sougouhyouka == 4'>
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star_border.svg" alt="★" class="star_lv"></i>
					<i class="material-icons" v-if='thePostData.acf.sougouhyouka == 4.5'>
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star_half.svg" alt="★" class="star_lv"></i>
					<i class="material-icons" v-if='thePostData.acf.sougouhyouka == 5'>
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star.svg" alt="★" class="star_lv">
					<img src="images/star.svg" alt="★" class="star_lv"></i>
					</p>
					<button @click='[panel.activeGlobalPanel = "search-panel",infoWinOpen = false]'>もどる</button>
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
	v-show='panel.activeGlobalPanel == "search-panel" && panel.activeSearchPanel == "genre"'
	@click='panel.activeGlobalPanel = "global-setting"'
	>⚙</button>

	<!--グローバル設定パネル-->
	<section
	id="global-setting-panel"
	v-show='panel.activeGlobalPanel == "global-setting"'>
		<header>
			<button
			class="back"
			@click='[panel.activeGlobalPanel = "search-panel"]'>⬅</button>
			<h2>車椅子設定</h2>
			<button
			class="diside"
			@click='[
				panel.activeGlobalPanel = "search-panel"
			]'>✅</button>
		</header>
		<dl>
			<dt>車椅子の横幅</dt>
			<dd>
				<input 
				type="range" 
				list="min_width" 
				name="min_width" 
				v-model='panel.query.well.min_width'
				min="0.5" max="2" step="0.1">
				<span>{{panel.query.well.min_width}}</span>
			</dd>
			<dt>どれくらいの高さまで<br>自力でこえられるか</dt>
			<dd>
				<input 
				type="range" 
				list="max_height" 
				name="max_height" 
				v-model='panel.query.well.max_height'
				min="0" max="20" step="1">
				<span>{{panel.query.well.max_height}}</span>
			</dd>
			<dt>車椅子の種類</dt>
			<dd>
				<input 
				type="radio" 
				name="well_type" 
				id="syudou" 
				v-model='panel.query.well.well_type' 
				value='hand'>
				<label for="syudou">手動</label>
				<input 
				type="radio" 
				name="well_type" 
				id="elec" 
				v-model='panel.query.well.well_type' 
				value='elec'>
				<label for="elec">電動</label>
			</dd>
		</dl>
	</section>

	<!--検索機能メインパネル-->
	<section
	id="searchPanel"
	v-show='panel.activeGlobalPanel == "search-panel"'>
		<!--ジャンル選択パネル-->
		<section id="genre-panel" v-show='panel.activeSearchPanel == "genre"'>
			<header>
				<h2 class="mdl-button mdl-js-button mdl-js-ripple-effect">さがす</h2>
			</header>
			<ul>
				<li>
					<button
					@click='[
						panel.activeGenre = "restroom",
						panel.activeSearchPanel = "list",
						getAPI()]'>
						<img src="images/pin/toire-C.svg" alt="トイレ">
						<p>トイレ</p>
					</button>
				</li>
				<li>
					<button
					@click='[
						panel.activeGenre = "food",
						panel.activeSearchPanel = "list",
						getAPI()]'>
						<img src="images/pin/food-C.svg" alt="飲食店">
						<p>飲食店</p>
					</button>
				</li>
				<li>
					<button
					@click='[
						panel.activeGenre = "convenience",
						panel.activeSearchPanel = "list",
						getAPI()]'>
						<img src="images/pin/store-C.svg" alt="コンビニ">
						<p>コンビニ</p>
					</button>
				</li>
				<li>
					<button
					@click='[
						panel.activeGenre = "amusement",
						panel.activeSearchPanel = "list",
						getAPI()]'>
						<img src="images/pin/mic-C.svg" alt="アミューズメント">
						<p>アミューズメント</p>
					</button>
				</li>
				<li>
					<button
					@click='[
						panel.activeGenre = "all",
						panel.activeSearchPanel = "list",
						getAPI()]'>
						<img src="images/pin/mic-C.svg" alt="すべて">
						<p>すべて</p>
					</button>
				</li>
			</ul>
		</section>

		<!--リストパネル-->
		<section id="list-panel" v-show='panel.activeSearchPanel == "list"'>
			<header>
				<button
				class="back"
				@click='panel.activeSearchPanel = "genre"'>⬅</button>
				<h2>リスト</h2>
				<button
				class="setting"
				@click='panel.activeSearchPanel = "setting"'
				v-show='panel.activeGenre != "all" && panel.activeGenre != "amusement"'>⚙</button>
			</header>
			<ul>
				<li
				v-for='pin in markers'
				@click='[
					center = pin.gps_pos,
					toggleInfoWindow(pin),
					activePin = pin.name,
					panel.activePostID = pin.postid,
					getThePostData(),
					panel.activeGlobalPanel = "info"
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
		<section id="query-panel" v-show='panel.activeSearchPanel == "setting"'>
			<header>
				<button
				class="back"
				@click='panel.activeSearchPanel = "list"'>⬅</button>
				<h2>条件設定</h2>
				<button
				class="check"
				@click='[
					getAPI(),
					panel.activeSearchPanel = "list"
				]'>✅</button>
			</header>
			<!--ジャンル：トイレ-->
			<section class="restroom" v-show='panel.activeGenre == "restroom"'>
				<h3 class="none">トイレの検索条件</h3>
				<dl>
					<dt>横のバーは</dt>
					<dd>
						<input 
						type="radio" 
						name="bar" 
						id="dokaseru" 
						v-model='panel.query.restroom.bar' 
						value='1'>
						<label for="dokaseru">どかせる</label>
						<input 
						type="radio" 
						name="bar" 
						id="dokasenai" 
						v-model='panel.query.restroom.bar' 
						value='0'>
						<label for="dokasenai">どかせない</label>
					</dd>
					<dl>便座横の空間</dl>
					<dd>
						<input 
						type="radio" 
						name="space" 
						id="kamiza" 
						v-model='panel.query.restroom.side_space' 
						value='1'>
						<label for="kamiza">上座</label>
						<input 
						type="radio" 
						name="space" 
						id="simoza" 
						v-model='panel.query.restroom.side_space' 
						value='2'>
						<label for="simoza">下座</label>
					</dd>
					<dt>清潔さ</dt>
					<dd>
						<input 
						type="range" 
						list="clean" 
						name="clean" 
						v-model='panel.query.restroom.clean'
						min="0" max="2" step="1">
						<datalist id="clean">
						<option value="0" label="汚い">
						<option value="1" label="ふつう">
						<option value="2" label="きれい">
						</datalist>
						<span>{{panel.query.restroom.clean}}</span>
					</dd>
				</dl>
			</section>
			<!--ジャンル：飲食-->
			<section class="food" v-show='panel.activeGenre == "food"'>
				<h3 class="none">飲食の検索条件</h3>
				<dl>
					<dt>道具</dt>
					<dd>
						<input type="checkbox" name="tool" id="spoon" v-model="panel.query.food.spoon">
						<label for="spoon">スプーン</label>
						<input type="checkbox" name="tool" id="folk" v-model="panel.query.food.folk">
						<label for="folk">フォーク</label>
					</dd>
					<dt>食のジャンル</dt>
					<dd>
						<?php
						$api_query = new WP_Query(
							array(
								'post_type' => 'food',
								'posts_per_page' => 100,
							)
						);
						if ( $api_query->have_posts() ) {
							while ( $api_query->have_posts() ) {
								$api_query->the_post();
						?>
							<input 
							type="radio" 
							name="genre" 
							id="<?php echo get_field('foods')['genre'];?>" 
							v-model='panel.query.food.genre' 
							value='1'>
							<label for="<?php echo get_field('foods')['genre'];?>"><?php echo get_field('foods')['genre'];?></label>
						<?php }} wp_reset_postdata();?>
					</dd>
					<dt>予算</dt>
					<dd>
						<input 
						type="range" 
						list="yosan" 
						name="yosan" 
						v-model='panel.query.food.yosan'
						min="0" max="2000" step="100">
						<datalist id="yosan">
						<option value="0" label="0">
						<option value="500" label="500">
						<option value="1000" label="1000">
						<option value="1500" label="1500">
						<option value="2000" label="2000">
						</datalist>
						<span>{{panel.query.food.yosan}}</span>
					</dd>
				</dl>
			</section>
			<!--ジャンル：コンビニ-->
			<section class="convenience" v-show='panel.activeGenre == "convenience"'>
				<h3 class="none">コンビニの検索条件</h3>
				<dl>
					<dt>ブランド</dt>
					<dd>
						<input 
						type="radio" 
						id="seven" 
						name="brand" 
						value="seven" 
						v-model='panel.query.convenience.brand'>
						<label for="seven">セブン</label>
						<input 
						type="radio" 
						id="famima" 
						name="brand" 
						value="famima" 
						v-model='panel.query.convenience.brand'>
						<label for="famima">ファミマ</label>
						<input 
						type="radio" 
						id="lawson" 
						name="brand" 
						value="lawson" 
						v-model='panel.query.convenience.brand'>
						<label for="lawson">ローソン</label>
						<input 
						type="radio" 
						id="other" 
						name="brand" 
						value="other" 
						v-model='panel.query.convenience.brand'>
						<label for="other">その他</label>
					</dd>
					<dt>施設</dt>
					<dd>
						<input type="checkbox" name="atm" id="atm" v-model="panel.query.convenience.atm">
						<label for="atm">ATM</label>
						<input type="checkbox" name="eatin" id="eatin" v-model="panel.query.convenience.eatin">
						<label for="eatin">イートイン</label>
					</dd>
				</dl>
			</section>
		</section>
	</section>

	<!--詳細情報パネル-->
	<section id="infoPanel" v-show='panel.activeGlobalPanel == "info"'>
		<div class="tabArea">
			<button @click='panel.activeInfoPanel = "shisetsu"' :class='{ active : panel.activeInfoPanel == "shisetsu" }'>施設情報</button>
			<button @click='panel.activeInfoPanel = "photo"' :class='{ active : panel.activeInfoPanel == "photo" }'>写真</button>
		</div>
		<section class="shisetsuArea" v-show='panel.activeInfoPanel == "shisetsu"'>
			施設のパネル
			<dl>
				<div v-if='
				thePostData.type != "food" && 
				thePostData.type == "restroom" && 
				thePostData.type != "convenience" && 
				thePostData.type != "amusement"'>
			    	<dt>便座横のバーは収納できるか</dt>
					<dd>
						<span :class='{ checkin : thePostData.acf.metas.fold_the_bar == true }'>どかせる</span>
						<span :class='{ checkin : thePostData.acf.metas.fold_the_bar == false }'>どかせない</span>
					</dd>
			    </div>
			    <div v-if='
				thePostData.type != "food" && 
				thePostData.type == "restroom" && 
				thePostData.type != "convenience" && 
				thePostData.type != "amusement"'>
			    	<dt>便座横の空間</dt>
					<dd>
						<span :class='{ checkin : thePostData.acf.metas.side_space == 0 }'>ない</span>
						<span :class='{ checkin : thePostData.acf.metas.side_space == 1 }'>上座</span>
						<span :class='{ checkin : thePostData.acf.metas.side_space == 2 }'>下座</span>
					</dd>
			    </div>
				<div v-if='
				thePostData.type != "food" && 
				thePostData.type == "restroom" && 
				thePostData.type != "convenience" && 
				thePostData.type != "amusement"'>
					<dt>手洗い台の高さ</dt>
					<dd>
						<span :class='{ checkin : thePostData.acf.metas.hand_height == 0 }'>低い</span>
						<span :class='{ checkin : thePostData.acf.metas.hand_height == 1 }'>ちょうどよい</span>
						<span :class='{ checkin : thePostData.acf.metas.hand_height == 2 }'>高い</span>
					</dd>
				</div>
				<div v-if='
				thePostData.type != "food" && 
				thePostData.type == "restroom" && 
				thePostData.type != "convenience" && 
				thePostData.type != "amusement"'>
					<dt>便座の高さ</dt>
					<dd>
						<span :class='{ checkin : thePostData.acf.metas.benza_height == 0 }'>低い</span>
						<span :class='{ checkin : thePostData.acf.metas.benza_height == 1 }'>ちょうどよい</span>
						<span :class='{ checkin : thePostData.acf.metas.benza_height == 2 }'>高い</span>
					</dd>
				</div>
				<div v-if='
				thePostData.type != "food" && 
				thePostData.type == "restroom" && 
				thePostData.type != "convenience" && 
				thePostData.type != "amusement"'>
					<dt>トイレの清潔さ</dt>
					<dd>
						<span :class='{ checkin : thePostData.acf.metas.clean == 0 }'>汚い</span>
						<span :class='{ checkin : thePostData.acf.metas.clean == 1 }'>ちょうどよい</span>
						<span :class='{ checkin : thePostData.acf.metas.clean == 2 }'>美しい</span>
					</dd>
				</div>
				<div v-if='
				thePostData.type != "food" && 
				thePostData.type == "restroom" && 
				thePostData.type != "convenience" && 
				thePostData.type != "amusement"'>
					<dt>使いやすさ</dt>
					<dd>
						<i class="material-icons" v-if='thePostData.acf.metas.tukaiyasusa == 0'>
						<img src="images/star_border.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv"></i>
						<i class="material-icons" v-if='thePostData.acf.metas.tukaiyasusa == 0.5'>
						<img src="images/star_half.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv"></i>
						<i class="material-icons" v-if='thePostData.acf.metas.tukaiyasusa == 1'>
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv"></i>
						<i class="material-icons" v-if='thePostData.acf.metas.tukaiyasusa == 1.5'>
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star_half.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv"></i>
						<i class="material-icons" v-if='thePostData.acf.metas.tukaiyasusa == 2'>
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv"></i>
						<i class="material-icons" v-if='thePostData.acf.metas.tukaiyasusa == 2.5'>
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star_half.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv"></i>
						<i class="material-icons" v-if='thePostData.acf.metas.tukaiyasusa == 3'>
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv"></i>
						<i class="material-icons" v-if='thePostData.acf.metas.tukaiyasusa == 3.5'>
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star_half.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv"></i>
						<i class="material-icons" v-if='thePostData.acf.metas.tukaiyasusa == 4'>
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv"></i>
						<i class="material-icons" v-if='thePostData.acf.metas.tukaiyasusa == 4.5'>
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star_half.svg" alt="★" class="star_lv"></i>
						<i class="material-icons" v-if='thePostData.acf.metas.tukaiyasusa == 5'>
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star.svg" alt="★" class="star_lv"></i>
					</dd>
				</div>
				<div v-if='
				thePostData.type == "food" && 
				thePostData.type != "restroom" && 
				thePostData.type != "convenience" && 
				thePostData.type != "amusement"'>
					<dt>注文形式</dt>
					<dd>
						<span :class='{ checkin : thePostData.acf.metas.orderstyle == "0:食券式" }'>食券式</span>
						<span :class='{ checkin : thePostData.acf.metas.orderstyle == "1:オーダー式" }'>オーダー式</span>
					</dd>
				</div>
				<div v-if='
				thePostData.type == "food" && 
				thePostData.type != "restroom" && 
				thePostData.type != "convenience" && 
				thePostData.type != "amusement"'>
					<dt>ＩＣの支払</dt>
					<dd>
						<span :class='{ checkin : thePostData.acf.metas.payment == true }'>できる</span>
						<span :class='{ checkin : thePostData.acf.metas.payment == false }'>できない</span>
					</dd>
				</div>
				<div v-if='
				thePostData.type == "food" && 
				thePostData.type != "restroom" && 
				thePostData.type != "convenience" && 
				thePostData.type != "amusement"'>
					<dt>店員さん</dt>
					<dd>
						<i class="material-icons" v-if='thePostData.acf.metas.smile == 0'>
						<img src="images/star_border.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv"></i>
						<i class="material-icons" v-if='thePostData.acf.metas.smile == 0.5'>
						<img src="images/star_half.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv"></i>
						<i class="material-icons" v-if='thePostData.acf.metas.smile == 1'>
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv"></i>
						<i class="material-icons" v-if='thePostData.acf.metas.smile == 1.5'>
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star_half.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv"></i>
						<i class="material-icons" v-if='thePostData.acf.metas.smile == 2'>
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv"></i>
						<i class="material-icons" v-if='thePostData.acf.metas.smile == 2.5'>
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star_half.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv"></i>
						<i class="material-icons" v-if='thePostData.acf.metas.smile == 3'>
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv"></i>
						<i class="material-icons" v-if='thePostData.acf.metas.smile == 3.5'>
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star_half.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv"></i>
						<i class="material-icons" v-if='thePostData.acf.metas.smile == 4'>
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv"></i>
						<i class="material-icons" v-if='thePostData.acf.metas.smile == 4.5'>
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star_half.svg" alt="★" class="star_lv"></i>
						<i class="material-icons" v-if='thePostData.acf.metas.smile == 5'>
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star.svg" alt="★" class="star_lv"></i>
					</dd>
				</div>
				<div v-if='
				thePostData.type == "food" && 
				thePostData.type != "restroom" && 
				thePostData.type != "convenience" && 
				thePostData.type != "amusement"'>
					<dt>道具</dt>
					<dd>
						<span :class='{ checkin : thePostData.acf.metas.tool[0] == "spoon" }'>スプーン</span>
						<span :class='{ checkin : thePostData.acf.metas.tool[0] == "spoon" }'>フォーク</span>
					</dd>
				</div>
				<div v-if='
				thePostData.type == "food" && 
				thePostData.type != "restroom" && 
				thePostData.type != "convenience" && 
				thePostData.type != "amusement"'>
					<dt>椅子</dt>
					<dd>
						<span :class='{ checkin : thePostData.acf.metas.chair == true }'>どかせる</span>
						<span :class='{ checkin : thePostData.acf.metas.chair == false }'>どかせない</span>
					</dd>
				</div>
				<div v-if='
				thePostData.type != "food" && 
				thePostData.type != "restroom" && 
				thePostData.type == "convenience" && 
				thePostData.type != "amusement"'>
					<dt>ATM</dt>
					<dd>
						<span :class='{ checkin : thePostData.acf.metas.atm[0] == 0 }'>ない</span>
						<span :class='{ checkin : thePostData.acf.metas.atm[0] == 1 }'>ある</span>
						<span :class='{ checkin : thePostData.acf.metas.atm[0] == 2 }'>車イスでも操作できる</span>
					</dd>
				</div>
				<div v-if='
				thePostData.type != "food" && 
				thePostData.type != "restroom" && 
				thePostData.type == "convenience" && 
				thePostData.type != "amusement"'>
					<dt>イートインコーナー</dt>
					<dd>
						<span :class='{ checkin : thePostData.acf.metas.eatin == true }'>ある</span>
						<span :class='{ checkin : thePostData.acf.metas.eatin == false }'>ない</span>
					</dd>
				</div>
				<div v-if='
				thePostData.type != "food" && 
				thePostData.type != "restroom" && 
				thePostData.type != "convenience" && 
				thePostData.type == "amusement"'>
					<dt>ひとこと</dt>
					<dd>{{thePostData.acf.info.dup}}</dd>
				</div>
				<div v-if='
				thePostData.type != "food" && 
				thePostData.type != "restroom" && 
				thePostData.type != "convenience" && 
				thePostData.type == "amusement"'>
					<dt>接客</dt>
					<dd>
						<i class="material-icons" v-if='thePostData.acf.setubi.sekkyaku == 0'>
						<img src="images/star_border.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv"></i>
						<i class="material-icons" v-if='thePostData.acf.setubi.sekkyaku == 0.5'>
						<img src="images/star_half.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv"></i>
						<i class="material-icons" v-if='thePostData.acf.setubi.sekkyaku == 1'>
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv"></i>
						<i class="material-icons" v-if='thePostData.acf.setubi.sekkyaku == 1.5'>
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star_half.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv"></i>
						<i class="material-icons" v-if='thePostData.acf.setubi.sekkyaku == 2'>
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv"></i>
						<i class="material-icons" v-if='thePostData.acf.setubi.sekkyaku == 2.5'>
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star_half.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv"></i>
						<i class="material-icons" v-if='thePostData.acf.setubi.sekkyaku == 3'>
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv"></i>
						<i class="material-icons" v-if='thePostData.acf.setubi.sekkyaku == 3.5'>
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star_half.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv"></i>
						<i class="material-icons" v-if='thePostData.acf.setubi.sekkyaku == 4'>
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star_border.svg" alt="★" class="star_lv"></i>
						<i class="material-icons" v-if='thePostData.acf.setubi.sekkyaku == 4.5'>
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star_half.svg" alt="★" class="star_lv"></i>
						<i class="material-icons" v-if='thePostData.acf.setubi.sekkyaku == 5'>
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star.svg" alt="★" class="star_lv">
						<img src="images/star.svg" alt="★" class="star_lv"></i>
					</dd>
					
				</div>
				<div v-if='
				thePostData.type != "food" && 
				thePostData.type != "restroom" && 
				thePostData.type != "convenience" && 
				thePostData.type == "amusement"'>
					<dt>ピークタイムの混雑度</dt>
					<dd></dd>
					
				</div>
				<div v-if='
				thePostData.type != "food" && 
				thePostData.type != "restroom" && 
				thePostData.type != "convenience" && 
				thePostData.type == "amusement"'>
					<dt>楽しめるための工夫</dt>
					<dd><p>{{thePostData.acf.setubi.kuhuu}}</p></dd>
				</div>
				<div v-if='
				thePostData.type == "food" && 
				thePostData.type != "restroom" && 
				thePostData.type != "convenience" && 
				thePostData.type == "amusement"'>
					<dt>公式HP</dt>
					<dd><a href="thePostData.link" target="_blank">{{thePostData.link}}</dd>
				</div>
			</dl>
		</section>
		<section class="photoArea" v-show='panel.activeInfoPanel == "photo"'>
			<div v-if='thePostData.acf.gallery != ""' v-html='thePostData.acf.gallery' class='hasPhoto'></div>
			<div v-if='thePostData.acf.gallery == ""' class='hasntPhoto'>写真がありません</div>
				</div>
				<div v-if='
				thePostData.type != "food" && 
				thePostData.type != "restroom" && 
				thePostData.type != "convenience" && 
				thePostData.type == "amusement"'>
					<dt>楽しめるための工夫</dt>
					<dd><p>{{thePostData.acf.setubi.kuhuu}}</p></dd>
				</div>
				<div v-if='
				thePostData.type == "food" && 
				thePostData.type != "restroom" && 
				thePostData.type != "convenience" && 
				thePostData.type == "amusement"'>
					<dt>公式HP</dt>
					<dd><a href="thePostData.link" target="_blank">{{thePostData.link}}</dd>
				</div>
			</dl>
		</section>
		<section class="photoArea" v-show='panel.activeInfoPanel == "photo"'>
			<div v-if='thePostData.acf.gallery != ""' v-html='thePostData.acf.gallery' class='hasPhoto'></div>
			<div v-if='thePostData.acf.gallery == ""' class='hasntPhoto'>写真がありません</div>
				</div>
				<div v-if='
				thePostData.type != "food" && 
				thePostData.type != "restroom" && 
				thePostData.type != "convenience" && 
				thePostData.type == "amusement"'>
					<dt>楽しめるための工夫</dt>
					<dd><p>{{thePostData.acf.setubi.kuhuu}}</p></dd>
				</div>
				<div v-if='
				thePostData.type == "food" && 
				thePostData.type != "restroom" && 
				thePostData.type != "convenience" && 
				thePostData.type == "amusement"'>
					<dt>公式HP</dt>
					<dd><a href="thePostData.link" target="_blank">{{thePostData.link}}</dd>
				</div>
			</dl>
		</section>
		<section class="photoArea" v-show='panel.activeInfoPanel == "photo"'>
			<div v-if='thePostData.acf.gallery != ""' v-html='thePostData.acf.gallery' class='hasPhoto'></div>
			<div v-if='thePostData.acf.gallery == ""' class='hasntPhoto'>写真がありません</div>
				</div>
				<div v-if='
				thePostData.type != "food" && 
				thePostData.type != "restroom" && 
				thePostData.type != "convenience" && 
				thePostData.type == "amusement"'>
					<dt>楽しめるための工夫</dt>
					<dd><p>{{thePostData.acf.setubi.kuhuu}}</p></dd>
				</div>
				<div v-if='
				thePostData.type == "food" && 
				thePostData.type != "restroom" && 
				thePostData.type != "convenience" && 
				thePostData.type == "amusement"'>
					<dt>公式HP</dt>
					<dd><a href="thePostData.link" target="_blank">{{thePostData.link}}</dd>
				</div>
			</dl>
		</section>
		<section class="photoArea" v-show='panel.activeInfoPanel == "photo"'>
			<div v-if='thePostData.acf.gallery != ""' v-html='thePostData.acf.gallery' class='hasPhoto'></div>
			<div v-if='thePostData.acf.gallery == ""' class='hasntPhoto'>写真がありません</div>
				</div>
				<div v-if='
				thePostData.type != "food" && 
				thePostData.type != "restroom" && 
				thePostData.type != "convenience" && 
				thePostData.type == "amusement"'>
					<dt>楽しめるための工夫</dt>
					<dd><p>{{thePostData.acf.setubi.kuhuu}}</p></dd>
				</div>
				<div v-if='
				thePostData.type == "food" && 
				thePostData.type != "restroom" && 
				thePostData.type != "convenience" && 
				thePostData.type == "amusement"'>
					<dt>公式HP</dt>
					<dd><a href="thePostData.link" target="_blank">{{thePostData.link}}</dd>
				</div>
			</dl>
		</section>
		<section class="photoArea" v-show='panel.activeInfoPanel == "photo"'>
			<div v-if='thePostData.acf.gallery != ""' v-html='thePostData.acf.gallery' class='hasPhoto'></div>
			<div v-if='thePostData.acf.gallery == ""' class='hasntPhoto'>写真がありません</div>
				</div>
				<div v-if='
				thePostData.type != "food" && 
				thePostData.type != "restroom" && 
				thePostData.type != "convenience" && 
				thePostData.type == "amusement"'>
					<dt>楽しめるための工夫</dt>
					<dd><p>{{thePostData.acf.setubi.kuhuu}}</p></dd>
				</div>
				<div v-if='
				thePostData.type == "food" && 
				thePostData.type != "restroom" && 
				thePostData.type != "convenience" && 
				thePostData.type == "amusement"'>
					<dt>公式HP</dt>
					<dd><a href="thePostData.link" target="_blank">{{thePostData.link}}</dd>
				</div>
			</dl>
		</section>
		<section class="photoArea" v-show='panel.activeInfoPanel == "photo"'>
			<div v-if='thePostData.acf.gallery != ""' v-html='thePostData.acf.gallery' class='hasPhoto'></div>
			<div v-if='thePostData.acf.gallery == ""' class='hasntPhoto'>写真がありません</div>
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