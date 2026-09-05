# Pre/Post Oven Clean Checklist App — Design & Copy Brief

**For:** the AI model running the design and copy session
**From:** the Claude Code session that will build it
**Business:** Leicester Oven Cleaning (LOC), Leicester UK
**Date issued:** 5 September 2026
**Status:** nothing built yet. Architecture agreed. Design and copy outstanding — that is your job.

---

## 0. READ THIS FIRST

**Chris — the founder and sole operator — is standing by right now for the design and copy discussion.** He is expecting you. Open the conversation with him; do not produce a finished document in one shot and hand it over.

He holds all the domain knowledge (what actually goes wrong on an oven clean, what he needs to protect himself from, how a job really runs). You hold the structure. Work through it with him **a section at a time**, ask him things, and push back where his answers will cause problems in use. He responds well to being told plainly when something won't work — he has said so repeatedly.

The single biggest failure mode here is a checklist that is too long. **A 40-question checklist will not get used on a hot job at 4pm.** Aim for roughly **8–12 pre-clean questions and 6–10 post-clean questions.** If Chris wants more, your job is to make him justify each one or fold it into another.

When you are done, hand back a single document in the exact format specified in **Section 11**. That format is not a suggestion — it is what I will build from directly.

---

## 1. The business and the person

- **Trading name:** Leicester Oven Cleaning. Sole trader, pre-launch-ish — the website is live, real jobs are being done, real customers exist.
- **Chris** is the only person in the business and the only person who will ever use this app. There is no team, no admin, no second device.
- He works alone in customers' kitchens. Domestic ovens mostly, plus tenancy/end-of-tenancy cleans for letting agents.
- He is technically capable but not a developer. He reads and approves changes; he does not write code.

**Privacy rules that still apply (relaxed, but not gone):**
- His **first name "Chris" is fine anywhere.** The site is built around it.
- **Still off-limits everywhere: his full name, his photograph, his employment history.**
- Do not put any of those into app copy, PDF footers, or email signatures.

---

## 2. What the app is, in one paragraph

A private, install-to-home-screen web app on Chris's iPhone. Before he starts cleaning, he steps through a pre-clean inspection of the appliance, one question at a time. If anything is wrong — damage, a fault, something that won't come clean — the app collects it, shows the customer a plain summary of what was found, and takes their signature (on Chris's phone if they're there, or via a link sent to their own phone if they're not). He cleans. Afterwards he steps through a post-clean checklist which requires a short video of the appliance working. The customer and Chris both get a PDF record by email.

Its real purpose is **evidence and dispute protection**, and secondarily **looking professional**. It is a work tool, not a marketing surface.

---

## 3. Voice and brand rules — NON-NEGOTIABLE

These come from the live site and must not be broken.

| Rule | Detail |
|---|---|
| **First person singular** | "I", never "we". The business is one man and the site says so. This applies to everything the customer reads. |
| **Exception** | Anything contractual/legal in tone may use "we" — that is the existing convention on the legal pages. Flag it if you use it. |
| **CTA convention** | The website never says "Book Now". It says "Reserve Your Slot — I'll call to confirm". Keep that register: plain, direct, no salesy verbs. |
| **Tone** | Direct, confident, local. Personal, not corporate. Being one identifiable person is the whole advantage over the faceless franchises (Ovenu, Ovensupport). |
| **No claims** | No eco-friendly claims. No financial guarantees. No "like new" or "showroom" language — LOC has a defined, honest standard of clean and says plainly what will not come off. |
| **Never edit a customer's words** | If any customer-written text ever appears, it appears verbatim. |
| **Payment facts** | Deposit is £25, arranged by bank transfer on the confirmation call. No card details are ever taken. Balance by bank transfer or cash on the day. Do not write copy implying card payment. |

**Two audiences, two registers.** Most screens are Chris talking to himself — those can be terse and functional. A handful of screens are seen by the customer (the issues summary, the signature screen, the remote signing page, the emails, the PDF). Those need care, warmth, and the first-person voice.

---

## 4. Technical envelope — the box your design must fit inside

Design outside this box and it cannot be built. Every constraint here is load-bearing.

### Platform
- **iPhone Safari only**, added to the Home Screen (a PWA). No App Store, no Android, no desktop, no tablet.
- **Portrait only.** Design for roughly 390×844pt. Do not design landscape layouts.
- **Single user.** No accounts, no roles, no multi-user anything. Some lightweight lock (PIN or similar) because it holds customer data on a phone.

### Physical conditions of use
- Used **one-handed**, standing up, in someone else's kitchen.
- Hands may be **gloved, wet, or greasy**. Tap targets must be large and forgiving — **48px minimum**, and bigger is better. Small inline text links are effectively unusable; this has already caused a real bug on the website.
- Kitchen lighting is often bad, or there's window glare. **High contrast is a functional requirement, not an accessibility nicety.** The site was recently taken to zero WCAG contrast failures and the app must not regress from that.
- Interruptions are constant. Every screen must survive being abandoned mid-way and returned to.

### Data — the hard rule
- **No customer data may touch any third-party service.** No Google Drive, no Dropbox, no form vendor, no analytics, no cloud storage. Everything lives on Chris's own SiteGround server and on his phone. This is Chris's explicit, stated red line.
- Consequence for you: **no external CDNs at all.** No Google Fonts link, no icon libraries loaded from the web, no external CSS. Everything must be self-hosted so it also works offline. If you want an icon, it must be describable as an inline SVG I can draw.

### Offline behaviour (affects your screen list)
- The app itself works with no signal.
- Every answer saves to the phone the instant it is tapped, not on submit.
- Checklist text and signatures are tiny and upload immediately when there is any signal, or queue if there isn't.
- **Video does NOT upload at the customer's house.** It is held on the phone and sent later from an **Outbox** screen when Chris has decent signal. This is deliberate — iOS will not let a web app finish an upload in the background.
- **You must therefore design: an Outbox screen, an unsent-items badge, per-item upload progress, and a retry/failed state.** These are core screens, not edge cases.
- A job is only "complete" when the server confirms every piece landed.

### Video
- Recorded in-app at the post-clean stage. **Mandatory** — the post-check cannot be completed without it.
- Target **720p, short (aim under 30 seconds)**. Your copy must coach him to keep it short, because file size is the constraint on the whole system.
- **Kept for 90 days, then auto-deleted.** Customer-facing copy must state this honestly where relevant.
- **Sharing is per-job, not global:**
  - **Domestic job, customer present** → Chris keeps the only copy. Customer does not receive it.
  - **Tenancy / letting-agent job** → both parties get it, delivered as a **private expiring link, never an attachment**.
  - The app needs a clear toggle for this, defaulting sensibly by job type.

### Signature
- Drawn with a finger on a canvas. Needs a clear "clear and redo" action and an obvious "this is where you sign" affordance.
- **Two routes:** signed on Chris's phone with the customer present, or signed remotely by the customer on their own phone via a link sent by **WhatsApp or email**.
- The remote signing page is a **public-facing page on a customer's own device**. It is the single most design-sensitive screen in the whole project — it arrives cold, from a stranger's link, and asks someone to sign something. It needs its own copy written with real care.

### Output
- A **PDF report**, emailed to the customer and to Chris on completion.
- Email is sent from the existing LOC mail setup. Sender identity is already fixed as `hello@leicesterovencleaning.co.uk` / "Leicester Oven Cleaning".

---

## 5. Design tokens available

The site has a complete design-token system. **Reuse it.** Do not invent new colours or spacing values; if you need something that doesn't exist, say so explicitly and I'll add a token.

**Brand:** `--blue #1A3A6E` · `--gold #C9960C` · `--gold-light #e8b020` · `--white #FFFFFF` · `--lightgrey #F5F5F5` · `--offblack #1C1C2E` · `--border #e2e2e2`
There is also a `--gold-dark` for gold text on light backgrounds — plain `--gold` fails contrast on white.

**Greys:** `--grey-700 #444` · `--grey-600 #555` (body text) · `--grey-500 #666` · `--grey-400 #888` · `--grey-300 #aaa` · `--grey-200 #ccc` · `--grey-100 #e2e2e2` · `--grey-50 #F5F5F5`
**Warning:** `--grey-400` and `--grey-300` fail contrast as text on light backgrounds. Do not specify them for text.

**Blue tints:** `--blue-dark #122d58` · `--blue-darker #0f2550` · `--blue-pale #eef3fa`

**Spacing** (4px base, token number × 4 = px): `--space-1` through `--space-30`.

**Type** (px): `--text-fine 11` · `--text-xs 12` · `--text-sm 13` · `--text-ui 14` · `--text-ui-lg 15` · `--text-body-sm 16` · `--text-body 17` · `--text-body-lg 18` · `--text-lead 20` · `--text-h4 24` · `--text-h3 28` · `--text-h2 32` · `--text-h2-lg 36` · `--text-h1 40`

**Typefaces:** Montserrat 700/800 for headings, Open Sans 400/600 for body. **These must be self-hosted for the app** (see the no-CDN rule) — if that proves impractical I will substitute a system font stack, so don't build anything that depends on exact letterforms.

**Radius:** `--radius-xs 2` · `--radius-sm 4` · `--radius-md 8` · `--radius-lg 16` · `--radius-pill 20` · `--radius-full 50%`

**Shadows:** an elevation ramp exists — `--shadow-xs` through `--shadow-xl`, plus `--shadow-up` for bottom bars.

**There is a green missing.** The app needs a clear "pass / all clear" colour and a "defect / attention" colour, and the brand palette has neither. Propose them; I'll add tokens.

---

## 6. Look and feel — the direction I'd suggest, for you to challenge

It should feel like it belongs to LOC, but it must not look like the website. The website is a marketing surface with generous whitespace and a considered rhythm. This is a tool used at speed in bad light.

Starting position, argue with it if you disagree:

- **Bigger and denser than the website.** Larger type, larger targets, less decorative space.
- **One thing per screen.** The pre-check is one question at a time by design — do not put two questions on a screen "to save taps". Taps are cheap; losing your place is expensive.
- **Obvious progress.** Chris needs to know where he is and how much is left. Something persistent: "4 of 11".
- **Answers should be two big buttons**, not a toggle or a dropdown. Thumb-sized, unambiguous, hard to mis-hit.
- **Defects should be visually loud.** When something is wrong, that state should be impossible to miss on the summary.
- **Customer-facing screens should soften.** More whitespace, more warmth, closer to the website's register. The customer is being asked to sign something — it should feel considered, not like an internal form.
- **No animation that costs time.** A transition between questions is fine if it's fast. Nothing that makes him wait.

---

## 7. Screen inventory — everything needing design and copy

Work through these with Chris. For each, I need the layout described, every state enumerated, and **every string written verbatim**. Some of these he may want to cut — that's a legitimate outcome, just tell me it was a decision.

### A. Chris-facing — getting started
1. **Lock / unlock** — it holds customer data on a phone that could be lost.
2. **Job list / home** — today's jobs, jobs in progress, and the unsent-items badge.
3. **New job — customer details form** — name, address, postcode, phone, email. Which are mandatory? Email presumably must be, since the PDF goes there.
4. **Job type selection** — domestic vs tenancy/agent. Drives the video-sharing default and possibly a second recipient (the agent) alongside the customer.
5. **Appliance details** — what's being cleaned. May fold into 3.

### B. Chris-facing — the pre-clean check
6. **The question screen** — the core screen of the whole app. One question, two big answers, progress indicator, back.
7. **The defect capture screen** — shown when an answer indicates a problem. Notes, and a photo. *(Open question for Chris — see Section 9.)*
8. **Pre-check complete, all clear** — a short confirmation and a way through to "start cleaning".
9. **Pre-check complete, issues found** — customer's name, the issues listed in plain English, and the accept/decline decision. This screen is shown to the customer. **Highest copy priority after the remote signing page.**

### C. Sign-off
10. **Signature capture** — customer present, signing on Chris's phone.
11. **Customer absent — send a link** — choose WhatsApp or email, confirm the address/number, send.
12. **The WhatsApp message and the email** that carry that link — short, must not look like spam, must make clear who it's from and what it is.
13. **The remote signing page** — what the customer sees on their own phone. Branded, reassuring, states plainly what they are agreeing to and what happens next. **Design this one properly.**
14. **Waiting for signature** — Chris's view while it's outstanding. What can he do? Resend? Proceed anyway?
15. **Customer declined** — what the app says and what happens next.

### D. Chris-facing — the clean and after
16. **Job paused / cleaning in progress** — the state the job sits in while he works. Must be easy to get back into.
17. **Post-clean question screen** — reuses screen 6.
18. **Video capture** — with coaching copy: what to film, how long, why it's short. He needs to be told what a good video shows (appliance powering on, element glowing, fan running, door closing properly — confirm with him).
19. **Post-check summary and final signature.**
20. **Job complete** — confirmation, what's been sent and to whom, what's still queued.

### E. Chris-facing — records and plumbing
21. **Outbox / sync** — queued items, per-item progress, retry, and a clear explanation of why something is waiting.
22. **Job history** — past jobs, searchable by name or address. What does he actually need to find, and how?
23. **Individual job record** — the full read-back of a completed job.

### F. Error and edge states — please do not skip these
24. No signal.
25. Upload failed / retry exhausted.
26. Phone storage full or video too large.
27. Customer email bounced or missing.
28. Job abandoned part-way — does it expire? Get deleted? Sit forever?

### G. Documents
29. **The PDF report itself** — full layout and every label. What appears, in what order, on how many pages. Include: LOC branding, job reference, date, customer, appliance, both checklists with answers, issues found, both signatures with timestamps, and a note about the video (held/shared, and the 90-day retention).
30. **Customer confirmation email** — subject line and body.
31. **Chris's own copy email** — can be terser.
32. **The video link email** (tenancy jobs) — including the expiry.

---

## 8. Content to write with Chris — the checklist itself

This is the most valuable output of your session. Everything else is packaging.

**Pre-clean check.** Get from Chris the real list of what he inspects before he starts. Prompts to explore with him — do not just adopt these, they are conversation starters:
- Is the appliance operational? (his own stated example)
- Does the door close and seal properly?
- Is the door glass intact / is there staining between the panes?
- Is the interior enamel damaged, chipped, or already worn through?
- Are seals, shelves, runners, trays present and undamaged?
- Are there existing faults — dead element, broken fan, faulty light, damaged knobs/controls?
- Is the hob/extractor included, and what condition is it in?
- Is there anything that will not come clean, that the customer should know about before work starts?
- Is there safe access, working power, and hot water?
- Is the appliance safe to isolate/switch off?

**Post-clean check.** What proves the job was done and left safe:
- Appliance switched back on and working
- Element(s) heating
- Fan running
- Light working
- Door closing and sealing
- All parts refitted (shelves, runners, trays, panels)
- Work area left clean
- Any faults observed after cleaning that were not present before
- The video

**For every single question I need:**

| Field | Meaning |
|---|---|
| `id` | A stable short identifier, e.g. `pre_operational` |
| `section` | Which part of the checklist |
| `order` | Position in sequence |
| `question` | The exact wording Chris reads on screen |
| `answer_type` | `yes_no`, `yes_no_na`, `number`, `text`, `photo`, `video` |
| `defect_when` | Which answer flags a defect (e.g. "No"), or `never` |
| `issue_text` | **The exact sentence that appears on the customer's issue summary when this is flagged.** This is customer-facing copy in Chris's voice — not a repeat of the question. |
| `requires_photo` | Does flagging this force a photo? |
| `requires_note` | Does flagging this force a written note? |
| `help_text` | Optional one-line clarification shown under the question |
| `required` | Can it be skipped? |

The `issue_text` column is the one people forget and it is the one that matters most. "Door seal damaged" is a question label. What the customer needs to read is a sentence in Chris's voice explaining what he found and what it means for the clean.

---

## 9. Open decisions Chris must make

Get answers to all of these. Each one changes what I build.

1. **Should the pre-check take photos?** My strong recommendation is yes for any flagged defect. A photo of a pre-existing chip or a cracked seal is worth vastly more than a "No" if a customer later says he caused it. Confirm whether it's optional or forced.
2. **Absent customer — does he crack on, or wait for the signature?** Changes whether the app hard-blocks at that step or just flags the job.
3. **If a customer declines the work after issues are found** — does the job stop dead, or is there a "declined, but proceeding at customer's request" path that still gets recorded and signed?
4. **What identifies a job?** A reference number he can quote? Customer surname plus date? Needs to be something he can find later.
5. **Does the job link to an existing booking?** The website already takes reservations and holds customer details. Pulling those in saves retyping — but is he always working from a booking, or does he sometimes turn up to an ad-hoc job?
6. **Tenancy jobs — who is the customer?** The tenant, the landlord, or the agent? Who signs? Who gets the PDF? Possibly more than one recipient.
7. **Retention of the record itself.** The video goes at 90 days — confirmed. But the PDF and checklist data are business records and probably want keeping much longer. How long?
8. **What happens if he has no phone signal at the customer's house AND the customer is absent?** The signing link can't be sent. What does he do?

---

## 10. Do not do these things

- **Do not write code.** No HTML, no CSS, no JS. I own implementation. Describe layouts in words, tables, or ASCII sketches.
- **Do not propose any third-party service.** Not for storage, not for e-signature, not for PDF generation, not for email, not for analytics, not for fonts or icons. If you think one is genuinely unavoidable, flag it as a question — do not design around it.
- **Do not design for anything but a portrait iPhone.**
- **Do not invent prices, services, guarantees or policies.** If copy needs a fact you don't have, mark it `[NEEDS FACT: ...]` and ask Chris.
- **Do not describe copy — write it.** "A friendly message reassuring the customer" is useless to me. Give me the sentence.
- **Do not let the checklist sprawl.** See the warning at the top.
- **Do not make it look like the website.** It's a tool.

---

## 11. HOW TO HAND IT BACK TO ME

**One markdown document.** Not several files, not a slide deck, not a spreadsheet. Plain markdown that can be pasted into a Claude Code session.

Use exactly these top-level sections, in this order:

```
1. Decisions Made          — what Chris settled, one line each, including his answers to Section 9
2. Open Questions          — anything unresolved, with your recommendation on each
3. Checklist Content       — the full question tables (see below)
4. Screen Specifications   — one block per screen, in the Section 7 order
5. Documents               — PDF layout, and all email/WhatsApp copy
6. Design Direction        — palette additions, type scale, component notes
7. Changes To This Brief   — anything here you and Chris decided to overrule, and why
```

### Format for Section 3 — Checklist Content

A markdown table per checklist (pre and post), with **one row per question and every column from Section 8 filled in**. Do not abbreviate. If a field doesn't apply, write `—`.

### Format for Section 4 — Screen Specifications

One block per screen, exactly like this:

```
### S06 — Pre-check question screen

**Purpose:** one sentence.
**Who sees it:** Chris / customer / both.
**Reached from:** S05. **Leads to:** S06 (next question), S07 (if defect), S08/S09 (if last).

**Layout, top to bottom:**
1. Progress indicator — "Question 4 of 11"
2. ...

**All copy, verbatim:**
- Progress label: `Question {n} of {total}`
- Primary button: `Yes`
- ...

**States:** default / first question (no back) / last question / answer already given (returning via back)
**Interactions:** what each tap does, including back and accidental double-tap.
**Notes:** anything I need to know that isn't obvious.
```

Every screen from Section 7 gets one of these, even the boring ones. If a screen was cut, include the block with a single line saying it was cut and why.

### Rules for the handback

- **Verbatim copy in backticks or fenced blocks.** Never paraphrase a string.
- **Mark every item `[DECIDED]` or `[SUGGESTED]`.** I need to know what Chris actually signed off versus what you proposed and he hasn't seen. Do not blur the two.
- **Mark unknowns `[NEEDS FACT: ...]`.** Better an honest gap than an invented figure.
- **Give me stable IDs** — screen IDs (`S01`…) and question IDs (`pre_operational`). I will use them as-is in the code, so once assigned they should not change.
- **Wireframes are welcome** as ASCII sketches inside fenced blocks, or as images if you can produce them. Words are fine too — a clear description beats a vague picture.
- **Length is not a problem.** Completeness is. A long document I can build from directly is far better than a short one that sends me back with questions.

---

## 12. What happens next

Chris pastes your document back into this Claude Code session. I will:

1. Read it and come back with anything genuinely blocking — I'll try to make sensible calls on the rest rather than stalling.
2. Build in stages so it's usable early: customer details + pre-check + signature first; then the clean/post-check + video; then the Outbox, history and PDF polish.
3. Test it against a real job in aeroplane mode before Chris relies on it.

Cost target is **£0/month** and it stays that way. Nothing in your design should introduce a bill.

**Chris is waiting. Start the conversation.**
