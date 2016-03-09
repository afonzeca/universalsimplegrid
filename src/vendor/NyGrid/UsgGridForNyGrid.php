<?php

/**
 * This file contains UsgGridForNyGrid class.
 *
 * It implements the UsgGridInterface of Universal Simple Grid Package
 * and it is a part of the "driver" (wrapper) for the Nayjest/Grids (https://github.com/Nayjest/Grids)
 *
 * See the interface for details about every methods.
 *
 * @license    MIT LICENSE - see license.txt
 * @author     Copyright (C) 2016 Copyright Holder Angelo Fonzeca <angelo.fonzeca@gmail.com>
 */

namespace AFonzeca\UniversalSimpleGrid\vendor\NyGrid;

use AFonzeca\UniversalSimpleGrid\Contracts\UsgGridInterface;
use AFonzeca\UniversalSimpleGrid\Contracts\UsgGridSetupInterface;
use Nayjest\Grids\Grid;

class UsgGridForNyGrid implements UsgGridInterface
{
    protected $gridSetup;

    public function init(UsgGridSetupInterface $gridSetup)
    {
        $this->gridSetup = $gridSetup;

        return $this;
    }

    public function getGrid()
    {
        $script = $this->attachJsToGrid();
        $grid = (new Grid($this->gridSetup->getGridConfig()))->render();

        return $grid.$script;
    }

    public function attachJsToGrid()
    {

        $script =

<<<SCRIPT
<!-- Data Grid Scripts - Start -->
        <script>
        function sure(path, id, action) {
            if (confirm("Are you sure?")) {
                window.location = path + '/' + id + '/' + action;
            }
        }
        </script>
<!-- Data Grid Scripts - End -->
SCRIPT;

        return $script;
    }
}
