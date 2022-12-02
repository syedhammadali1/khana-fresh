jQuery(document).ready(function ($) {
    $(window).on('load', function () {
        setTimeout(function () {
            $('.preloader').fadeOut().end().delay(500).fadeOut('slow');
        }, 1000);
    });
    $('.product-item__toggle button').on('click', function () {
        $(this).offsetParent('.product-item').find('.product-item__active').toggleClass('is-show');
        $(this).parent('.product-item__toggle').toggleClass('is-show');
    });
    $('.product-item__whish').on('click', function () {
        $(this).toggleClass('is-active');
    });
    $('.product-full-card__toggle button').on('click', function () {
        $(this).offsetParent('.product-full-card').find('.product-full-card__active').toggleClass('is-show');
        $(this).parent('.product-full-card__toggle').toggleClass('is-show');
    });
    $('.product-full-card__whish').on('click', function () {
        $(this).toggleClass('is-active');
    });
    $('.counter .minus').on('click', function () {
        var $input = $(this).parent().find('input');
        var count = parseInt($input.val()) - 1;
        count = count < 1 ? 1 : count;
        $input.val(count);
        $input.change();
        return false;
    });
    $('.counter .plus').on('click', function () {
        var $input = $(this).parent().find('input');
        $input.val(parseInt($input.val()) + 1);
        $input.change();
        return false;
    });
    $('.js-hidden-box').each(function () {
        $(this).children('div').hide();
        $(this).children('div').slice(0, 8).show();
        $(this).next('.js-hidden-btn').on('click', function (e) {
            e.preventDefault();
            $(this).prev('.js-hidden-box').children('div:hidden').slice(0, 3).slideDown();
            var elHidden = $(this).prev('.js-hidden-box').children('div:hidden').length;

            if (elHidden <= 0)
            {
                $(this).hide();
            }
        });
    });
    $('.js-checkbox').on('click', function () {
        $(this).toggleClass('is-checked');
    });
});


$('.jus-hidden-box').each(function () {
    $(this).children('div').hide();
    $(this).children('div').slice(0, 8).show();
    $(this).next('.jus-hidden-btn').on('click', function (e) {
        e.preventDefault();
        $(this).prev('.jus-hidden-box').children('div:hidden').slice(0, 3).slideDown();
        var elHidden = $(this).prev('.jus-hidden-box').children('div:hidden').length;

        if (elHidden <= 0)
        {
            $(this).hide();
        }
    });
});



$('.sj-hidden-box').each(function () {
    $(this).children('div').hide();
    $(this).children('div').slice(0, 1).show();
    $(this).next('.sj-hidden-btn').on('click', function (e) {
        e.preventDefault();
        $(this).prev('.sj-hidden-box').children('div:hidden').slice(0, 3).slideDown();
        var elHidden = $(this).prev('.sj-hidden-box').children('div:hidden').length;

        if (elHidden <= 0)
        {
            $(this).hide();
            $('.sj-hidden-btn-less').show();
        }
    });
});

$('.sj-hidden-btn-less').click(function () {
    $('#hide-section').hide();
    $('.sj-hidden-btn-less').hide();
    $('.sj-hidden-btn').show();
});


$(document).ready(function () {

    var current_fs, next_fs, previous_fs; //fieldsets
    var opacity;

    $(".next").click(function () {

        current_fs = $(this).parent();
        next_fs = $(this).parent().next();

        //Add Class Active
        $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active-progress");

        //show the next fieldset
        next_fs.show();
        //hide the current fieldset with style
        current_fs.animate({ opacity: 0 }, {
            step: function (now) {
                // for making fielset appear animation
                opacity = 1 - now;

                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });
                next_fs.css({ 'opacity': opacity });
            },
            duration: 600
        });
    });

    $(".previous").click(function () {

        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();

        //Remove class active
        $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active-progress");

        //show the previous fieldset
        previous_fs.show();

        //hide the current fieldset with style
        current_fs.animate({ opacity: 0 }, {
            step: function (now) {
                // for making fielset appear animation
                opacity = 1 - now;

                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });
                previous_fs.css({ 'opacity': opacity });
            },
            duration: 600
        });
    });

    $('.radio-group .radio').click(function () {
        $(this).parent().find('.radio').removeClass('selected');
        $(this).addClass('selected');
    });

    $(".submit").click(function () {
        return false;
    })

});

/////////////////////////////////////////////////////////////////
// Preloader
/////////////////////////////////////////////////////////////////

var $preloader = $('#page-preloader'),
    $spinner = $preloader.find('.spinner-loader');
$spinner.fadeOut();
$preloader.delay(50).fadeOut('slow');


const mediaQueryTablet = window.matchMedia('(max-width: 768px)');

function handleTabletChange(e) {
    if (e.matches)
    {
        console.log('Media Query 768!');
    }
}

mediaQueryTablet.addListener(handleTabletChange);
handleTabletChange(mediaQueryTablet);

var acc = document.getElementsByClassName("accordion-panel-title");
var dd = document.getElementsByClassName("accordion-panel-content");
var i;

for (i = 0; i < acc.length; i++)
{
    acc[i].addEventListener("click", function () {
        /* Toggle between adding and removing the "active" class,
        to highlight the button that controls the panel */
        this.classList.toggle("open");

        /* Toggle between hiding and showing the active panel */
        var dd = this.nextElementSibling;
        if (dd.style.display === "block")
        {
            dd.style.display = "none";
        } else
        {
            dd.style.display = "block";
        }
    });
}

$(document).ready(function () {
    $("#show_hide_password a").on('click', function (event) {
        event.preventDefault();
        if ($('#show_hide_password input').attr("type") == "text")
        {
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass("fa-eye-slash");
            $('#show_hide_password i').removeClass("fa-eye");
        } else if ($('#show_hide_password input').attr("type") == "password")
        {
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass("fa-eye-slash");
            $('#show_hide_password i').addClass("fa-eye");
        }
    });
});

document.addEventListener('DOMContentLoaded', () => {

    let myBtns = document.querySelectorAll('.user-front');
    myBtns.forEach(function (btn) {

        btn.addEventListener('click', () => {
            myBtns.forEach(b => b.classList.remove('user-active-dash'));
            btn.classList.add('user-active-dash');
        });

    });

});

$(document).ready(function () {
    $("#Pay-info").on('click', function (event) {
        $("#user-payment").show();
        $("#user-dash-menu").hide();
        $("#user-dash-form").hide();
        $("#user-subscriptin").hide();
    });
});


$(document).ready(function () {
    $("#per-info").on('click', function (event) {
        $("#user-payment").hide();
        $("#user-dash-menu").hide();
        $("#user-dash-form").show();
        $("#user-subscriptin").hide();
    });
});


$(document).ready(function () {
    $("#Pay-menu").on('click', function (event) {
        $("#user-payment").hide();
        $("#user-dash-form").hide();
        $("#user-dash-menu").show();
        $("#user-subscriptin").hide();
    });
});


$(document).ready(function () {
    $("#Pay-Subscription").on('click', function (event) {
        $("#user-payment").hide();
        $("#user-dash-form").hide();
        $("#user-dash-menu").hide();
        $("#user-subscriptin").show();
    });
});





