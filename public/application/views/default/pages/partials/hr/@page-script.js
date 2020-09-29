jQuery(function ($) {

  //masked input
  try { //not working in IE11
    $("#input-cid").inputmask('9-9999-99999-99-9');
    $("#input-mobile").inputmask('99-9999-9999');
    $("#input-accountNo").inputmask('999-9-99999-9');
    // $("#input-nameeng").inputmask("[A]{4,*} [A]{*,*}")
  } catch (e) {}

  // select2
  $('.select2').select2({
    allowClear: true,
    dropdownParent: $('#input-titlename'),
  })


  // chosen
  $(".chosen-select").chosen({
    allow_single_deselect: true
  })

  $('#attachment').aceFileInput({

    btnChooseClass: 'bgc-grey-l2 pt-15 px-2 my-1px mr-1px',
    btnChooseText: 'เลือกไฟล์',
    placeholderText: 'ยังไม่มีไฟล์',
    placeholderIcon: '<i class="fas fa-folder-open bgc-warning-m1 text-white w-4 py-2 text-center"></i> '

  })

  //datetimepicker
  $.datetimepicker.setLocale('th'); // ต้องกำหนดเสมอถ้าใช้ภาษาไทย และ เป็นปี พ.ศ.

  $("#input-birthday").datetimepicker({
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

})

// hr register user
jQuery(document).on('click', 'button#add-submit', function () {
  jQuery.ajax({
    type: 'POST',
    url: baseurl + 'hr/addUsers',
    data: jQuery("form#hr-register-form").serialize(),
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
        //alert('ID'+json['lastID']);
        // $("#loading-modal").modal("toggle");
        jQuery('#loading-modal').modal();
        setTimeout(function () {
          location.replace(baseurl + "hr")
        }, 3000);

        jQuery('form#hr-register-form').find('textarea, input').each(function () {
          jQuery(this).val('');
        });
        jQuery('#add-submit').modal('hide');

      }

    },
    error: function (xhr, ajaxOptions, thrownError) {
      console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
});

// hr edit user
jQuery(document).on('click', 'button#edit-submit', function () {
  jQuery.ajax({
    type: 'POST',
    url: baseurl + 'hr/updateUsers',
    data: jQuery("form#hr-edit-form").serialize(),
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
        // alert('ID'+json['Hospcode']);
        jQuery('#loading-modal').modal();
        setTimeout(function () {
          location.replace(baseurl + "hr/profile/" + json['Hospcode'])
        }, 3000);

        jQuery('form#hr-edit-form').find('textarea, input').each(function () {
          jQuery(this).val('');
        });
        jQuery('#edit-submit').modal('hide');

      }

    },
    error: function (xhr, ajaxOptions, thrownError) {
      console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
});

// get province 
jQuery(document).on('change', 'select#input-province', function (e) {
  e.preventDefault();
  var provinceID = jQuery(this).val();
  selectAmphur(provinceID);
});

// get amphur
jQuery(document).on('change', 'select#input-amphur', function (e) {
  e.preventDefault();
  var amphurID = jQuery(this).val();
  selectDistrict(amphurID);

});

// function select amphur
function selectAmphur(provinceID) {
  $.ajax({
    url: baseurl + 'hr/getAmphur',
    type: 'post',
    data: {
      provinceID: provinceID
    },
    dataType: 'json',
    beforeSend: function () {
      jQuery('select#input-amphur').find("option:eq(0)").html("Loading...");
    },
    complete: function () {
      // code
    },
    success: function (json) {
      var options = '';
      options += '<option value="">-- กรุณาเลือก --</option>';
      for (var i = 0; i < json.length; i++) {
        options += '<option value="' + json[i].amphur_id + '">' + json[i].amphur_name + '</option>';
      }
      jQuery("select#input-amphur").html(options);

    },
    error: function (xhr, ajaxOptions, thrownError) {
      console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
}

// function select district
function selectDistrict(amphurID) {
  $.ajax({
    url: baseurl + "hr/getDistrict",
    type: 'post',
    data: {
      amphurID: amphurID
    },
    dataType: 'json',
    beforeSend: function () {
      jQuery('select#input-district').find("option:eq(0)").html("Loading..");
    },
    complete: function () {
      // code
    },
    success: function (json) {
      var options = '';
      options += '<option value="">-- กรุณาเลือก --</option>';
      for (var i = 0; i < json.length; i++) {
        options += '<option value="' + json[i].district_id + '">' + json[i].district_name + '</option>';
      }
      jQuery("select#input-district").html(options);

    },
    error: function (xhr, ajaxOptions, thrownError) {
      console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
}


// Load the Visualization API and the line package.
google.charts.load('current', {
  'packages': ['corechart']
});
// Set a callback to run when the Google Visualization API is loaded.
google.charts.setOnLoadCallback(pieCategory);

function pieCategory() {
  $.ajax({
    type: 'POST',
    url: baseurl + 'hr/pieCategory',
    success: function (value) {
      var data = new google.visualization.DataTable();
      // Add legends with data type
      data.addColumn('string', 'name');
      data.addColumn('number', 'count');
      //Parse data into Json
      var jsonData = $.parseJSON(value);
      for (var i = 0; i < jsonData.length; i++) {
        data.addRow([jsonData[i].name, parseInt(jsonData[i].count)]);
      }

      var options = {
        'legend': 'bottom',
        is3D: true,
        // pieSliceText: 'value-and-percentage',
        // legend: { position: 'labeled' },
        // backgroundColor: 'transparent'
      };
      var chart = new google.visualization.PieChart(document.getElementById('pieCategory'));
      chart.draw(data, options);
    }
  });
}
$(window).resize(function () {
  pieCategory();
});


// Load the Visualization API and the line package.
google.charts.load('current', {
  'packages': ['corechart']
});
// Set a callback to run when the Google Visualization API is loaded.
google.charts.setOnLoadCallback(pieEducation);

function pieEducation() {
  $.ajax({
    type: 'POST',
    url: baseurl + 'hr/pieEducation',
    success: function (value) {
      var data = new google.visualization.DataTable();
      // Add legends with data type
      data.addColumn('string', 'name');
      data.addColumn('number', 'count');
      //Parse data into Json
      var jsonData = $.parseJSON(value);
      for (var i = 0; i < jsonData.length; i++) {
        data.addRow([jsonData[i].name, parseInt(jsonData[i].count)]);
      }

      var options = {
        'legend': 'bottom',
        is3D: true,
        // pieSliceText: 'value-and-percentage',
        // legend: { position: 'labeled' },
        // backgroundColor: 'transparent'
      };
      var chart = new google.visualization.PieChart(document.getElementById('pieEducation'));
      chart.draw(data, options);
    }
  });
}
$(window).resize(function () {
  pieEducation();
});

// Load the Visualization API and the line package.
google.charts.load('current', {
  'packages': ['corechart']
});
// Set a callback to run when the Google Visualization API is loaded.
google.charts.setOnLoadCallback(pieGen);

function pieGen() {
  $.ajax({
    type: 'POST',
    url: baseurl + 'hr/pieGen',
    success: function (value) {
      var data = new google.visualization.DataTable();
      // Add legends with data type
      data.addColumn('string', 'name');
      data.addColumn('number', 'count');
      //Parse data into Json
      var jsonData = $.parseJSON(value);
      for (var i = 0; i < jsonData.length; i++) {
        data.addRow([jsonData[i].name, parseInt(jsonData[i].count)]);
      }

      var options = {
        'legend': 'bottom',
        is3D: true,
        // pieSliceText: 'value-and-percentage',
        // legend: { position: 'labeled' },
        // backgroundColor: 'transparent'
      };
      var chart = new google.visualization.PieChart(document.getElementById('pieGen'));
      chart.draw(data, options);
    }
  });
}
$(window).resize(function () {
  pieGen();
});

// Load the Visualization API and the line package.
google.charts.load('current', {
  'packages': ['corechart']
});
// Set a callback to run when the Google Visualization API is loaded.
google.charts.setOnLoadCallback(pieLavel);

function pieLavel() {
  $.ajax({
    type: 'POST',
    url: baseurl + 'hr/pieLavel',
    success: function (value) {
      var data = new google.visualization.DataTable();
      // Add legends with data type
      data.addColumn('string', 'name');
      data.addColumn('number', 'count');
      //Parse data into Json
      var jsonData = $.parseJSON(value);
      for (var i = 0; i < jsonData.length; i++) {
        data.addRow([jsonData[i].name, parseInt(jsonData[i].count)]);
      }

      var options = {
        'legend': 'bottom',
        is3D: true,
        // pieSliceText: 'value-and-percentage',
        // legend: { position: 'labeled' },
        // backgroundColor: 'transparent'
      };
      var chart = new google.visualization.PieChart(document.getElementById('pieLavel'));
      chart.draw(data, options);
    }
  });
}
$(window).resize(function () {
  pieLavel();
});

$(document).ready(function () {
  var table = $('#tbl-listings').DataTable({
    responsive: true,
    scrollX: true,
    iDisplayLength: 25,
    processing: true,
    serverSide: true,
    order: [],
    ajax: {
      url: baseurl + 'hr/ajaxListings',
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
        width: "8%"
      },
      {
        targets: 1,
        className: "text-center",
        width: "12%"
      },
      {
        targets: 2,
        className: "text-left",
        width: "25%"
      },
      {
        responsivePriority: 2,
        targets: 3,
        className: "text-left",
        width: "25%",
      },
      {
        responsivePriority: 1,
        targets: 4,
        className: "text-left",
        width: "20%",
      },
      {
        targets: 5,
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

$(document).ready(function () {
  var table = $('#tbl-discard').DataTable({
    responsive: true,
    scrollX: true,
    iDisplayLength: 10,
    processing: true,
    serverSide: true,
    order: [],
    ajax: {
      url: baseurl + 'hr/ajaxDiscard',
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
        width: "8%"
      },
      {
        targets: 1,
        className: "text-center",
        width: "12%"
      },
      {
        targets: 2,
        className: "text-left",
        width: "25%"
      },
      {
        responsivePriority: 2,
        targets: 3,
        className: "text-left",
        width: "25%",
      },
      {
        responsivePriority: 1,
        targets: 4,
        className: "text-left",
        width: "20%",
      },
      {
        targets: 5,
        className: "text-center",
        width: "10%"
      }
    ],
  });
});

$(document).ready(function () {
  var table = $('#tbl-category').DataTable({
    responsive: true,
    scrollX: true,
    iDisplayLength: 25,
    lengthMenu: [
      [5, 10, 25, 50, 100],
      [5, 10, 25, 50, 100]
    ],
    columnDefs: [{
        targets: 0,
        className: "text-center",
        width: "8%"
      },
      {
        targets: 1,
        className: "text-center",
        width: "12%"
      },
      {
        targets: 2,
        className: "text-left",
        width: "25%"
      },
      {
        responsivePriority: 2,
        targets: 3,
        className: "text-left",
        width: "25%",
      },
      {
        responsivePriority: 1,
        targets: 4,
        className: "text-left",
        width: "20%",
      },
      {
        targets: 5,
        className: "text-center",
        width: "10%"
      }
    ],

  });
});

// tinymce.init({
//   mode: "textareas",
//   selector: "#master",
//   theme: "silver",
//   setup: function (editor) {
//     editor.on('change', function () {
//       tinymce.triggerSave();
//     });
//   },
//   height: 360,
//   plugins: [
//     "advlist autolink link image lists charmap print preview hr anchor pagebreak",
//     "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
//     "table contextmenu directionality emoticons paste textcolor responsivefilemanager code"
//   ],
//   toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
//   toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
//   image_advtab: true,

//   // external_filemanager_path: "https://apps.anamai.moph.go.th/e-service/public/node_modules/resources/filemanager/",
//   external_filemanager_path: baseurl + "node_modules/resources/filemanager/",
//   filemanager_title: "Responsive Filemanager",
//   external_plugins: {
//     "filemanager": "../filemanager/plugin.min.js"
//   },
//   relative_urls: false,
//   remove_script_host: false,
//   document_base_url: baseurl
// });

tinymce.init({
  mode: "textareas",
  selector: "#hrNote",
  theme: "silver",
  setup: function (editor) {
    editor.on('change', function () {
      tinymce.triggerSave();
    });
  },
  height: 360,
  plugins: [
    "advlist autolink link image lists charmap print preview hr anchor pagebreak",
    "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
    "table contextmenu directionality emoticons paste textcolor responsivefilemanager code"
  ],
  toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
  toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
  image_advtab: true,

  // external_filemanager_path: "https://apps.anamai.moph.go.th/e-service/public/node_modules/resources/filemanager/",
  external_filemanager_path: baseurl + "node_modules/resources/filemanager/",
  filemanager_title: "Responsive Filemanager",
  external_plugins: {
    "filemanager": "../filemanager/plugin.min.js"
  },
  relative_urls: false,
  remove_script_host: false,
  document_base_url: baseurl
});

tinymce.init({
  mode: "textareas",
  selector: "#retireDetail",
  theme: "silver",
  setup: function (editor) {
    editor.on('change', function () {
      tinymce.triggerSave();
    });
  },
  height: 360,
  plugins: [
    "advlist autolink link image lists charmap print preview hr anchor pagebreak",
    "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
    "table contextmenu directionality emoticons paste textcolor responsivefilemanager code"
  ],
  toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
  toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
  image_advtab: true,

  // external_filemanager_path: "https://apps.anamai.moph.go.th/e-service/public/node_modules/resources/filemanager/",
  external_filemanager_path: baseurl + "node_modules/resources/filemanager/",
  filemanager_title: "Responsive Filemanager",
  external_plugins: {
    "filemanager": "../filemanager/plugin.min.js"
  },
  relative_urls: false,
  remove_script_host: false,
  document_base_url: baseurl
});

// hr transfer users
jQuery(document).on('click', 'button#transfer-submit', function () {
  var files = $('#attachment')[0].files;
  var error = '';
  var formData = new FormData();
  for (var count = 0; count < files.length; count++) {
    var name = files[count].name;
    var extension = name.split('.').pop().toLowerCase();
    if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg', 'pdf']) == -1) {
      error += "Invalid " + count + " File"
    } else {
      formData.append("attachment[]", files[count]);
    }
  }

  formData.append('hospcode', jQuery('form#hr-transfer-form').find('.input-hospcode').val());
  formData.append('retire', jQuery('form#hr-transfer-form').find('.input-retire').val());
  formData.append('retireDate', jQuery('form#hr-transfer-form').find('.input-retireDate').val());
  formData.append('retireDetail', jQuery('form#hr-transfer-form').find('.input-retireDetail').val());


  if (error == '') {
    jQuery.ajax({
      type: 'POST',
      data: formData,
      url: baseurl + 'hr/transferUsers',
      dataType: 'json',
      contentType: false,
      processData: false,

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
          // alert('ID'+json['Hospcode']);
          jQuery('#loading-modal').modal();
          setTimeout(function () {
            location.replace(baseurl + "hr/profile/" + json['Hospcode'])
          }, 3000);

          jQuery('form#hr-transfer-form').find('textarea, input').each(function () {
            jQuery(this).val('');
          });
          jQuery('#transfer-submit').modal('hide');

        }

      },
      error: function (xhr, ajaxOptions, thrownError) {
        console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
      }
    });
  } else {
    alert(error);
  }
});

// set id users
jQuery(document).on('click', 'a.reset-passwd-details', function(){
  var id = jQuery(this).data('getid');
  // window.alert(id);
  jQuery('button#reset-passwd-user').data('userId', id);

});

// reset passwd users
jQuery(document).on('click', 'button#reset-passwd-user', function(){
  var id = jQuery(this).data('userId');
  jQuery.ajax({
      type:'POST',
      url:baseurl+'hr/resetPasswd',
      data:{id: id},
      dataType:'html',         
      complete: function () {           
          jQuery('#reset-passwd').modal('hide');
      }, 
      success: function () {
        jQuery('#loading-modal').modal();
        setTimeout(function () {
          location.replace(baseurl + "hr/profile/" + id)
        }, 3000);
                               
      },
      error: function (xhr, ajaxOptions, thrownError) {
          console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
      }        
  });
});