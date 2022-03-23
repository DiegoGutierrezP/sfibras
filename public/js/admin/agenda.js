import ajaxFetch from '../../helpers/ajaxFetch.js';

const d = document;
let $formAgenda = d.getElementById('form-agenda');
let $formEditEvent = d.getElementById('form-edit-event');
let $calendarModal = d.getElementById('calendarModal');
let $calendarShowModal = d.getElementById('calendarShowModal');


d.addEventListener('DOMContentLoaded', function() {

    var calendarEl = d.getElementById('agenda');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale:"es",
        selectable: true,
        timeZone: 'local',
        slotLabelFormat: [
            {
                hour: '2-digit',
                minute: '2-digit',
                hour12:false
            }
        ],
        headerToolbar:{
            left:"prev,next today",
            center:'title',
            right:'dayGridMonth,timeGridWeek,listWeek'
        },
        events:urlGetEvents,
        eventClick: function(info){
            $formEditEvent.id_event.value = info.event.id
            $formEditEvent.title.value = info.event.title
            $formEditEvent.descripcion.value = info.event.extendedProps.descripcion
            let fstart = new Date(info.event.start);
            let fend = new Date(info.event.end);
            $formEditEvent.start.value = (new Date(fstart.getTime() - fstart.getTimezoneOffset() * 60000)).toISOString().slice(0,16);
            $formEditEvent.end.value = (new Date(fend.getTime() - fend.getTimezoneOffset() * 60000)).toISOString().slice(0,16);
            $("#calendarShowModal").modal('show');

            //console.log(info.event,info.event.id);

            info.el.style.borderColor = 'red';
        },
        select: function (selectInfo) {
            $formAgenda.reset();

            let fstart = new Date(selectInfo.startStr);
            let fend = new Date(selectInfo.endStr);
            if(selectInfo.view.type == 'dayGridMonth'){
                fstart.setHours(fstart.getHours() + 8);
                //fend.setHours(fend.getHours() + 20);
                //$formAgenda.start.value = (new Date(selectInfo.startStr)).toISOString().slice(0,16);
                //$formAgenda.end.value = (new Date (selectInfo.endStr)).toISOString().slice(0,16);
                //$formAgenda.start.value = fstart.toISOString().slice(0,16);
                //$formAgenda.end.value = fend.toISOString().slice(0,16);
                $formAgenda.start.value = fstart.toISOString().slice(0,16);
                $formAgenda.end.value = fend.toISOString().slice(0,16);
                //console.log(fstart,fend);
                //console.log(selectInfo.startStr,selectInfo.endStr);
            }else if(selectInfo.view.type == 'timeGridWeek'){
                $formAgenda.start.value = (new Date(fstart.getTime() - fstart.getTimezoneOffset() * 60000)).toISOString().slice(0,16);
                $formAgenda.end.value =(new Date(fend.getTime() - fend.getTimezoneOffset() * 60000)).toISOString().slice(0,16);
            }
            $("#calendarModal").modal('show');
          }
    });
    calendar.render();

    d.addEventListener("click",e=>{
        if(e.target.matches('.btn-registrar-event')){
            e.preventDefault();

            ajaxFetch({
                url:urlStoreEvent,
                ops:{
                    method:'POST',
                    body: new FormData($formAgenda),
                },
                success: json => {
                    if(!json.res){
                        let [errTitle,errStart,errEnd] = getErrorsModal($calendarModal);
                        json.errors.title? errTitle.textContent = json.errors.title : ''
                        json.errors.start? errStart.textContent = json.errors.start : ''
                        json.errors.end? errEnd.textContent = json.errors.end : ''
                    }else{
                        $("#calendarModal").modal('hide');
                        calendar.refetchEvents();
                        Swal.fire({
                            position: "top-end",
                            icon: json.data.icon,
                            title: json.data.msg,
                            background: "#E6F4EA",
                            toast: true,
                            color: "#333",
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                        });
                    }
                    //console.log(json)
                },
                error: err=>{
                    console.log(err);
                }
            })
        }
        if(e.target.matches('.btn-update-event')){
            e.preventDefault();

            ajaxFetch({
                url:urlUpdateEvent,
                ops:{
                    method:'POST',
                    body: new FormData($formEditEvent),
                },
                success: json => {
                    if(!json.res){
                        let [errTitle,errStart,errEnd] = getErrorsModal($calendarShowModal);
                        json.errors.title? errTitle.textContent = json.errors.title : ''
                        json.errors.start? errStart.textContent = json.errors.start : ''
                        json.errors.end? errEnd.textContent = json.errors.end : ''
                    }else{
                        $("#calendarShowModal").modal('hide');
                        calendar.refetchEvents();
                        Swal.fire({
                            position: "top-end",
                            icon: json.data.icon,
                            title: json.data.msg,
                            background: "#E6F4EA",
                            toast: true,
                            color: "#333",
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                        });
                        //console.log(json);
                    }
                },
                error: err=>{
                    console.log(err);
                }
            })
        }
        if(e.target.matches(['.btn-delete-event','.btn-delete-event *'])){
            e.preventDefault();
            let title = $formEditEvent.title.value;
            Swal.fire({
                title: "Esta seguro?",
                text: `Se eliminara el evento '${title}'`,
                showCancelButton: true,
                confirmButtonColor: "#dc3545",
                cancelButtonColor: "#6c757d",
                cancelButtonText: "Cancelar",
                confirmButtonText: "Eliminar",
            }).then((result) => {
                if(result.value){
                    let urlDeleteEvent2 = urlDeleteEvent.replace(":id",$formEditEvent.id_event.value);
                    let options ={
                        url:urlDeleteEvent2,
                        ops:{
                            method:"DELETE",
                            headers: {
                                "Content-type": "application/json; charset=utf-8",
                                "X-CSRF-TOKEN": $formEditEvent._token.value,
                            }
                        },
                        success: json =>{
                            $("#calendarShowModal").modal('hide');
                            calendar.refetchEvents();
                            Swal.fire({
                                position: "top-end",
                                icon: json.data.icon,
                                title: json.data.msg,
                                background: "#E6F4EA",
                                toast: true,
                                color: "#333",
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                            });
                        },
                        error: err =>{
                                alert(err);
                        }

                    }
                    ajaxFetch(options);
                }
            });
        }
    })

    d.addEventListener("change",e=>{
        if(e.target.matches('#checkEditarEvent')){
            if(e.target.checked){
                $("#calendarShowModal").find(".modal-title").html('Editar Evento');
                $formEditEvent.querySelectorAll('input').forEach(el=> el.removeAttribute('readonly'));
                $formEditEvent.querySelector('textarea').removeAttribute('readonly');
                d.querySelector('.btn-update-event').classList.remove('d-none');
            }else{
                $("#calendarShowModal").find(".modal-title").html('Evento');
                $formEditEvent.querySelectorAll('input').forEach(el=> el.setAttribute('readonly'));
                $formEditEvent.querySelector('textarea').setAttribute('readonly');
                d.querySelector('.btn-update-event').classList.add('d-none');
            }
        }
    })

});

$('#calendarModal').on('hidden.bs.modal', function (event) {
    let [errTitle,errStart,errEnd] = getErrorsModal($calendarModal);
    errTitle.textContent =  '';
    errStart.textContent = '';
    errEnd.textContent ='';
})

$('#calendarShowModal').on('hidden.bs.modal', function (event) {
    $("#calendarShowModal").find(".modal-title").html('Evento');
    d.getElementById('checkEditarEvent').checked = false;
    $formEditEvent.querySelectorAll('input').forEach(el=> el.setAttribute('readonly'));
    $formEditEvent.querySelector('textarea').setAttribute('readonly');
    d.querySelector('.btn-update-event').classList.add('d-none');
    let [errTitle,errStart,errEnd] = getErrorsModal($calendarShowModal);
    errTitle.textContent =  '';
    errStart.textContent = '';
    errEnd.textContent ='';
  })

function getErrorsModal(modal){
    let errTitle = modal.querySelector('.error-title'),
    errStart = modal.querySelector('.error-start'),
    errEnd = modal.querySelector('.error-end');

    return [errTitle,errStart,errEnd];
}


