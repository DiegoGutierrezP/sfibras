const d = document;
d.addEventListener('DOMContentLoaded', function() {

    let $formAgenda = d.getElementById('form-agenda');

    var calendarEl = d.getElementById('agenda');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      locale:"es",
      timeZone: 'local',
        headerToolbar:{
            left:"prev,next today",
            center:'title',
            right:'dayGridMonth,timeGridWeek,listWeek'
        },
        dateClick: function(info) {
            //alert('Clicked on: ' + info.dateStr);
            $formAgenda.reset();
            $("#calendarModal").modal('show');
        }
    });
    calendar.render();

    d.addEventListener("change",e=>{
        if(e.target == $formAgenda.start){
            $formAgenda.end.value = e.target.value;
        }
    })

});


