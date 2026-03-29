# aiagency-wez

Classic WordPress starter theme for Local on macOS. This theme uses standard PHP templates and Advanced Custom Fields (ACF) so editors can build Pages by selecting a Page Template and filling in matching custom fields.

## File Structure

```text
aiagency-wez/
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
│   └── template-landing.php
└── template-parts/
    └── sections/
        ├── cta.php
        ├── features.php
        └── hero.php
```

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
2. Create one field group for each template, or one combined field group if you prefer.
3. Set each field group location rule to show when:
   - `Page Template` is equal to `Landing Page`, or
   - `Page Template` is equal to `About Page`, or
   - `Page Template` is equal to `Contact Page`
4. Use the exact field names listed below.

## Required Field Names

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
- [`page-templates/template-about.php`](/Users/vincent6/Local%20Sites/wp-base/app/public/wp-content/themes/aiagency-wez/page-templates/template-about.php)
- [`page-templates/template-contact.php`](/Users/vincent6/Local%20Sites/wp-base/app/public/wp-content/themes/aiagency-wez/page-templates/template-contact.php)
- [`template-parts/sections/hero.php`](/Users/vincent6/Local%20Sites/wp-base/app/public/wp-content/themes/aiagency-wez/template-parts/sections/hero.php)
- [`template-parts/sections/features.php`](/Users/vincent6/Local%20Sites/wp-base/app/public/wp-content/themes/aiagency-wez/template-parts/sections/features.php)
- [`template-parts/sections/cta.php`](/Users/vincent6/Local%20Sites/wp-base/app/public/wp-content/themes/aiagency-wez/template-parts/sections/cta.php)
- [`style.css`](/Users/vincent6/Local%20Sites/wp-base/app/public/wp-content/themes/aiagency-wez/style.css)

## Notes

- `page.php` is the fallback template for normal Pages that do not use a custom Page Template.
- `index.php` is the final fallback template.
- This theme does not require a page builder or block theme setup.
- `features_items` and `team_members` are built for ACF Free by using textarea fields with one item per line.
