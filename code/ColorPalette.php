<?php

/**
 * Color palette helper
 */
class ColorPalette extends Object
{

    /**
     * Get all colors
     *
     * @return array
     */
    static function all()
    {
        return self::config()->colors;
    }

    /**
     * Helper to convert an array to an associative array of values
     *
     * @param array $arr
     * @return array
     */
    static function values($arr)
    {
        $values = array_values($arr);
        return array_combine($values, $values);
    }

    /**
     * Get the name of a color
     *
     * @param string $hex
     * @return string
     */
    static function name($hex)
    {
        $flip = array_flip(self::all());

        // Get defined name
        if (isset($flip[$hex])) {
            return $flip[$hex];
        }

        // Make up a name
        $rgb  = self::hex2rgb($hex);
        $luma = self::luma($rgb[0], $rgb[1], $rgb[2]);

        if ($rgb[0] == $rgb[1] && $rgb[1] == $rgb[2]) {
            $name = 'grey';
        } else {
            $max = array_search(max($array), $array);
            if ($max == 0) {
                $name = 'red';
            } else if ($max == 1) {
                $name = 'green';
            } else if ($max == 2) {
                $name = 'blue';
            }
        }
        if ($luma > 0.5) {
            $name = 'light '.$name;
        } else {
            $name = 'dark '.$name;
        }
        return $name;
    }

    /**
     * Get all light colors
     *
     * @return array
     */
    static function light()
    {
        $colors = array();
        foreach (self::all() as $name => $color) {
            $rgb  = self::hex2rgb($color);
            $luma = self::luma($rgb[0], $rgb[1], $rgb[2]);
            if ($luma >= 0.5) {
                $colors[$name] = $color;
            }
        }
        return $colors;
    }

    /**
     * Get all dark colors
     * 
     * @return array
     */
    static function dark()
    {
        $colors = array();
        foreach (self::all() as $name => $color) {
            $rgb  = self::hex2rgb($color);
            $luma = self::luma($rgb[0], $rgb[1], $rgb[2]);
            if ($luma <= 0.5) {
                $colors[$name] = $color;
            }
        }
        return $colors;
    }

    /**
     * Convert hex to rgb
     *
     * @param string $hex
     * @return array
     */
    static function hex2rgb($hex)
    {
        $hex = str_replace("#", "", $hex);

        if (strlen($hex) == 3) {
            $r = hexdec(substr($hex, 0, 1).substr($hex, 0, 1));
            $g = hexdec(substr($hex, 1, 1).substr($hex, 1, 1));
            $b = hexdec(substr($hex, 2, 1).substr($hex, 2, 1));
        } else {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }
        $rgb = array($r, $g, $b);
        return $rgb;
    }

    /**
     * Get luma from rgb
     *
     * 0 is darker, 1 is lighter
     *
     * @param int $r
     * @param int $g
     * @param int $b
     * @return float
     */
    static function luma($r, $g, $b)
    {
        return (0.2126 * $r + 0.7152 * $g + 0.0722 * $b) / 255;
    }

    /**
     * Get a list suitable for TinyMCE config
     * 
     * @return string
     */
    static function tinymce()
    {
        $pieces = array_values(self::all());
        $pieces = array_map(function($item) {
            return trim($item, '#');
        }, $pieces);
        return implode(',', $pieces);
    }
}
