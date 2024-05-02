class Temperature {

    constructor() {
        this.elem = '#temperature';
        this.options = {
            chart: {
                type: 'line',
                height: '200px',
                toolbar: {
                    show: false
                },
                animations: {
                    enabled: true,
                    easing: 'linear',
                    dynamicAnimation: {
                      speed: 1000
                    }
                },
            },
            series: [
                {
                    name: 'IOT',
                    data: [25, 28, 28, 29, 27]
                },
                {
                    name: 'Edge',
                    data: [29, 30, 27, 28, 29]
                }
            ],
            colors: ['#77B6EA', '#545454'],
            stroke: {
                curve: 'straight'
            },
            xaxis: {
                categories: [
                    '07:00', '08:00', '09:00', '09:30', '10:00'
                ]
            },
            yaxis: {
                min: Math.min(...[29, 30, 27, 28, 29, 25, 28, 28, 29, 27]),
                max: Math.max(...[29, 30, 27, 28, 29, 25, 28, 28, 29, 27]) + 2,
                tickAmount: 4,
                labels: {
                    formatter: (text) => text.toFixed(0) + '°C'
                }
            },
            stroke: {
                width: 3
            }
        };
        this.chart = '';
        this.init();
    }

    init() {
        if (!this.chart) {
            this.chart = new ApexCharts(document.querySelector(this.elem), this.options);
            this.chart.render();
        }
        this.liveChart();
    }

    liveChart() {
        setInterval(() => {
            let dataset1 = this.getRandomData();
            let dataset2 = this.getRandomData();
            let conc = dataset1.concat(dataset2);
            this.chart.updateOptions({
                // xaxis: {
                //     categories: this.getRandomCategories()
                // },
                yaxis: {
                    min: Math.min(...conc),
                    max: Math.max(...conc) + 2,
                    tickAmount: 4,
                    labels: {
                        formatter: (text) => text.toFixed(0) + '°C'
                    }
                },
                series: [
                    {
                        name: 'IOT',
                        data: dataset1
                    },
                    {
                        name: 'Edge',
                        data: dataset2
                    }
                ]
            });
        }, 3000);
    }

    getRandomData() {
        let arr = [25, 26, 27, 28, 29, 30, 31];
        let temp = [];
        for (let i = 0; i < 5; i++) {
            temp.push(arr[Math.floor(Math.random() * 7)]);
        }

        return temp;
    }

    getRandomCategories() {
        let arr = ['07:00', '08:00', '09:00', '09:30', '10:00', '11:00', '23:00'];
        let temp = [];
        for (let i = 0; i < 5; i++) {
            temp.push(arr[Math.floor(Math.random() * 7)]);
        }

        return temp;
    }


}
