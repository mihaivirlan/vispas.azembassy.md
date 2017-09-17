$(function() {
    console.log('load');
    setTimeout(function () {
        $('.p-alert').hide();
    }, 3000);

    var slider = $('.slider'),
        interval,
        slider_interval = 5000,
        slider_large_image = slider.find('.image-large>img'),
        slider_thumbnails = slider.find('.thumbnails>img'),
        slider_thumbnails_count = slider_thumbnails.length,
        increment = -1;
        slider_thumbnails.on('click', function () {
        var th = $(this);
            increment = th.index();
            slider_large_image.attr('src', th.attr('src'));
            th.addClass('active');
            th.siblings().removeClass('active');
            clearInterval(interval);

            increment++;
            interval = setInterval(function(){
                if (increment == slider_thumbnails_count) {
                    increment = 0
                }
                var image = slider_thumbnails.eq(increment);
                slider_large_image.attr('src', image.attr('src'));
                image.addClass('active');
                image.siblings().removeClass('active');
            } , slider_interval);

        });


    interval = setInterval(function(){
        increment++;
        if (increment == slider_thumbnails_count) {
            increment = 0
        }
        var image = slider_thumbnails.eq(increment);
        slider_large_image.attr('src', image.attr('src'));
        image.addClass('active');
        image.siblings().removeClass('active');
    } , slider_interval);
});