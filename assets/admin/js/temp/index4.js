$(function () {
	"use strict";
	// chart 1
	Highcharts.chart('chart1', {
		chart: {
			height: 350,
			plotBackgroundColor: null,
			plotBorderWidth: null,
			plotShadow: false,
			type: 'pie',
			styledMode: true
		},
		credits: {
			enabled: false
		},
		title: {
			text: 'Sessions Device'
		},
		subtitle: {
			text: 'Ratio of devices use by users'
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
				innerSize: 120,
				dataLabels: {
					enabled: true,
					format: '<b>{point.name}</b>: {point.percentage:.1f} %'
				},
				showInLegend: true
			}
		},
		//colors: ['#ff9ad5', '#50b5ff', '#5a65dc'],
		series: [{
			name: 'Users',
			colorByPoint: true,
			data: [{
				name: 'Desktop',
				y: 56
			}, {
				name: 'Mobile',
				y: 30
			}, {
				name: 'Tablet',
				y: 14
			}]
		}],
		responsive: {
			rules: [{
				condition: {
					maxWidth: 500
				},
				chartOptions: {
					plotOptions: {
						pie: {
							innerSize: 140,
							dataLabels: {
								enabled: false
							}
						}
					},
				}
			}]
		}
	});
	// chart 2
	// Create the chart
	Highcharts.chart('chart2', {
		chart: {
			height: 350,
			type: 'column',
			styledMode: false
		},
		credits: {
			enabled: false
		},
		title: {
			text: 'Browser usage'
		},
		subtitle: {
			text: 'Records of browser usage by users'
		},
		accessibility: {
			announceNewData: {
				enabled: true
			}
		},
		xAxis: {
			type: 'category'
		},
		yAxis: {
			title: {
				text: 'Browsers usage by users'
			}
		},
		legend: {
			enabled: false
		},
		plotOptions: {
			series: {
				borderWidth: 0,
				dataLabels: {
					enabled: true,
					format: '{point.y:.1f}%'
				}
			}
		},
		tooltip: {
			headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
			pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
		},
		colors: ['#ff6459', '#f5964b', '#56aafb', '#62aedf', '#9a78f0', '#5bb75f'],
		series: [{
			name: "Browsers",
			colorByPoint: true,
			data: [{
				name: "Chrome",
				y: 47.29,
				drilldown: "Chrome"
			}, {
				name: "Firefox",
				y: 24.25,
				drilldown: "Firefox"
			}, {
				name: "Internet Explorer",
				y: 41.48,
				drilldown: "Internet Explorer"
			}, {
				name: "Safari",
				y: 44.32,
				drilldown: "Safari"
			}, {
				name: "Edge",
				y: 76.39,
				drilldown: "Edge"
			}, {
				name: "Opera",
				y: 16.92,
				drilldown: "Opera"
			}]
		}],
		drilldown: {
			series: [{
				name: "Chrome",
				id: "Chrome",
				data: [
					["v65.0",
						0.1
					],
					["v64.0",
						1.3
					],
					["v63.0",
						53.02
					],
					["v62.0",
						1.4
					],
					["v61.0",
						0.88
					],
					["v60.0",
						0.56
					],
					["v59.0",
						0.45
					],
					["v58.0",
						0.49
					],
					["v57.0",
						0.32
					],
					["v56.0",
						0.29
					],
					["v55.0",
						0.79
					],
					["v54.0",
						0.18
					],
					["v51.0",
						0.13
					],
					["v49.0",
						2.16
					],
					["v48.0",
						0.13
					],
					["v47.0",
						0.11
					],
					["v43.0",
						0.17
					],
					["v29.0",
						0.26
					]
				]
			}, {
				name: "Firefox",
				id: "Firefox",
				data: [
					["v58.0",
						1.02
					],
					["v57.0",
						7.36
					],
					["v56.0",
						0.35
					],
					["v55.0",
						0.11
					],
					["v54.0",
						0.1
					],
					["v52.0",
						0.95
					],
					["v51.0",
						0.15
					],
					["v50.0",
						0.1
					],
					["v48.0",
						0.31
					],
					["v47.0",
						0.12
					]
				]
			}, {
				name: "Internet Explorer",
				id: "Internet Explorer",
				data: [
					["v11.0",
						6.2
					],
					["v10.0",
						0.29
					],
					["v9.0",
						0.27
					],
					["v8.0",
						0.47
					]
				]
			}, {
				name: "Safari",
				id: "Safari",
				data: [
					["v11.0",
						3.39
					],
					["v10.1",
						0.96
					],
					["v10.0",
						0.36
					],
					["v9.1",
						0.54
					],
					["v9.0",
						0.13
					],
					["v5.1",
						0.2
					]
				]
			}, {
				name: "Edge",
				id: "Edge",
				data: [
					["v16",
						2.6
					],
					["v15",
						0.92
					],
					["v14",
						0.4
					],
					["v13",
						0.1
					]
				]
			}, {
				name: "Opera",
				id: "Opera",
				data: [
					["v50.0",
						0.96
					],
					["v49.0",
						0.82
					],
					["v12.1",
						0.14
					]
				]
			}]
		}
	});
	// chart 3
	Highcharts.chart('chart3', {
		chart: {
			height: 330,
			type: 'column',
			styledMode: true
		},
		credits: {
			enabled: false
		},
		title: {
			text: 'Website Audience Overview',
			style: {
				display: 'none',
			}
		},
		subtitle: {
			text: 'Website Audience Overview',
			style: {
				display: 'none',
			}
		},
		xAxis: {
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
			crosshair: true
		},
		yAxis: {
			min: 0,
			title: {
				text: 'Rainfall (mm)',
				style: {
					display: 'none',
				}
			}
		},
		exporting: {
			buttons: {
				contextButton: {
					enabled: false,
				}
			}
		},
		tooltip: {
			headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
			pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' + '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
			footerFormat: '</table>',
			shared: true,
			useHTML: true
		},
		plotOptions: {
			column: {
				pointPadding: 0.2,
				borderWidth: 0
			}
		},
		//colors: ['#50b5ff', '#ff9ad5'],
		series: [{
			name: 'New Visitors',
			data: [70.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]
		}, {
			name: 'Returning Visitors',
			data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2]
		}]
	});
	// chart 4
	// Make monochrome colors
	var pieColors = (function () {
		var colors = ['#0370e6', 'rgb(3 112 230 / 76%)', 'rgb(3 112 230 / 60%)', 'rgb(3 112 230 / 46%)', 'rgb(3 112 230 / 26%)'],
			base = Highcharts.getOptions().colors[0],
			i;
		for (i = 0; i < 10; i += 1) {
			// Start out with a darkened base color (negative brighten), and end
			// up with a much brighter color
			colors.push(Highcharts.color(base).brighten((i - 3) / 7).get());
		}
		return colors;
	}());
	// Build the chart
	Highcharts.chart('chart4', {
		chart: {
			//height:380,
			plotBackgroundColor: null,
			plotBorderWidth: null,
			plotShadow: false,
			type: 'pie',
			//styledMode: true
		},
		credits: {
			enabled: false
		},
		exporting: {
			buttons: {
				contextButton: {
					enabled: false,
				}
			}
		},
		title: {
			text: 'Visitors by Location'
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
				innerSize: 0,
				colors: pieColors,
				dataLabels: {
					enabled: true,
					format: '<b>{point.name}</b><br>{point.percentage:.1f} %',
					distance: -50,
					filter: {
						property: 'percentage',
						operator: '>',
						value: 4
					}
				}
			}
		},
		series: [{
			name: 'Visitors',
			data: [{
				name: 'USA',
				y: 61.41
			}, {
				name: 'Australia',
				y: 11.84
			}, {
				name: 'India',
				y: 4.67
			}, {
				name: 'China',
				y: 4.18
			}, ]
		}]
	});
	// chart 5
	Highcharts.chart('chart5', {
		chart: {
			type: 'line',
			styledMode: true
		},
		title: {
			text: 'Popular Pages'
		},
		credits: {
			enabled: false
		},
		exporting: {
			buttons: {
				contextButton: {
					enabled: false,
				}
			}
		},
		yAxis: {
			title: {
				text: 'Popular Pages',
				style: {
					display: 'none',
				}
			}
		},
		xAxis: {
			categories: ['Jan', 'Feb', 'Mar', 'Apr']
		},
		legend: {
			layout: 'vertical',
			align: 'right',
			verticalAlign: 'middle'
		},
		plotOptions: {
			series: {
				label: {
					connectorAllowed: false
				},
				pointStart: 2010
			}
		},
		//colors: ['#dc3545', '#01adff', '#673ab7'],
		series: [{
			name: 'Search',
			data: [43934, 52503, 57177, 69658, 97031, 119931, 137133, 154175]
		}, {
			name: 'Payment',
			data: [24916, 24064, 29742, 29851, 32490, 30282, 38121, 40434]
		}, {
			name: 'Profile',
			data: [11744, 17722, 16005, 19771, 20185, 24377, 32147, 39387]
		}],
		responsive: {
			rules: [{
				condition: {
					maxWidth: 500
				},
				chartOptions: {
					legend: {
						layout: 'horizontal',
						align: 'center',
						verticalAlign: 'bottom'
					}
				}
			}]
		}
	});
	// chart 6
	Highcharts.chart('chart6', {
		chart: {
			type: 'bar',
			styledMode: true
		},
		credits: {
			enabled: false
		},
		exporting: {
			buttons: {
				contextButton: {
					enabled: false,
				}
			}
		},
		//colors: ['#7c6cfb', '#02c9ef', '#f7a103'],
		title: {
			text: 'Visitor by Gender'
		},
		xAxis: {
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May']
		},
		yAxis: {
			min: 0,
			title: {
				text: 'Visitor by Genders',
				style: {
					display: 'none',
				}
			}
		},
		legend: {
			reversed: false
		},
		plotOptions: {
			series: {
				stacking: 'normal'
			}
		},
		series: [{
			name: 'Male',
			data: [5, 3, 4, 7, 2]
		}, {
			name: 'Female',
			data: [2, 2, 3, 2, 1]
		}, {
			name: 'Others',
			data: [3, 4, 4, 2, 5]
		}]
	});
});