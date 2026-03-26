This audit is strong, and I agree with it.

My honest read: the architecture is now **very close**, but the onboarding/routing layer is still behaving like the old adaptive system, not like the new curriculum-first system.

## Bottom line

You are correct:

* **curriculum is grade/band-owned**
* **progression is student-specific**
* but the current runtime still breaks that model at student entry and remediation

So before adding more content, I would fix exactly the 5 things you listed.

---

# My response to each point

## Problem 1 — New students do not enter a grade-aligned curriculum automatically

I agree completely.

This is the most important bug.

A first-time student with a valid grade should **never** fall into:

* `placement_band = null`
* default middle band
* adaptive session from global pool

That defeats the curriculum model immediately.

### Correct behavior

On first login, if `grade` exists:

1. derive `placement_band`
2. assign curriculum tracks for that band
3. activate starting units
4. build starter queue
5. only then serve first session

So yes — this must be fixed first.

---

## Problem 2 — Grade selection does not drive starting curriculum track properly

I agree.

One band should not imply one track total.

If you now have:

* reading tracks
* math tracks
* maybe later attention/reasoning tracks

then `assignTrack()` is now too narrow as a concept.

### Correct behavior

You need:

* `ensureTracksAssigned($student)`
  not
* `assignTrack($student, $band)`

And that should assign:

* one active student curriculum track per **domain track family**
* not just the first row returned by the DB

Also, yes, using `->first()` here is dangerous and effectively non-deterministic from a product perspective.

---

## Problem 3 — Diagnostic is disconnected from curriculum entry

I agree again.

Right now the diagnostic is behaving like:

* score some skills
* then ignore those scores for routing

That makes it much weaker than it should be.

### Correct behavior

Diagnostic or starter placement should influence:

* starting unit
* support injection
* stretch permission
* review priority

Not just band assignment.

Your proposed model is good:

* **≥ 70** → start at Unit 2
* **40–69** → start at Unit 1 normally
* **< 40** → start at Unit 1 + inject support early

That is a clean and practical first version.

I would only add one safeguard:

### Suggested refinement

Do acceleration only if:

* the domain has at least 2 units
* and the student has enough evidence quality

So for example:

* reading can accelerate
* math can accelerate
* but only when there is enough starter evidence to justify it

Otherwise, you risk over-skipping.

---

## Problem 4 — Support/review pack injection is not implemented

Yes — this is a major product gap.

You already have:

* content packs
* pack roles
* support logic conceptually

but runtime still falls back to:

* raw adaptive activity selection

That means authored support content is not actually being used.

### Correct behavior

`injectRemediationSession()` should query:

* current band
* active unit
* pack role = `support`
* matching weak skills first

and only fallback to adaptive raw generation if:

* no support pack content exists

Same for bonus:

* prefer `stretch`
* then fallback

This is a big deal because otherwise your pack authoring investment is not reaching students.

---

## Problem 5 — Multi-domain curriculum assignment is missing

Yes, this is real and important.

If the product now includes:

* reading curriculum
* math curriculum

then one student must be able to hold:

* reading track progress
* math track progress

at the same time.

### Correct behavior

A Grade 4 student should have:

* a reading track assignment
* a math track assignment

not one global track row.

So yes, `ensureTracksAssigned()` should assign **one track per domain** for the band.

---

# My recommended fix plan

Your priorities are right.
I would keep them, with a slightly more explicit implementation plan.

---

## Priority 1 — Immediate grade-driven curriculum assignment on login

This should happen before any diagnostic requirement.

### New rule

If:

* student has a grade
* student has no placement band
* or student has no track assignments

then backend should:

* resolve band from grade
* persist band
* assign all starter tracks for that band
* activate first unit in each track
* seed queue if empty

### New method

```php
PlacementService::ensureTracksAssigned(Student $student)
```

This should:

* derive and save `placement_band`
* assign all required band tracks
* initialize progress rows

This should be called from login, not only after diagnostic.

---

## Priority 2 — Diagnostic/starter results influence starting route

The diagnostic should no longer just “exist.”
It should change entry behavior.

### Recommended domain-level routing

For each domain track:

* **score >= 70**

  * mark Unit 1 completed
  * activate Unit 2
* **score 40–69**

  * activate Unit 1 normally
* **score < 40**

  * activate Unit 1
  * inject support pack/session early

### Important

Do this **per domain**, not globally.
A student may be:

* strong in reading
* weak in math

and should not be treated the same across both.

---

## Priority 3 — Multi-domain track assignment

Yes.

### Rule

At minimum, assign:

* one reading track
* one math track

for the student’s band.

Later, if you formalize attention/reasoning as full curriculum tracks too, then assign those as well.

### Implementation note

You probably want something like:

```php
CurriculumTrack::where('grade_band_id', $bandId)
    ->whereIn('domain_id', ['reading', 'math'])
```

And not just `.first()`.

---

## Priority 4 — Support/review pack injection must use `pack_role`

This should be fixed before adding much more support content.

### Remediation rule

`injectRemediationSession()` should:

1. find weak skills
2. search unlocked/active-unit support packs
3. pick activities from those packs first
4. fallback only if empty

### Bonus/stretch rule

`injectBonusSession()` should:

1. find stronger skills
2. search unlocked stretch packs first
3. fallback only if none exist

### If stretch packs do not exist yet

Then keep the adaptive fallback for stretch temporarily.

---

# Additional improvement I recommend

Your audit is right, but I’d add one more fix:

## Priority 5 — Queue should become domain-aware

Once multi-domain tracks exist, your session queue should not feel random.

You need a clear rule for how reading and math coexist in the queue.

### Recommended MVP rule

Alternate by queue slot:

* session 1 → reading
* session 2 → math
* session 3 → reading
* session 4 → math

Or:

* daily primary session = reading/mixed
* secondary optional session = math

Because once both tracks are assigned, queue logic becomes important.

Otherwise math may exist in DB but still feel invisible.

---

# My final judgment

Your audit is correct.

The content model is now ahead of the runtime behavior.

That means the next important work is **not more content first** — it is making runtime respect the curriculum system you already built.

## The real order now should be:

1. fix login-time curriculum assignment
2. fix per-domain track assignment
3. fix diagnostic-to-routing logic
4. fix support pack injection
5. fix queue behavior across reading + math
6. then continue scaling content

---

# Short answer for backend

Yes:

* **grade should drive curriculum entry immediately**
* **students should be assigned to multiple domain tracks**
* **diagnostic should influence route inside curriculum**
* **support packs must be used before raw adaptive fallback**
