<?php

/**
 * This file contains UsgGridSetupForNyGrid class.
 *
 * It implements the UsgGridSetupInterface and extends UsgGridSetupAbstract
 * of Universal Simple Grid Package and it is a part of "driver" (wrapper)
 * for the Nayjest/Grids (https://github.com/Nayjest/Grids)
 *
 * See the interface for details about every methods.
 *
 * @license    MIT LICENSE - see license.txt
 * @author     Copyright (C) 2016 Copyright Holder Angelo Fonzeca <angelo.fonzeca@gmail.com>
 */

namespace AFonzeca\UniversalSimpleGrid\vendor\NyGrid;

use AFonzeca\UniversalSimpleGrid\Abstracts\UsgGridSetupAbstract;
use AFonzeca\UniversalSimpleGrid\Contracts\UsgGridSetupInterface;
use AFonzeca\UniversalSimpleGrid\Contracts\UsgWidgetsBarInterface;
use Nayjest\Grids\Components\OneCellRow;
use Nayjest\Grids\Components\TFoot;
use Nayjest\Grids\Components\THead;
use Nayjest\Grids\EloquentDataProvider;
use Nayjest\Grids\FieldConfig;
use Nayjest\Grids\FilterConfig;
use Nayjest\Grids\Grid;
use Nayjest\Grids\GridConfig;

class UsgGridSetupForNyGrid extends UsgGridSetupAbstract implements UsgGridSetupInterface
{
    protected $tHeadObj;
    protected $tFooterObj;
    protected $fields;
    protected $gdConfig;

    public function __construct()
    {
        $this->gdConfig = new GridConfig();
        $this->fields = [];

        return $this;
    }

    public function addFieldWithFilterAndOrder(
        $fieldName,
        $label = 'null',
        $filter = true,
        $sortable = true,
        $operator = null,
        $sortOrder = null
    ) {
        if (is_null($operator)) {
            $operator = FilterConfig::OPERATOR_LIKE;
        }

        if (is_null($sortOrder)) {
            $sortOrder = Grid::SORT_ASC;
        }

        $this->fields[$fieldName] = (new FieldConfig($fieldName))
            ->setLabel($label)
            ->setSortable($sortable)
            ->setSorting($sortOrder);

        if ($filter) {
            $this->fields[$fieldName]->addFilter(
                (new FilterConfig())
                ->setName($fieldName)
                ->setOperator($operator)
            );
        }

        return $this;
    }

    /* low level access
       example: $contacts_grid
                ->getFieldProperty("surname")
                ->addFilter((new FilterConfig)
                ->setName("surname")
                ->setOperator('like'));
    */
    public function &getFieldProperty($fieldName)
    {
        return $this->fields[$fieldName];
    }

    public function addGenericBsIconWithBasePath(
        $glyphicon,
        $action,
        $basePath,
        $askConfirm = false
    ) {
        $this->fields[] = (new FieldConfig($this->idField))
            ->setLabel($this->iconGenerator->makeFixedSpaces(1))
            ->setCallback(function ($val) use (
                $glyphicon,
                $action,
                $basePath,
                $askConfirm
            ) {
                return $this->iconGenerator->makeHtmlForIconAction($glyphicon, $basePath, $action, $val, $askConfirm);
            });

        return $this;
    }

    public function addGenericBsIcon($glyphicon, $action, $askConfirm = false)
    {
        $this->fields[] = (new FieldConfig($this->idField))
            ->setLabel($this->iconGenerator->makeFixedSpaces(6))
            ->setCallback(function ($val) use (
                $glyphicon,
                $action,
                $askConfirm
            ) {
                return $this->iconGenerator->makeHtmlForIconAction(
                    $glyphicon,
                    $this->basePath,
                    $action,
                    $val,
                    $askConfirm
                );
            });

        return $this;
    }

    protected function prepareAndGetGridConfig()
    {
        $this->gdConfig->setDataProvider(
            new EloquentDataProvider(
                $this->handle->getBuilder()
            )
        );
        $this->gdConfig->setColumns($this->fields);

        return $this->gdConfig;
    }

    public function attachToHead(UsgWidgetsBarInterface $bar)
    {
        if (is_null($this->tHeadObj)) {
            $this->tHeadObj = new THead();
        }

        $this->gdConfig->setComponents([
            $this->tHeadObj
                ->addComponents([
                    (new OneCellRow())
                        ->setComponents($bar->getWidgetCells()),
                ])
                ->setRenderSection(THead::SECTION_AFTER),
        ]);

        return $this;
    }

    public function attachToFooter(UsgWidgetsBarInterface $bar)
    {
        if (is_null($this->tFooterObj)) {
            $this->tFooterObj = new TFoot();
        }

        $this->gdConfig->addComponents([
                        $this->tFooterObj->setComponents($bar->getWidgetCells()),
        ]);

        return $this;
    }
}
