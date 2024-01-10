new Vue({
    el:"#app",
    data: {
        conditions:{
            generation: '',
            fee: '',
            people: '',
            date: 0,
            outdoor: 0,
            indoor: 0
        }
    },
    mounted() {
        sessionStorage.clear();
    },
    methods: {
        goMap() {
            window.sessionStorage.setItem(['conditions'],JSON.stringify(this.conditions));
            location.href = '../Asobanto/Asobanto.html';
        }
    }
});