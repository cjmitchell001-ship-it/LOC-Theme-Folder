# Copy Audit — Funnel Step 1 (Appliance Selection)
Generated from `page-reserve-step1.php` in page order. JS-injected copy from `loc_step1_script()` in `functions.php` flagged separately.

---

## Funnel Header

| Element | Copy | Location |
|---------|------|----------|
| Logo top | "Leicester" | `page-reserve-step1.php` ~L25 |
| Logo bottom | "Oven Cleaning" | `page-reserve-step1.php` ~L26 |
| Exit link | "← Back to Home" | `page-reserve-step1.php` ~L30 |

---

## Funnel Progress Bar

| Element | Copy | Location |
|---------|------|----------|
| Step 1 num | "1" | ~L40 |
| Step 1 label | "Select Appliances" | ~L41 |
| Step 2 num | "2" | ~L45 |
| Step 2 label | "Your Area" | ~L46 |
| Step 3 num | "3" | ~L50 |
| Step 3 label | "Choose Your Date" | ~L51 |

---

## Page Header

| Element | Copy | Location |
|---------|------|----------|
| Eyebrow | "Step 1 of 3" | ~L60 |
| h1 | "What would you like cleaned?" | ~L61 |
| Intro | "Select your oven and any extras below. Prices are fixed — what you see is what you pay, regardless of condition." | ~L62 |

> **PRICING FLAG:** "Prices are fixed — what you see is what you pay" is a pricing/guarantee claim. All pricing figures are placeholder per CLAUDE.md.

---

## Appliance Selection — Heading

| Element | Copy | Location |
|---------|------|----------|
| h2 | "Choose your appliances" | ~L72 |

---

## Ovens Group

| Element | Copy | Location |
|---------|------|----------|
| Group label | "Ovens" | ~L76 |
| Card name | "Single Oven" | ~L92 |
| Card price | "£55" | ~L93 |
| Card name | "Double Oven" | ~L112 |
| Card price | "£70" | ~L113 |
| Card name | "Range Cooker 90cm" | ~L132 |
| Card price | "£100" | ~L133 |
| Card name | "Range Cooker 100cm+" | ~L153 |
| Card price | "£120" | ~L154 |
| Card name | "AGA / Large Range" | ~L171 |
| Card price (idle state) | "Select type ↓" | ~L172 |
| Card note (idle state) | "Tap to choose" | ~L173 |

> **PRICING FLAG:** All appliance prices (£55, £70, £100, £120) are placeholder figures per CLAUDE.md ("All pricing figures: Placeholder throughout the funnel").

### AGA Sub-Options (revealed on click)

| Element | Copy | Location |
|---------|------|----------|
| Options label | "Which type of AGA?" | ~L178 |
| Option | "2 Door" / "£170" | ~L179-182 |
| Option | "3 Door" / "£190" | ~L183-186 |
| Option | "With Companion" / "£230" | ~L187-190 |
| Option | "With Module" / "£260" | ~L191-194 |
| Cancel button | "Cancel" | ~L195 |

> **PRICING FLAG:** AGA variant prices (£170/£190/£230/£260) are placeholder.

---

## Extras Group

| Element | Copy | Location |
|---------|------|----------|
| Group label | "Add Extras" | ~L204 |
| Card name | "Gas Hob" | ~L220 |
| Card price | "£22" | ~L221 |
| Card name | "Ceramic / Induction Hob" | ~L233 |
| Card price | "£18" | ~L234 |
| Card name | "Extractor Hood" | ~L249 |
| Card price | "£22" | ~L250 |
| Card name | "Microwave" | ~L264 |
| Card price | "£18" | ~L265 |

> **PRICING FLAG:** Extras prices (£22, £18, £22, £18) are placeholder.

---

## Skip Panel

| Element | Copy | Location |
|---------|------|----------|
| Heading | "Not sure what you have, or would you rather talk it through?" | ~L283 |
| Body | "If you'd prefer to discuss your appliances over the phone, just click below. We'll go through everything together when we call to confirm your booking." | ~L284 |
| Button (default state) | "Discuss on the Call Instead" | ~L286-288 |

> **SKIP-ROUTE FLAG:** This is the entry point to the £TBC skip route — see JS-injected copy below for the active/toggled state text.

---

## In-Flow Totals Panel (601px+)

| Element | Copy | Location |
|---------|------|----------|
| Label | "Your total" | ~L297 |
| Amount (default, JS-driven) | "£0" | ~L298 |
| Button | "Choose Your Area" | ~L300-302 |

---

## Price Guarantee (Sidebar)

| Element | Copy | Location |
|---------|------|----------|
| Body | "**Fixed price guaranteed.** The total shown is the price you pay — no matter the condition of your appliances when we arrive. Confirmed before we start." | ~L311 |

> **PRICING FLAG:** Repeats the fixed-price guarantee claim; pricing itself is placeholder.

---

## Sticky Bottom Bar (mobile/all breakpoints)

| Element | Copy | Location |
|---------|------|----------|
| Label | "Your total" | ~L321 |
| Amount (default, JS-driven) | "£0" | ~L322 |
| Button | "Choose Your Area →" | ~L324-326 |

---

## Scroll Indicator

No copy — icon-only (chevron-down SVG), `aria-hidden="true"`. ~L330-334

---

## JS-Injected Copy — `loc_step1_script()` in `functions.php` (~L193-481)

| State / Trigger | Exact text | Location |
|------------------|-----------|----------|
| AGA — idle price label | "Select type ↓" (`'Select type ↓'`) | ~L271, L280, L307 |
| AGA — idle note | "Tap to choose" | ~L272, L281, L308 |
| Skip button — activated | "Undo — Select Appliances Instead" (`'Undo — Select Appliances Instead'`) | ~L291 |
| Skip button — inactive/default | "Discuss on the Call Instead" | ~L329, L348 |
| Sticky total — skip-active state | "£TBC" (`'<span>£</span>TBC'`) | ~L317-318 |
| Sticky total — default/reset state | "£0" | ~L360-361 |

> **SKIP/£TBC FLAG:** All three instances above (£TBC display, skip-button toggle text) are the live mechanics of the skip route documented in CLAUDE.md's Funnel session-storage table (`loc_skip`).
> **PLACEHOLDER FLAG (non-copy, structural):** None of the JS strings in this script reference `tel:PLACEHOLDER` directly — that lives in the header/footer (see `copy-audit-header-footer.md`).

---

*No modal copy on Step 1 (modal exists only on Step 3). No hardcoded error/validation messages found in Step 1 template or script.*
