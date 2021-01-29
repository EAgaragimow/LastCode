<?php get_header(); ?>
<?php $lang = pll_current_language(); ?>

    <div class="contact" id="contact">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contact-box">
                        <h2><?= pll__('contact_us') ?></h2>
                        <ul>
                            <li><?=  ($lang === 'he') ? get_option('city_he') : get_option('city') ?></li>
                            <li><?=  ($lang === 'he') ? get_option('address_he') : get_option('address') ?></li>
                        </ul>
                        <ul>
                            <li>TEL: <a href="tel:<?= get_option('phone_1') ?>"><?= get_option('phone_1') ?></a></li>
                            <li><a href="email:<?= get_option('email') ?>"><?= get_option('email') ?></a></li>
                        </ul>
                        <ul>
                            <li><?= pll__('join_to_team') ?></li>
                            <li><a href=""><?= pll__('apply_today') ?></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="contact-box last">
                        <h2><?= pll__('opеning_hours') ?></h2>
                        <ul>
                            <li><?=  ($lang === 'he') ? nl2br(get_option('open_he')) : nl2br(get_option('open')) ?></li>
                        </ul>
                        <ul>
                            <li><?= pll__('call_us_at') ?></li>
                            <li><a href="email:<?= get_option('email') ?>"></a><?= get_option('email') ?></li>
                        </ul>
                        <ul>
                            <li><?= pll__('join_to_team') ?></li>
                            <li><a href="tel:<?= get_option('phone_2') ?>"><?= get_option('phone_2') ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="map-box">
        <div id="contact-map" class="contact-map">
			<?= get_option('map_iframe') ?>
        </div>
    </div>

    <?php include ('templates/request.php'); ?>

<?php get_footer(); ?>