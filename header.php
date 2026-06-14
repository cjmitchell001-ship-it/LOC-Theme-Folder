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
            <li><a href="/about">About</a></li>
            <li><a href="/services">Services</a></li>
            <li><a href="/business-commercial">Business &amp; Commercial</a></li>
        </ul>
    </nav>

    <!-- HEADER CTAs -->
    <div class="loc-header__ctas">
        <a href="tel:PLACEHOLDER" class="btn-ghost-blue">Call Us</a>
        <a href="/reserve-step-1" class="btn-primary">Reserve Your Slot</a>
    </div>

    <!-- MOBILE CONTROLS -->
    <div class="loc-header__mobile">
        <a href="/reserve-step-1" class="btn-primary btn-primary--small">Reserve</a>
        <button class="loc-hamburger" id="loc-hamburger" aria-label="Open menu">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>

    <!-- MOBILE DROPDOWN MENU -->
    <div class="loc-mobile-menu" id="loc-mobile-menu">
        <ul class="loc-mobile-menu__list">
            <li><a href="/about">About</a></li>
            <li><a href="/services">Services</a></li>
            <li><a href="/business-commercial">Business &amp; Commercial</a></li>
            <li><a href="tel:PLACEHOLDER">Call Us</a></li>
        </ul>
    </div>

</header>