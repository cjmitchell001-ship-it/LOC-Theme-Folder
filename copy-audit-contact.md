# Copy Audit — Contact Page
Generated from `page-contact.php` in page order. JS-injected copy: none found — `functions.php` was searched for any `is_page('contact')`, `loc_contact_script`, or enquiry-type selector JS and no matches were found. The enquiry type selector buttons (~L116–120) are pure HTML with no JS handler in `functions.php`; any JS handling them is either inline or absent.

---

## Page Header

| Element | Copy | Location |
|---------|------|----------|
| Eyebrow | "Get In Touch" | ~L15 |
| h1 | "We'd love to hear from you." (rendered as "We'd love to " + `<span>hear from you.</span>`) | ~L16 |
| Intro | "Not ready to reserve yet? Ask us anything — we'll get back to you within one working day." | ~L17 |

---

## Contact Details Column

| Element | Copy | Location |
|---------|------|----------|
| Eyebrow | "Contact details" | ~L28 |
| h2 | "How to reach us" | ~L29 |
| Intro | "We're a local Leicester business — you're always speaking directly with Chris, not a call centre or an automated system." | ~L30 |

> **FOUNDER IDENTITY FLAG:** Intro copy names "Chris" explicitly — "you're always speaking directly with Chris." Per CLAUDE.md's Privacy Requirement, the standard no-name rule applies to this page (the `page-business-commercial.php` exception does not extend here). Flag for decision: consistent with the Contact page's role as a direct-contact entry point, a first-name reference may be intentional and acceptable — but it is not currently a documented exception like the B&C page. Requires a call from the founder.

### Contact Method Cards

**Phone card (~L35–46)**

| Element | Copy | Location |
|---------|------|----------|
| Label | "Phone" | ~L42 |
| Value | "Number TBC — coming soon" (linked to `tel:+441234567890`) | ~L43 |
| Note | "Mon–Sat, 8am–6pm" | ~L44 |

> **PLACEHOLDER FLAG — phone number:** Label copy acknowledges the number isn't real: "Number TBC — coming soon." However, the `href` attribute is `tel:+441234567890` — a generic placeholder number that would dial if tapped on mobile. The display text is correct (it signals TBC), but the `href` should not be a dialable number before a real VoIP number is obtained. Flag as a technical placeholder risk, not just a copy issue.
>
> **OVERLAP NOTE — vs. Business & Commercial page (~L283):** B&C page states `[Number TBC]` with "Mon–Sat, 8am–6pm. Speak directly with Chris." The hours match. The B&C page names Chris; this page does not name Chris in the phone card (only in the intro ~L30).

**Email card (~L48–60)**

| Element | Copy | Location |
|---------|------|----------|
| Label | "Email" | ~L56 |
| Value | "hello@leicesterovencleaning.co.uk" (linked to `mailto:hello@leicesterovencleaning.co.uk`) | ~L57 |
| Note | "We aim to reply within one working day" | ~L58 |

> **NOTE:** Email address appears real and consistent (not flagged as placeholder in CLAUDE.md). The domain matches the business name. Flag for go-live: confirm this mailbox is active before launch.

**Service area card (~L62–74)**

| Element | Copy | Location |
|---------|------|----------|
| Label | "Service area" | ~L70 |
| Value | "Leicester & Leicestershire" | ~L71 |
| Note | "All LE postcodes — see Areas page for full coverage" | ~L72 |

> **NOTE — "All LE postcodes":** The same broad claim appears here and in the FAQ ("We cover all LE postcodes"). The Areas page lists specific LE districts — not every LE postcode is included (e.g. LE20 is absent). "All LE postcodes" is consistent as a shorthand but technically inaccurate vs. the explicit list. Flag for reconciliation across the three locations (Contact, FAQ, Areas page header which says "the surrounding Leicestershire area" — the most accurate of the three).

---

## Response Promise Block (~L79–86)

| Element | Copy | Location |
|---------|------|----------|
| Title | "Our response promise" | ~L80 |
| Item 1 | "Phone and email enquiries answered within one working day" | ~L82 |
| Item 2 | "Reservation callbacks made the same day where possible" | ~L83 |
| Item 3 | "No automated replies — you always hear from Chris directly" | ~L84 |

> **FOUNDER IDENTITY FLAG:** Item 3 names "Chris" — "you always hear from Chris directly." Same flag as the intro (~L30). Two instances of the founder's first name on this page.
>
> **OVERLAP NOTE — vs. Business & Commercial page:** B&C page "Direct contact — always" differentiator reads "You always deal with Chris directly. No call centres, no booking systems, no chasing a team." The Contact page response promise item 3 is the same claim, slightly different wording. Consistent in intent.

---

## Reserve Nudge Block (~L89–102)

| Element | Copy | Location |
|---------|------|----------|
| Title | "Ready to book instead?" | ~L98 |
| Sub | "Skip the form — reserve your slot in 2 minutes online. No card needed, we call to confirm." | ~L99 |
| Button | "Reserve Your Slot →" (links to `/reserve`) | ~L100 |

> **BROKEN LINK FLAG:** The Reserve Your Slot button links to `/reserve` — not `/reserve-step-1`. Per CLAUDE.md "Known Bugs / Open Items": "Reserve buttons point to `/reserve-step-1` (the earlier `/reserve` 404 bug is fixed)." This button was not updated when the other reserve URLs were fixed. A user clicking "Reserve Your Slot →" on the Contact page will hit a 404. Flag as a bug.

---

## Contact Form Column

### Form Box (~L109–128)

| Element | Copy | Location |
|---------|------|----------|
| Form box title | "Send us a message" | ~L110 |
| Form box sub | "Not ready to reserve yet? Ask us anything — we'll get back to you within one working day." | ~L111 |
| Enquiry type label | "What's your enquiry about?" | ~L114 |

> **NOTE — form box sub:** Duplicates the page header intro verbatim (~L17): "Not ready to reserve yet? Ask us anything — we'll get back to you within one working day." Exact repeat within the same page — internal duplication.

### Enquiry Type Selector Buttons (~L116–120)

| Button label | data-type value | Location |
|-------------|-----------------|----------|
| "Booking query" | "Booking query" | ~L116 |
| "Pricing question" | "Pricing question" | ~L117 |
| "Business / commercial" | "Business / commercial" | ~L118 |
| "Something else" | "Something else" | ~L119 |

> **NOTE — JS handling:** These buttons have `data-type` attributes suggesting they inject a value into the CF7 form on click. No corresponding JS handler was found in `functions.php`. The handler may be inline or missing — the enquiry type selector may be decorative/non-functional. Flag for technical verification.

### CF7 Form Reference

| Element | Copy | Location |
|---------|------|----------|
| CF7 shortcode | `[contact-form-7 id="1bfbd11" title="Contact Form"]` | ~L124 |
| Privacy note | "Your details are used only to respond to your enquiry. View our [Privacy Policy](/privacy-policy)." | ~L127 |

> **NOTE — CF7 form fields not captured here:** The Contact Form field labels and placeholder text are defined in the WordPress admin (Contact Form 7 editor), not in `page-contact.php` or `functions.php`. To audit form fields verbatim, open the CF7 form `1bfbd11` in WP Admin → Contact → Contact Form.

---

## Trust Markers / Credentials / Guarantee Copy

- "Our response promise" block (~L80–85) — a commitment to response times and direct contact. Not an insurance or credentials claim.
- No ICO, Companies House, or insurance reference on this page.
- No testimonials.

---

## Founder/Personal Identity Check

**Two instances of "Chris" by first name on this page:**

1. ~L30: "you're always speaking directly with Chris, not a call centre or an automated system."
2. ~L84: "you always hear from Chris directly."

Per CLAUDE.md's Privacy Requirement, the standard no-name rule applies to this page. The B&C page exception does not extend here. Both references are first-name only, no surname, no photo, no biographical detail. Flag for a decision (same question as the B&C page originally raised): is a first name alone acceptable on a contact/trust-building page, or does it need depersonalising?

---

## Image Alt Text

No `<img>` elements on this page — all icons are inline SVG (decorative, no `alt` or `title` attributes). Nothing to extract.

---

## JS-Injected Copy

None found in `functions.php`. The enquiry type selector buttons are HTML-only with `data-type` attributes — no JS handler found to extract. Flag for technical check (see above).

---

## Cross-Page Consistency Summary

| Topic | This page | Other pages | Flag |
|-------|-----------|-------------|------|
| Phone number | "Number TBC — coming soon" with `tel:+441234567890` href | B&C page: `[Number TBC]`; header.php: `tel:PLACEHOLDER` | Consistent as placeholder. **Bug: href is a dialable number** |
| Reserve button URL | Links to `/reserve` | All other reserve buttons link to `/reserve-step-1` | **Bug: 404 link** |
| Email address | `hello@leicesterovencleaning.co.uk` | Not referenced on other audited pages | Not confirmed active — flag for go-live |
| Response time promise | "within one working day" (×2 on this page) | B&C page: "within one working day" | Consistent |
| "Chris" named directly | 2 instances | B&C page: 3 instances (documented exception); How We Work, Services, Areas: none | Not a documented exception on this page |
| "All LE postcodes" | Service area card note | FAQ: "We cover all LE postcodes"; Areas page: specific district list | Wording imprecise vs. actual coverage list |

*Placeholder phone/ICO/Companies House content: phone placeholder noted above. ICO and Companies House are not referenced on this page — see `copy-audit-header-footer.md` for those.*
