# Pre/Post Oven Clean Checklist App — Design & Copy Response

**From:** the design/copy session (Cowork)
**To:** the Claude Code session that will build it
**Business:** Leicester Oven Cleaning (LOC), Leicester UK
**Date:** 5–7 September 2026
**Status:** Design and copy complete, worked through with Chris section by section as instructed. Nothing built yet.

Grounded throughout in the live knowledge base — `Insurance-Position.md`, `Post-Clean-Gas-Faults.md`, `Post-Clean-Electrical-Faults.md`, `SOP_v0.2.md`, `LOC-Pricing.md`, and `Material-Quick-Reference.md` — rather than generic assumptions. Where content is drawn directly from a real documented incident or an existing house rule, it's noted inline.

---

## 1. Decisions Made

All of these are Chris's own answers, given directly in the working session.

1. **Photos on any flagged defect:** as many as required, no cap.
2. **Absent customer, issue found:** the app waits until the full pre-check is complete, then sends an action item requiring the customer's response *before work commences*. Present customer: shown on screen, decided immediately, no block. This is a hard block when the customer is reachable.
3. **Resolving the block/no-signal conflict:** if there's no signal, find signal, then call the paying customer and describe the issue. A verbal "yes" alone is **not** acceptable — the minimum acceptable record is something in writing: either the customer taps the formal action item, or replies "yes" by text/WhatsApp. A written "yes" by message unblocks the job immediately; the formal signed action item is still pursued afterward for the complete record, but work doesn't wait for it once a written yes exists.
4. **Decline path:** both outcomes are real, separately recorded paths — (a) declined, job stops, signed record of the decline; (b) declined-but-proceed-anyway, a distinct signed statement, not styled as equal-weight against the decline.
5. **Job identifier:** continues the existing sequence used for job photo folders. Next job is 22, format `{number}-{first name}` (e.g. `22-Sarah`).
6. **Booking link:** no integration with the website's booking system. Manual entry every time — bookings also come in by phone and aren't always on the system.
7. **Tenancy "customer":** whoever engaged Chris is the customer — full stop, regardless of who's physically on site. An agent-commissioned job is, in practice, almost always a remote-signature job.
8. **Single recipient rule, no exceptions, explicitly confirmed for the video too:** "the only people that get to see whatever I do with this form and any videos" is whoever's paying for the job, period — PDF and video both. Applies identically to domestic and tenancy jobs. **This overrides the original brief's assumption that a tenancy job's video goes to "both parties" — see Section 7.**
9. **Retention:** kept forever, no auto-delete or review date, except the video (unchanged — 90 days, auto-deleted).
10. **App scope:** a strict check-and-sign-off document for peace of mind for all parties. It does **not** replace the SOP's Step 30 job log (price, payment, review-ask, upsell notes stay in whatever Chris uses for that already) — this app only ever holds check/sign-off data.
11. **No PIN.** The phone's own lock is enough security — S01 (a dedicated lock screen) is cut entirely.
12. **S03 mandatory fields:** Name and Email are hard-required. Address, Postcode and Phone are shown and expected but not validation-blocked.
13. **Checklist structure — family, not per-appliance-instance:** every appliance *family* (Oven/Grill Cavities, Hob, Extractor Hood, Microwave/Combi) is answered once per job, covering however many physical units of that type are present (e.g. a 3-cavity range answers the Cavities questions once, not three times).
14. **N/A means "not present at this property," not "not booked."** Every family is walked through on every job regardless of what was paid for — because that's exactly what surfaces additional work Chris can offer. A family that genuinely doesn't exist (e.g. no extractor in the kitchen) is skipped via its own presence question.
15. **Grill vs main cavity — no separate family needed.** The only real difference (grills never have a fan element) is already handled by the fan-element presence-gate inside the single Cavities family; a grill cavity just answers "no fan element" and those questions vanish.
16. **Heating elements added to Cavities** — roof/grill element and fan element, each checked separately for presence, physical condition, and even heat (heat + evenness merged into one question rather than two).
17. **Gas flame-response check added post-clean** — directly from the real Hotpoint Ultima incident (`Post-Clean-Gas-Faults.md`): an oven that lights and burns but doesn't respond to the dial looks fine on a plain yes/no "does it heat" question. Applied to both the Cavities family (oven/grill burners) and the Hob family (hob rings), since the same thermocouple/bypass-valve mechanism applies to any gas burner.
18. **No cuts to the checklist.** Chris reviewed the full length (35-40 questions on a job with everything included) and chose to keep everything as the trial version rather than pre-emptively cutting anything — justified by real fault history and the additional-work opportunity, both explicitly acknowledged as worth the extra taps.
19. **"Advisory" renamed and reframed to "Additional Work."** Originally modelled on an MOT advisory — a professional condition judgement. Chris flagged, correctly, that he holds no professional indemnity insurance, so the app must never advise on appliance condition or what the customer should do. Reframed as a pure service-upsell offer: "I noticed X, want me to also clean it for extra charge?" — never a comment on wear, condition, or need. Applied identically across every family.
20. **S29 incident script softened.** The original draft included "leave the door open for 24 hours to dry out and see if it resets" — a specific recommended remedy. Removed. The script now states only what happened and the factual consequence (isolated, needs a repair person), with no advice on remedy.
21. **S28 (abandoned job):** auto-archives out of the active "In Progress" list after roughly two weeks of no activity, but is never deleted — stays fully visible and searchable in Job History.
22. **Mid-clean incident (S29) protocol:** Chris isolates the affected appliance immediately and unconditionally — not a decision point. Whether the *rest* of a multi-appliance job continues is the paying customer's decision, made after being told what happened, and gets its own signature — not Chris's unilateral call.
23. **Repair referral list:** parked as a placeholder for now (`[NEEDS FACT]` in S29) rather than inventing names. A real, researched list of local appliance repair companies is a separate follow-up task.
24. **S18 video coaching copy confirmed:** `Keep it under 30 seconds. Show it powering on, the element glowing, the fan running, and the door closing properly.` Kept as originally proposed.

---

## 2. Open Questions

Everything below is genuinely unresolved — either not yet asked, or asked and not yet answered with enough certainty to mark Decided.

- **[NEEDS FACT]** The business phone number to print on the remote signing page (S13) trust footer, so a customer can call to verify the link is genuine.
- **[NEEDS FACT]** A researched, real list of ~5 local appliance repair companies for S29's referral placeholder.
- **[SUGGESTED, not explicitly confirmed]** The whole family-grouped, N/A-means-absent checklist architecture (Decisions 13-19) is explicitly a **trial** — Chris's own words were "let's give that the first trial point." It should be treated as provisional pending a handful of real jobs, not as settled forever.
- **[SUGGESTED, not explicitly confirmed]** Two small consistency additions made during final assembly, following the pattern Chris already approved rather than introducing anything new: an interior light check (present in the original brief's own post-clean list, present in every earlier draft, but not explicit in the final elements-heavy cavity table — reinstated here as `cavity_light` / `cavity_post_light`); and matching "parts refitted" / "existing faults" catch-all rows for Hob and Extractor Hood, mirroring what Cavities and Microwave already have, since there's no reason those two families should be less complete than the others. Flagging both explicitly rather than quietly assuming they're wanted.
- Whether the whole Design Direction section (new colour tokens, type scale mapping, component notes) needs any changes — presented, not yet reacted to point-by-point.

---

## 3. Checklist Content

**How this works, in one paragraph:** every family below is walked through on every job. A family whose first question ("is there one to check?") comes back No is skipped entirely and marked N/A — nothing else in that family is asked. Within Cavities, the roof-element and fan-element blocks are each gated the same way. Every defect row forces a photo; every "additional work" row is a pure upsell offer with no comment on appliance condition. `—` means the field doesn't apply to that row.

### Universal (always asked, once, regardless of what's present)

| id | question | answer_type | defect_when | issue_text | photo | note |
|---|---|---|---|---|---|---|
| access | Safe access, working power and hot water where needed? | yes_no_na | No | "I didn't have the [access/power/hot water] I needed to do the job as arranged." | — | Y |
| isolate | Can the appliance be safely isolated for cleaning? | yes_no | No | "I didn't have a safe way to isolate the appliance before starting." | — | Y |
| exterior | Are the door fronts, handles, knobs and pan supports free of existing damage? | yes_no | No | "The [door front/handle/knob/pan support] had existing damage before I started." | Y | — |

### Oven / Grill Cavities — shown if any cavity is present

**Pre-Clean**

| id | question | answer_type | defect_when | issue_text | photo | note |
|---|---|---|---|---|---|---|
| cavity_door_seal | Do the cavity doors close and seal properly? | yes_no | No | "The [oven/grill] door wasn't closing and sealing properly before I started." | Y | — |
| cavity_glass | Is the door glass intact, with no cracks or heavy staining between the panes? | yes_no | No | "The door glass had [a crack/staining between the panes] before I started." | Y | Y |
| cavity_interior | Is the interior lining (enamel or catalytic liner panels) free of chips, cracks or wear-through? | yes_no | No | "The interior had existing [chips/wear] before I started." | Y | Y |
| cavity_parts | Are shelves, runners, shelf supports and trays present and undamaged? | yes_no | No | "[Shelves/runners/trays] were missing or damaged before I started." | Y | Y |
| cavity_light | Is the interior light working? | yes_no_na | No | "The interior light wasn't working before I started." | — | — |
| cavity_roof_present | Does the cavity have a roof/grill element? | yes_no | never | — (No skips the next two rows, marked N/A) | — | — |
| cavity_roof_condition | Is the roof element free of splits, damage, twisting or warping? | yes_no | No | "The roof element shows [splits/damage/twisting/warping] — noted before I started." | Y | Y |
| cavity_roof_heat | Turned on, does it heat evenly with no cold or hot spots? | yes_no | No | "The roof element wasn't heating evenly when I tested it before starting." | Y | Y |
| cavity_fan_present | Does the cavity have a fan element? | yes_no | never | — (No skips the next three rows, marked N/A) | — | — |
| cavity_fan_condition | Is the fan element free of splits, damage, twisting or warping? | yes_no | No | "The fan element shows [splits/damage/twisting/warping] — noted before I started." | Y | Y |
| cavity_fan_spin | Is the fan spinning freely? | yes_no | No | "The fan wasn't spinning freely when I checked it before starting." | Y | Y |
| cavity_fan_heat | Turned on, does it heat evenly with no cold or hot spots? | yes_no | No | "The fan element wasn't heating evenly when I tested it before starting." | Y | Y |
| cavity_other_functions | Do the other cooking functions/modes work as expected? | yes_no_na | No | "The [function] wasn't working as expected before I started." | Y | Y |
| cavity_existing_faults | Anything else you're already aware of, not covered above? | yes_no | Yes | "I noted an existing fault before starting: [detail]." | Y | Y (forced) |
| cavity_additional_work | Is there anything here I could additionally clean for an extra charge — heavy build-up, staining, similar? | yes_no | never | "I noticed [detail] — happy to include this for an extra charge while I'm here, if you'd like it done." | Y | Y |

**Post-Clean**

| id | question | answer_type | defect_when | issue_text | photo | note |
|---|---|---|---|---|---|---|
| cavity_post_door_seal | Door closes and seals properly? | yes_no | No | "The door wasn't closing and sealing properly after I put it back together." | Y | Y |
| cavity_post_light | Interior light working? | yes_no_na | No | "The interior light wasn't working when I tested it." | — | — |
| cavity_post_roof_condition | Roof element free of splits, damage, twisting or warping? | yes_no_na | No | "The roof element shows [splits/damage/twisting/warping] after cleaning." | Y | Y |
| cavity_post_roof_heat | Heats evenly, no cold or hot spots? | yes_no_na | No | "The roof element wasn't heating evenly when I tested it after cleaning." | Y | Y |
| cavity_post_fan_condition | Fan element free of splits, damage, twisting or warping? | yes_no_na | No | "The fan element shows [splits/damage/twisting/warping] after cleaning." | Y | Y |
| cavity_post_fan_spin | Fan spinning freely? | yes_no_na | No | "The fan wasn't spinning freely when I tested it after cleaning." | Y | Y |
| cavity_post_fan_heat | Heats evenly, no cold or hot spots? | yes_no_na | No | "The fan element wasn't heating evenly when I tested it after cleaning." | Y | Y |
| cavity_post_flame_response *(gas only)* | For gas, does the flame respond properly across the full range of the dial? | yes_no_na | No | "The flame wasn't responding to the dial across its full range when I checked it." | Y | Y |
| cavity_post_other_functions | Other cooking functions/modes working? | yes_no_na | No | "The [function] wasn't working as expected after cleaning." | Y | Y |
| cavity_post_parts | Shelves, runners, trays correctly refitted? | yes_no | No | "I found a [shelf/runner/tray] wasn't sitting right — corrected before leaving." | — | Y |
| cavity_post_new_fault | Anything noticed now that wasn't there before? | yes_no | Yes | "I noticed something after cleaning that wasn't there before: [detail]." | Y (forced) | Y (forced) |

### Hob — shown if a hob is present

**Pre-Clean**

| id | question | answer_type | defect_when | issue_text | photo | note |
|---|---|---|---|---|---|---|
| hob_operational | Do all rings/burners currently ignite and heat? | yes_no_na | No | "A ring/burner wasn't heating/igniting when I checked it." | Y | Y |
| hob_surface | Is the hob surface/top free of cracks or damage? | yes_no | No | "The hob [surface/top] had existing damage before I started." | Y | Y |
| hob_existing_faults | Any existing fault you're aware of — burner cap/crown missing, damaged pan support, faulty control? | yes_no | Yes | "I noted an existing fault before starting: [detail]." | Y | Y (forced) |
| hob_additional_work | Is there anything here I could additionally clean for an extra charge? | yes_no | never | "I noticed [detail] — happy to include this for an extra charge while I'm here, if you'd like it done." | Y | Y |

**Post-Clean**

| id | question | answer_type | defect_when | issue_text | photo | note |
|---|---|---|---|---|---|---|
| hob_post_operational | All rings/burners heating/igniting correctly? | yes_no_na | No | "A ring/burner wasn't heating/igniting correctly after cleaning." | Y | Y |
| hob_post_flame_response *(gas only)* | Does each gas ring's flame respond properly across the full dial range? | yes_no_na | No | "A ring's flame wasn't responding to the dial across its full range when I checked it." | Y | Y |
| hob_post_parts_refitted | Pan supports, burner caps and crowns correctly refitted? | yes_no | No | "I found a [pan support/burner cap/crown] wasn't sitting right — corrected before leaving." | — | Y |
| hob_post_new_fault | Anything noticed now that wasn't there before? | yes_no | Yes | "I noticed something after cleaning that wasn't there before: [detail]." | Y (forced) | Y (forced) |

### Extractor Hood — shown if an extractor is present

**Pre-Clean**

| id | question | answer_type | defect_when | issue_text | photo | note |
|---|---|---|---|---|---|---|
| hood_operational | Does the fan and light currently work? | yes_no | No | "The extractor [fan/light] wasn't working when I checked it." | Y | Y |
| hood_filters | Are the grease filters present and undamaged? | yes_no | No | "The grease filter(s) were [missing/damaged] before I started." | Y | Y |
| hood_existing_faults | Any existing fault you're aware of — fan noise, damaged housing? | yes_no | Yes | "I noted an existing fault before starting: [detail]." | Y | Y (forced) |
| hood_additional_work | Is there anything here I could additionally clean for an extra charge — heavily built-up filters, similar? | yes_no | never | "I noticed [detail] — happy to include this for an extra charge while I'm here, if you'd like it done." | Y | Y |

**Post-Clean**

| id | question | answer_type | defect_when | issue_text | photo | note |
|---|---|---|---|---|---|---|
| hood_post_operational | Fan and light working? | yes_no | No | "The extractor [fan/light] wasn't working after cleaning." | Y | Y |
| hood_post_filters_refitted | Grease filters correctly refitted? | yes_no | No | "I found a filter wasn't sitting right — corrected before leaving." | — | Y |
| hood_post_new_fault | Anything noticed now that wasn't there before? | yes_no | Yes | "I noticed something after cleaning that wasn't there before: [detail]." | Y (forced) | Y (forced) |

### Microwave / Combi Microwave — shown if present

**Pre-Clean**

| id | question | answer_type | defect_when | issue_text | photo | note |
|---|---|---|---|---|---|---|
| micro_operational | Does it power on and run currently? | yes_no | No | "The microwave didn't power on when I checked it." | Y | Y |
| micro_door | Does the door close and seal properly, with glass/screen intact? | yes_no | No | "The door [wasn't sealing/glass was damaged] before I started." | Y | Y |
| micro_existing_faults | Any existing fault you're aware of — turntable, seal, display? | yes_no | Yes | "I noted an existing fault before starting: [detail]." | Y | Y (forced) |
| micro_additional_work | Is there anything here I could additionally clean for an extra charge? | yes_no | never | "I noticed [detail] — happy to include this for an extra charge while I'm here, if you'd like it done." | Y | Y |

**Post-Clean**

| id | question | answer_type | defect_when | issue_text | photo | note |
|---|---|---|---|---|---|---|
| micro_post_operational | Powers on, heats, turntable turns? | yes_no | No | "The microwave wasn't working correctly after cleaning." | Y | Y |
| micro_post_door | Door closes and seals properly? | yes_no | No | "The door wasn't closing and sealing properly after cleaning." | Y | Y |
| micro_post_new_fault | Anything noticed now that wasn't there before? | yes_no | Yes | "I noticed something after cleaning that wasn't there before: [detail]." | Y (forced) | Y (forced) |

### Universal (post-clean, always asked)

| id | question | answer_type | defect_when | issue_text |
|---|---|---|---|---|
| work_area | Work area left clean, everything removed? | yes_no | No | "The work area wasn't left as expected — noted and put right before leaving." |
| video | Record a short video showing it working | video | never | mandatory, not a defect flag |

---

## 4. Screen Specifications

All screens Chris and I worked through, in Section 7 order. S01 is included as a cut screen per the brief's own instruction for that case. Two extra screens beyond the original 28 were added during the session — **S29 (Report an Incident)** to cover a fault occurring mid-clean, which the original brief's inventory didn't account for.

### S01 — Lock / Unlock

**Cut.** Chris's own phone lock is sufficient security — no separate PIN or biometric layer inside the app. App launch goes straight to S02.

### S02 — Job list / home

**Purpose:** Chris's starting point every time he opens the app — what's on today, what's mid-job, what's still owed an upload.
**Who sees it:** Chris only.
**Reached from:** app launch. **Leads to:** S03 (new job), S16 (resume a job in progress), S22 (job history), S21 (Outbox).

**Layout, top to bottom:**
1. Header bar: LOC mark + an Outbox icon with a badge count (unsent items)
2. `+ New Job` button — large, fixed near the top
3. "In Progress" section — jobs started but not completed, showing job ID, customer name, stage paused at
4. "Today" section — jobs created for today, not yet started
5. A quiet link to full Job History (S22)

**All copy, verbatim:**
- Button: `+ New Job`
- Section headers: `In Progress`, `Today`
- Empty state: `Nothing scheduled for today.`
- In-progress subtext: `Paused at: {stage name}`
- Footer link: `View all jobs`

**States:** empty / jobs today, none in progress / one or more in progress (shown first) / Outbox badge present or absent.

**Interactions:** `+ New Job` → S03. Tap an in-progress job → resumes exactly where it left off. Tap Outbox icon → S21.

**Notes:** "Today" is only what Chris has created in the app himself — no external booking feed.

### S03 — New job — customer details

**Purpose:** Capture who's paying and how to reach them.
**Who sees it:** Chris only.
**Reached from:** S02. **Leads to:** S04.

**Layout, top to bottom:**
1. Header: `New Job`
2. Fields: Name, Address, Postcode, Phone, Email
3. `Continue`, fixed at bottom

**All copy, verbatim:**
- Title: `New Job`
- Field labels: `Name`, `Address`, `Postcode`, `Phone`, `Email`
- Button: `Continue`
- Validation (missing email): `An email address is needed to send the report.`

**States:** empty / partially filled, returned to / validation error.

**Interactions:** `Continue` validates Name and Email only, then → S04.

**Notes:** job ID (`22-{firstname}`) is assigned automatically here, continuing the existing sequence — not typed in.

### S04 — Job type selection

**Purpose:** Set domestic vs tenancy — drives the video-sharing default in S18 only. Does not change who "the customer" is; that's whoever's details went into S03.
**Who sees it:** Chris only.
**Reached from:** S03. **Leads to:** S05.

**Layout:** two large buttons, single-tap advance.

**All copy, verbatim:**
- Title: `Job Type`
- Buttons: `Domestic`, `Tenancy / Letting Agent`
- Explainer: `This sets whether the video is shared or kept — you can still change it before sending.`

### S05 — Appliance details (what's booked)

**Purpose:** Record what was quoted/booked, for the invoice and job record only.
**Who sees it:** Chris only.
**Reached from:** S04. **Leads to:** S06.

**Layout:** checkboxes/chips matching the live pricing list (Single Oven, Double Oven, Free-Standing Oven, Full/Partial Range Clean, Gas Hob, Induction Hob, Extractor Hood, Microwave, Combi Microwave, AGA/Large Range, BBQ), `Continue`.

**Notes — important:** this screen does **not** filter which checklist questions appear. Per Decision 14, every family is walked through regardless of what's ticked here — this screen is for the invoice only, and can genuinely differ from what the checklist actually covers on the same job.

### S06 — Question screen (reused for post-check as S17)

**Purpose:** Ask one checklist question, capture the answer, route to capture or the next question.
**Who sees it:** Chris only.
**Reached from:** S05 / itself. **Leads to:** itself / S07 / S08 or S09 (pre) / S19 (post).

**Layout, top to bottom:**
1. Progress indicator scoped to the current family — `Cavities — 6 of 15`
2. Back arrow
3. Question text, large
4. Help text, if present
5. Two large buttons: `Yes` / `No`
6. `N/A` text link, smaller, for `yes_no_na` questions only

**States:** first question in family / mid-family / last question / returning via back (previous answer shown) / presence-gate "No" (auto-skips its dependent block, marks N/A).

**Interactions:** answer saves instantly; routes to S07 if it matches `defect_when` or is an additional-work "Yes."

### S07 — Defect / additional work capture

**Purpose:** Capture the detail behind a flagged answer.
**Who sees it:** Chris only.
**Reached from:** S06. **Leads to:** S06.

**Layout:** coloured header band (defect red, or additional-work's own tone — see Design Direction), note field, `Add Photo` (camera direct, no gallery picker), photo thumbnails, `Save & Continue`.

**All copy, verbatim:**
- Header (defect): `Issue Found`
- Header (additional work): `Additional Work`
- Note placeholder: `What did you find?`
- Photo button: `Add Photo`
- Save button: `Save & Continue`

**Notes:** issue_text / additional-work text isn't typed here — it's the fixed sentence from Section 3, with the note dropped into `[detail]`.

### S08 — Pre-check complete, all clear

**Purpose:** Confirm nothing needs sign-off, move to cleaning.
**Who sees it:** Chris.
**Reached from:** S06 (zero defects). **Leads to:** S16.

**All copy, verbatim:**
- `Pre-check complete — nothing flagged.`
- Additional-work list header (if any): `Things I could also do while I'm here:`
- Button: `Start Cleaning`

### S09 — Pre-check complete, issues found

**Purpose:** Show the customer what was found, get their decision.
**Who sees it:** Both. Highest copy priority after S13.
**Reached from:** S06 (one or more defects). **Leads to:** S10 / S11 / S15.

**Layout, top to bottom:**
1. Brand mark, opening line
2. Each flagged issue, `issue_text`, photo inline
3. Additional-work items, in their own calmer section, clearly separate from what needs a decision
4. Two buttons

**All copy, verbatim:**
- Opening: `Hi {first name}, before I start, here's what I found:`
- Additional-work header: `Anything else I could do while I'm here:`
- Closing line: `Happy to go ahead on this basis?`
- Buttons: `Yes, go ahead` / `No, don't proceed`

**Notes:** deliberately two buttons, not three — the decline-but-proceed-anyway path lives one step deeper, at S15.

### S10 — Signature capture (customer present)

**Purpose:** One reusable signature component for every statement in the app.
**Who sees it:** Customer, on Chris's phone.
**Reached from:** S09 / S15 / S19. **Leads to:** back to whichever flow called it.

**Layout:** the statement as plain text, signature canvas with a "Sign here" watermark, `Clear` / `Confirm`, printed name and timestamp shown after confirming.

**All copy, verbatim (the three statements it carries):**
- Pre-check acceptance: `I confirm the above was found before work started, and I'm happy for Chris to go ahead.`
- Proceed-anyway: `I'd like Chris to go ahead with the clean, without confirming the details above.`
- Final sign-off (clean): `I confirm the work has been completed to my satisfaction.`
- Final sign-off (something flagged): `I confirm the work is complete and I'm aware of the item(s) noted above.`

### S11 — Customer absent — send a link

**Purpose:** Choose a channel and fire the signing link.
**Who sees it:** Chris.
**Reached from:** S09 / S15. **Leads to:** S12, then S14.

**All copy, verbatim:**
- Title: `Send for Signature`
- Buttons: `Send via WhatsApp` / `Send via Email`
- Fallback note: `Can't reach them this way? Call and read them the issue, then log it as a verbal reply on the next screen.`

**Notes:** also the screen reached for a Resend, from S14.

### S12 — Outgoing message (WhatsApp / email)

**Purpose:** Preview and send exactly what the customer will receive.
**Who sees it:** Chris reviews; customer receives.
**Reached from:** S11. **Leads to:** S14.

**All copy, verbatim — WhatsApp:**
```
Hi {first name}, it's Chris from Leicester Oven Cleaning. I've just done the pre-clean check on your appliance and found a couple of things I want you to see before I start — nothing urgent, just want your OK first. Have a look here: {link}
```

**All copy, verbatim — Email:**
- Subject: `Before I start — quick check on your oven clean`
- Body:
```
Hi {first name},

I've just done the pre-clean check at [address] and found a couple of things I want to show you before I get started — nothing urgent, I just want your OK first.

You can see what I found and let me know here: {link}

Speak soon,
Chris
Leicester Oven Cleaning
```

### S13 — Remote signing page

**Purpose:** The single most design-sensitive screen — a stranger's link, landing cold, asking for a decision.
**Who sees it:** Customer only, on their own device, plain browser.
**Reached from:** the link in S12. **Leads to:** thank-you state; updates S14.

**Layout, top to bottom:**
1. LOC brand mark, full warmth register
2. Job identifier line
3. Issues found, plain English, with photos
4. Additional-work items, own calmer section
5. Decision buttons; signature pad appears in place after `Yes, go ahead`
6. Trust footer

**All copy, verbatim:**
- Header: `A quick check before I start — from Chris at Leicester Oven Cleaning`
- Job line: `For your {appliance} at {address}`
- Opening: `Hi {first name}, I've had a look at your {appliance} before starting the clean, and wanted to show you what I found.`
- Additional-work header: `Anything else I could do while I'm here:`
- Question: `Happy for me to go ahead on this basis?`
- Buttons: `Yes, go ahead` / `No, don't proceed`
- Trust footer: `Not sure this is genuine? Call me directly on [NEEDS FACT: business phone number] and I'll talk you through it.`
- Privacy line: `This page is only for you, and it's not stored anywhere except with my own records for this job.`
- Thank-you (signed): `Thanks, {first name} — that's all I need. I'll get started now.`
- Thank-you (declined): `No problem, {first name}. I won't go ahead — I'll be in touch about next steps.`
- Already-used state: `Already responded on {date} — call me if anything's changed.`

### S14 — Waiting for signature

**Purpose:** Chris's view of an outstanding remote signature.
**Who sees it:** Chris.
**Reached from:** S12. **Leads to:** S16, once resolved.

**All copy, verbatim:**
- Status: `Waiting on {first name} — sent via {channel} at {time}`
- Button: `Resend`
- Secondary action: `Customer confirmed by message`
- Confirmation prompt: `Log that {first name} replied "yes" by message, and proceed now? The formal signature will still be collected once it comes back.`
- Log entries: `Sent via WhatsApp, 2:14pm` / `Verbal yes by phone, 2:31pm — formal request sent` / `Confirmed by message, 2:33pm — proceeding`

### S15 — Customer declined

**Purpose:** Confirm the decline, offer the genuinely separate "proceed anyway" path.
**Who sees it:** Both.
**Reached from:** S09 / S13. **Leads to:** S20 (declined) or S10/S11 (proceed anyway).

**All copy, verbatim:**
- Confirmation: `No problem — I won't go ahead today.`
- Secondary offer: `If you'd still like the clean to go ahead anyway, without confirming what I found, let me know.`
- Secondary button: `Go ahead anyway`
- No-further-action: `That's fine, I'll leave it there.`

### S16 — Job paused / cleaning in progress

**Purpose:** A safe holding state during the physical clean. The app is a check-and-signoff tool, not a cleaning guide.
**Who sees it:** Chris.
**Reached from:** S08 / S10 / S14. **Leads to:** S17.

**All copy, verbatim:**
- Status: `Cleaning in progress`
- Button: `Begin Post-Clean Check`
- Secondary action: `Report an Incident` (→ S29)

### S17 — Post-clean question screen

**Reuses S06** with the post-clean question set. **Reached from:** S16. **Leads to:** itself / S07 / S18 (on hitting `video`) / S19.

### S18 — Video capture

**Purpose:** Capture the mandatory post-clean video, with coaching, plus the sharing toggle.
**Who sees it:** Chris.
**Reached from:** S17. **Leads to:** S19.

**All copy, verbatim:**
- Coaching: `Keep it under 30 seconds. Show it powering on, the element glowing, the fan running, and the door closing properly.`
- Review prompt: `Use this video?` — `Retake` / `Use This`
- Sharing toggle: `Keep privately` / `Share with customer` (defaults from job type, S04)
- Sharing explainer: `Videos are kept for 90 days, then deleted automatically.`

### S19 — Post-check summary and final signature

**Purpose:** Show what post-clean found, capture final sign-off.
**Who sees it:** Both.
**Reached from:** S17/S18. **Leads to:** S20.

**All copy, verbatim:**
- Clean summary: `All done — nothing new found during the clean.`
- New-fault header: `Before you sign, here's what I found during the clean:`
- Sign-off statements: see S10.

**Notes:** no "decline" option here — the work's done, this is an acknowledgement.

### S20 — Job complete

**Purpose:** Confirm what's sent/queued.
**Who sees it:** Chris.
**Reached from:** S19 / S15. **Leads to:** S02.

**All copy, verbatim — completed:**
- Banner: `Job complete`
- Line: `Sending: PDF report to {customer email}, copy to your own records{, video link to customer — tenancy job}.`
- Queued note: `Queued — will send once you have signal.`

**All copy, verbatim — declined:**
- Banner: `Job recorded — no clean performed`
- Line: `Sending: pre-check record to {customer email}, copy to your own records.`

### S21 — Outbox / sync

**Purpose:** Queued items, progress, retry.
**Who sees it:** Chris.
**Reached from:** S02 / S20. **Leads to:** S02.

**All copy, verbatim:**
- Title: `Outbox`
- Empty: `Nothing waiting — everything's sent.`
- States: `Queued — waiting for signal` / `Sending… {progress}%` / `Failed — tap to retry` / `Sent`

### S22 — Job history

**Purpose:** Find a past job.
**Who sees it:** Chris.
**Reached from:** S02. **Leads to:** S23.

**All copy, verbatim:**
- Title: `Job History`
- Search placeholder: `Search by name or address`
- Empty: `No jobs yet.`

### S23 — Individual job record

**Purpose:** Full read-back of one job — check/sign-off data only, per Decision 10.
**Who sees it:** Chris.
**Reached from:** S22. **Leads to:** S22.

**Layout:** header (job ID, customer, address, date, appliances), Pre-Clean Check, Post-Clean Check, Signatures (with route each took), Video status, `Resend PDF`, and an email-edit action (added to support S27 — a bounced email has no fix without it).

**All copy, verbatim:**
- Section headers: `Pre-Clean Check`, `Post-Clean Check`, `Signatures`, `Video`
- Outstanding-signature flag: `Formal signature still outstanding — proceeded on {date} by verbal/message confirmation.`

### S24 — No signal

**Purpose:** Ambient status, not an error — the app works offline by design.
**Layout:** small persistent icon near the Outbox badge, header of every screen.
**Copy (only becomes explicit on S12):** `No signal — this will send automatically once you're back in range.`

### S25 — Upload failed / retry exhausted

**Purpose:** Repeated failure, not a single one.
**Reached from:** S21, expanded detail state of a failed item.
**All copy, verbatim:**
- `This hasn't been able to send after {n} attempts.`
- `Check your connection and try again, or leave it — it'll keep retrying automatically.`
- Buttons: `Retry Now` / `Leave It`

### S26 — Phone storage full / video too large

**Reached from:** S18, on save failure.
**All copy, verbatim:**
- `Not enough space to save this video. Free up some storage on your phone and try again.`
- `That recording's a bit large — try trimming it shorter next time.`

### S27 — Customer email bounced or missing

**Reached from:** automatic, on a bounced send; surfaces on S21 and S23.
**All copy, verbatim:**
- `The email to {customer email} bounced — check the address and resend.`
- Action: `Edit Email`

### S28 — Job abandoned part-way

**Decided:** auto-archives out of the active "In Progress" list on S02 after roughly two weeks of no activity. Never deleted — stays fully visible in Job History (S22). A manual `Cancel Job` action is also available from S16 or S23 at any time, which keeps the job in history marked cancelled.

**All copy, verbatim:**
- `Cancel Job`
- Confirmation: `Cancel this job? It'll be kept in your records as cancelled, not deleted.`

### S29 — Report an Incident (mid-clean)

**Purpose:** Capture a fault happening *during* the physical clean, isolate it, get the paying customer's informed decision on the rest of the job. Added during this session — the original inventory had no path for this, and it's the single most important real scenario the app protects against (directly from the RCD-trip and split-element incidents already in the knowledge base).
**Who sees it:** Chris captures; customer decides and signs.
**Reached from:** S16, a visible secondary action. **Leads to:** back to S16 (job continues) or S20 (job stops), as a partial-job variant.

**Layout — Step 1, capture (Chris only):** defect-red header, note field (required), `Add Photo`, the matching pre-check answer for this component shown for context if one exists, `Continue`.

**Layout — Step 2, customer notification and decision:** an editable pre-filled account (default script below), photos, decision buttons, signature pad.

**All copy, verbatim:**
- Header: `Report an Incident`
- Note prompt: `What happened?`
- Default script (editable): `Hi {first name}, the {appliance} has just tripped the electrics while I was cleaning it. I checked it over properly before I started and didn't see any damage, and my cleaning method doesn't get inside the element itself — so this looks like something already going on in there that wouldn't show from the outside. I've isolated it so it's safe, and it'll need a repair person to take a proper look.`
- Decision question: `Would you like me to continue with the rest of today's job, or stop here?`
- Buttons: `Continue with the rest` / `Stop here today`
- Sign-off (continuing): `I've been told about the issue above and I'm happy for the rest of today's job to continue.`
- Sign-off (stopping): `I've been told about the issue above and I'd like the job to stop here today.`
- Repair referral: `[NEEDS FACT: local appliance repair company referral list — to be researched and inserted]`

**States:** single-appliance job (stop = whole job stops) / multi-appliance job (stop = only unaffected work continues; the isolated component's later post-check questions get answered honestly as "not tested — isolated," never silently skipped) / customer present / customer absent (routes through S11-S14 exactly like a pre-check issue).

**Notes:** the isolation itself is automatic and non-negotiable, made by Chris, before this screen is even opened. What this screen captures is the account and the customer's decision about the *rest* of the job — never whether to isolate.

---

## 5. Documents

### PDF Report

**Length:** typically 2 pages (all-clear job), running to 4-5 with several flagged items and photos.

**Page 1:** LOC brand mark, title, job reference/date/customer/address/appliances, Pre-Clean Check (compact table, every question, not just flagged ones), any flagged issues expanded with photos, any additional-work items in a separate section.

**Page 2 (or continuing):** **Incident During Clean** (only if S29 was used — sits between pre and post so the report reads as one honest timeline), Post-Clean Check, video note, both signatures with timestamps and route (in-person/remote/verbal-then-message), footer.

**Declined-job variant:** Page 1 only, no post-check, no video.

**All copy, verbatim:**
- Title: `Oven Clean Report`
- Section headers: `Pre-Clean Check`, `Incident During Clean`, `Post-Clean Check`, `Issues Found`, `Additional Work Offered`, `Signatures`
- Video note (kept): `A short video of the appliance working was recorded after cleaning and kept for my own records. It's automatically deleted 90 days after the job.`
- Video note (shared, tenancy): `A short video of the appliance working was recorded after cleaning and sent to you separately via an expiring link. It's automatically deleted 90 days after the job.`
- Footer: `Leicester Oven Cleaning · Chris`

### Customer confirmation email

**Sent:** on job completion, PDF attached.
**Subject:** `Your oven clean is complete — job {id}`
```
Hi {first name},

All done — thanks for having me round today. I've attached the full report, including the pre and post-clean checks.

If anything doesn't look right, just reply to this email or give me a call.

Chris
Leicester Oven Cleaning
```
No review ask folded in — that already happens verbally at the walk-round per the SOP.

### Chris's own copy email

**Sent:** same time, to Chris's own address, PDF attached.
**Subject:** `Job Record — {id} — {customer name}`
```
{address}
{date}
{appliances}
{flagged: "Issues found — see attached" / "All clear"}
```

### Video link email (tenancy jobs only)

**Sent:** separately, once the video's actually uploaded from the Outbox.
**Subject:** `Video from your oven clean — job {id}`
```
Hi {first name},

Here's the video from today's clean, showing the appliance working: {link}

This link expires in 90 days, in line with how long I keep the video.

Chris
Leicester Oven Cleaning
```
Link only, never an attachment. Recipient: whoever's the paying customer, per Decision 8.

---

## 6. Design Direction

### New tokens — Pass / Defect

No green or red exists in the current palette. Two new pairs, following the existing dark/pale pattern already set by `--blue`/`--blue-pale`:

| Token | Value | Use |
|---|---|---|
| `--pass` | `#1E7A34` | Text/icons for a clear result |
| `--pass-pale` | `#E7F5EA` | Background fill behind pass states |
| `--defect` | `#B3261E` | Text/icons for a flagged defect |
| `--defect-pale` | `#FBEAEA` | Background fill behind defect states |

**Additional Work needs no new token** — it reuses `--blue`/`--blue-pale` directly, keeping it visually distinct from both pass and defect without a third colour family.

**Both new pairs need contrast verification** before shipping, the same discipline the site itself went through to reach zero WCAG failures — values chosen to clear 4.5:1 on white by a comfortable margin, but not yet formally checked.

**Colour is never the only signal** — pass gets a checkmark icon, defect an exclamation icon, additional work an info icon, both for colourblind accessibility and consistency with how the rest of the token system already treats state.

### Type scale — existing tokens, no new sizes needed

| Element | Token | Why |
|---|---|---|
| Question text | `--text-h3` (28px) | Readable at a glance, one-handed |
| Button labels | `--text-lead` (20px), bold | The highest-stakes taps in the app |
| Progress indicator | `--text-sm` (13px), `--grey-600` | Deliberately quiet |
| Help text | `--text-body` (17px) | Matches site body size |
| Customer-facing screens (S09, S13) | `--text-lead` body, `--text-h2` headers | Closer to the website's own register |

### Component notes

- **Big answer buttons:** `--radius-lg`, `--shadow-md` at rest, minimum 64px tall, `--space-4` gap.
- **Fixed bottom action bar:** `--shadow-up` — already exists specifically for this.
- **Status pills:** `--radius-pill`, `-pale` background with the dark variant as text/icon colour.
- **Photo thumbnails:** `--radius-md`, `--border` outline, `×` overlay top-right to remove.
- **Signature canvas:** `--radius-md`, `--border`, `--lightgrey` fill.
- **Camera viewfinder / capture overlay:** full-screen, `--z-modal`.
- **N/A text link:** `--text-sm`, `--grey-500`, deliberately unstyled so it never competes with the two primary answers.

---

## 7. Changes To This Brief

- **Tenancy video recipient.** The original brief (Section 4) stated a tenancy job's video goes to "both parties" (tenant and agent). Chris explicitly overrode this, twice, in his own words: whoever's paying is the only recipient of both the document and any videos, no exceptions, applied identically to domestic and tenancy. Confirmed, not a design assumption — built throughout on this rule.
- **"Advisory" reframed to "Additional Work."** The original brief's own Section 9 framed this as an MOT-style condition advisory. Chris correctly identified this as advice he's not insured to give (no professional indemnity) — reframed as a pure upsell offer of Chris's own further cleaning work, never a comment on appliance condition. Applied consistently across every family and every customer-facing screen.
- **A new screen, S29, added.** Not in the original 28-screen inventory. Added because the brief's own scenario coverage stopped at "found before I started" and "found straight after," with no path for a fault occurring *during* the physical clean — exactly the shape of the two real incidents already documented in `Post-Clean-Electrical-Faults.md`.
- **Checklist length exceeds the brief's own original 8-12 / 6-10 target.** Chris reviewed the real number (35-40 questions on a fully-loaded job) with the trade-off explained plainly, and chose to keep everything rather than cut, given the checklist scales with genuine job complexity (family-grouped, not per-cavity) rather than padding every job equally.
