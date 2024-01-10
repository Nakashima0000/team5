new Vue({
    el:"#app",
    data: {
        conditions: JSON.parse(window.sessionStorage.getItem(['conditions'])),
        /*conditions:{
            generation: 'family',
            fe: '無料',
            people: '1~2人',
            date: false,
            outdoor: false,
            indoor:true
        },*/
        results:[{
            spots_id: null,
            name: '',
            adress: '',
            time: '',
            detail: '',
            image: '',
            latitude: null,
            longitude: null,
            generation: '', 
            fee: '',
            people: '',
            date: 0,
            outdoor: 0,
            indoor: 0
        }],
        set: 'searchSpot',
        //set: 'getSpotsAll,'
        count: 0
    },
    created : function(){
        
    },
    async mounted() {
        await axios
            //timestamp=${new Date().getTime()}を入れることで毎回違うアドレスで検索が出来るから以前のキャッシュを読み込まない
            //.get("http://localhost/system/php/DB.php/?set=" + this.set + "&generation=" + this.conditions.generation + "&fee=" + this.conditions.fee + "&people=" + this.conditions.people + "&date=" + this.conditions.date + "&outdoor=" + this.conditions.outdoor + "&indoor=" + this.conditions.indoor)
            .get("https://nakash.main.jp/asobanto/php/DB.php/?set=" + this.set + "&generation=" + this.conditions.generation + "&fee=" + this.conditions.fee + "&people=" + this.conditions.people + "&date=" + this.conditions.date + "&outdoor=" + this.conditions.outdoor + "&indoor=" + this.conditions.indoor)
            .then((response) => (this.results = response.data))
            .catch((error) => console.log(error));
        await window.sessionStorage.setItem(['results'],JSON.stringify(this.results));
        //alert(this.results.length);
        if(this.results.length != 0) {
            this.count = 1;
        }
    },
    methods: {
        getid(name) {
            return "#" + name;
        },
        goSearch() {
            location.href = '../search/search.html';
        }
    },
    watch: {

    }
});