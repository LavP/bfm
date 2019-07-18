<?php
/*
Template Name:DATA API2



必要なパラメタ
?well_type=elec      車椅子のタイプ（elec/hand)
?min_width=メートル   車椅子の幅
?max_height=センチ    自力でこえられる高さ
?type=ジャンル         検索クエリにするジャンル
?o=1                 ジャンルの検索条件を入れたか

つけられるパラメタ
?spoon=1             スプーンが必要か
?folk=1              folkが必要か
?yosan=500           予算の上限
?genre=焼肉           食のジャンル

?brand               コンビニのブランド
?atm=1               ATMがあるか
?eatin=1             イートインがあるか

?bar=1               トイレ横のバーは収納できるか
?side_space          横の空間（0:none 1:上座 2:下座）
?clean=1             トイレの清潔さ（0:汚い 1:いい 2:美しい）
*/
if(!isset($_GET['type'])) $_GET['type'] = 'all';
if(!isset($_GET['query'])) $_GET['query'] = 'init';
else if($_GET['query'] != 'init'){
    $queryTmp = explode( ",", $_GET['query'] );
    $query = array();
    for($i = 0;$i < 2;$i++){
        array_push($query,explode( "@", $queryTmp[$i] ));
    }
    //var_dump($query);
}



if($_GET['type'] == 'all') $type = ['restroom','food','convenience','amusement'];
else $type = explode(',',$_GET['type']);

$returnArray = array();
$templateURI = get_template_directory_uri();

$api_query = new WP_Query(
    array(
        'post_type' => $type,
        'posts_per_page' => 100,
    )
);
if ( $api_query->have_posts() ) {
    while ( $api_query->have_posts() ) {
        $api_query->the_post();
        
        $postType = get_post_type();
        //1ループあたりの格納情報
        $arrayTmp = array();

        $arrayTmp['post_type'] = $postType;

        /*==============車椅子設定と合致していないものを省く==================*/
        if($_GET['well_type'] == 'elec'){
            //電動車いすの場合
            if(!($_GET['min_width']+0.15 <= $arrayTmp['well']['min_width']) && $arrayTmp['well']['min_width'] != null) continue;
        }else{
            //手動の車椅子の場合
            if(!($_GET['min_width'] <= $arrayTmp['well']['min_width']) && $arrayTmp['well']['min_width'] != null) continue;
        }
        if(!($_GET['max_height'] >= $arrayTmp['well']['max_height']) && $arrayTmp['well']['max_height'] != null) continue;
        /*==============飲食店条件と合致していないものを省く=================*/
        if($arrayTmp['post_type'] == 'food' && $_GET['o'] == 1){
            $tool = get_field('metas')['tool'];
            if(!($_GET['spoon'] == true && in_array('spoon',$tool)) && $_GET['spoon'] != null) continue;
            if(!($_GET['folk'] == true && in_array('folk',$tool)) && $_GET['folk'] != null) continue;
            if(!($_GET['yosan'] >= get_field('foods')['match']['min']) && $_GET['yosan'] != null) continue;
            if(!(get_field('foods')['genre'] == $_GET['genre']) && $_GET['genre'] != null) continue;
        }
        /*==============コンビニ条件と合致していないものを省く=================*/
        if($arrayTmp['post_type'] == 'convenience' && $_GET['o'] == 1){
            //TODO:その他コンビニ対応まだ
            if(!($_GET['brand'] == get_field('metas')['type']['value']) && $_GET['brand'] != null) continue;
            //修正
            if(get_field('metas')['atm'] != 0 && $_GET['atm'] == true && $_GET['atm'] != null) continue;
            //TODO:多分これバグある
            if(get_field('metas')['eatin'] != 1 && $_GET['eatin'] == true && $_GET['eatin'] != null) continue;
        }
        /*==============トイレ条件と合致していないものを省く=================*/
        if($arrayTmp['post_type'] == 'restroom' && $_GET['o'] == 1){
            //var_dump(get_field('metas')['fold_the_bar']);
            if($_GET['bar'] == 1) $bar = true;
            else $bar = false;
            if(!(get_field('metas')['fold_the_bar'] == $bar) && $_GET['bar'] != null) continue;
            if(!(get_field('metas')['side_space'] == $_GET['side_space']) && $_GET['side_space'] != null) continue;
            if(!(get_field('metas')['clean'] >= $_GET['clean']) && $_GET['clean'] != null) continue;
        }


        /*==========共通データ格納（リスト状態）===============*/
        $arrayTmp['url'] = get_permalink();
        $arrayTmp['name'] = get_field('info')['name'];
        $gps = get_field('gps_pos');
        $arrayTmp['gps_pos'] = [
            'lat' => round($gps['lat'],10),
            'lng' => round($gps['lng'],10)
        ];
        $arrayTmp['eye'] = get_field('eye');
        /*==========飲食店データ格納（リスト状態）===============*/
        if($arrayTmp['post_type'] == 'food'){
            $arrayTmp['icon'] = $templateURI.'/images/pin/food.png';
            $arrayTmp['metas'] = [
                'genre' => get_field('foods')['genre'],
                'hyouka' => get_field('foods')['oisii'],
                'cost' => get_field('foods')['cost']
            ];
        }
        /*==========コンビニデータ格納（リスト状態）===============*/
        if($arrayTmp['post_type'] == 'convenience'){
            $arrayTmp['icon'] = $templateURI.'/images/pin/store.png';
            $arrayTmp['metas'] = [
                'brand' => get_field('metas')['type'],
                'atm' => get_field('metas')['atm'][0],
                'eatin' => get_field('metas')['eatin']
            ];
        }
        /*==========トイレデータ格納（リスト状態）===============*/
        if($arrayTmp['post_type'] == 'restroom'){
            $arrayTmp['icon'] = $templateURI.'/images/pin/toire.png';
            $arrayTmp['metas'] = [
                'time' => [
                    'start' => get_field('info')['start_time'],
                    'end' => get_field('info')['end_time']
                ]
            ];
        }
        /*==========アミューズメントデータ格納（リスト状態）===============*/
        if($arrayTmp['post_type'] == 'amusement'){
            $arrayTmp['icon'] = $templateURI.'/images/pin/mic.png';
            $arrayTmp['metas'] = [
                'genre' => get_field('genre')[0],
                'hyouka' => get_field('sougouhyouka'),
                'cost' => get_field('cost')
            ];
        }





        array_push($returnArray,$arrayTmp);
    }
}
wp_reset_postdata();
echo json_encode($returnArray);