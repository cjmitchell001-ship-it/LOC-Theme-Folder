# Copy Audit — FAQ Page
Generated from `page-faq.php` in page order. JS-injected copy: none found — `functions.php` was searched for any `is_page('faq')` or equivalent hook and no matches were found.

---

## Page Header

| Element | Copy | Location |
|---------|------|----------|
| Eyebrow | "Got Questions?" | ~L15 |
| h1 | "Frequently Asked Questions" (rendered as "Frequently Asked " + `<span>Questions</span>`) | ~L16 |
| Intro | "Everything you need to know before you reserve. Can't find your answer here? Get in touch — we're happy to help." | ~L17 |

---

## FAQ Content

### Group: General (~L29–70)

---

**Q: "How long does an oven clean take?"** (~L32–33)

> A: "A single oven typically takes 1.5 to 2 hours. Add approximately 30–45 minutes per additional appliance. We'll give you a realistic estimate when we confirm your booking."

> **OVERLAP NOTE — vs. How We Work page:** The How We Work page does not state specific duration estimates anywhere. This is the only place on the site time estimates appear. Consistent with the process described on HWW (multi-step clean), but not cross-referenced there.

---

**Q: "Do I need to do anything before you arrive?"** (~L37–38)

> A: "Just make sure the oven is switched off and has had time to cool down. We'll take care of everything else — no need to pre-clean or remove anything."

> **OVERLAP NOTE — vs. How We Work "Before We Arrive" section:** HWW says "All we ask is clear access to the appliance and a small amount of space to work." This FAQ answer adds "switched off and cooled down" — a practical prep step not mentioned in HWW. The two are complementary but the HWW page is incomplete by comparison.

---

**Q: "What do you need access to?"** (~L42–43)

> A: "We only require access to a cold water tap. We bring all our own equipment and do not use your electricity — so there's no disruption to the rest of your home."

> **NOTE — "do not use your electricity":** This is a specific operational claim not stated on any other page. Consistent with the dip-tank process described on HWW (parts are removed and cleaned externally), but the "no electricity" claim warrants verification — e.g. if a fan is used to dry the oven, it may use the oven's own power briefly. Flag as a factual claim to confirm before go-live.

---

**Q: "Will there be any chemical smells afterwards?"** (~L47–48)

> A: "No. All products are thoroughly rinsed and the oven is dried before reassembly. Your oven will be ready to use immediately — with no residue or fumes."

---

**Q: "Is the price really fixed regardless of condition?"** (~L52–53)

> A: "Yes. The price we agree when we confirm your booking is the price you pay — no matter how dirty the oven is when we arrive. No hidden fees, no on-the-day surprises."

> **PRICING FLAG:** Describes the fixed-price commitment. Consistent with the brand positioning and How We Work ("Fixed price reconfirmed before any work starts"). No specific figures.
>
> **OVERLAP NOTE — vs. How We Work and Pricing & Payment FAQ (below):** The fixed-price commitment appears in multiple places — both FAQ groups and the HWW process step. All consistent.

---

**Q: "Can I use my oven the same day?"** (~L57–58)

> A: "Yes — your oven will be fully reassembled, tested, and ready to use before we leave. Same day, every time."

> **OVERLAP NOTE:** Consistent with HWW ("Oven ready to use immediately" / "ready to use the same day") and CTA copy across the site.

---

**Q: "Do you clean all oven brands?"** (~L62–63) *(also appears in Coverage & Eligibility group ~L157–158)*

> A: "Yes. We clean all makes and models including AGA, Rayburn, Rangemaster, Smeg, Neff, Siemens, Bosch, and all standard domestic brands."

> **NOTE — DUPLICATE QUESTION:** This question and answer appear verbatim twice on the page — once here in General (~L62–63) and again in Coverage & Eligibility (~L157–158). Exact duplication of both the question and the full answer. Flag as internal duplication to remove one instance.

---

**Q: "Why is my preferred date not available?"** (~L67–68)

> A: "We group jobs geographically each day — working within a set radius rather than travelling across the county. This keeps us punctual and efficient. Dates with a gold dot on the calendar are days we're already working near you. If none of those suit, choose any available date and we'll do our best to accommodate you."

> **PLACEHOLDER FLAG:** References the Step 3 calendar and "gold dot" availability indicators — these are currently hardcoded placeholder arrays, not a real booking API (per CLAUDE.md). The description of how the calendar works is accurate to the current placeholder implementation but will need review when the real booking system is built.

---

### Group: Booking & Reservations (~L73–95)

---

**Q: "How do I reserve a slot?"** (~L77–78)

> A: "You select your appliances and a preferred date online. We'll call you to confirm the booking, agree a time window, and take a £25 deposit at that point. Nothing is charged until after we've spoken."

> **PRICING FLAG:** £25 deposit figure stated. Per CLAUDE.md this is a placeholder figure — but the £25 deposit has been referenced across the site in m8 (Step 3, CTA subtext). Flag as a real business decision figure that needs confirming before go-live, not an arbitrary placeholder.
>
> **OVERLAP NOTE — vs. funnel and CTA copy:** Consistent with Step 3 ("£25 deposit, taken after the call") and the revised CTA subtext pattern introduced in m8. The deposit amount is now consistent across FAQ, funnel, and CTAs.

---

**Q: "Is there a deposit?"** (~L82–83)

> A: "Yes, a £25 deposit is taken after our confirmation call — not at the point of reservation. It's deducted from your total on the day. It's refundable with 48 hours notice and transferable to another date if you need to reschedule."

> **PRICING FLAG:** £25 deposit stated again. Consistent with "How do I reserve a slot?" answer above. Deduction from total and 48-hour refund/transfer policy stated here.
>
> **OVERLAP NOTE — vs. cancellation FAQ below:** The 48-hour refund window is described here as the reschedule condition and below (Cancel FAQ) as the cancellation condition. Consistent.

---

**Q: "Can I reschedule?"** (~L87–88)

> A: "Yes. Give us 48 hours notice and your deposit transfers to your new date, no questions asked. Within 48 hours the deposit is non-refundable."

---

**Q: "What if I need to cancel?"** (~L92–93)

> A: "Cancel with 48 hours or more notice and we'll refund your deposit in full. Within 48 hours the deposit is forfeit. No-shows forfeit the deposit automatically."

> **OVERLAP NOTE — vs. cancellation policy page:** CLAUDE.md notes a cancellation policy placeholder page was created in m8 with content still to be written. These FAQ answers contain the operative cancellation and reschedule terms. The two need to be consistent once the cancellation policy page is written.

---

### Group: On The Day (~L98–115)

---

**Q: "Do you need to prepare?"** (~L102–103)

> A: "Just make sure there's clear access to the appliance. We bring everything else — equipment, protective coverings, cleaning products, and replacement parts."

> **REPAIR/PARTS FLAG:** "replacement parts" is listed as part of what is brought to every job. This is the same claim removed from the Services page (commit `ece9cc2`) and from the How We Work checklist (commit `45ffd0a`) as repair-adjacent, conflicting with CLAUDE.md's Voice & CTA Rules. The claim remains here. Flag for consistency: all three removal decisions should be applied here too, or this page needs a deliberate exception.
>
> **NOTE:** The question heading in the PHP is "Do I need to do anything to prepare?" (~L102) — this overlaps with the General group question "Do I need to do anything before you arrive?" (~L37). The answers are complementary (one covers pre-arrival prep; this one covers what to have ready on the day), but a user may find the similarity confusing.

---

**Q: "Do you use fume-free products?"** (~L107–108)

> A: "Yes. All our products are low-fume and safe for use in a home environment. You don't need to vacate the property."

> **NOTE — "low-fume" vs. "no chemical smells":** The General group answer to "Will there be any chemical smells afterwards?" says "No" — implying no smell at all. This On The Day answer qualifies: "low-fume" (not zero-fume). The two answers together are consistent (low-fume during, thoroughly rinsed before leaving) but a user reading only the On The Day section may notice the qualifier. Not a contradiction but worth noting.

---

**Q: "Will there be any smell?"** (~L112–113)

> A: "There may be a mild clean scent during and after the process — nothing unpleasant. We recommend ventilating the kitchen for 30 minutes after we leave."

> **OVERLAP NOTE:** The General group "Will there be any chemical smells afterwards?" answer says "No... with no residue or fumes." This On The Day answer says "There may be a mild clean scent." The two answers are to different questions (one is about chemical smells/fumes; this one is about any smell at all) and are technically consistent — but placed side-by-side in a search or structured read, they could appear contradictory. Worth reviewing whether the General answer should be softened slightly (e.g. "No fumes or chemical residue — though there may be a mild clean scent during the process").

---

### Group: Pricing & Payment (~L118–140)

---

**Q: "How are you so confident the price won't change?"** (~L122–123)

> A: "We inspect the appliance before we start and confirm the price at that point. If we find something unexpected, we tell you before we do anything. You're never surprised."

> **PRICING FLAG:** Describes the price confirmation process. Consistent with HWW "Arrival & Setup" step 2 ("Pre-clean inspection carried out — condition and any existing damage noted before work begins") and "Fixed price reconfirmed before any work starts."

---

**Q: "Do you take card payment?"** (~L127–128)

> A: "Yes. We take payment on the day by card. The £25 deposit is deducted from the total automatically."

> **PRICING FLAG:** £25 deposit figure stated again. Third instance in the FAQ. Consistent throughout.

---

**Q: "Are there any call-out charges?"** (~L132–133)

> A: "No. The price you see is the price you pay — including travel within our coverage area."

---

**Q: "What's included in the price?"** (~L137–138)

> A: "Our fixed price covers a full clean of the oven itself — including the interior, door glass, and standard racks and shelves. If you have additional loose trays, baking tins, or extra items you'd like cleaned, just mention it when we call to confirm — we'll agree any additional cost before we start, so there are no surprises."

> **PRICING FLAG:** Describes scope of the fixed price and the process for agreeing extras. Mentions "additional cost" — consistent with the fixed-price model (extras are agreed, not hidden). Added in m8 per CLAUDE.md session log ("FAQ: 'what's included in the price' added (extra trays/shelves scope)").

---

### Group: Coverage & Eligibility (~L143–160)

---

**Q: "Do you cover my area?"** (~L147–148)

> A: "We cover all LE postcodes and selected surrounding areas. Enter your postcode on the reservation page and we'll confirm coverage immediately."

> **PLACEHOLDER FLAG:** "all LE postcodes" — same concern as flagged in the Contact and Areas audits. The Areas page lists specific LE districts; not every LE postcode is included. "All LE postcodes" is a shorthand that may overstate coverage.
>
> "confirm coverage immediately" — same concern as the Areas page: implies backend validation that doesn't exist. The Step 2 funnel uses a static selectable list.

---

**Q: "Do you clean commercial appliances?"** (~L152–153)

> A: "We clean domestic-scale appliances in commercial settings — rental properties, offices, care homes, and small commercial kitchens. For larger commercial operations, get in touch directly."

> **OVERLAP NOTE — vs. Business & Commercial page and Services page:** Consistent with B&C page scope (domestic-scale appliances in commercial settings) and the Services page Commercial section. The mention of "care homes" here matches the Services page (which listed "Care Homes & Sheltered Housing") — and aligns the FAQ with the Services page rather than the B&C page's grid (which omitted care homes from its Who We Work With cards).

---

**Q: "Do you clean all oven brands?"** (~L157–158) *(duplicate of General group ~L62–63)*

> A: "Yes. We clean all makes and models including AGA, Rayburn, Rangemaster, Smeg, Neff, Siemens, Bosch, and all standard domestic brands."

> **NOTE — DUPLICATE:** Verbatim repeat of the identical question and answer from the General group (~L62–63). Flag for removal of one instance.

---

## CTA Section

| Element | Copy | Location |
|---------|------|----------|
| Eyebrow | "Still have a question?" | ~L170 |
| h2 | "We're happy to help." | ~L171 |
| Body | "Drop us a message and we'll get back to you." | ~L172 |
| Button | "Get In Touch →" (links to `/contact`) | ~L173 |

---

## Trust Markers / Credentials / Guarantee Copy

- Fixed-price commitment is stated in multiple answers (General Q5, Pricing Q1, Q3). All consistent.
- £25 deposit amount stated three times in Booking group and Pricing group — all consistent.
- 48-hour cancellation/reschedule terms stated clearly.
- No insurance, ICO, or Companies House reference on this page.
- No testimonials.

---

## Founder/Personal Identity Check

No name, photo, or biographical/employment detail found anywhere on this page. Fully compliant with CLAUDE.md's Privacy Requirement.

---

## Image Alt Text

No `<img>` elements on this page. Nothing to extract.

---

## JS-Injected Copy

None. `functions.php` was searched for any `is_page('faq')` or equivalent hook and no matches were found — this page has no JS-injected copy.

---

## Key Flags Summary

| Flag | Location | Detail |
|------|----------|--------|
| **Duplicate Q&A** | ~L62–63 and ~L157–158 | "Do you clean all oven brands?" appears verbatim twice — General and Coverage groups |
| **Replacement parts** | ~L103 | "replacement parts" listed as brought to every job — same claim removed from Services and HWW as repair-adjacent |
| **"All LE postcodes"** | ~L148 | Overstates coverage vs. the explicit district list on the Areas page |
| **"Instantly" / "immediately"** | ~L148 | Coverage confirmation implies backend validation that doesn't exist |
| **Smell contradiction** | ~L48 vs ~L113 | General group says "No" to chemical smells; On The Day group acknowledges "mild clean scent" — technically consistent but jarring side-by-side |
| **"No electricity" claim** | ~L43 | Specific operational claim not stated elsewhere — needs factual verification |
| **Calendar gold-dot description** | ~L68 | Accurate to the placeholder implementation; needs review when real booking system is built |
| **Cancellation policy alignment** | ~L92–93 | Operative terms here must match the cancellation policy page (content not yet written) |

*Placeholder phone/ICO/Companies House content is not referenced on this page — see `copy-audit-header-footer.md` for those (site-wide footer/header elements appear on every page including this one, but were already captured there).*
