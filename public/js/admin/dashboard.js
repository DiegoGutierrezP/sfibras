import ajaxFetch from "../../helpers/ajaxFetch.js";

const d = document;
const cardIngresosMes = d.getElementById("ingresos-mes"),
    cardPedidosMes = d.getElementById("pedidos-mes"),
    cardPedidosPend = d.getElementById("pedidos-pendientes"),
    cardPedidosEntre = d.getElementById("pedidos-entregados");
const ctx1 = document.getElementById("chartIngresos");
const ctx2 = document.getElementById("chartPedidos");
const cardChartIngresos = d.getElementById('card-chartIngresos');
const cardChartPedidos = d.getElementById('card-chartPedidos');


d.addEventListener("DOMContentLoaded", (e) => {

    d.querySelectorAll(".card-dash .number").forEach((el) => {
        el.innerHTML = `<img src='/storage/admin/loader.svg' alt='loader'>`;
    });
    d.querySelectorAll(".content-cards-chart .card .loader").forEach(el=>{
        el.innerHTML = `<img src='/storage/admin/loader.svg' alt='loader'>`;
    })
    //-----------------------------------------------------------------------------
    ajaxFetch({
        url:urlIngresosMeses,
        ops:{
            method:"GET",
            headers:{
                "Content-type": "application/json; charset=utf-8",
            }
        },
        success: json=>{
            console.log(json);
            cardChartIngresos.querySelector('.loader').innerHTML= '';
            const chartIngresos = new Chart(ctx1, {
                type: "pie",
                data: {
                    labels: json.data.labels,
                    datasets: [
                        {
                            label: "My First Dataset",
                            data: json.data.data,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.9)',
                                'rgba(54, 162, 235, 0.9)',
                                'rgba(255, 206, 86, 0.9)',
                                'rgba(75, 192, 192, 0.9)',
                            ],
                            hoverOffset: 4,
                        },
                    ],
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                        },
                    },
                },
            });
        },
        error:err=>{
            cardChartIngresos.querySelector('.loader').innerHTML= '';
            cardChartIngresos.querySelector('.loader').innerHTML= 'Ocurrio un Error '+ err;
            console.log(err)
        }
    });
    //--------------------------------------------------------------------------------
    ajaxFetch({
        url:urlPedidosMeses,
        ops:{
            method:"GET",
            headers:{
                "Content-type": "application/json; charset=utf-8",
            }
        },
        success: json => {
            cardChartPedidos.querySelector('.loader').innerHTML= '';
            const chartPedidos = new Chart(ctx2, {
                type: "bar",
                data: {
                    labels: json.data.labels,
                    datasets: [
                        {
                            label: "Pedidos",
                            data: json.data.data,
                            backgroundColor: [
                                'rgba(255, 206, 86, 0.9)',
                                'rgba(75, 192, 192, 0.9)',
                                'rgba(255, 99, 132, 0.9)',
                                'rgba(54, 162, 235, 0.9)',
                            ],
                            hoverOffset: 4,
                        },
                    ],
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                        },
                    },
                },
            });
        },
        error: err=>{
            cardChartPedidos.querySelector('.loader').innerHTML= '';
            cardChartPedidos.querySelector('.loader').innerHTML= 'Ocurrio un Error '+ err;
        }
    })

    //--------------------------------------------------------------------------------
    let options = {
        url: urlInfoCards,
        ops: {
            method: "GET",
            headers: {
                "Content-type": "application/json; charset=utf-8",
            },
        },
        success: (json) => {
            console.log(json);
            cardIngresosMes.querySelector(".number").innerHTML =
                json.data.ingresosTotalMes;
            cardPedidosPend.querySelector(".number").innerHTML =
                json.data.ocPendientes;
            cardPedidosEntre.querySelector(".number").innerHTML =
                json.data.ocEntregados;
            cardPedidosMes.querySelector('.number').innerHTML = json.data.pedidosXMes;
        },
        error: (err) => {
            console.log(err);
            cardIngresosMes.querySelector(".number").innerHTML =
                err.msg;
            cardPedidosPend.querySelector(".number").innerHTML =
                err.msg;
            cardPedidosEntre.querySelector(".number").innerHTML =
                err.msg;
            cardPedidosMes.querySelector('.number').innerHTML = err.msg;
        },
    };
    ajaxFetch(options);
});
