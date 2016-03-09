<?php

/**
 * This file contains UsgWidgetsBarForNyGrid class.
 *
 * It implements the UsgWidgetsBarInterface of Universal Simple Grid Package
 * and it is a part of the "driver" (wrapper) for the Nayjest/Grids (https://github.com/Nayjest/Grids)
 *
 * See the interface for details about every methods.
 *
 * @license    MIT LICENSE - see license.txt
 * @author     Copyright (C) 2016 Copyright Holder Angelo Fonzeca <angelo.fonzeca@gmail.com>
 */

namespace AFonzeca\UniversalSimpleGrid\vendor\NyGrid;

use Mockery\Exception;
use Nayjest\Grids\Components\ColumnsHider;
use Nayjest\Grids\Components\HtmlTag;
use Nayjest\Grids\Components\Laravel5\Pager;
use Nayjest\Grids\Components\OneCellRow;
use Nayjest\Grids\Components\RecordsPerPage;
use AFonzeca\UniversalSimpleGrid\Contracts\UsgWidgetsBarInterface;

class UsgWidgetsBarForNyGrid implements UsgWidgetsBarInterface
{
    protected $cells;

    public function addPagination()
    {
        $this->cells[] = (new OneCellRow())->addComponent(new Pager());

        return $this;
    }

    public function addWidgetRecordsPerPage($range = [10, 100, 500])
    {
        $this->cells[] = (new RecordsPerPage())->setVariants($range);

        return $this;
    }

    public function addCustom($customObj)
    {
        $this->cells[] = $customObj;

        return $this;
    }

    public function addWidgetHideColumns($columns = null)
    {
        if (!is_array($columns)) {
            throw new Exception('Expected parameters array');
        }

        $this->cells[] = (new ColumnsHider())
            ->setHiddenByDefault($columns);

        return $this;
    }

    public function addWidgetDoButton($name = 'Filter')
    {
        $this->cells[] = (new HtmlTag())
                        ->setTagName('button')
                        ->setAttributes([
                                        'type' => 'submit',
                                        # Some bootstrap classes
                                        'class' => 'btn btn-primary',
                                        ])
                        ->setContent($name);

        return $this;
    }

    public function getWidgetCells()
    {
        return $this->cells;
    }
}
