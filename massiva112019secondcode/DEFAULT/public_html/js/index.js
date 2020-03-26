/* global auth_api */

$(document).ready(function () {
    jQuery("#revolution-slider").revolution({
        sliderType: "standard",
        sliderLayout: "fullwidth",
        delay: 5000,
        navigation: {
            arrows: {enable: true}
        },
        parallax: {
            type: "mouse",
            origo: "slidercenter",
            speed: 2000,
            levels: [2, 3, 4, 5, 6, 7, 12, 16, 10, 50]
        },
        spinner: "on",
        gridwidth: 1140,
        gridheight: 600,
        disableProgressBar: "on"
    });
    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        responsiveClass: true,
        autoplay: true,
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            576: {
                items: 2,
                nav: false
            },
            768: {
                items: 2,
                nav: false
            },
            992: {
                items: 3,
                nav: false
            },
            1200: {
                items: 4,
                nav: true
            }
        }
    });
    $('#paquetes_descripcion').removeClass('d-none');
    $('.div-massiva-header').click(function () {
        $(this).parent('.div-massiva-container').addClass('visited').toggleClass('active');
    });
    $('li[name="paquetes_descripcion"]').click(function () {
        $(this).addClass('btn-primary');
        $('li[name="extras"]').removeClass('btn-primary');
        $('#extras').removeClass('d-none');
        $('#paquetes_descripcion').removeClass('d-none');
        $('#extras').addClass('d-none');
    });
    $('li[name="extras"]').click(function () {
        $(this).addClass('btn-primary');
        $('li[name="paquetes_descripcion"]').removeClass('btn-primary');
        $('#extras').removeClass('d-none');
        $('#paquetes_descripcion').removeClass('d-none');
        $('#paquetes_descripcion').addClass('d-none');
    });
    $.validate({
        modules: 'sanitize, logic',
        lang: 'es'
    });
    $(window).on('shown.bs.modal', function () {
        $("#registro-form").submit(function (e) {
            e.stopPropagation();
            e.preventDefault();
            $('#registro .alert').addClass('d-none');

            $.ajax({
                type: 'POST',
                url: auth_api + 'registro',
                data: {
                    rfc: $("input[name='registro-rfc']").val(),
                    nombre: $("input[name='registro-nombre']").val(),
                    apellido_paterno: $("input[name='registro-paterno']").val(),
                    apellido_materno: $("input[name='registro-materno']").val(),
                    email: $("input[name='registro-email']").val(),
                    telefono: $("input[name='registro-telefono']").val()
                },
                success: function (data) {
                    $('#registro .alert-success').html(data.message).removeClass('d-none');
                    $('#registro-form').addClass('d-none');
                    $("#registro-form").find("input").val("");
                    setTimeout(function () {
                        $("#registro .close").trigger('click');
                    }, 3000);
                    step = 2;
                    showStep(2);
                },
                error: function (jqXHR) {
                    $('#registro .alert-danger').html(jqXHR.responseJSON.message).removeClass('d-none');

                }
            });
            return false;
        });
    });
    initDemo();
    $('#preloader').delay(1000).fadeOut(500);
});
var step = 1;
$(window).on('scroll', function () {
    var top = $(window).scrollTop();
    if (30 > top) {
        $('.menu-area').removeClass('menu-black');
    } else {
        $('.menu-area').addClass('menu-black');
    }
});
function initDemo() {
    showStep(step);
    $("#form-step-1").submit(function (e) {
        e.stopPropagation();
        e.preventDefault();
        $('#demo .alert').addClass('d-none');
        $.ajax({
            type: 'POST',
            url: auth_api + 'registro',
            data: {
                rfc: $("input[name='demo-rfc']").val(),
                nombre: $("input[name='demo-nombre']").val(),
                apellido_paterno: $("input[name='demo-paterno']").val(),
                apellido_materno: $("input[name='demo-materno']").val(),
                email: $("input[name='demo-email']").val(),
                telefono: $("input[name='demo-telefono']").val()
            },
            success: function (data) {
                step = 2;
                showStep(step);
            },
            error: function (jqXHR) {
                $('#demo .alert-danger').html(jqXHR.responseJSON.message).removeClass('d-none');
            }
        });
        return false;
    });
    return false;
}
function showStep(step) {
    $('#step-1, #step-2').addClass('d-none');
    $('li[name="step-1-title"], li[name="step-2-title"]').removeClass('active');
    $('#step-' + step).removeClass('d-none');
    $('li[name="step-' + step + '-title"]').addClass('active');
}
