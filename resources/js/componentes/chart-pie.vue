<template>
    <div :class="is_show? '': 'd-none'">
        <div v-if="preloading != 'none' && !hasData" style="height: 70vh">
            <div class="text-center font-24 vertical-align-middle" style="margin-top: 50vh">
                <i class="fa fa-spinner fa-spin"></i> {{ (preloading == '')? "Cargando datos ...": preloading }}
            </div>
        </div>
        <div :id="keyname" ref="chartdiv" :class="(preloading != 'none' && !hasData)? 'hide': ''" style="height: 70vh"></div>
    </div>
</template>
<script>
import * as am4core from "@amcharts/amcharts4/core";
import * as am4charts from "@amcharts/amcharts4/charts";
import am4themes_animated from "@amcharts/amcharts4/themes/animated";

am4core.useTheme(am4themes_animated);

export default {
    props: {
        altura: {type: String, default: "150"},
        ruta: {type: String, default: 'none'},
        contexto: {type: String, default: 'datos'},
        campo_categoria: {type: String, default: 'categoria'},
        campo_valor: {type: String, default: 'valor'},
        campo_color: {type: String, default: ''},
        lanzarevento: {type: String, default: 'none'},
        multitamaño: {type: Boolean, default: false},
        etiquetas: {type: String, default: 'none'},
        leyenda: {type: String, default: 'none'},
        radio: {type: String, default: "0"},
        esquinaredonda: {type: Boolean, default: false},
        efecto: {type: Boolean, default: false},
        alfa: {type: String, default: '1'},
        paleta: {type: String, default: "basica"},
        muestra: {type: Boolean, default: false},
        preloading: {type: String, default: 'none'},
        totalizar: {type: String, default: 'none'},
        ocultar: {type: Boolean, default: false},
    },
    data(){
        return {
            keyname: '_am4_' + Math.random().toString().replace("0.", ""),
            chart: null,
            datos: [],
            ejeCategorias: null,
            ejeValores: null,
            listSeries: [],
            label: null,
            paletas: {
                basica: ["#67b7dc", "#6794dc", "#6771dc", "#8067dc", "#a367dc", "#c767dc", "#dc67ce", "#dc67ab", "#dc6788", "#dc6967", "#dc8c67", "#dcaf67", "#dcd267", "#c3dc67", "#a0dc67", "#7ddc67", "#67dc75", "#67dc98", "#67dcbb", "#67dadc"],
                material: ["#f44336", "#e91e63", "#9c27b0", "#673ab7", "#3f51b5", "#2196f3", "#03a9f4", "#00bcd4", "#009688", "#4caf50", "#8bc34a", "#cddc39", "#ffeb3b", "#ffc107", "#ff9800", "#ff5722", "#795548", "#9e9e9e", "#607d8b"],
                dataviz: ["#283250", "#902c2d", "#d5433d", "#f05440", "#f05440", "#f26958", "#f47e6f", "#f69487", "#f7a99f", "#f9beb6", "#fbd3ce", "#d32711", "#eb2b12", "#741509", "#8c1a0b", "#a41e0d", "#bb220f", "#741509", "#8c1a0b", "#a41e0d", "#bb220f", "#d32711", "#eb2b12", "#ee3f28"],
                kelly: ["#f3c300", "#875692", "#f38400", "#a1caf1", "#be0032", "#c2b280", "#848482", "#008856", "#e68fac", "#0067a5", "#f99379", "#604e97", "#f6a600", "#b3446c", "#dcd300", "#882d17", "#8db600", "#654522", "#e25822", "#2b3d26", "#f2f3f4", "#222222"],
                frozen: ["#bec4f8", "#a5abee", "#6a6dde", "#4d42cf", "#713e8d", "#a160a0", "#eb6eb0", "#f597bb", "#fbb8c9", "#f8d4d8"],
                moonrise: ["#3a1302", "#601205", "#8a2b0d", "#c75e24", "#c79f59", "#a4956a", "#868569", "#756f61", "#586160", "#617983"],
                custom: [],
            },
            themePaleta: '',
            _accion: null,
            hasData: false,
            halfsize: 0,
            isCreated: false,
            is_show: true,
        }
    },
    methods: {
        formatMiles: function(num){
            var regla = /(\d+)(\d{3})/;
            var tmp = String(num);
            while(regla.test(tmp)){
                tmp = tmp.replace(regla, '$1' + ',' + '$2');
            }
            return tmp;
        },
        preview: function(){
            let dt = [];
            ['Montería', 'Bogotá', 'Medellín', 'Cali', 'Cartagena'].forEach(elm => {
                dt.push({'categoria': elm, 'valor': Math.round(Math.random() * 20 + 10)});
            });
            this.setDatos(dt);
        },
        loadRuta: function(){
            if(this.ruta != 'none'){
                axios.get(this.ruta).then(response => {
                    this.setDatos(response.data[this.contexto]);
                }).catch(err => {console.log(err)});
            }
        },
        setDatos: function(arg){
            this.datos = arg;
            if(this.isCreated){
                this.chart.data = this.datos;
                if(this.totalizar != "none"){
                    var rs = this.datos.reduce((acum, elm) => acum + parseInt(elm[this.listSeries[0]]), 0);
                    this.label.text = this.formatMiles(rs);
                }
            }
            this.hasData = true;
        },
        loadingStatus: function(){
            this.setDatos([]);
            this.hasData = false;
        },
        setAccion: function(arg){
            this._accion = arg;
        },
        setPaleta: function(arg){
            if(arg == '' || arg == undefined){
                this.themePaleta = 'basica';
            }else if(['basica', 'material', 'dataviz', 'kelly', 'frozen', 'moonrise'].indexOf(arg) > -1){
                this.themePaleta = arg;
            }else if(/^\d+$/.test(arg)){
                var plt = ['basica', 'basica', 'material', 'dataviz', 'kelly', 'frozen', 'moonrise'];
                var num = parseInt(arg);
                this.themePaleta = (num > 0 && num < 7)? plt[num]: 'basica';
            }else if(/#/.test(arg)){
                this.paletas.custom = arg.split(',');
                this.themePaleta = 'custom';
            }else{
                this.themePaleta = 'basica';
            }
        },
        getPaleta: function(){
            return this.paletas[this.themePaleta];
        },
        createChart: function(){
            var colorSet = new am4core.ColorSet();
            colorSet.list = this.getPaleta().map(col => new am4core.color(col));
            this.chart = this.efecto? am4core.create(this.$refs.chartdiv, am4charts.PieChart3D): am4core.create(this.$refs.chartdiv, am4charts.PieChart);
            this.chart.hiddenState.properties.opacity = 0;
            // alert(this.chart.radius);
            if(this.efecto){
                //this.chart.innerRadius = 50;
            }
            if(this.totalizar != "none"){
                if(this.radio == "0"){
                    this.chart.innerRadius = 100;
                }
                var bis = this.totalizar.split('|');
                var tam = (this.totalizar == '')? 50: parseInt(bis[0]);
                this.label = this.chart.seriesContainer.createChild(am4core.Label);
                this.label.horizontalCenter = "middle";
                this.label.verticalCenter = "middle";
                this.label.fontSize = tam;
                if(bis.length > 1){
                    this.subtx = this.chart.seriesContainer.createChild(am4core.Label);
                    this.subtx.horizontalCenter = "middle";
                    this.subtx.verticalCenter = "middle";
                    this.subtx.fontSize = (bis.length == 3)? parseInt(bis[2]): 14;
                    this.subtx.dy = parseInt(tam / 2);
                    this.subtx.text = bis[1];
                }

            }
            this.listSeries.forEach(elm => {
                var serie = this.efecto? this.chart.series.push(new am4charts.PieSeries3D()): this.chart.series.push(new am4charts.PieSeries());
                serie.slices.template.states.getKey('hover').properties.scale = 1.1;
                serie.slices.template.states.getKey('active').properties.shiftRadius = 0;
                if(this.campo_color != ''){
                    serie.slices.template.propertyFields.fill = this.campo_color;
                }else{
                    serie.colors = colorSet;
                }
                serie.dataFields.category = this.campo_categoria;
                serie.dataFields.value = elm;

                /*  Efecto interesante de labels plegados al borde
                serie.alignLabels = false;
                serie.labels.template.bent = true;
                serie.labels.template.radius = 3;
                serie.labels.template.padding(0,0,0,0);
                */

                if(this.multitamaño) serie.dataFields.radiusValue = elm;
                if(parseInt(this.radio) > 0) serie.innerRadius = am4core.percent(parseInt(this.radio));
                if(this.esquinaredonda) serie.slices.template.cornerRadius = 6;
                serie.slices.template.stroke = am4core.color("#FFF");
                serie.slices.template.strokeWidth = 0;
                serie.slices.template.strokeOpacity = 0;
                serie.slices.template.fillOpacity = 1;
                if(this.etiquetas != 'none'){
                    // content | truncate | multiline | size          content: default|category|value
                    var opt = this.etiquetas.split('|').reduce((acum, elm) => {
                        var bi = elm.split(':');
                        if(['content', 'truncate', 'multiline', 'size'].indexOf(bi[0]) >= 0) acum[bi[0]] = bi[1];
                        return acum;
                    }, {'content': 'default', 'truncate': 'false', 'multiline': 'false', 'size': 'none'});
                    if(opt.content == 'category'){
                        serie.labels.template.text = "{category}";
                    }else if(opt.content == 'value'){
                        serie.labels.template.text = "{value.percent.formatNumber('#.0')}%";
                    }
                    if(opt.multiline == 'true'){
                        serie.labels.template.maxWidth = 130;
                        serie.labels.template.wrap = true;
                    }else if(opt.truncate == 'true'){
                        serie.labels.template.maxWidth = 130;
                        serie.labels.template.truncate = true;
                    }
                    if(opt.size != 'none'){
                        serie.labels.template.fontSize = parseInt(opt.size);
                    }
                    //serie.alignLabels = false;
                }else{
                    serie.labels.template.disabled = true;
                }
                serie.slices.template.events.on("hit", ev => {
                    var contexto = ev.target.dataItem.dataContext;
                    if(this._accion != null){
                        this._accion(contexto);
                    }
                    if(this.lanzarevento != 'none'){
                        var tm = contexto;
                        tm.campo_categoria = this.campo_categoria;
                        tm.campo_valor = elm;
                        this.$eventBus.$emit(this.lanzarevento, tm);
                    }
                });
            });
            if(this.leyenda != 'none'){
                // left | fontSize | markerHeight | color
                var opt = ['bottom', 12, 14, '#F1F3F4', true];
                this.leyenda.split('|').forEach((elm, i) => opt[i] = elm);
                this.chart.legend = new am4charts.Legend();
                this.chart.legend.useDefaultMarker = true;

                this.chart.legend.position = opt[0];
                this.chart.legend.labels.template.fontSize = opt[1];
                this.chart.legend.markers.template.height = opt[2];
                this.chart.legend.background.fill = am4core.color(opt[3]);
                if(opt[4] == 'true'){
                    this.chart.legend.valueLabels.template.disabled = true;
                }else{
                    this.chart.legend.valueLabels.template.align = 'right';
                    this.chart.legend.valueLabels.template.textAlign = 'end';
                }
                // this.chart.legend.background.stroke = am4core.color("#D3D4D6");
                // this.chart.legend.background.strokeWidth = 1;
            }
            this.isCreated = true;
        },
        setVisible: function(bool){
            this.is_show = bool;
        },
        listen: function(){
            $eventBus.$on('view-mode', mode => this.setVisible(mode == 'chart'));
            $eventBus.$on('change-page', arg => {
                var schema = {};
                arg.registros.forEach(elm => {
                    if(schema[elm.status] == undefined){
                        schema[elm.status] = {'categoria': elm.status, 'valor': 0};
                    }
                    schema[elm.status].valor++;
                });
                this.setDatos(Object.values(schema));
            });
        }
    },
    mounted(){
        this.is_show = !this.ocultar;
        this.halfsize = parseInt(this.altura)  * 0.5;
        this.setPaleta(this.paleta);
        this.listSeries = this.campo_valor.split(',');
        this.createChart();
        this.loadRuta();
        if(this.muestra){
            this.preview();
        }
        this.listen();
    }
}
</script>