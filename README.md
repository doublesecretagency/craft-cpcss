<img align="left" src="https://raw.githubusercontent.com/doublesecretagency/craft-cpcss/v2/src/icon.svg" alt="Plugin icon">

# Control Panel CSS plugin for Craft CMS

**Add custom CSS to your Control Panel.**

---

Easily overwrite the default Control Panel styles that ship with Craft...

![](src/resources/img/example-cp.png)

After installing the plugin, go to:

- **Settings > Control Panel CSS**

Your custom CSS can be saved in either (or both) of two places:

**1) An external file in your public directory...**
![](src/resources/img/example-cssFile.png)

**2) The "Additional CSS" field on the settings page...**
![](src/resources/img/example-additionalCss.png)

You can now customize the CSS in any way you see fit!

---

## Starter Code

Customizing your CSS is pretty easy. But to make it even easier, here's a snippet to get you started...

```css
/* Sidebar background color */
#global-sidebar {
    background: #333f4d;
}

/* Header background color */
#main-container #main #header {
    background: #ebedef;
}

/* H1 tags */
h1 {
    color: #29323d;
}

/* Standard button color */
.btn.submit {
    background: #da5a47;
}
/* Hover button color */
.btn.submit:not(.disabled):not(.inactive):hover,
.btn.submit:not(.disabled):not(.inactive).hover {
    background: #bf503f;
}
/* Active button color */
.btn.submit:not(.disabled):not(.inactive):active,
.btn.submit:not(.disabled):not(.inactive).active {
    background: #8c3b2e;
}
```

And here's the same code as a [Gist...](https://gist.github.com/lindseydiloreto/37332424e0edaef54cabc50c324b0fab)

---

## File Hashing

To ensure you get the freshest version of your CSS, a cache-busting hash is appended to the end of each file reference.

This can be disabled by setting `cacheBusting` to **false** in the [PHP config file](https://github.com/doublesecretagency/craft-cpcss/blob/v2/src/config.php)...

```php
// Disable hash-based cache busting
'cacheBusting' => false
```

See config file for usage instructions.

---

## Anything else?

We've got other plugins too!

Check out the full catalog at [plugins.doublesecretagency.com](https://plugins.doublesecretagency.com)

**On behalf of Double Secret Agency, thanks for checking out our plugin!** 🍺

<p align="center">
    <img width="130" src="https://www.doublesecretagency.com/resources/images/dsa-transparent.png" alt="Logo for Double Secret Agency">
</p>
