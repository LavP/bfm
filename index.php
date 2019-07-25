<?php
session_start();
/*
Template name:トップページ
*/
if(!isset($_SESSION['come']) || $_GET['t'] == 1){
	$_SESSION['come'] = 'set';
	$tutorial = 1;
	//echo "チュートリアルは 有効 です。";
}else{
	$tutorial = 0;
	//echo "チュートリアルは 無効 です。";
}
get_header();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <base href="<?php echo get_template_directory_uri();?>/">
    <!--共通CSS-->
    <style>
        <?php include('style/reset.css');?>
		<?php include('style/index.min.css');?>
		<?php include('style/googlefonts.css');?>
    </style>
	<?php wp_head(); ?>
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
			<!--TODO:パネルで仕様する変数の点検-->
				<div class='pinPopup' v-if='thePostData.type == "food"'>
					<img :src="thePostData.acf.eye.sizes.thumbnail" :alt="thePostData.acf.eye.sizes.thumbnail">
					<p class='genre'>{{thePostData.acf.foods.genre}}</p>
					<h3>{{thePostData.acf.info.name}}</h3>
					<p class='cost'>約{{thePostData.acf.foods.cost.min}}円&nbsp;&sim;&nbsp;{{thePostData.acf.foods.cost.max}}円程</p>
					<p class='time' v-if='thePostData.acf.info.start_time == thePostData.acf.info.end_time'>24時間営業</p>
					<p class='time' v-else>{{thePostData.acf.info.start_time}}&mdash;{{thePostData.acf.info.end_time}}</p>
					<p class='sougouhyouka'>総合評価<br>
					<div class='starArea' v-html='star(thePostData.acf.foods.oisii)'></div>
					</p>
					<button @click='[panel.activeGlobalPanel = "search-panel",infoWinOpen = false]'>もどる</button>
				</div>
				<div class='pinPopup' v-if='thePostData.type == "restroom"'>
					<img :src="thePostData.acf.eye.sizes.thumbnail" :alt="thePostData.acf.eye.sizes.thumbnail">
					<h3>{{thePostData.acf.info.name}}</h3>
					<p class='time' v-if='thePostData.acf.info.start_time == thePostData.acf.info.end_time'>24時間営業</p>
					<p class='time' v-else>{{thePostData.acf.info.start_time}}&mdash;{{thePostData.acf.info.end_time}}</p>
					<p class='sougouhyouka'>総合評価<br>
					<!--TODO:ここがトイレが出ない原因
					<div class='starArea' v-html='star(thePostData.acf.metas.tukaiyasusa)'></div>-->
					<div class='starArea' v-html='star(5)'></div>
					</p>
					<button @click='[panel.activeGlobalPanel = "search-panel",infoWinOpen = false]'>もどる</button>
				</div>
				
				<div class='pinPopup' v-if='thePostData.type == "convenience"'>
					<img :src="thePostData.acf.eye.sizes.thumbnail" :alt="thePostData.acf.eye.sizes.thumbnail">
					<p class='genre'>{{thePostData.acf.metas.type.label}}</p>
					<h3>{{thePostData.acf.info.name}}</h3>
					<p class='time' v-if='thePostData.acf.info.start_time == thePostData.acf.info.end_time'>24時間営業</p>
					<p class='time' v-else>{{thePostData.acf.info.start_time}}&mdash;{{thePostData.acf.info.end_time}}</p>
					<button @click='[panel.activeGlobalPanel = "search-panel",infoWinOpen = false]'>もどる</button>
				</div>
				<div class='pinPopup' v-if='thePostData.type == "amusement"'>
					<img :src="thePostData.acf.eye.sizes.thumbnail" :alt="thePostData.acf.eye.sizes.thumbnail">
					<p class='genre'>{{thePostData.acf.genre[0]}}</p>
					<h3>{{thePostData.acf.info.name}}</h3>
					<p class='time' v-if='thePostData.acf.info.start_time == thePostData.acf.info.end_time'>24時間営業</p>
					<p class='time' v-else>{{thePostData.acf.info.start_time}}&nbsp;&mdash;&nbsp;{{thePostData.acf.info.end_time}}</p>
					<p class='cost'>約{{thePostData.acf.cost.min}}円&sim;{{thePostData.acf.cost.max}}円程</p>
					<p class='sougouhyouka'>総合評価<br>
					<div class='starArea' v-html='star(thePostData.acf.sougouhyouka)'></div>
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

	<!--チュートリアル要素-->
	<section id='tutorialArea'>
		<div id='tutorial_01' v-show='tutorial == 1 && tutorial_num == 1'>
			<div>
				<img src="images/logo.png" alt="バリマ">
				<p>
					日本工学院ってバリアフリー<br>どうなの？<br><br>
					そんな不安を抱く車椅子ユーザーに送るバリアフリーマップです！
				</p>
				<button @click='[
					panel.activeGlobalPanel = "global-setting",
					tutorial_num = 2
				]'>つかってみる</button>
			</div>
		</div>
		<div id='tutorial_02' v-show='tutorial == 1 && tutorial_num == 2'>
			<div>
				<button><img src="images/close.svg" alt="✖" @click='tutorial_num = null'></button>
				<span class="no">1</span><span class='tukaikata'>使い方</span>
				<p>まず、あなたの車椅子について教えて下さい。あなたにぴったりな施設が表示されるようになります。</p>
			</div>
		</div>
		<div id='tutorial_03' v-show='tutorial == 1 && tutorial_num == 3'>
			<div>
				<button><img src="images/close.svg" alt="✖" @click='tutorial_num = null'></button>
				<span class="no">2</span><span class='tukaikata'>使い方</span>
				<p>探したいジャンルを選びます。</p>
			</div>
		</div>
		<div id='tutorial_04' v-show='tutorial == 1 && tutorial_num == 4'>
			<div>
				<button><img src="images/close.svg" alt="✖" @click='[tutorial_num = null,tutorial = 0]'></button>
				<span class="no">3</span><span class='tukaikata'>使い方</span>
				<p>検索結果が表示されます。<br>気になるお店をクリックしましょう。</p>
				<p><img src="images/setting.svg" alt="⚙">で条件を絞り込めます。</p>
			</div>
		</div>
		<div id='tutorial_on' v-show='tutorial == 0' @click='[tutorial = 1,tutorial_num = 2,panel.activeGlobalPanel = "global-setting"]'>
			<img src="images/info.svg" alt='info'>ヒント
		</div>
	</section>

	<!--グローバル設定ボタン-->
	<button
	id='global-setting'
	v-show='panel.activeGlobalPanel == "search-panel" && panel.activeSearchPanel == "genre"'
	@click='panel.activeGlobalPanel = "global-setting"'
	><img src="images/setting.svg" alt="⚙"></button>

	<!--グローバル設定パネル-->
	<section
	id="global-setting-panel"
	v-show='panel.activeGlobalPanel == "global-setting"'>
		<header>
			<button
			class="back"
			@click='[
				panel.activeGlobalPanel = "search-panel",
				tutorial_num = 3
			]'><img src="images/back.svg" alt="⬅"></button>
			<h2>車椅子設定</h2>
			<button
			class="diside"
			@click='[
				panel.activeGlobalPanel = "search-panel",
				tutorial_num = 3
			]'><img src="images/diside.svg" alt="✅"></button>
		</header>
		<dl>
			<dt class="yyheight">車椅子の横幅を<br>
				教えてください</dt>
			<dd class='range'>
				<span>{{panel.query.well.min_width}}m</span>
				<input 
				type="range" 
				list="min_width" 
				name="min_width" 
				v-model='panel.query.well.min_width'
				min="0.5" max="1.5" step="0.1">
				
			</dd>
			<dt class="yyheight">どれくらいの高さまで<br>自力でこえられるか<br>教えてください</dt>
			<dd class='range'>
				<span>{{panel.query.well.max_height}}cm</span>
				<input 
				type="range" 
				list="max_height" 
				name="max_height" 
				v-model='panel.query.well.max_height'
				min="0" max="20" step="1">
			</dd>
			<dt class="yyheight">車椅子の種類を<br>教えてください</dt>
			<dd class='toggle'>
				<input 
				type="radio" 
				name="well_type" 
				id="syudou" 
				v-model='panel.query.well.well_type' 
				value='hand'>
				<label
				for="syudou"
				:class='{ active : panel.query.well.well_type == "hand" }'>手動</label>
				<input 
				type="radio" 
				name="well_type" 
				id="elec" 
				v-model='panel.query.well.well_type' 
				value='elec'>
				<label
				for="elec"
				:class='{ active : panel.query.well.well_type == "elec" }'>電動</label>
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
						getAPI(),
						tutorial_num = 4]'>
						<img src="images/pin/toire-C.svg" alt="トイレ">
						<p>トイレ</p>
					</button>
				</li>
				<li>
					<button
					@click='[
						panel.activeGenre = "food",
						panel.activeSearchPanel = "list",
						getAPI(),
						tutorial_num = 4]'>
						<img src="images/pin/food-C.svg" alt="飲食店">
						<p>飲食店</p>
					</button>
				</li>
				<li>
					<button
					@click='[
						panel.activeGenre = "convenience",
						panel.activeSearchPanel = "list",
						getAPI(),
						tutorial_num = 4]'>
						<img src="images/pin/store-C.svg" alt="コンビニ">
						<p>コンビニ</p>
					</button>
				</li>
				<li>
					<button
					@click='[
						panel.activeGenre = "amusement",
						panel.activeSearchPanel = "list",
						getAPI(),
						tutorial_num = 4]'>
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
						<img src="images/all.svg" alt="すべて">
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
				@click='panel.activeSearchPanel = "genre"'><img src="images/back.svg" alt="⬅"></button>
				<h2>リスト</h2>
				<button
				class="setting"
				@click='panel.activeSearchPanel = "setting"'
				v-show='panel.activeGenre != "all" && panel.activeGenre != "amusement"'><img src="images/setting.svg" alt="⚙"></button>
			</header>
			<!--TODO:リストにアイコンつける-->
			<ul>
				<li
				v-for='pin in markers'
				@click='[
					center = pin.gps_pos,
					toggleInfoWindow(pin),
					activePin = pin.name,
					panel.activePostID = pin.postid,
					getThePostData(),
					panel.activeGlobalPanel = "info",
					panel.activeInfoPanel = "shisetsu"
				]'>
					<!--飲食店のリスト項目-->
					<div v-if='pin.post_type == "food"' class='food'>
						<div class="header">
							<p class="genre">{{pin.metas.genre}}</p>
							<h3>{{pin.name}}</h3>
						</div>
						<dl class="metas">
							
							<dt class="sougouhyouka"><img src="images/oisisa.svg" alt="💩"></dt>
							<dd class="sougouhyouka">
								<span v-for='n in pin.metas.hyouka'>★</span>
							</dd>
							
							<dd class="cost none"><img src="images/nedan.svg" alt="💩"></dd>
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
						
						<dt class="sougouhyouka"><img src="images/tanosisa.svg" alt="💩"></dt>
							<dd class="sougouhyouka">
								<span v-for='n in pin.metas.hyouka'>★</span>
							</dd>
							
							<dd class="cost none"><img src="images/nedan.svg" alt="💩"></dd>
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
							
							<dt><img src="images/time.svg" alt="💩"></dt>
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
							<dt><img src="images/atm.svg" alt="ATM"></dt>
							<dd>ATM {{isLabel(pin.metas.atm)}}</dd>
							<dt><img src="images/eatin.svg" alt="イートイン"></dt>
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
				@click='panel.activeSearchPanel = "list"'><img src="images/back.svg" alt="⬅"></button>
				<h2>条件設定</h2>
				<button
				class="check"
				@click='[
					getAPI(),
					panel.activeSearchPanel = "list"
				]'><img src="images/diside.svg" alt="✅"></button>
			</header>
			<!--ジャンル：トイレ-->
			<section class="restroom" v-show='panel.activeGenre == "restroom"'>
				<h3 class="none">トイレの検索条件</h3>
				<dl>
					<div>
						<dt>横のバーは</dt>
						<dd class='toggle'>
							<input 
							type="radio" 
							name="bar" 
							id="dokaseru" 
							v-model='panel.query.restroom.bar' 
							value='1'>
							<label for="dokaseru" :class='{ active : panel.query.restroom.bar == 1 }'>どかせる</label>
							<input 
							type="radio" 
							name="bar" 
							id="dokasenai" 
							v-model='panel.query.restroom.bar' 
							value='0'>
							<label for="dokasenai" :class='{ active : panel.query.restroom.bar == 0 }'>どかせない</label>
						</dd>
					</div>
					<div>
						<dl>便座横の空間</dl>
						<dd class='toggle'>
							<input 
							type="radio" 
							name="space" 
							id="kamiza" 
							v-model='panel.query.restroom.side_space' 
							value='1'>
							<label for="kamiza" :class='{ active : panel.query.restroom.side_space == 1}'>上座</label>
							<input 
							type="radio" 
							name="space" 
							id="simoza" 
							v-model='panel.query.restroom.side_space' 
							value='2'>
							<label for="simoza" :class='{ active : panel.query.restroom.side_space == 2}'>下座</label>
						</dd>
					</div>
					<div>
						<dt>清潔さ</dt>
						<dd class='range'>
							<span v-if='panel.query.restroom.clean == 0'>汚い</span>
							<span v-else-if='panel.query.restroom.clean == 1'>ふつう</span>
							<span v-else-if='panel.query.restroom.clean == 2'>きれい</span>
							<span v-else>スライダーを動かす</span>
							<input 
							type="range" 
							list="clean" 
							name="clean" 
							v-model='panel.query.restroom.clean'
							min="0" max="2" step="1">
							
						</dd>
					</div>
				</dl>
			</section>
			<!--ジャンル：飲食-->
			<section class="food" v-show='panel.activeGenre == "food"'>
				<h3 class="none">飲食の検索条件</h3>
				<dl>
					<div>
						<dt>道具</dt>
						<dd class='checkbox'>
							<input type="checkbox" name="tool" id="spoon" v-model="panel.query.food.spoon">
							<label for="spoon" :class='{ active : panel.query.food.spoon == true }'>
								<img src="images/ken/spoon.svg" alt="🥄">
								<p>スプーン</p>
							</label>
							<input type="checkbox" name="tool" id="folk" v-model="panel.query.food.folk">
							<label for="folk":class='{ active : panel.query.food.folk == true }'>
								<img src="images/ken/fork.svg" alt="🍴">
								<p>フォーク</p>
							</label>
						</dd>
					</div>
					<div>
						<dt>食のジャンル</dt>
						<dd class='toggle this'>
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
								value='<?php echo get_field('foods')['genre'];?>'
								id="<?php echo get_field('foods')['genre'];?>" 
								v-model='panel.query.food.genre'>
	
								<label
								for="<?php echo get_field('foods')['genre'];?>"
								:class='{ active : panel.query.food.genre == "<?php echo get_field('foods')['genre'];?>" }'><?php echo get_field('foods')['genre'];?></label>
	
							<?php
								}
							} 
							wp_reset_postdata()
							;?>
						</dd>
					</div>
					<div>
						<dt>予算</dt>
						<dd class='range'>
							<span>{{panel.query.food.yosan}}円</span>
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
							
						</dd>
					</div>
				</dl>
			</section>
			<!--ジャンル：コンビニ-->
			<section class="convenience" v-show='panel.activeGenre == "convenience"'>
				<h3 class="none">コンビニの検索条件</h3>
				<dl>
					<div>
						<dt>ブランド</dt>
						<dd class='toggle'>
							<input 
							type="radio" 
							id="seven" 
							name="brand" 
							value="seven" 
							v-model='panel.query.convenience.brand'>
							<label for="seven" :class='{ active : panel.query.convenience.brand == "seven" }'>セブン</label>
							<input 
							type="radio" 
							id="famima" 
							name="brand" 
							value="famima" 
							v-model='panel.query.convenience.brand'>
							<label for="famima" :class='{ active : panel.query.convenience.brand == "famima" }'>ファミマ</label>
							<input 
							type="radio" 
							id="lawson" 
							name="brand" 
							value="lawson" 
							v-model='panel.query.convenience.brand'>
							<label for="lawson" :class='{ active : panel.query.convenience.brand == "lawson" }'>ローソン</label>
							<input 
							type="radio" 
							id="other" 
							name="brand" 
							value="other" 
							v-model='panel.query.convenience.brand'>
							<label for="other" :class='{ active : panel.query.convenience.brand == "other" }'>その他</label>
						</dd>
					</div>
					<div>
						<dt>施設</dt>
						<dd class='checkbox'>
							<input type="checkbox" name="atm" id="atm" v-model="panel.query.convenience.atm">
							<label for="atm" :class='{ active : panel.query.convenience.atm == true }'>
								<img src="images/ken/atm.svg" alt="💩">
								<p>ATM</p>
							</label>
							<input type="checkbox" name="eatin" id="eatin" v-model="panel.query.convenience.eatin">
							<label for="eatin" :class='{ active : panel.query.convenience.eatin == true }'>
								<img src="images/ken/lunch.svg" alt="💩">
								<p>イートイン</p>
							</label>
						</dd>
					</div>
				</dl>
			</section>
		</section>
	</section>

	<!--詳細情報パネル-->
	<section id="infoPanel"  v-show='panel.activeGlobalPanel == "info"'>
		<!--タブエリア-->
		<div class="tabArea">
			<button @click='panel.activeInfoPanel = "shisetsu"' :class='{ active : panel.activeInfoPanel == "shisetsu" }'>施設情報</button>
			<button @click='[
				panel.activeInfoPanel = "photo",
				removeWidth()
			]' :class='{ active : panel.activeInfoPanel == "photo" }'>写真</button>
		</div>
		<!--情報エリア-->
		<section class="shisetsuArea" v-show='panel.activeInfoPanel == "shisetsu"'>
			<dl>
				<div v-if='thePostData.acf.info.name == "辛っとろ麻婆麺 あかずきん"'>
					<div class="frame-wrapper__video">
					<iframe width="560" height="315" src="https://www.youtube.com/embed/Sebs7UPmcrQ" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					</div>
				</div>
				<div v-if='
				thePostData.type == "restroom"'>
			    	<dt>便座横のバーは収納できるか</dt>
					<dd class='toggle'>
						<span :class='{ active : thePostData.acf.metas.fold_the_bar == 1 }'>どかせる</span>
						<span :class='{ active : thePostData.acf.metas.fold_the_bar == 2 }'>どかせない</span>
					</dd>
			    </div>
			    <div v-if='
				thePostData.type == "restroom"'>
			    	<dt>便座横の空間</dt>
					<dd class='toggle'>
						<span :class='{ active : thePostData.acf.metas.side_space == 0 }'>ない</span>
						<span :class='{ active : thePostData.acf.metas.side_space == 1 }'>上座</span>
						<span :class='{ active : thePostData.acf.metas.side_space == 2 }'>下座</span>
					</dd>
			    </div>
				<div v-if='
				thePostData.type == "restroom"'>
					<dt>手洗い台の高さ</dt>
					<dd class='toggle'>
						<span :class='{ active : thePostData.acf.metas.hand_height == 0 }'>低い</span>
						<span :class='{ active : thePostData.acf.metas.hand_height == 1 }'>ちょうどよい</span>
						<span :class='{ active : thePostData.acf.metas.hand_height == 2 }'>高い</span>
					</dd>
				</div>
				<div v-if='
				thePostData.type == "restroom"'>
					<dt>便座の高さ</dt>
					<dd class='toggle'>
						<span :class='{ active : thePostData.acf.metas.benza_height == 0 }'>低い</span>
						<span :class='{ active : thePostData.acf.metas.benza_height == 1 }'>ちょうどよい</span>
						<span :class='{ active : thePostData.acf.metas.benza_height == 2 }'>高い</span>
					</dd>
				</div>
				<div v-if='
				thePostData.type == "restroom"'>
					<dt>トイレの清潔さ</dt>
					<dd class='toggle'>
						<span :class='{ active : thePostData.acf.metas.clean == 0 }'>汚い</span>
						<span :class='{ active : thePostData.acf.metas.clean == 1 }'>ちょうどよい</span>
						<span :class='{ active : thePostData.acf.metas.clean == 2 }'>美しい</span>
					</dd>
				</div>
				<div v-if='
				thePostData.type == "restroom"'>
					<dt>使いやすさ</dt>
					<dd class='range'>
						<!--<div class='starArea' v-html='star(thePostData.acf.metas.tukaiyasusa)'></div>-->
						<p v-if='thePostData.acf.metas.tukaiyasusa = 0'>使いづらい</p>
						<p v-else-if='thePostData.acf.metas.tukaiyasusa = 1'>使いづらい</p>
						<p v-else-if='thePostData.acf.metas.tukaiyasusa = 2'>やや使いづらい</p>
						<p v-else-if='thePostData.acf.metas.tukaiyasusa = 3'>普通</p>
						<p v-else-if='thePostData.acf.metas.tukaiyasusa = 4'>やや使いやすい</p>
						<p v-else-if='thePostData.acf.metas.tukaiyasusa = 5'>使いやすい/p>
						<p v-else>Data読み込みませんでした</p>
						<input type="range" class="restroom_tukaiyasusa" min="0" max="5" step="1" :value="thePostData.acf.metas.tukaiyasusa" disabled>
					</dd>
				</div>
				<div v-if='
				thePostData.type == "food"'>
					<dt>注文形式</dt>
					<dd class='icon'>
						<div
						v-if='thePostData.acf.metas.orderstyle == "0:食券式"'
						class='active'>
							<img src="images/ken/ticket.svg" alt="🎫">
							<p>食券式</p>
						</div>
						<div
						v-if='thePostData.acf.metas.orderstyle == "1:オーダー式"'
						class='active'>
							<img src="images/ken/order.svg" alt="👩">
							<p>オーダー式</p>
						</div>

						<div
						:class='{ active : thePostData.acf.metas.payment == true }'>
							<img src="images/ken/ic.svg" alt="💳">
							<p>Suica</p>
						</div>
					</dd>
				</div>
				<div v-if='
				thePostData.type == "food"'>
					<dt>店員さん</dt>
					<dd class='icon'>
						<!--TODO:アイコンによる-->
						<div v-if='thePostData.acf.metas.smile = 0'>むすっと</div>
						<div v-else-if='thePostData.acf.metas.smile = 1'>普通</div>
						<div v-else-if='thePostData.acf.metas.smile = 2'>にこにこ</div>
						<div v-else='thePostData.acf.metas.smile = 3'>笑顔満開</div>
					</dd>
				</div>
				<div v-if='
				thePostData.type == "food"'>
					<dt>道具</dt>
					<dd class='icon'>
						<div :class='{ active : thePostData.acf.metas.tool[0] == "spoon" }'>
							<img src="images/ken/spoon.svg" alt="🍴">
							<p>スプーン</p>
						</div>
						<div :class='{ active : thePostData.acf.metas.tool[0] == "folk" }'>
							<img src="images/ken/fork.svg" alt="🍴">
							<p>フォーク</p>
						</div>
					</dd>
				</div>
				<div v-if='
				thePostData.type == "food"'>
					<dt>椅子</dt>
					<dd class='toggle'>
						<span :class='{ active : thePostData.acf.metas.chair[0] == "どかせる" }'>どかせる</span>
						<span :class='{ active : thePostData.acf.metas.chair[0] == "どかせない" }'>どかせない</span>
					</dd>
				</div>
				<div v-if='
				thePostData.type == "convenience"'>
					<dt>ATM</dt>
					<dd class='toggle'>
						<span :class='{ active : thePostData.acf.metas.atm[0] == 0 }'>ない</span>
						<span :class='{ active : thePostData.acf.metas.atm[0] == 1 || thePostData.acf.metas.atm[0] == 2 }'>ある</span>
					</dd>
				</div>
				<div v-if='
				thePostData.type == "convenience"'>
					<dt>イートインコーナー</dt>
					<dd class='toggle'>
						<span :class='{ active : thePostData.acf.metas.eatin == false }'>ない</span>
						<span :class='{ active : thePostData.acf.metas.eatin == true }'>ある</span>
					</dd>
				</div>
				<div v-if='
				thePostData.type == "amusement"'>
					<dt>ひとこと</dt>
					<dd class='text'>
						<p>{{thePostData.acf.info.dup}}</p>
					</dd>
				</div>
				<div v-if='
				thePostData.type == "amusement"'>
					<dt>接客</dt>
					<dd class='range'>
						<!--<div class='starArea' v-html='star(thePostData.acf.setubi.sekkyaku)'></div>-->
						<p v-if='thePostData.acf.setubi.sekkyaku = 0'>全然ダメ</p>
						<p v-else-if='thePostData.acf.setubi.sekkyaku = 1'>気難しい</p>
						<p v-else-if='thePostData.acf.setubi.sekkyaku = 2'>やや優しい</p>
						<p v-else-if='thePostData.acf.setubi.sekkyaku== 3'>普通</p>
						<p v-else-if='thePostData.acf.setubi.sekkyaku = 4'>優しい</p>
						<p v-else-if='thePostData.acf.setubi.sekkyaku = 5'>すごく優しい</p>
						<p v-else>Data読み込みませんでした</p>
						<input type="range" class="amusement_sekkyaku" min="0" max="5" step="1" :value="thePostData.acf.setubi.sekkyaku" disabled>
					</dd>
				</div>
				<div v-if='
				thePostData.type == "amusement"'>
					<dt>楽しめるための工夫</dt>
					<dd class='text'>
						<p v-html='thePostData.acf.setubi.kuhuu'></p>
					</dd>
				</div>
				<div v-if='
				thePostData.type == "amusement"'>
					<dt>公式HP</dt>
					<dd class='link'>
						<a :href="thePostData.acf.site" target="_blank">{{thePostData.acf.site}}</a>
					</dd>
				</div>
				<div v-if='
				thePostData.type == "food" &&
				thePostData.acf.hp != ""'>
					<dt>公式HP</dt>
					<dd class='link'>
						<a :href="thePostData.acf.hp" target="_blank">{{thePostData.acf.hp}}</a>
					</dd>
				</div>
			</dl>
		</section>
		<!--写真エリア-->
		<section class="photoArea" v-show='panel.activeInfoPanel == "photo"'>
			<div v-if='thePostData.acf.gallery != ""' v-html='thePostData.acf.gallery' class='hasPhoto'></div>
			<div v-else class='hasntPhoto'>写真がありません</div>
		</section>
	</section>
</main>

<!--Script-->
<script><?php include('js/vue.js');?></script>
<script><?php include('js/axios.min.js');?></script>
<script><?php include('js/vue-google-maps.js');?></script>
<script><?php include('js/index.js');?></script>

<?php wp_footer(); ?>
</body>
</html>