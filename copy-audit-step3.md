# Copy Audit — Funnel Step 3 (Calendar & Reservation)
Generated from `page-reserve-step3.php` in page order. JS-injected copy from `loc_step3_script()` in `functions.php` flagged separately.

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
| Step 2 num (complete) | "✓" | ~L41 |
| Step 2 label | "Your Area" | ~L42 |
| Step 3 num | "3" | ~L46 |
| Step 3 label | "Choose Your Date" | ~L47 |

> Note: page header section is empty on Step 3 (comment placeholder only, ~L52-53) — no eyebrow/h1/intro like Steps 1 & 2.

---

## Calendar Column

| Element | Copy | Location |
|---------|------|----------|
| Eyebrow | "Available Slots" | ~L61 |
| h2 | "Select a date" | ~L62 |
| Legend item | "Available" | ~L67 |
| Legend item | "Unavailable" | ~L71 |
| Cal nav | "← Prev" | ~L78 |
| Cal nav | "Next →" | ~L80 |
| Cal month label | (empty, JS-populated — e.g. "June 2026") | ~L79 |
| Table headers | "Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun" | ~L87 |

> **PLACEHOLDER FLAG:** Calendar availability is hardcoded — `unavailableDays = [1, 2, 8, 15, 16, 22, 29]` in the JS (no real booking API), per CLAUDE.md.

### Time Slot Picker (revealed on date select)

| Element | Copy | Location |
|---------|------|----------|
| Title | "Choose a time window for [date]" | ~L95 |
| Slot button | "Morning" / "8am – 1pm" | ~L97-100 |
| Slot button | "Afternoon" / "1pm – 6pm" | ~L101-104 |

### Date Escape Hatch

| Element | Copy | Location |
|---------|------|----------|
| Heading | "Need a specific date?" | ~L110 |
| Body | "If you need your oven cleaned by a particular date — or you can't see a slot that works for you — just let us know. We'll sort it over the phone." | ~L111 |
| Button | "Call Us" (links to `tel:+441234567890`) | ~L113 |
| Button | "Confirm On Call" | ~L114 |

> **PHONE PLACEHOLDER FLAG:** "Call Us" links to `tel:+441234567890` — this is a **different placeholder number** from the `tel:PLACEHOLDER` literal used in the header (per CLAUDE.md). Two inconsistent placeholder phone representations exist in the codebase; flag for reconciliation when the real number is set.

---

## Order Summary (right column / aside)

| Element | Copy | Location |
|---------|------|----------|
| Clear button | "Clear Date" (hidden until a date is picked) | ~L125 |
| Title | "Your Reservation" | ~L129 |
| Items — loading state | "Loading your selection…" | ~L131 |
| Total label | "Total" | ~L134 |
| Total amount (default) | "£0" | ~L135 |
| Location label | "Location" | ~L138 |
| Location value (default) | "—" (em dash) | ~L139 |
| Date row label | "Date" | ~L144 |
| Date value (default) | "—" (em dash) | ~L145 |
| Time row label | "Time" | ~L148 |
| Time value (default) | "—" (em dash) | ~L149 |
| Reserve button (inside slot panel, shown once date+time chosen) | "Reserve Your Slot →" | ~L154-156 |

| Element | Copy | Location |
|---------|------|----------|
| Price guarantee | "**Fixed price guaranteed.** The total shown is what you pay on the day — regardless of condition." | ~L160 |
| Reserve subtext | "No card taken now · We call to confirm · £25 deposit on the call" | ~L162 |

> **PRICING FLAG:** "Fixed price guaranteed" claim + "£25 deposit on the call" — the £25 deposit figure is a specific price point; confirm against CLAUDE.md's blanket "all pricing figures placeholder" note, since this reads as a more deliberate/recent figure (added in the m8 copy pass per Session Log) rather than a leftover dev placeholder — still flagging per instruction since it is a pricing figure.

---

## Confirmation Panel (replaces page body on submit)

| Element | Copy | Location |
|---------|------|----------|
| h2 | "Your slot is reserved." | ~L177 |
| Sub | "There's nothing more to do right now. We'll be in touch to confirm everything — no card has been taken." | ~L178 |
| Box label | "Date & Time" | ~L182 |
| Box label | "Your Total" | ~L186 |
| Box label | "Name" | ~L190 |
| Box label | "Callback Preference" | ~L194 |
| Callback message heading | "When we'll call" | ~L205 |
| Callback message (default, JS-overwritten) | "We'll be in touch during your preferred callback window." | ~L206 |
| Exit link | "← Back to Home" | ~L210 |

---

## Contact Details Modal

| Element | Copy | Location |
|---------|------|----------|
| Close button | "✕" | ~L219 |
| Header h2 | "Almost done — just a few details" | ~L222 |
| Header sub | "We'll use these to call and confirm your reservation. Nothing else." | ~L223 |
| Slot strip text | "Reserving: [slot summary]" | ~L232 |
| Field label | "First Name" | ~L239 |
| Field placeholder | "Sarah" | ~L240 |
| Field label | "Last Name" | ~L243 |
| Field placeholder | "Johnson" | ~L244 |
| Field label | "Phone Number" | ~L249 |
| Field placeholder | "07700 000000" | ~L250 |
| Field label | "Email Address" | ~L254 |
| Field placeholder | "sarah@example.com" | ~L255 |
| Callback label | "Preferred Callback Time" | ~L258 |
| Callback option | "Morning" / "8am – 12pm" | ~L260-263 |
| Callback option | "Afternoon" / "12pm – 5pm" | ~L264-267 |
| Callback option | "Evening" / "5pm – 8pm" | ~L268-271 |
| Privacy line | "Your details are used only to confirm this reservation. We'll never share them. [Privacy Policy]." (link to `/privacy-policy`) | ~L274 |
| Submit button | "Confirm My Reservation →" | ~L276 |

---

## Mobile Sticky Bottom Bar (Step 3)

| Element | Copy | Location |
|---------|------|----------|
| Slot status (default) | "Select a date above" | ~L284 |
| Total (default) | "£0" | ~L285 |
| Button | "Reserve Your Slot →" | ~L287-289 |

---

## JS-Injected Copy — `loc_step3_script()` in `functions.php` (~L881-1370)

| State / Trigger | Exact text | Location |
|------------------|-----------|----------|
| Summary — no selections found | "No selection found — [go back to Step 1]" (link text "go back to Step 1") | ~L913 |
| Summary total — skip route | "£TBC" | ~L926 |
| Summary location (default) | "—" (em dash) | ~L906 |
| Date escape — inactive/default | "Confirm On Call" | ~L1131 |
| Date escape — activated | "Undo — Select a Date Instead" | ~L1147 |
| Summary slot — TBC date state | "To be confirmed" (date & time both) | ~L1160-1161 |
| Summary slot — date only, time pending | "Choose a time above" | ~L1169 |
| Summary slot — empty state | "—" (em dash, date & time) | ~L1172-1173 |
| Modal slot summary — TBC | "Date to be confirmed on the call" | ~L1191 |
| Sticky bar — TBC date state | "Date to be confirmed on call" | ~L1240 |
| Sticky bar — empty state | "Select a date above" | ~L1248 |
| Sticky bar total — skip route | "TBC" | ~L1235 |
| Confirmed banner postcode fallback | "—" (em dash) | n/a (Step 2 only; see copy-audit-step2.md) |
| Submit validation — missing fields | "Please fill in all fields before confirming." | ~L1303 |
| Submit validation — invalid phone | "Please enter a valid UK phone number — for example 07700 000000 or 01234 567890." | ~L1311 |
| Submit validation — invalid email | "Please enter a valid email address — for example sarah@example.com." | ~L1318 |
| Submit validation — no callback selected | "Please select a preferred callback time." | ~L1323 |
| Confirmation — date (TBC) | "To be confirmed on the call" | ~L1332 |
| Confirmation — total (skip route) | "To be discussed on the call" | ~L1335 |
| Confirmation — total (normal) | "£[total] — Fixed Price" | ~L1336 |
| Smart callback message — weekend | "We'll call you first thing Monday morning to confirm your reservation." | ~L1276 |
| Smart callback message — morning, in-window | "We'll aim to call you this morning." | ~L1279 |
| Smart callback message — morning, Friday after 5pm | "We'll call you Monday morning — our first available morning slot." | ~L1280 |
| Smart callback message — morning, otherwise | "We'll aim to call you tomorrow morning." | ~L1281 |
| Smart callback message — afternoon, in-window | "We'll aim to call you this afternoon." | ~L1284 |
| Smart callback message — afternoon, otherwise | "We'll aim to call you tomorrow afternoon." | ~L1285 |
| Smart callback message — evening, in-window | "We'll aim to call you this evening." | ~L1288 |
| Smart callback message — evening, otherwise | "We'll aim to call you tomorrow evening." | ~L1289 |
| Smart callback message — fallback | "We'll call you during your preferred callback window." | ~L1291 |

> **SKIP/£TBC FLAG:** "£TBC" (summary + sticky bar), "No selection found" (summary empty state — flagged in CLAUDE.md's Known Bugs as needing to change to "To be discussed on the call" for consistency with the confirmation panel's own skip-route text), and "To be discussed on the call" (confirmation panel) are all live skip-route copy. Note the **inconsistency**: the live summary panel says "No selection found" while the confirmation panel (after submit) says "To be discussed on the call" for the same skip-route state — this is the open bug documented in CLAUDE.md.
> **ERROR STATE FLAG:** Four hardcoded `alert()` validation messages — missing fields, invalid phone, invalid email, no callback selected — all native browser alerts, not styled UI.
> **PHONE PLACEHOLDER FLAG:** Phone validation regex/example text references UK formats generically ("07700 000000 or 01234 567890") — these are example/placeholder format strings, not the business's real number.

---

*Modal copy fully captured above (Contact Details Modal). Confirmation panel captured separately as it replaces the page body rather than appearing inline.*
