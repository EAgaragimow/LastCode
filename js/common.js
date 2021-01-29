// text-time-slide

jQuery.fn.extend({
    textTimeSlider: function (text, time, loop = true) {
        if (!text.length) return this;
        //console.log(text, time);
        var curr_text = text.shift();
        var curr_time = time.shift();
        if (loop) {
            text.push(curr_text);
            time.push(curr_time);
        }

        // Fade out
        this.fadeOut(350, () => {
            this.html(curr_text); // Update text
            this.fadeIn(350); // Fade in
        });

        setTimeout(() => {
            this.textTimeSlider(text, time, loop);
        }, curr_time);

        return this;
    }
});

$(window).on('load', function () {
    let objects_tag = $('object');
    if (objects_tag.length) {
        objects_tag.each(function () {
            let icon = $((this).contentDocument).find('svg');
            icon.appendTo($(this).parent());
            setTimeout(() => {
                $(this).remove();
            }, 0);
        });
    }

    let menu = $('#menu-header-menu > li').length ? $('#menu-header-menu > li') : $('#menu-header-menu-ivrit > li');
    if (menu.length) {
        active_AND_arrow(menu);
    }

    let footer_menu = $('#menu-header-menu-1 > li').length ? $('#menu-header-menu-1 > li') : $('#menu-header-menu-ivrit-1 > li');
    if (footer_menu.length) {
        active_AND_arrow(footer_menu);
    }

    $('body > .page-preloader-cover').fadeOut(400);

    $('footer .primary-menu > li').last().remove();

    let companies = new Swiper('#companies', {
        direction: 'horizontal',
        loop: false,
        slidesPerView: 1,
        breakpoints: {
            // when window width is >= 320px
            320: {
                slidesPerView: 2
            },
            // when window width is >= 480px
            576: {
                slidesPerView: 3
            },
            // when window width is >= 640px
            768: {
                slidesPerView: 4
            }
        }
    });

    let gallery = $('#gallery #gallery-list');
    if (gallery.length) {
        gallery.magnificPopup({
            delegate: 'a',
            type: 'image',
            tLoading: 'Loading image #%curr%...',
            mainClass: 'mfp-img-mobile',
            gallery: {
                enabled: true,
                navigateByImgClick: true,
                tCounter: '<span class="mfp-counter">%curr% / %total%</span>', // markup of counter
                preload: [0,1] // Will preload 0 - before current, and 1 after the current image
            },
            image: {
                tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
            }
        });
    }

    let page_product_gallery = $('#page_product__gallery');
    if (page_product_gallery.length) {
        page_product_gallery.magnificPopup({
            delegate: 'a',
            type: 'image',
            tLoading: 'Loading image #%curr%...',
            mainClass: 'mfp-img-mobile',
            gallery: {
                enabled: true,
                navigateByImgClick: true,
                tCounter: '<span class="mfp-counter">%curr% / %total%</span>', // markup of counter
                preload: [0,1] // Will preload 0 - before current, and 1 after the current image
            },
            image: {
                tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
            }
        });
    }

    $(document).on('click', '#toggle-main-menu', function () {
        $(this).toggleClass('active');
        let header_menu = $('#site-header-menu');
        header_menu.toggleClass('open');
        $('#content-wrapper, body, html').toggleClass('wrapper-menu-open');

        if ($(window).width() <= 568) {
            let header = $('#content-wrapper > header');

            if (header_menu.hasClass('open')) {
                header_menu.css({
                    "width": "100%",
                    "height": `calc(100vh - ${header.outerHeight()}px`,
                    "top": `${header.outerHeight()}px`
                });
            } else {
                header_menu.removeAttr('style');
            }
        }
    });

});

// Auto Load Menu Items Via Scrolling
$(window).on("load scroll", function(e) {
    if ($('.products.page-menu').length) {
        let scroll_top = $(window).scrollTop() + $(window).outerHeight();
        let footer = $('footer').offset().top + 100;
        let section = $('.products');

        if (section.length) {
            if (Math.round(scroll_top) >= Math.round(footer)) {
                if (products.length) {
                    for(let i = 0; i < max_items; i++) {
                        section.append(templateItem(products[i]));
                        setTimeout(() => {
                            products.splice(0, 1);
                        });
                    }
                }
            }
        }
    }
});

function active_AND_arrow(menu) {
    menu.each(function () {
        let _self = $(this);
        let link = _self.find('a').attr('href');
        let list = _self.find('> ul > li');

        if (list.length) {
            if ($(window).width() >= 985) {
                _self.addClass('desktop');
            } else {
                _self.addClass('mobile');
                _self.on('click', '> .fa', function () {
                    _self.find('> .sub-menu').toggle(400);
                    _self.toggleClass('active');
                });
            }

            _self.append(`<i class="fa fa-chevron-down"></i>`);
            active_AND_arrow(list);
        }

        if (location.href === link) {
            _self.addClass('active');
        }
    });
}

function templateItem(data) {
    if (data) {
        return `<div class="products-item">
                <div class="products-item__image">
                    <a href="${data.link}" style="background-image: url('${data.image}')">
                        <div class="padding_box"></div>
                    </a>
                </div>

                <div class="products-item-caption">
                    <div class="products-item-caption__title_wrap">
                        <div class="products-item-caption__title">
                            <a href="${data.link}">${data.title}</a>
                        </div>
                        <div class="products-item-caption__price">${data.price}</div>
                    </div>
                    <div class="products-item-caption__description">${data.description}</div>
                </div>
            </div>`;
    }
}