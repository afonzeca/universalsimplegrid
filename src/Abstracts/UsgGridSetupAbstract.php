<?php

/**
 * This file contains UsgGridSetupAbstract class for Universal Simple Grid Package.
 *
 * @license    MIT LICENSE - see license.txt
 * @author     Copyright (C) 2016 Copyright Holder Angelo Fonzeca <angelo.fonzeca@gmail.com>
 */

namespace AFonzeca\UniversalSimpleGrid\Abstracts;

use AFonzeca\UniversalSimpleGrid\Contracts\UsgGridSetupInterface;
use AFonzeca\UniversalSimpleGrid\Contracts\UsgIconsInterface;
use AFonzeca\UniversalSimpleGrid\Contracts\UsgDataSourceHandlerInterface;

/**
 * UsgGridSetupAbstract is an abstract class with some implemented methods for the grid configuration.
 *
 * UsgGridSetupAbstract can be used as base class for the vendor' implementation, for
 * basic functions regarding the grid configuration.
 *
 * See also the interface UsgGridSetupInterface.
 *
 * See documentation for examples.
 *
 * @author   Angelo Fonzeca <angelo.fonzeca@gmail.com>
 *
 * @version  $Revision: 0.1 $
 */
abstract class UsgGridSetupAbstract implements UsgGridSetupInterface
{
    const NO_BASE_PATH_PROVIDED = 1;
    const NO_PRIMARY_KEY_PROVIDED = 2;
    const NO_QUERY_BUILDER_PROVIDER = 3;
    const ACTION_DELETE = 'delete';
    const ACTION_EDIT = 'edit';

    protected $basePath;
    protected $idField;
    protected $iconGenerator;
    protected $handle;

    /**
     * Set the concrete class to be used for querying
     * and retrive data from DB (Eloquent Query Builder).
     *
     * @param  UsqQueryBuilderHandlerInterface (valid class implementation of)
     *
     * @return $this (for fluent)
     */
    public function setBuilder(UsgDataSourceHandlerInterface $handle)
    {
        $this->handle = $handle;

        return $this;
    }

    /**
     * Set the basePath of controller. Used when the user clicks on generated
     * icons (example "/user/edit").
     *
     * @param  string
     *
     * @return $this (for fluent)
     */
    public function setBasePath($basePath)
    {
        $this->basePath = $basePath;

        return $this;
    }

    /**
     * Set the Key to be used for editing/deleting/etc.
     * (example "id").
     *
     * @param  string
     *
     * @return $this (for fluent)
     */
    public function setIdKey($idKey)
    {
        $this->idField = $idKey;

        return $this;
    }

    /**
     * Set the Object which contains the code to represent edit/delete/view icons.
     *
     * @param  UsgIconInterface
     *
     * @return $this (for fluent)
     */
    public function setIcons(UsgIconsInterface $iconMaker)
    {
        $this->iconGenerator = $iconMaker;

        return $this;
    }

    /**
     * It generates the code for the Edit Icon.
     *
     * @return $this (for fluent)
     */
    public function addBsEditIcon()
    {
        $this->addGenericBsIcon(
            $this->iconGenerator->getBsShowIcon(),
            self::ACTION_EDIT
        );

        return $this;
    }

    /**
     * It generates the code for the Trash Icon.
     *
     * @return $this (for fluent)
     */
    public function addBsTrashIcon()
    {
        $this->addGenericBsIcon(
            $this->iconGenerator->getBsRemoveIcon(),
            self::ACTION_DELETE,
            true
        );

        return $this;
    }

    /**
     * Add the timestamps fields to the Grid.
     *
     * @return $this (for fluent)
     */
    public function addTimestamps()
    {
        $this->addFieldWithFilterAndOrder('created_at', 'Created At');
        $this->addFieldWithFilterAndOrder('updated_at', 'Updated At');

        return $this;
    }

    /**
     * Gets an array of Key=>Value for grid creation.
     * The "key" is the field name of the table that will be represented into the grid
     * the "value" is the label to be used
     * (e.g. ["usrName"=>"User Name", "email","E-Mail"]).
     *
     * @param array
     * @param fieldsList - array of field as described above
     * @param filter - specify if the grid must show a field for filtering the column
     * @param sortable - specify if the grid must show button for ordering by specific column
     * @param operator - specify which operator must be used for filtering (e.g. LIKE).
     * @param sortOrder - specify a particular order (A-Z / Z-A / etc.)
     *
     * @return $this (for fluent)
     */
    public function addFieldsWithFilterAndOrderFromArray(
        $fieldsList,
        $filter = true,
        $sortable = true,
        $operator = null,
        $sortOrder = null
    ) {
        foreach ($fieldsList as $key => $value) {
            $this->addFieldWithFilterAndOrder($key, $value, $filter, $sortable, $operator, $sortOrder);
        }

        return $this;
    }

    /**
     * Gets an array of Keys=>Values for the grid creation.
     * The "key" is the field name of the table that will be represented into the grid
     * the "value" is an array
     * which contains ["labelName",filter value(T/F), sortable(T/F), operator
     * (null or grid framework specific value), sortOrder(null or grid framework
     * specific value)].
     * For example ["name" => ["Name",true,true,null,null]].
     *
     * @param  array
     *
     * @return $this (for fluent)
     */
    public function addRawFieldsFromArray($fieldsList)
    {
        foreach ($fieldsList as $key => $value) {
            $this->addFieldWithFilterAndOrder($key, $value[0], $value[1], $value[2], $value[3], $value[4]);
        }

        return $this;
    }

    /**
     * Check if the correct parameters has been set via fluent interface then return
     * the gridConfiguration according to the vendor/grid used.
     *
     * The called method prepareAndGetGridConfig is abstract. Must be overridden by
     * the vendor specific implementation
     *
     *
     * @return $this (for fluent)
     */
    public function getGridConfig()
    {
        $this->checkParameters();

        return $this->prepareAndGetGridConfig();
    }

    /**
     * Check if the correct parameters has been set via fluent interface.
     * If not an exception will be throw.
     *
     * @throws Exception if the parameters are null
     */
    private function checkParameters()
    {
        if (is_null($this->basePath)) {
            throw new \Exception(
                'No base path provided',
                $this->NO_BASE_PATH_PROVIDED
            );
        }

        if (is_null($this->idField)) {
            throw new \Exception(
                'No model primary key provided',
                $this->NO_PRIMARY_KEY_PROVIDED
            );
        }

        if (is_null($this->handle)) {
            throw new \Exception(
                'No model primary key provided',
                $this->NO_QUERY_BUILDER_PROVIDER
            );
        }
    }

    // This method is not mandatory for the interface (public API), but it is mandatory
    // via the abstact class (according to the getGridConfig method)
    abstract protected function prepareAndGetGridConfig();
    
}
