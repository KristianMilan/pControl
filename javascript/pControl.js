function updates() {
    $.ajax({
        type: "POST",
        url: "ajax.php",
        dataType: 'json',
        data: {
            action: 'updates'

        },
        success: function(json) {
            $('.temp').empty().append(json['updates']['temp']);
            $('.ip').empty().append(json['updates']['ip']);
        },
        error: function() {

            showCommunicationError();
            //$('.loading-dimmer').removeClass('active');
        }
    });
}

function bindToDevices() {
    //all on
    $('.all-on').on('click', function() {
        //alert('trol');
        $('.device-toggle').prop('checked', true).trigger('change');
    });
    //end all on
    //all off
    $('.all-off').on('click', function() {
        $('.device-toggle').prop('checked', false).trigger('change');
    });
    //end all off
    $('.device-toggle').on('change', function() {
        console.log('loool');
        var id1 = $(this).data('device-id');
        var state1 = $(this).is(':checked');
        $.ajax({
            type: "POST",
            url: "ajax.php",
            dataType: 'json',
            data: {
                action: 'devicechange',
                id: id1,
                state: state1
            },
            success: function(json) {
                if (json['success'] == true) {

                } else {
                    showCommunicationError();
                }
            },
            error: function() {

                showCommunicationError();
                //$('.loading-dimmer').removeClass('active');
            }
        });
    });

    $('.device-delete').on('click', function() {
        //console.log('loool');
        var id1 = $(this).data('id');
        //var state1 = $(this).is(':checked');
        $.ajax({
            type: "POST",
            url: "ajax.php",
            dataType: 'json',
            data: {
                action: 'deletedevice',
                id: id1
            },
            success: function(json) {
                if (json['success'] == true) {

                    initload();
                    bindToDevices();
                } else {
                    showCommunicationError();
                }
            },
            error: function() {

                showCommunicationError();
                //$('.loading-dimmer').removeClass('active');
            }
        });
    });

    $('.category-delete').on('click', function() {
        //console.log('loool');
        var id1 = $(this).data('id');
        //var state1 = $(this).is(':checked');
        $.ajax({
            type: "POST",
            url: "ajax.php",
            dataType: 'json',
            data: {
                action: 'deletecategory',
                id: id1
            },
            success: function(json) {
                if (json['success'] == true) {

                    initload();
                    bindToDevices();
                } else {
                    showCommunicationError();
                }
            },
            error: function() {

                showCommunicationError();
                //$('.loading-dimmer').removeClass('active');
            }
        });
    });
}

function initload() {
    $.ajax({
        type: "POST",
        url: "ajax.php",
        dataType: 'json',
        data: {
            action: 'initload'

        },
        success: function(json) {



            $('.switch-container').empty().append(json['devices']);
            $('.connect-table').empty().append(json['devices-table']);
            $('.category-table').empty().append(json['categories-table']);
            $('.ui.checkbox').checkbox();
            bindToDevices();
        },
        error: function() {

            showCommunicationError();
            //$('.loading-dimmer').removeClass('active');
        }
    });

}

function showLoginModal() {

    $('.login-modal').modal('setting', {
        closable: false,
        onApprove: function() {
            if ($('.login-username').val() == '' || $('.login-password').val() == '') {
                //alert('ddd');
                $('.login-please-fill').removeClass('hidden').transition('slide down', '0ms').transition('slide down', '1000ms');
                $('.login-modal').transition('shake', '500ms');


            } else {
                $.ajax({
                    type: "POST",
                    url: "ajax.php",
                    dataType: 'json',
                    data: {
                        action: 'login',
                        username: $('.login-username').val(),
                        password: $('.login-password').val()

                    },
                    success: function(json) {
                        if (json['success'] == true) {
                            $('.login-modal').modal('hide');
                            $('.set-username').empty().append(json['username']);
                            initload();
                            bindToDevices();
                        } else {
                            $('.login-wrong-data').removeClass('hidden').transition('slide down', '0ms').transition('slide down', '1000ms');
                            $('.login-modal').transition('shake', '500ms');
                        }
                    },
                    error: function() {

                        showCommunicationError();
                        //$('.loading-dimmer').removeClass('active');
                    }
                });


            }
            return false;
        }
    }).modal('show');
}

function showCommunicationError() {

    $('.communication-error-modal').modal('show');
}
$(function() {
    $('.message .close').on('click', function() {
        $(this).closest('.message').fadeOut();
    });
    $('.logout').on('click', function() {
        $.ajax({
            type: "POST",
            url: "ajax.php",
            dataType: 'json',
            data: {
                action: 'logout'
            },
            success: function(json) {
                if (json['success'] == true) {
                    location.reload();
                } else {
                    showCommunicationError();
                }
            },
            error: function() {

                showCommunicationError();
                //$('.loading-dimmer').removeClass('active');
            }
        });
    });
    //shutdown
    $('.shutdown').on('click', function() {
        $('.shutdown-modal')
            .modal('setting', {
                closable: false,
                onDeny: function() {

                },
                onApprove: function() {
                    $.ajax({
                        type: "POST",
                        url: "ajax.php",
                        dataType: 'json',
                        data: {
                            action: 'shutdown'
                        },
                        success: function(json) {
                            if (json['success'] == true) {
                                location.reload();
                            } else {
                                showCommunicationError();
                            }
                        },
                        error: function() {

                            showCommunicationError();

                        }
                    });
                }
            })
            .modal('show')
    });
    //reboot

    $('.reboot').on('click', function() {
        $('.reboot-modal')
            .modal('setting', {
                closable: false,
                onDeny: function() {

                },
                onApprove: function() {
                    $.ajax({
                        type: "POST",
                        url: "ajax.php",
                        dataType: 'json',
                        data: {
                            action: 'reboot'
                        },
                        success: function(json) {
                            if (json['success'] == true) {
                                location.reload();
                            } else {
                                showCommunicationError();
                            }
                        },
                        error: function() {

                            showCommunicationError();

                        }
                    });
                }
            })
            .modal('show')
    });
    //end reboot
    //add device

    $('.add-device').on('click', function() {
        $('.add-device-modal')
            .modal('setting', {
                closable: false,
                onDeny: function() {

                },
                onApprove: function() {
                    $.ajax({
                        type: "POST",
                        url: "ajax.php",
                        dataType: 'json',
                        data: {
                            action: 'adddevice',
                            pin: $('.add-device-modal-pin').val(),
                            description: $('.add-device-modal-description').val(),
                            inveretd: $('.add-device-modal-inverted').is(':checked'),
                        },
                        success: function(json) {
                            if (json['success'] == true) {

                                initload();


                            } else {
                                showCommunicationError();
                            }
                        },
                        error: function() {

                            showCommunicationError();

                        }
                    });
                }
            })
            .modal('show');
    });
    //end add device

    //add device
    $('.add-category').on('click', function() {
        $('.add-category-modal')
            .modal('setting', {
                closable: false,
                onDeny: function() {

                },
                onApprove: function() {
                    $.ajax({
                        type: "POST",
                        url: "ajax.php",
                        dataType: 'json',
                        data: {
                            action: 'addcategory',
                            name: $('.add-category-modal-name').val(),
                            column: $('.add-category-modal-column').val()
                        },
                        success: function(json) {
                            if (json['success'] == true) {

                                initload();


                            } else {
                                showCommunicationError();
                            }
                        },
                        error: function() {

                            showCommunicationError();

                        }
                    });
                }
            })
            .modal('show');
    });
    //end add device


    //console

    $('.console-submit').on('click', function() {
        $.ajax({
            type: "POST",
            url: "ajax.php",
            dataType: 'json',
            data: {
                action: 'console',
                command: $('.console-input').val()
            },
            success: function(json) {
                if (json['success'] == true) {
                    $('.console').append(json['response'] + '\n');
                    $('.console-input').val('');
                } else {
                    showCommunicationError();
                }
            },
            error: function() {

                showCommunicationError();
                //$('.loading-dimmer').removeClass('active');
            }
        });
    });
    //end console

    //tabs
    $('.shape-control').click(function() {
        $('.shape-control').removeClass('active');
        $(this).addClass('active');
        $('.shape')
            .shape('set next side', $(this).data('side'))
            .shape('flip left');
    });
    //end tabs
    //check auth
    $.ajax({
        type: "POST",
        url: "ajax.php",
        dataType: 'json',
        data: {
            action: 'checkauth'
        },
        success: function(json) {
            if (json['success'] == true) {
                if (json['isauthed'] == true) {
                    $('.set-username').empty().append(json['username']);
                    initload();

                } else {
                    showLoginModal();
                }
            } else {
                showCommunicationError();
            }
        },
        error: function() {

            showCommunicationError();
            //$('.loading-dimmer').removeClass('active');
        }
    });
    $('.ui.dropdown').dropdown();
    $('.ui.checkbox').checkbox();
    setInterval(function() {
        updates();
    }, 2000);

});
//end check auth
