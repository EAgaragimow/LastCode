<?php get_header(); ?>
<?php $post_fields = get_fields(); ?>
<?php
    $post_term = wp_get_object_terms( get_the_ID(), 'menu' );
    $post_args = [
        'post_type'     => 'dish',
		'orderby'       => 'rand',
        'numberposts'   => 3,
        'exclude'       => array(get_the_ID()),
    ];

    if (isset($post_term[0]) && !empty($post_term[0])) {
        $post_args['tax_query'] = array(
            array(
                'taxonomy'      => 'menu',
                'field'         => 'term_id',
                'terms'         => $post_term[0]->term_id,
            )
        );
    }

    $featureds = get_posts($post_args);
?>

	<div class="page_product">
        <div class="container">
            <div class="page_product__thumb">
                <img src="<?= get_the_post_thumbnail_url() ?>" alt="<?= get_the_title() ?>">
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <h1 class="page_product__title"><?= get_the_title() ?></h1>
                    <div class="page_product__description">
						<?php if (have_posts()) { while (have_posts()) { the_post(); ?>
                            <p><?= get_the_content(); ?></p>
						<?php }	} ?>
                    </div>
                    <div class="page_product-gallery" id="page_product__gallery">
						<?php if (isset($post_fields['images']) && !empty($post_fields['images'])) { ?>
                            <?php $i = 1; foreach ($post_fields['images'] as $image) { ?>
                                <a href="<?= $image['image'] ?>" class="page_product-gallery__item" style="background-image: url('<?= $image['image'] ?>');">
                                    <i class="fa fa-plus-circle"></i>
                                    <div class="padding_box"></div>
                                    <img style="display: none" src="<?= $image['image'] ?>" alt="<?= get_the_title() ?>">
                                </a>
                            <?php $i++; } ?>
						<?php } ?>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="page_product-attributes">
                        <h2 class="page_product__price"><?= priceFormat(get_the_ID()); ?></h2>
						<?php if (isset($post_fields['attributes']['weight']) && !empty($post_fields['attributes']['weight'])) { ?>
                            <div class="page_product-attributes__option-group">
                                <h2><?= pll__('weight') ?></h2>
                                <ul class="weight">
                                    <li><?= $post_fields['attributes']['weight'] ?></li>
                                </ul>
                            </div>
						<?php } ?>
						<?php if (isset($post_fields['attributes']['consist']) && !empty($post_fields['attributes']['consist'])) { ?>
                            <div class="page_product-attributes__option-group">
                                <h2><?= pll__('consist') ?></h2>
                                <ul class="consist">
									<?php foreach ($post_fields['attributes']['consist'] as $consist) { ?>
                                        <li><?= $consist['item'] ?></li>
									<?php } ?>
                                </ul>
                            </div>
						<?php } ?>

						<?php if (isset($post_fields['attributes']['calorie']) && !empty($post_fields['attributes']['calorie'])) { ?>
                            <div class="page_product-attributes__option-group">
                                <h2><?= pll__('calorie') ?></h2>
                                <ul class="calorie">
                                    <li><?= pll__('calorie') ?>: <?= $post_fields['attributes']['calorie'] ?></li>
                                </ul>
                            </div>
						<?php } ?>

						<?php if (isset($featureds) && !empty($featureds)) { ?>
                            <div class="page_product-attributes-featured">
                                <h2><?= pll__('featured') ?></h2>
								<?php foreach ($featureds as $featured) { ?>
                                    <a href="<?= get_post_permalink($featured->ID) ?>" class="page_product-attributes-featured__item">
                                        <img src="<?= get_the_post_thumbnail_url($featured->ID) ?>" alt="<?= $featured->post_name ?>">
                                        <span><?= $featured->post_name ?></span>
                                    </a>
								<?php } ?>
                            </div>
						<?php } ?>
					</div>
			    </div>
            </div>
        </div>
    </div>

<?php get_footer(); ?>