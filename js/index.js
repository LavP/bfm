Vue.use(VueGoogleMaps, {
    load: {
        key: "AIzaSyAOFSkQMtyOAI_LNePOHmyqC4Zhk-ZJm6Y",
        v: "3.37"
    }
});

Vue.component("google-map", VueGoogleMaps.Map);
Vue.component('google-marker', VueGoogleMaps.Marker);
Vue.component(
    "ground-overlay",
    VueGoogleMaps.MapElementFactory({
        mappedProps: {
            opacity: {}
        },
        props: {
            source: { type: String },
            bounds: { type: Object }
        },
        events: ["click", "dblclick"],
        name: "groundOverlay",
        ctr: () => google.maps.GroundOverlay,
        ctrArgs: (options, { source, bounds }) => [source, bounds, options]
    })
);

new Vue({
    el: "#mainMain",
    data: {
        place: "",
        center: {
            lat: 35.5636434,
            lng: 139.7173157
        },
        mapZoom: 16,
        infoContent: '',
        infoWindowPos: null,
        infoWinOpen: false,
        currentMidx: null,
        infoOptions: {
            pixelOffset: {
                width: 0,
                height: -35
            }
        },
        activePin:'',
        markers: null,
        thePostData:{
            type:null,
            acf:{
                gallery:null,
                info:{
                    name:null,
                    dup:null,
                    start_time:null,
                    end_time:null
                },
                foods:{
                    genre:null,
                    cost:{
                        min:null,
                        max:null
                    },
                    oisii:null
                },
                setubi:{
                    sekkyaku:null,
                    "pi-kutime":null,
                    kuhuu:null
                }
    
            }
        },
        panel:{
            activeGlobalPanel:'search-panel',
            activeSearchPanel:'genre',
            activeGenre:'all',
            activeInfoPanel:'shisetsu',
            activePostID:null,
            query:{
                food:{
                    spoon:null,
                    folk:null,
                    yosan:null,
                    genre:null
                },
                restroom:{
                    bar:null,
                    side_space:null,
                    clean:null
                },
                convenience:{
                    brand:null,
                    atm:null,
                    eatin:null
                },
                well:{
                    well_type:null,
                    min_width:null,
                    max_height:null
                },
                o:{
                    all:0,
                    restroom:0,
                    food:0,
                    convenience:0
                }
            }
        }
    },
    mounted(){
        this.getAPI();
    },
    methods: {
        toggleInfoWindow: function (marker, idx) {
            this.infoWindowPos = marker.gps_pos;
            //check if its the same marker that was selected if yes toggle
            if (this.currentMidx == idx) {
                //this.infoWinOpen = !this.infoWinOpen;
                this.infoWinOpen = true;
            }
            //if different marker set infowindow to open and reset current marker index
            else {
                this.infoWinOpen = true;
                this.currentMidx = idx;
            }
        },
        panelManager:function(){

        },
        isLabel:function(value){
            if(value == 0) return 'なし';
            else return 'あり';
        },
        makeQuery:function(list){
            let queryTmp = '';
            for(key in list){
                if(list[key] != null && list[key] != false){
                    queryTmp += `&${key}=${list[key]}`;
                }
            }
            this.panel.query.o[this.panel.activeGenre] = 1;
            //console.log(queryTmp);
            return queryTmp;
        },
        getAPI:function(){
            let optionQuery = '';
            let settingQuery = '';
            if(this.panel.activeSearchPanel == 'setting'){
                switch(this.panel.activeGenre){
                    case 'restroom':
                        optionQuery = this.makeQuery(this.panel.query.restroom);
                    break;
                    case 'food':
                        optionQuery = this.makeQuery(this.panel.query.food);
                    break;
                    case 'convenience':
                        optionQuery = this.makeQuery(this.panel.query.convenience);
                    break;
                }
            }

            settingQuery = this.makeQuery(this.panel.query.well);

            console.log('https://kamata-bfm.nextlav.xyz/data-api/?type='+this.panel.activeGenre+settingQuery+'&o='+this.panel.query.o[this.panel.activeGenre]+optionQuery);
            //取得
            axios
            .get('https://kamata-bfm.nextlav.xyz/data-api/?type='+this.panel.activeGenre+settingQuery+'&o='+this.panel.query.o[this.panel.activeGenre]+optionQuery)
            .then(response => (this.markers = response.data))
        },
        getThePostData:function(type = this.panel.activeGenre){
            //console.log('is work');
            axios
            .get('https://kamata-bfm.nextlav.xyz/wp-json/wp/v2/'+type+'/'+this.panel.activePostID)
            .then(response => (this.thePostData = response.data))
        },
        star:function(get){
            var kuro = Math.floor(get/1);
            var han = get%1;
            var hosibox = [];
            var rhtml = '';
            for(let i = 0;i < 5;i++){
                if(kuro != 0){
                    hosibox[i] = 'star';
                    kuro--;
                }else if(han == 0.5){
                    hosibox[i] = 'star_half';
                    han = 0;
                }else{
                    hosibox[i] = 'star_border';
                }
                rhtml+= '<img src="images/'+hosibox[i]+'.svg" alt="★">';
            };
            return rhtml;
        }
    }
});