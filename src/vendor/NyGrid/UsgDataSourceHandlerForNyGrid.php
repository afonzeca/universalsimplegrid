<?php

/**
 * This file contains UsgDataSourceHandlerForNyGrid class.
 *
 * It implements the UsgDataSourceHandlerInterface of Universal Simple Grid Package
 * and it is a part of the "driver" (wrapper) for the Nayjest/Grids (https://github.com/Nayjest/Grids)
 *
 * See the interface for details about every methods.
 *
 * @license    MIT LICENSE - see license.txt
 * @author     Copyright (C) 2016 Copyright Holder Angelo Fonzeca <angelo.fonzeca@gmail.com>
 */

namespace AFonzeca\UniversalSimpleGrid\vendor\NyGrid;

use AFonzeca\UniversalSimpleGrid\Contracts\UsgDataSourceHandlerInterface;
use Illuminate\Database\Eloquent\Builder;

class UsgDataSourceHandlerForNyGrid implements UsgDataSourceHandlerInterface
{
    protected $queryBuilder;

    public function init(Builder $queryBuilder)
    {
        $this->queryBuilder = $queryBuilder;

        return $this;
    }

    public function getBuilder()
    {
        return $this->queryBuilder;
    }
}
