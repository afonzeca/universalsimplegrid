<?php

/**
 * This file contains UsgGlyphiconIconsForNyGrid class.
 *
 * It implements the UsgIconsInterface of Universal Simple Grid Package
 * and it is a part of the "driver" (wrapper) for the Nayjest/Grids (https://github.com/Nayjest/Grids)
 *
 * See the interface for details about every methods.
 *
 * @license    MIT LICENSE - see license.txt
 * @author     Copyright (C) 2016 Copyright Holder Angelo Fonzeca <angelo.fonzeca@gmail.com>
 */

namespace AFonzeca\UniversalSimpleGrid\vendor\NyGrid;

use AFonzeca\UniversalSimpleGrid\Contracts\UsgIconsInterface;

class UsgGlyphiconIconsForNyGrid implements UsgIconsInterface
{
    public function makeHtmlForIconAction($icon, $basePath, $action, $val, $askConfirm)
    {
        if ($askConfirm) {
            return('<a href="#" onclick="sure(\'/'
             .$basePath.'\','.$val.',\''
             .strtolower($action).'\');" ><span class="glyphicon '
             .$icon.'"></span></a>').$this->makeFixedSpaces(2);
        }

        return '<a href="/'.$basePath.'/'.$val.'/'
              .strtolower($action).'"><span class="glyphicon '
              .$icon.'"></span></a>'.$this->makeFixedSpaces(2);
    }

    public function getBsShowIcon($icon = null)
    {
        if (is_null($icon)) {
            $icon = 'eye-open';
        }

        return sprintf('glyphicon glyphicon-%s', $icon);
    }

    public function getBsRemoveIcon($icon = null)
    {
        if (is_null($icon)) {
            $icon = 'remove';
        }

        return sprintf('glyphicon glyphicon-%s', $icon);
    }

    public function makeFixedSpaces($num)
    {
        return str_repeat('&nbsp;', $num);
    }
}
