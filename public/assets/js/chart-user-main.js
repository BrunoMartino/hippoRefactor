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

    function formatNumber(num) {
        if (num < 1000) return num.toString();

        const units = ["k", "M", "B", "T"];
        const order = Math.floor(Math.log10(num) / 3);
        const unitName = units[order - 1];
        const numDivided = num / Math.pow(1000, order);

        return numDivided.toFixed(1) + unitName;
    }

    // ===========================
    // Visualização de msgs
    // ===========================
    var chart_visu_msgs_options = {
        color: "#adb5bd",
        series: [],
        labels: [],
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
                            offsetY: -2,
                        },
                        value: {
                            offsetY: 5,
                            show: true,
                            formatter: function (value) {
                                // return parseFloat(value).toLocaleString();
                                return formatNumber(parseFloat(value))
                            }
                        },
                        total: {
                            formatter: function (w) {
                                let val = w.globals.seriesTotals.reduce((a, b) => { return a + b }, 0)
                                return formatNumber(val)
                            },
                            show: true,
                            color: '#7C8FAC',
                            fontSize: '20px',
                            fontWeight: "600",
                            label: 'Mensagens',
                        },
                    },
                },
            },
        },
        yaxis: {
            labels: {
                formatter: function (value) {
                    return value.toLocaleString();
                }
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
        colors: ["var(--bs-primary)", "var(--bs-orange)", "#37bb37"],

        tooltip: {
            theme: "dark",
            fillSeriesColor: false,
        },
    };

    var chart_visual_msgs = new ApexCharts(document.querySelector("#chart-visual-msgs"), chart_visu_msgs_options);
    chart_visual_msgs.render();

    function setDataVisuMsgs() {
        let dt_ini = ''
        let dt_fin = ''
        if (document.getElementById('input-data-visu-msg-ini').value != '') {
            dt_ini = document.getElementById('input-data-visu-msg-ini').value;
        }
        if (document.getElementById('input-data-visu-msg-fin').value != '') {
            dt_fin = document.getElementById('input-data-visu-msg-fin').value;
        }

        axios.get(`/charts/usuario/msgs-visua?dt_ini=${dt_ini}&dt_fin=${dt_fin}`)
            .then(res => {
                chart_visual_msgs.updateSeries(res.data.series);
                chart_visual_msgs.updateOptions({ labels: res.data.labels });

                if (res.data.percentual.visualizadas >= res.data.percentual.nao_vistas) {
                    document.getElementById('text-percet-visu-msgs').innerHTML = `${res.data.percentual.visualizadas}% Visto`
                } else {
                    document.getElementById('text-percet-visu-msgs').innerHTML = `${res.data.percentual.nao_vistas}% Não Visto`
                }

                document.getElementById('drop-filtro-vizu-msg').style.display = 'none'
            })
            .catch(err => {
                console.log(err);
            })
    }
    setDataVisuMsgs()
    $('#btn-filtro-visu-msg').click(function () {
        setDataVisuMsgs()
    })

    // ===========================
    // Entrega de msgs
    // ===========================
    var chart_entega_msgs_options = {
        color: "#adb5bd",
        series: [],
        labels: [],
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
                            offsetY: -2,
                        },
                        value: {
                            offsetY: 5,
                            show: true,
                            formatter: function (value) {
                                // return parseFloat(value).toLocaleString();
                                return formatNumber(parseFloat(value))
                            }
                        },
                        total: {
                            formatter: function (w) {
                                let val = w.globals.seriesTotals.reduce((a, b) => { return a + b }, 0)
                                return formatNumber(val)
                            },
                            show: true,
                            color: '#7C8FAC',
                            fontSize: '20px',
                            fontWeight: "600",
                            label: 'Mensagens',
                        },
                    },
                },
            },
        },
        yaxis: {
            labels: {
                formatter: function (value) {
                    return value.toLocaleString();
                }
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
        colors: ["var(--bs-primary)", "var(--bs-orange)", "#37bb37"],

        tooltip: {
            theme: "dark",
            fillSeriesColor: false,
        },
    };

    var chart_entrega_msgs = new ApexCharts(document.querySelector("#chart-entrega-msgs"), chart_entega_msgs_options);
    chart_entrega_msgs.render();

    function setDataEntregaMsgs() {

        let dt_ini = ''
        let dt_fin = ''
        if (document.getElementById('input-entrega-msg-ini').value != '') {
            dt_ini = document.getElementById('input-entrega-msg-ini').value;
        }
        if (document.getElementById('input-entrega-msg-fin').value != '') {
            dt_fin = document.getElementById('input-entrega-msg-fin').value;
        }

        axios.get(`/charts/usuario/msgs-entreg?dt_ini=${dt_ini}&dt_fin=${dt_fin}`)
            .then(res => {
                chart_entrega_msgs.updateSeries(res.data.series);
                chart_entrega_msgs.updateOptions({ labels: res.data.labels });
                if (res.data.percentual.entregue >= res.data.percentual.nao_entregue) {
                    document.getElementById('text-percet-entreg-msgs').innerHTML = `${res.data.percentual.entregue}% Entregue`
                } else {
                    document.getElementById('text-percet-entreg-msgs').innerHTML = `${res.data.percentual.nao_entregue}% Não entregue`
                }
                document.getElementById('drop-filtro-entrega-msg').style.display = 'none'

            })
            .catch(err => {
                console.log(err);
            })
    }
    setDataEntregaMsgs()
    $('#btn-filtro-entrega-msg').click(function () {
        setDataEntregaMsgs()
    })

    // ===========================
    // Entrega de msgs anual
    // ===========================
    var chart_comp_anual_options = {
        series: [],
        chart: {
            type: 'bar',
            height: 290,
            toolbar: {
                show: false,
            },
        },
        plotOptions: {
            bar: {
                horizontal: false,
                endingShape: "around",
                borderRadiusApplication: 'end',
                borderRadius: 10,

            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        xaxis: {
            categories: [],
            labels: {
                style: {
                    // fontSize: 13
                }
            }
        },
        yaxis: {
            title: {
                text: '$ (thousands)'
            },
            show: false,
        },
        grid: {
            show: false,
        },
        fill: {
            opacity: 1
        },
        colors: ["var(--bs-orange)", "var(--bs-primary)", "#37bb37"],
        tooltip: {
            y: {
                formatter: function (val) {
                    return val.toLocaleString();
                    // return " " + val + " "

                }
            },
            x: {
                formatter: function (val) {
                    return val.split('/')[0]
                }
            }
        },
        legend: {
            show: true,
            markers: {
                width: 14,
                height: 14,
                radius: 4,
                // offsetX: 0,
                // offsetY: 0
            },
            position: 'top',
            fontSize: '14px',
            itemMargin: {
                horizontal: 15,
                vertical: 0
            },
        },
    };

    var chart_comp_anual = new ApexCharts(document.querySelector("#chart-comparativo-anual"), chart_comp_anual_options);
    chart_comp_anual.render();

    function setDataCompAnual() {

        let anos = [];
        for (let i in document.querySelectorAll('.change-periodo')) {
            if (document.querySelectorAll('.change-periodo')[i].checked) {
                anos.push(document.querySelectorAll('.change-periodo')[i].value)
            }
        }

        let tipo = 'entregue'
        if (document.querySelector('.change-tipo-comp-anual:checked')) {
            tipo = document.querySelector('.change-tipo-comp-anual:checked').value
        } else {
             tipo = 'todos'
        }


        // console.log(`/charts/usuario/entrega-msg-anual?anos=[${anos}]&tipo=${tipo}`);

        axios.get(`/charts/usuario/entrega-msg-anual?anos=[${anos}]&tipo=${tipo}`)
            .then(res => {
                chart_comp_anual.updateSeries(res.data.series);
                chart_comp_anual.updateOptions({ xaxis: { categories: res.data.labels, }, });

                document.getElementById('drop-filtro-comp-anual').style.display = 'none'
            })
            .catch(err => {
                console.log(err);
            })
    }
    setDataCompAnual()
    $('#btn-filtro-comp-anual').click(function () {
        setDataCompAnual()
    })
    $('.change-periodo').change(function (item) {
        let count = 0;
        for (let i in document.querySelectorAll('.change-periodo')) {
            if (document.querySelectorAll('.change-periodo')[i].checked)
                count++;
        }

        if (count >= 3) {
            item.target.checked = false
        }
    })
    $('.change-tipo-comp-anual').change(function (item) {
        let st = item.target.checked
        $('.change-tipo-comp-anual').checked = false

        for (let i in document.querySelectorAll('.change-tipo-comp-anual')) {
            document.querySelectorAll('.change-tipo-comp-anual')[i].checked = false
        }

        item.target.checked = st
    })



    // ===========================
    // Satisfação de clientes
    // ===========================
    var chart_satis_clientes_options = {
        series: [],
        chart: {
            fontFamily: '"Nunito Sans", sans-serif',
            type: "bar",
            height: 130,
            stacked: true,
            stackType: '100%',
            toolbar: {
                show: false,
            },
        },
        dataLabels: {
            enabled: false
        },
        grid: {
            borderColor: "transparent",
            show: false,
            padding: {
                left: 0,
                right: 0
            }
        },
        colors: ["#e64107", "#ff6b01", "#f1f1f1", "var(--bs-primary)", "#203b59"],
        plotOptions: {
            bar: {
                horizontal: true,
                borderRadius: 10,
                borderRadiusApplication: 'end',
            },
        },
        stroke: {
            width: 0,
            colors: ["#fff"],
        },
        xaxis: {
            categories: ['Satisfação'],
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false
            },
            labels: {
                show: false,
                formatter: function (val) {
                    return val + "K";
                },
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
                    ],
                },
            },
        },
        yaxis: {
            show: false,
            title: {
                text: undefined,
            },
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
        fill: {
            opacity: 1,
        },
        legend: {
            fontSize: '14px',
            position: "bottom",
            horizontalAlign: "left",
            offsetX: 0,
            labels: {
                colors: ["#a1aab2", '#a1aab2', '#a1aab2', '#a1aab2', '#a1aab2', '#a1aab2', '#a1aab2'],
            },
            markers: {
                width: 13,
                height: 13,
                radius: 3,
                // offsetX: 0,
                // offsetY: 0
            },
            itemMargin: {
                horizontal: 20,
                vertical: 0
            },
        },
    };

    var chart_satis_clientes = new ApexCharts(document.querySelector("#chart-satis-clientes"), chart_satis_clientes_options);
    chart_satis_clientes.render();

    function setDataSatisClientes() {

        let select = document.getElementById("satisfacao-cliente-select");
        let valorSelecionado = select.value;

        let query = '?p='+valorSelecionado;


        // pergunta1
        // if (document.getElementById('pergunta-satis-cliente-1'))
        //     if (document.getElementById('pergunta-satis-cliente-1').checked)
        //         query = '?p=pergunta1'
        // pergunta2
        // if (document.getElementById('pergunta-satis-cliente-2'))
        //     if (document.getElementById('pergunta-satis-cliente-2').checked)
        //         query = '?p=pergunta2'
        // pergunta3
        // if (document.getElementById('pergunta-satis-cliente-3'))
        //     if (document.getElementById('pergunta-satis-cliente-3').checked)
        //         query = '?p=pergunta3'
        // pergunta3
        // if (document.getElementById('pergunta-satis-cliente-4'))
        //     if (document.getElementById('pergunta-satis-cliente-4').checked)
        //         query = '?p=pergunta4'



        // if (document.getElementById('pergunta-satis-cliente-2')) {
        //     if (document.getElementById('pergunta-satis-cliente-2').checked)
        //         query = '?p=pergunta2'
        // }


        let dt_ini = ''
        let dt_fin = ''
        if (document.getElementById('input-satis-cliente-ini'))
            dt_ini = document.getElementById('input-satis-cliente-ini').value
        if (document.getElementById('input-satis-cliente-fin'))
            dt_fin = document.getElementById('input-satis-cliente-fin').value

        query += `&dt_ini=${dt_ini}&dt_fin=${dt_fin}`

        console.log(`/charts/usuario/satis-clients${query}`);



        axios.get(`/charts/usuario/satis-clients${query}`)
            .then(res => {
                chart_satis_clientes.updateSeries(res.data.series);
                chart_satis_clientes.updateOptions(res.data.colors);
                document.getElementById('drop-filtro-satis-clientes').style.display = 'none'


                // pergunta inicila
                document.getElementById('text-pergunt-ps').innerHTML = 'Pergunta inicial'
                // pergunta1
                if (valorSelecionado == 'pergunta1')
                    document.getElementById('text-pergunt-ps').innerHTML = 'Pergunta 1'
                // pergunta2
                if (valorSelecionado == 'pergunta2')
                    document.getElementById('text-pergunt-ps').innerHTML = 'Pergunta 2'
                // pergunta3
                if (valorSelecionado == 'pergunta3')
                    document.getElementById('text-pergunt-ps').innerHTML = 'Pergunta 3'
                // pergunta3
                if (valorSelecionado == 'pergunta4')
                    document.getElementById('text-pergunt-ps').innerHTML = 'Pergunta 4'

            })
            .catch(err => {
                console.log(err);
            })
    }
    setDataSatisClientes()
    $('#btn-filtro-satis-cliente').click(function () {
        setDataSatisClientes()
    })


    // ===========================
    // Satisfação de clientes
    // ===========================
    // document.getElementById('satisfacao-cliente-select').change=function() {
    //     let select = document.getElementById("satisfacao-cliente-select");
    //     let valorSelecionado = select.value;
    //     alert("Valor selecionado: " + valorSelecionado);
    // }
   

    // ===========================
    // Satisfação média
    // ===========================
    var chart_satis_media_options = {
        series: [0],
        chart: {
            fontFamily: '"Nunito Sans", sans-serif',
            type: "radialBar",
            offsetY: 0,
            // offsetX: -80,
            // width: 300,
            height: 200,
            sparkline: {
                enabled: true,
            },
        },
        plotOptions: {
            radialBar: {
                startAngle: -90,
                endAngle: 90,
                hollow: {
                    margin: 5,
                    size: '73%',
                    background: 'transparent',
                    // image: undefined,

                    image: '/assets/images/pngs/star.png',
                    imageWidth: 30,
                    imageHeight: 30,
                    imageClipped: false,
                    imageOffsetY: -30
                },
                dataLabels: {
                    name: {
                        show: false,
                    },
                    value: {
                        offsetY: 5,
                        fontSize: "14px",
                        fontWeight: '800',
                        // color: "#a1aab2",
                        color: "black",
                        formatter: function (val) {
                            // return val;
                            return '0,0';
                        },
                    },
                },
            },
        },
        grid: {
            padding: {
                top: 0,
            },
        },
        colors: ['var(--bs-primary)'],
        labels: ["Average Results"],
    }

    var chart_satis_media = new ApexCharts(document.querySelector("#chart-satis-media"), chart_satis_media_options);
    chart_satis_media.render();

    function setDataSatisMedia() {

        let select = document.getElementById("pergunta-satis-media-cliente-select");
        let valorSelecionado = select.value;
        
        let query = '?p='+valorSelecionado;
       
        let dt_ini = ''
        if (document.getElementById('input-satis-media-ini'))
            dt_ini = document.getElementById('input-satis-media-ini').value

        let dt_fin = ''
        if (document.getElementById('input-satis-media-fin'))
            dt_fin = document.getElementById('input-satis-media-fin').value


        query += `&dt_ini=${dt_ini}&dt_fin=${dt_fin}`

        axios.get(`/charts/usuario/satis-media${query}`)
            .then(res => {

                chart_satis_media.updateSeries([res.data.percent]);
                chart_satis_media.updateOptions({
                    plotOptions: {
                        radialBar: {
                            dataLabels: {
                                value: {
                                    formatter: function (val) {
                                        // return val;
                                        return res.data.series;
                                    },
                                },
                            },
                        },
                    },
                });
                document.getElementById('drop-filtro-satis-media').style.display = 'none'

                // chart_satis_media.updateSeries(series);
                // chart_satis_media.updateOptions({ labels: ['Entregeu', 'Não entregue'] });
            })
            .catch(err => {
                console.log(err);
            })
    }
    setDataSatisMedia()
    $('#btn-filtro-satis-media-cliente').click(function () {
        setDataSatisMedia()
    })

    // ===========================
    // Faixa etária
    // ===========================
    var chart_faixa_etaria_options = {
        series: [],
        chart: {
            type: 'bar',
            height: 230,
            toolbar: {
                show: false,
            },
        },
        plotOptions: {
            bar: {
                horizontal: true,
                barHeight: '93%',
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        xaxis: {
            categories: [],

            labels: {
                rotation: 0,
                style: {
                    fontSize: '10px',
                    // paddingTop: '10px',
                    textOverflow: 'allow'
                },
            }
        },
        yaxis: {
            title: {
                text: '',
            },
            show: true,
        },
        grid: {
            show: false,
        },
        fill: {
            opacity: 1
        },
        colors: ["var(--bs-primary)", "var(--bs-orange)", "#37bb37"],
        tooltip: {
            y: {
                formatter: function (val) {
                    return val.toLocaleString();
                }
            }
        },
        legend: {
            show: false,
        },
    };

    var chart_faixa_etaria = new ApexCharts(document.querySelector("#chart-faixa-etaria"), chart_faixa_etaria_options);
    chart_faixa_etaria.render();

    function setDataFaixaEtarea() {

        let dt_ini = ''
        let dt_fin = ''
        if (document.getElementById('input-faixs-etaria-ini').value != '') {
            dt_ini = document.getElementById('input-faixs-etaria-ini').value;
        }
        if (document.getElementById('input-faixs-etaria-fin').value != '') {
            dt_fin = document.getElementById('input-faixs-etaria-fin').value;
        }

        axios.get(`/charts/usuario/msgs-faixa-etaria?dt_ini=${dt_ini}&dt_fin=${dt_fin}`)
            .then(res => {
                console.log(res.data);
                chart_faixa_etaria.updateOptions({ xaxis: { categories: res.data.labels, } });
                chart_faixa_etaria.updateSeries(res.data.series);
                document.getElementById('meida-faixa-etarea').innerHTML = res.data.media
                document.getElementById('drop-filtro-faixa-etaria').style.display = 'none'
            })
            .catch(err => {
                console.log(err);
            })
    }
    setDataFaixaEtarea()
    $('#btn-filtro-faixa-etaria').click(function () {
        setDataFaixaEtarea()
    })

    // ===========================
    // Gênero
    // ===========================
    var chart_genero_options = {
        color: "#adb5bd",
        series: [],
        labels: [],
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
                            offsetY: -2,
                        },
                        value: {
                            offsetY: 2,
                            show: true,
                            formatter: function (value) {
                                return formatNumber(parseFloat(value))
                            },
                            fontSize: '18px',
                        },
                        total: {
                            formatter: function (w) {
                                let val = w.globals.seriesTotals.reduce((a, b) => { return a + b }, 0)
                                return formatNumber(val)
                            },
                            show: true,
                            color: '#7C8FAC',
                            fontSize: '18px',
                            fontWeight: "600",
                            label: 'Envios',
                        },
                    },
                },
            },
        },
        yaxis: {
            labels: {
                formatter: function (value) {
                    return value.toLocaleString();
                }
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
        colors: ["var(--bs-primary)", "var(--bs-orange)", "#37bb37"],

        tooltip: {
            theme: "dark",
            fillSeriesColor: false,
        },
    };

    var chart_genero = new ApexCharts(document.querySelector("#chart-genero"), chart_genero_options);
    chart_genero.render();

    function setDataGenero() {
        axios.get(`/charts/usuario/msgs-genero`)
            .then(res => {
                chart_genero.updateSeries(res.data.series);
                chart_genero.updateOptions({ labels: res.data.labels });

                if (res.data.percentual.m >= res.data.percentual.f) {
                    document.getElementById('text-percet-genero').innerHTML = `${res.data.percentual.m}% Masculino`
                } else {
                    document.getElementById('text-percet-genero').innerHTML = `${res.data.percentual.f}% Feminino`
                }

                // let series = [2034, 3023];
                // chart_genero.updateSeries(series);
                // chart_genero.updateOptions({ labels: ['Masculino', 'Feminino'] });
            })
            .catch(err => {
                console.log(err);
            })
    }
    setDataGenero()


    // ===========================
    // Entrega de msgs
    // ===========================
    function setDataEnvioNotificacoes() {


        let dt_ini = ''
        let dt_fin = ''
        if (document.getElementById('input-envio-notific-ini').value != '') {
            dt_ini = document.getElementById('input-envio-notific-ini').value;
        }
        if (document.getElementById('input-envio-notific-fin').value != '') {
            dt_fin = document.getElementById('input-envio-notific-fin').value;
        }

        axios.get(`/charts/usuario/envio-notific?dt_ini=${dt_ini}&dt_fin=${dt_fin}`)
            .then(res => {

                document.getElementById('envio-notificacoes-total').innerHTML = res.data.total
                document.getElementById('envio-notificacoes-total-hoje').innerHTML = res.data.total_hoje
                document.getElementById('envio-notificacoes-text').innerHTML = res.data.text_periodo

                document.getElementById('drop-filtro-notific').style.display = 'none'

            })
            .catch(err => {
                console.log(err);
            })
    }
    setDataEnvioNotificacoes()
    $('#btn-filtro-envio-notific').click(function () {
        setDataEnvioNotificacoes()
    })

});