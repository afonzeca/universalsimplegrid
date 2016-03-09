<?php

/**
 * This file contains UsgGridInterface interface for Universal Simple Grid Package.
 *
 * @license    MIT LICENSE - see license.txt
 * @author     Copyright (C) 2016 Copyright Holder Angelo Fonzeca <angelo.fonzeca@gmail.com>
 */

namespace AFonzeca\UniversalSimpleGrid\Contracts;

/**
 * UsgGridInterface is the contract for the class that will manage the Grid creation
 * according to the configuration passed
 *
 * See documentation for examples.
 *
 * @author   Angelo Fonzeca <angelo.fonzeca@gmail.com>
 *
 * @version  $Revision: 0.1 $
 */
interface UsgGridInterface
{
    /**
     * Should get a class that implements the UsgGridSetupInterface.
     * It will allow to get data for filling the grid.
     *
     * @param UsgGridSetupInterface (instance of)
     *
     * @return $this (for fluent)
     */
    public function init(UsgGridSetupInterface $gridSetup);

    /**
     * The grid generator.
     *
     * @return string (the whole HTML to be printed inside view which represent the grid)
     */
    public function getGrid();

    /**
     * The AIM is to attach JS used by buttons or the grid itself to the Grid HTML generated code
     *
     * @return string (the whole JS to be attached to the grid HTML - should be called by getGrid)
     */
    public function attachJsToGrid();
}
