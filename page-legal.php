<?php
/**
 * Template Name: Legal Page
 * Shared template for all legal pages —
 * Privacy Policy, Terms & Conditions, Cancellation Policy, Cookie Policy
 */

get_header();

// Get current page slug to determine which content to show
$slug = get_post_field('post_name', get_the_ID());

// Page titles and eyebrow labels
$page_titles = [
    'privacy-policy'      => ['eyebrow' => 'Legal', 'title' => 'Privacy Policy'],
    'terms-and-conditions' => ['eyebrow' => 'Legal', 'title' => 'Terms &amp; Conditions'],
    'cancellation-policy'  => ['eyebrow' => 'Legal', 'title' => 'Cancellation Policy'],
    'cookie-policy'        => ['eyebrow' => 'Legal', 'title' => 'Cookie Policy'],
];

$current = $page_titles[$slug] ?? ['eyebrow' => 'Legal', 'title' => get_the_title()];
?>

<main id="loc-legal">

    <!-- PAGE HEADER -->
    <section class="loc-page-header loc-legal-header">
        <div class="loc-legal-header__inner">
            <p class="loc-page-header__eyebrow section-eyebrow"><?php echo $current['eyebrow']; ?></p>
            <h1><?php echo $current['title']; ?></h1>
            <div class="loc-legal-header__meta">
                <div class="loc-legal-meta-item">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><rect x="3" y="4" width="18" height="18" rx="2" stroke="rgba(255,255,255,0.5)" stroke-width="2"/><line x1="16" y1="2" x2="16" y2="6" stroke="rgba(255,255,255,0.5)" stroke-width="2" stroke-linecap="round"/><line x1="8" y1="2" x2="8" y2="6" stroke="rgba(255,255,255,0.5)" stroke-width="2" stroke-linecap="round"/></svg>
                    <span>Last updated: <strong>May 2026</strong></span>
                </div>
                <div class="loc-legal-meta-item">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" stroke="rgba(255,255,255,0.5)" stroke-width="2"/></svg>
                    <span>ICO Registration: <strong>[Pending — inserting before go-live]</strong></span>
                </div>
            </div>
        </div>
    </section>

    <!-- BODY -->
    <div class="loc-legal-body">
        <div class="loc-legal-body__inner">

            <!-- CONTENT -->
            <div class="loc-legal-content">

                <?php if ($slug === 'privacy-policy'): ?>

                <div class="loc-legal-section">
                    <p class="loc-legal-section__label">Introduction</p>
                    <h2>Your privacy matters to us</h2>
                    <p>Leicester Oven Cleaning is a trading name operated as a sole trader. We are committed to protecting the personal information of our customers and website visitors in accordance with UK data protection law, including the UK General Data Protection Regulation (UK GDPR) and the Data Protection Act 2018.</p>
                    <p>This Privacy Policy explains what personal information we collect, why we collect it, how we use it, how long we keep it, and what your rights are.</p>
                    <p>If you have any questions about this policy or how we handle your data, please contact us at <a href="mailto:hello@leicesterovencleaning.co.uk">hello@leicesterovencleaning.co.uk</a>.</p>
                    <div class="loc-legal-important">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="10" stroke="#1A3A6E" stroke-width="2"/><line x1="12" y1="8" x2="12" y2="12" stroke="#1A3A6E" stroke-width="2" stroke-linecap="round"/><circle cx="12" cy="16" r="1" fill="#1A3A6E"/></svg>
                        <p><strong>We will be registered with the Information Commissioner's Office (ICO) before this website goes live.</strong> Our ICO registration number will be displayed here once registration is complete.</p>
                    </div>
                </div>

                <div class="loc-legal-section" id="section-who">
                    <p class="loc-legal-section__label">Section 1</p>
                    <h2>Who we are</h2>
                    <p>The data controller responsible for your personal information is:</p>
                    <div class="loc-legal-highlight">
                        <p><strong>Trading name:</strong> Leicester Oven Cleaning<br>
                        <strong>Business type:</strong> Sole trader<br>
                        <strong>Legal name:</strong> [LEGAL NAME — required for sole trader disclosure]<br>
                        <strong>Contact address:</strong> [CONTACT ADDRESS — required for sole trader disclosure]<br>
                        <strong>Operating area:</strong> Leicester and Leicestershire<br>
                        <strong>Contact email:</strong> hello@leicesterovencleaning.co.uk<br>
                        <strong>Contact phone:</strong> [Number to be confirmed]<br>
                        <strong>ICO registration number:</strong> [To be inserted before go-live]</p>
                    </div>
                </div>

                <div class="loc-legal-section" id="section-collect">
                    <p class="loc-legal-section__label">Section 2</p>
                    <h2>What personal information we collect</h2>
                    <p>We collect only the information necessary to provide our service and communicate with you about your booking. We do not collect more than we need.</p>
                    <h3>Information you provide through our website</h3>
                    <p>When you use our online slot reservation system, we collect:</p>
                    <ul>
                        <li>Your first and last name</li>
                        <li>Your email address</li>
                        <li>Your phone number</li>
                        <li>Your postcode (used to check coverage and optimise scheduling)</li>
                        <li>Your preferred appointment date and time window</li>
                        <li>Your selected appliance type(s)</li>
                    </ul>
                    <p>When you contact us via our contact form, we collect:</p>
                    <ul>
                        <li>Your name</li>
                        <li>Your email address</li>
                        <li>The content of your message</li>
                    </ul>
                    <h3>Information collected automatically</h3>
                    <p>When you visit our website, certain technical information is collected automatically by our hosting provider for performance and security purposes — this may include your IP address, browser type, and time of visit. We also use Cloudflare Web Analytics, a cookieless, privacy-first tool that gives us only aggregate statistics (page views, referrers, country, and device type). It sets no cookies, uses no personal identifiers, and does not track you across other websites.</p>
                </div>

                <div class="loc-legal-section" id="section-why">
                    <p class="loc-legal-section__label">Section 3</p>
                    <h2>Why we collect your information and our lawful basis</h2>
                    <div class="loc-legal-table-wrap">
                        <table class="loc-legal-table">
                            <thead>
                                <tr>
                                    <th>Purpose</th>
                                    <th>Lawful basis</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr><td>Processing your slot reservation and confirming your booking by telephone</td><td>Contract — necessary to provide the service you've requested</td></tr>
                                <tr><td>Sending you a deposit payment request after your confirmation call</td><td>Contract — necessary to complete the booking process</td></tr>
                                <tr><td>Sending automated reminder emails if your deposit remains unpaid</td><td>Contract — necessary to manage the booking slot</td></tr>
                                <tr><td>Contacting you to confirm, amend, or follow up on your booking</td><td>Contract — necessary to deliver the service</td></tr>
                                <tr><td>Responding to general enquiries submitted via our contact form</td><td>Legitimate interests — to respond to your request</td></tr>
                                <tr><td>Maintaining records of completed jobs for accounting and legal purposes</td><td>Legal obligation — required for financial record-keeping</td></tr>
                                <tr><td>Website analytics and performance monitoring</td><td>Legitimate interests — to maintain and improve our website</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="loc-legal-section" id="section-share">
                    <p class="loc-legal-section__label">Section 4</p>
                    <h2>Who we share your information with</h2>
                    <p>We do not sell, rent, or trade your personal information to any third party.</p>
                    <p>Right now, your information is handled directly by us — when you submit a reservation or enquiry, your details are used only to call or email you back and arrange your booking. We don't currently use any third-party booking or payment software. Our website statistics come from Cloudflare Web Analytics, which is cookieless and aggregate-only — it never receives your name, contact details, or anything else that identifies you.</p>
                    <p>As the business grows, we may begin using third-party tools to help manage bookings, payments, or website performance. If we do, this policy will be updated to name those providers before they're put into use, and they will always be required to handle your data securely and in line with UK data protection law.</p>
                </div>

                <div class="loc-legal-section" id="section-retention">
                    <p class="loc-legal-section__label">Section 5</p>
                    <h2>How long we keep your information</h2>
                    <div class="loc-legal-table-wrap">
                        <table class="loc-legal-table">
                            <thead>
                                <tr>
                                    <th>Type of data</th>
                                    <th>Retention period</th>
                                    <th>Reason</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr><td>Booking records (name, contact details, job details)</td><td>6 years from the date of the booking</td><td>Legal requirement for financial records under HMRC guidelines</td></tr>
                                <tr><td>Unpaid reservation enquiries (no booking completed)</td><td>90 days from the slot release date</td><td>Legitimate interest — to follow up on incomplete bookings</td></tr>
                                <tr><td>General contact enquiries (no booking made)</td><td>12 months from the date of contact</td><td>Legitimate interest — in case of follow-up queries</td></tr>
                                <tr><td>Website analytics data</td><td>Not held by us — aggregate, anonymous statistics only</td><td>Cloudflare Web Analytics is cookieless and collects no personal data</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="loc-legal-section" id="section-rights">
                    <p class="loc-legal-section__label">Section 6</p>
                    <h2>Your rights</h2>
                    <p>Under UK GDPR, you have the following rights regarding your personal data:</p>
                    <ul>
                        <li><strong>Right of access</strong> — you can request a copy of the personal data we hold about you</li>
                        <li><strong>Right to rectification</strong> — you can ask us to correct inaccurate or incomplete data</li>
                        <li><strong>Right to erasure</strong> — you can ask us to delete your data where we no longer have a lawful basis to hold it</li>
                        <li><strong>Right to restrict processing</strong> — you can ask us to limit how we use your data in certain circumstances</li>
                        <li><strong>Right to data portability</strong> — you can request your data in a structured, machine-readable format</li>
                        <li><strong>Right to object</strong> — you can object to processing based on legitimate interests</li>
                    </ul>
                    <p>To exercise any of these rights, please contact us at <a href="mailto:hello@leicesterovencleaning.co.uk">hello@leicesterovencleaning.co.uk</a>. We will respond within one calendar month.</p>
                    <p>If you are unhappy with how we handle your data, you have the right to lodge a complaint with the Information Commissioner's Office at <a href="https://ico.org.uk" target="_blank" rel="noopener">ico.org.uk</a>.</p>
                </div>

                <div class="loc-legal-section" id="section-cookies">
                    <p class="loc-legal-section__label">Section 7</p>
                    <h2>Cookies</h2>
                    <p>Our website uses cookies. For full details of the cookies we use and how to manage them, please see our <a href="/cookie-policy">Cookie Policy</a>.</p>
                </div>

                <div class="loc-legal-section" id="section-changes">
                    <p class="loc-legal-section__label">Section 8</p>
                    <h2>Changes to this policy</h2>
                    <p>We may update this Privacy Policy from time to time. When we do, we will update the "Last updated" date at the top of this page. We encourage you to review this policy periodically.</p>
                    <p>This policy was last reviewed and updated in May 2026.</p>
                </div>

                <?php elseif ($slug === 'terms-and-conditions'): ?>

                <div class="loc-legal-section">
                    <p class="loc-legal-section__label">Introduction</p>
                    <h2>Our terms of service</h2>
                    <p>These Terms and Conditions govern the relationship between Leicester Oven Cleaning (a trading name operated as a sole trader) and customers who book or enquire about our oven cleaning services.</p>
                    <p>By making a reservation or booking with us, you agree to these terms. Please read them carefully before proceeding.</p>
                </div>

                <div class="loc-legal-section">
                    <p class="loc-legal-section__label">Section 1</p>
                    <h2>The service</h2>
                    <p>Leicester Oven Cleaning provides professional domestic oven cleaning services to customers in Leicester and Leicestershire. Our service includes the cleaning of ovens, hobs, extractor hoods, and related appliances as selected and confirmed at the time of booking.</p>
                    <p>We clean each appliance to the best achievable condition for its age and use. Removable parts are degreased and cleaned, the oven interior is cleared of carbon and grease deposits, glass is cleaned, and everything is reassembled and tested before we leave.</p>
                    <p>Some things cannot be reversed by cleaning. Discolouration, staining, pitting, scratches, heat damage, and worn finishes are permanent, and we will not attempt to force a result that risks damaging the appliance. Where we can see that something will not come out, we will tell you rather than leave you wondering.</p>
                    <p>All work is carried out by the founder personally. We do not subcontract or delegate jobs to third parties.</p>
                </div>

                <div class="loc-legal-section">
                    <p class="loc-legal-section__label">Section 2</p>
                    <h2>Reservations and booking confirmation</h2>
                    <p>Completing our online reservation form does not constitute a confirmed booking. It is a request to reserve a slot. Bookings are confirmed only after:</p>
                    <ul>
                        <li>We have contacted you by telephone to confirm the details of your job</li>
                        <li>You have paid the required deposit</li>
                        <li>We have sent you a written booking confirmation</li>
                    </ul>
                    <p>We reserve the right to decline any reservation request at our discretion.</p>
                </div>

                <div class="loc-legal-section">
                    <p class="loc-legal-section__label">Section 3</p>
                    <h2>Pricing and payment</h2>
                    <p>Our prices start from the figures shown on our website and are confirmed before any work begins. The price we agree on the confirmation call is based on the appliances you have described to us.</p>
                    <p>Where an appliance is in significantly heavier condition than described — for example an extractor hood with commercial-level grease build-up — we will tell you before starting, explain what is involved, and agree a revised price with you. You are free to decline, and you will not be charged. We will never begin work at a different price without your agreement.</p>
                    <p>Photographs you send us help us prepare and are welcome, but they are an indication rather than a quotation. The price is confirmed once we have seen the appliance in person.</p>

                    <h3>Domestic bookings</h3>
                    <p>A deposit of £25 is required to confirm your booking. This deposit is arranged on the confirmation call by bank transfer — we will provide our bank details when we speak. The deposit is deducted from the total price of the job on the day. The remaining balance is due on the day of the clean, upon satisfactory completion of the work. We accept bank transfer or cash on the day.</p>

                    <h3>Business and commercial bookings</h3>
                    <p>Deposit amounts and payment terms for business and commercial bookings are agreed individually at the time of booking confirmation and confirmed in writing before the booking is finalised.</p>
                </div>

                <div class="loc-legal-section">
                    <p class="loc-legal-section__label">Section 4</p>
                    <h2>Cancellations and rescheduling</h2>
                    <p>Please refer to our <a href="/cancellation-policy">Cancellation Policy</a> for full details of our cancellation and rescheduling terms, including deposit refund conditions.</p>
                </div>

                <div class="loc-legal-section">
                    <p class="loc-legal-section__label">Section 5</p>
                    <h2>Access and working conditions</h2>
                    <p>You agree to provide reasonable access to the appliance(s) to be cleaned on the agreed date and within the agreed time window. We require access to a cold water tap — and hot water where available. We do not require access to your electricity supply.</p>
                    <p>We will lay down protective floor coverings before commencing work and will remove all equipment and materials when the job is complete.</p>
                    <p>If we are unable to access the property or the appliance at the agreed time through no fault of our own, this may be treated as a customer cancellation. Please refer to our Cancellation Policy.</p>
                </div>

                <div class="loc-legal-section">
                    <p class="loc-legal-section__label">Section 6</p>
                    <h2>Pre-existing damage and appliance condition</h2>
                    <p>We carry out a pre-clean inspection before commencing any work and will note and bring to your attention any pre-existing damage, faults, or areas of concern that we can reasonably identify.</p>
                    <p>This inspection is a visual safety check, not a certification that an appliance is fault-free. Heavy grease or carbon build-up can conceal existing damage, and many faults are not visible from the outside at all — deterioration inside a heating element, for example, may only become apparent electrically, when the appliance is under load. A clear inspection means no visible fault was found. It does not mean no fault exists.</p>
                    <p>We will not proceed with work on an appliance if we believe it presents a safety risk. If we are unable to proceed due to a safety concern with the appliance, we will discuss the situation with you before making any decision regarding the deposit. Where the concern is genuine and could not have been reasonably foreseen, a full deposit refund will be issued.</p>
                    <p>We are not liable for damage that was pre-existing or concealed, or for faults arising from wear, age, or an existing defect that was not apparent at inspection. Components such as heating elements, seals, thermostats, and switches degrade over time, and a fault may become apparent during or shortly after a clean without the clean having caused it.</p>
                </div>

                <div class="loc-legal-section">
                    <p class="loc-legal-section__label">Section 7</p>
                    <h2>Older appliances and appliances that have been unused</h2>
                    <p>Cleaning involves operating an appliance — running a heat cycle, using the fan, turning the hob on to check it works. On an older appliance, or one that has stood unused for a long period, that can be the first time it has run properly in months or years.</p>
                    <p>Appliances near the end of their working life, and those affected by long disuse, can develop or reveal faults when brought back into normal use. This is a function of the appliance's age and history, not of the clean. We mention it particularly for pre-sale cleans and properties that have been standing empty, where it is most common.</p>
                    <p>We will always tell you what we have observed, in plain terms, and we will never leave an appliance in a state where someone could unknowingly use a faulty function.</p>
                </div>

                <div class="loc-legal-section">
                    <p class="loc-legal-section__label">Section 8</p>
                    <h2>If a fault appears during or after our visit</h2>
                    <p>If something fails while we are there — an appliance trips the electrics, or a function stops working — we will stop, leave the appliance safely isolated rather than forcing it back into use, and explain plainly what we saw and when. We will not repeatedly re-test a fault that has already tripped a safety device; doing so tells us nothing new and can make an existing electrical fault worse.</p>
                    <p>If something is not right after we have left, please contact us first, before arranging any repair. Many issues of this kind are straightforward — residue or moisture on a component that needs time to dry, or a part that needs reseating — and we will return and put it right at no cost to you.</p>
                    <p>Where a fault has been caused by our work, we will resolve it at our expense. Where it is pre-existing, age-related, or otherwise not caused by us, we will tell you honestly what we have found.</p>
                    <p>Cleaning products are applied as intended — sprayed across the cavity rather than directed at heating elements, with controlled application by hand where needed. This is normal practice and does not, in itself, damage a sound appliance.</p>
                    <p>Identifying and reporting a fault is part of doing the job properly and we do not charge for it. Diagnosing or repairing that fault is separate work — where it falls outside what we do, we will tell you what we observed so that you can pass it to an appropriate engineer.</p>
                    <p>Contacting us first matters: it allows us to put our own mistakes right quickly, and it protects your position if a claim ever becomes necessary.</p>
                </div>

                <div class="loc-legal-section">
                    <p class="loc-legal-section__label">Section 9</p>
                    <h2>Gas appliances</h2>
                    <p>We clean gas ovens and hobs, including removable burner caps, crowns, and pan supports. This is cleaning work only.</p>
                    <p>We are not Gas Safe registered and do not carry out any gas work. We will not adjust, dismantle, or repair gas pipework, injectors, valves, or fittings. If we identify a fault with a gas appliance, or an appliance is not operating correctly, we will tell you and recommend that you contact a Gas Safe registered engineer. We cannot advise on or carry out that work ourselves.</p>
                </div>

                <div class="loc-legal-section">
                    <p class="loc-legal-section__label">Section 10</p>
                    <h2>Insurance</h2>
                    <p>We hold £1,000,000 public and products liability insurance with Hiscox, which includes cover for accidental damage to the appliances we are working on. Details of our insurance are available on request.</p>
                </div>

                <div class="loc-legal-section">
                    <p class="loc-legal-section__label">Section 11</p>
                    <h2>Liability</h2>
                    <p>Our liability for any claim arising from our services is limited to the value of the job for which the claim arises. We are not liable for any indirect, consequential, or economic loss.</p>
                    <p>Nothing in these terms limits our liability for death, personal injury, fraud, or any other matter that cannot be excluded by law.</p>
                </div>

                <div class="loc-legal-section">
                    <p class="loc-legal-section__label">Section 12</p>
                    <h2>Governing law</h2>
                    <p>These Terms and Conditions are governed by the laws of England and Wales. Any disputes will be subject to the exclusive jurisdiction of the courts of England and Wales.</p>
                </div>

                <?php elseif ($slug === 'cancellation-policy'): ?>

                <div class="loc-legal-section">
                    <p class="loc-legal-section__label">Introduction</p>
                    <h2>Cancellations &amp; rescheduling</h2>
                    <p>Plans change — we get it. This policy sets out what happens if you need to cancel or reschedule your booking, and when your deposit will be refunded or retained.</p>
                    <p>Please read this before booking. By confirming your booking and paying your deposit, you agree to these terms.</p>
                </div>

                <div class="loc-legal-section">
                    <p class="loc-legal-section__label">Section 1</p>
                    <h2>Cancellation by the customer</h2>
                    <div class="loc-legal-table-wrap">
                        <table class="loc-legal-table">
                            <thead>
                                <tr>
                                    <th>Notice given</th>
                                    <th>Deposit outcome</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr><td>48 hours or more before the appointment</td><td>Full refund of deposit</td></tr>
                                <tr><td>Less than 48 hours before the appointment</td><td>Deposit forfeited</td></tr>
                                <tr><td>No-show (no contact made)</td><td>Deposit forfeited</td></tr>
                            </tbody>
                        </table>
                    </div>
                    <p>To cancel, <a href="/contact">contact us</a> as soon as possible by phone or email. The cancellation time is recorded from when we receive your message.</p>
                </div>

                <div class="loc-legal-section">
                    <p class="loc-legal-section__label">Section 2</p>
                    <h2>Rescheduling by the customer</h2>
                    <p>If you need to move your appointment, <a href="/contact">get in touch</a> as soon as you can. We'll always try to find a new date that works.</p>
                    <ul>
                        <li><strong>48 hours or more notice:</strong> rescheduling is free of charge and your deposit transfers to the new date</li>
                        <li><strong>Less than 48 hours notice:</strong> treated as a cancellation — see Section 1</li>
                    </ul>
                </div>

                <div class="loc-legal-section">
                    <p class="loc-legal-section__label">Section 3</p>
                    <h2>Cancellation by Leicester Oven Cleaning</h2>
                    <p>If we ever need to cancel your booking, we'll contact you as early as possible and offer either:</p>
                    <ul>
                        <li>A full refund of your deposit, or</li>
                        <li>A rescheduled appointment at a date that suits you</li>
                    </ul>
                    <p>We will never retain your deposit where the cancellation is made by us.</p>
                </div>

                <div class="loc-legal-section">
                    <p class="loc-legal-section__label">Section 4</p>
                    <h2>Unable to proceed on arrival</h2>
                    <p>If we arrive and can't carry out the work for reasons outside our control — the appliance is inaccessible, access isn't available, or a safety concern is identified — this may be treated as a short-notice cancellation under Section 1.</p>
                    <p>If the issue is a safety concern with the appliance itself, we'll talk it through with you before making any decision about the deposit.</p>
                </div>

                <div class="loc-legal-section">
                    <p class="loc-legal-section__label">Section 5</p>
                    <h2>Need to talk it through?</h2>
                    <p>Stuff happens — a burst pipe, a sick kid, a change of plan. If you're outside the 48-hour window for a genuine reason, <a href="/contact">get in touch</a> before your slot rather than after. We're reasonable people, and we'll always try to work with you.</p>
                </div>

                <div class="loc-legal-section">
                    <p class="loc-legal-section__label">Section 6</p>
                    <h2>Refund processing</h2>
                    <p>Deposit refunds will be processed within 5 working days of the cancellation being agreed. Refunds are made by bank transfer to the account used to pay the deposit.</p>
                </div>

                <?php elseif ($slug === 'cookie-policy'): ?>

                <div class="loc-legal-section">
                    <p class="loc-legal-section__label">Introduction</p>
                    <h2>How we use cookies</h2>
                    <p>This page explains what storage this website uses and what it doesn't.</p>
                </div>

                <div class="loc-legal-section">
                    <p class="loc-legal-section__label">Section 1</p>
                    <h2>What this page covers</h2>
                    <p>This website uses Cloudflare Web Analytics to help us understand how visitors use the site. It is a privacy-first, cookieless tool — it sets no cookies on your device, uses no personal identifiers, and does not track you across other websites. It gives us only aggregate statistics such as page views, referrers, country, and device type. Because it stores nothing on your device and collects no personal data, no cookie consent is required for it.</p>
                </div>

                <div class="loc-legal-section">
                    <p class="loc-legal-section__label">Section 2</p>
                    <h2>What we don't use</h2>
                    <p>We do not use advertising or remarketing cookies. We do not track you across other websites. The only other storage used on this site is temporary session data kept in your browser while you use our reservation form — for example, remembering which appliances you have selected as you move between steps. This information stays on your device, is never sent to us or anyone else, and clears automatically when you close your browser tab.</p>
                </div>

                <div class="loc-legal-section">
                    <p class="loc-legal-section__label">Section 3</p>
                    <h2>If this changes</h2>
                    <p>If we introduce any tool that does set cookies or track you in future, we'll update this page and add a consent mechanism where required by law, before any such tool goes live.</p>
                </div>

                <div class="loc-legal-section">
                    <p class="loc-legal-section__label">Section 4</p>
                    <h2>Changes to this policy</h2>
                    <p>We may update this Cookie Policy from time to time. When we do, we will update the "Last updated" date. We encourage you to review this policy periodically.</p>
                    <p>This policy was last reviewed and updated in May 2026.</p>
                </div>

                <?php endif; ?>

            </div>

            <!-- SIDEBAR -->
            <aside class="loc-legal-sidebar">

                <!-- NAVIGATION -->
                <div class="loc-legal-sidebar__nav">
                    <p class="loc-legal-sidebar__nav-title">Legal documents</p>
                    <ul>
                        <li><a href="/privacy-policy" <?php echo ($slug === 'privacy-policy') ? 'class="is-active"' : ''; ?>>Privacy Policy</a></li>
                        <li><a href="/terms-and-conditions" <?php echo ($slug === 'terms-and-conditions') ? 'class="is-active"' : ''; ?>>Terms &amp; Conditions</a></li>
                        <li><a href="/cancellation-policy" <?php echo ($slug === 'cancellation-policy') ? 'class="is-active"' : ''; ?>>Cancellation Policy</a></li>
                        <li><a href="/cookie-policy" <?php echo ($slug === 'cookie-policy') ? 'class="is-active"' : ''; ?>>Cookie Policy</a></li>
                    </ul>
                </div>

                <!-- ICO BOX -->
                <div class="loc-legal-sidebar__ico">
                    <p class="loc-legal-sidebar__ico-label">ICO Registration</p>
                    <p>Leicester Oven Cleaning is registered with the <strong>Information Commissioner's Office</strong> as required by UK data protection law.</p>
                    <p>Registration number: <strong>[Pending — inserting before go-live]</strong></p>
                </div>

                <!-- CONTACT BOX -->
                <div class="loc-legal-sidebar__contact">
                    <p class="loc-legal-sidebar__contact-title">Questions about this policy?</p>
                    <p><a href="/contact">Contact us directly</a> — we'll respond within one working day.</p>
                    <a href="/contact" class="btn-primary loc-legal-sidebar__contact-btn">Get in Touch</a>
                </div>

            </aside>

        </div>
    </div>

</main>

<?php get_footer(); ?>