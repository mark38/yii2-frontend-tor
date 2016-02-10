ymaps.ready(init);

function init () {
    var myMap = new ymaps.Map('contacts-map', {
            center: [51.526337, 37.802894],
            zoom: 7,
            controls: ['zoomControl', 'fullscreenControl']
        }),
        objectManager = new ymaps.ObjectManager({
            // Чтобы метки начали кластеризоваться, выставляем опцию.
            clusterize: true,
            // ObjectManager принимает те же опции, что и кластеризатор.
            gridSize: 32
        }),
        clusterer = new ymaps.Clusterer({
            preset: 'islands#invertedBlueClusterIcons',
            clusterHideIconOnBalloonOpen: false,
            geoObjectHideIconOnBalloonOpen: false
        });

    // Чтобы задать опции одиночным объектам и кластерам,
    // обратимся к дочерним коллекциям ObjectManager.
    objectManager.objects.options.set('preset', 'islands#greenDotIcon');
    objectManager.clusters.options.set('preset', 'islands#greenClusterIcons');
    myMap.geoObjects.add(objectManager);

    $.ajax({
        url: "/files/contacts.json"
    }).done(function(data) {
        objectManager.add(data);
    });

}