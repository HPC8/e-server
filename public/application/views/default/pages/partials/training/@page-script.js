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

  function addTraining() {
    $.aceToaster.add({
      placement: 'tr',
      body: "<div class='d-flex'>\
              <div class='bgc-success-d1 text-white px-3 pt-3'>\
                  <div class='border-2 brc-white px-3 py-25 radius-round'>\
                      <i class='fa fa-check text-150'></i>\
                  </div>\
              </div>\
              <div class='p-3 mb-0 flex-grow-1'>\
                  <h4 class='text-130'>Success </h4>\
                  เพิ่มรายชื่อผู้ไปราชการเรียบร้อย ...\
              </div>\
              <button data-dismiss='toast' class='align-self-start btn btn-xs btn-outline-grey btn-h-light-grey py-2px mr-1 mt-1 border-0 text-150'>&times;</button></div>\
             </div>",

      width: 420,
      delay: 5000,

      close: false,

      className: 'bgc-white-tp1 shadow border-0',

      bodyClass: 'border-0 p-0 text-dark-tp2',
      headerClass: 'd-none',
    })
  }

  function trashTraining() {
    $.aceToaster.add({
      placement: 'tr',
      body: "<div class='d-flex'>\
              <div class='bgc-danger-d1 text-white px-3 pt-3'>\
                  <div class='border-2 brc-white px-3 py-25 radius-round'>\
                      <i class='fa fa-times text-150'></i>\
                  </div>\
              </div>\
              <div class='p-3 mb-0 flex-grow-1'>\
                  <h4 class='text-130'>Alert</h4>\
                  ลบรายชื่อผู้ไปราชการเรียบร้อย ...\
              </div>\
              <button data-dismiss='toast' class='align-self-start btn btn-xs btn-outline-grey btn-h-light-grey py-2px mr-1 mt-1 border-0 text-150'>&times;</button></div>\
             </div>",

      width: 420,
      delay: 5000,

      close: false,

      className: 'bgc-white-tp1 shadow border-0',

      bodyClass: 'border-0 p-0 text-dark-tp2',
      headerClass: 'd-none',
    })
  }

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
          //jQuery('span#success-msg').html('<div class="alert d-flex bgc-green-l4 brc-green-m4 border-1 border-l-0 pl-3 radius-l-0" role="alert"><div class="position-tl h-102 border-l-4 brc-green mt-n1px"></div><i class="fa fa-check mr-3 text-140 text-green"></i><span class="align-self-center text-green-d2 text-100">เพิ่มรายชื่อผู้ไปราชการเรียบร้อย ...</span></div>');
          addTraining();
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
        //jQuery('span#success-msg').html('<div class="alert d-flex bgc-red-l4 brc-red-m4 border-1 border-l-0 pl-3 radius-l-0" role="alert"><div class="position-tl h-102 border-l-4 brc-red mt-n1px"></div><i class="fa fa-trash-alt mr-3 text-140 text-danger-m1"></i><span class="align-self-center text-danger-d2 text-100">ลบรายชื่อผู้ไปราชการเรียบร้อย ...</span></div>');
        trashTraining();
        setTimeout(function () {
          window.location.reload(true);
        }, 1000);
      },
      error: function (xhr, ajaxOptions, thrownError) {
        console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
      }
    });
  });

  // update training
  jQuery(document).on('click', 'button#update-training', function () {
    jQuery.ajax({
      type: 'POST',
      url: baseurl + 'planning/trainingUpdate',
      data: jQuery("form#update-training-form").serialize(),
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
          jQuery('#loading-modal').modal();
          setTimeout(function () {
            window.location.reload(true);
            //location.replace(baseurl + "planning/training")
          }, 3000);

          jQuery('form#update-training-form').find('textarea, input').each(function () {
            jQuery(this).val('');
          });
          jQuery('#update-training').modal('hide');

        }

      },
      error: function (xhr, ajaxOptions, thrownError) {
        console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
      }
    });
  });

  // confirm training
  jQuery(document).on('click', 'button#confirm-training', function () {
    jQuery.ajax({
      type: 'POST',
      url: baseurl + 'planning/trainingConfirm',
      data: jQuery("form#update-training-form").serialize(),
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
          jQuery('#loading-modal').modal();
          setTimeout(function () {
            location.replace(baseurl + "planning/training")
          }, 3000);

          jQuery('form#update-training-form').find('textarea, input').each(function () {
            jQuery(this).val('');
          });
          jQuery('#confirm-training').modal('hide');

        }

      },
      error: function (xhr, ajaxOptions, thrownError) {
        console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
      }
    });
  });

  $(document).ready(function () {
    var table = $('#tbl-training').DataTable({
      responsive: true,
      scrollX: true,
      iDisplayLength: 25,
      processing: true,
      serverSide: true,
      order: [],
      ajax: {
        url: baseurl + 'planning/ajaxTraining',
        type: 'POST'
      },
      //optional
      lengthMenu: [
        [5, 10, 25, 50, 100],
        [5, 10, 25, 50, 100]
      ],
      columnDefs: [{
          targets: 0,
          className: "text-center",
          width: "14%"
        },
        {
          targets: 1,
          className: "text-left",
          width: "40%"
        },
        {
          targets: 2,
          className: "text-left",
          width: "18%"
        },
        {
          responsivePriority: 4,
          targets: 3,
          className: "text-center",
          width: "18%",
        },
        {
          responsivePriority: 3,
          targets: 4,
          className: "text-left",
          width: "0%",
        },
        {
          responsivePriority: 2,
          targets: 5,
          className: "text-left",
          width: "0%",
        },
        {
          responsivePriority: 1,
          targets: 5,
          className: "text-left",
          width: "0%",
        },
        {
          targets: 7,
          className: "text-center",
          width: "10%"
        }
      ],


      // columnDefs: [{
      //   // "targets": [],
      //   // "orderable": false, 
      //   orderable: false,
      //   className: null,
      //   targets: -1
      // }, ],
    });
  });

  // get plan 
  jQuery(document).on('change', 'select#train-plan', function (e) {
    e.preventDefault();
    var planID = jQuery(this).val();
    selectProduct(planID);
  });


  function selectProduct(planID) {
    $.ajax({
      url: baseurl + 'planning/getProduct',
      type: 'post',
      data: {
        planID: planID
      },
      dataType: 'json',
      beforeSend: function () {
        jQuery('select#train-product').find("option:eq(0)").html("Loading...");
      },
      complete: function () {
        // code
      },
      success: function (json) {
        var options = '';
        options += '<option value="">-- กรุณาเลือก --</option>';
        for (var i = 0; i < json.length; i++) {
          options += '<option value="' + json[i].product_id + '">' + json[i].product_name + '</option>';
        }
        jQuery("select#train-product").html(options);

      },
      error: function (xhr, ajaxOptions, thrownError) {
        console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
      }
    });
  }

  // get product 
  jQuery(document).on('change', 'select#train-product', function (e) {
    e.preventDefault();
    var productID = jQuery(this).val();
    selectActivity(productID);
  });

  function selectActivity(productID) {
    $.ajax({
      url: baseurl + 'planning/getActivity',
      type: 'post',
      data: {
        productID: productID
      },
      dataType: 'json',
      beforeSend: function () {
        jQuery('select#train-activity').find("option:eq(0)").html("Loading...");
      },
      complete: function () {
        // code
      },
      success: function (json) {
        var options = '';
        options += '<option value="">-- กรุณาเลือก --</option>';
        for (var i = 0; i < json.length; i++) {
          options += '<option value="' + json[i].activity_id + '">' + json[i].activity_name + '</option>';
        }
        jQuery("select#train-activity").html(options);

      },
      error: function (xhr, ajaxOptions, thrownError) {
        console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
      }
    });
  }

  // get activity 
  jQuery(document).on('change', 'select#train-activity', function (e) {
    e.preventDefault();
    var activityID = jQuery(this).val();
    selectProgram(activityID);
  });

  function selectProgram(activityID) {
    $.ajax({
      url: baseurl + 'planning/getProgram',
      type: 'post',
      data: {
        activityID: activityID
      },
      dataType: 'json',
      beforeSend: function () {
        jQuery('select#train-program').find("option:eq(0)").html("Loading...");
      },
      complete: function () {
        // code
      },
      success: function (json) {
        var options = '';
        options += '<option value="">-- กรุณาเลือก --</option>';
        for (var i = 0; i < json.length; i++) {
          options += '<option value="' + json[i].program_id + '">' + json[i].program_name + '</option>';
        }
        jQuery("select#train-program").html(options);

      },
      error: function (xhr, ajaxOptions, thrownError) {
        console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
      }
    });
  }