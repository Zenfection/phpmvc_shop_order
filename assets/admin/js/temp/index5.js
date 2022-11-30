$(function () {
	"use strict";
	// chart 1
	var options = {
		series: [{
			name: 'Consultations',
			data: [440, 505, 414, 671, 227, 613, 901, 352, 752, 320, 257, 160]
		}, {
			name: 'Patients',
			data: [230, 420, 350, 270, 430, 320, 570, 310, 220, 220, 120, 100]
		}],
		chart: {
			foreColor: '#9a9797',
			type: 'bar',
			height: 250,
			toolbar: {
				show: false
			},
			zoom: {
				enabled: false
			},
			dropShadow: {
				enabled: true,
				top: 3,
				left: 14,
				blur: 4,
				opacity: 0.10,
			}
		},
		legend: {
			position: 'top',
			horizontalAlign: 'left',
			offsetX: -25
		},
		markers: {
			size: 4,
			// colors: ["#007bff"],
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
		},
		dataLabels: {
			enabled: false
		},
		stroke: {
			show: true,
			width: 3,
			curve: 'smooth'
		},
		colors: ["#265ed7", "#fe6555"],
		xaxis: {
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
		},
		fill: {
			opacity: 1
		}
	};
	var chart = new ApexCharts(document.querySelector("#chart1"), options);
	chart.render();
	// chart 2
	var options1 = {
		chart: {
			type: 'bar',
			width: 170,
			height: 65,
			zoom: {
				enabled: false
			},
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
			name: 'Appointments',
			data: [25, 66, 41, 59, 25, 44, 52, 36, 20, 21]
		}],
		plotOptions: {
			bar: {
				horizontal: false,
				columnWidth: '22%',
				//endingShape: 'rounded'
			},
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
	new ApexCharts(document.querySelector("#chart2"), options1).render();
	// chart 3
	var options1 = {
		chart: {
			type: 'bar',
			width: 170,
			height: 65,
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
			name: 'Surgery',
			data: [33, 41, 59, 25, 35, 44, 52, 36, 40, 21]
		}],
		plotOptions: {
			bar: {
				horizontal: false,
				columnWidth: '22%',
				//endingShape: 'rounded'
			},
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
	new ApexCharts(document.querySelector("#chart3"), options1).render();
	// chart 4
	var options = {
		series: [44, 55, 41, 17],
		chart: {
			foreColor: '#9a9797',
			height: 320,
			type: 'donut',
		},
		legend: {
			position: 'bottom',
			show: true,
		},
		plotOptions: {
			pie: {
				customScale: 0.8,
				donut: {
					size: '80%'
				}
			}
		},
		colors: ["#504da6", "#ffc200", "#6fd1f6", "#e0e6f0"],
		dataLabels: {
			enabled: false
		},
		labels: ['Flue', 'Covid-19', 'Diabetis', 'Colds'],
		responsive: [{
			breakpoint: 480,
			options: {
				chart: {
					height: 300
				},
				legend: {
					position: 'bottom'
				},
				plotOptions: {
					pie: {
						customScale: 1,
					}
				},
			}
		}]
	};
	var chart = new ApexCharts(document.querySelector("#chart4"), options);
	chart.render();
	// chart 5
	var options = {
		series: [{
			name: 'Patients',
			data: [440, 505, 414, 671, 427, 613, 901, 257, 160]
		}],
		chart: {
			type: 'area',
			height: 300,
			toolbar: {
				show: false
			},
			zoom: {
				enabled: false
			},
			dropShadow: {
				enabled: false,
				top: 3,
				left: 14,
				blur: 4,
				opacity: 0.10,
			},
			sparkline: {
				enabled: true
			}
		},
		markers: {
			size: 4,
			// colors: ["#007bff"],
			strokeColors: "#fff",
			strokeWidth: 2,
			hover: {
				size: 7,
			}
		},
		dataLabels: {
			enabled: false
		},
		stroke: {
			show: true,
			width: 3,
			curve: 'smooth'
		},
		colors: ["#ff162c"],
		xaxis: {
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
		},
		tooltip: {
			theme: 'dark',
			x: {
			  show: false
			},
		},
		fill: {
			opacity: 0.2
		}
	};
	var chart = new ApexCharts(document.querySelector("#chart5"), options);
	chart.render();
	// chart 6
	var options = {
		series: [{
			name: 'Avg Treatment Costs',
			data: [440, 505, 414, 671, 427, 613, 901, 257, 160]
		}],
		chart: {
			foreColor: '#9a9797',
			type: 'bar',
			height: 260,
			toolbar: {
				show: false
			},
			zoom: {
				enabled: false
			},
			dropShadow: {
				enabled: false,
				top: 3,
				left: 14,
				blur: 4,
				opacity: 0.10,
			},
			sparkline: {
				enabled: false
			}
		},
		grid: {
		   show: true,
		   borderColor: '#ededed',
		   strokeDashArray: 4,
		},
		plotOptions: {
			bar: {
				horizontal: false,
				columnWidth: '22%',
				endingShape: 'rounded'
			},
		},
		markers: {
			size: 4,
			// colors: ["#007bff"],
			strokeColors: "#fff",
			strokeWidth: 2,
			hover: {
				size: 7,
			}
		},
		dataLabels: {
			enabled: false
		},
		stroke: {
			show: true,
			width: 0,
			curve: 'smooth'
		},
		colors: ["#8833ff"],
		xaxis: {
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
		},
		fill: {
			opacity: 1
		}
	};
	var chart = new ApexCharts(document.querySelector("#chart6"), options);
	chart.render();
});