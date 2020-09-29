  //datetimepicker
  $.datetimepicker.setLocale('th'); // ต้องกำหนดเสมอถ้าใช้ภาษาไทย และ เป็นปี พ.ศ.

  $("#train-createDate").datetimepicker({
    timepicker: false,
    format: 'Y-m-d', // กำหนดรูปแบบวันที่ ที่ใช้ เป็น 00-00-0000            
    lang: 'th', // ต้องกำหนดเสมอถ้าใช้ภาษาไทย และ เป็นปี พ.ศ.
    scrollMonth: false,
    onSelectDate: function (dp, $input) {
      var yearT = new Date(dp).getFullYear() - 0;
      var yearTH = yearT + 0;
      var fulldate = $input.val();
      var fulldateTH = fulldate.replace(yearT, yearTH);
      $input.val(fulldateTH);
    },
  });

  $("#input-startDate").datetimepicker({
    timepicker: false,
    format: 'Y-m-d', // กำหนดรูปแบบวันที่ ที่ใช้ เป็น 00-00-0000            
    lang: 'th', // ต้องกำหนดเสมอถ้าใช้ภาษาไทย และ เป็นปี พ.ศ.
    scrollMonth: false,
    onSelectDate: function (dp, $input) {
      var yearT = new Date(dp).getFullYear() - 0;
      var yearTH = yearT + 0;
      var fulldate = $input.val();
      var fulldateTH = fulldate.replace(yearT, yearTH);
      $input.val(fulldateTH);
    },
  });

  $("#input-stopDate").datetimepicker({
    timepicker: false,
    format: 'Y-m-d', // กำหนดรูปแบบวันที่ ที่ใช้ เป็น 00-00-0000            
    lang: 'th', // ต้องกำหนดเสมอถ้าใช้ภาษาไทย และ เป็นปี พ.ศ.
    scrollMonth: false,
    onSelectDate: function (dp, $input) {
      var yearT = new Date(dp).getFullYear() - 0;
      var yearTH = yearT + 0;
      var fulldate = $input.val();
      var fulldateTH = fulldate.replace(yearT, yearTH);
      $input.val(fulldateTH);
    },
  });

  $("#retireDate").datetimepicker({
    timepicker: false,
    format: 'Y-m-d', // กำหนดรูปแบบวันที่ ที่ใช้ เป็น 00-00-0000            
    lang: 'th', // ต้องกำหนดเสมอถ้าใช้ภาษาไทย และ เป็นปี พ.ศ.
    scrollMonth: false,
    onSelectDate: function (dp, $input) {
      var yearT = new Date(dp).getFullYear() - 0;
      var yearTH = yearT + 0;
      var fulldate = $input.val();
      var fulldateTH = fulldate.replace(yearT, yearTH);
      $input.val(fulldateTH);
    },
  });