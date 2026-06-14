# style.css Audit — Leicester Oven Cleaning
Generated: 2026-06-14

---

## 1. File Inventory

| Metric | Value |
|--------|-------|
| Total lines | 8,665 |
| `@media` rules | 53 |
| CSS custom properties (variables) | 7 brand tokens |
| Stylesheet version | 2.0.0 (post-migration) |

---

## 2. Colour Audit

### Brand Tokens (CSS Variables)

| Variable | Value | Role |
|----------|-------|------|
| `--blue` | `#1A3A6E` | Leicester Blue — primary |
| `--gold` | `#C9960C` | Rich Gold — accent |
| `--gold-light` | `#e8b020` | Gold hover state |
| `--white` | `#FFFFFF` | White |
| `--lightgrey` | `#F5F5F5` | Light grey background |
| `--offblack` | `#1C1C2E` | Near-black text |
| `--border` | `#e2e2e2` | Border colour |

### Hardcoded Hex Values (not using tokens)

25 distinct hex values found in the file. Notable violations — brand colour literals used raw instead of their token:

| Hardcoded Value | Token Equivalent | Location |
|-----------------|-----------------|----------|
| `#c9960c` | `--gold` | `@keyframes` animation |
| `#e8b020` | `--gold-light` | `@keyframes` animation |
| `#1a3a6e` | `--blue` | Scattered selectors |
| `#1C1C2E` | `--offblack` | Scattered selectors |

### Hardcoded Grey Scale (no tokens)

Nine distinct grey shades in use, none tokenised:

`#444` · `#555` · `#666` · `#777` · `#888` · `#999` · `#aaa` · `#bbb` · `#ccc`

### Distinct `rgba()` Values

43 distinct `rgba()` values — almost entirely one-off usages. No consistent rgba palette.

### Near-Duplicate Colours

| Pair | Difference |
|------|-----------|
| `#eef3fa` / `#edf2fa` | 1 digit apart — visually identical light blue; likely the same intent |

---

## 3. Typography Audit

### Font Families

| Family | Uses | Role |
|--------|------|------|
| Montserrat | 216 | Headings, labels, CTAs |
| Open Sans | 139 | Body text |
| Georgia | 1 | One-off (likely accidental or legacy) |

### Font Weights in Use

`300` · `400` · `600` · `700` · `800`

### Font Sizes (26 distinct values)

Ordered smallest to largest:

| Size | Notes |
|------|-------|
| 9px | Micro label |
| 11px | |
| 12px | |
| 13px | |
| 14px | |
| 15px | |
| 16px | |
| 17px | Base body size |
| 18px | |
| 19px | |
| 20px | |
| 21px | Off-grid |
| 22px | |
| 24px | |
| 26px | |
| 28px | |
| 30px | |
| 32px | |
| 36px | |
| 40px | |
| 42px | |
| 48px | |
| 56px | |
| 64px | |
| 80px | |
| 120px | Hero display size |

**26 values** across a 9px–120px range with no systematic scale.

---

## 4. Spacing Audit

### Distinct Spacing Values

35 distinct `px` spacing values in use across `margin`, `padding`, and `gap`.

### Off-Grid Values (not on 4px base)

Values that fall outside a 4px grid, with occurrence count:

| Value | Count | Note |
|-------|-------|------|
| 3px | 7 | |
| 5px | 1 | |
| 7px | 4 | |
| 9px | 2 | |
| 11px | 2 | |
| 13px | 6 | |
| 18px | 14 | High usage — consider tokenising as a half-step |
| 21px | 1 | |
| 22px | 3 | |
| 44px | 1 | |
| 50px | 2 | |
| 52px | 1 | |

---

## 5. Border Radius / Box Shadow / Z-Index

### Border Radius (6 distinct values)

| Value | Count |
|-------|-------|
| 50% | 26 |
| 4px | 6 |
| 8px | 5 |
| 2px | 3 |
| 0 | 1 |
| 20px | 1 |

### Box Shadow (21 distinct values)

18 of 21 values used **exactly once** — no consistent elevation system. Only one value appears 3 times:

| Value | Count |
|-------|-------|
| `0 -4px 20px rgba(0,0,0,0.2)` | 3 |
| All other 20 values | 1 each |

### Z-Index Stacking Map

| Value | Context |
|-------|---------|
| 1000 | Site header, modal overlay |
| 999 | Mobile menu, scroll hint indicator |
| 990 | Sticky postcode bar (fixed state) |
| 500 | Step 3 mobile sticky bar |
| 100 | Step 1 / Step 2 sticky bars |
| 90 | Step 2 sticky bar base |
| 10 | Modal close button |
| 2 | Decorative pseudo-elements (::before/::after layering) |
| 1 | Internal layering |
| 0 | Reset / explicit baseline |

---

## 6. Breakpoint Audit

### Total `@media` Rules: 53

### Near-Duplicate Breakpoint Clusters

Three clusters where the same logical breakpoint is expressed inconsistently across the file:

| Cluster | Values Used | Issue |
|---------|------------|-------|
| Desktop threshold | `max-width: 768px` and `min-width: 769px` | Same breakpoint, both forms present — gap between 768 and 769 |
| Funnel desktop | `max-width: 780px` and `min-width: 781px` | Inner pages use 780, funnel uses 781 — inconsistent |
| Funnel mobile split | `max-width: 600px` and `min-width: 601px` | Consistent within funnel but separate from global 768 cluster |

**Recommendation:** Settle on three canonical breakpoints and consolidate. Suggested:

```css
/* Mobile-first suggestion */
--bp-sm: 601px;   /* funnel mobile/tablet split */
--bp-md: 769px;   /* global desktop threshold */
--bp-lg: 1025px;  /* wide desktop */
```

---

## 7. Component Inventory & Duplication

### Page / Section Components

| Component Prefix | Pages Used On |
|-----------------|---------------|
| `loc-hero` | Homepage |
| `loc-trust` | Homepage |
| `loc-how` | Homepage |
| `loc-pricing` | Homepage |
| `loc-ticker` | Homepage |
| `loc-reviews` | Homepage |
| `loc-areas` | Homepage + Areas page |
| `loc-faq` | Homepage + FAQ page |
| `loc-biz` | Homepage |
| `loc-step1-*` | Funnel Step 1 |
| `loc-step2-*` | Funnel Step 2 |
| `loc-step3-*` | Funnel Step 3 |
| `loc-about-*` | About page |
| `loc-services-*` | Services page |
| `loc-how-we-work-*` | How We Work page |
| `loc-commercial-*` | B2B page |
| `loc-404-*` | 404 page |
| `loc-contact-*` | Contact page |

### Duplicated CSS Blocks (verbatim duplicates)

| Selector | Occurrences | Action |
|----------|-------------|--------|
| `.loc-step2-areas-section` block | 2 | Deduplicate |
| `.loc-step2-inline-summary` block | 2 | Deduplicate |
| `.loc-step2-btn-proceed` block | 2 | Deduplicate |

### Structurally Duplicated Patterns (same intent, independent implementations)

Three funnel summary panels each independently implement the same blue-box-with-items-and-total pattern:

| Component | File |
|-----------|------|
| Step 1 sticky bottom bar summary | `page-reserve-step1.php` |
| Step 2 continue bar / inline summary | `page-reserve-step2.php` |
| Step 3 summary panel | `page-reserve-step3.php` |

These share identical visual language but have no shared CSS. Consolidation opportunity on migration.

---

## 8. Candidate-Unused CSS Classes

Classes present in `style.css` but not referenced in any PHP template file. Grouped by likely status:

### JS-Manipulated (keep — applied dynamically at runtime)

| Class | Used By |
|-------|---------|
| `loc-cal-day--available` | Calendar JS — built dynamically by `makeCell()` |
| `loc-step3-summary__slot-label` | Step 3 JS — slot row label |
| `loc-step3-summary__slot-value` | Step 3 JS — slot row value |
| `loc-step3-summary__slot-reserve` | Step 3 JS — reserve button state |
| `loc-step3-summary__slot--active` | Step 3 JS — pulsing active state |

### Confirmed Dead / Legacy (safe to delete)

| Class | Reason |
|-------|--------|
| `loc-founding-strip` | Founding Rate removed June 2026 |
| `loc-step1-founding-note` | Founding Rate removed June 2026 |
| `loc-step3-confirm-founding` | Founding Rate removed June 2026 |
| `loc-step1-summary__*` (multiple) | Old Step 1 right-rail summary panel — replaced by sticky bar June 2026 |
| `loc-step1-confirm-btn` | Part of removed right-rail summary panel |

### Utility Classes (defined but no PHP uses found)

| Class | Defined Intent |
|-------|---------------|
| `section-white` | Section background utility |
| `section-grey` | Section background utility |
| `section-blue` | Section background utility |
| `section-inner` | Section inner wrapper utility |
| `section-eyebrow` | Eyebrow label utility |

### Areas Section (redesigned — old classes orphaned)

| Class | Status |
|-------|--------|
| `loc-areas__grid` | Orphaned |
| `loc-areas__legend` | Orphaned |
| `loc-areas__map` | Orphaned |
| `loc-areas__radius` | Orphaned |

### Total Candidate-Unused: 49 classes

| Category | Count |
|----------|-------|
| JS-manipulated (keep) | 5 |
| Confirmed dead/legacy | ~15 |
| Utility (undefined use) | 5 |
| Areas orphans | 4 |
| Remaining unresolved candidates | ~20 |

---

## Summary

**Headline numbers:** 25 distinct hex values + 43 distinct `rgba()` values (colour); 26 distinct font-size values (9px–120px); 35 distinct spacing values with 12 off-grid sizes; 21 distinct box-shadow values (18 used exactly once); 53 `@media` rules across 3 near-duplicate breakpoint clusters (768/769, 780/781, 600/601); 3 funnel summary panels independently implementing the same pattern + 3 verbatim-duplicate CSS blocks; 49 candidate-unused classes (~20 confirmed dead, 5 JS-only, ~24 unresolved).
