# Copy Audit — Business & Commercial Page
Generated from `page-business-commercial.php` in page order. JS-injected copy: none found — `functions.php` was searched for any `is_page('business')`, `is_page('business-commercial')`, or equivalent hook and no matches were found.

---

## Page Header

| Element | Copy | Location |
|---------|------|----------|
| Eyebrow | "Business & Commercial" | ~L15 |
| h1 | "Oven cleaning for businesses that mean it." (rendered as "Oven cleaning for " + `<span>businesses that mean it.</span>`) | ~L16 |
| Intro | "Landlords, letting agents, HMOs, offices, and small commercial kitchens — we work around your schedule, not the other way around." | ~L17 |
| CTA button 1 | "Get in Touch" (links to `#biz-contact`) | ~L19 |
| CTA button 2 | "Request a Callback" (links to `#biz-contact`) | ~L20 |

> **NOTE — CTA 2 mismatch:** "Request a Callback" links to `#biz-contact` (the form section anchor), not to a dedicated callback scheduler. In the same page's contact section (Option 3, ~L292), copy acknowledges a callback scheduler is "coming soon." The header CTA implies it's already available; the contact section copy reveals it isn't. Flag for reconciliation.

> **FOUNDER IDENTITY FLAG:** ~L130 and ~L172 (see "What's Different" section below) name "Chris" explicitly. This page is public-facing. Per CLAUDE.md's Privacy Requirement — "Do not add a name, face, or biographical detail to any page." Flag for review: this page uses the founder's first name twice.

---

## Who We Work With Section

| Element | Copy | Location |
|---------|------|----------|
| Eyebrow | "Who we work with" | ~L28 |
| h2 | "Built for businesses of all sizes" | ~L29 |
| Subtitle | "From a single rental property to a portfolio of HMOs — if you need ovens cleaned professionally, we can help." | ~L30 |

### Cards

| Card title | Body text | Location |
|-----------|-----------|----------|
| "Landlords" | "End of tenancy cleans, routine maintenance, and between-let deep cleans. We work to your schedule and around tenant access." | ~L38–39 |
| "Letting Agents" | "Managing multiple properties means coordinating multiple cleans. We're reliable, consistent, and easy to work with across a portfolio." | ~L46–47 |
| "HMO Properties" | "Multiple ovens at a single property cleaned in one visit. Shared travel and setup costs reflected in how we quote — not a simple per-oven rate." | ~L54–55 |
| "Office & Staff Kitchens" | "Staff kitchen ovens and appliances cleaned professionally. We work outside of business hours where needed to avoid disruption." | ~L62–63 |
| "Small Cafés & Businesses" | "Small cafés and businesses using domestic-scale ovens. Professional results without the disruption of industrial cleaning contractors." | ~L70–71 |
| "Holiday Lets & Airbnb" | "Fast turnaround cleans between guests. Reliable scheduling and consistent results — every time a guest checks in, the oven is spotless." | ~L78–79 |

> **OVERLAP NOTE — vs. Services page Commercial section (`copy-audit-services.md`):** The Services page Commercial section lists three offering types: "Rental Properties & HMOs", "Offices & Commercial Premises", and "Care Homes & Sheltered Housing". This page's "Who we work with" grid lists six: Landlords, Letting Agents, HMO Properties, Office & Staff Kitchens, Small Cafés & Businesses, and Holiday Lets & Airbnb. Notable gaps/differences:
> - **"Care Homes & Sheltered Housing"** appears on the Services page but is absent from this page's grid cards (though it does appear in the in-scope list further down, ~L206).
> - **"Small Cafés & Businesses"** and **"Holiday Lets & Airbnb"** appear here but not on the Services page.
> - The Services page card description for "Offices & Commercial Premises" mentions "small commercial ovens, and catering equipment at office scale." This page's "Office & Staff Kitchens" card mentions "Staff kitchen ovens and appliances" only — no catering equipment reference.
> - Flag: the two pages do not present a consistent picture of who the commercial offering covers.

---

## How Commercial Bookings Work Section

| Element | Copy | Location |
|---------|------|----------|
| Eyebrow | "The process" | ~L89 |
| h2 | "How commercial bookings work" | ~L90 |
| Subtitle | "Business bookings work differently from domestic — no automated funnel, just a straightforward conversation." | ~L91 |

### Process Steps

| Step | Title | Body text | Location |
|------|-------|-----------|----------|
| 1 | "Get in touch" | "Fill in the enquiry form, call us directly, or request a callback. Tell us about your property and what you need." | ~L97–98 |
| 2 | "We discuss and quote" | "We'll go through the details, confirm whether we can help, and put together a fair quote — especially for multi-oven properties." | ~L103–104 |
| 3 | "We agree a schedule" | "We book in around your schedule — tenant access, business hours, or out-of-hours if needed. Deposit and payment terms are agreed in writing before the job is confirmed." | ~L109–110 |
| 4 | "Job done" | "We turn up, do the job to the same standard as every domestic clean, and invoice you directly. Simple." | ~L115–116 |

---

## What Makes Us Different Section

| Element | Copy | Location |
|---------|------|----------|
| Eyebrow | "Why choose us" | ~L128 |
| h2 | "What makes us different for business customers" | ~L129 |
| Body para 1 | "We're not a franchise with a call centre. When you deal with Leicester Oven Cleaning, you deal with Chris — the person who turns up and does the job. No layers, no miscommunication, no surprises." | ~L130 |
| Body para 2 | "For business customers, that means flexible scheduling, honest pricing, and a direct line to the person responsible for the work." | ~L131 |

> **FOUNDER IDENTITY FLAG:** Body para 1 names "Chris" directly — "you deal with Chris — the person who turns up and does the job." Per CLAUDE.md's Privacy Requirement, the founder's name should not appear on public-facing pages. This is a first-name reference only (no surname, no photo, no employment history), but it is an explicit name. Flag for decision: is a first name alone acceptable here, or does this need to be depersonalised (e.g. "you deal with one person")?

### Differentiator List Items

| Label (bold) | Body text | Location |
|-------------|-----------|----------|
| "Flexible scheduling" | "We work around tenant access, business hours, or out-of-hours where possible. You tell us what works." | ~L139–140 |
| "Fair multi-oven pricing" | "Multiple appliances in one visit means shared travel and setup costs — that efficiency is reflected in what you pay." | ~L147–148 |
| "Transparent commercial pricing" | "Deposit amounts and payment terms for business bookings are agreed individually and confirmed in writing — reflecting the scale of the job fairly." | ~L155–156 |
| "Fully insured including items worked upon" | "Treatment risk insurance covers the appliances being cleaned — not just standard public liability." | ~L163–164 |
| "Direct contact — always" | "You always deal with Chris directly. No call centres, no booking systems, no chasing a team." | ~L171–172 |

> **FOUNDER IDENTITY FLAG:** "Direct contact — always" item names "Chris" again — "You always deal with Chris directly." Same flag as above.

> **PRICING FLAG:** "Fair multi-oven pricing" and "Transparent commercial pricing" items reference pricing approach — no specific figures quoted (correctly handled as a process description rather than stated prices). No literal price figures on this page.

---

## In Scope & Out of Scope Section

| Element | Copy | Location |
|---------|------|----------|
| Eyebrow | "What we clean" | ~L184 |
| h2 | "In scope & out of scope" | ~L185 |
| Subtitle | "We're clear about what we do and what we don't — no wasted conversations." | ~L186 |
| In-scope column title | "What we clean" | ~L192 |
| Out-of-scope column title | "What we don't cover" | ~L219 |

### In-Scope List (`$in_scope` PHP array, ~L196–207)

| Item | Location |
|------|----------|
| "All domestic single and double ovens" | ~L196 |
| "Range cookers and AGA" | ~L197 |
| "Gas, ceramic, and induction hobs" | ~L198 |
| "Extractor hoods" | ~L199 |
| "Microwaves" | ~L200 |
| "HMOs and multi-unit rental properties" | ~L201 |
| "Small commercial kitchens with domestic-scale appliances" | ~L202 |
| "Landlord and letting agent end-of-tenancy cleans" | ~L203 |
| "Holiday lets and Airbnb properties" | ~L204 |
| "Office and staff kitchen appliances" | ~L205 |
| "Care homes and supported living properties" | ~L206 |

### Out-of-Scope List (`$out_scope` PHP array, ~L222–226)

| Title (bold) | Description | Location |
|-------------|-------------|----------|
| "Industrial & catering equipment" | "Large-scale commercial ovens in hotel kitchens, restaurants, schools, and hospitals require specialist equipment and certification beyond our current offering." | ~L223 |
| "Commercial extraction & ventilation systems" | "Commercial kitchen canopy and ducting systems — a specialist field with its own certification requirements." | ~L224 |
| "Appliance repair & fault diagnosis" | "We clean appliances — we do not currently offer repair or electrical fault diagnosis as a formal service." | ~L225 |

> **REPAIR REFERENCE NOTE:** "Appliance repair & fault diagnosis" out-of-scope item is correctly framed as something we do NOT currently offer. This is consistent with CLAUDE.md's Voice & CTA Rules ("Do not reference appliance repair as a current service — future ambition only"). The wording "we do not currently offer... as a formal service" is a clean boundary statement. No flag raised — this is appropriate handling. Note the qualifier "as a formal service" leaves slight ambiguity (implies it might still happen informally); flag if that's a concern.

### HMO Note Block (~L250–253)

| Element | Copy | Location |
|---------|------|----------|
| Note title | "HMOs and multi-oven properties" | ~L250 |
| Para 1 | "If you have multiple ovens at a single property — such as an HMO with shared kitchens — pricing is not a simple multiple of the standard rate. When several appliances are cleaned in a single visit, travel and setup costs are shared across the job, and that efficiency is reflected in how we quote." | ~L251 |
| Para 2 | "We don't publish a fixed multi-oven rate because every situation is different." + bold inline: **"Get in touch with the details of your property and we'll put together a fair quote."** | ~L252 |

> **PRICING FLAG:** HMO note references pricing model — no specific figures, framed correctly as "we don't publish a fixed rate." Consistent with the differentiator list.

> **OVERLAP NOTE — vs. Services page:** The Services page Commercial section does not mention HMO pricing nuance at all. This page dedicates a dedicated callout block to it. The Services page "Rental Properties & HMOs" card says only "we work around your void period. Multiple appliances cleaned in a single visit" — no pricing context. Not an inconsistency per se, but the Services page leaves the HMO pricing question unanswered for a user who lands there.

---

## Contact & Enquiry Form Section

| Element | Copy | Location |
|---------|------|----------|
| Eyebrow | "Get in touch" | ~L265 |
| h2 | "Tell us about your property" | ~L266 |
| Intro | "Business bookings are arranged directly — just tell us what you need and we'll take it from there. No automated system, no waiting." | ~L267 |

### Contact Options

| Option | Title | Body text | Location |
|--------|-------|-----------|----------|
| 1 | "Fill in the enquiry form" | "Tell us about your property and requirement — we'll respond within one working day." | ~L273–274 |
| 2 | "Call us directly" | "**[Number TBC]** — Mon–Sat, 8am–6pm. Speak directly with Chris." | ~L283 |
| 3 | "Request a callback" | "Pick a time slot and we'll call you. Callback scheduler coming soon — powered by our booking system." | ~L291–292 |
| — | Callback placeholder UI | "Callback scheduler — active once booking system is configured" | ~L295 |

> **PLACEHOLDER FLAG — phone number:** Option 2 shows `[Number TBC]` — explicit placeholder for a phone number not yet obtained. Per CLAUDE.md: "VoIP not yet obtained. Update when real." Also names "Chris" — same founder identity flag as above.

> **FOUNDER IDENTITY FLAG:** Option 2 copy — "Speak directly with Chris." Third instance of the founder's first name on this page.

> **PLACEHOLDER FLAG — callback scheduler:** Option 3 and the placeholder UI both acknowledge the callback feature does not yet exist ("coming soon", "active once booking system is configured"). This is transparent about the gap, but the header "Request a Callback" CTA button (which links to `#biz-contact`, i.e. this section) gives no indication the feature isn't live. A user clicking "Request a Callback" in the header and scrolling to this section finds it's not available yet.

### Form Box

| Element | Copy | Location |
|---------|------|----------|
| Form box title | "Business Enquiry" | ~L305 |
| Form box sub | "Tell us about your property and what you need — we'll get back to you within one working day." | ~L306 |
| Form | CF7 shortcode `[contact-form-7 id="c4c07d2" title="Business Enquiry"]` — field labels/placeholders are defined in the CF7 admin, not in this template | ~L308 |
| Privacy note | "Your details are used only to respond to your enquiry. View our [Privacy Policy](/privacy-policy)." | ~L310 |

> **NOTE — CF7 form fields not captured here:** The Business Enquiry CF7 form field labels and placeholder text are defined in the WordPress admin (Contact Form 7 editor), not in `page-business-commercial.php` or `functions.php`. They cannot be extracted from the theme files. To audit the form fields verbatim, open the CF7 form `c4c07d2` in WP Admin → Contact → Business Enquiry.

---

## Trust Markers / Credentials / Guarantee Copy

- **"Fully insured including items worked upon"** — appears in the differentiator list (~L163). Specific and accurate: distinguishes treatment risk insurance from standard public liability. Consistent with About page credentials.
- No ICO registration reference on this page.
- No Companies House reference on this page.
- No fixed-price guarantee copy on this page (appropriate — commercial pricing is handled as bespoke/agreed individually).
- No testimonials on this page.

---

## Founder/Personal Identity Check

**Three instances of "Chris" by first name on this page** — all in the "What's Different" section and contact options:

1. ~L130: "you deal with Chris — the person who turns up and does the job."
2. ~L172: "You always deal with Chris directly."
3. ~L283: "Speak directly with Chris."

Per CLAUDE.md's Privacy Requirement: "Do not add a name, face, or biographical detail to any page." This is a first-name-only reference with no surname, photo, or employment history attached. Flag for a decision: the privacy requirement as written covers "name" generally, but the intent ("staying anonymous from some people while the business is pre-launch") may or may not extend to a first name alone. The About page explicitly removes the name; this page uses it three times. Requires a call from the founder.

---

## Image Alt Text

No `<img>` elements present on this page — all icons are inline SVG (decorative, no `alt` or `title` attributes). Nothing to extract.

---

## JS-Injected Copy

None. `functions.php` was searched for any `is_page('business')`, `is_page('business-commercial')`, or pattern matching this template and no matches were found — this page has no JS-injected copy.

---

## Overlap / Consistency Summary vs. Services Page (`copy-audit-services.md`)

| Topic | Services page | Business & Commercial page | Flag |
|-------|--------------|---------------------------|------|
| Commercial offering description | Three card types: Rental/HMOs, Offices & Commercial, Care Homes & Sheltered Housing | Six card types: Landlords, Letting Agents, HMOs, Office & Staff Kitchens, Small Cafés & Businesses, Holiday Lets & Airbnb | Mismatch — different sets, neither is a superset of the other |
| Care homes | "Care Homes & Sheltered Housing" card present | Not in grid cards; present only in in-scope list | Gap in the grid presentation |
| Small Cafés, Holiday Lets | Not on Services page | Present on this page | Services page omits these customer types |
| HMO pricing nuance | Not mentioned | Dedicated callout block | Services page leaves the question open |
| CTA for commercial enquiries | "Get in Touch →" linking to `/business-commercial` | Direct form on-page | Consistent intent, different mechanism |
| Services page commercial intro | "Business bookings are handled directly — get in touch and we'll arrange everything around your schedule." | — | Not duplicated verbatim on this page — intro here is different wording, same message |

*Placeholder phone/ICO/Companies House content: phone placeholder `[Number TBC]` appears on this page (~L283). ICO and Companies House are not referenced here — see `copy-audit-header-footer.md` for those (site-wide footer elements appear on every page including this one, but were already captured there).*
