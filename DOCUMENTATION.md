# Painter Creative Elementor Widgets — Official Documentation

> **Production-ready WordPress & Elementor plugin for hand-painted brush stroke CTA buttons and creative painter headings with attached realistic vector paint rollers.**
>
> **Author:** Usman Tayyab  
> **Role:** Senior WordPress Architect & Team Lead (TPM)  
> **GitHub Repository:** [https://github.com/imuxmantayyab/painter-creative-elementor-widgets](https://github.com/imuxmantayyab/painter-creative-elementor-widgets)  
> **LinkedIn:** [https://www.linkedin.com/in/imuxmantayyab/](https://www.linkedin.com/in/imuxmantayyab/)  

---

## Table of Contents
1. [The Origin Story & Problem Statement](#1-the-origin-story--problem-statement)
2. [User Stories](#2-user-stories)
3. [Architecture & Design Principles](#3-architecture--design-principles)
4. [Creative Painter Button Widget (`ute_creative_button`)](#4-creative-painter-button-widget)
5. [Creative Painter Heading Widget (`ute_creative_heading`)](#5-creative-painter-heading-widget)
6. [Paint Roller Graphic System](#6-paint-roller-graphic-system)
7. [Vector Brush Shapes & Edge Engine](#7-vector-brush-shapes--edge-engine)
8. [Multi-Layer Paint Depth & 3D Volume](#8-multi-layer-paint-depth--3d-volume)
9. [Micro-Animations & GPU Acceleration](#9-micro-animations--gpu-acceleration)
10. [Elementor Real-Time Canvas Reactivity](#10-elementor-real-time-canvas-reactivity)
11. [Design Presets & Palettes](#11-design-presets--palettes)
12. [Developer Hooks & API Reference](#12-developer-hooks--api-reference)
13. [Troubleshooting & FAQ](#13-troubleshooting--faq)

---

## 1. The Origin Story & Problem Statement

### The Real-World Client Challenge
During the custom design and development of a WordPress website for a high-end painting & decorating contractor, our client's brand identity called for something distinctive:
- **Artistic Call-to-Action Buttons**: High-impact CTA buttons featuring realistic wet-paint brush strokes with organic bristle edges on the leading side.
- **Physical Paint Roller Attachment**: A realistic commercial paint roller vector physically positioned at the finish line of the brush stroke as if it had just painted the button onto the screen.
- **Synchronized Hover Dynamics**: When the user hovers over the button or heading, the paint stroke, the roller sleeve, and the end-cap rings transition harmoniously to an accent hover color (`#FEA502`).

### The Market Gap in WordPress & Elementor
When attempting to implement this design within Elementor, we encountered fundamental limitations across the entire ecosystem:
1. **Native Elementor Button & Heading Widgets**: Only support basic rectangular boxes, flat solid borders, and uniform border-radii. They offer no support for organic vector borders or dynamic bristle textures.
2. **Third-Party Addon Packs**: Popular Elementor addon suites (Essential Addons, Ultimate Addons, HappyAddons, Crocoblock JetElements) only offer static background PNG masks or rigid SVG clip-paths. When resized across desktop, tablet, and mobile, these static images stretch, blur, and distort ungracefully.
3. **Absence of Roller Graphics**: Zero solutions on the market allowed attaching a multi-piece vector paint roller (steel wire arm, ergonomic grip, and color-matched wet sleeve) to the edge of an interactive button or heading.

### The Solution: Built from the Ground Up
To fulfill the client's design vision without fragile CSS overrides or slow, layout-shifting scripts, we engineered **Painter Creative Elementor Widgets**:
- **100% Vector Precision**: Pure inline SVGs that scale infinitely with zero pixelation on 4K/Retina displays.
- **Zero Bloat Architecture**: Zero external dependencies, no jQuery animation plugins, and no bulky asset bundles.
- **Instant Client-Side Reactivity**: Full live canvas preview synchronization inside the Elementor editor using native Underscore.js templates and cross-window data bridging.

---

## 2. User Stories

### User Story 1: Agency Web Designer
> *"As an agency web designer, I want to deliver bespoke, brand-aligned trade websites in Elementor that break away from cookie-cutter rectangular templates, so that my clients' websites look custom-coded, award-winning, and premium."*

### User Story 2: Painting Contractor & Business Owner
> *"As a commercial painting contractor, I want my website visitors to instantly recognize my craft in the first 3 seconds and feel drawn to request a quote, so that my website generates higher conversions and stands out against local competitors."*

### User Story 3: Content Editor & Marketer
> *"As a marketing manager, I want to edit headline text, CTA button links, brush styles, and color schemes directly in the Elementor visual canvas with instant live updates, so that I don't need to hire a developer for routine content changes."*

---

## 3. Architecture & Design Principles

```
painter-creative-elementor-widgets/
├── assets/
│   ├── css/
│   │   ├── admin-settings.css      # WordPress admin dashboard styling
│   │   ├── animations.css          # GPU-accelerated micro-animations (60 FPS)
│   │   ├── creative-button.css     # Button layout, paint layers, roller positioning
│   │   └── creative-heading.css    # Heading layout, semantic tags, typography
│   ├── js/
│   │   ├── creative-widgets.js     # Frontend runtime enhancements
│   │   └── editor-preview.js       # Cross-window Elementor live preview bridge
│   └── svg/
│       ├── brushes/                # Hand-crafted SVG brush stroke shapes
│       │   └── roller-stop-stroke.svg # Default feathered bristle + flat end stroke
│       └── rollers/                # Realistic vector paint roller models
│           ├── paint-roller-horizontal.svg # Option 1: Classic Square Arm
│           └── paint-roller-offset.svg     # Option 2: Offset S-Curve Arm
├── includes/
│   ├── Admin/                      # Admin dashboard & settings page
│   ├── Elementor/                  # Category registration & widget loader
│   ├── class-ute-assets.php        # Script & style enqueuing + UTE_Editor_Data
│   ├── class-ute-plugin.php        # Singleton plugin lifecycle manager
│   ├── class-ute-shapes.php        # SVG brush and roller registry
│   └── class-ute-svg-sanitizer.php # Multi-tier XML/SVG sanitizer
├── widgets/
│   ├── class-ute-widget-creative-button.php  # Creative Painter Button
│   └── class-ute-widget-creative-heading.php # Creative Painter Heading
├── painter-creative-elementor-widgets.php   # Main plugin bootstrap file
├── DOCUMENTATION.md                # Comprehensive technical documentation
├── USER_GUIDE.md                   # Step-by-step user guide & user stories
└── README.md                       # Repository overview
```

### Core Design Tokens & Defaults
- **Default Paint Color:** `#FF5E4D` (Contractor Coral Acrylic)
- **Default Hover Color:** `#FEA502` (Vibrant Warm Amber)
- **Default Roller Sleeve:** `#FF5E4D` (Color-matched to wet paint)
- **Default Roller Cap Ring:** `#FF5E4D` (Matches sleeve; eliminates unwanted steel grey rings)
- **Default Roller Frame:** `#8C96A8` (Industrial brushed chrome/steel)
- **Default Roller Handle:** `#2B4CFF` (Ergonomic cobalt blue grip)
- **Default Brush Shape:** `roller-stop-stroke` (*Roller Stamp & Bristle Stroke*)
- **Default Stroke Height Scale (Y):** `1.5`
- **Default Stroke Width Scale (X):** `1.0`
- **Default Roller Dimensions:** `100px` width × `130px` height × `26px` X-offset

---

## 4. Creative Painter Button Widget

**Elementor Widget Slug:** `ute_creative_button`  
**Category:** `Painter Creative Widgets`

### Key Controls & Capabilities

#### Content Controls
- **Button Text:** Editable text label with dynamic tags support.
- **Link:** WordPress URL control with internal page autocomplete, external link target, and `nofollow` toggle.
- **HTML Tag:** `<a>`, `<button>`, or `<div>`.
- **Alignment:** Left, Center, Right, or Justified (Full Width).
- **Icon Support:** FontAwesome or custom SVG icons with before/after position and configurable spacing.
- **Accessibility:** Custom HTML ID and descriptive ARIA label for screen readers.

#### Paint Stroke Background
- **Paint Shape Dropdown:** 9 curated vector brush strokes or user-provided custom SVG code.
- **Paint Color Picker:** Base color (`--ute-paint-color`).
- **Hover Paint Color Picker:** Color on mouse hover (`--ute-paint-hover-color`).
- **Gradient Toggle:** Optional 2-color linear gradient with 0° to 360° angle slider.

#### Brush Edges & Irregularity
- **Bristle Definition / Contrast:** Adjusts filter contrast to emphasize brush bristle grain.
- **Stroke Width Scale (X):** Stretches or compresses the horizontal stroke profile (`0.7` to `1.5`).
- **Stroke Height Scale (Y):** Vertical scaling (`0.7` to `2.0`, defaults to `1.5`).
- **Stroke Tilt / Rotation:** Subtle angle offset (`-25°` to `+25°`).
- **Left Edge Extension:** Extends the jagged bristle edge past the button container.

---

## 5. Creative Painter Heading Widget

**Elementor Widget Slug:** `ute_creative_heading`  
**Category:** `Painter Creative Widgets`

### Key Controls & Capabilities

#### Heading Typography & Semantics
- **Semantic SEO Tags:** Full support for `H1`, `H2`, `H3`, `H4`, `H5`, `H6`, `div`, `span`, and `p` (defaults to `H2`).
- **Heading Text:** Direct headline copy input with dynamic tags support.
- **Optional Link:** Wrap the headline in an interactive anchor tag.
- **Typography Group:** Complete Elementor typography control (font family, weight, style, transform, letter spacing, line height).
- **Text Shadow:** Elementor text shadow control.
- **Colors:** Normal text color and hover text color.

#### Full Paint Background & Roller Integration
- Employs the **exact same artistic multi-layer paint engine** as the button widget.
- Headings can have attached paint rollers that scale, position, and transition hover colors in perfect visual harmony with the button widgets.

---

## 6. Paint Roller Graphic System

### Vector Models
1. **Straight Handle - Square Arm (Option 1 - Default):** Classic heavy-duty industrial roller arm with 90-degree metal bend and smooth cylindrical grip.
2. **Straight Handle - Offset S-Curve Arm (Option 2):** Professional ergonomic painter frame with double curved neck.
3. **Detailed Paint Roller:** Classic commercial roller with contour wire accents.
4. **Minimalist Outline Roller:** Clean flat outline for minimalist interfaces.
5. **Small Trim Roller:** Compact mini-roller designed for secondary CTA elements.
6. **Heavy Duty Industrial Roller:** Extra-large frame for bold hero sections.
7. **Custom SVG:** Allows pasting any custom SVG roller vector code.

### End-Cap Circle ("Gol Circle") Architecture
Previous roller vectors suffered from a hardcoded steel-grey stroke (`#808A9D`) around the top and bottom sleeve ellipses. 

In real-world painting, the roller ends are saturated in wet paint. Our system updates this architecture:
```xml
<!-- Sleeve End Caps with CSS Variable Fallbacks -->
<ellipse class="ute-roller-sleeve ute-roller-cap" 
         cx="34" cy="28" rx="26" ry="5" 
         fill="var(--ute-roller-sleeve, #FF5E4D)" 
         stroke="var(--ute-roller-cap-color, var(--ute-roller-sleeve, #FF5E4D))" 
         stroke-width="1.8" />
```
- **Normal State:** Cap circles match the sleeve color by default.
- **Customizable Control:** Dedicated `roller_cap_color` picker in Elementor.
- **Hover Transition:** Cap circles smoothly transition to `var(--ute-roller-hover-cap, var(--ute-paint-hover-color, #FEA502))` alongside the sleeve.

---

## 7. Vector Brush Shapes & Edge Engine

The plugin includes 9 handcrafted SVG brush shapes designed for high-resolution rendering:

| Shape Key | Name | Visual Characteristics |
| :--- | :--- | :--- |
| `roller-stop-stroke` | **Roller Stamp & Bristle Stroke (Default)** | Feathered organic bristle start on left; clean squared finish on right that meets the roller. |
| `coral-banner-ref` | Coral Banner Stroke | Wide saturated acrylic brush banner with ragged bristle ends. |
| `rough-stroke-01` | Rough Hand-Painted Stroke | Aggressive paint splatter and coarse bristle marks. |
| `classic-brush-02` | Classic Acrylic Stroke | Balanced, high-coverage commercial brush stroke. |
| `dry-brush-03` | Dry Bristle Stroke | Textured brush stroke with semi-dry bristle drag marks. |
| `marker-04` | Broad Chisel Marker | Semi-translucent wide stroke with angled ends. |
| `organic-05` | Fluid Organic Swipe | Smooth, rounded flow for modern creative agencies. |
| `double-brush-06` | Double Overlapping Brush | Two distinct overlapping brush strokes for layered depth. |
| `underline-swipe-07` | Tapered Underline Swipe | Tapered swipe for subtle decorative highlights. |

---

## 8. Multi-Layer Paint Depth & 3D Volume

To produce realistic physical paint rather than flat 2D shapes, the plugin includes a multi-tier rendering stack:

```
[ Z-Index 8 ]  Paint Roller Graphic (.ute-roller-wrap)
[ Z-Index 6 ]  Button / Heading Content Text & Icons (.ute-button-content)
[ Z-Index 4 ]  Wet Paint Specular Shine (.ute-paint-layer--highlight)
[ Z-Index 3 ]  Canvas Texture Blend Overlay (.ute-paint-layer--texture)
[ Z-Index 2 ]  Primary Paint Layer (.ute-paint-layer--primary)
[ Z-Index 1 ]  Secondary Paint Shadow Stroke (.ute-paint-layer--secondary)
[ Z-Index 0 ]  Ambient Occlusion Drop Shadow (.ute-paint-layer--shadow)
```

1. **Secondary Paint Shadow Layer:** Adds an offset under-stroke with customizable color and angle to simulate layered paint thickness.
2. **Canvas Texture Overlay:** Applies a blend-mode texture that makes the paint look applied onto textured canvas or masonry.
3. **Wet Paint Specular Highlight:** Adds a top-lit reflection simulating high-gloss wet enamel.
4. **Ambient Drop Shadow Layer:** Soft drop shadow under the paint stroke for physical elevation.

---

## 9. Micro-Animations & GPU Acceleration

All animations are hardware-accelerated using CSS `transform` and `filter` executed directly on the GPU:

- **Hover Transformations:**
  - `None` (Default, clean).
  - `Lift Up`: Smooth `-5px` Y-axis elevation with `1.02` scale.
  - `Press In`: Tactile `+3px` depress with `0.98` scale.
  - `Angle Skew`: Dynamic `-4deg` shear.
  - `Scale`: Smooth `1.05` proportional expansion.
  - `Rotation Tilt`: Dynamic `2.5deg` twist.
  - `Radial Glow`: Soft drop-shadow illumination.
- **Paint Texture Animations:**
  - `Paint Spread`: Brush strokes physically expand outward on hover.
  - `Continuous Pulse`: Subtle rhythmic breathing cycle.
  - `Light Shimmer`: Diagonal light sweep across the wet paint surface.
- **Accessibility:** Fully honors `@media (prefers-reduced-motion: reduce)` by disabling aggressive movement for users with vestibular sensitivity.

---

## 10. Elementor Real-Time Canvas Reactivity

To ensure zero lag and immediate feedback during design sessions, the plugin implements a dual-layer rendering strategy:

1. **PHP `render()`:** Generates optimized server-rendered HTML for the production frontend and search engines.
2. **Underscore.js `content_template()`:** Executes client-side inside the Elementor editor canvas. When any control is adjusted in the Elementor panel, the widget re-renders instantaneously without an iframe reload.
3. **Cross-Window Data Bridge (`editor-preview.js`):** Synchronizes `UTE_Editor_Data` (all inline SVG brushes and roller assets) between the top WordPress editor window and the canvas preview iframe.

---

## 11. Design Presets & Palettes

| Preset | Paint Color | Hover Color | Sleeve Color | Handle Color | Wire Frame | Recommended Font |
| :--- | :--- | :--- | :--- | :--- | :--- | :--- |
| **Contractor Coral (Default)** | `#FF5E4D` | `#FEA502` | `#FF5E4D` | `#2B4CFF` | `#8C96A8` | Plus Jakarta Sans |
| **Safety High-Vis Yellow** | `#FBBF24` | `#F59E0B` | `#FBBF24` | `#18181B` | `#71717A` | Montserrat |
| **Industrial Navy & Crimson** | `#1E3A8A` | `#E11D48` | `#1E3A8A` | `#0F172A` | `#94A3B8` | Inter |
| **Eco Forest Green** | `#059669` | `#10B981` | `#059669` | `#064E3B` | `#A1A1AA` | Outfit |
| **Modern Charcoal Accent** | `#18181B` | `#FEA502` | `#18181B` | `#3B82F6` | `#A1A1AA` | Roboto |

---

## 12. Developer Hooks & API Reference

### Action Hooks
- `ute_register_widgets( $widgets_manager )`: Fires during widget registration, allowing add-on plugins to register custom widgets under the *Painter Creative Widgets* category.
- `ute_plugin_loaded`: Fires once the plugin has initialized all classes and verified environment prerequisites.

### Filter Hooks
- `apply_filters( 'ute_paint_shapes', $shapes )`: Add custom brush stroke SVGs to the dropdown.
  ```php
  add_filter( 'ute_paint_shapes', function( $shapes ) {
      $shapes['custom-roller-wave'] = esc_html__( 'Roller Wave Stroke', 'textdomain' );
      return $shapes;
  } );
  ```
- `apply_filters( 'ute_paint_rollers', $rollers )`: Add custom roller vector models to the selection list.
  ```php
  add_filter( 'ute_paint_rollers', function( $rollers ) {
      $rollers['custom-pro-frame'] = esc_html__( 'Pro Commercial Frame', 'textdomain' );
      return $rollers;
  } );
  ```

---

## 13. Troubleshooting & FAQ

#### Q: Why didn't my live preview update instantly when changing settings?
**A:** In version 1.0.0, we resolved this by enqueuing `assets/js/editor-preview.js` and setting `render_type => 'template'` on all controls. Ensure your browser cache is refreshed if you previously used an older build.

#### Q: Can I disable the paint roller on mobile devices?
**A:** Yes. In the **Paint Roller Graphic** section of either widget, toggle **Hide Roller on Mobile Devices** to `Yes`. The roller will cleanly hide on viewports narrower than `768px`.

#### Q: How can I use custom brand fonts?
**A:** Open the **Typography & Colors** tab in Elementor, click the pencil icon next to **Typography**, and choose any font from Google Fonts or your custom uploaded fonts in Elementor.

#### Q: Is the plugin compatible with PHP 8.0, 8.1, and 8.2?
**A:** Yes. The plugin contains zero deprecated functions and is thoroughly tested on PHP 7.4 through PHP 8.2.

---

## 👨‍💻 Developer & Author

* **Author:** Usman Tayyab
* **Professional Title:** Senior WordPress Architect & Team Lead (TPM)
* **Experience:** 4+ years full-stack WordPress engineering, listed contributor on Xpro Elementor Addons (40,000+ active installs).
* **LinkedIn:** [https://www.linkedin.com/in/imuxmantayyab/](https://www.linkedin.com/in/imuxmantayyab/)
* **GitHub:** [https://github.com/imuxmantayyab/painter-creative-elementor-widgets](https://github.com/imuxmantayyab/painter-creative-elementor-widgets)
