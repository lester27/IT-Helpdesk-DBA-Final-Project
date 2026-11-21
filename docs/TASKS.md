# Task Assignments

Each member owns specific files. The owner is also written at the top of every file (`OWNER:`).
Create one GitHub Issue per checkbox (use the **Task** issue template) and assign it to the owner.

| Member | Area | Files |
|---|---|---|
| **Lester** (Team Lead) | Ticket Workflow & Integration | `tickets/index.php`, `tickets/view.php`, `tickets/update.php`, `tickets/assign.php`, `includes/helpers.php` |
| **Myrson** | Database & Report Queries | `database/*`, `includes/db.php`, queries for `dashboard.php` and `reports/index.php` |
| **Harold** | Users, Skills & Equipment Records | `includes/auth.php`, `users/index.php`, `users/form.php`, `users/skills.php`, `equipment/form.php` |
| **Miguel** | Equipment Pages, Departments & Site Layout | `equipment/index.php`, `equipment/view.php`, `departments/index.php`, `includes/header.php`, `includes/navbar.php`, `errors/403.php` |
| **Lauren** | Dashboard, Reports Page & Ticket Form | `login.php` (design), `tickets/create.php`, `dashboard.php` (layout), `reports/index.php` (layout), `assets/css/style.css` |

### Pairs
Some pages are shared. The pairs below work together:

- **Myrson + Lauren:** dashboard and reports. Myrson writes the PHP that loads the data into arrays (`$workload`, `$sla`, …). Lauren builds the Bootstrap cards, tabs and tables that display them.
- **Lester + Lauren:** tickets. Lauren's create form must match the fields Lester's list and detail pages expect.
- **Harold + Miguel:** equipment. Harold's form saves the records and Miguel's list and detail pages show them.

---

## Lester: Ticket Workflow & Integration
**Week 1**
- [x] GitHub setup: protect `main`, create Issues from this file, Project board (To Do / In Progress / Review / Done)
- [x] Make sure everyone has the project running locally (by Nov 15)

**Week 2**
- [x] `tickets/index.php`: role-based query (Employee = own, Technician = assigned/all, Admin = all + unassigned), filters, SLA badge
- [x] `tickets/view.php`: load ticket + joins + `v_ticket_sla`, access check, timeline from `ticket_updates`

**Week 3**
- [x] `tickets/update.php`: comments (BR9); status changes in a transaction, next status only (BR16), lock resolved tickets (BR18), set `resolved_at`
- [x] `tickets/assign.php`: Admin only, active + qualified technician (BR17), history row, transaction

**Week 4**
- [ ] Integration testing across all modules, demo script, tag `v1.0`

**Every week:** review and merge PRs, run the Monday sync.

## Myrson: Database & Report Queries
**Week 1**
- [x] Review `01_schema.sql` line by line against the data dictionary and ERD
- [x] Test trigger `trg_tickets_bi`: insert a ticket per priority and confirm `due_at`
- [x] Test view `v_ticket_sla`: confirm seed data shows On Track / At Risk / Breached / Met

**Week 2**
- [ ] Test every constraint (bad role, duplicate serial, deleting a referenced user, …) and record the results with screenshots for the paper
- [ ] Verify R1–R5 in `03_reports.sql`
- [ ] `reports/index.php`: write the PHP that runs R2–R5 into `$sla`, `$workload`, `$recurring`, `$slow` (hand off to Lauren)

**Week 3**
- [ ] `dashboard.php`: write the data-loading PHP for each role (counts, my tickets, workload, recurring alert) (hand off to Lauren)
- [ ] `database/04_security.sql`: application MySQL user with only SELECT / INSERT / UPDATE (no DELETE / DROP)
- [ ] Backup and restore guide using `mysqldump` (`docs/BACKUP.md`)

**Week 4**
- [ ] Fix the database sections of the paper (see [PAPER-FIXES.md](PAPER-FIXES.md))
- [ ] Help teammates with SQL questions

## Harold: Users, Skills & Equipment Records
**Week 1**
- [x] `attempt_login()` + basic login is already done. **Review it** and check that inactive `tech.old` cannot log in (BR4)

**Week 2**
- [ ] `users/index.php`: list + filters (role, department, active), activate/deactivate toggle via POST, never delete (BR4), can't deactivate yourself
- [ ] `users/form.php`: create/edit, `password_hash()`, blank password on edit keeps the old one, friendly errors for duplicate username/email (BR1–BR3)

**Week 3**
- [ ] `users/skills.php`: checkbox editor for `technician_skills`, saved in a transaction
- [ ] `equipment/form.php`: create/edit, unique serial error (BR13), holder ↔ status consistency (BR14), retired equipment can't have a holder (BR19)

**Week 4**
- [ ] Test the user, skills and equipment rules from [PAGES.md](PAGES.md)

## Miguel: Equipment Pages, Departments & Site Layout
**Week 1**
- [ ] `includes/navbar.php`: highlight the current page's link (`active` class)
- [ ] `errors/403.php` and `includes/footer.php`: final look

**Week 2**
- [ ] `departments/index.php`: table of departments with user count, "Add department" form, rename form (no delete)
- [ ] `equipment/index.php`: equipment table, status badges, highlight expired warranty, filters

**Week 3**
- [ ] `equipment/view.php`: detail card + table of tickets for that equipment + "Recurring issue" badge (BR15)

**Week 4**
- [ ] Run the full test checklist in [PAGES.md](PAGES.md) with every demo account and open an Issue for each bug found

## Lauren: Dashboard, Reports Page & Ticket Form
**Week 1**
- [ ] `login.php`: design the login page (card, title/logo, spacing). The login logic already works
- [ ] Sketch (on paper or Figma) what each dashboard looks like for Employee, Technician and Admin

**Week 2**
- [ ] `tickets/create.php`: the "Report a Problem" form (title, description, category, priority, equipment) + INSERT. Don't send `due_at` (the trigger sets it)

**Week 3**
- [ ] `dashboard.php`: Bootstrap cards and tables for each role, using Myrson's data
- [ ] `reports/index.php`: Bootstrap tabs with one table per report, using Myrson's data, plus a Print button

**Week 4**
- [ ] Consistency pass across all pages (same badge colors, button styles, page titles, empty-table messages)
- [ ] Take screenshots of every page for the paper's system chapter
