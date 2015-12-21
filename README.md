# Redactor Clips plugin for Craft

Adds Redactor’s “Clips” [plugin](http://imperavi.com/redactor/docs/plugins/) to Rich Text fields in Craft, which lets you insert predefined code snippets.

You can manage your code snippets from Settings → Plugins → Redactor Clips.

## Installation

To install Redactor Clips, copy the redactorclips/ folder into craft/plugins/, and then go to Settings → Plugins and click the “Install” button next to “Redactor Clips”.

Once installed, open your craft/config/redactor/ folder, and add the `clips` plugin in whichever Redactor configs you want it to be enabled in:

```javascript
"plugins": ["clips" /* , ... */ ]
```

## Changelog

### 1.2

* Updated the Clips plugin to take advantage of Craft 2.5 features

### 1.1

* Updated the Clips plugin for Redactor 10 compatibility

### 1.0

* Initial release
