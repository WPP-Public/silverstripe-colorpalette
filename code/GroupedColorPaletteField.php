<?php

/**
 * Class GroupedColorPaletteField
 */
class GroupedColorPaletteField extends GroupedDropdownField
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
                            'ID'         => $itemID,
                            'Class'      => $extraClass,
                            'Name'       => $this->name,
                            'Value'      => $value,
                            'Title'      => $color,
                            'isChecked'  => $value == $this->value,
                            'isDisabled' => $this->disabled || in_array($value, $this->disabledItems),
                        ));
                    }

                    $groups[] = new ArrayData(
                        array(
                            'ID'         => $this->ID() . '_' . preg_replace('/[^a-zA-Z0-9]/', '', $name),
                            'extraClass' => $fieldExtraClass,
                            'Name'       => $name,
                            'Options'    => new ArrayList($options)
                        )
                    );

                } else {
                    throw new InvalidArgumentException('To use GroupedColorPaletteField you need to pass in an array of array\'s');
                }
            }
        }

        $properties = array_merge(
            $properties,
            array(
                'Groups' => new ArrayList($groups)
            )
        );

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

    /**
     * Gets a readonly version of the field
     * @return GroupedColorPaletteField_Readonly
     */
    public function performReadonlyTransformation()
    {
		// Source and values are DataObject sets.
		$field = $this->castedCopy('GroupedColorPaletteField_Readonly');
		$field->setSource($this->getSource());
		$field->setReadonly(true);

		return $field;
	}
}

class GroupedColorPaletteField_Readonly extends LookupField
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
     * Gets the label of the group that the color appears in
     * @return string
     */
    public function getSelectedGroup()
    {
        $source = $this->getSource();
        
        if ($source) {
            foreach($source as $groupName => $values) {
                if (is_array($values)) {
                    if (array_key_exists($this->value, $values)) {
                        return $groupName;
                    }
                } else {
                    throw new InvalidArgumentException('To use GroupedColorPaletteField you need to pass in an array of array\'s');
                }
            }
        }
    }
}
