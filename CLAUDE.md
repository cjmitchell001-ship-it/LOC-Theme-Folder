---
title: Leicester Oven Cleaning — Claude Code Project Context
description: Single source of truth for the theme/codebase — design tokens, working conventions, funnel architecture, known bugs, the migration plan, and the founder privacy requirement. Read at the start of every session.
tags: [technical, design-tokens, wordpress, css, leicester-oven-cleaning]
type: reference
updated: 2026-06-16
---

# Leicester Oven Cleaning — Claude Code Project Context

> This file is the single source of truth for the project. It is maintained alongside the code and updated as decisions are made. Read it at the start of every session. Do not treat the V10 context document as authoritative — this file supersedes it.

---

## Project

Startup oven cleaning business based in Leicester, UK. Founder: Chris. Pre-launch — no commercial customers yet. The website is built and being refined before go-live. Solo project — Chris is the only person touching the site.

**Trading name:** Leicester Oven Cleaning  
**Parent company name:** The Proper-T Cleaning Group — **not yet registered as a Ltd company**  
The "Companies House Registered" footer badge and "Ltd" in the copyright line have been removed (June 2026, m8) — they were aspirational placeholder copy, not a current fact.

---

## Hard Technical Facts

### Stack

| Item | Detail |
|------|--------|
| Local dev | Local by Flywheel |
| Local domain | `leicester-oven-cleaning.local` |
| WordPress | 6.9.4 |
| Theme | **Standalone theme** — GeneratePress parent dependency REMOVED. Full CSS control, no parent fallbacks. |
| Theme folder | `leicester-oven-cleaning-child` (name is historical — it is NOT a child theme any more) |
| Hosting | SiteGround (pre-launch, live site exists) |
| Version control | git (run git via Claude Code, not the VS Code PowerShell terminal — git is not on that terminal's PATH) |

WordPress is used for routing and template loading only. There are no plugin dependencies in the funnel. All pages are custom PHP/CSS/JS.

### Theme Files

| File | Purpose |
|------|---------|
| `style.css` | All CSS — design tokens, global styles, every page and funnel component (~7,700 lines, CRLF, UTF-8 no BOM) |
| `functions.php` | Font enqueue, Google Fonts, hamburger JS, hero carousel JS, contact JS, `loc_step1_script`, `loc_step2_script`, `loc_step3_script`. ALL inline JS lives here. |
| `front-page.php` | Homepage |
| `header.php` | Custom sticky site header (nav hardcoded, not wp_nav_menu) |
| `footer.php` | Five-column footer (brand + Services + Company + Help + Legal) |
| `page-about.php` | About page |
| `page-contact.php` | Contact page — uses Contact Form 7 |
| `page-business-commercial.php` | B2B / commercial page |
| `page-legal.php` | Shared legal template |
| `page-services.php` | Services page (Template Name: Services) |
| `page-how-we-work.php` | How We Work page (Template Name: How We Work) |
| `page-faq.php` | FAQ page (Template Name: FAQ) |
| `page-areas.php` | Areas We Serve page (Template Name: Areas) |
| `home.php` | Blog listing |
| `single.php` | Blog post |
| `404.php` | 404 page |
| `page-reserve-step1.php` | Funnel Step 1 — appliance selection |
| `page-reserve-step2.php` | Funnel Step 2 — postcode / area |
| `page-reserve-step3.php` | Funnel Step 3 — calendar + reservation modal |

Companion docs in the repo: `STYLE-CONFLICTS.md` (conflict/duplication audit — the structural to-do list) and `STYLE-AUDIT.md` (original value audit). Read alongside this file.

---

## Design Token System (authoritative — use tokens, never hardcode)

Every colour, space, font-size, shadow, radius, and z-index is a CSS custom property in `:root`. **Never reintroduce a hardcoded value.** Need a value with no token? Snap to the nearest existing token, or add a new token to `:root` first, then use it. Never leave a literal.

`:root` definitions keep their literal values — never tokenise a token definition (no `--blue: var(--blue)`).

### Brand colours
`--blue #1A3A6E` · `--gold #C9960C` · `--gold-light #e8b020` · `--white #FFFFFF` · `--lightgrey #F5F5F5` · `--offblack #1C1C2E` · `--border #e2e2e2`

### Greys
`--grey-700 #444` · `--grey-600 #555` · `--grey-500 #666` · `--grey-400 #888` · `--grey-300 #aaa` · `--grey-200 #ccc` · `--grey-100 #e2e2e2` · `--grey-50 #F5F5F5`
(`--grey-600` exists specifically for body text — do not fold it into `--grey-500`.)

### Blue tints
`--blue-dark #122d58` · `--blue-darker #0f2550` · `--blue-pale #eef3fa`

### White overlay ramp (glass panels on blue)
`--white-a05 / a10 / a15 / a35 / a60 / a85`

### Spacing (4px base; token number × 4 = px)
`--space-1 4` `--space-2 8` `--space-3 12` `--space-4 16` `--space-5 20` `--space-6 24` `--space-7 28` `--space-8 32` `--space-10 40` `--space-12 48` `--space-14 56` `--space-16 64` `--space-18 72` `--space-20 80` `--space-25 100` `--space-30 120`

### Type (px; body base = `--text-body` 17px)
`--text-fine 11` `--text-xs 12` `--text-sm 13` `--text-ui 14` `--text-ui-lg 15` `--text-body-sm 16` `--text-body 17` `--text-body-lg 18` `--text-lead 20` `--text-h4 24` `--text-h3 28` `--text-h2 32` `--text-h2-lg 36` `--text-h1 40` `--text-display 56` `--text-hero 80` `--text-hero-xl 120`

### Shadows (elevation ramp, brand-blue tinted)
`--shadow-xs` `--shadow-sm` `--shadow-md` `--shadow-lg` `--shadow-xl` · `--shadow-up` (sticky/fixed bottom bars, casts upward) · `--shadow-gold` (gold button/badge glow)

### Radius
`--radius-xs 2` `--radius-sm 4` `--radius-md 8` `--radius-lg 16` `--radius-pill 20` `--radius-full 50%`

### Z-index ladder
`--z-base 1` `--z-raised 2` `--z-sticky 100` `--z-fixed-bar 200` `--z-nav 500` `--z-header 700` `--z-overlay 1000` `--z-modal 1200` `--z-modal-ui 1210`
Stacking intent: page content (base/raised) < sticky bars < nav menu < header < modal overlay < modal < modal UI. The modal overlay deliberately sits ABOVE the header so it covers it.

### Typography
- **Headings:** Montserrat 700/800 — Google Fonts CDN
- **Body:** Open Sans 400/600, 17px base — Google Fonts CDN

---

## Working Conventions

1. **Tokens only.** Replace any hardcoded value with a token (see above).
2. **No `!important`.** If a rule won't apply, the cause is a specificity conflict or a duplicate rule — find and fix that. The legacy GP `!important` workarounds have all been removed (June 2026). Two intentional `display: none !important` guards remain (Step 1/2 sticky-bottom desktop hide rules) — do not remove those.
3. **One element, one home.** Each element governed by one clear rule. Don't add a second class to win a fight; fix the conflict.
4. **CRLF line endings, UTF-8 NO BOM.** `style.css` is CRLF. Any script that rewrites the file MUST detect and preserve the line ending (double-quoted `` "`r`n" `` in PowerShell checks — single quotes give false negatives) and write with `UTF8Encoding($false)` (no BOM). VS Code default encoding should be `utf8` (not utf8bom).
5. **For multi-instance value changes, prefer a verified script over hand-edits.** The Edit tool repeatedly failed insert-vs-replace on `:root` lines; literal string-replace with an "assert occurs exactly once, else abort" guard is reliable.
6. **Commit per logical change**, descriptive message, clean working tree between tasks. Don't commit one-off tooling scripts — delete them after (their work is in the commit).
7. **Approval gates stay ON.** Never "allow all edits" / "don't ask again". The per-step review is what catches errors.

---

## VERIFICATION — hard-won lessons (read twice)

Bugs were shipped during the token refactor because verification checked the wrong thing. Caught later by audit, not the browser. Do not repeat:

- **A swap that changes a VALUE can also damage the PROPERTY NAME or a DEPENDENCY.** The shadow pass wrote `ox-shadow:` (dropped the `b`) on 21 declarations — values correct, property dead, shadows invisible. After ANY find-and-replace: verify (a) the property name is intact, (b) every `var(--x)` it references is actually DEFINED in `:root`.
- **A `git checkout` revert can orphan a dependency a later step assumes exists.** `--space-18`/`--space-25` definitions were rolled back by a revert, then a later swap wrote `var(--space-18)` referencing the now-missing token → those sections rendered with ZERO padding. After any revert-then-redo, confirm all referenced tokens resolve.
- **Verify against the actual file/diff, not the script's narration.** Verification scripts repeatedly produced alarming-but-wrong intermediate output while the file was fine (and occasionally the reverse). Resolve contradictions by reading the real diff/file.
- **PowerShell writes can add a UTF-8 BOM or convert line endings.** A BOM (`EF BB BF`) on byte 0 of a CSS file is harmless-looking but can misparse the first rule / break build tools. After any script write: confirm first bytes are the expected content, CRLF preserved, and `git diff` shows only the intended change.
- **Visible-change passes get a browser check that looks for the thing PRESENT, not just "looks fine."** "Looked good" missed absent shadows. Confirm the specific element shows the specific expected result.
- **Count and list must agree.** "22 found" but 21 listed → reconcile before acting.

---

## Funnel — Session Storage Keys

| Key | Written by | Read by | Value |
|-----|-----------|---------|-------|
| `loc_selections` | Step 1 confirm / Step 2 inline sticky btn | Step 2 carryover, Step 3 summary | JSON `{name: price}` |
| `loc_total` | Step 1 confirm / Step 2 inline sticky btn | Step 2 carryover bar, Step 3 summary | Integer |
| `loc_from_step1` | Step 1 confirm | Step 2 routing, carryover IIFE | `'true'` |
| `loc_skip` | Step 1 skip / Step 2 skip | Step 3 total display | `'true'` |
| `loc_postcode` | Step 2 confirm btn | Step 3 (unused currently) | String e.g. `'LE4'` |

`loc_skip` must be explicitly `removeItem`'d when proceeding with actual selections. A stale skip flag causes Step 3 to show £TBC despite real selections.

## Funnel — Four User Journey Routes

1. Step 1 appliances → Step 2 → Step 3 (selections + total carried through)
2. Step 1 skip → Step 2 → Step 3 (£TBC throughout)
3. Direct land Step 2 → inline appliances → Step 3 (sticky bar writes storage on click)
4. Direct land Step 2 → inline discuss → Step 3 (£TBC throughout)

All four routes implemented and tested on mobile (June 2026).

## Funnel — Step 3 Mobile Layout Rules

- Summary panel sits **below** the calendar on mobile (`order: 1`). Do not move it back above (`order: -1`) — deliberately changed.
- No sticky/condense behaviour on any breakpoint — old scroll handler fully removed.
- Auto-scroll on slot select: `summaryCol.scrollIntoView({ behavior: 'smooth', block: 'end' })`
- `loc-step3-summary__slot--active` (pulsing) only removed on successful form submit.

---

## Placeholder Content (Not Yet Real — replace before go-live)

- **Phone number:** `tel:PLACEHOLDER` — appears in the `header.php` Call button (mobile blue phone SVG icon, added m8). Mobile dropdown menu no longer has a "Call Us" item (removed m8 — contact page handles discovery instead). VoIP not yet obtained. Update when real.
- **Reserve URLs:** Reserve buttons point to `/reserve-step-1` (the earlier `/reserve` 404 bug is fixed).
- **ICO number:** Footer wording reworded (m8) to remove the implication of a current registration number — still placeholder, no real ICO number yet.
- **Companies House:** Badge/claim removed from footer entirely (m8) — company not registered, no number to show.
- **Cancellation policy:** Placeholder page created (m8) — content still to be written before go-live.
- **Social links:** All `#` placeholders in `footer.php`
- **All pricing figures:** Placeholder throughout the funnel
- **Calendar availability:** Hardcoded arrays in Step 3 — no real booking API
- **Areas map image:** AI-generated placeholder
- **Hero carousel images:** Mix of AI/stock — real photos needed

---

## Known Bugs / Open Items

- ~~**Reserve button URLs** `/reserve` → `/reserve-step-1`~~ Fixed June 2026
- ~~**Mobile header overflow:** RESERVE/CALL/hamburger clipped off right edge~~ Fixed — Call moved into the dropdown menu, header row is now logo · Reserve · hamburger. (This was the root cause of the funnel's 780/781 breakpoint hack — see breakpoint note below.)
- ~~**Token rendering bugs from the refactor:** `--space-18`/`--space-25` undefined (8 sections zero-padding); `ox-shadow` typo (21 shadows not rendering)~~ Both found by the conflict audit and fixed June 2026.
- **Step 3 skip route text:** `#loc-summary-items` shows "No selection found" when skip route used — should say "To be discussed on the call"
- **Step 1 desktop right rail:** Empty after summary panel was removed — needs a plan for the responsive pass
- ~~**Clickable contact references — pre-launch task:**~~ Completed June 2026 (m12). 17 instances linked across 6 files (`front-page.php`, `page-areas.php`, `page-business-commercial.php`, `page-faq.php`, `page-legal.php`, `page-services.php`). Call references use `tel:PLACEHOLDER`; all others use `/contact`. Final sweep confirmed zero unlinked instances remain.

---

## Structural Cleanup — COMPLETE (June 2026)

Token system and all 6 structural cleanup objectives are done. 9 commits, ~550 lines removed from `style.css`. Detail in the session report at the end of this file.

1. ✅ **`!important` removal.** 24/26 removed. 2 intentional guards kept (Step 1/2 sticky-bottom desktop hide).
2. ✅ **Duplicate selectors.** 221-line verbatim Step 2 copy deleted; straggler selector merged; dead block removed.
3. ✅ **Breakpoint unification.** Canonical pair: `max-width: 768px` / `min-width: 769px`. 780/781px cluster (15 blocks) collapsed. Overlap bug fixed.
4. ✅ **Section-spacing normalisation.** Two outliers corrected (`.loc-reserve`, `.loc-hww-page-section`).
5. ✅ **Component consolidation.** 19 eyebrow CSS blocks → `section-eyebrow` utility class (14 PHP templates updated). 9 sticky-bar sub-element pairs comma-grouped.
6. ✅ **Media query collection.** Duplicate Step 2 responsive block merged; 3 back-to-back layout-cap blocks collapsed into one.

**What remains (deferred):**
- Sticky-bar full CSS/JS unification (Option B) — JS references sub-element class names; deferred until a JS refactor pass.
- `STYLE-CONFLICTS.md` is stale — all items resolved; archive or rewrite before Phase 2.
- `loc-step3-summary-col { order: 1 }` formatting inconsistency (unindented inside `@media`) — low priority.

---

## Architecture Migration (AGREED — Phase 2)

Migration off WordPress to a static stack is **agreed**. WordPress is only used for URL routing and template loading — ~95% of the site is custom PHP/CSS/JS with no real WP dependency, and SiteGround hosting (~£220/yr) is overhead for what's used.

**Target stack:** static frontend on **Cloudflare Pages** (free/very cheap) + a separate **booking API** (Railway/Render, ~£5-7/mo). Projected cost ~£60-80/yr.

**Timing — the agreed plan:** migration happens **at the same time as building the real booking backend — both together as one project (Phase 2)**, NOT before and NOT after. Reasoning: the funnel JS is already structured for API calls (sessionStorage is a temporary stand-in); the PHP templates are almost entirely portable (only 3-4 WP function calls to replace); building the backend inside WP and then migrating creates coupling that has to be unpicked; doing both at once is one project not two.

**HARD PRINCIPLE: do not start migration until the frontend is completely finished, tested, and signed off.** Frontend-first. The structural cleanup below IS part of finishing the frontend.

**Why the cleanup matters for migration:** the CSS carries over to the static stack essentially unchanged (the migration is lifting the HTML/CSS/JS out of WP's template wrapper). So every bit of structural cleanup — `!important` removal, breakpoint unification, spacing normalisation, component consolidation — ports directly AND de-risks Phase 2 (less to puzzle over / port when served statically). None of it is throwaway WordPress-specific work.

---

## Privacy Requirement — Founder Identity

Chris (the founder) wants his name, face, and personal/employment history kept OFF all public-facing pages for now — he is deliberately staying anonymous from some people while the business is pre-launch. Do not add a name, photo, or biographical detail (employment history, how the business started, personal anecdotes) to any page. The About page profile card shows role/location/quote only, no name. The intro and story sections are written in first person without self-identifying detail.

**Exception: `page-business-commercial.php` intentionally uses the founder's first name ("Chris") three times**, in the "What Makes Us Different" section and contact options (~L130, ~L172, ~L283). This was a deliberate, reconsidered decision (June 2026) — the blanket no-name rule still applies to all other pages (About page remains fully anonymous), but this page is treated as an intentional exception. Do not depersonalise this page in future sessions without explicit instruction.

---

## Voice & CTA Rules

- Brand voice: direct, confident, local — never corporate or generic
- CTA rule: always **"Reserve Your Slot — we'll call to confirm"** — never "Book Now"
- Primary CTA pattern: a short reassurance tagline directly above the button, button itself short (e.g. "Reserve Your Slot →"), with a subtext line below covering practical details (time, deposit, commitment)
- Deposit taken after the confirmation call by bank transfer — no card details, no online payment of any kind at reservation or otherwise. Remaining balance by bank transfer or cash on the day.
- Do not reference appliance repair as a current service — future ambition only
- No eco-friendly claims; no financial guarantees in copy; no dirty-oven before/after imagery
- **Founding Customer Rate:** fully removed (June 2026) — do not reintroduce

---

## Session Log

| Date | What changed |
|------|-------------|
| June 2026 | Step 1: right-rail summary removed, sticky bottom bar added. Step 2: summary removed, static continue bar, inline-route £0 storage bug fixed. Step 3: summary below calendar on mobile, sticky/condense removed, auto-scroll on time selection, modal dead-end fixed. Claude Code installed. |
| June 2026 (m2) | Header reserve URLs → `/reserve-step-1`. Step 2 postcode/sessionStorage sync fixes; location+postcode in continue/summary/sticky bars. Step 3 restructured into Location/Date/Time rows; various encoding/autofill/name-field fixes. GeneratePress button-colour bleed → temporary `!important` workarounds. |
| June 2026 (m3) | 601px layout complete. Step 1 in-flow 2-col panel, scroll-down hint. Step 3 sticky bar hidden above 600px. |
| June 2026 (m4) | Full funnel stress-tested across breakpoints. Step 1 desktop 3-col (781px+, sticky sidebar, `overflow-x: clip` fix). Step 2 confirm bar top:74px. Step 3 desktop body 900px cap. "Add Extras" label. |
| June 2026 (m5) | Homepage restructure (section order finalised). Founding Rate removed site-wide. Four new inner pages (Services/HWW/FAQ/Areas). Footer → 5 columns. Header nav hardcoded. Brand CSS ticker. Desktop whitespace reduced (section padding 80→48). GeneratePress confirmed as migration trigger. |
| June 2026 (m6 — CSS systematisation) | **GeneratePress dependency removed (standalone theme).** Dead code removed (46 classes). Full design-token system built and applied across 7 categories: colour, grey, shadow, radius, spacing (on-grid + off-grid snap, + `--space-18`/`--space-25`), type (+ `--text-body-lg`/`--text-h2-lg`), z-index (ladder + `--z-nav`, fixed header/modal collision). Mobile header overflow fixed (Call → dropdown menu). Two refactor-introduced bugs found by conflict audit and fixed (`--space-18/25` undefined → zero-padding; `ox-shadow` typo → 21 shadows not rendering). Conflict audit written (STYLE-CONFLICTS.md). This CLAUDE.md rewritten with full token system + verification lessons. |
| June 2026 (m7 — structural cleanup) | All 6 structural cleanup objectives complete. !importants removed (24/26). Duplicate selectors eliminated (221-line Step 2 copy deleted). Breakpoints unified to 768/769px canonical pair (780/781 cluster collapsed). Section spacing normalised. Eyebrow pattern consolidated: 19 CSS blocks → `section-eyebrow` utility across 14 PHP templates. Sticky-bar sub-elements deduplicated. @media scatter resolved. 9 commits, ~550 lines removed from style.css. |
| June 2026 (m8 — copy pass) | Began conversion-copywriting review, page by page. Header/footer copy fixed (Companies House badge removed, Ltd dropped from copyright, ICO inconsistency resolved, cancellation policy placeholder page created). Mobile header: phone SVG icon added (blue) between Reserve and hamburger, Call Us removed from dropdown menu (contact page handles discovery instead). Homepage: new hero proposition ("Your oven, cleaned properly. Fixed price, same day."), trust bar item 3 replaced (Local & Independent), Step 2 simplified, £25 deposit now mentioned in Step 3 and CTA subtext, tagline-above-button CTA pattern introduced, FAQ "do I need to be home" added, business banner rewritten (out-of-hours + multi-site angle). About page: full rework removing personal identifiers (no name, no face, no employment history) per privacy requirement — story section replaced with two side-by-side cards (The Approach / Looking Ahead), Looking Ahead expanded to include commercial extraction units and accessibility retrofitting as market-testing feedback-loop CTA, credentials fixed (Companies House removed, ICO placeholder reworded), values copy tightened (price promise scoped to cleaning not repair, "on time" promise softened, Yorkshire tea line added). FAQ: "what's included in the price" added (extra trays/shelves scope). |
| June 2026 (m9 — copy pass continued) | **Site-wide copy pass:** Legal sweep — Ltd/Proper-T Cleaning Group removed throughout, sole trader language introduced, Privacy Policy and T&Cs updated accordingly. Cookie policy rewritten to reflect Google Analytics (sessionStorage-only claim was incorrect). Cancellation policy aligned with FAQ two-tier structure. Payment mechanic updated to Stripe card-hold model (£0.00 due at reservation, hold released or £25 charged after confirmation call). "Dip tank" removed site-wide and replaced with descriptive process language. AGA/BBQ/Rayburn repositioned as quoted-and-arranged-individually services. Areas map placeholder removed from Areas page. Commercial page headline updated. Contact page headline updated. Step 3 sticky bar: button copy now progresses from "Reserve Your Slot →" to "Confirm Your Slot →" once date and time are both selected (JS change in `loc_step3_script`). Footer copyright simplified (trading-as line removed). ICO badge updated to "ICO Registration Pending". FAQ: new Q&A added (Why do you need my card details to reserve?), "Do I need to be home" answer softened, electricity sentence removed from access answer, card payment answer updated for Apple/Google Pay. **Homepage:** hero eyebrow added ("Leicester Oven Cleaning"), how to reserve intro copy updated, Step 3 card description rewritten, CTA subtext line removed, reviews section rewritten (stars removed, new statement). **About page:** hot water line added to Your Home Respected tile, Fully Insured tile replaced with new "You're Invited to Check the Result" tile, Fully Insured moved to credentials section, Looking Ahead card removed, CTA body copy updated. |
| June 2026 (m10 — copy pass continued) | **Inner pages & funnel copy pass.** Services: BBQ price replaced with "Contact us" (matching AGA pattern), CTA subtext updated to standard pattern. How We Work: "Technician introduces themselves at the door" arrival line removed, CTA subtext updated to standard pattern. FAQ: access answer updated (hot water clause added), bank transfer added to card payment answer, "What's included" answer adds "(if any)" qualifier, new Results & Expectations section added (3 Q&As: brand new result, existing damage/faults, not happy with result), "What if you can't get access on the day?" added to On The Day, "When is payment due?" added to Pricing & Payment. Areas: standard CTA subtext added above Reserve button. T&Cs: fixed price clause updated (condition caveat nuanced, material-difference wording), bank transfer added to domestic payment methods, hot water clause added to access section, safety risk deposit clause replaced with specific discussion-first + full refund commitment. **Funnel:** Step 1 price guarantee copy softened (condition language removed). Step 2 direct-landing "Fixed price · No card needed · We call to confirm" subtext removed. Step 3 price guarantee replaced with card-hold explanation copy; "No card taken now" subtext line removed. `Codemaster-Skill.md` added to repo root — standing technical authority skill file covering code review, pre-launch/pre-migration audits, and Phase 2 readiness. Post-copy-pass integrity check run and passed (all 8 modified templates structurally sound, no CSS/JS changes). |
| June 2026 (m11 — payment mechanic update) | **Stripe card-hold model removed site-wide; replaced with bank transfer mechanic.** New mechanic: reservation requires no payment and no card details; Chris calls to confirm; £25 deposit arranged on that call by bank transfer; remaining balance by bank transfer or cash on the day. Changes across 3 files: FAQ — "Is there a deposit?" rewritten, "Do you take card payment?" renamed to "How do I pay?" and rewritten, "Why do you need my card details?" Q&A removed entirely, "When is payment due?" updated (card reader removed). Step 3 — price guarantee container rewritten, confirmation panel subtext updated ("no card has been taken" → "no payment has been taken"). Legal — T&Cs domestic payment clause updated (deposit described as bank transfer on the call, card removed from balance methods), cancellation refund processing updated ("original payment method" → "bank transfer to the account used to pay the deposit"). Steps 1 & 2, front-page, HWW, commercial, and footer confirmed clean — no changes needed. "No card needed" phrases in sidebars/contact page left in place (still factually accurate). |
| June 2026 (m12 — contact references sweep) | **All passive contact references made clickable site-wide.** 17 instances linked across 6 files. Rule: call references → `tel:PLACEHOLDER`; all other contact references → `/contact`. Files changed: `front-page.php` (1), `page-areas.php` (1), `page-business-commercial.php` (3 — "call us directly", "Get in touch" in HMO note, "Speak directly with Chris"), `page-faq.php` (4 — page intro, date availability answer, commercial appliances answer, "Drop us a message" CTA para), `page-legal.php` (4 — cancel instruction, reschedule instruction, 48hr-window note, sidebar contact para), `page-services.php` (4 — page intro, AGA card desc, BBQ card desc, commercial section intro). UI headings, eyebrows, and the contact page's own heading left unlinked (correct). Final sweep confirmed zero unlinked instances. Note: `page-reserve-step3.php:113` has `tel:+441234567890` (not `tel:PLACEHOLDER`) — predates this session, fix when real number confirmed. |
| June 2026 (Phase 2 — Google Calendar API) | **Google Calendar API connection established.** Installed `google/apiclient` v2.19.3 via Composer. Created `calendar-api.php` (4 functions: `loc_get_google_client`, `loc_get_calendar_service`, `loc_get_available_slots`, `loc_create_provisional_booking`). Created `calendar-auth.php` for one-time OAuth flow (accessed via `127.0.0.1:10004`, no WordPress dependency). `token.json` written and gitignored. Calendar ID set to Leicester Oven Cleaning Jobs calendar. `vendor/`, `token.json`, `client_secret_*.json` all gitignored. Commit `57bf832`. |
| June 2026 (Phase 3 — real availability in Step 3) | **Step 3 calendar now shows real availability from Google Calendar.** Created `calendar-ajax.php` — JSON endpoint called by Step 3 JS via `fetch()`, `days_ahead` set to 180. Rewrote `loc_get_available_slots`: zone-labelled dates (all-day events titled North/South/East/West/Central) shown only to customers whose `loc_zone` matches; no-zone dates shown to all customers; fully booked dates hidden; past dates hidden. Updated `loc_step3_script`: replaced hardcoded `unavailableDays` array with `fetch()` to AJAX endpoint; per-date morning/afternoon slot visibility from API response; loading state while fetching; fallback to all-dates mode if zone unknown; skip route and inline Step 2 route use 60-min default duration so zone filtering still applies. Fixed `get_template_directory()` → `get_stylesheet_directory()` in `functions.php` (was resolving to GeneratePress folder, causing fatal error). Fixed CORS error by switching fetch URL from hardcoded `127.0.0.1:10004` to relative path (works on production without changes). Corrected slot time labels: Morning `7am–1pm`, Afternoon `1pm–6pm`. All four funnel routes stress-tested and passing. Commit `f856146`. |
| June 2026 (Phase 4 — reservation submission, calendar write, emails) | **Full reservation submission flow implemented.** Installed WP Mail SMTP (free), configured with `uk12.siteground.eu` SMTP, port 465, SSL, `hello@leicesterovencleaning.co.uk`, Force From Email ON. Created `reservation-handler.php` as a pure logic file (no wp-load.php bootstrap) defining `loc_handle_reservation()`. Registered in `functions.php` via `wp_ajax_nopriv_loc_reservation` and `wp_ajax_loc_reservation` action hooks — WordPress AJAX pattern used specifically to avoid wp-load.php path resolution failures on Windows under Local by Flywheel (mixed backslash/forward-slash paths cause fatal errors; `/wp-admin/admin-ajax.php` loads WordPress natively). `fetch()` in `loc_step3_script` updated to POST to `/wp-admin/admin-ajax.php` with `action=loc_reservation`, `Content-Type: application/x-www-form-urlencoded`, body as `URLSearchParams`. Key bugs fixed: (1) WordPress `wp_magic_quotes()` adds slashes to all `$_POST` values — `wp_unslash()` required before `json_decode` on the appliances JSON string (without it, `json_last_error` returns 4 / JSON_ERROR_SYNTAX and `$appliances` stays empty); (2) sessionStorage timing bug — `loc_selections` was null by submission time because the click handler was reading it after the fetch resolved and cleared it; fixed by snapshotting all sessionStorage values (`ssSelections`, `ssTotal`, `ssDuration`, `ssZone`) into local variables at the very top of the click handler before any validation or async work. `loc_create_provisional_booking` updated to accept `$callback_time` as optional 9th parameter; calendar event description now shows appliances as a multi-line block. All three `wp_mail()` calls confirmed firing and returning `true` via `error_log` debugging. Google Calendar provisional booking confirmed working correctly — event title `PROVISIONAL: [Name]`, correct start time (07:00 morning / 13:00 afternoon), appliances and all customer details in description. Email delivery not verifiable locally — SiteGround SMTP rejects outbound mail from non-SiteGround IPs; will be verified after deployment to live server. Commits `6cb340a`, `e16e162`. |

*Update this log and the sections above whenever significant progress is made or a decision is confirmed.*

---

## Deployment Notes — Google Calendar API

These steps are required when deploying to the live SiteGround server. They are one-time actions per environment.

### Before deploying
1. Go to Google Cloud Console → APIs & Services → Credentials → your OAuth 2.0 Client ID
2. Add the production URL to **Authorised redirect URIs**:
   `https://your-live-domain.co.uk/wp-content/themes/leicester-oven-cleaning-child/calendar-auth.php`
   (keep the `127.0.0.1:10004` local URI alongside it — do not remove it)
3. Save the credentials

### After deploying files to SiteGround
4. `token.json` is gitignored and will not be present on the live server — it must be generated there
5. Visit `calendar-auth.php` on the live domain in a browser to trigger the OAuth flow
6. Sign in with the Google account that owns the Jobs calendar and grant access
7. Confirm the success message: "Calendar connected successfully"
8. `token.json` will be written to the theme folder on the live server
9. The calendar AJAX endpoint will then work correctly on production
