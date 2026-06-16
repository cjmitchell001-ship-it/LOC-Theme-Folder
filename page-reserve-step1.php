<?php
/**
 * Template Name: Reserve Step 1
 * Funnel Step 1 — Appliance selection & pricing
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

<!-- ============================================================
     FUNNEL HEADER — stripped back, logo + exit link only
     ============================================================ -->
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

<!-- ============================================================
     FUNNEL PROGRESS BAR
     ============================================================ -->
<div class="loc-funnel-progress">
    <div class="loc-funnel-steps">
        <div class="loc-funnel-step loc-funnel-step--active">
            <div class="loc-funnel-step__num">1</div>
            <span class="loc-funnel-step__label">Select Appliances</span>
            <div class="loc-funnel-step__arrow"></div>
        </div>
        <div class="loc-funnel-step loc-funnel-step--inactive">
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

<!-- ============================================================
     PAGE HEADER
     ============================================================ -->
<div class="loc-funnel-page-header">
    <p class="loc-funnel-page-header__eyebrow section-eyebrow">Step 1 of 3</p>
    <h1>What would you like cleaned?</h1>
    <p class="loc-funnel-page-header__intro">Select your oven and any extras below. Prices are fixed — what you see is what you pay, regardless of condition.</p>
</div>

<!-- ============================================================
     MAIN CONTENT
     ============================================================ -->
<main class="loc-step1-body" style="position:relative;">
    <!-- LEFT: APPLIANCE SELECTION -->
    <div class="loc-step1-selection">

        <h2 class="loc-step1-selection__heading">Choose your appliances</h2>

        <!-- OVENS GROUP -->
        <div class="loc-appliance-group">
            <p class="loc-appliance-group__label">Ovens</p>
            <div class="loc-appliance-cards">

                <!-- Single Oven -->
                <div class="loc-appliance-card" data-name="Single Oven" data-price="55">
                    <svg width="64" height="64" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
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
                    <p class="loc-appliance-card__price">£55</p>
                </div>

                <!-- Double Oven -->
                <div class="loc-appliance-card" data-name="Double Oven" data-price="70">
                    <svg width="64" height="64" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="14" y="14" width="92" height="92" rx="4" stroke="#1A3A6E" stroke-width="3" fill="none"/>
                        <rect x="14" y="14" width="92" height="16" rx="4" stroke="#1A3A6E" stroke-width="3" fill="#F0F4FA"/>
                        <circle cx="30" cy="22" r="4" stroke="#1A3A6E" stroke-width="2" fill="none"/><circle cx="30" cy="22" r="1.5" fill="#1A3A6E"/>
                        <circle cx="60" cy="22" r="4" stroke="#1A3A6E" stroke-width="2" fill="none"/><circle cx="60" cy="22" r="1.5" fill="#1A3A6E"/>
                        <circle cx="90" cy="22" r="4" stroke="#1A3A6E" stroke-width="2" fill="none"/><circle cx="90" cy="22" r="1.5" fill="#1A3A6E"/>
                        <line x1="14" y1="64" x2="106" y2="64" stroke="#1A3A6E" stroke-width="2" opacity="0.4"/>
                        <rect x="22" y="34" width="76" height="26" rx="2" stroke="#1A3A6E" stroke-width="2.5" fill="none"/>
                        <rect x="30" y="39" width="60" height="16" rx="1.5" stroke="#1A3A6E" stroke-width="1.5" fill="#EEF3FA"/>
                        <line x1="34" y1="62" x2="86" y2="62" stroke="#1A3A6E" stroke-width="2.5" stroke-linecap="round"/>
                        <rect x="22" y="68" width="76" height="30" rx="2" stroke="#1A3A6E" stroke-width="2.5" fill="none"/>
                        <rect x="30" y="73" width="60" height="18" rx="1.5" stroke="#1A3A6E" stroke-width="1.5" fill="#EEF3FA"/>
                        <line x1="34" y1="100" x2="86" y2="100" stroke="#1A3A6E" stroke-width="2.5" stroke-linecap="round"/>
                    </svg>
                    <p class="loc-appliance-card__name">Double Oven</p>
                    <p class="loc-appliance-card__price">£70</p>
                </div>

                <!-- Range Cooker 90cm -->
                <div class="loc-appliance-card" data-name="Range Cooker 90cm" data-price="100">
                    <svg width="64" height="64" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="8" y="24" width="104" height="82" rx="4" stroke="#1A3A6E" stroke-width="3" fill="none"/>
                        <rect x="8" y="24" width="104" height="18" rx="4" stroke="#1A3A6E" stroke-width="3" fill="#F0F4FA"/>
                        <circle cx="22" cy="33" r="4.5" stroke="#1A3A6E" stroke-width="2" fill="none"/><circle cx="22" cy="33" r="1.5" fill="#1A3A6E"/>
                        <circle cx="40" cy="33" r="4.5" stroke="#1A3A6E" stroke-width="2" fill="none"/><circle cx="40" cy="33" r="1.5" fill="#1A3A6E"/>
                        <circle cx="80" cy="33" r="4.5" stroke="#1A3A6E" stroke-width="2" fill="none"/><circle cx="80" cy="33" r="1.5" fill="#1A3A6E"/>
                        <circle cx="98" cy="33" r="4.5" stroke="#1A3A6E" stroke-width="2" fill="none"/><circle cx="98" cy="33" r="1.5" fill="#1A3A6E"/>
                        <rect x="14" y="48" width="42" height="50" rx="2" stroke="#1A3A6E" stroke-width="2.5" fill="none"/>
                        <rect x="20" y="54" width="30" height="30" rx="1.5" stroke="#1A3A6E" stroke-width="1.5" fill="#EEF3FA"/>
                        <line x1="20" y1="100" x2="56" y2="100" stroke="#1A3A6E" stroke-width="2.5" stroke-linecap="round"/>
                        <rect x="64" y="48" width="42" height="50" rx="2" stroke="#1A3A6E" stroke-width="2.5" fill="none"/>
                        <rect x="70" y="54" width="30" height="30" rx="1.5" stroke="#1A3A6E" stroke-width="1.5" fill="#EEF3FA"/>
                        <line x1="70" y1="100" x2="106" y2="100" stroke="#1A3A6E" stroke-width="2.5" stroke-linecap="round"/>
                    </svg>
                    <p class="loc-appliance-card__name">Range Cooker 90cm</p>
                    <p class="loc-appliance-card__price">£100</p>
                </div>

                <!-- Range Cooker 100cm+ -->
                <div class="loc-appliance-card" data-name="Range Cooker 100cm+" data-price="120">
                    <svg width="64" height="64" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="4" y="24" width="112" height="82" rx="4" stroke="#1A3A6E" stroke-width="3" fill="none"/>
                        <rect x="4" y="24" width="112" height="18" rx="4" stroke="#1A3A6E" stroke-width="3" fill="#F0F4FA"/>
                        <circle cx="16" cy="33" r="4" stroke="#1A3A6E" stroke-width="2" fill="none"/><circle cx="16" cy="33" r="1.5" fill="#1A3A6E"/>
                        <circle cx="30" cy="33" r="4" stroke="#1A3A6E" stroke-width="2" fill="none"/><circle cx="30" cy="33" r="1.5" fill="#1A3A6E"/>
                        <circle cx="60" cy="33" r="4" stroke="#1A3A6E" stroke-width="2" fill="none"/><circle cx="60" cy="33" r="1.5" fill="#1A3A6E"/>
                        <circle cx="90" cy="33" r="4" stroke="#1A3A6E" stroke-width="2" fill="none"/><circle cx="90" cy="33" r="1.5" fill="#1A3A6E"/>
                        <circle cx="104" cy="33" r="4" stroke="#1A3A6E" stroke-width="2" fill="none"/><circle cx="104" cy="33" r="1.5" fill="#1A3A6E"/>
                        <rect x="10" y="48" width="44" height="50" rx="2" stroke="#1A3A6E" stroke-width="2.5" fill="none"/>
                        <rect x="16" y="54" width="32" height="30" rx="1.5" stroke="#1A3A6E" stroke-width="1.5" fill="#EEF3FA"/>
                        <line x1="16" y1="100" x2="54" y2="100" stroke="#1A3A6E" stroke-width="2.5" stroke-linecap="round"/>
                        <rect x="66" y="48" width="44" height="50" rx="2" stroke="#1A3A6E" stroke-width="2.5" fill="none"/>
                        <rect x="72" y="54" width="32" height="30" rx="1.5" stroke="#1A3A6E" stroke-width="1.5" fill="#EEF3FA"/>
                        <line x1="72" y1="100" x2="110" y2="100" stroke="#1A3A6E" stroke-width="2.5" stroke-linecap="round"/>
                    </svg>
                    <p class="loc-appliance-card__name">Range Cooker 100cm+</p>
                    <p class="loc-appliance-card__price">£120</p>
                </div>

                <!-- AGA / Large Range — expand in place -->
                <div class="loc-appliance-card loc-appliance-card--aga" id="loc-aga-card" data-name="AGA / Large Range" data-price="0">
                    <svg width="64" height="64" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="6" y="18" width="108" height="88" rx="6" stroke="#1A3A6E" stroke-width="3" fill="none"/>
                        <rect x="6" y="18" width="108" height="14" rx="6" stroke="#1A3A6E" stroke-width="2.5" fill="#F0F4FA"/>
                        <rect x="14" y="38" width="38" height="36" rx="3" stroke="#1A3A6E" stroke-width="2.5" fill="none"/>
                        <circle cx="33" cy="56" r="10" stroke="#1A3A6E" stroke-width="2" fill="none"/>
                        <circle cx="33" cy="56" r="4" stroke="#1A3A6E" stroke-width="1.5" fill="none"/>
                        <rect x="68" y="38" width="38" height="36" rx="3" stroke="#1A3A6E" stroke-width="2.5" fill="none"/>
                        <circle cx="87" cy="56" r="10" stroke="#1A3A6E" stroke-width="2" fill="none"/>
                        <circle cx="87" cy="56" r="4" stroke="#1A3A6E" stroke-width="1.5" fill="none"/>
                        <rect x="14" y="82" width="92" height="16" rx="2" stroke="#1A3A6E" stroke-width="2" fill="none"/>
                        <line x1="30" y1="90" x2="90" y2="90" stroke="#1A3A6E" stroke-width="2" stroke-linecap="round" opacity="0.3"/>
                    </svg>
                    <p class="loc-appliance-card__name">AGA / Large Range</p>
                    <p class="loc-appliance-card__price" id="loc-aga-price">Select type &darr;</p>
                    <p class="loc-appliance-card__note" id="loc-aga-note">Tap to choose</p>
                    <p class="loc-aga-selected-variant" id="loc-aga-variant"></p>

                    <!-- AGA sub-options — revealed on click -->
                    <div class="loc-aga-options" id="loc-aga-options">
                        <p class="loc-aga-options__label">Which type of AGA?</p>
                        <button class="loc-aga-option" data-variant="2 Door" data-price="170">
                            <span>2 Door</span>
                            <span class="loc-aga-option__price">£170</span>
                        </button>
                        <button class="loc-aga-option" data-variant="3 Door" data-price="190">
                            <span>3 Door</span>
                            <span class="loc-aga-option__price">£190</span>
                        </button>
                        <button class="loc-aga-option" data-variant="With Companion" data-price="230">
                            <span>With Companion</span>
                            <span class="loc-aga-option__price">£230</span>
                        </button>
                        <button class="loc-aga-option" data-variant="With Module" data-price="260">
                            <span>With Module</span>
                            <span class="loc-aga-option__price">£260</span>
                        </button>
                        <button class="loc-aga-cancel">Cancel</button>
                    </div>
                </div>

            </div>
        </div><!-- /ovens group -->

        <!-- EXTRAS GROUP -->
        <div class="loc-appliance-group">
            <p class="loc-appliance-group__label">Add Extras</p>
            <div class="loc-appliance-cards">

                <!-- Gas Hob -->
                <div class="loc-appliance-card" data-name="Gas Hob" data-price="22">
                    <svg width="64" height="64" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="10" y="28" width="100" height="64" rx="4" stroke="#1A3A6E" stroke-width="3" fill="none"/>
                        <circle cx="38" cy="60" r="16" stroke="#1A3A6E" stroke-width="2" fill="none"/>
                        <circle cx="38" cy="60" r="8" stroke="#1A3A6E" stroke-width="1.5" fill="none"/>
                        <circle cx="38" cy="60" r="2.5" fill="#1A3A6E"/>
                        <circle cx="82" cy="60" r="16" stroke="#1A3A6E" stroke-width="2" fill="none"/>
                        <circle cx="82" cy="60" r="8" stroke="#1A3A6E" stroke-width="1.5" fill="none"/>
                        <circle cx="82" cy="60" r="2.5" fill="#1A3A6E"/>
                        <line x1="38" y1="44" x2="38" y2="40" stroke="#1A3A6E" stroke-width="2" stroke-linecap="round" opacity="0.4"/>
                        <line x1="82" y1="44" x2="82" y2="40" stroke="#1A3A6E" stroke-width="2" stroke-linecap="round" opacity="0.4"/>
                    </svg>
                    <p class="loc-appliance-card__name">Gas Hob</p>
                    <p class="loc-appliance-card__price">£22</p>
                </div>

                <!-- Ceramic / Induction Hob -->
                <div class="loc-appliance-card" data-name="Ceramic / Induction Hob" data-price="18">
                    <svg width="64" height="64" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="10" y="28" width="100" height="64" rx="4" stroke="#1A3A6E" stroke-width="3" fill="none"/>
                        <rect x="18" y="38" width="36" height="36" rx="18" stroke="#1A3A6E" stroke-width="2" fill="none" stroke-dasharray="4 3"/>
                        <rect x="66" y="38" width="36" height="36" rx="18" stroke="#1A3A6E" stroke-width="2" fill="none" stroke-dasharray="4 3"/>
                        <line x1="10" y1="82" x2="110" y2="82" stroke="#1A3A6E" stroke-width="1.5" opacity="0.2"/>
                        <text x="60" y="98" text-anchor="middle" fill="#1A3A6E" font-family="Montserrat, sans-serif" font-weight="700" font-size="10" opacity="0.5">CERAMIC / INDUCTION</text>
                    </svg>
                    <p class="loc-appliance-card__name">Ceramic / Induction Hob</p>
                    <p class="loc-appliance-card__price">£18</p>
                </div>

                <!-- Extractor Hood -->
                <div class="loc-appliance-card" data-name="Extractor Hood" data-price="22">
                    <svg width="64" height="64" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 30 L100 30 L88 70 L32 70 Z" stroke="#1A3A6E" stroke-width="3" fill="#EEF3FA"/>
                        <rect x="40" y="70" width="40" height="12" rx="2" stroke="#1A3A6E" stroke-width="2" fill="none"/>
                        <line x1="44" y1="44" x2="76" y2="44" stroke="#1A3A6E" stroke-width="2" stroke-linecap="round" opacity="0.5"/>
                        <line x1="48" y1="53" x2="72" y2="53" stroke="#1A3A6E" stroke-width="2" stroke-linecap="round" opacity="0.3"/>
                        <circle cx="55" cy="36" r="3" stroke="#1A3A6E" stroke-width="1.5" fill="none"/>
                        <circle cx="65" cy="36" r="3" stroke="#1A3A6E" stroke-width="1.5" fill="none"/>
                        <line x1="60" y1="88" x2="60" y2="100" stroke="#1A3A6E" stroke-width="2" stroke-linecap="round" opacity="0.3"/>
                        <path d="M54 94L60 100L66 94" stroke="#1A3A6E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" opacity="0.3"/>
                    </svg>
                    <p class="loc-appliance-card__name">Extractor Hood</p>
                    <p class="loc-appliance-card__price">£22</p>
                </div>

                <!-- Microwave -->
                <div class="loc-appliance-card" data-name="Microwave" data-price="18">
                    <svg width="64" height="64" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="8" y="30" width="104" height="60" rx="4" stroke="#1A3A6E" stroke-width="3" fill="none"/>
                        <rect x="16" y="38" width="62" height="44" rx="2" stroke="#1A3A6E" stroke-width="2.5" fill="#EEF3FA"/>
                        <rect x="88" y="38" width="16" height="44" rx="2" stroke="#1A3A6E" stroke-width="1.5" fill="none"/>
                        <circle cx="96" cy="50" r="4" stroke="#1A3A6E" stroke-width="1.5" fill="none"/>
                        <circle cx="96" cy="66" r="3" fill="#1A3A6E" opacity="0.3"/>
                        <circle cx="96" cy="76" r="3" fill="#1A3A6E" opacity="0.3"/>
                        <line x1="25" y1="60" x2="65" y2="60" stroke="#1A3A6E" stroke-width="1.5" stroke-linecap="round" opacity="0.3"/>
                    </svg>
                    <p class="loc-appliance-card__name">Microwave</p>
                    <p class="loc-appliance-card__price">£18</p>
                </div>

            </div>
        </div><!-- /extras group -->

    </div><!-- /loc-step1-selection -->

    <!-- SIDEBAR: discuss, totals, guarantee (single grid item at desktop) -->
    <div class="loc-step1-sidebar">

        <!-- SKIP + TOTALS ROW (601px+) -->
        <div class="loc-step1-bottom-row">

            <!-- SKIP PANEL -->
            <div class="loc-step1-skip-panel">
                <div class="loc-step1-skip-panel__inner">
                    <div class="loc-step1-skip-panel__text">
                        <p class="loc-step1-skip-panel__heading">Prefer to talk it through instead?</p>
                        <p class="loc-step1-skip-panel__body">If you'd prefer to discuss your appliances over the phone, just click below. We'll go through everything together when we call to confirm your booking.</p>
                    </div>
                    <button class="loc-step1-skip-btn" id="loc-skip-btn">
                        Discuss on the Call
                    </button>
                </div>
            </div>

            <!-- IN-FLOW TOTALS PANEL (601px+) -->
            <div class="loc-step1-inflow-total" id="loc-step1-inflow-total">
                <div class="loc-step1-sticky-bottom loc-step1-sticky-bottom--static is-visible">
                    <div class="loc-step1-sticky-bottom__row">
                        <div class="loc-step1-sticky-bottom__total">
                            <span class="loc-step1-sticky-bottom__label">Your total</span>
                            <span class="loc-step1-sticky-bottom__amount" id="loc-step1-inflow-amount"><span>£</span>0</span>
                        </div>
                        <a href="<?php echo home_url('/reserve-step-2'); ?>" class="loc-step1-sticky-bottom__btn loc-step1-sticky-bottom__btn--disabled" id="loc-step1-inflow-btn">
                            Choose Your Area
                        </a>
                    </div>
                </div>
            </div>

        </div><!-- /bottom-row -->

        <!-- PRICE GUARANTEE -->
        <div class="loc-step1-price-guarantee">
            <p><strong>Fixed price guaranteed.</strong> The total shown is the price you pay — no matter the condition of your appliances when we arrive. Confirmed before we start.</p>
        </div>

    </div><!-- /sidebar -->

</main>

<!-- STICKY BOTTOM BAR — Step 1 -->
<div class="loc-step1-sticky-bottom" id="loc-step1-sticky-bottom">
    <div class="loc-step1-sticky-bottom__total">
        <span class="loc-step1-sticky-bottom__label">Your total</span>
        <span class="loc-step1-sticky-bottom__amount" id="loc-step1-sticky-total"><span>£</span>0</span>
    </div>
    <a href="<?php echo home_url('/reserve-step-2'); ?>" class="loc-step1-sticky-bottom__btn loc-step1-sticky-bottom__btn--disabled" id="loc-step1-sticky-btn">
        Choose Your Area &rarr;
    </a>
</div>

<!-- SCROLL INDICATOR — shown at 601px+ after first selection -->
<div class="loc-step1-scroll-hint" id="loc-step1-scroll-hint" aria-hidden="true">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
        <path d="M12 5v14M5 13l7 7 7-7" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
</div>

<?php get_footer(); ?>
