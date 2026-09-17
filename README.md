# Painter Creative Elementor Widgets

**Author:** Usman Tayyab  
**LinkedIn:** [https://www.linkedin.com/in/imuxmantayyab/](https://www.linkedin.com/in/imuxmantayyab/)  
**Text Domain:** `painter-creative-elementor-widgets`  
**Requires at least:** WordPress 5.8+, Elementor 3.5.0+, PHP 7.4+  

A high-performance, production-ready WordPress plugin that introduces artistic hand-painted brush stroke CTA buttons and creative painter headings to Elementor. Designed to reproduce hand-painted service contractor banners (such as paint roller CTA banners) with pixel precision while allowing designers to customize every brush edge, layer, paint roller graphic, and responsive behavior without touching a line of CSS.

> 📖 **Full User Guide & Documentation:** Check out [USER_GUIDE.md](USER_GUIDE.md) for step-by-step instructions, design presets, and user stories.

---

## Why We Developed This Plugin

### The Real-World Client Challenge & Market Gap
During the development of a bespoke WordPress website for a professional painting & decorating contractor, our client required an authentic, hand-painted brand aesthetic: wet-paint brush strokes for CTA buttons and section headlines with realistic paint rollers attached directly to the strokes.

When exploring the WordPress and Elementor ecosystem, we found:
1. **Native Elementor widgets** are strictly rectangular and lack support for organic vector brush edges.
2. **Third-party addon packs** only offered static, pixelated background images or rigid clip-paths that broke across screen sizes.
3. **No existing market solution** provided vector paint roller models with customizable sleeve/cap colors, independent X/Y bristle scaling, and synchronized hover color transitions.

To meet our client's design requirements with zero compromise, we engineered **Painter Creative Elementor Widgets** from scratch.

---

## Visual Design Reference & Default Style

The plugin is architected around an authentic hand-painted aesthetic:
- **Primary Shape:** A horizontal coral/orange (`#FF5E4D`) acrylic paint banner with rough, jagged, organic brush bristles on the leading edge (default: *Roller Stamp & Bristle Stroke*).
- **Paint Roller Assembly:** An attached commercial paint roller with a color-matched wet sleeve, metallic steel spindle/arm (`#8C96A8`), and an ergonomic cobalt blue grip (`#2B4CFF`).
- **Typography:** Crisp, bold text rendered in pure white with full Elementor typography controls.
- **Synchronized Hover:** On hover, the paint, sleeve, and cap circles smoothly transition together to `#FEA502`.
- **Reactivity:** Real-time Elementor editor canvas preview support via `content_template()`.

---

## Key Features & Included Widgets

### 1. Creative Painter Button (`ute_creative_button`)
- **Content Controls:** Dynamic button text, custom links, semantic HTML tags (`<a>`, `<button>`, `<div>`), before/after icons, and ARIA labels.
- **Paint Stroke Background:** 9 built-in vector brush shapes (including *Roller Stamp & Bristle Stroke*) plus custom SVG support, solid colors, and 2-color gradients.
- **Brush Edge & Irregularity Controls:** Stroke scale X (`1.0`) & Y (`1.5` default), stroke tilt rotation, left edge bristle extension, and contrast roughness.
- **Multi-Layer Paint System:** Secondary shadow stroke layer, canvas texture blend overlay, wet paint specular shine, and drop shadow.
- **Paint Roller System:** Realistic vector rollers (Square Arm Option 1, Offset S-Curve Option 2, etc.), color pickers for sleeve, cap ring, hover colors, frame, and handle, plus responsive dimensions and offsets.
- **Hover & GPU Micro-Animations:** Lift, Press, Paint Scale, Skew, Glow, and paint stroke spread. Respects `@media (prefers-reduced-motion: reduce)`.

### 2. Creative Painter Heading (`ute_creative_heading`)
- **Full Paint Background:** Shares the exact same artistic paint engine, multi-layer depth, and customizable brush shapes as the button.
- **Semantic SEO Tagging:** Choose `H1`, `H2`, `H3`, `H4`, `H5`, `H6`, `div`, `span`, or `p` (defaults to `H2`).
- **Heading Paint Roller:** Attach the paint roller to headlines with identical positioning, dimension controls, and synchronized hover transitions.
- **Full Typography:** Complete Elementor typography group control, text shadow, and normal/hover text colors.
- **Optional Link & Icon:** Make headlines clickable with optional FontAwesome or SVG icons.

---

## Developer Extensibility & Hooks

### Actions
- `ute_register_widgets( $widgets_manager )`: Hook to register additional custom Elementor widgets under the "Painter Creative Widgets" category.
- `ute_plugin_loaded`: Fires when the plugin has completely verified prerequisites and initialized.

### Filters
- `apply_filters( 'ute_paint_shapes', $shapes )`: Add or filter available brush stroke SVGs.
- `apply_filters( 'ute_paint_rollers', $rollers )`: Add or filter available paint roller vector models.

---

## Installation

1. Download the `painter-creative-elementor-widgets.zip` file.
2. In your WordPress Admin, navigate to **Plugins > Add New > Upload Plugin**.
3. Select the `.zip` file and click **Install Now**.
4. Click **Activate Plugin**.
5. Ensure **Elementor** is active.
6. Open any page in Elementor, look for the **Painter Creative Widgets** category in the widget panel, and drag the **Creative Painter Button** or **Creative Painter Heading** onto the canvas.

---

## About Developer

**Usman Tayyab** — *Senior WordPress Architect & Team Lead (TPM)*  
*I build WordPress products that are fast, scalable, and built to last.*

- Listed contributor on **Xpro Elementor Addons** (40,000+ active installs) — architected 140+ widgets, full theme builder, and 100+ starter templates from scratch.
- 4+ years engineering across custom plugin & theme architecture (PHP OOP), Elementor addon development, VPS server management, and Core Web Vitals optimization.
- *Open to senior engineering roles, product teams, and high-impact freelance projects.*

[LinkedIn Profile](https://www.linkedin.com/in/imuxmantayyab/) | [GitHub Repository](https://github.com/imuxmantayyab/painter-creative-elementor-widgets)
