<template>
    <div>
        <div id="tokai" style="height:500px"></div>
        <button class="btn btn-danger bg-gradient" v-on:click="cambiar">Probar</button>
    </div>
</template>
<script>
import * as am5 from "@amcharts/amcharts5";
import * as am5xy from "@amcharts/amcharts5/xy";

export default {
    props: {
        mimetic: {type: String, default: ''}
    },
    data() {
        return {
            tokai: '',
            // series: null,
            data: [],
            some: null,
            schema: [],
            mochai: null,
            lc_series: null,
            lc_cates: null,
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
        nodo: function(){
            this.rooty = am5.Root.new("tokai");
            let chart = this.rooty.container.children.push(am5xy.XYChart.new(this.rooty, {
                // panX: true,
                // panY: true,
                // wheelX: "panX",
                // wheelY: "zoomX",
                // pinchZoomX:true
            }));

            let cursor = chart.set("cursor", am5xy.XYCursor.new(this.rooty, {}));
            cursor.lineY.set("visible", false);

            let xRenderer = am5xy.AxisRendererX.new(this.rooty, { minGridDistance: 30 });
            xRenderer.labels.template.setAll({
                rotation: -90,
                centerY: am5.p50,
                centerX: am5.p100,
                paddingRight: 15
            });

            let xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(this.rooty, {
                maxDeviation: 0.3,
                categoryField: "country",
                renderer: xRenderer,
                tooltip: am5.Tooltip.new(this.rooty, {})
            }));

            let yAxis = chart.yAxes.push(am5xy.ValueAxis.new(this.rooty, {
                maxDeviation: 0.3,
                renderer: am5xy.AxisRendererY.new(this.rooty, {})
            }));

            let series = chart.series.push(am5xy.ColumnSeries.new(this.rooty, {
                name: "Series 1",
                xAxis: xAxis,
                yAxis: yAxis,
                valueYField: "value",
                sequencedInterpolation: true,
                categoryXField: "country",
                tooltip: am5.Tooltip.new(this.rooty, {
                    labelText:"{valueY}"
                })
            }));
            series.columns.template.setAll({ cornerRadiusTL: 5, cornerRadiusTR: 5 });
            series.columns.template.adapters.add("fill", function(fill, target) {
                return chart.get("colors").getIndex(series.columns.indexOf(target));
            });
            series.columns.template.adapters.add("stroke", function(stroke, target) {
                return chart.get("colors").getIndex(series.columns.indexOf(target));
            });

            let data = [{country: "USA", value: 2025}, {country: "China", value: 1882}, {country: "Japan", value: 1809}, {country: "Germany", value: 1322}, {country: "India", value: 984}, {country: "Spain", value: 711}, {country: "South Korea", value: 443}, {country: "Canada", value: 441}];
            xAxis.data.setAll(data);
            series.data.setAll(data);
            this.lc_cates = xAxis;
            this.lc_series = series;
        },
        setDatos: function(arr){
            this.lc_cates.data.setAll(arr);
            this.lc_series.data.setAll(arr);
        },
        cambiar: function(){
            var dat = [{country: "USA", value: 2025}, {country: "China", value: 1882}, {country: "Japan", value: 1809}];
            this.setDatos(dat);
        }
    },
    mounted() {
        this.makeToken();
        // this.chispa();
        // var kan = [{country: "USA", value: 2025}, {country: "China", value: 1882}, {country: "Japan", value: 1809}, {country: "Germany", value: 1322}, {country: "UK", value: 1122}];
        // this.setDatos(kan);
        this.nodo();
    }
}
</script>