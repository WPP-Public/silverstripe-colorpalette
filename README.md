# SilverStripe Color Palette Field

Provides a color picker field in SilverStripe allowing a user to select from defined selection of colors (palette)

## Installation (with composer)

	$ composer require heyday/silverstripe-colorpalette

## Example

![Color Palette Example](resources/example.png?raw=true)

## Usage

### Regular palette

```php
$fields->addFieldToTab(
	'Root.Main',
	Heyday\ColorPalette\Fields\ColorPaletteField::create(
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
	Heyday\ColorPalette\Fields\GroupedColorPaletteField::create(
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

## License

SilverStripe Color Palette Field is licensed under an [MIT license](http://heyday.mit-license.org/)
