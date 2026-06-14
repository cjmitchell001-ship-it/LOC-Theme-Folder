# Leicester Oven Cleaning — Master Project Context Document
**Version 6.0 — Updated June 2026**

> **This document is written for Claude AI assistants operating inside this project.**
> When you read this file, you have full context on the business, its current state, and what needs to be done. You do not need further background. Jump straight into the task you are assigned.
>
> **What's new in v6.0:** Major funnel rework completed in the June 2026 session. Step 1 now uses a sticky bottom bar instead of the right-rail summary panel. Step 2 has been fully rebuilt — summary panel removed, continue button replaced with a static bar for the from-Step-1 route, inline sticky bar now correctly writes storage on all routes. Step 3 summary repositioned, sticky collapse removed, scroll-to-summary on time selection, Reserve Your Slot modal dead-end fixed. All three steps tested mobile-functional across all four user journey routes. Claude Code installed and operational. Architecture migration plan agreed — decoupled frontend/backend post-launch. See Section 22 for full session build record.
>
> **From v5.0:** Reservation funnel fully built as custom PHP/CSS/JS templates — MotoPress not used. All three steps complete with mobile responsive, session storage handoff, skip route, AGA expand, pulsing gold confirmation mechanic, smart callback message, and confirmation panel. Business strategy framework captured in Section 21. Founding Customer Rate remains idea under consideration (not committed). Pricing remains placeholder.

-----

## 1. What This Business Is

**Trading Name:** Leicester Oven Cleaning
**Parent Company (registered):** The Proper-T Cleaning Group Ltd
**Founder:** Chris
**Future Trademark:** Proper-T Cleaning (post-launch)

This is a startup oven cleaning business based in Leicester, UK. The founder is building it from the ground up — solo, with a phased approach that separates early proof-of-concept work from full commercial launch.

The business cleans domestic and light commercial ovens. It will eventually offer a mobile service using a trailer, an EV vehicle, and a gas dip tank for deep cleaning. There is a longer-term ambition to expand the brand into a broader cleaning group (hence "The Proper-T Cleaning Group" as the parent company name).

**Services roadmap (phased):** Oven cleaning first (current phase), then oven repair and restoration, then jet washing, upholstery cleaning, and eventually industrial and commercial operations.

**Appliance repair ambition:** Chris has a natural aptitude for taking things apart and fixing them. Appliance repair and restoration is a confirmed future direction — not currently offered as a formal service, but referenced on the About page as a future ambition. Do not include repair as a current offering in any copy.

**Exit strategy:** The founder's long-term goal is to build a scalable property cleaning business, take on staff, move off the tools, build an office team, and sell the business within a 10–15 year timeframe.

The business is **pre-launch**. No customers have been served commercially yet.

-----

## 2. Launch Strategy: Two Phases

### Phase 1 — Proof of Concept (The Test)

- Acquire tools and cleaning products ✅ Complete
- Training day with professional contact — planned imminently
- Equipment sourcing trip — planned after training day
- Approximately four weeks of unpaid practice cleans on personal and familiar contacts' appliances
- Set up digital presence (Google Business Profile, social media, leaflets, website) — in progress
- Register with the ICO (data protection) — planned for immediately before go-live
- Remain as sole trader during this phase

**Phase 1 is the current active phase.**

### Phase 2 — Execution (The Trigger)

Phase 2 is unlocked once a 3-month waitlist fills.

Trigger actions include:
- Obtain a personal loan
- Register Ltd company (The Proper-T Cleaning Group)
- Open a business bank account
- Transfer loan as a Director's Loan to the company
- Hire an accountant
- Get a Lower Tier Waste Carrier Licence
- Get fully insured (Treatment Risk + Business EV cover)
- Obtain Safety Data Sheets for all chemicals
- Acquire trailer and gas dip tank

**Founding Customer Rate (idea under consideration — NOT committed):** This is a concept Chris has floated, not a locked decision. Do not treat it as a fixed part of the plan or build hard dependencies on it. The reservation funnel currently contains Founding Rate copy — these are placeholders that can be removed if the idea is dropped.

-----

## 3. Brand Identity

The brand is clean, professional, and local. Do not deviate from these values.

### Colour Palette

| Role           | Name           | Hex       |
|----------------|----------------|-----------|
| Primary        | Leicester Blue | `#1A3A6E` |
| Accent         | Rich Gold      | `#C9960C` |
| Background     | Clean White    | `#FFFFFF` |
| Background Alt | Light Grey     | `#F5F5F5` |
| Body Text      | Off Black      | `#1C1C2E` |

CSS variables: `--blue`, `--gold`, `--white`, `--grey`, `--off-black`

### Typography

- **Headings:** Montserrat (700, 800 weights)
- **Body:** Open Sans (400, 600 weights), 17px base
- Both loaded via Google Fonts CDN

### Voice & Tone

- Direct, confident, local
- Never corporate or generic
- Warm but professional
- Speaks to homeowners who care about their home

### Critical CTA Rule

**Always "Reserve Your Slot — we'll call to confirm"** — NEVER "Book Now". The reservation model is central to the business: customer reserves, team calls to confirm, deposit taken after call. This distinction must never be lost in copy.

### Deposit Policy

- £25 flat reservation deposit — taken after confirmation call, deducted from total on the day
- Refundable with 48+ hours notice
- Forfeit within 48 hours or no-show
- Rescheduling with 48+ hours notice transfers deposit to new date

-----

## 4–17. [Unchanged from V9 — Brand, Copy Rules, Services, Pricing, Legal, Operations]

> Sections 4 through 17 are unchanged from Version 5.0. They cover: brand personality, copywriting rules, service definitions, pricing structure, legal policies, operations, trust markers, and commercial services. Refer to V9 for those sections if needed.

-----

## 18. Project Status Summary (v6.0)

| Area | Status |
|------|--------|
| Business naming & registration | ✅ Complete |
| Branding | ✅ Complete |
| Phase 1 actions | 🔄 In progress |
| Legal & compliance | ⚠️ ICO and insurance are hard pre-launch blockers |
| Website WordPress build | ✅ Complete — all pages built |
| Reservation funnel — frontend | ✅ Complete — mobile tested, all four routes working |
| Reservation funnel — backend | ❌ Outstanding — no real data, no POST, no emails |
| Responsive (tablet 600–960px) | 🔄 In progress — mobile done, tablet/desktop next |
| Claude Code | ✅ Installed and operational (v2.1.170) |
| Architecture migration plan | ✅ Agreed — decoupled frontend/backend post-launch |
| Marketing | 🔄 Competitor research complete, content planned |
| Finance | ❌ Not set up |

-----

## 19. Technical Stack & Development Environment

### Current Stack

| Item | Detail | Status |
|------|--------|--------|
| Local development | Local by Flywheel | ✅ Active |
| Site domain (local) | leicester-oven-cleaning.local | ✅ Active |
| WordPress | 6.9.4 | ✅ Active |
| Parent theme | GeneratePress (free tier) | ✅ Installed |
| Child theme | leicester-oven-cleaning-child | ✅ Active |
| Editor | VS Code | ✅ Active |
| AI coding assistant | Claude Code v2.1.170 | ✅ Installed |
| Version control | Git (via Claude Code) | 🔄 Set up during tooling session |
| Hosting | SiteGround (~£220/year) | ✅ Active (pre-launch) |

### Planned Architecture Migration (Post-Launch)

This is a significant and agreed strategic decision. **Do not treat the current WordPress stack as permanent.**

**Current state:** WordPress on SiteGround. All pages are custom PHP templates — WordPress is only used for URL routing, template loading, and `get_header()`/`get_footer()` calls. The funnel is 100% custom JavaScript/PHP with no WordPress plugin dependency.

**Planned end state (to be implemented when building the real booking backend):**
- **Frontend:** Static site (likely Astro or plain PHP) hosted on Cloudflare Pages or similar — free/very cheap, fast, no database
- **Backend:** Decoupled booking API on Railway, Render, or a VPS (~£5–7/month) — handles customer records, availability, job scheduling, Stripe deposits, email notifications
- **Communication:** Frontend JavaScript calls the API via `fetch()` — the funnel is already structured this way (sessionStorage is a temporary stand-in for real API calls)
- **Total hosting cost target:** ~£60–80/year vs current £220

**Why this timing:** The migration should happen simultaneously with building the real booking backend — not before, not after. The current frontend PHP templates are almost entirely portable (3-4 WordPress function calls to replace). The migration is not a rebuild; it is a re-plumbing. Estimated effort: a few hours of file changes.

**Blog posts:** Will use Markdown files rather than WordPress editor. No CMS needed.

**Do not start this migration** until the frontend is fully complete, tested, and signed off. Current priority is finishing the frontend.

### Child Theme Files

| File | Purpose | Status |
|------|---------|--------|
| `style.css` | All CSS — brand variables, global styles, all page and funnel styles | ✅ Complete |
| `functions.php` | Parent theme + fonts enqueue, hamburger JS, hero carousel JS, contact JS, legal template routing, `loc_step1_script`, `loc_step2_script`, `loc_step3_script` | ✅ Complete |
| `front-page.php` | Homepage — all 13 sections | ✅ Complete |
| `header.php` | Custom sticky header | ✅ Complete |
| `footer.php` | Custom four-column footer | ✅ Complete |
| `page-about.php` | About page | ✅ Complete — needs business-voice rewrite |
| `page-contact.php` | Contact page — CF7 integrated | ✅ Complete |
| `page-business-commercial.php` | B2B page | ✅ Complete |
| `page-legal.php` | Shared legal template | ✅ Complete |
| `home.php` | Blog listing | ✅ Complete |
| `single.php` | Blog article | ✅ Complete |
| `404.php` | 404 error page | ✅ Complete |
| `page-reserve-step1.php` | Step 1 funnel | ✅ Complete — sticky bar version |
| `page-reserve-step2.php` | Step 2 funnel | ✅ Complete — rebuilt June 2026 |
| `page-reserve-step3.php` | Step 3 funnel | ✅ Complete — rebuilt June 2026 |

-----

## 20. Funnel Architecture — Current State (v6.0)

### Session Storage Keys

| Key | Written by | Read by | Value |
|-----|-----------|---------|-------|
| `loc_selections` | Step 1 confirm / Step 2 inline sticky btn | Step 2 carryover, Step 3 summary | JSON object `{name: price}` |
| `loc_total` | Step 1 confirm / Step 2 inline sticky btn | Step 2 carryover bar, Step 3 summary | Integer |
| `loc_from_step1` | Step 1 confirm | Step 2 routing, carryover IIFE | `'true'` |
| `loc_skip` | Step 1 skip / Step 2 skip | Step 3 total display | `'true'` |
| `loc_postcode` | Step 2 confirm btn | Step 3 (unused currently) | String e.g. `'LE4'` |

**Critical:** `loc_skip` must be explicitly cleared (`removeItem`) when proceeding with actual appliance selections. Failure to clear it causes Step 3 to show £TBC despite real selections. This bug was fixed in the June 2026 session — see `positionStep2StickyBar` handler.

### Four User Journey Routes — All Tested and Working

1. **Step 1 (appliances) → Step 2 → Step 3:** Step 1 writes selections and total. Step 2 shows static bar with carried total. Step 3 shows itemised list and total. ✅
2. **Step 1 (discuss/skip) → Step 2 → Step 3:** Step 1 sets skip flag. Step 2 shows static bar with £TBC. Step 3 shows £TBC. ✅
3. **Direct land on Step 2 → inline appliances → Step 3:** Inline sticky bar button writes selections/total on click. Step 3 shows itemised list and total. ✅ (Bug fixed June 2026)
4. **Direct land on Step 2 → inline discuss → Step 3:** Skip flag set. Sticky bar shows £TBC. Step 3 shows £TBC. ✅

### Step 1 — Appliance Selection

**Layout:** Single column on mobile/tablet. Two-column grid (appliances left, summary previously right — now removed) on desktop. Desktop right rail is currently empty — needs addressing in responsive pass.

**Components:**
- Nine appliance cards across two groups (Ovens, Extras)
- AGA card expands inline to show four sub-type options
- Skip panel — "Discuss on the Call Instead" / "Undo" toggle
- **Sticky bottom bar** (replaces old right-rail summary panel) — slides up from bottom on first selection, shows running total + "Choose Your Area →" button, lifts off footer via `positionStep1StickyBar()`
- The sticky bar button is wired to `handleConfirm` — writes all sessionStorage before navigating
- No separate summary panel exists on this step

**Key JS functions in `loc_step1_script`:**
- `updateSummary()` — updates sticky bar total and enabled state
- `setSkipActive()` / `setSkipInactive()` — skip toggle
- `handleConfirm()` — writes storage, navigates to Step 2
- `positionStep1StickyBar()` — footer-lift logic, called on appear and on scroll

### Step 2 — Postcode and Area

**Layout:** Single column throughout. Sticky postcode input bar locks below header on scroll.

**Routing logic:**
- `fromStep1 = sessionStorage.getItem('loc_from_step1') === 'true'`
- From Step 1: shows `loc-continue-wrap` (contains banner + static bar), hides `loc-inline-section`
- Direct landing: shows `loc-inline-section` (appliance selector), hides `loc-continue-wrap`

**From-Step-1 route components:**
- Confirmed banner (postcode saved message) — lives inside `loc-continue-wrap`
- **Static continue bar** (`#loc-continue-bar`) — uses `.loc-step1-sticky-bottom.loc-step1-sticky-bottom--static` classes, shows carried total from sessionStorage, "Choose Your Date →" links to Step 3
- Carryover IIFE populates `#loc-continue-total` from `loc_total` or shows TBC if skip
- No itemised summary panel on Step 2 — itemised list lives only on Step 3

**Inline (direct landing) route components:**
- Appliance cards, AGA expand, skip panel — same pattern as Step 1
- Inline sticky bottom bar (`#loc-step2-sticky-bottom`) — real `position: fixed` sticky bar
- **Storage write bug fix:** `loc-step2-sticky-btn` has a click handler that writes `loc_selections`/`loc_total` before navigation (was previously a plain link — caused £0 on Step 3)
- `positionStep2StickyBar()` — footer-lift, called on appear and on scroll

**Postcode validation:** UK postcode regex `/^([A-Z]{1,2}\d[A-Z\d]?)(\s?\d[A-Z]{2})?$/` — accepts both outward codes (LE4) and full postcodes (LE4 7AB). Error element `#loc-postcode-error`.

**Area highlight clear:** `postcodeInput` `input` event listener clears `is-selected` from all area tags when user types manually.

### Step 3 — Calendar and Reservation

**Layout:** Two-column on desktop (calendar left, summary right). Single column on mobile — summary sits **below** the calendar (NOT sticky, NOT at top — order changed in June 2026 session).

**Summary panel position on mobile:** Uses `order: 1` in `@media (max-width: 600px)` — sits after the calendar column, below the Clear Selection button. This was deliberately moved from `order: -1` (top) to below. **Do not change this back.**

**No sticky/condense behaviour on mobile:** The old `summaryCol` fixed-position scroll handler and `is-condensed` class have been **fully removed**. Summary panel stays static in the flow at all widths. `updateSummarySlot()` no longer adds `is-condensed` to the summary box.

**Auto-scroll on time selection:** When a time slot (Morning/Afternoon) is selected, page auto-scrolls to bring the summary panel into view using `summaryCol.scrollIntoView({ behavior: 'smooth', block: 'end' })`.

**Reserve Your Slot interaction:**
- The entire `#loc-summary-slot` gold panel is clickable (not just the inner button) — click handler on the panel element opens the modal
- The active/pulsing state (`loc-step3-summary__slot--active`) is **NOT removed** when the modal opens — only removed on successful submit
- This means: close the modal without submitting → button is still pulsing → can reopen immediately. Previously it killed the animation on open (dead-end bug, fixed June 2026)

**Calendar:** Placeholder data (hardcoded `recommendedDays`/`unavailableDays` arrays). Must be replaced with real booking API data before go-live.

**Modal and confirmation:**
- Contact modal collects: first name, last name, phone (UK validation), email (format validation), callback preference (Morning/Afternoon/Evening)
- Smart callback message — time-aware and day-aware
- On submit: hides `#loc-step3-main`, shows `#loc-confirmation-wrap`, clears sessionStorage, removes pulsing state
- Confirmation panel shows: date/time, total (or "To be discussed on the call"), callback preference, smart message, Back to Home button

**Skip route on Step 3:** Summary items show "No selection found — go back to Step 1" when `loc_selections` is empty (skip route). Total correctly shows £TBC. The items message is an acknowledged inconsistency — to be fixed in a future session.

-----

## 21. Outstanding Items — Before Go-Live

### Funnel — Functional

- **Responsive pass (tablet/desktop):** Mobile is complete. Need to widen from mobile, find natural breakpoints, fix layout/appearance at each, iterate up to full desktop. Step 1 desktop right rail is currently empty (old summary panel removed) — needs a plan. All three steps need this pass.
- **Step 3 skip route items text:** When skip route used, `#loc-summary-items` shows "No selection found" instead of "To be discussed on the call." Inconsistent with the TBC total. Minor fix.
- **Backend wiring:** Calendar uses placeholder data. No POST on submission. No email notifications. No real booking system. This is intentionally deferred until the architecture migration.
- **Inline route storage bug edge case:** Ensure `loc_skip` is cleared when proceeding with appliances via inline route (Step 2 sticky bar handler now does this, but stress test confirm).

### Funnel — Copy & Pricing

- **Pricing:** All figures are placeholder. Founding Rate is placeholder. AGA pricing (£170/£190/£230/£260) is placeholder. Confirm real prices after training day.
- **Founding Rate decision:** Decide whether to keep or drop the mechanic. If dropping, remove all Founding Rate copy from funnel and homepage.

### Homepage

- **Reserve Your Slot button URLs** — currently `/reserve` (404). Update to `/reserve-step-1` in `front-page.php` and `header.php`
- **"How to Reserve" section** — three step cards should link to the funnel

### Whole-Site Pass (After Responsive Complete)

- All links functional
- All functionality tested across every page
- Natural breakpoints on non-funnel pages

### Content & Copy

- **About page rewrite** — change from personal/founder voice to business voice. Trust markers (ICO, Companies House, insurance) must remain prominent even in business voice.
- **Trust bar copy** — needs dedicated copy session (Fully Insured, ICO Registered, Fixed Price Guarantee all need rewording)
- **Hero section images** — real photos needed for hero carousel
- **Subtle gold ring motifs** — extend hob-ring SVG backgrounds to all blue sections (currently only business banner)
- **Founding Rate strip on homepage** — currently domestic-focused; needs business customer note if mechanic is kept

### Placeholder Content — Replace Before Go-Live

- Phone number — "Number TBC" throughout
- ICO registration number — "Pending Registration"
- Social media URLs — placeholder `#` links
- Companies House number — not yet inserted in footer
- All appliance pricing — placeholder figures
- Areas map — replace AI placeholder image with real Google Maps screenshot
- Calendar availability data — hardcoded placeholder arrays

### Technical / Infrastructure

- VoIP business number — active before go-live
- Business email — hello@leicesterovencleaning.co.uk
- Stripe setup — for deposit payment links
- ICO registration — immediately before go-live
- Google Business Profile — set up and verified
- Social media accounts — created and linked
- Google Analytics — installed
- Cookie consent banner — implemented
- Yoast SEO — page titles and meta descriptions all pages
- Delete Sample Page from WordPress
- Remove "Built with GeneratePress" from footer

### SVG Icons

- Extractor hood icon — reads upside down, needs inverting
- Gas hob rings — not clear enough, needs redrawing
- New appliance types to add: Freestanding Single Oven, Freestanding Double Oven, Combi Microwave Oven, Small Gas Ring Hob, Large Gas Ring Hob, Small Extractor Fan, Large Extractor Fan

-----

## 22. Funnel Build Record — June 2026 Session (v6.0)

This section records the significant changes made during the June 2026 development session. It supersedes the Step 1/2/3 notes in Section 20 of V9.

### Step 1 — Sticky Bar Replacement

**What changed:** The right-rail summary panel (`loc-step1-summary`) and the "Confirm & Check Your Area" button were removed. A sticky bottom bar replaced them — identical in appearance to the Step 2 inline sticky bar.

**Why:** Three evenings were spent attempting to make a sticky bar work correctly on Step 1 early in the project. The bar was ultimately removed and replaced with the summary panel. This session re-introduced it cleanly using the proven Step 2 bar pattern.

**Key implementation details:**
- Bar markup: `#loc-step1-sticky-bottom` with `__total` and `__btn` children
- Button text: "Choose Your Area →" (not "Choose Your Date")
- Button is wired to `handleConfirm` — essential, as it must write sessionStorage before navigation
- `positionStep1StickyBar()` handles footer-lift — called both on appear and via scroll listener
- The Founding Rate note and the "Fixed price guaranteed" trust copy were also removed from the summary area during this change
- Desktop grid right rail is now empty — needs addressing in responsive pass

**Files changed:** `page-reserve-step1.php`, `functions.php`, `style.css`

### Step 2 — Full Rebuild

**What changed:** Three separate issues fixed in one pass.

**Issue 1 — Summary panel removed:**
The carryover summary panel (`#loc-carryover` with itemised list) was removed from Step 2 entirely. The itemised breakdown now lives only on Step 3 where it belongs (final review before confirming).

**Issue 2 — Static continue bar:**
The gold "Continue — Choose Your Date" button in `loc-continue-wrap` was replaced with a static bar matching the sticky bar appearance: total on left, "Choose Your Date →" on right. Uses `.loc-step1-sticky-bottom.loc-step1-sticky-bottom--static` classes. The `--static` modifier overrides `position: fixed` to `position: static`. Total is populated from sessionStorage by a lightweight IIFE on load (£figure or £TBC).

**Issue 3 — Inline route £0 bug:**
The Step 2 inline route (direct landing, appliance selection) was not writing `loc_selections`/`loc_total` to sessionStorage. The write handler existed on `#loc-inline-proceed-btn` (inside the inline summary panel) but users were actually clicking `#loc-step2-sticky-btn` (the sticky bar). Added a proper storage-write click handler to the sticky bar button. Also added `sessionStorage.removeItem('loc_skip')` before the write to prevent stale skip flag causing £TBC on Step 3.

**Files changed:** `page-reserve-step2.php`, `functions.php`, `style.css`

### Step 3 — Summary Reposition and UX Fixes

**What changed:** Four separate improvements.

**Change 1 — Summary panel moved below calendar on mobile:**
`order: -1` (top of page) changed to `order: 1` (below calendar) in `@media (max-width: 600px)`. Summary now sits naturally below the Clear Selection button — where the user's attention is after picking a date and time.

**Change 2 — Sticky/condense behaviour removed:**
The entire `// Stick summary panel on scroll — mobile only` JavaScript block was deleted from `loc_step3_script`. This block was causing jarring page jumps when the summary was yanked out of document flow. It used `position: fixed` which is incompatible with the `overflow-x: hidden` on `html, body`. `updateSummarySlot()` was also cleaned to remove all `is-condensed` class manipulation. The summary panel now sits static in the flow at all times on mobile.

**Change 3 — Auto-scroll to summary on time selection:**
Added `summaryCol.scrollIntoView({ behavior: 'smooth', block: 'end' })` inside the slot-button click handler. Fires when user taps Morning or Afternoon — smoothly scrolls so the summary panel's bottom aligns with the viewport bottom, bringing the full panel into view.

**Change 4 — Reserve Your Slot modal dead-end fixed:**
Previously, clicking "Reserve Your Slot" removed the `loc-step3-summary__slot--active` class (killing the pulsing animation), then opened the modal. If the user closed the modal without submitting, the animation was gone and the button appeared inactive — forcing a full date re-selection to proceed. Fix: removed the class removal from the slot-button click handler. The active class is now only removed on successful form submission. The entire `#loc-summary-slot` panel is also now the click target (not just the inner button), giving a larger, more natural hit area.

**Files changed:** `functions.php`, `style.css`

### Known Issues Remaining After This Session

- Step 3 skip route: `#loc-summary-items` shows "No selection found" text when skip route used (items are empty because `loc_selections` is empty). Total correctly shows £TBC. Inconsistency — minor fix for a future session.
- Step 1 desktop right rail: now empty after removing the summary panel. Needs a plan for what to show at desktop widths. Will be addressed in the responsive breakpoint pass.
- Calendar uses hardcoded placeholder availability data throughout — real booking system API wiring is a Phase 2 / architecture migration item.

-----

## 23. Architecture Migration Plan (Agreed June 2026)

This section captures the agreed future direction for the technical stack. It is not a current action item — it is a plan to execute when the booking backend is built.

### The Core Decision

The current WordPress stack will be replaced when the real booking backend is built. These two things happen simultaneously — not sequentially. Building the backend inside WordPress and then migrating is the wrong order; it creates coupling that would have to be unpicked.

### Why Migrate

- WordPress is only used for URL routing and template loading — 95% of the site is custom PHP/CSS/JS with no WordPress dependency
- Current hosting cost: ~£220/year (SiteGround)
- Target hosting cost: ~£60–80/year (Cloudflare Pages free tier + small API server)
- The booking backend needs a real database and server-side logic regardless of WordPress — the question is only where that logic lives
- Decoupled architecture gives independence: frontend and backend can change separately, mobile app could use the same API later, business is not locked to any CMS

### Planned Stack

**Frontend (static site):**
- Likely Astro or plain PHP files
- Hosted on Cloudflare Pages (free or very cheap)
- Blog posts written as Markdown files — no CMS editor needed
- Pure HTML/CSS/JS — no PHP runtime needed at the CDN layer

**Backend (booking API):**
- Likely Railway or Render (~£5–7/month) or a Hetzner VPS (~€4–5/month)
- PHP or Node.js — decision TBC at build time
- Handles: customer records, real availability, job scheduling, Stripe deposits, email notifications (to customer and to Chris), booking confirmation flow
- Exposes REST API endpoints consumed by the frontend JavaScript

**How the funnel connects:**
The funnel JavaScript already writes data to sessionStorage and navigates between steps. Connecting to a real backend is a one-line change per submission:
- Currently: `sessionStorage.setItem('loc_selections', ...)`
- After migration: `fetch('https://api.leicesterovencleaning.co.uk/bookings', { method: 'POST', body: data })`

The funnel is already structured for this. SessionStorage is a temporary stand-in.

### Migration Effort Estimate

Low. The PHP templates are portable — WordPress dependency is limited to:
- `get_header()` → `include 'includes/header.php'`
- `get_footer()` → `include 'includes/footer.php'`
- `home_url('/reserve-step-2')` → hardcoded or a config constant
- `is_page()` checks → removed (each file is its own page)

A few hours of find-and-replace, not a rebuild.

### Timing

**Do not start until:**
1. Frontend is fully complete (all pages, all breakpoints, all copy, all content)
2. Site is ready to go live in its current form
3. Ready to build the real booking backend

The migration is the booking backend build. They are one project, not two.

-----

## 24. Claude Code Setup (June 2026)

Claude Code was installed and authenticated during the June 2026 session.

| Item | Detail |
|------|--------|
| Version | 2.1.170 |
| Install method | Native Windows installer (`irm https://claude.ai/install.ps1 \| iex`) |
| Location | `C:\Users\cjmit\.local\bin\claude.exe` |
| Auth | Authenticated via Claude Pro subscription (cjmitchell001@gmail.com) |
| Default model | Sonnet 4.6 |
| Project folder | `C:\Users\cjmit\Local Sites\leicester-oven-cleaning\app\public\wp-content\themes\leicester-oven-cleaning-child` |

### CLAUDE.md

A `CLAUDE.md` file should be created in the project root using this context document as the source. This gives Claude Code automatic project context in every session without needing to re-explain the project.

**Priority features to learn and use:**
- `/goal` — set clear objective before starting a task
- `/re` — rollback to checkpoint if something goes wrong (replaces the manual file-revert pattern used throughout the June 2026 session)
- `Skills` — reusable markdown instructions for common tasks (CSS conventions, PHP patterns, JS patterns specific to this project)
- Sub-agents — useful for Phase 2 when building frontend and backend simultaneously

-----

## 25. Business Strategy & Mentoring Principles

*(Unchanged from V9 Section 21 — reproduced in full)*

### The core frame — job vs asset

- The central distinction is **job vs asset**. A *job* is where the business *is* Chris — when he stops working, the money stops, and there is nothing to sell. An *asset* runs and earns without him, and can be sold.
- Rough working definition of business value: **owner-free cash flow × the predictability of that cash flow.**
- Chris's existing instincts already point at "asset": the Ltd structure, the umbrella/holding brand, and the systematised booking funnel are all asset-building moves.
- **Method:** work backwards from the eventual sale.

### The first hire — the hinge and the "valley"

- The **first hire is the hinge** on which job becomes asset.
- The first hire causes a **temporary income dip (the "valley")** — crossed deliberately via: hire into overflowing diary, hold a cash cushion, fatten margin first.
- **Funding order for the valley: margin → cash cushion.** Director's loan is NOT proposed for bridging the first-hire dip.

### Pricing & unit economics — ILLUSTRATIVE ANALYSIS ONLY

> **Pricing is not formally decided.** All figures are illustrative analysis only.

- Market context (Leicester, 2026): budget from ~£49, strong local Ltd ~£75 single / £94 double
- With a hired cleaner, a single-oven job costs roughly £54 to deliver fully loaded. A ~£10 price increase nearly doubles per-job owner profit.
- **The basket beats the oven:** add-ons (hob, extractor) are near-pure margin.
- The honest test of any price: does it survive paying someone else to do the work?

### The day-rate floor

- ~£340/day to truly match a ~£37.5k employed package (vs ~£250/day assumed — the difference is hidden employer costs and non-billable days)
- Use ~£340/day as a floor, never a ceiling.

### Sales model & sequencing

- One-off clean is the front door; recurring is offered at the doorstep after the first job
- Recurring revenue is the highest-value asset characteristic for a sale multiple
- Domestic-only for ~first 6 months — forced by the HGV day job constraint, not a compromise
- 6 months exists to gather: true cost/time per job, demand signal, cleaning method written down

### The cautionary anchor — the ten-year solo operator

- Real operator Chris knows: ~10 years, still solo, tried hiring, retreated — because he hired into an unchanged thin-margin model
- **The lesson:** not a failure at hiring — a failure to re-engineer the model before hiring

### Customer acquisition — three sequential jobs

- **Get found (visibility) → get trusted (credibility) → get the booking (conversion)**
- Credibility and conversion are largely built. The real gap is **visibility**.
- Early channel priority: warm circle + word of mouth first → local social + leaflets second → Google/SEO planted now to harvest later

-----

*Document version: 6.0 — Updated June 2026. Major funnel rebuild: Step 1 now uses sticky bar, Step 2 rebuilt with static continue bar and inline write bug fixed, Step 3 summary repositioned and sticky behaviour removed. All four user journey routes tested and working on mobile. Claude Code installed. Architecture migration plan agreed and documented. Next priority: responsive breakpoint pass from mobile up to desktop.*
