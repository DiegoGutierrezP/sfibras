const d = document;
        document.addEventListener('DOMContentLoaded', () => {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    locale:'es',
                    headerToolbar:{
                        left:'prev,next,today',
                        center:'title',
                        right:'dayGridMonth,timeGridWeek,listWeek'
                    },
                    contentHeight: 600,
                    aspectRatio:  3,
                    dateClick: function(){
                        console.log('ai')
                    }
                });
                calendar.updateSize();
                calendar.render();

        });
