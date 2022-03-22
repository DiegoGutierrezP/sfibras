import ajaxFetch from '../../helpers/ajaxFetch.js';

const d = document;
let $formAgenda = d.getElementById('form-agenda');

d.addEventListener('DOMContentLoaded', function() {

    var calendarEl = d.getElementById('agenda');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale:"es",
        selectable: true,
        //timeZone: 'local',
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
        eventDidMount: function(info) {console.log(1);},//investigar
        select: function (selectInfo) {
            $formAgenda.reset();

            if(selectInfo.view.type == 'dayGridMonth'){
                $formAgenda.start.value = (new Date(selectInfo.startStr)).toISOString().slice(0,16);
                $formAgenda.end.value = (new Date (selectInfo.endStr)).toISOString().slice(0,16);
            }else if(selectInfo.view.type == 'timeGridWeek'){
                let fstart = new Date(selectInfo.startStr);
                let fend = new Date(selectInfo.endStr);
                $formAgenda.start.value = (new Date(fstart.getTime() - fstart.getTimezoneOffset() * 60000)).toISOString().slice(0,16);
                $formAgenda.end.value =(new Date(fend.getTime() - fend.getTimezoneOffset() * 60000)).toISOString().slice(0,16);
            }
            $("#calendarModal").modal('show');

          }
    });
    calendar.render();

});

d.addEventListener("click",e=>{
    if(e.target.matches('.btn-registrar-event')){
        e.preventDefault();
        let form = new FormData($formAgenda);
        console.log(form);

        ajaxFetch({
            url:urlStoreEvent,
            ops:{
                method:'POST',
                /* headers: {
                    "accept": "application/json; charset=utf-8"
                }, */
                body: new FormData($formAgenda),
            },
            success: json => {
                console.log(json);
            },
            error: err=>{
                console.log(err);
            }
        })
    }
})


