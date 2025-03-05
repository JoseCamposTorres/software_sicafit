$(document).ready(function () {
    $("#selectMes").val(new Date().toISOString().slice(0, 7)); // Establece el mes actual por defecto
    cargarGrafica(); // Cargar la gráfica al inicio

    $("#selectMes").change(function () { 
        cargarGrafica(); // Cargar la gráfica cuando cambie el mes
    });
});

let chart = null; // Variable global para almacenar la gráfica

function cargarGrafica() {
    let fechaSeleccionada = $("#selectMes").val(); // Obtiene el valor en formato "YYYY-MM"
    let [year, month] = fechaSeleccionada.split("-"); // Divide en año y mes

    $.post("../../controller/graficaController.php?op=grafica", { mes: month, anio: year }, function (data) {
        data = JSON.parse(data);

        let fiscales = [];
        let casos = [];
        let imagenes = [];

        for (let i = 0; i < data.length; i++) {
            fiscales.push(data[i]["usuario"]);
            casos.push(data[i]["total_casos"]);
            imagenes.push("../../public/" + data[i]["usu_photo"]);
        }

        var ctx = document.getElementById("casosChart").getContext("2d");

        // Si ya hay un gráfico, destrúyelo antes de crear otro
        if (chart !== null) {
            chart.destroy();
        }

        chart = new Chart(ctx, {
            type: "bar",
            data: {
                labels: fiscales,
                datasets: [{
                    label: "Casos Ingresados",
                    data: casos,
                    backgroundColor: [
                        "#6a89cc", "#82ccdd", "#b8e994", "#f8c291", "#e55039"
                    ],
                    hoverBackgroundColor: [
                        "#4a69bd", "#60a3bc", "#78e08f", "#e58e26", "#b71540"
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { beginAtZero: true }
                },
                plugins: {
                    legend: { display: false }
                }
            },
            plugins: [{
                afterDraw: function(chart) {
                    let ctx = chart.ctx;
                    let xAxis = chart.scales.x;

                    xAxis.ticks.forEach((tick, index) => {
                        let img = new Image();
                        img.src = imagenes[index];

                        let x = xAxis.getPixelForTick(index) - 10;
                        let y = chart.height - 40;

                        img.onload = () => ctx.drawImage(img, x, y, 20, 20);
                    });
                }
            }]
        });
    });
}

$(document).ready(function () {
    cargarGraficaCircular();
});

let chartCircular = null;

function cargarGraficaCircular() {
    $.post("../../controller/graficaController.php?op=casosDistrito", function (data) {
        data = JSON.parse(data);

        let distritos = [];
        let casos = [];

        for (let i = 0; i < data.length; i++) {
            distritos.push(data[i]["distrito"]);
            casos.push(data[i]["total_casos"]);
        }

        let ctx = document.getElementById("casosResueltosChart").getContext("2d");

        if (window.chartCircular) {
            window.chartCircular.destroy();
        }

        window.chartCircular = new Chart(ctx, {
            type: "doughnut",
            data: {
                labels: distritos,
                datasets: [{
                    label: "Casos por Distrito",
                    data: casos,
                    backgroundColor: [
                        "#6a89cc", "#82ccdd", "#b8e994", "#f8c291",
                        "#e55039", "#78e08f", "#fa983a", "#eb2f06"
                    ],
                    hoverBackgroundColor: [
                        "#4a69bd", "#60a3bc", "#78e08f", "#e58e26",
                        "#b71540", "#38ada9", "#fa8231", "#e55039"
                    ],
                    borderColor: "#ffffff",
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                layout: {
                    padding: 20
                },
                plugins: {
                    legend: {
                        position: "bottom", // Mejor presentación de la leyenda
                        labels: {
                            font: {
                                size: 16,
                            },
                            color: "#333"
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function (tooltipItem) {
                                let dataset = tooltipItem.dataset;
                                let total = dataset.data.reduce((sum, value) => sum + value, 0);
                                let value = dataset.data[tooltipItem.dataIndex];
                                let percentage = ((value / total) * 100).toFixed(1) + "%";
                                return `${dataset.label}: ${value} (${percentage})`;
                            }
                        }
                    }
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                }
            }
        });
    });
}

$(document).ready(function () {
    cargarGraficaEdades();
});
let chartEdades = null;

function cargarGraficaEdades() {
    $.post("../../controller/graficaController.php?op=graficaEdadesVictima", function (data) {
        data = JSON.parse(data);

        let rangosEdades = [];
        let cantidades = [];

        for (let i = 0; i < data.length; i++) {
            rangosEdades.push(data[i]["rango_de_edad"]);
            cantidades.push(data[i]["cantidad_de_personas"]);
        }

        let ctx = document.getElementById("casosProcesoChart").getContext("2d");

        if (window.chartEdades) {
            window.chartEdades.destroy();
        }

        window.chartEdades = new Chart(ctx, {
            type: "doughnut",
            data: {
                labels: rangosEdades,
                datasets: [{
                    label: "Víctimas por Rango de Edad",
                    data: cantidades,
                    backgroundColor: [
                        "#6a89cc", "#82ccdd", "#b8e994", "#f8c291", "#e55039"
                    ],
                    hoverBackgroundColor: [
                        "#4a69bd", "#60a3bc", "#78e08f", "#e58e26", "#b71540"
                    ],
                    borderColor: "#ffffff",
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                layout: {
                    padding: 20
                },
                plugins: {
                    legend: {
                        position: "bottom",
                        labels: {
                            font: {
                                size: 16,
                            },
                            color: "#333"
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function (tooltipItem) {
                                let dataset = tooltipItem.dataset;
                                let total = dataset.data.reduce((sum, value) => sum + value, 0);
                                let value = dataset.data[tooltipItem.dataIndex];
                                let percentage = ((value / total) * 100).toFixed(1) + "%";
                                return `${dataset.label}: ${value} (${percentage})`;
                            }
                        }
                    }
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                }
            }
        });
    });
}

document.addEventListener("DOMContentLoaded", function () {
    let fechaInput = document.getElementById("fecha_proceso_desde");
  
    // Abre el selector de fecha al hacer clic en cualquier parte del input
    fechaInput.addEventListener("selectMes", function () {
      this.showPicker(); // Abre el selector de fecha (solo funciona en navegadores modernos)
    });
  

  });
  