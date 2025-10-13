<p align="center">
  <img src="./logo.png" alt="Star & Light Logo" width="180"/>
</p>

<h1 align="center">✨ Auriels Light ✨</h1>

<p align="center">
  A modern, fast, and minimal WordPress theme powered by <b>Vite.js</b>.<br/>
  Designed and developed by <b>Alperen</b>.
</p>

# Auriels Light Theme

Auriels Light is a modern WordPress starter for front-end developers. It keeps the PHP surface small while giving you Vite, Tailwind, GSAP (with ScrollTrigger), and a Swiper coverflow slider. Every major section is editable through Advanced Custom Fields so teammates can manage copy without touching code.

---

## 1. Requirements Checklist

| Tool                         | Why you need it                                       | Download                      |
| ---------------------------- | ----------------------------------------------------- | ----------------------------- |
| XAMPP (Apache + PHP + MySQL) | Local web server for WordPress                        | https://www.apachefriends.org |
| Node.js 18+ (npm included)   | Builds assets through Vite                            | https://nodejs.org            |
| Composer                     | PHP dependency manager (optional today, useful later) | https://getcomposer.org       |
| Git (optional)               | Version control                                       | https://git-scm.com           |
| Advanced Custom Fields       | Provides the editable field groups                    | Install inside WordPress      |

> Using LocalWP, wp-env, or Docker? Follow their install steps and skip the XAMPP specific notes below.

---

## 2. WordPress + XAMPP Setup

1. Install XAMPP and open the Control Panel. Start Apache and MySQL.
2. Go to http://localhost/phpmyadmin and create a database (example name: `auriels_light`).
3. Download WordPress from https://wordpress.org and extract it to `c:\xampp\htdocs\auriels-light`.
4. Visit http://localhost/auriels-light in the browser, follow the installer, and connect it to the database you just created (user `root`, blank password by default).
5. Complete the setup and log in to the WordPress dashboard.

---

## 3. Install the Theme

1. Copy the `auriels-light` theme folder into `wp-content/themes/`.
2. Run the build dependencies:
   ```bash
   cd c:\xampp\htdocs\auriels-light\wp-content\themes\auriels-light
   npm install
   ```
3. In the WordPress admin go to Appearance -> Themes and activate **Auriels Light**.
4. Install and activate the free **Advanced Custom Fields** plugin.

---

## 4. Quick WordPress Configuration

1. Create three pages under Pages -> Add New and assign templates:
   - Home (Template: **Home**)
   - About (Template: **About**)
   - Contact (Template: **Contact**)
2. Set a static front page: Settings -> Reading -> Your homepage displays -> A static page. Choose Home as the homepage (select a posts page if you plan to blog).
3. Build a menu in Appearance -> Menus, add your pages, assign it to **Primary Menu**. The last menu item is styled as the header CTA button.
4. Optional: upload a logo via Appearance -> Customize -> Site Identity.

Start the dev server whenever you work on the theme:

```bash
npm run dev
```

Open your site (for example http://localhost/auriels-light). Vite injects the development assets with hot reload.

---

## 5. Editing Content with ACF

| Page    | ACF group            | What it controls                                                      |
| ------- | -------------------- | --------------------------------------------------------------------- |
| Home    | Home Page Content    | Hero badge, heading, buttons, illustration, feature slider cards      |
| About   | About Page Content   | Intro label, heading, description, highlight panel, info cards        |
| Contact | Contact Page Content | Form headings, field labels, placeholders, submit text, error message |
| Shared  | Page CTA             | Footer CTA heading, body copy, button label and link                  |

Edit the matching page, update the ACF fields, and publish. No PHP required.

---

## 6. Theme Folder Map

| Path                      | Purpose                                         | Typical edits                                                |
| ------------------------- | ----------------------------------------------- | ------------------------------------------------------------ |
| `templates/`              | Page level layouts (`page-home.php`, etc.)      | Reorder or add `get_template_part` calls                     |
| `partials/`               | Reusable sections (hero, features, CTA, header) | Adjust markup, Tailwind classes, ACF output                  |
| `assets/src/scss/`        | Tailwind entry plus modular SCSS                | Create `_section.scss` files and `@use` them in `main.scss`  |
| `assets/src/js/partials/` | JS controllers for each section                 | Add `section-name.js` and register it in `partials/index.js` |
| `assets/src/js/pages/`    | JS that runs on specific templates              | Check `document.body.dataset.template` before doing work     |
| `inc/helpers.php`         | Helper functions for ACF lookups                | Usually leave as-is                                          |
| `inc/acf.php`             | Local ACF field definitions                     | Extend when you add new editable fields                      |
| `inc/vite.php`            | Vite dev/build integration                      | No edits unless you change ports or directories              |

---

## 7. Create a New Section

1. Copy an existing partial, e.g. `partials/section-cta.php`, to `partials/section-services.php`.
2. Include it from a template with `get_template_part( 'partials/section', 'services' );`.
3. Add styles in `assets/src/scss/partials/_services.scss` and import them with `@use 'partials/services';` in `main.scss`.
4. (Optional) Add behaviour via `assets/src/js/partials/services.js` and include it in `assets/src/js/partials/index.js`.
5. (Optional) Create a new ACF group in the WordPress admin (or extend `inc/acf.php`) and pull values with `aurielslight_get_field('field_name')`.

---

## 8. Create Another Page Template

1. Duplicate a file from `templates/`, e.g. copy `page-about.php` to `page-services.php`.
2. Change the header comment to:
   ```php
   /**
    * Template Name: Services
    */
   ```
3. Swap in the sections you want with `get_template_part`.
4. Create a WordPress page, assign the new template, and publish.
5. Add an ACF group with a location rule (Page Template equals Services) so editors get relevant fields.

---

## 9. npm Commands

```bash
npm install     # install dependencies
npm run dev     # start Vite with hot module replacement
npm run build   # output production assets to assets/dist
npm run preview # optional: preview the build locally
```

Always run `npm run build` before deploying so the latest assets exist in `assets/dist`.

---

## 10. Optional Enhancements

- Configure Composer once you need PHP packages (e.g. Timber, Carbon Fields).
- Use wp-env or Docker if you need a reproducible environment across machines.
- Initialise a Git repository to track your changes.

---

## 11. Troubleshooting

- **No styles/scripts in development**: confirm `npm run dev` is running and the dev server URL matches `AURIELSLIGHT_VITE_SERVER` in `inc/vite.php`.
- **ACF fields missing**: check that the plugin is active and the page uses the expected template.
- **Menu missing**: assign a menu to Primary Menu in Appearance -> Menus.
- **Swiper coverflow not working**: keep the `.js-feature-slider` class on the slider wrapper.

Happy building! Focus on HTML, CSS, and JavaScript while WordPress and ACF handle content editing.
