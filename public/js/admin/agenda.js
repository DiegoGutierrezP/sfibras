import ajaxFetch from '../../helpers/ajaxFetch.js';

const d = document;
let $formAgenda = d.getElementById('form-agenda');
let errTitle = d.querySelector('#calendarModal .error-title'),
errStart = d.querySelector('#calendarModal .error-start'),
errEnd = d.querySelector('#calendarModal .error-end');

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
            console.log(info.event);
            alert('Event: ' + info.event.descripcion);
            alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
            alert('View: ' + info.view.type);

            // change the border color just for fun
            info.el.style.borderColor = 'red';
        },
        select: function (selectInfo) {
            $formAgenda.reset();
            errTitle.textContent =  '';
            errStart.textContent = '';
            errEnd.textContent ='';

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
                console.log(fstart,fend);
                console.log(selectInfo.startStr,selectInfo.endStr);
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
            let form = new FormData($formAgenda);

            ajaxFetch({
                url:urlStoreEvent,
                ops:{
                    method:'POST',
                    body: new FormData($formAgenda),
                },
                success: json => {
                    if(!json.res){
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
    })

});




