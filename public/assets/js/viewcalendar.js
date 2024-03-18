$(document).ready(function() {
    $('#calendar').fullCalendar({
        defaultView: 'month',
        events: scheduleVisits.map(function(visit) {
            return {
                title: 'Melakukan Schedule Visit - ' + visit.pic,
                start: visit.schedule,
                end: visit.due_date
            };
        })
    });
});