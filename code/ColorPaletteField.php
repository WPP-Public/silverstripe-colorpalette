<?php

class ColorPaletteField extends OptionsetField
{
    public function Field($properties = array())
    {
        Requirements::css(COLORPALETTE_DIR . '/css/ColorPaletteField.css');

        return parent::Field($properties);
    }
}