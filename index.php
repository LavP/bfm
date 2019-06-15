<?php
/*
Template name:マップ実験
*/
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        #list > li{
            cursor: pointer;
        }
        #list > .active{
            background-color: #f4f4f4;
        }
        #kasane{
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 20vh;
            background-color: aqua;
            opacity: 0.8;
        }
    </style>
    <base href="<?php echo get_template_directory_uri() ?>/">
</head>
<body>
        <div id="root">
          <google-map :center="center" :zoom="mapZoom" style="width: 50%; height: 100vh; display: inline-block">
            
            <gmap-info-window :options="infoOptions" :position="infoWindowPos" :opened="infoWinOpen" @closeclick="infoWinOpen=false">
                    {{infoContent}}
            </gmap-info-window>
            <gmap-marker :key="i" v-for="(m,i) in markers" :position="m.position" :clickable="true" @click="[toggleInfoWindow(m,i),center = m.position,activePin = m.infoText]"></gmap-marker>
          </google-map>

          <div class="left" style="display: inline-block; width: calc(50% - 1em); vertical-align: top;">
              <button v-on:click='center.lat+=0.0005'>Y Centerをズラス</button>
              <button v-on:click='center.lng+=0.0005'>X Centerをズラス</button>
              <button v-on:click='mapZoom+=0.1'>拡大</button>
              <button v-on:click='mapZoom-=0.1'>縮小</button>
    
              <h2>リストに追加する</h2>
              名前<input type="text" name="" id="" v-model='addPin.infoText'>
              緯度<input type="text" name="" id="" v-model='addPin.position.lat'>
              経度<input type="text" name="" id="" v-model='addPin.position.lng'>
              <button @click='addPinToMarkers()'>追加</button>
    
              <h2>リスト</h2>
              <ul id="list">
                  <li v-for='data in markers' @click='[center = data.position,toggleInfoWindow(data),activePin = data.infoText]' :class='{ active : data.infoText == activePin}'>
                      <h3>{{data.infoText}}</h3>
                      <p>緯度：{{data.position.lat}}　経度：{{data.position.lng}}</p>
                  </li>
              </ul>
    
              <p>クリックされたピンは「{{activePin}}」です。</p>
              <p>{{markers}}</p>
          </div>

          <div id="kasane">
              重ねるオブジェクト
          </div>
        </div>
      
        <script src="https://cdn.jsdelivr.net/npm/vue@2.6.10/dist/vue.js"></script>
        <script src="js/vue-google-maps.js"></script>
        <script><?php include('js/mapdev.js');?></script>
      
      </body>
</html>