class FlowrateSensor {

    constructor(data, treshold) {
        this.elem = '#FlowrateSensor';
        this.elData = data.map(d => d[0]);
        this.treshold = treshold;
        this.categories = data.map(d => {
            let dt = new Date(d[1]);
            return `${dt.getHours()}:${((dt.getMinutes() < 10 ? '0' : '') + dt.getMinutes())}`;
        })

        if (this.elData.length < 1)
            this.elData = [0, 0, 0, 0, 0];
        if (this.categories.length < 1)
            this.categories = ['-', '-', '-', '-', '-'];

        this.options = {
            chart: {
                type: 'area',
                height: '200px',
                toolbar: {
                    show: false
                },
                zoom: { enabled: false },
                parentHeightOffset: 0,
                animations: {
                    enabled: true,
                    easing: 'linear',
                    dynamicAnimation: {
                        speed: 1000
                    }
                },
            },
            markers: {
                strokeWidth: 7,
                strokeOpacity: 1,
                strokeColors: ['#fff'],
                colors: ['#FF9F43']
            },
            annotations: {
                yaxis: [
                    {
                        y: parseFloat(this.treshold.value),
                        opacity: 0.8,
                        borderColor: '#FF4560',
                        label: {
                            borderColor: '#00E396',
                            style: {
                                color: '#fff',
                                background: '#FF4560',
                            },
                            text: `Threshold : ${this.treshold.value}`,
                        }
                    }
                ]
            },
            dataLabels: {
                enabled: false
            },
            series: [
                {
                    name: 'Flowrate',
                    data: this.elData
                }
            ],
            stroke: {
                width: 3,
                curve: 'smooth'
            },
            grid: { xaxis: { lines: { show: true } } },
            xaxis: {
                categories: this.categories
            },
            yaxis: {
                min: 0,
                max: Math.max(...this.elData),
                tickAmount: 4,
                decimalsInFloat: 1,
                labels: {
                    formatter: (text) => `${text}`
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
    }

    update(value, created_at) {
        this.elData.push(value);
        if (this.elData.length === 6) this.elData.shift();

        const date = new Date(created_at);
        const time = `${date.getHours()}:${((date.getMinutes() < 10 ? '0' : '') + date.getMinutes())}`;

        this.categories.push(time);
        if (this.categories.length === 6) this.categories.shift();

        this.chart.updateOptions({
            xaxis: {
                categories: this.categories
            },
            series: [
                {
                    data: this.elData
                }
            ],
            yaxis: {
                min: 0,
                max: Math.max(...this.elData),
                tickAmount: 4,
                decimalsInFloat: 1,
                labels: {
                    formatter: (text) => `${text}`
                },
            },
        });
    }

}
