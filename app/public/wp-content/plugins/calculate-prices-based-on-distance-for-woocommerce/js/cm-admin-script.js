"use strict";
jQuery(function($){

    var cm_time_interval = $('input[name="cm_time_interval"]').val();
    if (cm_time_interval==0||cm_time_interval=='0') {
        $('input[name="cm_time_interval"]').val('');
    }

    //saving the form fields
    $('.cm-save-admin-settings').submit(function(e){
        e.preventDefault();
        var data = $(this).serialize();
        var submit_btn = $("input[type='submit']", this);
        submit_btn.css({'width' : '100px'});
        submit_btn.val("Please Wait...").attr('disabled', true);
        $.post(ajax_vars.ajax_url, data, function(resp){
            swal({
                title: 'Settings Saved Successfully',
                icon: "success",
            }).then(function(){
                window.location.reload();
            })
        });
    });

    $( function() {
    $( "#cm-tabs" ).tabs();
  } );

    //Appending The Cost/distance Input
    $(document).on('click', '.wccpd-add-cost', function(e){
        e.preventDefault();

        var selector = $(this).closest('.wccpd-clone-tr');
        
        var clone_div = $(this).closest(selector);
        var clone_item = clone_div.clone();
        clone_item.find(':input').val('');
        clone_div.after(clone_item);
    });

    // hiding the appending input of cost/distance on admin side
    $(document).on('click', '.wccpd-remove-cost', function(e){
        e.preventDefault();
        var hide_check = $('.wccpd-clone-tr').length;
        
        if (hide_check == 1) {
            swal({
                title: 'Oopss... Cannot Remove This!',
                icon: "error",
            })
        }
        else{
            var selector = $(this).closest('.wccpd-clone-tr');
            selector.remove();
        }
    })

    //Appending The Time(Disable) Input
    $(document).on('click', '.cm-add-time-input', function(e){
        e.preventDefault();

        var selector = $(this).closest('.cm-disable-time');
        
        var clone_div = $(this).closest(selector);
        var clone_item = clone_div.clone();
        clone_item.find(':input').val('');
        clone_div.after(clone_item);
    });

    // hiding the appending input of time on admin side
    $(document).on('click', '.cm-remove-time-input', function(e){
        e.preventDefault();
        var hide_check = $('.cm-remove-time-input').length;
        
        if (hide_check == 1) {
            swal({
                title: 'Oopss... Cannot Remove This!',
                icon: "error",
            })
        }
        else{
            var selector = $(this).closest('.cm-disable-time');
            selector.remove();
        }
    })

    //Appending The Date(Disable) Input
    $(document).on('click', '.cm-add-date-input', function(e){
        e.preventDefault();

        var selector = $(this).closest('.cm-disable-date');
        
        var clone_div = $(this).closest(selector);
        var clone_item = clone_div.clone();
        clone_item.find(':input').val('');
        clone_div.after(clone_item);
    });

    // hiding the appending input of Date on admin side
    $(document).on('click', '.cm-remove-date-input', function(e){
        e.preventDefault();
        var hide_check = $('.cm-remove-date-input').length;
        
        if (hide_check == 1) {
            swal({
                title: 'Oopss... Cannot Remove This!',
                icon: "error",
            })
        }
        else{
            var selector = $(this).closest('.cm-disable-date');
            selector.remove();
        }
    })

})