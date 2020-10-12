$('#input-avatar').aceFileInput({

  btnChooseClass: 'bgc-grey-l2 pt-15 px-2 my-1px mr-1px',
  btnChooseText: 'เลือกไฟล์',
  placeholderText: 'ยังไม่มีไฟล์ (jpg png, gif)',
  placeholderIcon: '<i class="fas fa-folder-open bgc-warning-m1 text-white w-4 py-2 text-center"></i> '

})

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $('#input-avatar-tag').attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
  }
}
$("#input-avatar").change(function () {
  readURL(this);
});

// Edit Passwd
jQuery(document).on('click', 'a.passwd-user-details', function () {
  var hospcode = jQuery(this).data('getcode');
  // alert(hospcode);
  // exit;
  jQuery.ajax({
    type: 'POST',
    url: baseurl + 'users/changePasswd',
    data: {
      hospcode: hospcode
    },
    dataType: 'html',
    beforeSend: function () {
      jQuery('#render-passwd-user').html('<div class="text-center"><i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i></div>');
    },
    success: function (html) {
      jQuery('#render-passwd-user').html(html);
    },
    error: function (xhr, ajaxOptions, thrownError) {
      console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
});

// user passwd update
jQuery(document).on('click', 'button#passwd-user', function () {
  jQuery.ajax({
    type: 'POST',
    url: baseurl + 'users/updatePasswd',
    data: jQuery("form#passwd-user-form").serialize(),
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
          location.replace(baseurl + "users/profile")
        }, 3000);

        jQuery('form#passwd-user-form').find('textarea, input').each(function () {
          jQuery(this).val('');
        });
        jQuery('#passwd-user').modal('hide');

      }

    },
    error: function (xhr, ajaxOptions, thrownError) {
      console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
});

// user edit submit
// jQuery(document).on('click', 'button#user-edit-submit', function () {
//   jQuery.ajax({
//     type: 'POST',
//     url: baseurl + 'users/updateUser',
//     data: jQuery("form#user-edit-form").serialize(),
//     dataType: 'json',

//     success: function (json) {

//       //console.log(json);
//       $('.text-danger').remove();
//       if (json['error']) {
//         for (i in json['error']) {
//           var element = $('.input-' + i.replace('_', '-'));
//           if ($(element).parent().hasClass('input-group')) {
//             $(element).parent().after('<div class="text-danger" style="font-size: 14px;">' + json['error'][i] + '</div>');
//           } else {
//             $(element).after('<div class="text-danger" style="font-size: 14px;">' + json['error'][i] + '</div>');
//           }
//         }
//       } else {
//         // alert('ID'+json['Hospcode']);
//         jQuery('#loading-modal').modal();
//         setTimeout(function () {
//           location.replace(baseurl + "users/profile")
//         }, 3000);

//         jQuery('form#user-edit-form').find('textarea, input').each(function () {
//           jQuery(this).val('');
//         });
//         jQuery('#user-edit-submit').modal('hide');

//       }

//     },
//     error: function (xhr, ajaxOptions, thrownError) {
//       console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
//     }
//   });
// });

jQuery(document).on('click', 'button#user-edit-submit', function () {
  var formData = new FormData($("#user-edit-form")[0]);

  jQuery.ajax({
    url: baseurl + 'users/updateUser',
    type: 'post',
    data: formData,
    cache: false,
    processData: false,
    contentType: false,
    dataType: 'json',
    beforeSend: function () {
    },
    complete: function () {
    },
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
        jQuery('#loading-modal').modal();
        setTimeout(function () {
          location.replace(baseurl + "users/profile")
        }, 3000);

        jQuery('form#user-edit-form').find('textarea, input').each(function () {
          jQuery(this).val('');
        });
        jQuery('#user-edit-submit').modal('hide');

      }

    },
    error: function (xhr, ajaxOptions, thrownError) {
      console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
});