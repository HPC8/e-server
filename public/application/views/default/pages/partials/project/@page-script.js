$(document).ready(function () {
    var table = $('#tbl-planList').DataTable({
        scrollX: true,
        iDisplayLength: 25,
        lengthMenu: [
            [5, 10, 25, 50, 100],
            [5, 10, 25, 50, 100]
        ],
        columnDefs: [{
                targets: 0,
                className: "text-center",
                width: "10%"
            },
            {
                targets: 1,
                className: "text-left",
                width: "53%"
            },
            {
                targets: 2,
                className: "text-left",
                width: "25%"
            },
            {
                targets: 3,
                className: "text-center",
                width: "12%"
            }
        ],

    });
});

// ----------------------------------------start plan------------------------------------------------ //
// add plan
jQuery(document).on('click', 'button#add-plan', function () {
    jQuery.ajax({
        type: 'POST',
        url: baseurl + 'project/addPlan',
        data: jQuery("form#add-plan-form").serialize(),
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
                if (json['access'] != 'denied') {
                    jQuery('#loading-modal').modal();
                    setTimeout(function () {
                        location.replace(baseurl + "project/plan")
                    }, 3000);
                } else {
                    location.replace(baseurl + "project/plan")
                }
                // alert('ID'+json['Hospcode']);


                jQuery('form#add-plan-form').find('textarea, input').each(function () {
                    jQuery(this).val('');
                });
                jQuery('#add-plan').modal('hide');

            }

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});

// view plan
jQuery(document).on('click', 'a.view-plan', function () {
    var id = jQuery(this).data('getid');
    jQuery.ajax({
        type: 'POST',
        url: baseurl + 'project/viewPlan',
        data: {
            id: id
        },
        dataType: 'html',
        beforeSend: function () {
            jQuery('#render-view-plan').html('<div class="text-center"><i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i></div>');
        },
        success: function (html) {
            jQuery('#render-view-plan').html(html);

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});

// edit Plan
jQuery(document).on('click', 'a.edit-plan-details', function () {
    var id = jQuery(this).data('getid');
    jQuery.ajax({
        type: 'POST',
        url: baseurl + 'project/editPlan',
        data: {
            id: id
        },
        dataType: 'html',
        beforeSend: function () {
            jQuery('#render-edit-plan').html('<div class="text-center"><i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i></div>');
        },
        success: function (html) {
            jQuery('#render-edit-plan').html(html);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});

// update plan
jQuery(document).on('click', 'button#edit-plan', function () {
    jQuery.ajax({
        type: 'POST',
        url: baseurl + 'project/updatePlan',
        data: jQuery("form#edit-plan-form").serialize(),
        dataType: 'json',

        success: function (json) {
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
                if (json['access'] != 'denied') {
                    jQuery('#loading-modal').modal();
                    setTimeout(function () {
                        location.replace(baseurl + "project/plan")
                    }, 3000);
                } else {
                    location.replace(baseurl + "project/plan")
                }
                jQuery('form#edit-plan-form').find('textarea, input').each(function () {
                    jQuery(this).val('');
                });
                jQuery('#edit-plan').modal('hide');

            }

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});

// set id plan for trash 
jQuery(document).on('click', 'a.trash-plan-details', function () {
    var id = jQuery(this).data('getid');
    jQuery('button#trash-plan').data('trashId', id);

});

// trash plan
jQuery(document).on('click', 'button#trash-plan', function () {
    var id = jQuery(this).data('trashId');
    jQuery.ajax({
        type: 'POST',
        url: baseurl + 'project/trashPlan',
        data: {
            id: id
        },
        dataType: 'json',
        complete: function () {
            jQuery('#trash-plan').modal('hide');
        },
        success: function (json) {
            if (json['access'] != 'denied') {
                jQuery('#loading-modal').modal();
                setTimeout(function () {
                    location.replace(baseurl + "project/plan")
                }, 3000);
            } else {
                location.replace(baseurl + "project/plan")
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});

// ----------------------------------------end plan------------------------------------------------ //


// ----------------------------------------start product------------------------------------------------ //
// add product
jQuery(document).on('click', 'button#add-product', function () {
    jQuery.ajax({
        type: 'POST',
        url: baseurl + 'project/addProduct',
        data: jQuery("form#add-product-form").serialize(),
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
                if (json['access'] != 'denied') {
                    jQuery('#loading-modal').modal();
                    setTimeout(function () {
                        location.replace(baseurl + "project/product")
                    }, 3000);
                } else {
                    location.replace(baseurl + "project/product")
                }
                jQuery('form#add-product-form').find('textarea, input').each(function () {
                    jQuery(this).val('');
                });
                jQuery('#add-product').modal('hide');

            }

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});

// view product
jQuery(document).on('click', 'a.view-product', function () {
    var id = jQuery(this).data('getid');
    jQuery.ajax({
        type: 'POST',
        url: baseurl + 'project/viewProduct',
        data: {
            id: id
        },
        dataType: 'html',
        beforeSend: function () {
            jQuery('#render-view-product').html('<div class="text-center"><i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i></div>');
        },
        success: function (html) {
            jQuery('#render-view-product').html(html);

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});

// edit product
jQuery(document).on('click', 'a.edit-product-details', function () {
    var id = jQuery(this).data('getid');
    var year = jQuery(this).data('getyear');

    jQuery.ajax({
        type: 'POST',
        url: baseurl + 'project/editProduct',
        data: {
            id: id,
            year: year,
        },
        dataType: 'html',
        beforeSend: function () {
            jQuery('#render-edit-product').html('<div class="text-center"><i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i></div>');
        },
        success: function (html) {
            jQuery('#render-edit-product').html(html);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});

// update product
jQuery(document).on('click', 'button#edit-product', function () {
    jQuery.ajax({
        type: 'POST',
        url: baseurl + 'project/updateProduct',
        data: jQuery("form#edit-product-form").serialize(),
        dataType: 'json',

        success: function (json) {
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
                if (json['access'] != 'denied') {
                    jQuery('#loading-modal').modal();
                    setTimeout(function () {
                        location.replace(baseurl + "project/product")
                    }, 3000);
                } else {
                    location.replace(baseurl + "project/product")
                }
                jQuery('form#edit-product-form').find('textarea, input').each(function () {
                    jQuery(this).val('');
                });
                jQuery('#edit-product').modal('hide');

            }

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});

// set id product for trash 
jQuery(document).on('click', 'a.trash-product-details', function () {
    var id = jQuery(this).data('getid');
    jQuery('button#trash-product').data('trashId', id);

});

// trash product
jQuery(document).on('click', 'button#trash-product', function () {
    var id = jQuery(this).data('trashId');
    jQuery.ajax({
        type: 'POST',
        url: baseurl + 'project/trashProduct',
        data: {
            id: id
        },
        dataType: 'json',
        complete: function () {
            jQuery('#trash-product').modal('hide');
        },
        success: function (json) {
            if (json['access'] != 'denied') {
                jQuery('#loading-modal').modal();
                setTimeout(function () {
                    location.replace(baseurl + "project/product")
                }, 3000);
            } else {
                location.replace(baseurl + "project/product")
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});

// ----------------------------------------end product------------------------------------------------ //

// ----------------------------------------start activity------------------------------------------------ //
// add activity
jQuery(document).on('click', 'button#add-activity', function () {
    jQuery.ajax({
        type: 'POST',
        url: baseurl + 'project/addActivity',
        data: jQuery("form#add-activity-form").serialize(),
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
                if (json['access'] != 'denied') {
                    jQuery('#loading-modal').modal();
                    setTimeout(function () {
                        location.replace(baseurl + "project/activity")
                    }, 3000);
                } else {
                    location.replace(baseurl + "project/activity")
                }
                jQuery('form#add-activity-form').find('textarea, input').each(function () {
                    jQuery(this).val('');
                });
                jQuery('#add-activity').modal('hide');

            }

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});

// view activity
jQuery(document).on('click', 'a.view-activity', function () {
    var id = jQuery(this).data('getid');
    jQuery.ajax({
        type: 'POST',
        url: baseurl + 'project/viewActivity',
        data: {
            id: id
        },
        dataType: 'html',
        beforeSend: function () {
            jQuery('#render-view-activity').html('<div class="text-center"><i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i></div>');
        },
        success: function (html) {
            jQuery('#render-view-activity').html(html);

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});

// edit activity
jQuery(document).on('click', 'a.edit-activity-details', function () {
    var id = jQuery(this).data('getid');
    var year = jQuery(this).data('getyear');

    jQuery.ajax({
        type: 'POST',
        url: baseurl + 'project/editActivity',
        data: {
            id: id,
            year: year,
        },
        dataType: 'html',
        beforeSend: function () {
            jQuery('#render-edit-activity').html('<div class="text-center"><i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i></div>');
        },
        success: function (html) {
            jQuery('#render-edit-activity').html(html);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});

// update activity
jQuery(document).on('click', 'button#edit-activity', function () {
    jQuery.ajax({
        type: 'POST',
        url: baseurl + 'project/updateActivity',
        data: jQuery("form#edit-activity-form").serialize(),
        dataType: 'json',

        success: function (json) {
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
                if (json['access'] != 'denied') {
                    jQuery('#loading-modal').modal();
                    setTimeout(function () {
                        location.replace(baseurl + "project/activity")
                    }, 3000);
                } else {
                    location.replace(baseurl + "project/activity")
                }
                jQuery('form#edit-activity-form').find('textarea, input').each(function () {
                    jQuery(this).val('');
                });
                jQuery('#edit-activity').modal('hide');

            }

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});

// set id activity for trash 
jQuery(document).on('click', 'a.trash-activity-details', function () {
    var id = jQuery(this).data('getid');
    jQuery('button#trash-activity').data('trashId', id);

});

// trash activity
jQuery(document).on('click', 'button#trash-activity', function () {
    var id = jQuery(this).data('trashId');
    jQuery.ajax({
        type: 'POST',
        url: baseurl + 'project/trashActivity',
        data: {
            id: id
        },
        dataType: 'json',
        complete: function () {
            jQuery('#trash-activity').modal('hide');
        },
        success: function (json) {
            if (json['access'] != 'denied') {
                jQuery('#loading-modal').modal();
                setTimeout(function () {
                    location.replace(baseurl + "project/activity")
                }, 3000);
            } else {
                location.replace(baseurl + "project/activity")
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});

// ----------------------------------------end activity------------------------------------------------ //

// ----------------------------------------start program------------------------------------------------ //
// add program
jQuery(document).on('click', 'button#add-program', function () {
    jQuery.ajax({
        type: 'POST',
        url: baseurl + 'project/addProgram',
        data: jQuery("form#add-program-form").serialize(),
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
                if (json['access'] != 'denied') {
                    jQuery('#loading-modal').modal();
                    setTimeout(function () {
                        location.replace(baseurl + "project/program")
                    }, 3000);
                } else {
                    location.replace(baseurl + "project/program")
                }
                jQuery('form#add-program-form').find('textarea, input').each(function () {
                    jQuery(this).val('');
                });
                jQuery('#add-program').modal('hide');

            }

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});

// view program
jQuery(document).on('click', 'a.view-program', function () {
    var id = jQuery(this).data('getid');
    jQuery.ajax({
        type: 'POST',
        url: baseurl + 'project/viewProgram',
        data: {
            id: id
        },
        dataType: 'html',
        beforeSend: function () {
            jQuery('#render-view-program').html('<div class="text-center"><i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i></div>');
        },
        success: function (html) {
            jQuery('#render-view-program').html(html);

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});

// edit program
jQuery(document).on('click', 'a.edit-program-details', function () {
    var id = jQuery(this).data('getid');
    var year = jQuery(this).data('getyear');

    jQuery.ajax({
        type: 'POST',
        url: baseurl + 'project/editProgram',
        data: {
            id: id,
            year: year,
        },
        dataType: 'html',
        beforeSend: function () {
            jQuery('#render-edit-program').html('<div class="text-center"><i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i></div>');
        },
        success: function (html) {
            jQuery('#render-edit-program').html(html);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});

// update program
jQuery(document).on('click', 'button#edit-program', function () {
    jQuery.ajax({
        type: 'POST',
        url: baseurl + 'project/updateProgram',
        data: jQuery("form#edit-program-form").serialize(),
        dataType: 'json',

        success: function (json) {
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
                if (json['access'] != 'denied') {
                    jQuery('#loading-modal').modal();
                    setTimeout(function () {
                        location.replace(baseurl + "project/program")
                    }, 3000);
                } else {
                    location.replace(baseurl + "project/program")
                }
                jQuery('form#edit-program-form').find('textarea, input').each(function () {
                    jQuery(this).val('');
                });
                jQuery('#edit-program').modal('hide');

            }

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});

// set id program for trash 
jQuery(document).on('click', 'a.trash-program-details', function () {
    var id = jQuery(this).data('getid');
    jQuery('button#trash-program').data('trashId', id);

});

// trash program
jQuery(document).on('click', 'button#trash-program', function () {
    var id = jQuery(this).data('trashId');
    jQuery.ajax({
        type: 'POST',
        url: baseurl + 'project/trashProgram',
        data: {
            id: id
        },
        dataType: 'json',
        complete: function () {
            jQuery('#trash-program').modal('hide');
        },
        success: function (json) {
            if (json['access'] != 'denied') {
                jQuery('#loading-modal').modal();
                setTimeout(function () {
                    location.replace(baseurl + "project/program")
                }, 3000);
            } else {
                location.replace(baseurl + "project/program")
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});

// ----------------------------------------end program------------------------------------------------ //