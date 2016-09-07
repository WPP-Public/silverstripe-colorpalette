# SilverStripe Color Palette Field

Provides a color picker field in SilverStripe allowing a user to select from defined selection of colors (palette)

## Installation (with composer)

	$ composer require heyday/silverstripe-colorpalette

## Example

![Color Palette Example](resources/example.png?raw=true)

## Usage

### Define your palette

You can define your color palette in your config file

```yml
ColorPalette:
  colors:
    white: '#ffffff'
    white-two: '#fafafa'
    black: '#232323'
```

### Regular palette

This will use your default palette as defined in your yml

```php
$fields->addFieldToTab(
	'Root.Main',
	new ColorPaletteField('Color')
);
```

### Custom palette

```php
$fields->addFieldToTab(
	'Root.Main',
	new ColorPaletteField(
		'BackgroundColor',
		'Background Color',
		array(
			'White' => '#fff',
			'Black' => '#000'
		)
	)
);
```

### Grouped Palette

```php
$fields->addFieldToTab(
	'Root.Main',
	new GroupedColorPaletteField(
		'BackgroundColor',
		'Background Color',
		array(
			'Primary Palette' => array(
				'White' => '#fff',
				'Black' => '#000'
			),
			'Secondary Palette' => array(
				'Blue' => 'blue',
				'Red' => 'red'
			)
		)
	)
);
```

### Light or dark colors

The ColorPalette class provides helpers to filter your palette based on luma, allowing you to only display light or dark colors.

```php
$fields->replaceField('BackgroundColor',
    new ColorPaletteField('BackgroundColor', 'Background Color',
    ColorPalette::values(ColorPalette::dark())));
```

### Update TinyMCE colors

If your TinyMCE config allows using colors, you can use the ColorPalette class to generate the colors you would use in _config.php

```php
HtmlEditorConfig::get('cms')->setOption('theme_advanced_text_colors',
    ColorPalette::tinymce());
```

##License

SilverStripe Color Palette Field is licensed under an [MIT license](http://heyday.mit-license.org/)
