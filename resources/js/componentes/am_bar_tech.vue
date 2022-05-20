<template>
    <div id="tokai" ref="tokai" style="height:400px"></div>
</template>
<script>
import { onMounted, ref } from 'vue';
import * as am5 from "@amcharts/amcharts5";
import * as am5xy from "@amcharts/amcharts5/xy";

export default {
    name: 'Sinabia',
    props: {},
    emits: [],
    setup() {
        const tokai = ref(null);
        let root = null;
        let chart = null;
        // let series = null;
        // let data = [];

        const iniMap = () => {
            console.log('rooty');
            console.log(root);
            root = am5.Root.new(tokai.value);
            chart = root.container.children.push( am5xy.XYChart.new(root, {}) );

            let xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
                categoryField: "country",
                // renderer: x
                tooltip: am5.Tooltip.new(root, {})
            }));
            let yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                maxDeviation: 0.3,
                renderer: am5xy.AxisRendererY.new(root, {})
            }));
            let series = chart.series.push(am5xy.ColumnSeries.new(root, {
                name: "Series 1",
                xAxis: xAxis,
                yAxis: yAxis,
                valueYField: "value",
                sequencedInterpolation: true,
                categoryXField: "country",
                tooltip: am5.Tooltip.new(root, {
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
            data = [{country: "USA", value: 2025}, {country: "China", value: 1882}, {country: "Japan", value: 1809}, {country: "Germany", value: 1322}, {country: "India", value: 984}, {country: "Spain", value: 711}, {country: "South Korea", value: 443}, {country: "Canada", value: 441}];
            xAxis.data.setAll(data);
            series.data.setAll(data);
        }

        // iniMap();

        onMounted(() => {
            iniMap();
            console.log('-- kunai --');
            // tm = am5xy.CategoryAxis.new(root, {
            //     categoryField: "country",
            //     // renderer: x
            //     tooltip: am5.Tooltip.new(root, {})
            // })
            // let xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
            //     categoryField: "country",
            //     // renderer: x
            //     tooltip: am5.Tooltip.new(root, {})
            // }));

        })
        return {tokai};
    }
}
</script>
