![Wirecookies](art/banner.png)

# Wirecookies

Drop-in cookie consent banner and preferences modal for Laravel, Livewire and Alpine. Pure CSS, no Tailwind. Themeable through the `wire*` family CSS variables, so it shares its look with [wiremodal](https://github.com/edulazaro/wiremodal) and [wiretoast](https://github.com/edulazaro/wiretoast). GDPR / AEPD friendly: granular categories, re-openable preferences, multilingual, and it tracks nothing of its own.

## Requirements

- PHP 8.2+
- Laravel 11 or 12
- Alpine.js (already shipped with Livewire)
- [edulazaro/wiremodal](https://github.com/edulazaro/wiremodal) — pulled in automatically; it powers the preferences modal and provides the shared theme tokens.

## Features

- Bottom banner **and** an accessible preferences modal from a single `<x-wirecookies />` tag.
- Granular categories (essential always on; analytics / marketing / functional opt-in), persisted in `localStorage`.
- Re-openable: a floating button lets users change or withdraw consent at any time (AEPD requirement).
- Works standalone with a clean light default; optionally set `data-wire-theme` (with wiremodal/wiretoast loaded) and it adopts that theme so banner, modal and toasts match.
- Multilingual: ships Spanish and English; every string is translatable and overridable per prop.
- Configurable policy link: a single URL or one per locale.
- Emits a `wirecookies-saved` event and writes a plain `localStorage` object you can read from anywhere.

## Install

```bash
composer require edulazaro/wirecookies
```

The service provider is auto-discovered.

Wirecookies ships a single stylesheet (`wirecookies.css`) and **no JS of its own** — it relies on Alpine and on wiremodal's JS for the modal.

### Styles (Vite)

Import the stylesheet from your `resources/css/app.css`, after a `wire*` family base (wiremodal or wiretoast) that defines the theme tokens:

```css
/* resources/css/app.css */
@import '../../vendor/edulazaro/wiremodal/resources/css/wiremodal.css';
@import '../../vendor/edulazaro/wirecookies/resources/css/wirecookies.css';
```

Bundle wiremodal's JS too (needed to open/close the preferences modal):

```js
// resources/js/app.js
import '../../vendor/edulazaro/wiremodal/resources/js/wiremodal.js';
```

Prefer a copy you can edit? Publish the CSS into your app and `@import` that instead:

```bash
php artisan vendor:publish --tag=wirecookies-css
# → resources/css/vendor/wirecookies.css
```

### Publish config, translations and views (optional)

```bash
php artisan vendor:publish --tag=wirecookies-config   # → config/wirecookies.php
php artisan vendor:publish --tag=wirecookies-lang     # → lang/vendor/wirecookies/{locale}/wirecookies.php
php artisan vendor:publish --tag=wirecookies-views    # → resources/views/vendor/wirecookies
```

## Usage

Drop the component **once**, near the end of your layout:

```blade
<x-wirecookies />
```

First-time visitors get the banner. Once they choose, the banner is replaced by a floating button that reopens the preferences modal.

### Theming

Wirecookies styles itself: its CSS ships sensible light defaults, so it looks right on its own with nothing else loaded. Each token is also wired to the shared `--wire-*` family variables, so if you set `data-wire-theme` on a parent — with wiremodal or wiretoast loaded, since they define those variables — wirecookies automatically adopts that theme and matches your modals and toasts:

```blade
<html data-wire-theme="studio">
```

Without it, the built-in defaults apply. Wirecookies doesn't ship its own named theme catalog — it borrows the family's. See wiremodal/wiretoast for the available themes.

### Configuration

Edit `config/wirecookies.php` after publishing it:

| Key | Description |
| --- | --- |
| `policy_url` | Link to your cookie policy. A **string** (same for every language) or an **array per locale** (`['es' => '/cookies', 'en' => '/en/cookies']`). `null` hides the link. |
| `delay` | Milliseconds before the banner appears (default `800`). |
| `categories` | The consent groups. Each holds **behavior only** (`required`, `default`); the text comes from translations. Add `label` / `description` to a category here to override its translation. |
| `storage_key` | `localStorage` key for the saved preferences (default `cookie-preferences`). |

### Reading consent

Preferences are a plain object in `localStorage`, and they are broadcast whenever the user saves:

```js
// Read the current choice anywhere
const prefs = JSON.parse(localStorage.getItem('cookie-preferences') || '{}');
if (prefs.analytics) { /* load analytics */ }

// React to changes (the event bubbles to window)
window.addEventListener('wirecookies-saved', (e) => {
    if (e.detail.marketing) { /* enable marketing pixels */ }
});
```

## Internationalization

Wirecookies ships Spanish (`es`) and English (`en`). Strings follow `app()->getLocale()` and fall back to `app.fallback_locale`.

- **Override one string** at render time by passing the matching prop (`:title`, `:accept-all`, …).
- **Customize the bundled copy** by publishing the translations:

  ```bash
  php artisan vendor:publish --tag=wirecookies-lang
  ```

  Then edit `lang/vendor/wirecookies/{locale}/wirecookies.php`. Add a new language by creating its file in the same folder.

## Component props

All props are optional. Text props default to the translation; pass one to override it for that render.

| Prop | Default | Description |
| --- | --- | --- |
| `policy-url` | config | Cookie policy link (string or per-locale array). |
| `delay` | config | Milliseconds before the banner shows. |
| `categories` | config | Override the consent groups. |
| `storage-key` | config | `localStorage` key. |
| `title` | translation | Banner / floating-button title. |
| `description` | translation | Banner description. |
| `accept-all` | translation | "Accept all" button. |
| `reject-all` | translation | "Reject all" button. |
| `configure` | translation | "Configure" button. |
| `save-preferences` | translation | Modal save button. |
| `reject-optional` | translation | Modal reject-optional button. |
| `more-policy` | translation | Inline policy link in the banner. |
| `view-full-policy` | translation | Policy link in the modal footer. |
| `modal-title` | translation | Preferences modal title. |
| `always-active` | translation | Badge on required (essential) categories. |

## Sponsors

Wirecookies is supported by the following sponsors. Thank you for keeping it growing:

<p>
  <a href="https://kenodo.com"><img src="art/logo-kenodo.png" width="24" alt="Kenodo"></a>&nbsp;<a href="https://kenodo.com">Kenodo</a>&nbsp;&nbsp;&nbsp;&nbsp;
  <a href="https://andorradev.com"><img src="art/logo-andorradev.png" width="24" alt="AndorraDev"></a>&nbsp;<a href="https://andorradev.com">AndorraDev</a>
</p>

## Author

Created by [Edu Lazaro](https://edulazaro.com)

## License

Wirecookies is open-sourced software licensed under the [MIT license](LICENSE.md).
