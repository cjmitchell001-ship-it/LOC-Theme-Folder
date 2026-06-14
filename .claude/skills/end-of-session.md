# Skill: End of Session — CLAUDE.md Update

## When to use this skill
When the user says any of the following:
- "end of session"
- "that's a wrap"
- "session done"
- "update the project memory"
- "update claude.md"

## What to do

### Step 1 — Review what happened this session
Before writing anything, mentally summarise:
- Which files were read, edited, or created
- What problems were identified and how they were solved
- What decisions were made (even small ones)
- What was tried and abandoned, and why
- What is now confirmed that was previously uncertain
- What new conventions or patterns were established

### Step 2 — Read the current CLAUDE.md
Always read the existing CLAUDE.md before making any changes. Never overwrite blindly.

### Step 3 — Update CLAUDE.md with a surgical diff mindset
Only update what actually changed. Do not rewrite sections that are still accurate.

**Add to CLAUDE.md if:**
- A decision that was "under consideration" is now confirmed or dropped
- A new file was created that needs to be in the file structure table
- A new CSS class, JS function, or pattern was established that future work needs to know about
- A bug was found and fixed — record what it was and the fix pattern so it isn't reintroduced
- A technical constraint was discovered (e.g. `overflow-x: hidden` on html/body breaks `position: sticky`)
- A rule was established during the session ("never do X", "always do Y")
- The status of an outstanding item changed (completed, dropped, deferred)

**Do NOT add to CLAUDE.md:**
- Business strategy discussions or evolving ideas
- Pricing figures (still placeholder until confirmed)
- Things that are still uncertain or under consideration
- Detailed session narrative — that belongs in the version context doc, not CLAUDE.md
- Anything the user said "we'll decide later" about

### Step 4 — Update the Outstanding Items section
CLAUDE.md should have an Outstanding Items section. After each session:
- Mark completed items as ✅ with a one-line note of what was done
- Add any new outstanding items discovered during the session
- Remove items that are no longer relevant
- Reorder by current priority if priorities shifted

### Step 5 — Update the "Last updated" line
Always update the timestamp at the top of CLAUDE.md so it's clear how current it is.

### Step 6 — Ask about the version context doc
After updating CLAUDE.md, ask:
"Do you want me to also flag what should go into the next version of the project context document (V11 etc.)? I can summarise what changed this session in a format ready to hand to a chat assistant."

This keeps the two documents in sync — CLAUDE.md as the live working rules, the version doc as the full project history.

---

## What CLAUDE.md is for (reminder)

CLAUDE.md is **standing orders** — the rules and current state that every Claude Code session needs to know immediately without reading the whole project history. It should answer:

- What does this project do?
- What files exist and what do they do?
- What are the hard rules I must never break?
- What conventions does this codebase use?
- What is currently outstanding?
- What should I never assume or guess about?

It is **not** a project diary, a business plan, or a record of every decision ever considered. Keep it lean, current, and actionable.

---

## Format rules for CLAUDE.md updates

- Use tables for file lists and status tracking — easier to scan than prose
- Use ✅ / 🔄 / ❌ / ⚠️ for status (complete / in progress / not started / blocked)
- Bold the actual rule when stating a rule: **Never use `position: sticky` on elements inside `overflow-x: hidden` containers**
- Keep explanations short — one sentence is enough for most things
- If something needs more than two sentences to explain, it probably belongs in the version context doc, not CLAUDE.md

---

## Red lines — never do these when updating CLAUDE.md

- Never remove a hard technical rule without explicit instruction from the user
- Never mark something as complete unless it was actually completed this session
- Never add pricing figures as confirmed — they remain placeholder until the user explicitly confirms them
- Never remove the "this is an evolving project" note — it should always be present
- Never make the file longer than necessary — if something is no longer relevant, remove it rather than adding more
