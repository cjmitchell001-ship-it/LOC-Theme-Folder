# Copy Audit — Areas We Serve Page
Generated from `page-areas.php` in page order. JS-injected copy: none found — `functions.php` was searched for any `is_page('areas')` or equivalent hook and no matches were found.

---

## Page Header

| Element | Copy | Location |
|---------|------|----------|
| Eyebrow | "Where We Cover" | ~L15 |
| h1 | "Areas We Serve" (rendered as "Areas " + `<span>We Serve</span>`) | ~L16 |
| Intro | "We cover Leicester city and the surrounding Leicestershire area. Enter your postcode on the reservation page for instant confirmation — or check the list below." | ~L17 |

> **PLACEHOLDER FLAG:** "Enter your postcode on the reservation page for instant confirmation" — this implies a live postcode-lookup that confirms coverage. In practice, Step 2 of the funnel has a postcode input and a clickable area-tag list, but there is no automated coverage API — it's a static selectable list with no backend validation. The word "instant confirmation" may oversell the mechanism. Flag for review: is this accurately describing what the funnel actually does?

---

## Map Section

| Element | Copy | Location |
|---------|------|----------|
| Map placeholder label | "Coverage map — Leicester & Leicestershire" | ~L32 |
| Map placeholder note | "Map coming soon" | ~L33 |

> **PLACEHOLDER FLAG:** The map is explicitly a placeholder. The HTML comment reads "Replace with real Google Maps screenshot before go-live" (~L26). The placeholder note "Map coming soon" is visible to users.

---

## Area List Section

| Element | Copy | Location |
|---------|------|----------|
| Eyebrow | "Coverage" | ~L43 |
| h2 | "Where We Work" | ~L44 |

### City & Inner Group (~L49–65)

| Area name | Postcode | Location |
|-----------|----------|----------|
| "Leicester City" | LE1 | ~L51 |
| "Stoneygate" | LE2 | ~L52 |
| "Clarendon Park" | LE2 | ~L53 |
| "Oadby" | LE2 | ~L54 |
| "Knighton" | LE2 | ~L55 |
| "Glenfield" | LE3 | ~L56 |
| "Braunstone" | LE3 | ~L57 |
| "Birstall" | LE4 | ~L58 |
| "Thurmaston" | LE4 | ~L59 |
| "Hamilton" | LE5 | ~L60 |
| "Humberstone" | LE5 | ~L61 |
| "Wigston" | LE18 | ~L62 |
| "Narborough" | LE19 | ~L63 |

### North & West Group (~L68–83)

| Area name | Postcode | Location |
|-----------|----------|----------|
| "Groby" | LE6 | ~L70 |
| "Anstey" | LE7 | ~L71 |
| "Syston" | LE7 | ~L72 |
| "Scraptoft" | LE7 | ~L73 |
| "Queniborough" | LE7 | ~L74 |
| "Kirby Muxloe" | LE9 | ~L75 |
| "Earl Shilton" | LE9 | ~L76 |
| "Hinckley" | LE10 | ~L77 |
| "Loughborough" | LE11 | ~L78 |
| "Shepshed" | LE12 | ~L79 |
| "Mountsorrel" | LE12 | ~L80 |
| "Sileby" | LE12 | ~L81 |

### South Group (~L86–94)

| Area name | Postcode | Location |
|-----------|----------|----------|
| "Blaby" | LE8 | ~L88 |
| "Countesthorpe" | LE8 | ~L89 |
| "Fleckney" | LE8 | ~L90 |
| "Lutterworth" | LE17 | ~L91 |
| "Market Harborough" | LE16 | ~L92 |

### Outer Group (~L97–104)

| Area name | Postcode | Location |
|-----------|----------|----------|
| "Melton Mowbray" | LE13 | ~L99 |
| "Melton Rural" | LE14 | ~L100 |
| "Oakham" | LE15 | ~L101 |
| "Rutland" | LE15 | ~L102 |

---

## Overlap — Areas Page vs. Funnel Step 2 (`page-reserve-step2.php`)

The Step 2 funnel contains an identical four-group area-tag list used for postcode selection. A direct comparison:

| Group | This page | Step 2 funnel | Match? |
|-------|-----------|---------------|--------|
| City & Inner | 13 items, LE1–LE19 | 13 items, LE1–LE19 | ✓ Identical items |
| North & West | 12 items, LE6–LE12 | 12 items, LE6–LE12 | ✓ Identical items |
| South | 5 items, LE8–LE17 | 5 items, LE8–LE17 | ✓ Identical items |
| Outer | 4 items, LE13–LE15 | 4 items, LE13–LE15 | ✓ Identical items |

**One name discrepancy found:**
- This page: "Market Harborough" (~L92)
- Step 2 funnel: "Mkt Harborough" (`page-reserve-step2.php` ~L134)

Both refer to the same place (LE16). The Areas page uses the full name; the funnel uses an abbreviated version. Minor inconsistency — likely a display-space abbreviation in the funnel tag — but flag for reconciliation.

> **PLACEHOLDER FLAG:** The FAQ page states "We cover all LE postcodes" (`copy-audit-faq.md` — see Coverage & Eligibility section). This page lists specific LE districts only — not all LE postcodes are included (e.g. LE20 is not listed). The FAQ's "all LE postcodes" claim is broader than what this page documents. Flag for reconciliation.

---

## Not on the List? Section

| Element | Copy | Location |
|---------|------|----------|
| h2 | "Not on the list?" | ~L115 |
| Body | "We're expanding our coverage as the business grows. If your area isn't listed, it's worth getting in touch — we may still be able to help depending on location and current schedule. We'll always be honest if it's not practical." | ~L116 |
| Button | "Get In Touch →" (links to `/contact`) | ~L117 |

---

## How Our Area Check Works Section

| Element | Copy | Location |
|---------|------|----------|
| h2 | "How our area check works" | ~L126 |
| Body | "When you reach Step 2 of the reservation, you'll enter your postcode or select your area. We'll confirm instantly whether we cover you. If you're in a listed area, you're good to go. If you're just outside, get in touch — we'll do our best." | ~L127 |
| Button | "Start Your Reservation →" (links to `/reserve-step-1`) | ~L128 |

> **PLACEHOLDER FLAG:** "We'll confirm instantly whether we cover you" — same concern as the page header. "Instantly" implies automated backend validation. The actual Step 2 mechanism is a selectable static list with a postcode text input; there is no real-time API call checking coverage. The word "instantly" is defensible (the UI responds immediately client-side) but the implication of a coverage-check backend may mislead.

---

## Trust Markers / Credentials / Guarantee Copy

None on this page. No insurance, ICO, Companies House, or fixed-price copy. No testimonials.

---

## Founder/Personal Identity Check

No name, photo, or biographical/employment detail found anywhere on this page. Fully compliant with CLAUDE.md's Privacy Requirement.

---

## Image Alt Text

No `<img>` elements on this page. The map is an SVG placeholder with visible text labels captured above. No alt text to extract.

---

## JS-Injected Copy

None. `functions.php` was searched for any `is_page('areas')` or equivalent hook and no matches were found — this page has no JS-injected copy.

---

*Placeholder phone/ICO/Companies House content is not referenced on this page — see `copy-audit-header-footer.md` for those (site-wide footer/header elements appear on every page including this one, but were already captured there).*
