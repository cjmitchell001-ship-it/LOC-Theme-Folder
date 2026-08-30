<?php
/**
 * Template Name: Reserve Step 2
 * Funnel Step 2 — Postcode & date optimisation
 * Leicester Oven Cleaning
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class('loc-funnel-page'); ?>>
<?php wp_body_open(); ?>

<!-- FUNNEL HEADER -->
<header class="loc-funnel-header">
    <a href="<?php echo home_url('/'); ?>" class="loc-logo">
        <div class="loc-logo__divider"></div>
        <div class="loc-logo__text">
            <span class="loc-logo__top">Leicester</span>
            <span class="loc-logo__bottom">Oven Cleaning</span>
        </div>
    </a>
    <a href="<?php echo home_url('/'); ?>" class="loc-funnel-header__exit">
        &larr; Back to Home
    </a>
</header>

<!-- FUNNEL PROGRESS BAR -->
<div class="loc-funnel-progress">
    <div class="loc-funnel-steps">
        <a href="<?php echo home_url('/reserve-step-1'); ?>" class="loc-funnel-step loc-funnel-step--complete">
            <div class="loc-funnel-step__num">&#10003;</div>
            <span class="loc-funnel-step__label">Select Appliances</span>
            <div class="loc-funnel-step__arrow"></div>
        </a>
        <div class="loc-funnel-step loc-funnel-step--active">
            <div class="loc-funnel-step__num">2</div>
            <span class="loc-funnel-step__label">Your Area</span>
            <div class="loc-funnel-step__arrow"></div>
        </div>
        <div class="loc-funnel-step loc-funnel-step--inactive">
            <div class="loc-funnel-step__num">3</div>
            <span class="loc-funnel-step__label">Choose Your Date</span>
        </div>
    </div>
</div>

<!-- PAGE HEADER -->
<div class="loc-funnel-page-header">
    <p class="loc-funnel-page-header__eyebrow section-eyebrow">Step 2 of 3</p>
    <h1>Help me find your best available dates</h1>
    <p class="loc-funnel-page-header__intro">I organise my schedule by area — enter your postcode or pick your area below and I'll show you the dates that work best for your location.</p>
</div>

<!-- STICKY POSTCODE BAR — locks below header on scroll -->
<div class="loc-step2-sticky-bar" id="loc-sticky-bar">
    <div class="loc-step2-sticky-bar__inner">
        <input
            type="text"
            id="loc-postcode-input"
            class="loc-step2-postcode-input"
            placeholder="Enter your postcode"
            maxlength="8"
            autocomplete="off"
        />
        <button class="loc-step2-btn-confirm" id="loc-confirm-btn">
            Confirm Postcode &rarr;
        </button>
    </div>
</div>
<p class="loc-step2-postcode-error" id="loc-postcode-error" style="display:none;"></p>


<!-- ANCHOR to detect when sticky bar should activate -->
<div id="loc-sticky-anchor"></div>

<!-- MAIN CONTENT -->
<main class="loc-step2-body">
    <!-- AREAS GRID — clickable -->
    <div class="loc-step2-areas-section">

        <p class="loc-step2-areas-intro">Pick your area from the list below — or type your postcode directly into the bar above. Can't see your area? Just type your postcode and I'll work it out.</p>

        <div class="loc-step2-areas-grid">

            <div class="loc-step2-area-group loc-step2-area-group--central">
                <h4 class="loc-step2-area-group-title">Central</h4>
                <ul class="loc-step2-area-tags">
                    <li data-postcode="LE1">Leicester City <span>LE1</span></li>
                </ul>
            </div>

            <div class="loc-step2-area-group">
                <h4 class="loc-step2-area-group-title">North</h4>
                <ul class="loc-step2-area-tags">
                    <li data-postcode="LE4">Birstall <span>LE4</span></li>
                    <li data-postcode="LE4">Thurmaston <span>LE4</span></li>
                    <li data-postcode="LE6">Groby <span>LE6</span></li>
                    <li data-postcode="LE7">Anstey <span>LE7</span></li>
                    <li data-postcode="LE7">Syston <span>LE7</span></li>
                    <li data-postcode="LE7">Scraptoft <span>LE7</span></li>
                    <li data-postcode="LE7">Queniborough <span>LE7</span></li>
                    <li data-postcode="LE11">Loughborough <span>LE11</span></li>
                    <li data-postcode="LE12">Shepshed <span>LE12</span></li>
                    <li data-postcode="LE12">Mountsorrel <span>LE12</span></li>
                    <li data-postcode="LE12">Sileby <span>LE12</span></li>
                    <li data-postcode="LE65">Ashby-de-la-Zouch <span>LE65</span></li>
                    <li data-postcode="LE67">Coalville <span>LE67</span></li>
                </ul>
            </div>

            <div class="loc-step2-area-group">
                <h4 class="loc-step2-area-group-title">East</h4>
                <ul class="loc-step2-area-tags">
                    <li data-postcode="LE5">Hamilton <span>LE5</span></li>
                    <li data-postcode="LE5">Humberstone <span>LE5</span></li>
                    <li data-postcode="LE13">Melton Mowbray <span>LE13</span></li>
                    <li data-postcode="LE14">Melton Rural <span>LE14</span></li>
                    <li data-postcode="LE15">Oakham <span>LE15</span></li>
                    <li data-postcode="LE15">Rutland <span>LE15</span></li>
                </ul>
            </div>

            <div class="loc-step2-area-group">
                <h4 class="loc-step2-area-group-title">South</h4>
                <ul class="loc-step2-area-tags">
                    <li data-postcode="LE2">Stoneygate <span>LE2</span></li>
                    <li data-postcode="LE2">Clarendon Park <span>LE2</span></li>
                    <li data-postcode="LE2">Oadby <span>LE2</span></li>
                    <li data-postcode="LE2">Knighton <span>LE2</span></li>
                    <li data-postcode="LE8">Blaby <span>LE8</span></li>
                    <li data-postcode="LE8">Countesthorpe <span>LE8</span></li>
                    <li data-postcode="LE8">Fleckney <span>LE8</span></li>
                    <li data-postcode="LE18">Wigston <span>LE18</span></li>
                    <li data-postcode="LE16">Market Harborough <span>LE16</span></li>
                    <li data-postcode="LE17">Lutterworth <span>LE17</span></li>
                </ul>
            </div>

            <div class="loc-step2-area-group">
                <h4 class="loc-step2-area-group-title">West</h4>
                <ul class="loc-step2-area-tags">
                    <li data-postcode="LE3">Glenfield <span>LE3</span></li>
                    <li data-postcode="LE3">Braunstone <span>LE3</span></li>
                    <li data-postcode="LE9">Kirby Muxloe <span>LE9</span></li>
                    <li data-postcode="LE9">Earl Shilton <span>LE9</span></li>
                    <li data-postcode="LE10">Hinckley <span>LE10</span></li>
                    <li data-postcode="LE19">Narborough <span>LE19</span></li>
                </ul>
            </div>

        </div>

        <p class="loc-step2-areas-note">Not on the list? Just type your postcode above — I may still be able to help depending on location and current schedule.</p>

    </div><!-- /areas-section -->


    <!-- INLINE APPLIANCE SELECTION — shown only on direct landing after postcode confirmed -->
    <?php $loc_eb = loc_earlybird_active(); ?>
    <div class="loc-step2-inline-section" id="loc-inline-section" style="display:none;">

        <p class="loc-funnel-page-header__eyebrow section-eyebrow">One more step</p>
        <h2 class="loc-step2-section-heading">What would you like cleaned?</h2>
        <p class="loc-step2-inline-intro">You came straight to this page — no problem. Select your appliances below and I'll get you to the calendar.</p>

        <!-- OVENS -->
        <div class="loc-appliance-group">
            <p class="loc-appliance-group__label">Ovens</p>
            <div class="loc-appliance-cards loc-appliance-cards--inline">

                <div class="loc-appliance-card loc-appliance-card--inline" data-name="Single Oven" data-price="<?php echo $loc_eb ? '55' : '70'; ?>">
                    <svg width="48" height="48" viewBox="0 0 120 120" fill="none">
                        <rect x="16" y="22" width="88" height="76" rx="4" stroke="#1A3A6E" stroke-width="3" fill="none"/>
                        <rect x="16" y="22" width="88" height="20" rx="4" stroke="#1A3A6E" stroke-width="3" fill="#F0F4FA"/>
                        <circle cx="34" cy="32" r="5" stroke="#1A3A6E" stroke-width="2.5" fill="none"/><circle cx="34" cy="32" r="1.5" fill="#1A3A6E"/>
                        <circle cx="52" cy="32" r="5" stroke="#1A3A6E" stroke-width="2.5" fill="none"/><circle cx="52" cy="32" r="1.5" fill="#1A3A6E"/>
                        <circle cx="70" cy="32" r="5" stroke="#1A3A6E" stroke-width="2.5" fill="none"/><circle cx="70" cy="32" r="1.5" fill="#1A3A6E"/>
                        <circle cx="88" cy="32" r="5" stroke="#1A3A6E" stroke-width="2.5" fill="none"/><circle cx="88" cy="32" r="1.5" fill="#1A3A6E"/>
                        <rect x="24" y="48" width="72" height="42" rx="3" stroke="#1A3A6E" stroke-width="2.5" fill="none"/>
                        <rect x="32" y="55" width="56" height="28" rx="2" stroke="#1A3A6E" stroke-width="2" fill="#EEF3FA"/>
                        <line x1="40" y1="94" x2="80" y2="94" stroke="#1A3A6E" stroke-width="3" stroke-linecap="round"/>
                    </svg>
                    <p class="loc-appliance-card__name">Single Oven</p>
                    <p class="loc-appliance-card__price"><?php echo $loc_eb ? 'From £55' : 'From £70'; ?></p>
                    <div class="loc-aga-options">
                        <p class="loc-aga-options__label">Add more</p>
                        <div class="loc-qty-stepper__controls">
                            <button class="loc-qty-btn loc-qty-btn--minus">−</button>
                            <button class="loc-qty-btn loc-qty-btn--plus">+</button>
                        </div>
                    </div>
                </div>

                <div class="loc-appliance-card loc-appliance-card--inline" data-name="Double Oven" data-price="<?php echo $loc_eb ? '70' : '90'; ?>">
                    <svg width="48" height="48" viewBox="0 0 120 120" fill="none">
                        <rect x="14" y="14" width="92" height="92" rx="4" stroke="#1A3A6E" stroke-width="3" fill="none"/>
                        <rect x="14" y="14" width="92" height="16" rx="4" stroke="#1A3A6E" stroke-width="3" fill="#F0F4FA"/>
                        <circle cx="30" cy="22" r="4" stroke="#1A3A6E" stroke-width="2" fill="none"/><circle cx="30" cy="22" r="1.5" fill="#1A3A6E"/>
                        <circle cx="60" cy="22" r="4" stroke="#1A3A6E" stroke-width="2" fill="none"/><circle cx="60" cy="22" r="1.5" fill="#1A3A6E"/>
                        <circle cx="90" cy="22" r="4" stroke="#1A3A6E" stroke-width="2" fill="none"/><circle cx="90" cy="22" r="1.5" fill="#1A3A6E"/>
                        <rect x="22" y="34" width="76" height="26" rx="2" stroke="#1A3A6E" stroke-width="2.5" fill="none"/>
                        <rect x="30" y="39" width="60" height="16" rx="1.5" stroke="#1A3A6E" stroke-width="1.5" fill="#EEF3FA"/>
                        <line x1="34" y1="62" x2="86" y2="62" stroke="#1A3A6E" stroke-width="2.5" stroke-linecap="round"/>
                        <rect x="22" y="68" width="76" height="30" rx="2" stroke="#1A3A6E" stroke-width="2.5" fill="none"/>
                        <rect x="30" y="73" width="60" height="18" rx="1.5" stroke="#1A3A6E" stroke-width="1.5" fill="#EEF3FA"/>
                        <line x1="34" y1="100" x2="86" y2="100" stroke="#1A3A6E" stroke-width="2.5" stroke-linecap="round"/>
                    </svg>
                    <p class="loc-appliance-card__name">Double Oven</p>
                    <p class="loc-appliance-card__price"><?php echo $loc_eb ? 'From £70' : 'From £90'; ?></p>
                    <div class="loc-aga-options">
                        <p class="loc-aga-options__label">Add more</p>
                        <div class="loc-qty-stepper__controls">
                            <button class="loc-qty-btn loc-qty-btn--minus">−</button>
                            <button class="loc-qty-btn loc-qty-btn--plus">+</button>
                        </div>
                    </div>
                </div>

                <div class="loc-appliance-card loc-appliance-card--inline" data-name="Full Range Clean" data-price="125">
                    <svg width="48" height="48" viewBox="0 0 120 120" fill="none">
                        <rect x="8" y="24" width="104" height="82" rx="4" stroke="#1A3A6E" stroke-width="3" fill="none"/>
                        <rect x="8" y="24" width="104" height="18" rx="4" stroke="#1A3A6E" stroke-width="3" fill="#F0F4FA"/>
                        <rect x="14" y="48" width="42" height="50" rx="2" stroke="#1A3A6E" stroke-width="2.5" fill="none"/>
                        <rect x="20" y="54" width="30" height="30" rx="1.5" stroke="#1A3A6E" stroke-width="1.5" fill="#EEF3FA"/>
                        <rect x="64" y="48" width="42" height="50" rx="2" stroke="#1A3A6E" stroke-width="2.5" fill="none"/>
                        <rect x="70" y="54" width="30" height="30" rx="1.5" stroke="#1A3A6E" stroke-width="1.5" fill="#EEF3FA"/>
                    </svg>
                    <p class="loc-appliance-card__name">Full Range Clean</p>
                    <p class="loc-appliance-card__price">From £125</p>
                    <p class="loc-appliance-card__note">Every cavity, the hob and the exterior</p>
                    <div class="loc-aga-options">
                        <p class="loc-aga-options__label">Add more</p>
                        <div class="loc-qty-stepper__controls">
                            <button class="loc-qty-btn loc-qty-btn--minus">−</button>
                            <button class="loc-qty-btn loc-qty-btn--plus">+</button>
                        </div>
                    </div>
                </div>

                <!-- Partial Range Clean -->
                <div class="loc-appliance-card loc-appliance-card--inline" data-name="Partial Range Clean" data-price="55">
                    <svg width="48" height="48" viewBox="0 0 120 120" fill="none">
                        <rect x="8" y="24" width="104" height="82" rx="4" stroke="#1A3A6E" stroke-width="3" fill="none"/>
                        <rect x="8" y="24" width="104" height="18" rx="4" stroke="#1A3A6E" stroke-width="3" fill="#F0F4FA"/>
                        <rect x="14" y="48" width="42" height="50" rx="2" stroke="#1A3A6E" stroke-width="2.5" fill="none"/>
                        <rect x="20" y="54" width="30" height="30" rx="1.5" stroke="#1A3A6E" stroke-width="1.5" fill="#EEF3FA"/>
                        <rect x="64" y="48" width="42" height="50" rx="2" stroke="#1A3A6E" stroke-width="2.5" fill="none"/>
                        <rect x="70" y="54" width="30" height="30" rx="1.5" stroke="#1A3A6E" stroke-width="1.5" fill="#EEF3FA"/>
                    </svg>
                    <p class="loc-appliance-card__name">Partial Range Clean</p>
                    <p class="loc-appliance-card__price">From £55</p>
                    <p class="loc-appliance-card__note">Only the cavities you choose</p>
                    <div class="loc-aga-options">
                        <p class="loc-aga-options__label">Add more</p>
                        <div class="loc-qty-stepper__controls">
                            <button class="loc-qty-btn loc-qty-btn--minus">−</button>
                            <button class="loc-qty-btn loc-qty-btn--plus">+</button>
                        </div>
                    </div>
                </div>

                <!-- Free-Standing Oven -->
                <div class="loc-appliance-card loc-appliance-card--inline" data-name="Free-Standing Oven" data-price="<?php echo $loc_eb ? '55' : '70'; ?>">
                    <svg width="48" height="48" viewBox="0 0 120 120" fill="none">
                        <rect x="14" y="14" width="92" height="88" rx="4" stroke="#1A3A6E" stroke-width="3" fill="none"/>
                        <rect x="14" y="14" width="92" height="22" rx="4" stroke="#1A3A6E" stroke-width="3" fill="#F0F4FA"/>
                        <circle cx="32" cy="25" r="5" stroke="#1A3A6E" stroke-width="2.5" fill="none"/><circle cx="32" cy="25" r="1.5" fill="#1A3A6E"/>
                        <circle cx="50" cy="25" r="5" stroke="#1A3A6E" stroke-width="2.5" fill="none"/><circle cx="50" cy="25" r="1.5" fill="#1A3A6E"/>
                        <circle cx="70" cy="25" r="5" stroke="#1A3A6E" stroke-width="2.5" fill="none"/><circle cx="70" cy="25" r="1.5" fill="#1A3A6E"/>
                        <circle cx="88" cy="25" r="5" stroke="#1A3A6E" stroke-width="2.5" fill="none"/><circle cx="88" cy="25" r="1.5" fill="#1A3A6E"/>
                        <rect x="22" y="44" width="76" height="46" rx="3" stroke="#1A3A6E" stroke-width="2.5" fill="none"/>
                        <rect x="30" y="50" width="60" height="28" rx="2" stroke="#1A3A6E" stroke-width="2" fill="#EEF3FA"/>
                        <line x1="38" y1="86" x2="82" y2="86" stroke="#1A3A6E" stroke-width="3" stroke-linecap="round"/>
                        <line x1="28" y1="102" x2="28" y2="114" stroke="#1A3A6E" stroke-width="2.5" stroke-linecap="round"/>
                        <line x1="92" y1="102" x2="92" y2="114" stroke="#1A3A6E" stroke-width="2.5" stroke-linecap="round"/>
                    </svg>
                    <p class="loc-appliance-card__name">Free-Standing Oven</p>
                    <p class="loc-appliance-card__price"><?php echo $loc_eb ? 'From £55' : 'From £70'; ?></p>
                    <div class="loc-aga-options">
                        <p class="loc-aga-options__label">Add more</p>
                        <div class="loc-qty-stepper__controls">
                            <button class="loc-qty-btn loc-qty-btn--minus">−</button>
                            <button class="loc-qty-btn loc-qty-btn--plus">+</button>
                        </div>
                    </div>
                </div>

                <!-- AGA -->
                <div class="loc-appliance-card loc-appliance-card--inline loc-appliance-card--aga" id="loc-aga-inline-card" data-name="AGA / Large Range" data-price="0">
                    <svg width="48" height="48" viewBox="0 0 120 120" fill="none">
                        <rect x="6" y="18" width="108" height="88" rx="6" stroke="#1A3A6E" stroke-width="3" fill="none"/>
                        <rect x="6" y="18" width="108" height="14" rx="6" stroke="#1A3A6E" stroke-width="2.5" fill="#F0F4FA"/>
                        <rect x="14" y="38" width="38" height="36" rx="3" stroke="#1A3A6E" stroke-width="2.5" fill="none"/>
                        <circle cx="33" cy="56" r="10" stroke="#1A3A6E" stroke-width="2" fill="none"/>
                        <rect x="68" y="38" width="38" height="36" rx="3" stroke="#1A3A6E" stroke-width="2.5" fill="none"/>
                        <circle cx="87" cy="56" r="10" stroke="#1A3A6E" stroke-width="2" fill="none"/>
                        <rect x="14" y="82" width="92" height="16" rx="2" stroke="#1A3A6E" stroke-width="2" fill="none"/>
                    </svg>
                    <p class="loc-appliance-card__name">AGA / Large Range</p>
                    <p class="loc-appliance-card__price">£TBC</p>
                    <p class="loc-appliance-card__note">Price on request</p>
                </div>

                <!-- BBQ -->
                <div class="loc-appliance-card loc-appliance-card--inline loc-appliance-card--aga" id="loc-bbq-inline-card" data-name="BBQ" data-price="0">
                    <svg width="48" height="48" viewBox="0 0 120 120" fill="none">
                        <path d="M20 60 A40 32 0 0 0 100 60" stroke="#1A3A6E" stroke-width="3" fill="none"/>
                        <path d="M20 60 A40 22 0 0 1 100 60" stroke="#1A3A6E" stroke-width="3" fill="none"/>
                        <line x1="16" y1="60" x2="104" y2="60" stroke="#1A3A6E" stroke-width="2.5" stroke-linecap="round"/>
                        <rect x="54" y="24" width="12" height="8" rx="2" stroke="#1A3A6E" stroke-width="2" fill="none"/>
                        <line x1="36" y1="70" x2="84" y2="70" stroke="#1A3A6E" stroke-width="1.5" stroke-linecap="round" opacity="0.5"/>
                        <line x1="42" y1="82" x2="30" y2="108" stroke="#1A3A6E" stroke-width="2.5" stroke-linecap="round"/>
                        <line x1="60" y1="82" x2="60" y2="108" stroke="#1A3A6E" stroke-width="2.5" stroke-linecap="round"/>
                        <line x1="78" y1="82" x2="90" y2="108" stroke="#1A3A6E" stroke-width="2.5" stroke-linecap="round"/>
                    </svg>
                    <p class="loc-appliance-card__name">BBQ</p>
                    <p class="loc-appliance-card__price">£TBC</p>
                    <p class="loc-appliance-card__note">Price on request</p>
                </div>

            </div>
        </div>

        <!-- EXTRAS -->
        <div class="loc-appliance-group">
            <p class="loc-appliance-group__label">Extras — add to any booking</p>
            <div class="loc-appliance-cards loc-appliance-cards--inline">

                <div class="loc-appliance-card loc-appliance-card--inline" data-name="Gas Hob" data-price="25">
                    <svg width="48" height="48" viewBox="0 0 120 120" fill="none">
                        <rect x="10" y="20" width="100" height="80" rx="4" stroke="#1A3A6E" stroke-width="3" fill="none"/>
                        <circle cx="35" cy="40" r="13" stroke="#1A3A6E" stroke-width="2" fill="none"/>
                        <circle cx="35" cy="40" r="6" stroke="#1A3A6E" stroke-width="1.5" fill="none"/>
                        <circle cx="35" cy="40" r="2" fill="#1A3A6E"/>
                        <circle cx="85" cy="40" r="13" stroke="#1A3A6E" stroke-width="2" fill="none"/>
                        <circle cx="85" cy="40" r="6" stroke="#1A3A6E" stroke-width="1.5" fill="none"/>
                        <circle cx="85" cy="40" r="2" fill="#1A3A6E"/>
                        <circle cx="35" cy="80" r="13" stroke="#1A3A6E" stroke-width="2" fill="none"/>
                        <circle cx="35" cy="80" r="6" stroke="#1A3A6E" stroke-width="1.5" fill="none"/>
                        <circle cx="35" cy="80" r="2" fill="#1A3A6E"/>
                        <circle cx="85" cy="80" r="13" stroke="#1A3A6E" stroke-width="2" fill="none"/>
                        <circle cx="85" cy="80" r="6" stroke="#1A3A6E" stroke-width="1.5" fill="none"/>
                        <circle cx="85" cy="80" r="2" fill="#1A3A6E"/>
                    </svg>
                    <p class="loc-appliance-card__name">Gas Hob</p>
                    <p class="loc-appliance-card__price">From £25</p>
                    <div class="loc-aga-options">
                        <p class="loc-aga-options__label">Add more</p>
                        <div class="loc-qty-stepper__controls">
                            <button class="loc-qty-btn loc-qty-btn--minus">−</button>
                            <button class="loc-qty-btn loc-qty-btn--plus">+</button>
                        </div>
                    </div>
                </div>

                <div class="loc-appliance-card loc-appliance-card--inline" data-name="Ceramic / Induction Hob" data-price="25">
                    <svg width="48" height="48" viewBox="0 0 120 120" fill="none">
                        <rect x="10" y="20" width="100" height="80" rx="4" stroke="#1A3A6E" stroke-width="3" fill="none"/>
                        <circle cx="35" cy="40" r="13" stroke="#1A3A6E" stroke-width="2" fill="none" stroke-dasharray="4 3"/>
                        <circle cx="85" cy="40" r="13" stroke="#1A3A6E" stroke-width="2" fill="none" stroke-dasharray="4 3"/>
                        <circle cx="35" cy="80" r="13" stroke="#1A3A6E" stroke-width="2" fill="none" stroke-dasharray="4 3"/>
                        <circle cx="85" cy="80" r="13" stroke="#1A3A6E" stroke-width="2" fill="none" stroke-dasharray="4 3"/>
                    </svg>
                    <p class="loc-appliance-card__name">Ceramic / Induction Hob</p>
                    <p class="loc-appliance-card__price">From £25</p>
                    <div class="loc-aga-options">
                        <p class="loc-aga-options__label">Add more</p>
                        <div class="loc-qty-stepper__controls">
                            <button class="loc-qty-btn loc-qty-btn--minus">−</button>
                            <button class="loc-qty-btn loc-qty-btn--plus">+</button>
                        </div>
                    </div>
                </div>

                <div class="loc-appliance-card loc-appliance-card--inline" data-name="Extractor Hood" data-price="25">
                    <svg width="48" height="48" viewBox="0 0 120 120" fill="none">
                        <rect x="40" y="18" width="40" height="12" rx="2" stroke="#1A3A6E" stroke-width="2" fill="none"/>
                        <path d="M32 30 L88 30 L100 75 L20 75 Z" stroke="#1A3A6E" stroke-width="3" fill="#EEF3FA"/>
                        <line x1="44" y1="52" x2="76" y2="52" stroke="#1A3A6E" stroke-width="2" stroke-linecap="round" opacity="0.5"/>
                    </svg>
                    <p class="loc-appliance-card__name">Extractor Hood</p>
                    <p class="loc-appliance-card__price">From £25</p>
                    <div class="loc-aga-options">
                        <p class="loc-aga-options__label">Add more</p>
                        <div class="loc-qty-stepper__controls">
                            <button class="loc-qty-btn loc-qty-btn--minus">−</button>
                            <button class="loc-qty-btn loc-qty-btn--plus">+</button>
                        </div>
                    </div>
                </div>

                <div class="loc-appliance-card loc-appliance-card--inline" data-name="Microwave" data-price="15">
                    <svg width="48" height="48" viewBox="0 0 120 120" fill="none">
                        <rect x="8" y="30" width="104" height="60" rx="4" stroke="#1A3A6E" stroke-width="3" fill="none"/>
                        <rect x="16" y="38" width="62" height="44" rx="2" stroke="#1A3A6E" stroke-width="2.5" fill="#EEF3FA"/>
                        <rect x="88" y="38" width="16" height="44" rx="2" stroke="#1A3A6E" stroke-width="1.5" fill="none"/>
                        <circle cx="96" cy="50" r="4" stroke="#1A3A6E" stroke-width="1.5" fill="none"/>
                    </svg>
                    <p class="loc-appliance-card__name">Microwave</p>
                    <p class="loc-appliance-card__price">£15</p>
                    <div class="loc-aga-options">
                        <p class="loc-aga-options__label">Add more</p>
                        <div class="loc-qty-stepper__controls">
                            <button class="loc-qty-btn loc-qty-btn--minus">−</button>
                            <button class="loc-qty-btn loc-qty-btn--plus">+</button>
                        </div>
                    </div>
                </div>

                <div class="loc-appliance-card loc-appliance-card--inline" data-name="Combi Microwave" data-price="20">
                    <svg width="48" height="48" viewBox="0 0 120 120" fill="none">
                        <rect x="8" y="30" width="104" height="60" rx="4" stroke="#1A3A6E" stroke-width="3" fill="none"/>
                        <rect x="16" y="38" width="62" height="44" rx="2" stroke="#1A3A6E" stroke-width="2.5" fill="#EEF3FA"/>
                        <path d="M22 50 Q28 44 34 50 Q40 56 46 50 Q52 44 58 50 Q64 56 70 50" stroke="#1A3A6E" stroke-width="2" stroke-linecap="round" fill="none" opacity="0.7"/>
                        <ellipse cx="47" cy="72" rx="18" ry="5" stroke="#1A3A6E" stroke-width="1.5" fill="none" opacity="0.4"/>
                        <rect x="88" y="38" width="16" height="44" rx="2" stroke="#1A3A6E" stroke-width="1.5" fill="none"/>
                        <circle cx="96" cy="50" r="4" stroke="#1A3A6E" stroke-width="1.5" fill="none"/>
                        <circle cx="96" cy="66" r="3" fill="#1A3A6E" opacity="0.3"/>
                        <circle cx="96" cy="76" r="3" fill="#1A3A6E" opacity="0.3"/>
                    </svg>
                    <p class="loc-appliance-card__name">Combi Microwave</p>
                    <p class="loc-appliance-card__price">£20</p>
                    <div class="loc-aga-options">
                        <p class="loc-aga-options__label">Add more</p>
                        <div class="loc-qty-stepper__controls">
                            <button class="loc-qty-btn loc-qty-btn--minus">−</button>
                            <button class="loc-qty-btn loc-qty-btn--plus">+</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- SKIP PANEL -->
        <div class="loc-step1-skip-panel">
            <div class="loc-step1-skip-panel__inner">
                <div class="loc-step1-skip-panel__text">
                    <p class="loc-step1-skip-panel__heading">Prefer to talk it through instead?</p>
                    <p class="loc-step1-skip-panel__body">If you'd prefer to discuss your appliances over the phone, just click below. I'll go through everything together when I call to confirm your booking.</p>
                </div>
                <button class="loc-step1-skip-btn" id="loc-step2-skip-btn">
                    Discuss on the Call
                </button>
            </div>
        </div>

        <!-- INLINE SUMMARY -->
        <div class="loc-step2-inline-summary">
            <div class="loc-step2-inline-summary__header">
                <span class="loc-step2-inline-summary__title">Your Selection</span>
                <span class="loc-step2-inline-summary__total" id="loc-inline-total"><span>£</span>0</span>
            </div>
            <div class="loc-step2-inline-summary__items" id="loc-inline-items">
                <p class="loc-step2-inline-summary__empty">No appliances selected yet</p>
            </div>
            <div class="loc-step2-inline-summary__location-row">
                <span class="loc-step2-inline-summary__location-label">Location</span>
                <span class="loc-step2-inline-summary__location-value" id="loc-inline-postcode">&mdash;</span>
            </div>
            <a href="<?php echo home_url('/reserve-step-3'); ?>" class="loc-step2-btn-proceed loc-step2-btn-proceed--disabled" id="loc-inline-proceed-btn">
                Choose Your Date &rarr;
            </a>
        </div>

    </div><!-- /inline-section -->

    <!-- CONTINUE BUTTON — shown when arriving from Step 1 after postcode confirmed -->
    <div id="loc-continue-wrap" style="display:none;">
        <!-- POSTCODE CONFIRMED BANNER — hidden until confirmed -->
    <div class="loc-step2-confirmed-banner" id="loc-confirmed-banner" style="display:none;">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
            <circle cx="12" cy="12" r="10" fill="#C9960C"/>
            <path d="M7 12l3.5 3.5L17 8" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <p id="loc-confirmed-text">Postcode saved — showing you the best available dates.</p>
    </div>
        <!-- STATIC CONTINUE BAR (Step 1 sticky-bar look, in-flow) -->
        <div class="loc-step1-sticky-bottom loc-step1-sticky-bottom--static is-visible" id="loc-continue-bar">
            <div class="loc-step1-sticky-bottom__row">
                <div class="loc-step1-sticky-bottom__total">
                    <span class="loc-step1-sticky-bottom__label">Your total</span>
                    <span class="loc-step1-sticky-bottom__amount" id="loc-continue-total"><span>£</span>0</span>
                </div>
                <a href="<?php echo home_url('/reserve-step-3'); ?>" class="loc-step1-sticky-bottom__btn">
                    Choose Your Date &rarr;
                </a>
            </div>
            <div class="loc-step1-sticky-bottom__location-row">
                <span class="loc-step1-sticky-bottom__location-label">Location</span>
                <span class="loc-step1-sticky-bottom__location" id="loc-continue-postcode">&mdash;</span>
            </div>
        </div>
    </div>

</main>
        <!-- MOBILE STICKY BOTTOM BAR — Step 2 inline selection -->
        <div class="loc-step2-sticky-bottom" id="loc-step2-sticky-bottom">
            <div class="loc-step2-sticky-bottom__row">
                <div class="loc-step2-sticky-bottom__total">
                    <span class="loc-step2-sticky-bottom__label">Your total</span>
                    <span class="loc-step2-sticky-bottom__amount" id="loc-step2-sticky-total"><span>£</span>0</span>
                </div>
                <a href="<?php echo home_url('/reserve-step-3'); ?>" class="loc-step2-sticky-bottom__btn loc-step2-sticky-bottom__btn--disabled" id="loc-step2-sticky-btn">
                    Choose Your Date &rarr;
                </a>
            </div>
            <div class="loc-step2-sticky-bottom__location-row">
                <span class="loc-step2-sticky-bottom__location-label">Location</span>
                <span class="loc-step2-sticky-bottom__location" id="loc-step2-sticky-postcode">&mdash;</span>
            </div>
        </div>
<?php get_footer(); ?>