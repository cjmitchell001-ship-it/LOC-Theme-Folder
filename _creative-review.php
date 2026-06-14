<?php
/**
 * _creative-review.php
 * =====================================================================
 * CREATIVE REVIEW FILE — Leicester Oven Cleaning Child Theme
 * =====================================================================
 * This file is NOT a WordPress template and is never loaded by the site.
 * It exists purely as a holding area for alternative section designs,
 * improvements, and experimental approaches for Chris to review after
 * the initial build phase is complete.
 *
 * HOW TO USE:
 * - Review each entry below
 * - If you want to adopt it, copy the HTML/CSS into the relevant file
 * - If you want to discard it, delete the entry
 * - Each entry is clearly labelled with what it replaces and why
 * =====================================================================
 */
?>

<?php /* =====================================================================
ENTRY 001 — TRUST BAR REDESIGN
Replaces: Section 3 of front-page.php (.loc-trust)
Reason: The current trust bar uses plain text with checkmarks. This version
uses icon cards with more visual weight — closer to the credentials section
on the About page which tested well visually. The copy placeholders here
also reflect the improved wording discussed during the trust bar copy session
(insurance coverage of items worked upon, ICO in plain English, certainty
over price rather than budget-hunting language).
Review after: Trust bar copy session is completed.
===================================================================== */ ?>

<!-- TRUST BAR — ALTERNATIVE DESIGN (Entry 001) -->
<section class="loc-trust-v2">
    <div class="loc-trust-v2__inner">

        <div class="loc-trust-v2__item">
            <div class="loc-trust-v2__icon">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" stroke="#C9960C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <p class="loc-trust-v2__title">The price we agree is the price you pay</p>
            <p class="loc-trust-v2__sub">However dirty the oven. No surprises on the day.</p>
        </div>

        <div class="loc-trust-v2__divider"></div>

        <div class="loc-trust-v2__item">
            <div class="loc-trust-v2__icon">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" stroke="#C9960C" stroke-width="2"/>
                    <path d="M9 12l2 2 4-4" stroke="#C9960C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <p class="loc-trust-v2__title">Your oven is covered — not just our public liability</p>
            <p class="loc-trust-v2__sub">We hold treatment risk insurance specifically for appliances being worked on.</p>
        </div>

        <div class="loc-trust-v2__divider"></div>

        <div class="loc-trust-v2__item">
            <div class="loc-trust-v2__icon">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none">
                    <rect x="3" y="11" width="18" height="11" rx="2" stroke="#C9960C" stroke-width="2"/>
                    <path d="M7 11V7a5 5 0 0110 0v4" stroke="#C9960C" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </div>
            <p class="loc-trust-v2__title">Your details are never shared or sold</p>
            <p class="loc-trust-v2__sub">Registered with the UK data protection authority (ICO).</p>
        </div>

        <div class="loc-trust-v2__divider"></div>

        <div class="loc-trust-v2__item">
            <div class="loc-trust-v2__icon">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none">
                    <circle cx="12" cy="12" r="10" stroke="#C9960C" stroke-width="2"/>
                    <path d="M12 8v4l3 3" stroke="#C9960C" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </div>
            <p class="loc-trust-v2__title">Oven ready to use before we leave</p>
            <p class="loc-trust-v2__sub">Fully reassembled, tested, and ready the same day.</p>
        </div>

    </div>
</section>

<!-- TRUST BAR V2 — CSS (add to style.css if adopted) -->
<?php /* 
.loc-trust-v2 {
    background: var(--blue);
    border-top: 3px solid var(--gold);
    padding: 40px 40px;
    position: relative;
    overflow: hidden;
}

.loc-trust-v2::before {
    content: '';
    position: absolute;
    top: -60px;
    right: 300px;
    width: 300px;
    height: 300px;
    border-radius: 50%;
    border: 50px solid rgba(201,150,12,0.06);
    pointer-events: none;
}

.loc-trust-v2__inner {
    max-width: 1080px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 0;
}

.loc-trust-v2__divider {
    width: 1px;
    height: 80px;
    background: rgba(255,255,255,0.12);
    flex-shrink: 0;
}

.loc-trust-v2__item {
    flex: 1;
    padding: 0 32px;
    text-align: center;
}

.loc-trust-v2__icon {
    margin-bottom: 12px;
    display: flex;
    justify-content: center;
}

.loc-trust-v2__title {
    font-family: 'Montserrat', sans-serif;
    font-weight: 700;
    font-size: 13px;
    color: var(--white);
    margin-bottom: 6px;
    line-height: 1.3;
}

.loc-trust-v2__sub {
    font-family: 'Open Sans', sans-serif;
    font-size: 12px;
    color: rgba(255,255,255,0.6);
    line-height: 1.5;
}

@media (max-width: 768px) {
    .loc-trust-v2__inner {
        flex-direction: column;
        gap: 32px;
    }

    .loc-trust-v2__divider {
        width: 60px;
        height: 1px;
    }

    .loc-trust-v2__item {
        padding: 0;
    }
}
*/ ?>