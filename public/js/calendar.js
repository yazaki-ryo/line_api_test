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

  // データ取得URL
  var endpoint = "/ajax/reservations/list";

  $('#calendar').fullCalendar({    
    header: {
        right: 'month,agendaWeek,agendaDay,listWeek',
        center: 'prev,next today',
    },
    events: endpoint,
    editable: false,
    eventClick: function(event) {
      // イベントをクリックしたときに実行
      setSelectDate(event.start._i);
    },
    dayClick: function(date){
      // 日をクリックしたときに実行
      setSelectDate(date._d);
    },
    eventDragStart: function(info) {
      // ドラッグ開始
      console.log(info);
    },
    eventDrop: function(info) {
      // ドラッグ終了
      console.log(info);
      if (!confirm("予約日時を変更してもよろしいですか？")) {
        $.ajax({

        })
      }
  }

  });

  function requestVisitorData(date) {
    location.href = '/reservations/?reserved_date=' + date;
  }

  function setSelectDate(date) {
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