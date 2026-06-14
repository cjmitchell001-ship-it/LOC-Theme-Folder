# Leicester Oven Cleaning — Claude Code Project Context

> This file is the single source of truth for the project. It is maintained alongside the code and updated as decisions are made. Read it at the start of every session. Do not treat the V10 context document as authoritative — this file supersedes it.

---

## Project

Startup oven cleaning business based in Leicester, UK. Founder: Chris. Pre-launch — no commercial customers yet. The website is built and being refined before go-live.

**Trading name:** Leicester Oven Cleaning  
**Parent company name:** The Proper-T Cleaning Group — **not yet registered as a Ltd company**  
The footer currently says "Companies House Registered" — this is aspirational placeholder copy, not a current fact.

---

## Hard Technical Facts

### Stack

| Item | Detail |
|------|--------|
| Local dev | Local by Flywheel |
| Local domain | `leicester-oven-cleaning.local` |
| WordPress | 6.9.4 |
| Parent theme | GeneratePress (free tier) |
| Child theme | `leicester-oven-cleaning-child` ← you are here |
| Hosting | SiteGround (pre-launch, live site exists) |

WordPress is used for routing and template loading only. There are no plugin dependencies in the funnel. All pages are custom PHP/CSS/JS.

### Child Theme Files

| File | Purpose |
|------|---------|
| `style.css` | All CSS — brand variables, global styles, every page and funnel component |
| `functions.php` | Parent theme enqueue, Google Fonts, hamburger JS, hero carousel JS, contact JS, `loc_step1_script`, `loc_step2_script`, `loc_step3_script` |
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

### Brand — CSS Variables (verified in `style.css`)

```css
--blue:       #1A3A6E;   /* Leicester Blue — primary */
--gold:       #C9960C;   /* Rich Gold — accent */
--gold-light: #e8b020;   /* Gold hover state */
--white:      #FFFFFF;
--lightgrey:  #F5F5F5;
--offblack:   #1C1C2E;
--border:     #e2e2e2;
```

Always use these variables. Never hardcode hex values.

### Typography (verified in `style.css` and `functions.php`)

- **Headings:** Montserrat 700/800 — loaded via Google Fonts CDN
- **Body:** Open Sans 400/600, 17px base — loaded via Google Fonts CDN

### Funnel — Session Storage Keys

| Key | Written by | Read by | Value |
|-----|-----------|---------|-------|
| `loc_selections` | Step 1 confirm / Step 2 inline sticky btn | Step 2 carryover, Step 3 summary | JSON `{name: price}` |
| `loc_total` | Step 1 confirm / Step 2 inline sticky btn | Step 2 carryover bar, Step 3 summary | Integer |
| `loc_from_step1` | Step 1 confirm | Step 2 routing, carryover IIFE | `'true'` |
| `loc_skip` | Step 1 skip / Step 2 skip | Step 3 total display | `'true'` |
| `loc_postcode` | Step 2 confirm btn | Step 3 (unused currently) | String e.g. `'LE4'` |

`loc_skip` must be explicitly `removeItem`'d when proceeding with actual selections. Leaving a stale skip flag causes Step 3 to show £TBC despite real selections being made.

### Funnel — Four User Journey Routes

1. Step 1 appliances → Step 2 → Step 3 (selections + total carried through)
2. Step 1 skip → Step 2 → Step 3 (£TBC throughout)
3. Direct land Step 2 → inline appliances → Step 3 (sticky bar writes storage on click)
4. Direct land Step 2 → inline discuss → Step 3 (£TBC throughout)

All four routes are implemented and were last tested on mobile (June 2026). Tablet and desktop breakpoints are outstanding.

### Funnel — Step 3 Mobile Layout Rules

- Summary panel sits **below** the calendar on mobile (`order: 1`)
- Do not move it back above the calendar (`order: -1`) — this was deliberately changed
- No sticky/condense behaviour on any breakpoint — the old scroll handler is fully removed
- Auto-scroll fires when a time slot is selected: `summaryCol.scrollIntoView({ behavior: 'smooth', block: 'end' })`
- `loc-step3-summary__slot--active` (pulsing state) is only removed on successful form submit

---

## Placeholder Content (Not Yet Real)

These are in the live code and must be replaced before go-live:

- **Phone number:** `+441234567890` in `header.php` and elsewhere — VoIP number not yet obtained
- **Reserve URLs:** `/reserve` in `header.php` and `front-page.php` — currently 404s, should be `/reserve-step-1`
- **ICO number:** Shows "[Pending Registration]" in `footer.php`
- **Companies House number:** Not in footer — company not yet registered
- **Social links:** All `#` placeholders in `footer.php`
- **All pricing figures:** Placeholder throughout the funnel
- **Calendar availability:** Hardcoded arrays in Step 3 — no real booking API
- **Areas map image:** AI-generated placeholder
- **Hero carousel images:** Mix of AI-generated and stock images — real photos needed

---

## Known Bugs / Open Items

- ~~**Reserve button URLs:** `/reserve` in `header.php` and `front-page.php` should be `/reserve-step-1`~~ Fixed June 2026
- **Step 3 skip route text:** `#loc-summary-items` shows "No selection found" when skip route used — should say "To be discussed on the call"
- **Step 1 desktop right rail:** Empty after summary panel was removed — needs a plan for the responsive pass
- **Responsive pass:** Homepage desktop (769px+) substantially complete. Funnel steps (Step 1/2/3) desktop responsive outstanding. Inner pages (Services, FAQ, Areas, How We Work, About, B2B) desktop responsive outstanding.
- **GeneratePress interference:** Global `button` styles and `transition` rules continue to bleed through and require `!important` workarounds. Getting worse as the CSS grows. Primary reason migration is being considered now rather than post-launch.

---

## Architecture Migration (Actively Planned)

Migration off WordPress/GeneratePress is the agreed next major step — likely to happen before the site is polished and launched, not after. The GeneratePress parent theme is the primary driver: its global CSS bleeds through the child theme and the workarounds are making `style.css` messier with each session.

**Intended target stack:**
- Static frontend (Astro or similar) hosted on Cloudflare Pages
- Decoupled API backend for the booking funnel (post-launch concern)
- Full ownership of the CSS stack — no parent theme, no `!important` workarounds

**Migration approach:**
- All existing PHP templates, CSS, and JS are self-contained and can be ported directly
- The CSS variable system (`--blue`, `--gold`, etc.) carries over unchanged
- The funnel sessionStorage logic is framework-agnostic and ports cleanly
- Migration is an opportunity to do a full code tidy before final polish

**Do not start migration** without a confirmed plan for the funnel backend (the Step 3 calendar is currently hardcoded — it needs a real booking API or a temporary solution before go-live).

## Soft Ideas (Under Consideration — Not Decided)

- **Founding Customer Rate:** Fully removed from all templates and funnel steps (June 2026). Do not reintroduce.

---

## Voice & CTA Rules

- Brand voice: direct, confident, local — never corporate or generic
- CTA rule: always **"Reserve Your Slot — we'll call to confirm"** — never "Book Now"
- The deposit is taken after the confirmation call, not at reservation
- Do not reference appliance repair as a current service — it is a future ambition only

---

## Session Log

| Date | What changed |
|------|-------------|
| June 2026 | Step 1: right-rail summary panel removed, sticky bottom bar added. Step 2: summary panel removed, static continue bar added, inline route £0 storage write bug fixed. Step 3: summary repositioned below calendar on mobile, sticky/condense behaviour removed, auto-scroll on time selection added, modal dead-end fixed. Claude Code installed. |
| June 2026 (milestone 2) | Header: reserve button URLs fixed to `/reserve-step-1`. Step 2: postcode/sessionStorage sync bugs fixed (tile click and manual re-edit without re-confirm); Location + postcode added to continue bar, inline summary, and mobile sticky bar across all routes. Step 3: page header removed; recommended days feature fully stripped (JS, CSS, homepage copy); Prev/Next nav bounded to current month and 12-month cap; mobile auto-scroll on Clear Selection and callback time pick; summary panel restructured into discrete Location / Date / Time rows with standalone Reserve Your Slot button; autofill yellow background fixed; confirmation screen name field bug fixed; appliance card tick character encoding fixed. GeneratePress global button styles identified as source of nav button text colour bug — `!important` overrides applied as temporary workaround; permanent fix deferred to Astro migration. |
| June 2026 (milestone 3) | 601px layout complete. Step 1: in-flow 2-column panel (skip + total/proceed) replaces sticky bar at 601px+; scroll-down hint indicator added (bouncing arrow, appears on first selection, disappears on scroll); Step 1→Step 2 sessionStorage handoff bug fixed (inflow button had no confirm listener). Step 3: sticky bottom bar hidden above 600px (was rendering as plain block element above its media query). |

| June 2026 (milestone 4) | Full funnel stress-tested across all breakpoints. Step 1 desktop (781px+): 3-column layout — ovens column, extras column, right sidebar (discuss + totals + guarantee); sidebar sticky; `overflow-x: clip` on html+body fixes both CSS sticky and JS-driven fixed positioning. Step 1 601–780px: discuss panel column layout fixed; guarantee box width-matched to discuss panel. Step 2: postcode confirm bar `top` fixed to 74px (below funnel header); areas grid capped at 560px in landscape. Step 3: desktop body capped at 900px max-width; calendar capped at 560px in stacked/landscape layout. Appliance label copy changed to "Add Extras". |
| June 2026 (milestone 5) | Homepage restructure: section order finalised (Hero → Trust → How to Reserve → Pricing → Brand Ticker → Reviews → Areas → FAQ → Business Banner). Founding Rate removed site-wide (all funnel steps, functions.php). Four new inner page templates added: Services, How We Work, FAQ, Areas. Footer expanded to 5 columns. Header nav hardcoded (wp_nav_menu removed). Hero CTAs replaced with bordered group containers (Home Enquiries / Business Enquiries). Brand logos converted to CSS ticker (10 brands, seamless loop, fade-edge mask, 32s speed, 1025px max-width). Trust bar forced to 4-column grid at 769px+. Homepage desktop whitespace aggressively reduced (section padding 80px → 48px across all sections). Pricing panel and Business Banner alignment fixed at 601–768px (left-aligned, full-width CTA). Reviews section constrained to 1080px inner wrapper. Business banner given 48px margin-bottom from footer at all breakpoints. GeneratePress interference confirmed as migration trigger — decision made to migrate before final polish. |

*Update this log and the sections above whenever significant progress is made or a decision is confirmed.*
