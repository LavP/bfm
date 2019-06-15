Vue.use(VueGoogleMaps, {
    load: {
        key: "AIzaSyAOFSkQMtyOAI_LNePOHmyqC4Zhk-ZJm6Y",
        v: "3.26"
    }
});

document.addEventListener("DOMContentLoaded", function () {
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
        el: "#root",
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
            //optional: offset infowindow so it visually sits nicely on top of our marker
            infoOptions: {
                pixelOffset: {
                    width: 0,
                    height: -35
                }
            },
            markers: [
                {
                    position: {
                        lat: 35.5644844,
                        lng: 139.7164114
                    },
                    infoText: '工学院トイレ'
                },
                {
                    position: {
                        lat: 35.5653571,
                        lng: 139.7144738
                    },
                    infoText: '片柳アリーナトイレ'
                }
            ],
            activePin:'',
            addPin:{
                position:{
                    lat: 35.5626028,
                    lng: 139.7157437
                },
                infoText:'JRトイレ'
            }
        },
        methods: {
            toggleInfoWindow: function (marker, idx) {
                this.infoWindowPos = marker.position;
                this.infoContent = marker.infoText;

                //check if its the same marker that was selected if yes toggle
                if (this.currentMidx == idx) {
                    this.infoWinOpen = !this.infoWinOpen;
                }
                //if different marker set infowindow to open and reset current marker index
                else {
                    this.infoWinOpen = true;
                    this.currentMidx = idx;
                }
            },
            addPinToMarkers : function() {
                if(this.addPin.position.lat != '' && this.addPin.position.lng && this.addPin.infoText){
                    //数値化
                    this.addPin.position.lat =  Number(this.addPin.position.lat);
                    this.addPin.position.lng =  Number(this.addPin.position.lng);
                    //参照渡しを回避
                    const tmp = JSON.parse(JSON.stringify(this.addPin));
                    //マーカー配列に追加
                    this.markers.push(tmp);
                    //初期化
                    this.addPin.position.lat = null;
                    this.addPin.position.lng = null;
                    this.addPin.infoText = '';
                }
            }
        }
    });

});