<?php

/**
 * This file contains UsgDataSourceHandlerInterface interface for Universal Simple Grid Package.
 *
 * @license    MIT LICENSE - see license.txt
 * @author     Copyright (C) 2016 Copyright Holder Angelo Fonzeca <angelo.fonzeca@gmail.com>
 */

namespace AFonzeca\UniversalSimpleGrid\Contracts;

use Illuminate\Database\Eloquent\Builder;

/**
 * UsgDataSourceHandlerInterface is the contract for the class that will pass a data source to the grid.
 *
 * See documentation for examples.
 *
 * @author   Angelo Fonzeca <angelo.fonzeca@gmail.com>
 *
 * @version  $Revision: 0.1 $
 */
interface UsgDataSourceHandlerInterface
{
    /**
     * Should get a Eloquent Builder object. It will
     * allow to get data for filling the grid.
     *
     * @param Illuminate\Database\Eloquent\Builder
     *
     * @return $this (for fluent)
     */
    public function init(Builder $queryBuilder);

     /**
      * Should returned the Eloquent Builder object set by the previous function.
      *
      * @return Illuminate\Database\Eloquent\Builder
      */
    public function getBuilder();
}
