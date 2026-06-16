# Copy Audit — Services Page
Generated from `page-services.php` in page order. No JS-injected copy exists for this page (checked `functions.php` — no `is_page('services')` or equivalent hook found).

---

## Page Header

| Element | Copy | Location |
|---------|------|----------|
| Eyebrow | "Our Services" | ~L15 |
| h1 | "Everything We Clean" (rendered as "Everything " + `<span>We Clean</span>`) | ~L16 |
| Intro | "Fixed prices, professional results, and your appliances ready to use the same day. Select what you need when you reserve — or get in touch if you're not sure." | ~L17 |

> **PRICING FLAG:** "Fixed prices" claim in the intro line.

---

## Domestic Services Section

| Element | Copy | Location |
|---------|------|----------|
| Eyebrow | "Domestic" | ~L26 |
| h2 | "For Your Home" | ~L27 |
| Intro | "We clean all domestic cooking appliances. Everything is stripped down, dip-tank cleaned, and reassembled on the same visit." | ~L28 |

### Service Cards

| Card name | Price | Description | Location |
|-----------|-------|--------------|----------|
| "Single Oven" | "from £55" | "Full strip-down clean. Interior cavity, door glass (both sides), racks, trays, fan housing, and exterior." | ~L34-37 |
| "Double Oven" | "from £70" | "Both cavities cleaned independently. All racks, trays, glass panels, and fan housings. Both cavities together." | ~L42-45 |
| "Range Cooker (90cm)" | "from £95" | "Full range clean including all cavities, grill compartment, and exterior." | ~L50-53 |
| "Range Cooker (100cm+)" | "from £120" | "Full clean for larger range formats, including all cavities, compartments, and exterior surfaces." | ~L58-61 |
| "AGA / Large Range" | "Contact us" | "Specialist clean for AGA, Rayburn, and equivalent appliances. Quoted by type — get in touch for a price." | ~L66-69 |
| "Gas Hob" | "from £20" | "Burner heads, caps, pan supports, and hob surface. All parts dip-tank cleaned." | ~L74-77 |
| "Ceramic / Induction Hob" | "from £18" | "Surface clean and polish. Scratch-safe technique throughout." | ~L82-85 |
| "Extractor Hood" | "from £22" | "Grease filters dip-tank cleaned, fan housing degreased, exterior surfaces cleaned and polished." | ~L90-93 |
| "Microwave" | "from £18" | "Interior cavity, turntable, and door — fully cleaned and dried." | ~L98-101 |
| "BBQ" | "from £45" | "Grill grates, burner covers, and interior cleaned and degreased. Seasonal service — contact us to arrange." | ~L106-109 |
| "Oven Parts Replacement" | "Ask on the day" | "We carry common replacement parts — bulbs, door seals, and fan filters — and fit them as part of your clean visit." | ~L114-117 |

> **PRICING FLAG:** All "from £X" prices (£55, £70, £95, £120, £20, £18, £22, £18, £45) are pricing figures — flag per CLAUDE.md "all pricing figures placeholder throughout the funnel," to confirm whether that blanket note also covers this services page or whether these are intended as more deliberate listing prices. Also flag "Contact us" and "Ask on the day" as non-numeric pricing placeholders.
> **NOTE — price mismatch vs funnel:** "Range Cooker (90cm)" lists "from £95" here vs. **£100** in the Step 1/Step 2 funnel templates (`copy-audit-step1.md`/`copy-audit-step2.md`). All other prices match the funnel's `data-price` values (£55/£70/£120/£20→hob is £22 in funnel not £20 — see below/£18/£22/£18). Flag both discrepancies for reconciliation:
>   - Single Oven, Double Oven, Range 100cm+, Ceramic/Induction Hob, Extractor Hood, Microwave all match funnel prices.
>   - **Range Cooker 90cm: £95 here vs £100 in funnel — mismatch.**
>   - **Gas Hob: £20 here vs £22 in funnel — mismatch.**
> **APPLIANCE REPAIR FLAG:** "Oven Parts Replacement" — "We carry common replacement parts — bulbs, door seals, and fan filters — and fit them as part of your clean visit." This describes fitting replacement parts during a clean visit. Per CLAUDE.md's Voice & CTA Rules ("Do not reference appliance repair as a current service — future ambition only"), this reads as repair-adjacent work being offered as a current service. Flag for review — bulbs/seals/filters replacement may be considered minor maintenance rather than "repair," but it sits close to the line CLAUDE.md draws.

### CTA Block (Domestic)

| Element | Copy | Location |
|---------|------|----------|
| Button | "Reserve Your Slot →" (links to `/reserve-step-1`) | ~L123 |
| Subtext | "Select your appliances and see your exact price — takes 2 minutes" | ~L124 |

> **PRICING FLAG:** "see your exact price" in the CTA subtext.

---

## Business & Commercial Section

| Element | Copy | Location |
|---------|------|----------|
| Eyebrow | "Commercial" | ~L134 |
| h2 | "For Your Business" | ~L135 |
| Intro | "We work with landlords, letting agents, HMOs, offices, care homes, and small commercial kitchens. Business bookings are handled directly — get in touch and we'll arrange everything around your schedule." | ~L136 |

### Commercial Cards

| Card name | Description | Location |
|-----------|--------------|----------|
| "Rental Properties & HMOs" | "Between-tenancy cleans for landlords and letting agents. Single properties or portfolios — we work around your void period. Multiple appliances cleaned in a single visit." | ~L141-142 |
| "Offices & Commercial Premises" | "Staff kitchen facilities, small commercial ovens, and catering equipment at office scale. Minimal disruption — we work around your team." | ~L146-147 |
| "Care Homes & Sheltered Housing" | "Domestic-scale appliances in care settings. We understand the sensitivity of working in these environments and treat every visit with care and discretion." | ~L151-152 |

### CTA Block (Commercial)

| Element | Copy | Location |
|---------|------|----------|
| Button | "Get in Touch →" (links to `/business-commercial`) | ~L158 |
| Subtext | "We'll call you back to discuss your requirements — no obligation" | ~L159 |

---

## Coming Soon Section

| Element | Copy | Location |
|---------|------|----------|
| Eyebrow | "Expanding" | ~L169 |
| h2 | "Coming Soon" | ~L170 |
| Intro | "We're expanding our services as the business grows. The following will be available soon — register your interest and we'll let you know when they launch." | ~L171 |

### Coming Soon Cards

| Badge | Card name | Description | Location |
|-------|-----------|--------------|----------|
| "Coming Soon" | "Deep Fat Fryer Cleaning" | "Full strip-down and dip-tank clean for commercial and domestic fryers." | ~L176-178 |
| "Coming Soon" | "Contract Commercial Kitchen Cleaning" | "Scheduled deep cleaning for restaurants, pubs, and catering operations." | ~L182-184 |

| Element | Copy | Location |
|---------|------|----------|
| Closing note | "Already need this? [Get in touch] — we may be able to help sooner than you think." (link to `/contact`) | ~L189 |

> **NOTE:** "Register your interest" copy (~L171) implies a registration mechanism (waitlist/email capture) that does not appear to exist anywhere on this page — no form, no link. Flag as a possible dead promise; no interest-registration UI found in this template.

---

## Trust Markers / Credentials / Guarantee Copy

None found on this page. No fixed-price guarantee block, no insurance/ICO/Companies House mentions, no badges — unlike the homepage and Step 1/3 funnel pages which carry guarantee copy. Flag as a possible gap if trust-building copy is expected here.

---

## Founder/Personal Identity Check

No name, photo, or biographical/employment detail found anywhere on this page. Fully compliant with CLAUDE.md's Privacy Requirement — Founder Identity section.

---

## Image Alt Text

No `<img>` elements present on this page — all visual treatment is CSS-driven (cards, badges). Nothing to extract.

---

## JS-Injected Copy

None. `functions.php` was searched for any `is_page('services')` (or `page-services`) hook and no matches were found — this page has no JS-injected copy.

---

*Placeholder phone/ICO/Companies House content is not referenced on this page — see `copy-audit-header-footer.md` for those (site-wide footer/header elements appear on every page including this one, but were already captured there and are not re-extracted here).*
