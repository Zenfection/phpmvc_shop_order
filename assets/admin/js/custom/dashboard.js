$(function () {
    var count_order = parseInt(document.getElementById('count_order').textContent);
    var count_processing = parseInt(document.getElementById('count_processing').textContent);
    var count_shipping = parseInt(document.getElementById('count_shipping').textContent);
    var count_canceled = parseInt(document.getElementById('count_canceled').textContent);
    var count_delivered = count_order - count_processing - count_shipping - count_canceled;

    var order = Math.round(count_delivered / count_order * 100, 2);
    // chart4
    var options = {
        series: [order],
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

    new PerfectScrollbar('.best-selling-products');
    new PerfectScrollbar('.recent-reviews');
    //new PerfectScrollbar('.support-list');
});