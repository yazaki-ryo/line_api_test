// calendar //

/**
 * <<header option>>
 * left: 'prev,next today',
 * center: 'title',
 * 
 * <<other option>>
 * editable: true,
 * eventLimit: true, // allow "more" link when too many events
 * navLinks: true,
 */

(function($) {

  var endpoint = "";
  $('#calendar').fullCalendar({    
    header: {
        right: 'month,agendaWeek,agendaDay,listWeek',
        center: 'prev,next today',
    },
    events: endpoint,
    eventClick: function(event) {
      // イベントをクリックしたときに実行
      setSelectDate(event.start._i);
    },
    dayClick: function(date){
      // 日をクリックしたときに実行
      setSelectDate(date._d);
    }

  });

  function requestVisitorData(date) {
    location.href = '/reservations/day_list/' + date;
  }

  function setSelectDate(date) {
      console.log(date)
      var selectDate = new Date(date);
      var year = selectDate.getFullYear();
      var month = toDoubleDigits(selectDate.getMonth() + 1);
      var day = toDoubleDigits(selectDate.getDate());
      var searchDate = year + '-' + month + '-' + day;
      requestVisitorData(searchDate);
  }

  // 1桁の数字を0埋めで2桁にする
  function toDoubleDigits(num) {
      num += "";
      if (num.length === 1) {
          num = "0" + num;
      }
      return num;     
  };

}(jQuery));