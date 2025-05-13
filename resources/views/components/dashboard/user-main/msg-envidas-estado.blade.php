<div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-chart-geo@4.3.1/build/index.umd.min.js"></script>

    <div class="overflow-hidden" style="height: 620px; width: 795px">
        <canvas id="canvas" height="620px" width="795px"></canvas>
    </div>

    <script>
        var dadosMeses = JSON.parse(`@json($dataEstados)`)

        // console.log(dadosMesesx.meses);

        // console.log(dadosMeses.meses);
        // console.log(dadosMeses.meses[0].dados[0].valor);


        // Função para obter os dados do mês especificado
        function getDadosMes(mes) {
            return dadosMeses.meses.find(m => m.mes === mes).dados;
        }

        var chartMap;

        function renderMap() {
            fetch(
                    'https://raw.githubusercontent.com/codeforamerica/click_that_hood/master/public/data/brazil-states.geojson'
                )
                .then(response => response.json())
                .then(brazil => {
                    chartMap = new Chart(document.getElementById("canvas").getContext("2d"), {
                        type: 'choropleth',
                        data: {
                            labels: brazil.features.map((d) => d.properties.name),
                            datasets: [{
                                label: 'Estados do Brasil',
                                outline: null,
                                data: getDadosMes('Janeiro').map((d) => ({
                                    feature: brazil.features.find(state => state.properties
                                        .name === d.estado),
                                    value: d.valor
                                })),
                            }]
                        },
                        options: {
                            plugins: {
                                legend: {
                                    display: false
                                },
                            },
                            scales: {
                                projection: {
                                    axis: 'xy',
                                    projection: 'geoMercator',
                                    projectionScale: 8.2, // Ajuste a escala para aumentar o mapa
                                    projectionOffset: [760, -220]
                                },
                                color: {
                                    display: false,
                                    axis: 'x',
                                    quantize: 5,
                                    legend: {
                                        position: 'bottom-right',
                                        align: 'bottom'
                                    },
                                },

                            },
                            layout: {
                                padding: {
                                    top: 0,
                                    right: 0,
                                    bottom: 0,
                                    left: 0
                                }
                            },
                            responsive: true,
                            maintainAspectRatio: false // Permite que o gráfico ocupe o espaço disponível

                        }
                    });
                });
        }
        renderMap()

        function atualizarGraficoMapa() {


            let dt_ini = ''
            let dt_fin = ''
            if (document.getElementById('input-por-estado-ini').value != '') {
                dt_ini = document.getElementById('input-por-estado-ini').value;
            }
            if (document.getElementById('input-por-estado-fin').value != '') {
                dt_fin = document.getElementById('input-por-estado-fin').value;
            }

            console.log(`/charts/usuario/msg-enviadas-estados?dt_ini=${dt_ini}&dt_fin=${dt_fin}`);

            axios.get(`/charts/usuario/msg-enviadas-estados?dt_ini=${dt_ini}&dt_fin=${dt_fin}`)
                .then(res => {
                    dadosMeses = res.data

                    chartMap.destroy();
                    renderMap()

                    document.getElementById('drop-filtro-estado').style.display = 'none';
                    // console.log(res.data);
                })

            // console.log(chartMap.data.datasets[0].data);
            // dadosMeses.meses[0].dados[0].valor = 1



        }
    </script>
</div>
