Redactor Clips for Craft CMS
===================

This plugin Adds Redactor’s “Clips” plugin to Rich Text fields in Craft, which lets you insert predefined code snippets.

## Requirements

This plugin requires Craft CMS 3.0.0-beta.26 or later.


## Installation

To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to load the plugin:

        composer require craftcms/redactor-clips

3. In the Control Panel, go to Settings → Plugins and click the “Install” button for Redactor Clips.

4. Open your `craft/config/redactor/` folder, and add the `clips` plugin in whichever Redactor configs you want it to be enabled in:

```javascript
"plugins": ["clips" /* , ... */ ]
```

5. Any Redactor fields using those configs will have a “Clips” menu button with your custom defined clips in it.
