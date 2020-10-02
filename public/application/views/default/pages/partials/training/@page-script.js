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
  // add training
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
          setTimeout(function () {
            location.replace(baseurl + "planning/training")
          }, 3000);

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

  // add user training
  jQuery(document).on('click', 'button#add-user', function () {
    jQuery.ajax({
      type: 'POST',
      url: baseurl + 'planning/trainingAddUser',
      data: jQuery("form#add-user-form").serialize(),
      dataType: 'json',

      success: function (json) {

        //console.log(json);
        $('.text-danger').remove();
        if (json['error']) {
          for (i in json['error']) {
            var element = $('.input-' + i.replace('_', '-'));
            if ($(element).parent().hasClass('input-group')) {
              $(element).parent().after('<div class="text-danger" style="font-size: 14px;">' + json['error'][i] + '</div>');
            } else {
              $(element).after('<div class="text-danger" style="font-size: 14px;">' + json['error'][i] + '</div>');
            }
          }
        } else {

          jQuery('span#success-msg').html('<div class="alert d-flex bgc-green-l4 brc-green-m4 border-1 border-l-0 pl-3 radius-l-0" role="alert"><div class="position-tl h-102 border-l-4 brc-green mt-n1px"></div><i class="fa fa-check mr-3 text-140 text-green"></i><span class="align-self-center text-green-d2 text-100">เพิ่มรายชื่อผู้ไปราชการเรียบร้อย ...</span></div>');
          setTimeout(function () {
            window.location.reload(true);
          }, 1000);

          jQuery('form#add-user-form').find('textarea, input').each(function () {
            jQuery(this).val('');
          });
          jQuery('#add-user').modal('hide');

        }

      },
      error: function (xhr, ajaxOptions, thrownError) {
        console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
      }
    });
  });

  // set id user for trash 
  jQuery(document).on('click', 'a.trash-user-details', function () {
    var id = jQuery(this).data('getid');
    jQuery('button#trash-user').data('trashId', id);
  });

  // trash user training
  jQuery(document).on('click', 'button#trash-user', function () {
    var id = jQuery(this).data('trashId');
    jQuery.ajax({
      type: 'POST',
      url: baseurl + 'planning/trainingTrashUser',
      data: {
        id: id
      },
      dataType: 'json',
      complete: function () {
        jQuery('#trash-user').modal('hide');
      },
      success: function (json) {
        jQuery('span#success-msg').html('<div class="alert d-flex bgc-red-l4 brc-red-m4 border-1 border-l-0 pl-3 radius-l-0" role="alert"><div class="position-tl h-102 border-l-4 brc-red mt-n1px"></div><i class="fa fa-trash-alt mr-3 text-140 text-danger-m1"></i><span class="align-self-center text-danger-d2 text-100">ลบรายชื่อผู้ไปราชการเรียบร้อย ...</span></div>');
        setTimeout(function () {
          window.location.reload(true);
        }, 1000);
      },
      error: function (xhr, ajaxOptions, thrownError) {
        console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
      }
    });
  });
