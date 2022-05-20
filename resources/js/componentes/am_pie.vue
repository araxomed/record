<template>
    <div>
        <div id="chart-pie" :style="{'height': altura}"></div>
    </div>
</template>
<script>
import * as am5 from "@amcharts/amcharts5";
import * as am5percent from "@amcharts/amcharts5/percent";

export default {
    props: {
        altura: {type: String, default: '500px'},
        radio: {type: String, default: '0'},
    },
    data() {
        return {
            tokai: '',
            lc_radio: 0,
            lc_series: null,
            lc_legend: null,
            status: 'ini'
        }
    },
    methods: {
        makeToken: function(){
            this.tokai = 'am_';
            for(var i = 0; i < 5; i++){
                var k = Math.round(Math.random() * 25 + 97);
                this.tokai += String.fromCharCode(k);
            }
            return this.tokai;
        },
        makeChart: function(){
            let root = am5.Root.new("chart-pie");
            let config = (this.lc_radio > 0)? {layout: root.verticalLayout, radius: am5.percent(90), innerRadius: am5.percent(this.lc_radio)}: {layout: root.verticalLayout};
            let chart = root.container.children.push(am5percent.PieChart.new(root, config));

            let series = chart.series.push(am5percent.PieSeries.new(root, {
                categoryField: "categoria",
                valueField: "total",
                alignLabels: false,
                fillField: "color",
            }));
            series.slices.template.setAll({
                strokeWidth: 1,
                stroke: am5.color(0xffffff)
            });            

            let legend = chart.children.push(am5.Legend.new(root, {
                centerX: am5.percent(50),
                x: am5.percent(50),
                marginTop: 30,
                marginBottom: 15
            }));

            this.lc_series = series;
            this.lc_legend = legend;
        },
        setDatos: function(arr){
            this.lc_series.data.setAll(arr);
            this.lc_legend.data.setAll(this.lc_series.dataItems);
            this.lc_series.appear(1000, 100);
        },
    },
    mounted() {
        // this.makeToken();
        if(this.radio != '0') this.lc_radio = parseInt(this.radio);
        this.makeChart();
    }
}
</script>