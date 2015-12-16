var format = function(d) {
    // d = d / 1000000;
    // return d3.format(',.02f')(d) + 'M';
    // var m = d % 10;
    // if (m != 0) {
    // 	if (m > 5) {
    //         d = Math.ceil(d/10) * 10;
    //     } else {
    //         d = Math.floor(d/10) * 10;
    //     }
    // }

    if (d <= 1) {
        return d3.format(',.0f')(d) + ' incident';
    } else {
        return d3.format(',.0f')(d) + ' incidents';
    } 
}

var map = d3.geomap.choropleth()
    .geofile('../assets/d3-geomap/topojson/world/countries.json')
    .colors(colorbrewer.Reds[9])
    .column('Incident Count')
    .format(format)
    .legend(true)
    .unitId('Country Code')
    .width("1250");

//CSV file forbidden ):
d3.csv('../pages/data/incident_counts.csv', function(error, data) {
    d3.select('#map')
        .datum(data)
        .call(map.draw, map); 
});

