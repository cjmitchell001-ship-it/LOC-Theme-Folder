# Copy Audit — Funnel Step 2 (Postcode / Area)
Generated from `page-reserve-step2.php` in page order. JS-injected copy from `loc_step2_script()` in `functions.php` flagged separately.

---

## Funnel Header

| Element | Copy | Location |
|---------|------|----------|
| Logo top | "Leicester" | ~L23 |
| Logo bottom | "Oven Cleaning" | ~L24 |
| Exit link | "← Back to Home" | ~L28 |

---

## Funnel Progress Bar

| Element | Copy | Location |
|---------|------|----------|
| Step 1 num (complete) | "✓" | ~L36 |
| Step 1 label | "Select Appliances" | ~L37 |
| Step 2 num | "2" | ~L41 |
| Step 2 label | "Your Area" | ~L42 |
| Step 3 num | "3" | ~L46 |
| Step 3 label | "Choose Your Date" | ~L47 |

---

## Page Header

| Element | Copy | Location |
|---------|------|----------|
| Eyebrow | "Step 2 of 3" | ~L54 |
| h1 | "Help us find your best available dates" | ~L55 |
| Intro | "We organise our schedule by area — enter your postcode or pick your area below and we'll show you the dates that work best for your location." | ~L56 |

---

## Sticky Postcode Bar

| Element | Copy | Location |
|---------|------|----------|
| Input placeholder | "Enter your postcode" | ~L66 |
| Button | "Confirm Postcode →" | ~L70-72 |
| Error message container | (empty by default, JS-populated — see below) | ~L75 |

---

## Areas Section

| Element | Copy | Location |
|---------|------|----------|
| Intro | "Pick your area from the list below — or type your postcode directly into the bar above. Can't see your area? Just type your postcode and we'll work it out." | ~L86 |

### Area Groups & Tags

| Group heading | Areas (name + postcode tag) | Location |
|---------------|------------------------------|----------|
| "City & Inner" | Leicester City (LE1), Stoneygate (LE2), Clarendon Park (LE2), Oadby (LE2), Knighton (LE2), Glenfield (LE3), Braunstone (LE3), Birstall (LE4), Thurmaston (LE4), Hamilton (LE5), Humberstone (LE5), Wigston (LE18), Narborough (LE19) | ~L91-106 |
| "North & West" | Groby (LE6), Anstey (LE7), Syston (LE7), Scraptoft (LE7), Queniborough (LE7), Kirby Muxloe (LE9), Earl Shilton (LE9), Hinckley (LE10), Loughborough (LE11), Shepshed (LE12), Mountsorrel (LE12), Sileby (LE12) | ~L110-124 |
| "South" | Blaby (LE8), Countesthorpe (LE8), Fleckney (LE8), Lutterworth (LE17), Mkt Harborough (LE16) | ~L128-135 |
| "Outer" | Melton Mowbray (LE13), Melton Rural (LE14), Oakham (LE15), Rutland (LE15) | ~L139-145 |

| Element | Copy | Location |
|---------|------|----------|
| Areas note | "Not on the list? Just type your postcode above — we may still be able to help depending on location and current schedule." | ~L150 |

---

## Inline Appliance Selection (shown only on direct-land route after postcode confirmed)

| Element | Copy | Location |
|---------|------|----------|
| Eyebrow | "One more step" | ~L158 |
| h2 | "What would you like cleaned?" | ~L159 |
| Intro | "You came straight to this page — no problem. Select your appliances below and we'll get you to the calendar." | ~L160 |

### Ovens (inline)

| Element | Copy | Location |
|---------|------|----------|
| Group label | "Ovens" | ~L164 |
| Card name | "Single Oven" / "£55" | ~L179-180 |
| Card name | "Double Oven" / "£70" | ~L197-198 |
| Card name | "Range 90cm" / "£100" | ~L210-211 |
| Card name | "Range 100cm+" / "£120" | ~L223-224 |
| Card name | "AGA / Large Range" | ~L238 |
| Card price (idle) | "Select type ↓" | ~L239 |
| Card note (idle) | "Tap to choose" | ~L240 |

> **NOTE:** Inline card names "Range 90cm" / "Range 100cm+" are abbreviated versions of Step 1's "Range Cooker 90cm" / "Range Cooker 100cm+" (`data-name` attributes still use the full names — only the visible `<p>` label differs). Flag for consistency review.

> **PRICING FLAG:** All prices here duplicate Step 1's placeholder figures (£55/£70/£100/£120, AGA variants £170/£190/£230/£260 below).

#### AGA Sub-Options (inline)

| Element | Copy | Location |
|---------|------|----------|
| Options label | "Which type?" | ~L243 |
| Option | "2 Door" / "£170" | ~L244 |
| Option | "3 Door" / "£190" | ~L245 |
| Option | "With Companion" / "£230" | ~L246 |
| Option | "With Module" / "£260" | ~L247 |
| Cancel button | "Cancel" | ~L248 |

### Extras (inline)

| Element | Copy | Location |
|---------|------|----------|
| Group label | "Extras — add to any booking" | ~L257 |
| Card name | "Gas Hob" / "£22" | ~L270-271 |
| Card name | "Ceramic / Induction" / "£18" | ~L280-281 |
| Card name | "Extractor Hood" / "£22" | ~L290-291 |
| Card name | "Microwave" / "£18" | ~L301-302 |

> **NOTE:** Inline card "Ceramic / Induction" drops "Hob" from the visible name vs Step 1's "Ceramic / Induction Hob". Flag for consistency review.
> **PRICING FLAG:** Same placeholder prices duplicated from Step 1.

### Skip Panel (inline)

| Element | Copy | Location |
|---------|------|----------|
| Heading | "Not sure what you have, or would you rather talk it through?" | ~L312 |
| Body | "If you'd prefer to discuss your appliances over the phone, just click below. We'll go through everything together when we call to confirm your booking." | ~L313 |
| Button (default) | "Discuss on the Call Instead" | ~L315-317 |

### Inline Summary

| Element | Copy | Location |
|---------|------|----------|
| Title | "Your Selection" | ~L324 |
| Total (default, JS-driven) | "£0" | ~L325 |
| Empty state | "No appliances selected yet" | ~L328 |
| Location label | "Location" | ~L331 |
| Location value (default) | "—" (em dash) | ~L332 |
| Button | "Choose Your Date →" | ~L334-336 |
| Subtext | "Fixed price · No card needed · We call to confirm" | ~L337 |

> **PRICING FLAG:** "Fixed price" subtext references pricing while all figures remain placeholder.

---

## Continue Bar (shown when arriving from Step 1, postcode confirmed)

| Element | Copy | Location |
|---------|------|----------|
| Confirmed banner text (default placeholder, JS-overwritten on confirm) | "Postcode saved — showing you the best available dates." | ~L350 |
| Total label | "Your total" | ~L356 |
| Total amount (default, JS-driven) | "£0" | ~L357 |
| Button | "Choose Your Date →" | ~L359-361 |
| Location label | "Location" | ~L364 |
| Location value (default) | "—" (em dash) | ~L365 |

---

## Mobile Sticky Bottom Bar (Step 2 inline selection)

| Element | Copy | Location |
|---------|------|----------|
| Label | "Your total" | ~L375 |
| Amount (default, JS-driven) | "£0" | ~L376 |
| Button | "Choose Your Date →" | ~L378-380 |
| Location label | "Location" | ~L383 |
| Location value (default) | "—" (em dash) | ~L384 |

---

## JS-Injected Copy — `loc_step2_script()` in `functions.php` (~L486-876)

| State / Trigger | Exact text | Location |
|------------------|-----------|----------|
| Postcode confirmed banner (area tag click or confirm) | `postcode + ' saved — we'll show you the best available dates for your area.'` (e.g. "LE2 saved — we'll show you the best available dates for your area.") | ~L541, L589 |
| Postcode validation error | "Please enter a valid UK postcode (e.g. LE2 7AB)." | ~L573 |
| AGA — idle price (inline) | "Select type ↓" | ~L677, L714, L747 |
| AGA — idle note (inline) | "Tap to choose" | ~L678, L715, L748 |
| Step 2 skip button — inactive/default | "Discuss on the Call Instead" | ~L690, L760 |
| Step 2 skip button — activated | "Undo — Select Appliances Instead" | ~L697 |
| Skip-active summary item name | "To be discussed on the call" | ~L723 |
| Skip-active summary item price | "TBC" | ~L723 |
| Skip-active total | "£TBC" (`'<span>£</span>TBC'`) | ~L724, L736 |
| Default/reset total | "£0" | ~L777, L780 |
| Default/reset summary empty state | "No appliances selected yet" | ~L776 |

> **ERROR STATE FLAG:** "Please enter a valid UK postcode (e.g. LE2 7AB)." is the only hardcoded validation message in Step 2.
> **SKIP/£TBC FLAG:** "To be discussed on the call" / "£TBC" / skip-button toggle text are the live mechanics of the skip route (see CLAUDE.md `loc_skip` session-storage key and the open bug noting Step 3's skip-route text still says "No selection found" instead of this same "discussed on the call" phrasing — inconsistency between Step 2 and Step 3 skip messaging).

---

*No modal copy on Step 2. No reassurance/subtext lines beyond those captured above.*
