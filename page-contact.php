<?php
/**
 * Template Name: Contact
 * Contact page — Leicester Oven Cleaning
 */

get_header();
?>

<main id="loc-contact">

    <!-- PAGE HEADER -->
    <section class="loc-page-header">
        <div class="loc-page-header__inner">
            <p class="loc-page-header__eyebrow section-eyebrow">Get In Touch</p>
            <h1>Got a question? <span>We're happy to help.</span></h1>
            <p class="loc-page-header__intro">Not ready to reserve yet? Ask us anything — we'll get back to you within one working day.</p>
        </div>
    </section>

    <!-- MAIN CONTENT -->
    <section class="loc-contact-body">
        <div class="loc-contact-body__inner">

            <!-- LEFT — CONTACT DETAILS -->
            <div class="loc-contact-details">

                <p class="section-eyebrow">Contact details</p>
                <h2 class="loc-contact-details__title">How to reach us</h2>
                <p class="loc-contact-details__intro">We're a local Leicester business — you're always speaking directly with Chris, not a call centre or an automated system.</p>

                <!-- CONTACT METHOD CARDS -->
                <div class="loc-contact-methods">

                    <div class="loc-contact-method">
                        <div class="loc-contact-method__icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                                <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81a19.79 19.79 0 01-3.07-8.63A2 2 0 012 .82h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 8.64a16 16 0 006.29 6.29l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z" stroke="#C9960C" stroke-width="2"/>
                            </svg>
                        </div>
                        <div class="loc-contact-method__text">
                            <p class="loc-contact-method__label">Phone</p>
                            <p class="loc-contact-method__value"><a href="tel:PLACEHOLDER">Number TBC — coming soon</a></p>
                            <p class="loc-contact-method__note">Mon–Sat, 8am–6pm</p>
                        </div>
                    </div>

                    <div class="loc-contact-method">
                        <div class="loc-contact-method__icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" stroke="#C9960C" stroke-width="2"/>
                                <polyline points="22,6 12,13 2,6" stroke="#C9960C" stroke-width="2"/>
                            </svg>
                        </div>
                        <div class="loc-contact-method__text">
                            <p class="loc-contact-method__label">Email</p>
                            <p class="loc-contact-method__value"><a href="mailto:hello@leicesterovencleaning.co.uk">hello@leicesterovencleaning.co.uk</a></p>
                            <p class="loc-contact-method__note">We aim to reply within one working day</p>
                        </div>
                    </div>

                    <div class="loc-contact-method">
                        <div class="loc-contact-method__icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z" stroke="#C9960C" stroke-width="2"/>
                                <circle cx="12" cy="10" r="3" stroke="#C9960C" stroke-width="2"/>
                            </svg>
                        </div>
                        <div class="loc-contact-method__text">
                            <p class="loc-contact-method__label">Service area</p>
                            <p class="loc-contact-method__value">Leicester &amp; Leicestershire</p>
                            <p class="loc-contact-method__note">All LE postcodes — see Areas page for full coverage</p>
                        </div>
                    </div>

                </div>

                <!-- RESPONSE PROMISE -->
                <div class="loc-contact-promise">
                    <p class="loc-contact-promise__title">Our response promise</p>
                    <ul class="loc-contact-promise__list">
                        <li>Phone and email enquiries answered within one working day</li>
                        <li>Reservation callbacks made the same day where possible</li>
                        <li>No automated replies — you always hear from Chris directly</li>
                    </ul>
                </div>

                <!-- RESERVE NUDGE -->
                <div class="loc-contact-reserve-nudge">
                    <div class="loc-contact-reserve-nudge__icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                            <circle cx="12" cy="12" r="10" stroke="#C9960C" stroke-width="2"/>
                            <line x1="12" y1="8" x2="12" y2="12" stroke="#C9960C" stroke-width="2" stroke-linecap="round"/>
                            <circle cx="12" cy="16" r="1" fill="#C9960C"/>
                        </svg>
                    </div>
                    <div class="loc-contact-reserve-nudge__text">
                        <p class="loc-contact-reserve-nudge__title">Ready to book instead?</p>
                        <p class="loc-contact-reserve-nudge__sub">Skip the form — reserve your slot in 2 minutes online. No card needed, we call to confirm.</p>
                        <a href="/reserve-step-1" class="btn-primary loc-contact-reserve-nudge__btn">Reserve Your Slot →</a>
                    </div>
                </div>

            </div>

            <!-- RIGHT — CONTACT FORM -->
            <div class="loc-contact-form-col">

                <div class="loc-contact-form-box" id="loc-contact-form-box">
                    <p class="loc-contact-form-box__title">Send us a message</p>
                    <p class="loc-contact-form-box__sub">Not ready to reserve yet? Ask us anything — we'll get back to you within one working day.</p>

                    <!-- ENQUIRY TYPE SELECTOR -->
                    <p class="loc-contact-form-box__type-label">What's your enquiry about?</p>
                    <div class="loc-contact-enquiry-types" id="loc-enquiry-types">
                        <button class="loc-enquiry-btn loc-enquiry-btn--selected" type="button" data-type="Booking query">Booking query</button>
                        <button class="loc-enquiry-btn" type="button" data-type="Pricing question">Pricing question</button>
                        <button class="loc-enquiry-btn" type="button" data-type="Business / commercial">Business / commercial</button>
                        <button class="loc-enquiry-btn" type="button" data-type="Something else">Something else</button>
                    </div>

                    <!-- CONTACT FORM 7 SHORTCODE -->
                    <div class="loc-cf7-wrapper">
                        <?php echo do_shortcode('[contact-form-7 id="1bfbd11" title="Contact Form"]'); ?>
                    </div>

                    <p class="loc-contact-form-box__privacy">Your details are used only to respond to your enquiry. View our <a href="/privacy-policy">Privacy Policy</a>.</p>

                </div>

            </div>

        </div>
    </section>

</main>

<?php get_footer(); ?>