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

  //datetimepicker วันที่มีราชการจริง
  jQuery(function () {
    jQuery('#train-startDate').datetimepicker({
      format: 'Y-m-d',
      lang: 'th',
      scrollMonth: false,
      onShow: function (ct) {
        this.setOptions({
          maxDate: jQuery('#train-endDate').val() ? jQuery('#train-endDate').val() : false
        })
      },
      // minDate: 0, // today
      timepicker: false
    });
    jQuery('#train-endDate').datetimepicker({
      format: 'Y-m-d',
      lang: 'th',
      scrollMonth: false,
      onShow: function (ct) {
        this.setOptions({
          minDate: jQuery('#train-startDate').val() ? jQuery('#train-startDate').val() : false
        })
      },
      timepicker: false
    });
  });

  
  //datetimepicker วันที่ขออนุมัติเดินทาง
  jQuery(function () {
    jQuery('#train-startTravel').datetimepicker({
      format: 'Y-m-d',
      lang: 'th',
      scrollMonth: false,
      onShow: function (ct) {
        this.setOptions({
          maxDate: jQuery('#train-endTravel').val() ? jQuery('#train-endTravel').val() : false
        })
      },
      // minDate: 0, // today
      timepicker: false
    });
    jQuery('#train-endTravel').datetimepicker({
      format: 'Y-m-d',
      lang: 'th',
      scrollMonth: false,
      onShow: function (ct) {
        this.setOptions({
          minDate: jQuery('#train-startTravel').val() ? jQuery('#train-startTravel').val() : false
        })
      },
      timepicker: false
    });
  });

  $(document).ready(function () {
    sum();
    $("#train-allowance, #train-hotel, #train-traveling, #train-oilPrice, #train-otherValues").on("keydown keyup", function () {
      sum();
    });
  });

  function sum() {
    element = document.getElementById('train-allowance');
    if (element != null) {
      var value1 = document.getElementById('train-allowance').value;
      var value2 = document.getElementById('train-hotel').value;
      var value3 = document.getElementById('train-traveling').value;
      var value4 = document.getElementById('train-oilPrice').value;
      var value5 = document.getElementById('train-otherValues').value;
      var result = parseFloat(value1) + parseFloat(value2) + parseFloat(value3) + parseFloat(value4) + parseFloat(value5);
      var bath = result.toLocaleString() + "  บาท";
      document.getElementById('train-sum').value = bath;

    }
  }


  // ----------------------------------------start training------------------------------------------------ //
  // add plan
  jQuery(document).on('click', 'button#add-training', function () {
    jQuery.ajax({
      type: 'POST',
      url: baseurl + 'planning/trainingAdd',
      data: jQuery("form#add-training-form").serialize(),
      dataType: 'json',

      success: function (json) {

        //console.log(json);
        $('.text-danger').remove();
        if (json['error']) {
          for (i in json['error']) {
            var element = $('.train-' + i.replace('_', '-'));
            if ($(element).parent().hasClass('input-group')) {
              $(element).parent().after('<div class="text-danger" style="font-size: 14px;">' + json['error'][i] + '</div>');
            } else {
              $(element).after('<div class="text-danger" style="font-size: 14px;">' + json['error'][i] + '</div>');
            }
          }
        } else {
          //if (json['access'] != 'denied') {
            jQuery('#loading-modal').modal();
            // setTimeout(function () {
            //   location.replace(baseurl + "planning/trainingEdit")
            // }, 3000);
          
          // alert('ID'+json['Hospcode']);


          jQuery('form#add-training-form').find('textarea, input').each(function () {
            jQuery(this).val('');
          });
          jQuery('#add-training').modal('hide');

        }

      },
      error: function (xhr, ajaxOptions, thrownError) {
        console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
      }
    });
  });