$(function () {
	"use strict";
	
	// chart1
	var options = {
		series: [{
			name: 'Revenue',
			data: [4, 3, 10, 9, 29, 19, 22, 9, 12, 7, 19, 5]
		}],
		chart: {
			foreColor: '#9a9797',
			type: 'area',
			height: 380,
			zoom: {
				enabled: false
			},
			toolbar: {
				show: false
			},
			dropShadow: {
				enabled: false,
				top: 3,
				left: 14,
				blur: 4,
				opacity: 0.10,
			}
		},
		stroke: {
			width: 4,
			curve: 'smooth'
		},
		xaxis: {
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
		},
		dataLabels: {
			enabled: false
		},
		fill: {
			type: 'gradient',
			gradient: {
				shade: 'light',
				gradientToColors: ['#8833ff'],
				shadeIntensity: 1,
				type: 'vertical',
				opacityFrom: 0.8,
				opacityTo: 0.3,
				//stops: [0, 100, 100, 100]
			},
		},
		colors: ["#8833ff"],
		yaxis: {
		  labels: {
			formatter: function (value) {
			  return value + "$";
			}
		  },
		},
		markers: {
			size: 4,
			colors: ["#8833ff"],
			strokeColors: "#fff",
			strokeWidth: 2,
			hover: {
				size: 7,
			}
		},
		grid: {
		   show: true,
		   borderColor: '#ededed',
		   strokeDashArray: 4,
		}
	};
	var chart = new ApexCharts(document.querySelector("#chart1"), options);
	chart.render();

	// chart 2
	var options = {
		series: [{
			name: 'Visitors',
			data: [94, 55, 57, 56, 61, 58, 63, 60, 66]
		}, {
			name: 'Chats',
			data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
		}, {
			name: 'Page Views',
			data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
		}],
		chart: {
			foreColor: '#9a9797',
			type: 'bar',
			height: 320,
			stacked: true,
			toolbar: {
				show: false
			},
		},
		plotOptions: {
			bar: {
				horizontal: false,
				columnWidth: '18%',
				//endingShape: 'rounded'
			},
		},
		legend: {
			show: false,
			position: 'top',
			horizontalAlign: 'left',
			offsetX: -20
		},
		dataLabels: {
			enabled: false
		},
		stroke: {
			show: true,
			width: 2,
			colors: ['transparent']
		},
		colors: ["#e62e2e", "#29cc39", "#0dcaf0"],
		xaxis: {
			categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
		},
		fill: {
			opacity: 1
		},
		grid: {
		   show: true,
		   borderColor: '#ededed',
		   strokeDashArray: 4,
		},
		responsive: [{
			breakpoint: 480,
			options: {
				chart: {
					height: 310,
				},
				plotOptions: {
					bar: {
						columnWidth: '30%'
					}
				}
			}
		}]
	};
	var chart = new ApexCharts(document.querySelector("#chart2"), options);
	chart.render();

	// chart 3
	var options = {
		series: [{
			name: 'Visitors',
			data: [4, 3, 10, 9, 29, 19, 22, 9, 12, 7, 19, 5, 13, 9, 17, 2, 7, 5]
		}],
		chart: {
			type: 'bar',
			height: 83,
			sparkline: {
				enabled: true
			},
			stacked: true,
			toolbar: {
				show: false
			},
		},
		plotOptions: {
			bar: {
				horizontal: false,
				columnWidth: '30%',
				//endingShape: 'rounded'
			},
		},
		legend: {
			position: 'top',
			horizontalAlign: 'left',
			offsetX: 0
		},
		dataLabels: {
			enabled: false
		},
		stroke: {
			show: true,
			width: 0,
			colors: ['transparent']
		},
		colors: ["#fff"],
		tooltip: {
			theme: 'dark',
			x: {
			  show: false
			},
		},
		xaxis: {
			categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
		},
		fill: {
			opacity: 1
		}
	};
	var chart = new ApexCharts(document.querySelector("#chart3"), options);
	chart.render();

	// chart4
	var options = {
		series: [87],
		chart: {
			//foreColor: '#9a9797',
			height: 380,
			type: 'radialBar',
			offsetY: -10
		},
		plotOptions: {
			radialBar: {
				startAngle: -135,
				endAngle: 135,
				hollow: {
					margin: 0,
					size: '70%',
					background: 'transparent',
				},
				track: {
					strokeWidth: '100%',
					dropShadow: {
						enabled: false,
						top: -3,
						left: 0,
						blur: 4,
						//color: 'rgba(209, 58, 223, 0.65)',
						opacity: 0.12
					}
				},
				dataLabels: {
					name: {
						fontSize: '16px',
						color: '#212529',
						offsetY: 5
					},
					value: {
						offsetY: 20,
						fontSize: '30px',
						color: '#212529',
						formatter: function (val) {
							return val + "%";
						}
					}
				}
			}
		},
		fill: {
			type: 'gradient',
			gradient: {
				shade: 'dark',
				shadeIntensity: 0.15,
				gradientToColors: ['#4a00e0'],
				inverseColors: false,
				opacityFrom: 1,
				opacityTo: 1,
				stops: [0, 50, 65, 91]
			},
		},
		colors: ["#8e2de2"],
		stroke: {
			dashArray: 4
		},
		labels: ['Đã Giao'],
		responsive: [{
			breakpoint: 480,
			options: {
				chart: {
					height: 300,
				}
			}
		}]
	};
	var chart = new ApexCharts(document.querySelector("#chart4"), options);
	chart.render();

	// chart 5
	var options1 = {
		chart: {
			foreColor: '#9a9797',
			type: 'line',
			//width: 170,
			height: 90,
			sparkline: {
				enabled: true
			}
		},
		dataLabels: {
			enabled: false
		},
		fill: {
			type: 'gradient',
			gradient: {
				shade: 'light',
				gradientToColors: ['#fff'],
				shadeIntensity: 1,
				type: 'vertical',
				opacityFrom: 1,
				opacityTo: 1,
				stops: [0, 100, 100, 100]
			},
		},
		colors: ["#fff"],
		series: [{
			name: 'New Users',
			data: [25, 66, 41, 46, 15, 21, 59, 25, 44, 12, ]
		}],
		stroke: {
			width: 3.0,
			curve: 'smooth',
			dashArray: [0]
		},
		tooltip: {
			theme: 'dark',
			fixed: {
				enabled: false
			},
			x: {
				show: false
			},
			y: {
				title: {
					formatter: function (seriesName) {
						return ''
					}
				}
			},
			marker: {
				show: false
			}
		}
	}
	new ApexCharts(document.querySelector("#chart5"),
	options1).render();

	// chart 6
	var options = {
		series: [70],
		chart: {
			//foreColor: '#9a9797',
			height: 245,
			type: 'radialBar',
		},
		plotOptions: {
			radialBar: {
				hollow: {
					margin: 0,
					//background: '#ffdbed',	
					size: '70%',
				},
				track: {
					// background: '#ffdbed',
					strokeWidth: '100%'
				},
				dataLabels: {
					name: {
						fontSize: '15px',
						color: '#212529',
						offsetY: 5
					},
					value: {
						offsetY: 20,
						fontSize: '22px',
						color: '#212529',
						formatter: function (val) {
							return val + "%";
						}
					}
				}
			},
		},
		colors: ["#00d54b"],
		stroke: {
			// lineCap: 'round'
		},
		labels: ['Monthly Invoices'],
	};
	var chart = new ApexCharts(document.querySelector("#chart6"), options);
	chart.render();

	// chart 7
	var options = {
		series: [68],
		chart: {
			//foreColor: '#9a9797',
			height: 245,
			type: 'radialBar',
		},
		plotOptions: {
			radialBar: {
				hollow: {
					margin: 0,
					//background: '#ffdbed',	
					size: '70%',
				},
				track: {
					// background: '#ffdbed',
					strokeWidth: '100%'
				},
				dataLabels: {
					name: {
						fontSize: '15px',
						color: '#212529',
						offsetY: 5
					},
					value: {
						offsetY: 20,
						fontSize: '22px',
						color: '#212529',
						formatter: function (val) {
							return val + "%";
						}
					}
				}
			},
		},
		colors: ["#ff0037"],
		stroke: {
			// lineCap: 'round'
		},
		labels: ['Monthly Downloads']
	};
	var chart = new ApexCharts(document.querySelector("#chart7"), options);
	chart.render();
});