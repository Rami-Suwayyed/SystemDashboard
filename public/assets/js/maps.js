let map;
let inputLat = document.querySelector("#lat");
let inputLng = document.querySelector("#lng");
function initMap() {

    let lat = parseFloat(inputLat.value);
    let lng = parseFloat(inputLng.value);
    map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: lat, lng:  lng },
        zoom: 4,
        scrollwheel: true,
    });
    const uluru = { lat: lat, lng:  lng };
    let marker = new google.maps.Marker({
        position: uluru,
        map: map,
        draggable: true
    });
    google.maps.event.addListener(marker,'position_changed',
        function (){
            let lat = marker.position.lat()
            let lng = marker.position.lng()
            $('#lat').val(lat)
            $('#lng').val(lng)
        })
    google.maps.event.addListener(map,'click',
    function (event){
        pos = event.latLng
        marker.setPosition(pos)
    })
}
