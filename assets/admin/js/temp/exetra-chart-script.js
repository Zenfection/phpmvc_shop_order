// chart 5
var options = {
    series: [{
        name: 'Current Clients',
        data: [33, 44, 55, 57, 56, 61, 58, 63, 60, 66, 72, 68]
    }, {
        name: 'Subscribers',
        data: [44, 76, 85, 101, 98, 87, 105, 91, 114, 94, 40, 59]
    }, {
        name: 'New Customers',
        data: [38, 35, 41, 36, 26, 45, 48, 52, 53, 41, 55, 43]
    }],
    chart: {
        foreColor: '#9ba7b2',
        type: 'bar',
        height: 400,
        stacked: true,
        toolbar: {
            show: false
        },
    },
    plotOptions: {
        bar: {
            horizontal: false,
            columnWidth: '15%',
            endingShape: 'rounded'
        },
    },
    dataLabels: {
        enabled: false
    },
    stroke: {
        show: true,
        width: 0,
        colors: ['transparent']
    },
    colors: ['#0d6efd', "#0dcaf0", '#e5e7e8'],
    xaxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
    },
    fill: {
        opacity: 1
    },
    tooltip: {
        y: {
            formatter: function (val) {
                return "" + val + " thousands"
            }
        }
    }
};
var chart = new ApexCharts(document.querySelector("#chart5"), options);
chart.render();



	// chart 8
	Highcharts.chart('chart8', {
		chart: {
			type: 'variablepie',
			height: 330,
			styledMode: true
		},
		credits: {
			enabled: false
		},
		title: {
			text: 'Total Traffic by Source'
		},
		tooltip: {
			pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
		},
		accessibility: {
			point: {
				valueSuffix: '%'
			}
		},
		plotOptions: {
			pie: {
				allowPointSelect: true,
				cursor: 'pointer',
				dataLabels: {
					enabled: true,
					format: '<b>{point.name}</b>: {point.percentage:.1f} %'
				}
			}
		},
		series: [{
			minPointSize: 10,
			innerSize: '65%',
			zMin: 0,
			name: 'Traffic',
			data: [{
				name: 'Organic',
				y: 505370,
				z: 92.9
			}, {
				name: 'Paid',
				y: 551500,
				z: 118.7
			}, {
				name: 'Email',
				y: 312685,
				z: 124.6
			}, {
				name: 'Google',
				y: 78867,
				z: 137.5
			}, {
				name: 'Direct',
				y: 301340,
				z: 201.8
			}, {
				name: 'Bing',
				y: 357022,
				z: 235.6
			}]
		}]
	});
	
	
	
	
	
	