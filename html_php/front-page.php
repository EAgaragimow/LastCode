<?php get_header();
	$post_fields = get_fields();

	$menu = get_terms([
		'taxonomy' => 'menu',
		'hide_empty' => FALSE,
		'number' => 4,
	]);

	$testimonials = get_posts([
		'numberposts' => '3',
		'post_type' => 'testimonial',
		'orderby' => 'menu_order',
	]);

	$products = get_posts([
		'post_type' => 'dish',
		'orderby' => 'rand',
		'numberposts' => 8,
	]);
?>

    <!-- banner-->
<?php if (isset($post_fields['banner']) && !empty($post_fields['banner'])) { ?>
    <div class="main-banner" style="background-image: url('<?= $post_fields['banner']['image'] ?>');">
        <div class="container">
            <div class="main-banner__inner">
                <h1 class="main-banner__title"><?= $post_fields['banner']['text_1'] ?></h1>
                <h2 class="main-banner__subtitle"><?= $post_fields['banner']['text_2'] ?></h2>
                <div class="main-banner__description"><?= nl2br($post_fields['banner']['text_3']) ?></div>
                <a href="#" class="button red-bg red-border"><?= pll__('book_online') ?></a>
            </div>
        </div>
    </div>
<?php } ?>
    <!-- END banner-->

    <!-- colaboration-->
<?php if (isset($post_fields['colaboration']) && !empty($post_fields['colaboration'])) { ?>
    <div class="companies swiper-container" id="companies">
        <div class="swiper-wrapper">
			<?php foreach ($post_fields['colaboration'] as $colaboration) { ?>
                <div class="companies-item swiper-slide">
                    <div class="companies-item__image"><img src="<?= $colaboration['image'] ?>" alt="company"></div>
                </div>
			<?php } ?>
        </div>
    </div>
<?php } ?>
    <!-- END colaboration-->

    <!-- categories-->
<?php if (isset($menu) && !empty($menu)) { ?>
    <div class="categories">
		<?php foreach ($menu as $section) { ?>
            <a href="<?= get_term_link($section); ?>" class="categories-item"
               style="background-image: url('<?= get_field('image', $section); ?>');">
                <div class="categories-item__hover"></div>
                <div class="categories-item__title"><?= $section->name; ?></div>
            </a>
		<?php } ?>
    </div>
<?php } ?>
    <!-- END categories-->

    <!--	testimonials-->
<?php if (isset($testimonials) && !empty($testimonials)) { ?>
    <div class="reviews invert">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="heading-block">
                        <h2 class="heading-block__title"><?= $post_fields['about_product']['title'] ?></h2>
                        <div class="heading-block__subtitle"><?= $post_fields['about_product']['subtitle'] ?></div>
                    </div>
                </div>
				<?php foreach ($testimonials as $testimonial) { ?>
                    <div class="col-lg-4">
                        <div class="reviews-item">
                            <i class="fa fa-quote-left"></i>
                            <div class="reviews-item__text"><?= $testimonial->post_content ?></div>
                            <div class="reviews-item-caption">
                                <img class="reviews-item-caption__image"
                                     src="<?= get_the_post_thumbnail_url($testimonial->ID) ?>"
                                     alt="<?= $testimonial->post_title ?>">
                                <div class="reviews-item-caption__name"><?= $testimonial->post_title ?></div>
                            </div>
                        </div>
                    </div>
				<?php } ?>
            </div>
        </div>
    </div>
<?php } ?>
    <!--	END testimonials-->

    <!--	products-->
<?php if (isset($products) && !empty($products)) { ?>
    <div class="main_products_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="heading-block">
                        <h2 class="heading-block__title"><?= $post_fields['about_product']['title'] ?></h2>
                        <div class="heading-block__subtitle"><?= $post_fields['about_product']['subtitle'] ?></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="products products__main">
			<?php foreach ($products as $product) { ?>
                <div class="products-item">
                    <div class="products-item__image">
                        <a href="<?= get_post_permalink($product->ID); ?>"
                           style="background-image: url('<?= get_the_post_thumbnail_url($product->ID) ?>')">
                            <div class="padding_box"></div>
                        </a>
                    </div>

                    <div class="products-item-caption">
                        <div class="products-item-caption__title_wrap">
                            <div class="products-item-caption__title">
                                <a href="<?= get_post_permalink($product->ID); ?>"><?= $product->post_title; ?></a>
                            </div>
                            <div class="products-item-caption__price"><?= priceFormat($product->ID); ?></div>
                        </div>
                        <div class="products-item-caption__description"><?= get_field('short_descroption', $product->ID) ?></div>
                    </div>
                </div>
			<?php } ?>
        </div>
    </div>
<?php } ?>
    <!-- END products-->

    <!-- about restaurant-->
<?php if (isset($post_fields['about_restaurant']) && !empty($post_fields['about_restaurant'])) { ?>
    <div class="about" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <img src="<?= $post_fields['about_restaurant']['image'] ?>" class="about__img" alt="Chef">
                </div>
                <div class="col-lg-6">
                    <div class="about-text_wrapper">
                        <div class="about__title"><?= $post_fields['about_restaurant']['title'] ?></div>
                        <h2 class="about__subtitle"><?= $post_fields['about_restaurant']['subtitle'] ?></h2>
                        <div class="about__text"><?= $post_fields['about_restaurant']['text'] ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
    <!-- END about restaurant-->

    <!--	about gallery-->
<?php if (isset($post_fields['about_gallery']) && !empty($post_fields['about_gallery'])) { ?>
    <div class="gallery_preview invert" data-parallax="scroll"
         data-image-src="/wp-content/themes/wasabi/images/bg_1.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="gallery_preview__title"><?= $post_fields['about_gallery']['title'] ?></div>
                    <h2 class="gallery_preview__subtitle"><?= $post_fields['about_gallery']['subtitle'] ?></h2>
                    <div class="gallery_preview__text"><?= $post_fields['about_gallery']['text'] ?></div>
                    <a href="/" class="button red-border"><?= pll__('gallery_button') ?></a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
    <!--	END about gallery-->

    <div class="map-box">
        <div id="contact-map" class="contact-map">
			<?= get_option('map_iframe') ?>
        </div>
    </div>

    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d108136.84450385241!2d34.73523324107112!3d32.1158371707428!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151d48f88e828a15%3A0x5d91260dd414c97c!2zRXpvciBUZWwgQXZpdiwg0JjQt9GA0LDQuNC70Yw!5e0!3m2!1sru!2sua!4v1590409331885!5m2!1sru!2sua"
            width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false"
            tabindex="0"></iframe>

<?php get_footer(); ?>