<?php

/**
 * Class GroupedColorPaletteField
 */
class GroupedColorPaletteField extends DropdownField
{
    /**
     * @param array $properties
     * @throws InvalidArgumentException
     * @return HTMLText
     */
    public function Field($properties = array())
    {
        Requirements::css(COLORPALETTE_DIR . '/css/ColorPaletteField.css');

        $source = $this->getSource();

        $odd = 0;
        $fieldExtraClass = $this->extraClass();
        $groups = array();

        if ($source) {
            foreach ($source as $name => $values) {
                if (is_array($values)) {
                    $options = array();

                    foreach ($values as $value => $color) {
                        $itemID = $this->ID() . '_' . preg_replace('/[^a-zA-Z0-9]/', '', $value);
                        $odd = ($odd + 1) % 2;
                        $extraClass = $odd ? 'odd' : 'even';
                        $extraClass .= ' val' . preg_replace('/[^a-zA-Z0-9\-\_]/', '_', $value);

                        $options[] = new ArrayData(array(
                            'ID' => $itemID,
                            'Class' => $extraClass,
                            'Name' => $this->name,
                            'Value' => $value,
                            'Title' => $color,
                            'isChecked' => $value == $this->value,
                            'isDisabled' => $this->disabled || in_array($value, $this->disabledItems),
                        ));
                    }

                    $groups[] = new ArrayData(
                        array(
                            'ID' => $this->ID() . '_' . preg_replace('/[^a-zA-Z0-9]/', '', $name),
                            'extraClass' => $fieldExtraClass,
                            'Name' => $name,
                            'Options' => new ArrayList($options)
                        )
                    );

                } else {
                    throw new InvalidArgumentException('To use GroupedColorPaletteField you need to pass in an array of array\'s');
                }
            }
        }

        $properties = array_merge($properties, array(
            'Groups' => new ArrayList($groups)
        ));

        return $this->customise($properties)->renderWith(
            $this->getTemplates()
        );
    }

    /**
     * @return string
     */
    public function Type()
    {
        return 'groupedcolorpalette colorpalette';
    }
}
