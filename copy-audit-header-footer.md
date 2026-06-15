# Copy Audit — Header & Footer
Generated from header.php and footer.php as they exist in the codebase.

---

## HEADER

Source: `header.php`

### Logo (link to homepage)
- Top line: **Leicester**
- Bottom line: **Oven Cleaning**
- href: `/` (dynamic via `home_url('/')`)

### Desktop navigation (`loc-nav`)
| Label | href |
|-------|------|
| About | /about |
| Services | /services |
| Business & Commercial | /business-commercial |

### Desktop CTAs (`loc-header__ctas`)
| Label | href | Class |
|-------|------|-------|
| Call Us | tel:PLACEHOLDER | btn-ghost-blue |
| Reserve Your Slot | /reserve-step-1 | btn-primary |

> **PLACEHOLDER:** `tel:PLACEHOLDER` — phone number not yet obtained.

### Mobile controls (`loc-header__mobile`)
| Element | Label / aria-label | href | Class |
|---------|-------------------|------|-------|
| Button (link) | *(visible text)* Reserve | /reserve-step-1 | btn-primary btn-primary--small |
| Icon link | aria-label="Call us" | tel:PLACEHOLDER | loc-header__call-icon |
| Hamburger button | aria-label="Open menu" | — | loc-hamburger |

> **PLACEHOLDER:** `tel:PLACEHOLDER` — phone number not yet obtained.

---

## MOBILE MENU

Source: `header.php` — `.loc-mobile-menu` dropdown

| Order | Label | href |
|-------|-------|------|
| 1 | About | /about |
| 2 | Services | /services |
| 3 | Business & Commercial | /business-commercial |

---

## FOOTER

Source: `footer.php`

### Column 1 — Brand & Trust

**Logo text:**
- Top line: Leicester
- Bottom line: Oven Cleaning

**Tagline:**
> Professional oven cleaning across Leicester & Leicestershire.

**Trust badges:**
- ✓ Fully Insured
- ✓ ICO Registered
- ✓ Companies House Registered

> **FLAG — aspirational/not-yet-true:** "✓ Companies House Registered" — per CLAUDE.md the company is NOT yet registered. This is aspirational placeholder copy.
> **FLAG — aspirational/not-yet-true:** "✓ ICO Registered" — ICO registration is pending (see bottom bar note). The badge says "registered" but the legal note says "[Pending Registration]". These are inconsistent.

---

### Column 2 — Services

Heading: **Services**

| Label | href |
|-------|------|
| Oven Cleaning | /services |
| Hob Cleaning | /services |
| Extractor Hood Cleaning | /services |
| Microwave Cleaning | /services |
| BBQ Cleaning | /services |
| Business & Commercial | /business-commercial |

> **NOTE:** All service links point to `/services` (the single services page). No individual service pages exist yet.

---

### Column 3 — Company

Heading: **Company**

| Label | href |
|-------|------|
| About Us | /about |
| How We Work | /how-we-work |
| Areas Covered | /areas |
| Blog | /blog |
| FAQ | /faq |

---

### Column 4 — Help

Heading: **Help**

| Label | href |
|-------|------|
| Contact Us | /contact |
| Cancellation Policy | /cancellation-policy |

> **FLAG — likely dead link:** `/cancellation-policy` — no page template for this exists in the theme. Likely a 404.

---

### Column 5 — Legal

Heading: **Legal**

| Label | href |
|-------|------|
| Privacy Policy | /privacy-policy |
| Terms & Conditions | /terms-and-conditions |
| Cookie Policy | /cookie-policy |

> **NOTE:** Verify these pages exist as WordPress pages — no PHP templates for them are visible in the theme (likely managed as WP pages with content).

---

### Bottom Bar

**Copyright line:**
> © [current year via PHP] Leicester Oven Cleaning — Trading as The Proper-T Cleaning Group Ltd. All rights reserved.

> **FLAG — not-yet-true:** "The Proper-T Cleaning Group Ltd" — per CLAUDE.md the company is NOT yet registered as a Ltd company. The "Ltd" suffix is premature.

**ICO & insurance line:**
> ICO Registration: [Pending Registration] | Fully insured including items worked upon

> **FLAG — placeholder:** `[Pending Registration]` — ICO number not yet obtained.

**Social links:**

| Platform | href | aria-label |
|----------|------|-----------|
| Facebook | # | Facebook |
| Instagram | # | Instagram |
| Google Business Profile | # | Google Business Profile |

> **FLAG — all placeholder:** All three social links use `href="#"` — no real social profiles linked yet.

---

## Summary of flags

| Issue | Location | Type |
|-------|----------|------|
| tel:PLACEHOLDER | Header desktop CTA "Call Us" | Placeholder — phone not yet obtained |
| tel:PLACEHOLDER | Header mobile phone icon | Placeholder — phone not yet obtained |
| ✓ Companies House Registered | Footer col 1 trust badge | Aspirational — company not yet registered |
| ✓ ICO Registered (badge) vs [Pending Registration] (bottom bar) | Footer col 1 + bottom bar | Inconsistent — badge says registered, legal note says pending |
| The Proper-T Cleaning Group Ltd | Footer copyright | Not-yet-true — not registered as Ltd |
| ICO Registration: [Pending Registration] | Footer bottom bar | Placeholder — ICO number not yet obtained |
| /cancellation-policy | Footer Help column | Likely dead link — no page template found |
| # (Facebook) | Footer social | Placeholder — no profile yet |
| # (Instagram) | Footer social | Placeholder — no profile yet |
| # (Google Business Profile) | Footer social | Placeholder — no profile yet |
