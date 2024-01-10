function GetMap() {
    let map = new Microsoft.Maps.Map('#myMap', {
        center: new Microsoft.Maps.Location(33.58995093320177, 130.4207810442512),
        zoom: 12,
        /* customMapStyle: myStyle*/
    });


    let center = map.getCenter();

    //4文字以内または6文字以上で名前を書く
    /*var spots = [{ name: "博多駅", latitude: "33.58995093320177", longitude: "130.4207810442512" },
    { name: "ららぽーと福岡", latitude: "33.56479781220516", longitude: "130.43988437960672" }];
    */
    var spots = JSON.parse(window.sessionStorage.getItem(['results']));
    let infobox = [];
    
    for (var i = 0; i < spots.length; i++) {
        let pin = new Microsoft.Maps.Pushpin(spots[i], {
            icon: '../img/redpin.png',  //base64,SVG,canvas,iframe
            anchor: new Microsoft.Maps.Point(12, 40)  //position move
        });
        //Add the pushpin to the map
        map.entities.push(pin);
        
        infobox[i] = new Microsoft.Maps.Infobox(pin.getLocation(), {
            offset: new Microsoft.Maps.Point(2,25),
            title: spots[i].name,
            showCloseButton: false,
            visible: false,
        });
        let infobox1 = infobox[i]; 
        infobox[i].setMap(map); //Add infobox to Map

        Microsoft.Maps.Events.addHandler(pin, 'mouseover', function () {
            infobox1.setOptions({
                visible: true
            })
        });

        Microsoft.Maps.Events.addHandler(pin, 'mouseout', function () {
            infobox1.setOptions({
                visible: false
            })
        });
    }
}