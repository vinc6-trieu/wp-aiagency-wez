# aiagency-wez

Classic WordPress starter theme for Local on macOS. This theme uses standard PHP templates and Advanced Custom Fields (ACF) so editors can build Pages by selecting a Page Template and filling in matching custom fields.

## Typography

- The theme sets **`html { font-size: 14px }`** and **`body { font-size: 1rem }`**, so **`1rem = 14px`** (~2px smaller than a typical 16px base). Sizes defined in `rem` or `clamp(..., rem, ...)` in `style.css` follow this root.
- Vertical padding between major front-page stripes (`.home-section`, `.section`, and `.home-v1-section--*`) is tuned with responsive rules; the Home V1 hero stays compact. **Our core competencies** (`.home-v1-section--competencies`) now follows the same **stripe padding** as **About / Team / Contact** (`3.75rem` vertical on large screens, shared `2rem` rule in the **≤860px** breakpoint), uses **`var(--aiagency-wez-home-v1-bg)`** (`#F8F9FE`), and mirrors **Problems we solve**: one `.home-v1-shell`, centered column flex **`gap: clamp(1.5rem, 3vw, 2.5rem)`**, list **`max-width: 48rem`**, closing copy up to **`58rem`**, list row gap **`1.625rem`**, and the global **`.home-v1-section-heading**` styles (no section-specific heading overrides). **What problems we solve** still uses **smaller** vertical padding than those sections.

## File Structure

```text
aiagency-wez/
├── assets/
│   ├── home-page-background.png  (Home template full-page backdrop)
│   ├── js/
│   │   ├── home-v1-reveal.js     (Home V1 section scroll animations)
│   │   ├── home-v1-smooth-nav.js (same-page #anchors, no full reload; path aliases from PHP when the home page is reachable at more than one pathname)
│   │   └── site-header-menu.js   (primary nav toggle ≤899px; enqueued on all front-end pages)
│   └── logo.png                   (Default site logo; replace or use Customizer)
├── footer.php
├── functions.php
├── header.php
├── index.php
├── page.php
├── README.md
├── style.css
├── page-templates/
│   ├── template-about.php
│   ├── template-contact.php
│   ├── template-home.php
│   ├── template-landing.php
│   ├── template-home-v1.php
│   └── template-welcome-page.php
└── template-parts/
    └── sections/
        ├── cta.php
        ├── features.php
        ├── hero.php
        └── home/
            ├── contact.php
            ├── hero.php
            ├── projects.php
            ├── what-we-do.php
            └── who-we-are.php
```

## Logo

- The header shows **`assets/logo.png`** by default (linked to the homepage, with the site name as `alt` text). On the **Home** template, logo height is **`--aiagency-wez-home-nav-pill-height` × `--aiagency-wez-home-logo-canvas-scale`** (defaults **`6.5`**, or **`4.9`** under 768px); pill height includes menu text at **`calc(var(--aiagency-wez-home-nav-link-font-size) + 2px)`**. The Home header strip uses **`0.3rem`** vertical padding on **`.site-header__inner`**. On **Home V1**, **`--home-v1-header-logo-max-height`** is **`5rem`** (**`4.125rem`** under 560px) with **`--home-v1-header-inner-pad-y`** **`0.25rem`** and matching **`min-height`**. Other templates use **`.site-branding__logo`** **`clamp(3.375rem, 10vw, 5.125rem)`** on a **`0.25rem`**-padded **`.site-header__inner`**.
- Primary menu link sizes: default **`.main-navigation a`** uses **`calc(1rem + 2px)`**; **Home** pill links **`calc(0.9rem + 2px)`**; **Home V1** **`.main-navigation--home-v1 a`** uses **`calc(0.875rem + 2px)`**.
- **Mobile menu (≤899px):** **`[header.php](header.php)`** outputs a **`.site-header__menu-toggle`** button and wraps the primary **`nav`** (and Home V1 CTA) in **`#site-header-primary-menu.site-header__menu-panel`**. **`[assets/js/site-header-menu.js](assets/js/site-header-menu.js)`** toggles **`site-header--nav-open`** on **`.site-header`**, updates **`aria-expanded`**, closes on **Escape**, viewport widen, or navigating via a link inside the panel. At **`min-width: 900px`** the panel is a **`flex: 1`** row aligned to the end of the header so branding stays left and navigation stays right.
- To use a different image without replacing that file, go to **Appearance → Customize → Site Identity** and set **Logo** (theme supports `custom-logo`).

## Home V1 hero portrait

- **Tablet / narrow desktop (`min-width: 768px` and `max-width: 1120px`):** the hero inner wrapper (`.home-v1-shell.home-v1-hero`, one element with both classes) uses **`display: flex`**, **`flex-direction: row`**, and **`justify-content: space-between`** so headline column and portrait column stay separated; **`min-width: 0`** on the text column avoids flex overflow clipping.
- The **hero banner** (`.home-v1-section--hero`) uses a shared **`--home-v1-header-height`** token so its first-load size is the visible viewport minus the sticky header: **`min-height: calc(100vh - var(--home-v1-header-height))`** with a modern **`100svh`** override, plus vertical centering and the existing layered gradient/image background treatment.
- The hero figure (portrait image in `.home-v1-hero__visual-frame`) now respects **`--home-v1-hero-portrait-max-height`** directly by capping frame width with that height-derived value, so the portrait shrinks before the section overflows the first screen. Short-height breakpoints further reduce hero padding, gaps, type sizing, button height, and stat-card insets so common laptop and phone viewports keep the full banner visible beneath the sticky header.

## Installation

1. Open your Local site on macOS.
2. Place this theme in `app/public/wp-content/themes/aiagency-wez`.
3. Start the site in Local.
4. In WordPress admin, go to `Appearance > Themes`.
5. Activate `aiagency-wez`.

## What This Theme Does

The theme follows this workflow:

1. Create a normal WordPress Page.
2. Assign one of the custom Page Templates in the Page editor.
3. Fill in the matching ACF fields for that Page.
4. View the Page on the frontend.
5. The selected PHP template reads the ACF data with `get_field()` and renders the UI.

Your layout and styling live in the theme files. The WordPress admin only supplies content.

## ACF Plugin Setup

1. Install and activate the `Advanced Custom Fields` plugin.
2. For the Home Page template, this theme includes an ACF JSON sync file at [`acf-json/group_aiagency_wez_home_page.json`](/Users/vincent6/Local%20Sites/wp-base/app/public/wp-content/themes/aiagency-wez/acf-json/group_aiagency_wez_home_page.json).
3. In WordPress admin, go to `Custom Fields` and look for the `Sync available` notice. Sync `Home Page Template` to import all Home Page fields automatically.
4. Create the remaining field groups manually, or create one field group for each template if you prefer.
5. Set each field group location rule to show when:
   - `Page Template` is equal to `Home Page`, or
   - `Page Template` is equal to `Landing Page`, or
   - `Page Template` is equal to `About Page`, or
   - `Page Template` is equal to `Contact Page`
6. Use the exact field names listed below.

## Required Field Names

### Home Page

Use these fields for Pages assigned to the `Home Page` template in [`page-templates/template-home.php`](/Users/vincent6/Local%20Sites/wp-base/app/public/wp-content/themes/aiagency-wez/page-templates/template-home.php).

| Field Name                  | Recommended Type | Notes                                |
| --------------------------- | ---------------- | ------------------------------------ |
| `home_hero_eyebrow`         | Text             | Small text above the main title      |
| `home_hero_title`           | Textarea         | Large hero headline                  |
| `home_hero_image`           | Image            | Main character/agent image           |
| `home_hero_primary_text`    | Text             | Primary hero button label            |
| `home_hero_primary_link`    | URL              | Primary hero button link             |
| `home_hero_secondary_text`  | Text             | Secondary hero button label          |
| `home_hero_secondary_link`  | URL              | Secondary hero button link           |
| `home_services_title`       | Text             | Section heading                      |
| `home_services_intro_image` | Image            | Intro image for What We Do           |
| `home_services_intro_text`  | Textarea         | Introductory paragraph               |
| `home_services_cta_text`    | Text             | What We Do button label              |
| `home_services_cta_link`    | URL              | What We Do button link               |
| `service_1_image`           | Image            | Service card 1 image                 |
| `service_1_title`           | Text             | Service card 1 title                 |
| `service_1_text`            | Textarea         | Service card 1 text                  |
| `service_2_image`           | Image            | Service card 2 image                 |
| `service_2_title`           | Text             | Service card 2 title                 |
| `service_2_text`            | Textarea         | Service card 2 text                  |
| `service_3_image`           | Image            | Service card 3 image                 |
| `service_3_title`           | Text             | Service card 3 title                 |
| `service_3_text`            | Textarea         | Service card 3 text                  |
| `home_services_banner_text` | Textarea         | Wide message banner text             |
| `home_projects_title`       | Text             | Projects section title               |
| `project_1_image`           | Image            | Project image 1                      |
| `project_1_title`           | Text             | Optional overlay label               |
| `project_2_image`           | Image            | Project image 2                      |
| `project_2_title`           | Text             | Optional overlay label               |
| `project_3_image`           | Image            | Project image 3                      |
| `project_3_title`           | Text             | Optional overlay label               |
| `project_4_image`           | Image            | Project image 4                      |
| `project_4_title`           | Text             | Optional overlay label               |
| `project_5_image`           | Image            | Project image 5                      |
| `project_5_title`           | Text             | Optional overlay label               |
| `home_about_title`          | Text             | Who We Are heading                   |
| `home_about_image`          | Image            | About section image                  |
| `home_about_intro`          | Textarea         | About section lead copy              |
| `home_about_points`         | Textarea         | One bullet point per line            |
| `home_team_title`           | Text             | Team grid heading                    |
| `team_member_1_image`       | Image            | Member 1 image                       |
| `team_member_1_name`        | Text             | Member 1 name                        |
| `team_member_1_role`        | Text             | Member 1 role                        |
| `team_member_2_image`       | Image            | Member 2 image                       |
| `team_member_2_name`        | Text             | Member 2 name                        |
| `team_member_2_role`        | Text             | Member 2 role                        |
| `team_member_3_image`       | Image            | Member 3 image                       |
| `team_member_3_name`        | Text             | Member 3 name                        |
| `team_member_3_role`        | Text             | Member 3 role                        |
| `team_member_4_image`       | Image            | Member 4 image                       |
| `team_member_4_name`        | Text             | Member 4 name                        |
| `team_member_4_role`        | Text             | Member 4 role                        |
| `home_contact_title`        | Textarea         | Large contact CTA title              |
| `home_contact_label`        | Text             | Small contact label                  |
| `home_contact_link_text`    | Text             | Contact button text                  |
| `home_contact_link_url`     | URL              | Contact button URL or `mailto:` link |
| `home_contact_visual_image` | Image            | Contact section visual               |

### Home Page — Version 1

Use [`page-templates/template-home-v1.php`](/Users/vincent6/Local%20Sites/wp-base/app/public/wp-content/themes/aiagency-wez/page-templates/template-home-v1.php) with ACF group [`acf-json/group_aiagency_wez_home_page_v1.json`](/Users/vincent6/Local%20Sites/wp-base/app/public/wp-content/themes/aiagency-wez/acf-json/group_aiagency_wez_home_page_v1.json) (sync in **Custom Fields**). [`page-templates/template-welcome-page.php`](/Users/vincent6/Local%20Sites/wp-base/app/public/wp-content/themes/aiagency-wez/page-templates/template-welcome-page.php) is an alternate template label that renders the same sections and `home_v1_*` fields. Competency rows support optional icon images:

**Section visibility:** On Home V1, each main stripe is output only when its primary **title** field is non-empty after trimming—**Hero** (`home_v1_hero_title`), **Core competencies** (`home_v1_competencies_title`), **Problems we solve** (`home_v1_problems_title`), **Projects** (`home_v1_projects_title`, and at least one project row), **Who we are** (`home_v1_who_title`), **Team** (`home_v1_team_title`), and **Contact** (`home_v1_contact_title`). Other fields alone do not render a section.

The **Home V1 footer** lives in [`footer.php`](/Users/vincent6/Local%20Sites/wp-base/app/public/wp-content/themes/aiagency-wez/footer.php). It renders three menu columns titled **Explore**, **Connect**, and **Legal**, plus a contact card on the right. Each column supports up to **five** ACF **Link** fields (`home_v1_footer_primary_link_*`, `home_v1_footer_secondary_link_*`, `home_v1_footer_legal_link_*`). When a column has at least one link set, that list is used; otherwise **Explore** falls back to the theme primary menu, **Connect** to fixed section anchors, and **Legal** to auto-detected privacy/terms pages. Link fields are **free ACF**–compatible (no repeater). The footer email uses `home_v1_contact_email_value`, LinkedIn uses `home_v1_footer_social_linkedin_url`, and the embedded map appears automatically when `home_v1_footer_address` is filled.

| Field Name | Type | Notes |
| ---------- | ---- | ----- |
| `home_v1_footer_copy` | Textarea | Brand/supporting copy under the footer logo |
| `home_v1_footer_primary_link_1` … `home_v1_footer_primary_link_5` | Link | Optional Explore column; replaces primary menu when any is set. |
| `home_v1_footer_secondary_link_1` … `home_v1_footer_secondary_link_5` | Link | Optional Connect column; replaces default anchors when any is set. |
| `home_v1_footer_legal_link_1` … `home_v1_footer_legal_link_5` | Link | Optional Legal column; replaces auto-detected pages when any is set. **BREAKING:** Replaces repeater `home_v1_footer_legal_links`. |
| `home_v1_footer_social_linkedin_url` | URL | Public LinkedIn profile or company page |
| `home_v1_footer_address` | Textarea | Optional. When filled, the footer shows an embedded map automatically |

Legacy footer heading / Instagram fields remain in ACF JSON for backward compatibility, but the current footer layout does not render them.

| Field Name                  | Type  | Notes                                 |
| --------------------------- | ----- | ------------------------------------- |
| `home_v1_competency_1_icon` | Image | Replaces default SVG for competency 1 |
| `home_v1_competency_2_icon` | Image | Replaces default SVG for competency 2 |
| `home_v1_competency_3_icon` | Image | Replaces default SVG for competency 3 |

If an icon field is empty, the theme shows a built-in SVG (white circle, **2px** `#0A5B8C` border, solid check) so each competency row still has an icon treatment.

The **Problems we solve** block renders between competencies and projects when `home_v1_problems_title` is set (see **Section visibility** above); bullets and the quote still appear when `home_v1_problem_*` / `home_v1_problems_quote` are filled. Markup lives in [`template-parts/sections/home-v1/problems-we-solve.php`](template-parts/sections/home-v1/problems-we-solve.php) (`#problems-we-solve`). Empty problem lines are skipped so you can use fewer than six bullets.

The **Projects** block (`#our-projects`, [`template-parts/sections/home-v1/projects.php`](template-parts/sections/home-v1/projects.php)) requires `home_v1_projects_title` and at least one project card (see **Section visibility**). It uses a four-column grid on large screens, two columns up to **1120px**, and a **horizontal scroll-snap** row at **860px width and below** (CSS only; swipe or trackpad scroll). The track is wrapped in `.home-v1-projects-scroll` with edge-aligned padding; a `.screen-reader-text` hint names the region for assistive tech. Card overlays use a stronger default gradient on those small viewports so copy stays readable without hover.

**Project popups:** If a project has a non-empty `home_v1_project_*_description`, clicking the **project image** opens a modal popup showing the description. The “View Case Study” link continues to navigate normally (no popup). Behavior is implemented in `assets/js/home-v1-projects-modal.js`.

| Field Name | Type | Notes |
| ---------- | ---- | ----- |
| `home_v1_projects_title` | Text | Section heading |
| `home_v1_projects_intro` | Textarea | Optional intro paragraph |
| `home_v1_projects_all_link_text` / `home_v1_projects_all_link_url` | Text / URL | Optional “View all projects” inline link |
| `home_v1_project_1_category` … `home_v1_project_4_category` | Text | Optional label shown above title |
| `home_v1_project_1_title` … `home_v1_project_4_title` | Text | Project title |
| `home_v1_project_1_description` … `home_v1_project_4_description` | Textarea | Popup body copy (when non-empty) |
| `home_v1_project_1_image` … `home_v1_project_4_image` | Image | Card image |
| `home_v1_project_1_link_text` … `home_v1_project_4_link_text` | Text | Optional case study link label |
| `home_v1_project_1_link_url` … `home_v1_project_4_link_url` | URL | Optional case study link destination |

| Field Name | Type | Notes |
| ---------- | ---- | ----- |
| `home_v1_problems_title` | Text | Section heading (uses `.home-v1-section-heading__title` styles) |
| `home_v1_problem_1_text` … `home_v1_problem_6_text` | Text | One bullet each; non-empty fields only are shown |
| `home_v1_problems_quote` | Textarea | Centered pull quote below a light top border |

The **Team** block (`#team`, [`template-parts/sections/home-v1/team.php`](template-parts/sections/home-v1/team.php)) uses a split heading (title with highlight + rule, intro), then a two-column row: framed featured image and an “Our Expertise” checklist. **BREAKING:** Per-member fields (`home_v1_team_member_*`) were removed; re-enter content under the fields below after syncing ACF JSON.

| Field Name | Type | Notes |
| ---------- | ---- | ----- |
| `home_v1_team_title` | Text | Main section heading |
| `home_v1_team_intro` | Textarea | Intro under the heading |
| `home_v1_team_featured_image` | Image | Left column; if expertise lines exist and this is empty, a placeholder fills the frame |
| `home_v1_team_expertise_heading` | Text | Subheading above the list (defaults to “Our Expertise” when the heading is empty but lines exist) |
| `home_v1_team_expertise_1_text` … `home_v1_team_expertise_6_text` | Text | One bullet each; empty fields are skipped |

The section renders when `home_v1_team_title` is set (see **Section visibility**); intro, featured image, and expertise lines still display beneath the heading when configured.

The **Contact** block (`#contact-us`, [`template-parts/sections/home-v1/contact.php`](template-parts/sections/home-v1/contact.php)) uses a horizontal gradient background, a two-column layout (≈96px gap on large screens), a framed portrait card with a glass “system status” bar, and a headline stack plus form. **`home_v1_contact_title` is required** for the block to appear (see **Section visibility**). **Layout note:** `home_v1_contact_phone_*` and `home_v1_contact_email_label` are kept in ACF but are not rendered in this section; `home_v1_contact_email_value` is used by the Home V1 footer contact card when filled.

| Field Name | Type | Notes |
| ---------- | ---- | ----- |
| `home_v1_contact_eyebrow` | Text | Small uppercase label (e.g. AI Agent) |
| `home_v1_contact_visual_image` | Image | Portrait in the left card; placeholder if empty |
| `home_v1_contact_status_kicker` | Text | Uppercase micro-label on the status bar (defaults if empty) |
| `home_v1_contact_status_line` | Text | Status line under the kicker (defaults if empty) |
| `home_v1_contact_status_badge` | Text | Green badge text (defaults if empty) |
| `home_v1_contact_title` | Textarea | Main headline (sentence case; not forced uppercase) |
| `home_v1_contact_description` | Textarea | Supporting copy |
| `home_v1_contact_email_value` | Email | Optional. Reused by the Home V1 footer contact card |
| `home_v1_contact_form_shortcode` | Textarea | CF7 / WPForms / etc. Shortcodes inherit contact field styling under `#contact-us`. |

The competencies section CTA (`home_v1_competencies_cta_text` / `home_v1_competencies_cta_url`) uses the same **`.home-v1-button--compact`** treatment as elsewhere (stroke **chat** icon, `currentColor` on white). The closing line is **`home_v1_competencies_disclaimer`** (centered; body color with slight opacity; type scale aligned with **Problems we solve** quote breakpoints).

The **Final CTA** block renders after `#contact-us` as `#final-cta` ([`template-parts/sections/home-v1/final-cta.php`](template-parts/sections/home-v1/final-cta.php)): light page background (`#F8F9FE`), full-width gradient card with soft blur orbs, centered headline and subcopy, optional **Lanova email** (`home_v1_final_cta_email`) as a `mailto:` link, and a white pill button.

| Field Name | Type | Notes |
| ---------- | ---- | ----- |
| `home_v1_final_cta_title` | Textarea | Main headline (white, sentence case) |
| `home_v1_final_cta_description` | Textarea | Subcopy (`rgba(255,255,255,0.8)`) |
| `home_v1_final_cta_email` | Email | Public mailto link; omitted if invalid/empty |
| `home_v1_final_cta_button_text` / `home_v1_final_cta_button_url` | Text / URL | White button on the gradient card |

**Motion:** On this template, each `.home-v1-section` scroll-reveals with a longer ease-out, slight scale, and brightness lift; inner blocks (hero lines, headings, competency rows, project cards, team column blocks, contact visual/intro/form shell, final CTA copy/button, etc.) use staggered delays. Logic lives in `assets/js/home-v1-reveal.js` and `style.css` under `home-v1-reveal-js`. Users who prefer reduced motion are not opted into the hidden-then-reveal behavior; `prefers-reduced-motion: reduce` also sets `scroll-behavior: auto` on `.home-v1-projects-grid` so the mobile projects strip does not use smooth scrolling.

**In-page navigation:** `assets/js/home-v1-smooth-nav.js` intercepts same-page links (`#section-id` or current URL + hash), smooth-scrolls with a sticky-header offset, and updates the URL via `history.pushState` so the browser does not perform a full navigation/reload.

**Translation:** On Home V1, Google’s Website Translator mounts in the **footer** (`#google_translate_element` inside `.site-footer__translate`), beside a **globe icon** pill— not in the header. `autoDisplay` is **off** so Google’s top-of-page banner does not compete with the sticky header. Source language comes from `get_locale()`. To show Google’s auto banner again, set `autoDisplay` to `true` in `aiagency_wez_enqueue_google_translate()` in `functions.php`. The theme caps the floating `.goog-te-menu-frame` iframe with `max-width` / `max-height` in `style.css` so the language list stays a narrow, scrollable panel instead of stretching across the viewport in many columns.

### Landing Page

Use these fields for Pages assigned to the `Landing Page` template in [`page-templates/template-landing.php`](/Users/vincent6/Local%20Sites/wp-base/app/public/wp-content/themes/aiagency-wez/page-templates/template-landing.php).

| Field Name         | Recommended Type | Notes                               |
| ------------------ | ---------------- | ----------------------------------- |
| `hero_title`       | Text             | Main hero heading                   |
| `hero_description` | Textarea         | Short supporting copy               |
| `hero_image`       | Image            | Can return array, ID, or URL        |
| `cta_text`         | Text             | CTA message shown before the button |
| `cta_link`         | URL              | Link used by the CTA button         |
| `features_items`   | Textarea         | One feature per line                |

### About Page

Use these fields for Pages assigned to the `About Page` template in [`page-templates/template-about.php`](/Users/vincent6/Local%20Sites/wp-base/app/public/wp-content/themes/aiagency-wez/page-templates/template-about.php).

| Field Name           | Recommended Type | Notes                    |
| -------------------- | ---------------- | ------------------------ |
| `about_title`        | Text             | Page heading override    |
| `about_content`      | WYSIWYG Editor   | Main about content       |
| `team_section_title` | Text             | Team section heading     |
| `team_members`       | Textarea         | One team member per line |

### Contact Page

Use these fields for Pages assigned to the `Contact Page` template in [`page-templates/template-contact.php`](/Users/vincent6/Local%20Sites/wp-base/app/public/wp-content/themes/aiagency-wez/page-templates/template-contact.php).

| Field Name            | Recommended Type | Notes                                 |
| --------------------- | ---------------- | ------------------------------------- |
| `contact_title`       | Text             | Page heading override                 |
| `contact_description` | Textarea         | Intro copy                            |
| `contact_email`       | Email            | Email address                         |
| `contact_phone`       | Text             | Phone number as entered by the editor |
| `contact_address`     | Textarea         | Address block                         |
| `contact_map_embed`   | Textarea         | Paste iframe embed code               |

## How To Create Pages From Templates

### Home Page

1. Go to `Pages > Add New`.
2. Create the page that will become your homepage.
3. In the Page sidebar, choose `Home Page` from the Template dropdown.
4. Fill in the Home Page ACF fields.
5. Publish the Page.
6. Go to `Settings > Reading` and set this page as the static homepage if you want it on `/`.

### Landing Page

1. Go to `Pages > Add New`.
2. Create a Page title.
3. In the Page sidebar, choose `Landing Page` from the Template dropdown.
4. Fill in the Landing Page ACF fields.
5. Publish the Page.

### About Page

1. Go to `Pages > Add New`.
2. Choose the `About Page` template.
3. Fill in the About Page ACF fields.
4. Publish the Page.

### Contact Page

1. Go to `Pages > Add New`.
2. Choose the `Contact Page` template.
3. Fill in the Contact Page ACF fields.
4. Publish the Page.

## Where To Edit The UI

Use these files when you want to change the frontend HTML or layout:

- [`page-templates/template-landing.php`](/Users/vincent6/Local%20Sites/wp-base/app/public/wp-content/themes/aiagency-wez/page-templates/template-landing.php)
- [`page-templates/template-home.php`](/Users/vincent6/Local%20Sites/wp-base/app/public/wp-content/themes/aiagency-wez/page-templates/template-home.php)
- [`page-templates/template-about.php`](/Users/vincent6/Local%20Sites/wp-base/app/public/wp-content/themes/aiagency-wez/page-templates/template-about.php)
- [`page-templates/template-contact.php`](/Users/vincent6/Local%20Sites/wp-base/app/public/wp-content/themes/aiagency-wez/page-templates/template-contact.php)
- [`template-parts/sections/hero.php`](/Users/vincent6/Local%20Sites/wp-base/app/public/wp-content/themes/aiagency-wez/template-parts/sections/hero.php)
- [`template-parts/sections/features.php`](/Users/vincent6/Local%20Sites/wp-base/app/public/wp-content/themes/aiagency-wez/template-parts/sections/features.php)
- [`template-parts/sections/cta.php`](/Users/vincent6/Local%20Sites/wp-base/app/public/wp-content/themes/aiagency-wez/template-parts/sections/cta.php)
- [`template-parts/sections/home/hero.php`](/Users/vincent6/Local%20Sites/wp-base/app/public/wp-content/themes/aiagency-wez/template-parts/sections/home/hero.php)
- [`template-parts/sections/home/what-we-do.php`](/Users/vincent6/Local%20Sites/wp-base/app/public/wp-content/themes/aiagency-wez/template-parts/sections/home/what-we-do.php)
- [`template-parts/sections/home/projects.php`](/Users/vincent6/Local%20Sites/wp-base/app/public/wp-content/themes/aiagency-wez/template-parts/sections/home/projects.php)
- [`template-parts/sections/home/who-we-are.php`](/Users/vincent6/Local%20Sites/wp-base/app/public/wp-content/themes/aiagency-wez/template-parts/sections/home/who-we-are.php)
- [`template-parts/sections/home/contact.php`](/Users/vincent6/Local%20Sites/wp-base/app/public/wp-content/themes/aiagency-wez/template-parts/sections/home/contact.php)
- [`style.css`](/Users/vincent6/Local%20Sites/wp-base/app/public/wp-content/themes/aiagency-wez/style.css)

## Notes

- On the **Home Page** template (`body.aiagency-wez-home-template`), the header uses `position: sticky` so the primary nav stays at the top while scrolling. Page backdrop uses **`--aiagency-wez-home-page-bg`** (default `#d4ebf5`). The **hero** block uses a warmer gradient (`--aiagency-wez-home-hero-bg-top` / `--aiagency-wez-home-hero-bg-mid`) that blends into that blue, plus a **`.home-hero-section::after`** blurred overlay for a soft fade into the following sections.
- Home primary nav links use a **transparent** pill by default; the **current page** does not get an extra background—only **hover** (fine pointer) or **keyboard focus** (`:focus-visible`) show the solid white pill.
- `page.php` is the fallback template for normal Pages that do not use a custom Page Template.
- `index.php` is the final fallback template.
- This theme does not require a page builder or block theme setup.
- `features_items` and `team_members` are built for ACF Free by using textarea fields with one item per line.
