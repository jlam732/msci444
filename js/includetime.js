$.fn.androClock = function() {
    var days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    var months = ["Jan", "Feb", "Mar", "Apr", "May", "June", "July", "Aug", "Sep", "Oct", "Nov", "Dec"];
    function getTime() {
      var date = new Date(),
          hour = date.getHours();
      return {
        day: days[date.getDay()],
        date: date.getDate(),
        month: months[date.getMonth()],
        hour: appendZero(((hour + 11) % 12) + 1),
        minute: appendZero(date.getMinutes())
      };
    }
    function appendZero(num) {
      return (num >= 0 && num < 10) ? "0" + num : num + "";
    }
        
    function refreshClock() {
      var now = getTime();
      $('#date').html(now.day + ' ' + now.month + ' ' + now.date + ' ' + now.hour + ":" + now.minute);
      setTimeout(function() {
        refreshClock();
      }, 10000);
    }
    refreshClock();
};

$('#andro-clock').androClock();
