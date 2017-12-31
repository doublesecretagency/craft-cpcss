Control Panel CSS plugin for Craft CMS
======================================

Easily overwrite the default Control Panel styles that ship with Craft.

![](src/resources/img/example-cp.png)

After you've installed the plugin, go to:

- **Settings > Plugins > Control Panel CSS**

Your custom CSS can be saved in either (or both) of two places:

**1) An external file in your public directory...**
![](src/resources/img/example-cssFile.png)

**2) The "Additional CSS" field on the settings page...**
![](src/resources/img/example-additionalCss.png)

You can now customize the CSS in any way you see fit!

***

## Starter Code

Customizing your CSS is pretty easy. But to make it even easier, here's a snippet to get you started...

```css
/* Sidebar background color */
#global-sidebar {
    background: #333f4d !important;
}

/* Header background color */
#main-container #main #header {
    background: #ebedef !important;
}

/* H1 tags */
h1 {
    color: #29323d !important;
}

/* Standard button color */
.btn.submit {
    background: #da5a47 !important;
}
/* Hover button color */
.btn.submit:not(.disabled):not(.inactive):hover,
.btn.submit:not(.disabled):not(.inactive).hover {
    background: #bf503f !important;
}
/* Active button color */
.btn.submit:not(.disabled):not(.inactive):active,
.btn.submit:not(.disabled):not(.inactive).active {
    background: #8c3b2e !important;
}
```

And here's the same code as a [Gist...](https://gist.github.com/lindseydiloreto/37332424e0edaef54cabc50c324b0fab)

***

## Environment-aware file path

If you'd like to set your CSS file path at the _environment_ level, then you'll simply want to create a `/config/cp-css.php` file, and enter something like this...

```php
return [
    '*' => [],
    'dev' => [
        'cssFile' => 'http://local.dev/path/to/cp.css',
    ],
    'production' => [
        'cssFile' => 'http://example.com/path/to/cp.css',
    ]
];
```

You can also keep the file path out of your repo entirely, by using `.env` variables to set the CSS file path...

```php
return [
    'cssFile' => getenv('CP_CSS_FILE'),
];
```

With that in place, you can add this to your `.env` file...

```dotenv
# Path to CSS file for the Control Panel
CP_CSS_FILE="http://example.com/path/to/cp.css"
```

***

## Anything else?

We've got other plugins too!

Check out the full catalog at [doublesecretagency.com/plugins](https://www.doublesecretagency.com/plugins)
