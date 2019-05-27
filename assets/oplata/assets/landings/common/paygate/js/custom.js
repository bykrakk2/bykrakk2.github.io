$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();

    $('[data-toggle="popover"]').popover({
        trigger : 'hover',
        placement: "top",
    });

    // Сбрасываем GATE что бы не юзать версию из кеша
    $('#chosen-gate').val(default_gate);

     if( $('#ask_number').val() == 'true' ) {
        $('#phone').val('');

        telInput = $("#phone_full");

        allow_countries = ["IN", "AZ", "KR", "EE", "BY", "AM", "GB", "UZ", "IL", "TH", "TR", "JP", "US", "PA", "RU", "KZ", "UA", "LV", "LT", "KG", "GE", "TJ", "MD", "VN"];

        telInput.intlTelInput({
            preferredCountries: ["RU", "UA", "KZ", "BY"],
            onlyCountries: allow_countries,
            nationalMode: false,
            separateDialCode: true,
            utilsScript: "/assets/landings/common/intl-tel-input-master/js/utils.js" // just for formatting/placeholders etc
        });
         
        if( allow_countries.indexOf(country_code) !== -1 ) {
            telInput.intlTelInput("setCountry", country_code);
        } else {
            telInput.intlTelInput("setCountry", 'RU');
        }

        jQuery.validator.addMethod("checkPhone", function (val, el) {
            if (telInput.intlTelInput("isValidNumber")) {
                current_number = telInput.intlTelInput("getNumber").replace('+', '');

                if (/^(91|994|82|372|375|374|44|998|972|66|90|81|1|507|7|77|380|371|370|996|9955|992|373|84)[0-9]{6,14}$/.test(current_number)) {
                    return true;
                } else return false;
            } else {
                return false;
            }
        });

        $("#phone-form").validate({
            submitHandler: function(form) {
                $("#main-form #phone").val(telInput.intlTelInput("getNumber").replace('+', ''));
                $("#main-form").submit();
                return false;
            },
            errorContainer: "#phone-error-box",
            errorLabelContainer: "#phone-error-holder",
        });

        telInput.rules("add", {
            required: true,
            checkPhone: true,
            messages: {
                required: "Это поле необходимо заполнить",
                checkPhone: "Введите корректный QIWI кошелек",
            }
        });
    }

    //AFFIX START
    $('.sidebar-form').affix({
        offset: {
            top: $('.main-info').offset().top + $('.main-info').outerHeight()
        }
    });

    $(".sidebar-form").on('affixed.bs.affix', function(){
        $('.sidebar-form.affix').width($('.mobile-hide').width());
    });

    $(window).resize(function () {
        $('.sidebar-form.affix').width($('.mobile-hide').width());
    });

    $(window).scroll(function () {
        $('.sidebar-form.affix').width($('.mobile-hide').width());
    });
    //AFFIX END

    $gatemethod_holder = 'select.gate-methods';

    $gatemethod_selectpicker = $($gatemethod_holder).selectpicker({
        style: 'btn-primary btn-sm',
        size: 'auto',
    }).on('hidden.bs.select', function (e, relatedTarget) {
        var selected = $(this).find("option:selected").val();

        $($gatemethod_holder).selectpicker('val', selected);
    });

    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
        $gatemethod_selectpicker.selectpicker('mobile');
    }

    $('.fake-submit').click(function () {
        $('#main-form').submit();
    })

    $('#main-form').submit(function (e) {
        if ( $('#ask_number').val() == 'true' && $('#chosen-gate').val() == 'qiwi' && !$('#phone').val() ) {
            e.preventDefault();
            $("#get-phone-number").modal();
            return false;
        }
    });

    $('.item .item-inner').click(function () {
        $('.item .item-inner').removeClass('active');
        $( this ).addClass('active');

        gate = $( this ).attr('data-gate');
        gate_title = $( this ).attr('data-gate-title');

        $('#chosen-gate').val(gate);
        createDropdown(gate);

        $('.chosen-gate-title').html(gate_title);
    });

    function createDropdown(gate) {
        $($gatemethod_holder).html('');

        var current_config = methods[gate];

        if(current_config.length > 1) {
            $('.method-holder').show();
            $('.btn-submit').addClass('topmargin');
        } else {
            $('.method-holder').hide();
            $('.btn-submit').removeClass('topmargin');
        }

        current_config.forEach(function(item, i, arr){
            $('<option>').val(item['method']).text(item['title']).appendTo($gatemethod_holder);
        });

        $gatemethod_selectpicker.selectpicker('refresh');
    }

    $( ".top-menu-info" ).mouseenter(function() {
        $('.nav-paymethods').addClass('alert-hover');
    });

    $( ".top-menu-info" ).mouseleave(function() {
        $('.nav-paymethods').removeClass('alert-hover');
    });

    // ISOTOPE sorting START
    var $items_grid = $('.items-holder');

    $items_grid.imagesLoaded( function() {
        // init Isotope after all images have loaded
        $items_grid.isotope({
            itemSelector: '.item',
            layoutMode: 'fitRows',
            filter: '.popular'
        });
    });

    $items_grid.css('visibility','visible').hide().fadeIn('slow');

    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var filter_data = $(e.target).attr("data-filter");
        $items_grid.isotope({ filter: filter_data });
        checkResults();

        if(filter_data == '*') {
            $('.more-results').hide();
        } else {
            $('.more-results').show();
        }
    });

    function checkResults(){
        var visibleItemsCount = $items_grid.data('isotope').filteredItems.length;

        if( visibleItemsCount > 0 ){
            $('.no-results').hide();
        } else{
            $('.no-results').show();
        }

        if(visibleItemsCount > 13) {
            $('.sidebar-form').fadeIn(100);
        } else {
            $('.sidebar-form').fadeOut(100);
        }
    }
    // ISOTOPE sorting END

});