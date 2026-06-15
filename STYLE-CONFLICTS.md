# STYLE-CONFLICTS.md — CSS Audit Report

> Read-only findings. No changes made. Run against committed HEAD after Phase 3b tokenisation.
> One critical rendering bug discovered in the process — see Section 4, item 1 (undefined tokens).

---

## 6. SCORECARD (summary first)

| Issue | Count | Severity |
|---|---|---|
| Total `!important` declarations | 26 | Medium |
| Selectors with 2+ `!important` | 6 | Medium |
| Hardcoded hex inside `!important` | 1 (line 7858: `#152d58`) | Low |
| `ox-shadow` typo (missing `b`, shadow never fires) | ~10 occurrences | Medium |
| **Undefined CSS tokens in use** (`--space-18`, `--space-25`) | **~8 uses** | **CRITICAL — zero padding bug** |
| Duplicate selectors (same selector, separate blocks, outside @media) | 28 | High |
| Genuine same-property value conflicts (later wins silently) | 1 | Low |
| Root cause of most duplicates | ~220-line Step 2 block copied verbatim | High |
| Distinct `@media` breakpoint values | 10 | Medium |
| Total `@media` blocks | 52 | Medium |
| Max blocks at one breakpoint | 21 at `(max-width: 768px)` | Medium |
| Breakpoint cluster inconsistency (768 vs 780 for same concept) | Yes | Medium |
| `(min-width: 768px)` / `(max-width: 768px)` boundary collision | Yes | Low |
| Section vertical spacing inconsistencies (peer sections differ) | 4 distinct spacing values in use | Medium |
| Private eyebrow-pattern selectors (vs 1 global `.section-eyebrow`) | ~26 | Low |
| Duplicated sticky-bottom-bar components | 3 near-identical implementations | Medium |
| Duplicated guarantee-box pattern | ~5 instances | Low |

---

## 1. `!important` AUDIT

**Total count: 26**

| Line | Selector | Property | Category |
|---|---|---|---|
| 5319 | `.loc-funnel-page .site-content, #page, .content-area` | `padding: 0` | override-thirdparty |
| 5319 | `.loc-funnel-page .site-content, #page, .content-area` | `margin: 0` | override-thirdparty |
| 5611 | `.loc-appliance-card--aga.is-expanded` | `transform: none` | specificity-war |
| 5818 | `.loc-step1-skip-btn` | `background: var(--gold)` | override-thirdparty |
| 5837 | `.loc-step1-skip-btn:hover` | `background: var(--gold-light)` | override-thirdparty |
| 5841 | `.loc-step1-skip-btn.is-active` | `background: var(--blue)` | override-thirdparty |
| 5915 | `.loc-step1-inflow-total .loc-step1-sticky-bottom__btn` (in @media 781px+) | `background: var(--gold)` | override-mediaquery |
| 5915 | `.loc-step1-inflow-total .loc-step1-sticky-bottom__btn` (in @media 781px+) | `color: var(--white)` | override-mediaquery |
| 5953 | `#loc-step1-sticky-bottom` (in @media 781px+) | `display: none` | override-mediaquery |
| 7014 | `.loc-step3-cal-nav-btn` | `background: transparent` | override-thirdparty |
| 7021 | `.loc-step3-cal-nav-btn` | `color: var(--blue)` | override-thirdparty |
| 7021 | `.loc-step3-cal-nav-btn` | `transition: opacity 0.15s ease` | override-thirdparty |
| 7027 | `.loc-step3-cal-nav-btn:hover, :focus` | `background: transparent` | override-thirdparty |
| 7033 | `.loc-step3-cal-nav-btn:active` | `background: transparent` | override-thirdparty |
| 7104 | `.loc-cal-day--selected` | `background: var(--blue)` | specificity-war |
| 7104 | `.loc-cal-day--selected` | `border-color: var(--blue)` | specificity-war |
| 7104 | `.loc-cal-day--selected` | `color: var(--white)` | specificity-war |
| 7111 | `.loc-cal-day--selected::after` | `background: var(--white)` | specificity-war |
| 7764 | `.loc-step2-sticky-bottom` (in @media 781px+) | `display: none` | override-mediaquery |
| 7853 | `.loc-step3-date-escape__btn--call` | `background: var(--blue)` | override-thirdparty |
| 7853 | `.loc-step3-date-escape__btn--call` | `color: var(--white)` | override-thirdparty |
| 7858 | `.loc-step3-date-escape__btn--call:hover` | `background: #152d58` | override-thirdparty |
| 7862 | `.loc-step3-date-escape__btn--discuss` | `background: var(--gold)` | override-thirdparty |
| 7862 | `.loc-step3-date-escape__btn--discuss` | `color: var(--white)` | override-thirdparty |
| 7867 | `.loc-step3-date-escape__btn--discuss:hover` | `background: var(--gold-light)` | override-thirdparty |
| 7871 | `.loc-step3-date-escape__btn--discuss.is-active` | `background: var(--blue)` | override-thirdparty |

**Selectors with 2+ `!important` (active specificity battles):**

| Selector | Count | Notes |
|---|---|---|
| `.loc-funnel-page .site-content / #page / .content-area` | 2 | GeneratePress layout reset |
| `.loc-step1-inflow-total .loc-step1-sticky-bottom__btn` | 2 | @media override |
| `.loc-step3-cal-nav-btn` | 3 | Calendar nav button — GP global button bleed |
| `.loc-cal-day--selected` | 3 | Calendar selected state — specificity war |
| `.loc-step3-date-escape__btn--call` | 2 | Escape panel buttons — GP bleed |
| `.loc-step3-date-escape__btn--discuss` | 2 | Escape panel buttons — GP bleed |

**Additional flags:**
- Line 7858: `background: #152d58 !important` — hardcoded hex, not a token. Should be `var(--blue-dark)`.
- `ox-shadow` typo (missing leading `b`): appears at lines 259, 447 and approximately 8 other places. Written as `ox-shadow: var(--shadow-*)` — the `box-shadow` property never fires on these selectors. Silent visual bug.

---

## 2. DUPLICATE / COMPETING SELECTORS

**28 selectors defined in more than one rule block outside @media.**

Root cause: the entire Step 2 inline-section and areas-section CSS block (approx lines 6172–6450) is copied verbatim at lines 6699–6918. This creates ~220 lines of dead duplicate code.

### Genuine conflict (later wins silently):

| Selector | Property | First value (line) | Second value (line) | Winner |
|---|---|---|---|---|
| `.loc-step3-summary-col` | `top` | `20px` (line 7180) | `80px` (line 7382) | line 7382 — 20px is dead |

### Complete verbatim duplicates (no conflict, just waste):

`.loc-step2-areas-grid`, `.loc-step2-area-group-title`, `.loc-step2-area-tags li:hover`, `.loc-step2-area-tags li span`, `.loc-step2-areas-note`, `.loc-step2-areas-note strong`, `.loc-step2-inline-section`, `.loc-appliance-cards--inline`, `.loc-step2-inline-summary` and all its sub-elements (`__header`, `__title`, `__total`, `__total span`, `__empty`, `__items`, `__item`, `__item-name`, `__item-price`), `.loc-step2-btn-proceed` and its states (`::after`, `:hover`, `--disabled`, `--disabled::after`), `.loc-step2-proceed-subtext` — 26 selectors.

### Near-duplicates (one block has extra properties the other omits):

| Selector | Difference |
|---|---|
| `.loc-step2-areas-section` | Second block adds `padding-top` and `border-top` that first block lacks |
| `.loc-step2-area-tags` | First block has `margin: 0; width: 100%`; second block omits both |
| `.loc-step2-area-tags li` | First block has `cursor: pointer`; second block omits it |

**Fix:** Delete lines 6699–6918 (the second copy). Verify nothing is lost by diffing the two blocks first.

---

## 3. MEDIA QUERY SCATTER

**52 total @media blocks. 10 distinct breakpoint values.**

### Count per breakpoint value:

| Breakpoint | Count | Used for |
|---|---|---|
| `(max-width: 768px)` | 21 | Primary mobile — homepage, inner pages, funnel shared |
| `(max-width: 780px)` | 7 | Inner page templates + funnel step caps |
| `(min-width: 781px)` | 6 | Funnel desktop layouts |
| `(min-width: 768px)` | 4 | Step 2 inline grids |
| `(min-width: 769px)` | 2 | Trust bar 4-col, desktop section spacing |
| `(min-width: 601px) and (max-width: 768px)` | 3 | Mid-range layouts |
| `(max-width: 600px)` | 2 | Funnel small-phone overrides |
| `(min-width: 540px)` | 2 | Step 2 inline grid columns |
| `(max-width: 960px)` | 1 | Step 1 body stack |
| `(max-width: 480px)` | 1 | Areas page single-col grid |

### The 768/769/780/781 cluster:

These four values are all active and in tension:

- **768px** is the mobile threshold for the homepage and all inner pages (21 blocks).
- **780px** is the mobile threshold for funnel steps and inner page templates (7 blocks). These two values conflict in the 769–780px range — behaviour is undefined/unstyled for that 12px band.
- **769px** is used as "desktop starts" for the trust bar and section spacing (2 blocks) — correctly avoids the 768px boundary.
- **781px** is used as "desktop starts" for all funnel steps (6 blocks) — matches the 780px mobile threshold.
- **768px min-width** (4 blocks) creates a boundary collision with **768px max-width** (21 blocks) — at exactly 768px viewport width, both conditions fire simultaneously.

**Target unification (not yet done):** consolidate to `600 / 768 / 780` and replace `(min-width: 768px)` with `(min-width: 769px)` throughout.

---

## 4. SECTION-LEVEL VERTICAL SPACING

### Full table:

| Selector | padding-top | padding-bottom | Notes |
|---|---|---|---|
| `.section-white / .section-grey / .section-blue` | `--space-16` (64px) | `--space-16` (64px) | Global utility classes |
| `.loc-reserve` | `--space-16` (64px) | `--space-16` (64px) | Homepage How to Reserve |
| `.loc-hww` | `--space-20` (80px) | `--space-20` (80px) | Homepage How We Work |
| `.loc-reviews` | `--space-20` (80px) | `--space-20` (80px) | Homepage Reviews |
| `.loc-areas` | `--space-20` (80px) | `--space-20` (80px) | Homepage Areas |
| `.loc-faq` | `--space-20` (80px) | `--space-20` (80px) | Homepage FAQ |
| `.loc-pricing` | `--space-20` (80px) | `0` | Homepage Pricing — asymmetric (intentional, panel flush) |
| `.loc-business-banner` | `--space-14` (56px) | `--space-14` (56px) | Homepage Business Banner |
| `.loc-inner-cta` | `--space-20` (80px) | `--space-20` (80px) | Shared CTA block |
| `.loc-services-section` | `--space-20` (80px) | `--space-20` (80px) | Services page |
| `.loc-hww-page-section` | `--space-16` (64px) | `--space-16` (64px) | How We Work page |
| `.loc-hww--page` | `0` | `--space-20` (80px) | HWW page body — asymmetric |
| `.loc-hww-checklist-section` | `var(--space-18)` | `var(--space-18)` | **UNDEFINED TOKEN — zero padding** |
| `.loc-faq-page` | `var(--space-18)` | `var(--space-18)` | **UNDEFINED TOKEN — zero padding** |
| `.loc-areas-page-map-section` | `--space-12` (48px) | `--space-12` (48px) | Areas page map |
| `.loc-areas-page-list-section` | `var(--space-18)` | `var(--space-18)` | **UNDEFINED TOKEN — zero padding** |
| `.loc-areas-page-contact-section` | `var(--space-18)` | `var(--space-18)` | **UNDEFINED TOKEN — zero padding** |
| `.loc-areas-page-how-section` | `var(--space-18)` | `var(--space-18)` | **UNDEFINED TOKEN — zero padding** |
| `.loc-about-intro / values / story / credentials / cta` | `--space-20` (80px) | `--space-20` (80px) | About page (all sections) |
| `.loc-contact-body` | `var(--space-18)` | `var(--space-25)` | **BOTH UNDEFINED TOKENS — zero padding** |
| `.loc-biz-who / how / different / scope / contact` | `--space-20` (80px) | `--space-20` (80px) | Business page (all sections) |
| `.loc-legal-body` | `--space-16` (64px) | `--space-16` (64px) | Legal page |
| `.loc-blog-body / .loc-single-body` | `--space-16` (64px) | `--space-16` (64px) | Blog/post |
| `.loc-404-section` | `var(--space-25)` | `var(--space-25)` | **UNDEFINED TOKEN — zero padding** |
| `.loc-page-header` | `var(--space-18)` | `--space-16` (64px) | **Top undefined, bottom defined — mixed** |

### !! CRITICAL: Undefined tokens (rendering bug)

`--space-18` and `--space-25` are referenced throughout the file but are **not defined in `:root`**. The `:root` spacing scale jumps from `--space-16: 64px` directly to `--space-20: 80px`. These were added during Phase 3b cat.5b development but the definition was lost in a `git checkout` revert and never re-committed.

**Affected selectors (all have zero or broken padding):**
`.loc-hww-checklist-section`, `.loc-faq-page`, `.loc-areas-page-list-section`, `.loc-areas-page-contact-section`, `.loc-areas-page-how-section`, `.loc-contact-body`, `.loc-404-section`, `.loc-page-header` (top only)

**Fix required:** Add `--space-18: 72px;` and `--space-25: 100px;` back to `:root` (same script `add-space-tokens.ps1` was used before — re-run it, or add manually). This is a one-line `:root` fix.

### Peer-section inconsistencies:

| Issue | Sections | Values |
|---|---|---|
| Homepage section rhythm splits into 3 tiers | .loc-reserve (64px) vs .loc-hww/.loc-reviews/.loc-areas/.loc-faq (80px) vs .loc-business-banner (56px) | No clear rule for which tier each uses |
| Inner pages split into 2 tiers | HWW page, legal, blog (64px) vs Services, About, Business (80px) | Reasonable but undocumented |
| Inner page map section uses 48px | `.loc-areas-page-map-section` | One-off, inconsistent with 64/80 rhythm |

---

## 5. COMPONENT DUPLICATION

### A. Funnel Summary Panels

Four near-identical blue summary panel implementations exist under different namespaces:

| Component | Type | Lines | Total rows |
|---|---|---|---|
| `.loc-step2-inline-summary` | Static blue panel | 6303–6449 (+ duplicate 6797–6918) | ~20 selectors |
| `.loc-step1-sticky-bottom` | Fixed bar | 6568–6688 | ~15 selectors |
| `.loc-step2-sticky-bottom` | Fixed bar | 6457–6563 | ~15 selectors |
| `.loc-step3-summary-box` / `.loc-step3-summary__*` | Static panel | 7185–7399 | ~20 selectors |

**Shared pattern across all four:** `background: var(--blue)`; white/gold typography on blue; `__label` in Montserrat 700, `--text-fine`, `letter-spacing: 0.1em`, uppercase, `rgba(255,255,255,0.5)`; `__amount` / `__total` in Montserrat 800; item rows with `justify-content: space-between`; location row with label/value pattern; gold proceed/reserve button.

**Key differences only:**

| Property | Step 1 sticky | Step 2 sticky | Step 2 inline | Step 3 summary |
|---|---|---|---|---|
| Position | fixed | fixed | static | static |
| Total font-size | `--text-h4` | `--text-h4` | `--text-h3` | `--text-h3` |
| Location value size | `--text-body-sm` | `--text-body-sm` | `--text-body-sm` | `--text-ui-lg` (differs) |
| Slot sub-component | No | No | No | Yes |

Estimated duplicated declarations across the four: **~60 property declarations**.

### B. Section Eyebrows

A global `.section-eyebrow` class exists (line 239) but is unused — every section defines its own private eyebrow:

`.loc-reserve__eyebrow`, `.loc-pricing__eyebrow`, `.loc-business-banner__eyebrow`, `.loc-reviews__eyebrow`, `.loc-areas__eyebrow`, `.loc-faq__eyebrow`, `.loc-about-intro__eyebrow`, `.loc-about-values__eyebrow`, `.loc-about-story__eyebrow`, `.loc-about-credentials__eyebrow`, `.loc-about-cta__eyebrow`, `.loc-services-section__eyebrow`, `.loc-areas-page-list-section__eyebrow`, `.loc-biz-who__eyebrow` (×4 sections), `.loc-contact-details__eyebrow`, `.loc-inner-cta__eyebrow`, `.loc-step3-eyebrow`, `.loc-blog-eyebrow`, `.loc-404-eyebrow`, `.loc-page-header__eyebrow`, `.loc-funnel-page-header__eyebrow`, `.loc-legal-section__label` (similar)

**~26 private selectors** each repeating the same 5–6 declarations. Minor variations in `letter-spacing` (0.12em–0.22em) and font-size (`--text-fine` vs `--text-xs`) prevent exact deduplication but these are all variations on one pattern. Estimated **~130 duplicated property declarations**.

### C. Gold-border Highlight Box (grey panel + 4px gold left border)

Pattern: `background: var(--lightgrey)` (or similar), `border-left: 4px solid var(--gold)`, `padding: var(--space-4) var(--space-5)`.

Appears independently as:
- `.loc-step1-price-guarantee`
- `.loc-step3-price-guarantee`
- `.loc-about-story__future-box`
- `.loc-legal-highlight`
- (partially) `.loc-biz-hmo-note` (blue bg, not grey)

~5 instances, each with identical 3–4 structural declarations re-stated independently. No shared base class.

### D. Sticky Bottom Bars

Three components share near-identical fixed-bar structure: `.loc-step1-sticky-bottom`, `.loc-step2-sticky-bottom`, `.loc-step3-sticky-bottom`. Each independently declares `position: fixed; bottom: 0; left: 0; right: 0; background: var(--blue); display: none;` and identical sub-element patterns. Estimated **~60 duplicated declarations**.

### E. Card Components (no shared base)

Five+ "white card with accent + hover lift" patterns each independently implement `border-radius`, `box-shadow` hover, and `transform: translateY` hover with no shared base class: `.loc-hww__group`, `.loc-about-values__card`, `.loc-biz-who__card`, `.loc-faq__item`, `.loc-services-commercial-card`, `.loc-reserve__card`.

---

## Immediate action required

1. **Add `--space-18: 72px` and `--space-25: 100px` to `:root`** — fixes zero-padding bug on ~8 page sections. One-liner.
2. **Delete duplicate Step 2 CSS block** (lines ~6699–6918) — removes ~220 lines of dead code and the `.loc-step3-summary-col` top conflict.
3. **Fix `ox-shadow` typo** — `box-shadow` never fires where written as `ox-shadow`.
4. **Replace `#152d58` at line 7858 with `var(--blue-dark)`** — stray hardcoded hex in `!important`.
