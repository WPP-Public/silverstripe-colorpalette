<?php

/**
 * Class ColorPaletteField
 */
class ColorPaletteField extends OptionsetField
{
    /**
     * @param array $properties
     * @return HTMLText
     */
    public function Field($properties = array())
    {
        Requirements::css(COLORPALETTE_DIR . '/css/ColorPaletteField.css');

        return parent::Field($properties);
    }

    /**
     * Gets a readonly version of the field
     * @return ColorPaletteField_Readonly
     */
    public function performReadonlyTransformation()
    {
		// Source and values are DataObject sets.
		$field = $this->castedCopy('ColorPaletteField_Readonly');
		$field->setSource($this->getSource());
		$field->setReadonly(true);

		return $field;
	}
}

class ColorPaletteField_Readonly extends LookupField
{
    /**
     * @param array $properties
     * @return HTMLText
     */
    public function Field($properties = array())
    {
        Requirements::css(COLORPALETTE_DIR . '/css/ColorPaletteField.css');

        return parent::Field($properties);
    }
}
