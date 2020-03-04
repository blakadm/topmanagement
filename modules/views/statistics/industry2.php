<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/treemap.js"></script>


<style type="text/css">
    #container {
        min-width: 300px;
        max-width: 600px;
        margin: 0 auto;
    }
</style>



<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/treemap.js"></script>
<div id="container"></div>			
<script>
    jQuery.noConflict();
    var example = 'treemap-with-levels',
            theme = 'default';
    (function ($) { // encapsulate jQuery
        Highcharts.chart('container', {
            series: [{
                    type: "treemap",
                    layoutAlgorithm: 'stripes',
                    alternateStartingDirection: true,
                    levels: [{
                            level: 1,
                            layoutAlgorithm: 'sliceAndDice',
                            dataLabels: {
                                enabled: true,
                                align: 'left',
                                verticalAlign: 'top',
                                style: {
                                    fontSize: '15px',
                                    fontWeight: 'bold'
                                }
                            }
                        }],
                    data: [{
                            id: 'A',
                            name: 'Apples',
                            color: "#EC2500"
                        }, {
                            id: 'B',
                            name: 'Bananas',
                            color: "#ECE100"
                        }, {
                            id: 'O',
                            name: 'Oranges',
                            color: '#EC9800'
                        }, {
                            name: 'Anne',
                            parent: 'A',
                            value: 5
                        }, {
                            name: 'Rick',
                            parent: 'A',
                            value: 3
                        }, {
                            name: 'Peter',
                            parent: 'A',
                            value: 4
                        }, {
                            name: 'Anne',
                            parent: 'B',
                            value: 4
                        }, {
                            name: 'Rick',
                            parent: 'B',
                            value: 10
                        }, {
                            name: 'Peter',
                            parent: 'B',
                            value: 1
                        }, {
                            name: 'Anne',
                            parent: 'O',
                            value: 1
                        }, {
                            name: 'Rick',
                            parent: 'O',
                            value: 3
                        }, {
                            name: 'Peter',
                            parent: 'O',
                            value: 3
                        }, {
                            name: 'Susanne',
                            parent: 'Kiwi',
                            value: 2,
                            color: '#9EDE00'
                        }]
                }],
            title: {
                text: 'Fruit consumption'
            }
        });
    })(jQuery);
</script>






<div id="container"></div>

