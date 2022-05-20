@extends('layouts.base')
@section('estilo')
<style>
    .colmin {width:1%; white-space: nowrap; text-align:center}
</style>
@endsection
@section('contenido')
<!--breadcrumb-->
<div class="page-breadcrumb d-sm-flex align-items-center mb-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
            <li class="breadcrumb-item"><a href="{{ route('inicio') }}"><i class="bx bx-home-alt"></i></a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </nav>
</div>
<!--end breadcrumb-->
<div class="card radius-10 w-100">
    <div class="card-body">
        <am-bar></am-bar>
    </div>
</div>
@endsection
@section('logica')
<script>
    // import * as am5 from "@amcharts/amcharts5";
    // import * as am5xy from "@amcharts/amcharts5/xy";

    // let rooty = am5.Root.new("tokai");
    // let chart = rooty.container.children.push(am5xy.XYChart.new(rooty, {
    //     // panX: true,
    //     // panY: true,
    //     // wheelX: "panX",
    //     // wheelY: "zoomX",
    //     // pinchZoomX:true
    // }));

    // let cursor = chart.set("cursor", am5xy.XYCursor.new(rooty, {}));
    // cursor.lineY.set("visible", false);

    // let xRenderer = am5xy.AxisRendererX.new(rooty, { minGridDistance: 30 });
    // xRenderer.labels.template.setAll({
    //     rotation: -90,
    //     centerY: am5.p50,
    //     centerX: am5.p100,
    //     paddingRight: 15
    // });

    // let xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(rooty, {
    //     maxDeviation: 0.3,
    //     categoryField: "country",
    //     renderer: xRenderer,
    //     tooltip: am5.Tooltip.new(rooty, {})
    // }));

    // let yAxis = chart.yAxes.push(am5xy.ValueAxis.new(rooty, {
    //     maxDeviation: 0.3,
    //     renderer: am5xy.AxisRendererY.new(rooty, {})
    // }));

    // let series = chart.series.push(am5xy.ColumnSeries.new(rooty, {
    //     name: "Series 1",
    //     xAxis: xAxis,
    //     yAxis: yAxis,
    //     valueYField: "value",
    //     sequencedInterpolation: true,
    //     categoryXField: "country",
    //     tooltip: am5.Tooltip.new(rooty, {
    //         labelText:"{valueY}"
    //     })
    // }));
    // // console.log(series);
    // series.columns.template.setAll({ cornerRadiusTL: 5, cornerRadiusTR: 5 });
    // series.columns.template.adapters.add("fill", function(fill, target) {
    //     return chart.get("colors").getIndex(series.columns.indexOf(target));
    // });
    // series.columns.template.adapters.add("stroke", function(stroke, target) {
    //     return chart.get("colors").getIndex(series.columns.indexOf(target));
    // });

    // let data = [{country: "USA", value: 2025}, {country: "China", value: 1882}, {country: "Japan", value: 1809}, {country: "Germany", value: 1322}, {country: "India", value: 984}, {country: "Spain", value: 711}, {country: "South Korea", value: 443}, {country: "Canada", value: 441}];
    // xAxis.data.setAll(data);
    // series.data.setAll(data);

</script>
@endsection