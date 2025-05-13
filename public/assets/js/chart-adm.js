$(function () {
    // pt-BR
    var locales = [{
        name: 'pt-BR',
        options: {
            months: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
            shortMonths: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
            days: ['Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado'],
            shortDays: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'],
            toolbar: {
                download: 'Download SVG',
                selection: 'Seleção',
                selectionZoom: 'Seleção Zoom',
                zoomIn: 'Aumentar',
                zoomOut: 'Diminuir',
                pan: 'Panorâmica',
                reset: 'Redefinir Zoom'
            }
        }
    }];


    // ----> Mensagens Enviadas
    var dataMsgEnviadas = [];
    var options_msg_enviadas = {

        series: [{
            name: "Enviadas",
            data: dataMsgEnviadas,
        },],
        chart: {
            locales: locales,
            defaultLocale: 'pt-BR',
            fontFamily: '"Nunito Sans",sans-serif',
            type: "area",
            stacked: false,
            height: 230,
            zoom: {
                type: "x",
                enabled: true,
                autoScaleYaxis: true,
            },
            toolbar: {
                autoSelected: "zoom",
                show: false,
            },
        },
        dataLabels: {
            enabled: false,
        },
        grid: {
            borderColor: "transparent",
        },
        colors: ["var(--bs-primary)"],
        markers: {
            size: 0,
        },
        fill: {
            type: "gradient",
            gradient: {
                shadeIntensity: 1,
                inverseColors: false,
                opacityFrom: 0.12,
                opacityTo: 0,
                stops: [0, 90, 100],
            },
        },
        yaxis: {
            labels: {

                style: {
                    colors: [
                        "#a1aab2",
                        "#a1aab2",
                        "#a1aab2",
                        "#a1aab2",
                        "#a1aab2",
                        "#a1aab2",
                    ],
                },
            },
        },
        xaxis: {
            type: "datetime",
            tickAmount: 'dataPoints',
            labels: {
                style: {
                    colors: [
                        "#a1aab2",
                        "#a1aab2",
                        "#a1aab2",
                        "#a1aab2",
                        "#a1aab2",
                        "#a1aab2",
                        "#a1aab2",
                        "#a1aab2",
                        "#a1aab2",
                        "#a1aab2",
                        "#a1aab2",
                        "#a1aab2",
                        "#a1aab2",
                        "#a1aab2",
                        "#a1aab2",
                        "#a1aab2",
                        "#a1aab2",
                        "#a1aab2",
                        "#a1aab2",
                    ],
                },
            },
        },
        tooltip: {
            shared: false,
            y: {
                formatter: function (val) {
                    return val + "";
                },
            },
            theme: "dark",
        },
    };
    var chart_line_msg_enviadas = new ApexCharts(
        document.querySelector("#chart-adm-msg-enviadas"),
        options_msg_enviadas
    );
    chart_line_msg_enviadas.render();

    function setDataMsgEnviadas() {
        let novosDados = [];

        let dt_ini = document.getElementById('input-msg-enviada-periodo-ini').value
        let dt_fin = document.getElementById('input-msg-enviada-periodo-fin').value

        console.log(dt_ini, dt_fin);
        axios.get(`/charts/adm/msg-enviadas?dt_ini=${dt_ini}&dt_fin=${dt_fin}`)
            .then(res => {
                novosDados = [{
                    name: 'Enviadas',
                    data: res.data
                }];
                chart_line_msg_enviadas.updateSeries(novosDados);
                document.getElementById('modal-filtro-grafico-clientes').style.display = 'none';
            })
            .catch(err => {
                console.log(err);
                document.getElementById('modal-filtro-grafico-clientes').style.display = 'none';
            })
    }

    setDataMsgEnviadas()
    $('#btn-aplicar-filtro-msg-enviada').click(setDataMsgEnviadas);
    // $('#input-msg-enviada-periodo-fin').change(setDataMsgEnviadas);

    // <---- Mensagens Enviadas

    // ----> Modulos - Remarketing
    let jsonRemarketing = document.getElementById('chart-pie-modulo-remarketing').dataset.dados
    let objRemarketing = JSON.parse(jsonRemarketing)

    var options_modulo_remarketing = {
        color: "#adb5bd",
        labels: objRemarketing.labels,
        series: objRemarketing.data,
        chart: {
            type: "donut",
            fontFamily: "Plus Jakarta Sans', sans-serif",
            foreColor: "#adb0bb",
        },
        plotOptions: {
            pie: {
                donut: {
                    size: '88%',
                    background: 'transparent',
                    labels: {
                        show: true,
                        name: {
                            show: true,
                            offsetY: 7,
                        },
                        value: {
                            show: true,
                            // label: '$500,458',
                        },
                        total: {
                            show: true,
                            color: '#7C8FAC',
                            fontSize: '20px',
                            fontWeight: "600",
                            label: 'Usuários',
                        },
                    },
                },
            },
        },
        stroke: {
            show: false,
        },
        dataLabels: {
            enabled: false,
        },

        legend: {
            show: false,
            position: "bottom",
        },
        colors: ["var(--bs-primary)", "var(--bs-secondary)", "var(--bs-orange)", '#feb019', '#ff455f', '#775dd0', '#80effe',
            '#0077B5', '#ff6384', '#c9cbcf', '#0057ff', '00a9f4', '#2ccdc9', '#5e72e4'],

        tooltip: {
            theme: "dark",
            fillSeriesColor: false,
        },
    };

    var chart_pie_modulo_remarketing = new ApexCharts(document.querySelector("#chart-pie-modulo-remarketing"), options_modulo_remarketing);
    chart_pie_modulo_remarketing.render();
    // <---- Modulos - Remarketing




    // ----> Modulos - Faturamento
    let jsonFaturamento = document.getElementById('chart-pie-modulo-faturamento').dataset.dados
    let objFaturamento = JSON.parse(jsonFaturamento)
    
    var options_modulo_faturamento = {
        color: "#adb5bd",
        labels: objFaturamento.labels,
        series: objFaturamento.data,
        chart: {
            type: "donut",
            fontFamily: "Plus Jakarta Sans', sans-serif",
            foreColor: "#adb0bb",
        },
        plotOptions: {
            pie: {
                donut: {
                    size: '88%',
                    background: 'transparent',
                    labels: {
                        show: true,
                        name: {
                            show: true,
                            offsetY: 7,
                        },
                        value: {
                            show: true,
                            // label: '$500,458',
                        },
                        total: {
                            show: true,
                            color: '#7C8FAC',
                            fontSize: '20px',
                            fontWeight: "600",
                            label: 'Usuários',
                        },
                    },
                },
            },
        },
        stroke: {
            show: false,
        },
        dataLabels: {
            enabled: false,
        },

        legend: {
            show: false,
            position: "bottom",
        },
        colors: ["var(--bs-primary)", "var(--bs-secondary)", "var(--bs-orange)", '#feb019', '#ff455f', '#775dd0', '#80effe',
            '#0077B5', '#ff6384', '#c9cbcf', '#0057ff', '00a9f4', '#2ccdc9', '#5e72e4'],

        tooltip: {
            theme: "dark",
            fillSeriesColor: false,
        },
    };

    var chart_pie_modulo_faturamento = new ApexCharts(document.querySelector("#chart-pie-modulo-faturamento"), options_modulo_faturamento);
    chart_pie_modulo_faturamento.render();
    // <---- Modulos - Faturamento

    // ----> Modulos - Cobranças
    let jsonCobrancas = document.getElementById('chart-pie-modulo-cobrancas').dataset.dados
    let objCobrancas = JSON.parse(jsonCobrancas)

    var options_modulo_cobrancas = {
        color: "#adb5bd",
        labels: objCobrancas.labels,
        series: objCobrancas.data,
        chart: {
            type: "donut",
            fontFamily: "Plus Jakarta Sans', sans-serif",
            foreColor: "#adb0bb",
        },
        plotOptions: {
            pie: {
                donut: {
                    size: '88%',
                    background: 'transparent',
                    labels: {
                        show: true,
                        name: {
                            show: true,
                            offsetY: 7,
                        },
                        value: {
                            show: true,
                            // label: '$500,458',
                        },
                        total: {
                            show: true,
                            color: '#7C8FAC',
                            fontSize: '20px',
                            fontWeight: "600",
                            label: 'Usuários',
                        },
                    },
                },
            },
        },
        stroke: {
            show: false,
        },
        dataLabels: {
            enabled: false,
        },

        legend: {
            show: false,
            position: "bottom",
        },
        colors: ["var(--bs-primary)", "var(--bs-secondary)", "var(--bs-orange)", '#feb019', '#ff455f', '#775dd0', '#80effe',
            '#0077B5', '#ff6384', '#c9cbcf', '#0057ff', '00a9f4', '#2ccdc9', '#5e72e4'],

        tooltip: {
            theme: "dark",
            fillSeriesColor: false,
        },
    };
    var chart_pie_modulo_cobrancas = new ApexCharts(document.querySelector("#chart-pie-modulo-cobrancas"), options_modulo_cobrancas);
    chart_pie_modulo_cobrancas.render();
    // <---- Modulos - Cobranças

    // ----> Modulos - Rastreamento
    let jsonRastreamento = document.getElementById('chart-pie-modulo-rastreamento').dataset.dados
    let objRastreamento = JSON.parse(jsonRastreamento)
    
    var options_modulo_rastreamento = {
        color: "#adb5bd",
        labels: objRastreamento.labels,
        series: objRastreamento.data,
        chart: {
            type: "donut",
            fontFamily: "Plus Jakarta Sans', sans-serif",
            foreColor: "#adb0bb",
        },
        plotOptions: {
            pie: {
                donut: {
                    size: '88%',
                    background: 'transparent',
                    labels: {
                        show: true,
                        name: {
                            show: true,
                            offsetY: 7,
                        },
                        value: {
                            show: true,
                            // label: '$500,458',
                        },
                        total: {
                            show: true,
                            color: '#7C8FAC',
                            fontSize: '20px',
                            fontWeight: "600",
                            label: 'Usuários',
                        },
                    },
                },
            },
        },
        stroke: {
            show: false,
        },
        dataLabels: {
            enabled: false,
        },

        legend: {
            show: false,
            position: "bottom",
        },
        colors: ["var(--bs-primary)", "var(--bs-secondary)", "var(--bs-orange)", '#feb019', '#ff455f', '#775dd0', '#80effe',
            '#0077B5', '#ff6384', '#c9cbcf', '#0057ff', '00a9f4', '#2ccdc9', '#5e72e4'],

        tooltip: {
            theme: "dark",
            fillSeriesColor: false,
        },
    };

    var chart_pie_modulo_rastreamento = new ApexCharts(document.querySelector("#chart-pie-modulo-rastreamento"), options_modulo_rastreamento);
    chart_pie_modulo_rastreamento.render();
    // <---- Modulos - Rastreamento

    // ----> Upgrade e Downgrad Planos
    var options_up_dow_planos = {
        chart: {
            fontFamily: '"Nunito Sans", sans-serif',
            type: "bar",
            height: 400,
            stacked: true,
            toolbar: {
                show: false,
            },
        },
        grid: {
            borderColor: "transparent",
        },
        colors: ["var(--bs-primary)", "#FF4560"],
        plotOptions: {
            bar: {
                horizontal: true,
            },
        },
        stroke: {
            width: 0,
            colors: ["#fff"],
        },
        series: [
            {
                name: "Upgrade",
                data: [],
            },
            {
                name: "Downgrade",
                data: [],
            },
        ],
        xaxis: {
            categories: [],
            labels: {
                formatter: function (val) {
                    return val + "";
                },
                style: {
                    colors: '#a1aab2'
                },
            },
        },
        yaxis: {
            title: {
                text: undefined,
            },
            labels: {
                style: {
                    colors: '#a1aab2',
                    fontSize: 12
                },
            },
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return val + "";
                },
            },
            theme: "dark",
        },
        fill: {
            opacity: 1,
        },
        legend: {
            position: "top",
            horizontalAlign: "left",
            offsetX: 40,
            labels: {
                // colors: ["#a1aab2"],
            },
        },
    };

    var chart_bar_up_dow_planos = new ApexCharts(
        document.querySelector("#chart-bar-up-dow-planos"),
        options_up_dow_planos
    );
    chart_bar_up_dow_planos.render();

    function setDataUpDowPlanos() {

        let updateSeries = [];
        let updateOptionsCategories = [];

        let dt_ini = document.getElementById('input-up-dow-planos-periodo-ini').value
        let dt_fin = document.getElementById('input-up-dow-planos-periodo-fin').value

        console.log(dt_ini, dt_fin);
        axios.get(`/charts/adm/up-dow-plans?dt_ini=${dt_ini}&dt_fin=${dt_fin}`)
            .then(res => {
                updateSeries = res.data.series
                updateOptionsCategories = res.data.categories

                chart_bar_up_dow_planos.updateOptions({ xaxis: { categories: updateOptionsCategories } });
                chart_bar_up_dow_planos.updateSeries(updateSeries);

                document.getElementById('modal-filtro-grafico-up-dow').style.display = 'none';
            })
            .catch(err => {
                document.getElementById('modal-filtro-grafico-up-dow').style.display = 'none';
                console.log(err);
            })
    }

    setDataUpDowPlanos()
    $('#btn-aplicar-filtro-up-dow').click(setDataUpDowPlanos);

    // <---- Upgrade e Downgrad Planos


    // ----> Novos Cliente
    var options_novos_clientes = {

        chart: {
            locales: locales,
            defaultLocale: 'pt-BR',
            fontFamily: '"Nunito Sans",sans-serif',
            height: 270,
            type: "line",
            toolbar: {
                show: false,
            },
        },
        stroke: {
            width: 7,
            curve: "smooth",
        },
        series: [{
            name: "Clientes",
            data: [],
        },],
        xaxis: {
            type: "datetime",
            categories: [],

            labels: {
                style: {
                    colors: [
                        "#a1aab2",
                        "#a1aab2",
                        "#a1aab2",
                        "#a1aab2",
                        "#a1aab2",
                        "#a1aab2",
                        "#a1aab2",
                        "#a1aab2",
                        "#a1aab2",
                        "#a1aab2",
                        "#a1aab2",
                        "#a1aab2",
                        "#a1aab2",
                        "#a1aab2",
                        "#a1aab2",
                    ],
                },
            },
        },
        grid: {
            borderColor: "transparent",
        },
        colors: ["#39b69a"],
        fill: {
            type: "gradient",
            gradient: {
                shade: "dark",
                gradientToColors: ["var(--bs-primary)"],
                shadeIntensity: 1,
                type: "horizontal",
                opacityFrom: 1,
                opacityTo: 1,
                stops: [0, 100, 100, 100],
            },
        },
        markers: {
            size: 4,
            colors: ["var(--bs-primary)"],
            strokeColors: "#fff",
            strokeWidth: 2,
            hover: {
                size: 7,
            },
        },
        yaxis: {
            labels: {
                style: {
                    colors: [
                        "#a1aab2",
                        "#a1aab2",
                        "#a1aab2",
                        "#a1aab2",
                        "#a1aab2",
                        "#a1aab2",
                        "#a1aab2",
                        "#a1aab2",
                        "#a1aab2",
                        "#a1aab2",
                        "#a1aab2",
                        "#a1aab2",
                        "#a1aab2",
                        "#a1aab2",
                        "#a1aab2",
                    ],
                },
            },
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return val + "";
                },
            },
            theme: "dark",
        },

    };

    var chart_line_novos_clientes = new ApexCharts(
        document.querySelector("#chart-line-novo-clientes"),
        options_novos_clientes
    );
    chart_line_novos_clientes.render();

    function setDataNovosClientes() {
        let dt_ini = document.getElementById('input-novos-clientes-periodo-ini').value
        let dt_fin = document.getElementById('input-novos-clientes-periodo-fin').value

        axios.get(`/charts/adm/novos-clientes?dt_ini=${dt_ini}&dt_fin=${dt_fin}`)
            .then(res => {

                let updateSeries = res.data.series
                let updateOptionsCategories = res.data.categories

                chart_line_novos_clientes.updateOptions({ xaxis: { categories: updateOptionsCategories } });
                chart_line_novos_clientes.updateSeries(updateSeries);

                document.getElementById('modal-filtro-grafico-novos-clientes').style.display = 'none';
            })
            .catch(err => {
                document.getElementById('modal-filtro-grafico-novos-clientes').style.display = 'none';
                console.log(err);
            })
    }

    setDataNovosClientes()
    $('#btn-aplicar-filtro-novos-clientes').click(setDataNovosClientes);
    // <---- Novos Cliente


    /* Acultar Modal Filtro */
    // $('.modal-filtro-grafico').click(function (event) {
    //     event.target.style.display = 'none'
    // })
    // $('.modal-filtro-grafico div').click(function (event) {
    //     event.stopPropagation();
    // })



});

