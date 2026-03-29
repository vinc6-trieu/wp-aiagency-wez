# aiagency-wez

Classic WordPress starter theme for Local on macOS. This theme uses standard PHP templates and Advanced Custom Fields (ACF) so editors can build Pages by selecting a Page Template and filling in matching custom fields.

## File Structure

```text
aiagency-wez/
├── assets/
│   ├── home-page-background.png  (Home template full-page backdrop)
│   ├── js/
│   │   └── home-v1-reveal.js     (Home V1 section scroll animations)
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
│   └── template-home-v1.php
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

- The header shows **`assets/logo.png`** by default (linked to the homepage, with the site name as `alt` text). On the **Home** template, logo height is **`--aiagency-wez-home-nav-pill-height` × `--aiagency-wez-home-logo-canvas-scale`** (defaults `5`, or `3.75` under 768px) so the visible lockup isn’t tiny inside the square PNG’s margins. On **Home V1**, the header row uses **`--home-v1-header-logo-max-height`** (`4.5rem`, `3.5rem` under 560px) with matching **`min-height`** on `.site-header__inner--home-v1` so the logo can span the bar. Other templates use the general `.site-branding__logo` max sizes.
- To use a different image without replacing that file, go to **Appearance → Customize → Site Identity** and set **Logo** (theme supports `custom-logo`).

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

| Field Name | Recommended Type | Notes |
| --- | --- | --- |
| `home_hero_eyebrow` | Text | Small text above the main title |
| `home_hero_title` | Textarea | Large hero headline |
| `home_hero_image` | Image | Main character/agent image |
| `home_hero_primary_text` | Text | Primary hero button label |
| `home_hero_primary_link` | URL | Primary hero button link |
| `home_hero_secondary_text` | Text | Secondary hero button label |
| `home_hero_secondary_link` | URL | Secondary hero button link |
| `home_services_title` | Text | Section heading |
| `home_services_intro_image` | Image | Intro image for What We Do |
| `home_services_intro_text` | Textarea | Introductory paragraph |
| `home_services_cta_text` | Text | What We Do button label |
| `home_services_cta_link` | URL | What We Do button link |
| `service_1_image` | Image | Service card 1 image |
| `service_1_title` | Text | Service card 1 title |
| `service_1_text` | Textarea | Service card 1 text |
| `service_2_image` | Image | Service card 2 image |
| `service_2_title` | Text | Service card 2 title |
| `service_2_text` | Textarea | Service card 2 text |
| `service_3_image` | Image | Service card 3 image |
| `service_3_title` | Text | Service card 3 title |
| `service_3_text` | Textarea | Service card 3 text |
| `home_services_banner_text` | Textarea | Wide message banner text |
| `home_projects_title` | Text | Projects section title |
| `project_1_image` | Image | Project image 1 |
| `project_1_title` | Text | Optional overlay label |
| `project_2_image` | Image | Project image 2 |
| `project_2_title` | Text | Optional overlay label |
| `project_3_image` | Image | Project image 3 |
| `project_3_title` | Text | Optional overlay label |
| `project_4_image` | Image | Project image 4 |
| `project_4_title` | Text | Optional overlay label |
| `project_5_image` | Image | Project image 5 |
| `project_5_title` | Text | Optional overlay label |
| `home_about_title` | Text | Who We Are heading |
| `home_about_image` | Image | About section image |
| `home_about_intro` | Textarea | About section lead copy |
| `home_about_points` | Textarea | One bullet point per line |
| `home_team_title` | Text | Team grid heading |
| `team_member_1_image` | Image | Member 1 image |
| `team_member_1_name` | Text | Member 1 name |
| `team_member_1_role` | Text | Member 1 role |
| `team_member_2_image` | Image | Member 2 image |
| `team_member_2_name` | Text | Member 2 name |
| `team_member_2_role` | Text | Member 2 role |
| `team_member_3_image` | Image | Member 3 image |
| `team_member_3_name` | Text | Member 3 name |
| `team_member_3_role` | Text | Member 3 role |
| `team_member_4_image` | Image | Member 4 image |
| `team_member_4_name` | Text | Member 4 name |
| `team_member_4_role` | Text | Member 4 role |
| `home_contact_title` | Textarea | Large contact CTA title |
| `home_contact_label` | Text | Small contact label |
| `home_contact_link_text` | Text | Contact button text |
| `home_contact_link_url` | URL | Contact button URL or `mailto:` link |
| `home_contact_visual_image` | Image | Contact section visual |

### Home Page — Version 1

Use [`page-templates/template-home-v1.php`](/Users/vincent6/Local%20Sites/wp-base/app/public/wp-content/themes/aiagency-wez/page-templates/template-home-v1.php) with ACF group [`acf-json/group_aiagency_wez_home_page_v1.json`](/Users/vincent6/Local%20Sites/wp-base/app/public/wp-content/themes/aiagency-wez/acf-json/group_aiagency_wez_home_page_v1.json) (sync in **Custom Fields**). Competency rows support optional icon images:

| Field Name | Type | Notes |
| --- | --- | --- |
| `home_v1_competency_1_icon` | Image | Replaces default SVG for competency 1 |
| `home_v1_competency_2_icon` | Image | Replaces default SVG for competency 2 |
| `home_v1_competency_3_icon` | Image | Replaces default SVG for competency 3 |

If an icon field is empty, the theme shows a built-in SVG (thin circle with checkmark) so the section is never blank.

The competencies section CTA (`home_v1_competencies_cta_text` / `home_v1_competencies_cta_url`) includes a leading **chat bubbles** icon (inherits button text color).

**Motion:** On this template, each `.home-v1-section` scroll-reveals with a longer ease-out, slight scale, and brightness lift; inner blocks (hero lines, headings, competency rows, project/team cards, contact columns, etc.) use staggered delays. Logic lives in `assets/js/home-v1-reveal.js` and `style.css` under `home-v1-reveal-js`. Users who prefer reduced motion are not opted into the hidden-then-reveal behavior.

### Landing Page

Use these fields for Pages assigned to the `Landing Page` template in [`page-templates/template-landing.php`](/Users/vincent6/Local%20Sites/wp-base/app/public/wp-content/themes/aiagency-wez/page-templates/template-landing.php).

| Field Name | Recommended Type | Notes |
| --- | --- | --- |
| `hero_title` | Text | Main hero heading |
| `hero_description` | Textarea | Short supporting copy |
| `hero_image` | Image | Can return array, ID, or URL |
| `cta_text` | Text | CTA message shown before the button |
| `cta_link` | URL | Link used by the CTA button |
| `features_items` | Textarea | One feature per line |

### About Page

Use these fields for Pages assigned to the `About Page` template in [`page-templates/template-about.php`](/Users/vincent6/Local%20Sites/wp-base/app/public/wp-content/themes/aiagency-wez/page-templates/template-about.php).

| Field Name | Recommended Type | Notes |
| --- | --- | --- |
| `about_title` | Text | Page heading override |
| `about_content` | WYSIWYG Editor | Main about content |
| `team_section_title` | Text | Team section heading |
| `team_members` | Textarea | One team member per line |

### Contact Page

Use these fields for Pages assigned to the `Contact Page` template in [`page-templates/template-contact.php`](/Users/vincent6/Local%20Sites/wp-base/app/public/wp-content/themes/aiagency-wez/page-templates/template-contact.php).

| Field Name | Recommended Type | Notes |
| --- | --- | --- |
| `contact_title` | Text | Page heading override |
| `contact_description` | Textarea | Intro copy |
| `contact_email` | Email | Email address |
| `contact_phone` | Text | Phone number as entered by the editor |
| `contact_address` | Textarea | Address block |
| `contact_map_embed` | Textarea | Paste iframe embed code |

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
