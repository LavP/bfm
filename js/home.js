Vue.use(VueGoogleMaps, {
    load: {
        key: "AIzaSyAOFSkQMtyOAI_LNePOHmyqC4Zhk-ZJm6Y",
        v: "3.26"
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
        panel:{
            activePanel:'genre',
            activeGenre:'',
            query:{
                restroom:{
                    exsample1:'aaaaa'
                }
            }
        }
    },
    mounted(){
        this.getAPI('all','init');
    },
    methods: {
        getAPI(type,query){
            if(query == 'init'){
                query = 'init';
            }else{
                query = JSON.stringify(query);
                console.log(query);
                query = query.replace(/\{/g,'');
                query = query.replace(/\}/g,'');
                query = query.replace(/\:/g,'@');
                query = query.replace(/\"/g,'');
                console.log(query);
            }
            axios
            .get('https://kamata-bfm.nextlav.xyz/data-api/?type='+type+'&query='+query)
            .then(response => (this.markers = response.data))
        },
        toggleInfoWindow: function (marker, idx) {
            this.infoWindowPos = marker.gps_pos;
            this.infoContent = marker.name;

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
        }
    }
});