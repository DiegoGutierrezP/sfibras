import ajaxFetch from "../../helpers/ajaxFetch.js";

const d= document;

    d.addEventListener("click",e=>{
        if (e.target.matches('.btn-estado-coti')) {
            e.preventDefault();
            console.log(e.target.dataset.estado, e.target.dataset.codigo);
            $('#estadosCotiModal').modal('show');
            $('#estadosCotiModal').find('.modal-body h5').text('Cotización ' + e.target.dataset.codigo);
            $('#estadosCotiModal').find('.modal-body input[name="codigo_coti"]').val(e.target.dataset.codigo);
            d.querySelectorAll('#estadosCotiModal input[name="estadosCoti"]').forEach(el => {
                if (el.value == e.target.dataset.estado) {
                    el.checked = true;
                }
            });
        }
        if(e.target.matches('.btn-guardar-estado-coti')){
            e.preventDefault();
            $('#estadosCotiModal').modal('hide');
            if(d.querySelector('input[name="estadosCoti"]:checked')){
                let estado = d.querySelector('input[name="estadosCoti"]:checked').value;
                if(estado == 1 || estado == 5){
                    d.getElementById("form-checks-estado-coti").submit();
                }else if(estado == 2 || estado == 3){
                    let codigoCoti = d.querySelector('#estadosCotiModal input[name="codigo_coti"]').value;
                    let urlOcCreate2 = urlOcCreate.replace(':codigo', codigoCoti);
                    window.location.href = urlOcCreate2;
                }
            }
        }
        if(e.target.matches('.btn-coti-aceptada')){
            e.preventDefault();
            console.log(e.target.dataset.coti);
            let estadoCoti = e.target.dataset.estado;
            let obj ={
                url:urlInfoAceptada,
                ops:{
                    method:"POST",
                    headers: {
                        "Content-type": "application/json; charset=utf-8",
                        "X-CSRF-TOKEN": token
                    },
                    body: JSON.stringify({
                        codigoCoti: e.target.dataset.coti,
                    })
                },
                success: json => {
                    //console.log(json);
                    const contentModal = d.querySelector("#cotiAceptadaModal .modal-body");
                    let msg = "";
                    if(estadoCoti == 2){
                        msg = 'Esta cotizacion fue aceptada sin ninguna modificacion.'
                    }else{
                        msg = 'Esta cotizacion fue aceptada con alguna  modificacion.'
                    }
                    contentModal.querySelector('.info').textContent = msg;
                    const tableInfo = contentModal.querySelector('.table-information');
                    let fechaAprobacion = new Date(json.data.oc.created_at);
                    let urlOcShow2 = urlOcShow.replace(':id', json.data.oc.id);
                    tableInfo.rows[0].cells[1].innerHTML = `<a href="${urlOcShow2}">${json.data.oc.codigoOC}</a>`
                    tableInfo.rows[1].cells[1].textContent = fechaAprobacion.toLocaleString();
                    tableInfo.rows[2].cells[1].textContent = json.data.oc.estadoPedido;
                    $('#cotiAceptadaModal').modal('show');

                },
                error:err => {
                    console.log(err)
                }
            }
            ajaxFetch(obj);
        }

    })

