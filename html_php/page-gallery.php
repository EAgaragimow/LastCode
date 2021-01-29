<?php get_header(); ?>
<?php $post_fields = get_fields(); ?>

    <div class="gallery content" id="gallery">
        <div class="gallery-banner" style="background-image: url('<?= $post_fields['image'] ?>');">
            <div class="gallery-banner__title"><?= $post_fields['title'] ?></div>
        </div>

        <div class="gallery-gallery">
            <?php if (isset($post_fields['gallery']) && !empty($post_fields['gallery'])) { ?>
                <div class="gallery-gallery-caption">
                    <div class="container">
                        <h2 class="gallery-gallery-caption__title"><?= pll__('gallery_subtitle') ?></h2>
                        <div class="gallery-gallery-caption__subtitle"><?= $post_fields['subtitle'] ?></div>
                    </div>
                </div>

                <div class="gallery-gallery__list" id="gallery-list">
                    <?php $iterator = 1; foreach ($post_fields['gallery'] as $image) { ?>
                        <a href="<?= $image['image'] ?>" style="background-image: url('<?= $image['image'] ?>');" class="gallery-gallery__item gallery-item" id="gallery__item<?= $iterator; ?>">
                            <img style="display: none;" loading="lazy" src="<?= $image['image'] ?>" alt="Image">
                            <div class="padding_box"></div>
                            <div class="gallery-gallery__overlay">
                                <i class="fa fa-search-plus"></i>
                            </div>
                        </a>
                    <?php $iterator++; } ?>
                </div>
            <?php } ?>
        </div>
    </div>

<?php get_footer(); ?>