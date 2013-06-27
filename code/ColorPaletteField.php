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
}
