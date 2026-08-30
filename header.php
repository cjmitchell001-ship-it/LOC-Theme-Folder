<?php
/**
 * Header template — Leicester Oven Cleaning
 * Replaces GeneratePress default header
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php
// Announcement bar. Weekend availability is permanent and always shown —
// it is the genuinely unusual thing most oven cleaners don't offer. The
// early-rate half is conditional, so when LOC_EARLYBIRD_END passes the
// prices drop out but the bar itself stays.
?>
<a href="/reserve-step-1" class="loc-announce-bar">
    <span class="loc-announce-bar__lead">Weekends currently being offered</span>
</a>

<header class="loc-header" id="loc-header">
    
    <!-- LOGO -->
    <a href="<?php echo home_url('/'); ?>" class="loc-logo">
        <div class="loc-logo__divider"></div>
        <div class="loc-logo__text">
            <span class="loc-logo__top">Leicester</span>
            <span class="loc-logo__bottom">Oven Cleaning</span>
        </div>
    </a>

    <!-- NAVIGATION -->
    <nav class="loc-nav" id="loc-nav">
        <ul class="loc-nav__list">
            <li><a href="/services">What I Clean + Prices</a></li>
            <li><a href="/areas">Areas</a></li>
            <li><a href="/about">About Chris</a></li>
        </ul>
    </nav>

    <!-- HEADER CTAs -->
    <div class="loc-header__ctas">
        <a href="tel:+447710649360" class="btn-ghost-blue">Call Me</a>
        <a href="/reserve-step-1" class="btn-primary">Reserve Your Slot</a>
    </div>

    <!-- MOBILE CONTROLS -->
    <div class="loc-header__mobile">
        <a href="/reserve-step-1" class="btn-primary btn-primary--small">Reserve</a>
        <a href="tel:+447710649360" class="loc-header__call-icon" aria-label="Call me">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                <path d="M6.62 10.79a15.05 15.05 0 0 0 6.59 6.59l2.2-2.2a1 1 0 0 1 1.01-.24 11.47 11.47 0 0 0 3.58.57 1 1 0 0 1 1 1V20a1 1 0 0 1-1 1C10.61 21 3 13.39 3 4a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1c0 1.25.2 2.45.57 3.58a1 1 0 0 1-.25 1.01l-2.2 2.2z"/>
            </svg>
        </a>
        <button class="loc-hamburger" id="loc-hamburger" aria-label="Open menu">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>

    <!-- MOBILE DROPDOWN MENU -->
    <div class="loc-mobile-menu" id="loc-mobile-menu">
        <ul class="loc-mobile-menu__list">
            <li><a href="/services">What I Clean + Prices</a></li>
            <li><a href="/areas">Areas</a></li>
            <li><a href="/about">About Chris</a></li>
        </ul>
    </div>

</header>