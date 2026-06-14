<?php
/**
 * Template Name: Reserve Step 3
 * Funnel Step 3 — Choose your date
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
        <a href="<?php echo home_url('/reserve-step-2'); ?>" class="loc-funnel-step loc-funnel-step--complete">
            <div class="loc-funnel-step__num">&#10003;</div>
            <span class="loc-funnel-step__label">Your Area</span>
            <div class="loc-funnel-step__arrow"></div>
        </a>
        <div class="loc-funnel-step loc-funnel-step--active">
            <div class="loc-funnel-step__num">3</div>
            <span class="loc-funnel-step__label">Choose Your Date</span>
        </div>
    </div>
</div>

<!-- PAGE HEADER -->


<!-- MAIN BODY -->
<div class="loc-step3-body" id="loc-step3-main">

    <!-- LEFT: CALENDAR -->
    <div class="loc-step3-calendar-col">

        <p class="loc-step3-eyebrow">Available Slots</p>
        <h2 class="loc-step3-section-heading">Select a date</h2>
        <!-- LEGEND -->
        <div class="loc-step3-legend">
            <div class="loc-step3-legend-item">
                <div class="loc-step3-legend-dot loc-step3-legend-dot--available"></div>
                <span>Available</span>
            </div>
            <div class="loc-step3-legend-item">
                <div class="loc-step3-legend-dot loc-step3-legend-dot--unavailable"></div>
                <span>Unavailable</span>
            </div>
        </div>


        <!-- CALENDAR NAV -->
        <div class="loc-step3-cal-nav">
            <button class="loc-step3-cal-nav-btn" id="loc-cal-prev">&larr; Prev</button>
            <span class="loc-step3-cal-month" id="loc-cal-month"></span>
            <button class="loc-step3-cal-nav-btn" id="loc-cal-next">Next &rarr;</button>
        </div>

        <!-- CALENDAR TABLE -->
        <table class="loc-step3-cal-grid">
            <thead>
                <tr>
                    <th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th><th>Sun</th>
                </tr>
            </thead>
            <tbody id="loc-cal-body"></tbody>
        </table>

        <!-- TIME SLOT PICKER — revealed on date select -->
        <div class="loc-step3-time-slots" id="loc-time-slots" style="display:none;">
            <p class="loc-step3-time-slots__title">Choose a time window for <span id="loc-selected-date-label"></span></p>
            <div class="loc-step3-time-slots__grid">
                <button class="loc-step3-slot-btn" data-label="Morning" data-time="8am &ndash; 1pm">
                    <span class="loc-step3-slot-btn__label">Morning</span>
                    <span class="loc-step3-slot-btn__time">8am &ndash; 1pm</span>
                </button>
                <button class="loc-step3-slot-btn" data-label="Afternoon" data-time="1pm &ndash; 6pm">
                    <span class="loc-step3-slot-btn__label">Afternoon</span>
                    <span class="loc-step3-slot-btn__time">1pm &ndash; 6pm</span>
                </button>
            </div>
        </div>

        <!-- ESCAPE HATCH — for users who can't find a suitable date -->
        <div class="loc-step3-date-escape" id="loc-date-escape">
            <p class="loc-step3-date-escape__heading">Need a specific date?</p>
            <p class="loc-step3-date-escape__body">If you need your oven cleaned by a particular date — or you can't see a slot that works for you — just let us know. We'll sort it over the phone.</p>
            <div class="loc-step3-date-escape__btns">
                <a href="tel:+441234567890" class="loc-step3-date-escape__btn loc-step3-date-escape__btn--call">Call Us</a>
                <button class="loc-step3-date-escape__btn loc-step3-date-escape__btn--discuss" id="loc-date-escape-btn">Confirm On Call</button>
            </div>
        </div>

    </div><!-- /calendar-col -->

    <!-- RIGHT: ORDER SUMMARY -->
    <aside class="loc-step3-summary-col">

        <!-- CLEAR DATE BUTTON -->
        <button class="loc-step3-clear-btn" id="loc-clear-date-btn" style="display:none;">
            <span>Clear Date</span>
        </button>

        <div class="loc-step3-summary-box">
            <p class="loc-step3-summary__title">Your Reservation</p>
            <div class="loc-step3-summary__items" id="loc-summary-items">
                <p class="loc-step3-summary__empty">Loading your selection&hellip;</p>
            </div>
            <div class="loc-step3-summary__total-row">
                <span class="loc-step3-summary__total-label">Total</span>
                <span class="loc-step3-summary__total-amount" id="loc-summary-total"><span>&pound;</span>0</span>
            </div>
            <div class="loc-step3-summary__location-row">
                <span class="loc-step3-summary__location-label">Location</span>
                <span class="loc-step3-summary__location-value" id="loc-summary-postcode">&mdash;</span>
            </div>

            <!-- Date & Time rows -->
            <div class="loc-step3-summary__location-row">
                <span class="loc-step3-summary__location-label">Date</span>
                <span class="loc-step3-summary__location-value" id="loc-summary-slot-date">&mdash;</span>
            </div>
            <div class="loc-step3-summary__location-row">
                <span class="loc-step3-summary__location-label">Time</span>
                <span class="loc-step3-summary__location-value" id="loc-summary-slot-time">&mdash;</span>
            </div>

            <!-- Reserve button — only shown when date + time selected -->
            <div class="loc-step3-summary__slot" id="loc-summary-slot">
                <button class="loc-step3-summary__slot-reserve" id="loc-slot-reserve-btn">
                    Reserve Your Slot &rarr;
                </button>
            </div>
        </div>
        <div class="loc-step3-price-guarantee">
            <p><strong>Fixed price guaranteed.</strong> The total shown is what you pay on the day — regardless of condition.</p>
        </div>
            <p class="loc-step3-reserve-subtext">No card taken now &middot; We call to confirm &middot; &pound;25 deposit on the call</p>
    </aside>

</div><!-- /loc-step3-body -->

<!-- CONFIRMATION PANEL — replaces page body on submit -->
<div class="loc-step3-body loc-step3-body--confirm" id="loc-confirmation-wrap" style="display:none;">
    <div class="loc-step3-confirm-panel">

        <div class="loc-step3-confirm-tick">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none">
                <path d="M5 12l5 5L19 7" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>

        <h2 class="loc-step3-confirm-heading">Your slot is reserved.</h2>
        <p class="loc-step3-confirm-sub">There&rsquo;s nothing more to do right now. We&rsquo;ll be in touch to confirm everything &mdash; no card has been taken.</p>

        <div class="loc-step3-confirm-grid">
            <div class="loc-step3-confirm-box">
                <p class="loc-step3-confirm-box__label">Date &amp; Time</p>
                <p class="loc-step3-confirm-box__value" id="loc-confirm-date">&mdash;</p>
            </div>
            <div class="loc-step3-confirm-box">
                <p class="loc-step3-confirm-box__label">Your Total</p>
                <p class="loc-step3-confirm-box__value" id="loc-confirm-total">&mdash;</p>
            </div>
            <div class="loc-step3-confirm-box">
                <p class="loc-step3-confirm-box__label">Name</p>
                <p class="loc-step3-confirm-box__value" id="loc-confirm-name">&mdash;</p>
            </div>
            <div class="loc-step3-confirm-box">
                <p class="loc-step3-confirm-box__label">Callback Preference</p>
                <p class="loc-step3-confirm-box__value" id="loc-confirm-callback">&mdash;</p>
            </div>
        </div>

        <!-- SMART CALLBACK MESSAGE -->
        <div class="loc-step3-callback-message">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.86 9.1 19.79 19.79 0 01.79.5 2 2 0 012.77 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.91 7.91a16 16 0 006.06 6.06l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z" stroke="#C9960C" stroke-width="2"/>
            </svg>
            <div>
                <strong>When we&rsquo;ll call</strong>
                <p id="loc-callback-smart-message">We&rsquo;ll be in touch during your preferred callback window.</p>
            </div>
        </div>

        <a href="<?php echo home_url('/'); ?>" class="loc-step3-btn-home">&larr; Back to Home</a>

    </div>
</div>

<!-- CONTACT DETAILS MODAL -->
<div class="loc-step3-modal-overlay" id="loc-modal-overlay">
    <div class="loc-step3-modal">

        <button class="loc-step3-modal__close" id="loc-modal-close">&#10005;</button>

        <div class="loc-step3-modal__header">
            <h2>Almost done &mdash; just a few details</h2>
            <p>We&rsquo;ll use these to call and confirm your reservation. Nothing else.</p>
        </div>

        <div class="loc-step3-modal__slot-strip">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                <rect x="3" y="4" width="18" height="18" rx="2" stroke="#C9960C" stroke-width="2"/>
                <line x1="16" y1="2" x2="16" y2="6" stroke="#C9960C" stroke-width="2" stroke-linecap="round"/>
                <line x1="8" y1="2" x2="8" y2="6" stroke="#C9960C" stroke-width="2" stroke-linecap="round"/>
            </svg>
            <p>Reserving: <span id="loc-modal-slot-summary">&mdash;</span></p>
        </div>

        <div class="loc-step3-modal__body">

            <div class="loc-step3-form-row">
                <div class="loc-step3-form-group">
                    <label class="loc-step3-form-label">First Name</label>
                    <input type="text" class="loc-step3-form-input" id="loc-first-name" placeholder="Sarah" autocomplete="given-name"/>
                </div>
                <div class="loc-step3-form-group">
                    <label class="loc-step3-form-label">Last Name</label>
                    <input type="text" class="loc-step3-form-input" id="loc-last-name" placeholder="Johnson" autocomplete="family-name"/>
                </div>
            </div>

            <div class="loc-step3-form-group loc-step3-form-group--full">
                <label class="loc-step3-form-label">Phone Number</label>
                <input type="tel" class="loc-step3-form-input" id="loc-phone" placeholder="07700 000000" autocomplete="tel"/>
            </div>

            <div class="loc-step3-form-group loc-step3-form-group--full">
                <label class="loc-step3-form-label">Email Address</label>
                <input type="email" class="loc-step3-form-input" id="loc-email" placeholder="sarah@example.com" autocomplete="email"/>
            </div>

            <span class="loc-step3-callback-label">Preferred Callback Time</span>
            <div class="loc-step3-callback-options">
                <button class="loc-step3-callback-btn" data-label="Morning" data-time="8am &ndash; 12pm">
                    <span class="loc-step3-callback-btn__label">Morning</span>
                    <span class="loc-step3-callback-btn__time">8am &ndash; 12pm</span>
                </button>
                <button class="loc-step3-callback-btn" data-label="Afternoon" data-time="12pm &ndash; 5pm">
                    <span class="loc-step3-callback-btn__label">Afternoon</span>
                    <span class="loc-step3-callback-btn__time">12pm &ndash; 5pm</span>
                </button>
                <button class="loc-step3-callback-btn" data-label="Evening" data-time="5pm &ndash; 8pm">
                    <span class="loc-step3-callback-btn__label">Evening</span>
                    <span class="loc-step3-callback-btn__time">5pm &ndash; 8pm</span>
                </button>
            </div>

            <p class="loc-step3-form-privacy">Your details are used only to confirm this reservation. We&rsquo;ll never share them. <a href="<?php echo home_url('/privacy-policy'); ?>">Privacy Policy</a>.</p>

            <button class="loc-step3-btn-submit" id="loc-submit-btn">Confirm My Reservation &rarr;</button>

        </div>
    </div>
</div>
<!-- MOBILE STICKY BOTTOM BAR — Step 3 -->
<div class="loc-step3-sticky-bottom" id="loc-step3-sticky-bottom">
    <div class="loc-step3-sticky-bottom__info">
        <span class="loc-step3-sticky-bottom__slot" id="loc-sticky-slot">Select a date above</span>
        <span class="loc-step3-sticky-bottom__total">£<span id="loc-sticky-total-3"><?php echo '0'; ?></span></span>
    </div>
    <button class="loc-step3-sticky-bottom__btn loc-step3-sticky-bottom__btn--disabled" id="loc-step3-sticky-btn">
        Reserve Your Slot &rarr;
    </button>
</div>

<?php get_footer(); ?>