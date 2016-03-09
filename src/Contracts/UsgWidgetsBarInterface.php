<?php

/**
 * This file contains  class for Universal Simple Grid Package.
 *
 * @license    MIT LICENSE - see license.txt
 * @author     Copyright (C) 2016 Copyright Holder Angelo Fonzeca <angelo.fonzeca@gmail.com>
 */

namespace AFonzeca\UniversalSimpleGrid\Contracts;

/**
 * UsgWidgetBarInterface is a contract for the vendor class that will implement
 * a Bar (container of widgets added by the methods of the class).
 *
 * See documentation for examples.
 *
 * @author   Angelo Fonzeca <angelo.fonzeca@gmail.com>
 *
 * @version  $Revision: 0.1 $
 */
interface UsgWidgetsBarInterface
{
    /**
     * Should add a pagination widget to the bar.
     *
     * @return $this (for fluent)
     */
    public function addPagination();

    /**
     * Should specify how many records must be displayed in the grid
     * per page.
     *
     * @return $this (for fluent)
     */
    public function addWidgetRecordsPerPage($range = [10, 100, 500]);

    /**
     * Should attach low level custom object (for specific vendor implementation) to the bar.
     *
     * @return $this (for fluent)
     */
    public function addCustom($customObj);

    /**
     * Should hide the fields in the array.
     *
     * @return $this (for fluent)
     */
    public function addWidgetHideColumns($columns = null);

    /**
     * Should add a button to filter via filter fileds.
     *
     * @return $this (for fluent)
     */
    public function addWidgetDoButton($name = 'Filter');

    public function getWidgetCells();
}
