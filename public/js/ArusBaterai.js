class ArusBaterai {
    
    constructor() {
        this.elem = '#arus-baterai';
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
                    name: 'Arus Baterai',
                    data: [1.2, 1.4, 1, 1.2, 1.2]
                }
            ],
            stroke: {
                width: 3,
                curve: 'smooth'
            },
            xaxis: {
                categories: [
                    '07:00', '08:00', '09:00', '09:30', '10:00'
                ]
            },
            yaxis: {
                min: 1,
                max: Math.max(...[1.2, 1.2, 1.2, 1.2, 1.4]),
                tickAmount: 4,
                decimalsInFloat: 1,
                labels: {
                    formatter: (text) => text.toFixed(2) + ' V'
                },
            },
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
        // setInterval(() => {
        //     this.chart.updateOptions({
        //         xaxis: {
        //             categories: this.getRandomCategories()
        //         },
        //         series: [
        //             {
        //                 data: this.getRandomData()
        //             }
        //         ]
        //     });
        // }, 3000);
    }

    getRandomData() {
        let arr = [1.5, 1.2, 1.0, 1.4, 1.3];
        let temp = [];
        for (let i = 0; i < 5; i++) {
            temp.push(arr[Math.floor(Math.random() * 5)]);
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