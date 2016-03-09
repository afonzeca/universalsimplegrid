<?php

/**
 * This file contains UsgGridInterface class for Universal Simple Grid Package.
 *
 * @license    MIT LICENSE - see license.txt
 * @author     Copyright (C) 2016 Copyright Holder Angelo Fonzeca <angelo.fonzeca@gmail.com>
 */

namespace AFonzeca\UniversalSimpleGrid\Contracts;

/**
 * UsgGridSetupInterface is the contract for the class that will manage the configuration of the Grid.
 *
 * See documentation for examples and Abstracts/UsgGridSetupAbstract.
 *
 * @author   Angelo Fonzeca <angelo.fonzeca@gmail.com>
 *
 * @version  $Revision: 0.1 $
 */
interface UsgGridSetupInterface
{
    // Fields and buttons adders

    /**
     * Should gets an array of Key=>Value (fields) for creating the grid.
     *
     * The "key" will be the field name, the "value" will be the label to be used
     * (e.g. ["usrName"=>"User Name", "email","E-Mail"]).
     *
     * @param fieldName - the name of db field to represent
     * @param label - the label to show in the grid for the field
     * @param filter - specify if the grid must show a field for filtering the column
     * @param sortable - specify if the grid must show button for ordering by specific column
     * @param operator - specify which operator must be used for filtering (e.g. LIKE).
     * @param sortOrder - specify a particular order (A-Z / Z-A / etc.)
     *
     * @return must return the class (for fluent)
     */
    public function addFieldWithFilterAndOrder(
        $fieldName,
        $label = 'null',
        $filter = true,
        $sortable = true,
        $operator = null,
        $sortOrder = null
    );

    /**
     * Should get an array of Key=>Value (fields) for creating the grid.
     *
     * The "key" will be the field name, the "value" will be the label to be used
     * (e.g. ["usrName"=>"User Name", "email","E-Mail"]).
     * The other parameters defines optional functionalities for the fields (should be applied to all).
     *
     * @param fieldsList - array of field as described above
     * @param filter - specify if the grid must show a field for filtering the column
     * @param sortable - specify if the grid must show button for ordering by specific column
     * @param operator - specify which operator must be used for filtering (e.g. LIKE).
     *                   It differs for specific vendor implementation
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
    );

    /**
     * Should get an array of Key=>Value (fields) for creating the grid.
     *
     * The "key" will be the field name, the "value" will be an array
     * which will contain ["labelName",filter value(T/F), sortable(T/F), operator
     * (null or grid framework specific value), sortOrder(null or grid framework
     * specific value)].
     *
     * The meanings of every field are:
     * filter - specify if the grid must show a field for filtering the column
     * sortable - specify if the grid must show button for ordering by specific column
     * operator - specify which operator must be used for filtering (e.g. LIKE).
     *            It differs for specifi vendor implementation
     * sortOrder - specify a particular order (A-Z / Z-A / etc.)
     *
     * For example ["name" => ["Name",true,true,null,null]].
     *
     * @param  array
     *
     * @return $this (for fluent)
     */
    public function addRawFieldsFromArray($fieldsList);

    /**
     * Should generate the html code for the Edit Icon.
     *
     * @return $this (for fluent)
     */
    public function addBsEditIcon();

    /**
     * Should generate the code for the Trash Icon.
     *
     * @return $this (for fluent)
     */
    public function addBsTrashIcon();

    /**
     * Should generate the html code for a link for a bootstrap icon (for calling an action).
     *
     * @parameter glyphicon - string - the name of bootstrap glyphicon without "glyphicon glyphicon-"
     * @parameter action - string - the action to be taken when the user clicks on the icon (e.g. /users/edit)
     * @parameter askConfirm - boolean - a confirm message is required before taking an action (via javascript, etc.)
     *
     * @return $this (for fluent)
     */
    public function addGenericBsIcon($glyphicon, $action, $askConfirm = false);

    /**
     * Should add the timestamps fields to the Grid.
     *
     * @return $this (for fluent)
     */
    public function addTimestamps();

    // Parameters Setters

    /**
     * Should set the concrete class to be used for querying
     * and retrive data from DB (Eloquent Query Builder).
     *
     * @param  UsgDataSourceHandlerInterface (valid class implementation of)
     *
     * @return $this (for fluent)
     */
    public function setBuilder(UsgDataSourceHandlerInterface $handle);

    /**
     * Should set the basePath of controller. Should be used when the user clicks on generated
     * icons (example "/user/edit").
     *
     * @param  string
     *
     * @return $this (for fluent)
     */
    public function setBasePath($basePath);

    /**
     * Should set the Key to be used for editing/deleting/etc.
     * (example "id").
     *
     * @param  string
     *
     * @return $this (for fluent)
     */
    public function setIdKey($idKey);

    /**
     * Should set the Object which contains the code to represent edit/delete/view icons.
     *
     * @param  UsgIconInterface
     *
     * @return $this (for fluent)
     */
    public function setIcons(UsgIconsInterface $iconMaker);

    // Attacher Widgets Bar

    /**
     * Should set the Object which contains a set of widgets that will be attached on the upper
     * part of the grid.
     *
     * @param  UsgIconInterface
     *
     * @return $this (for fluent)
     */
    public function attachToHead(UsgWidgetsBarInterface $bar);

    /**
     * Should set the Object which contains a set of widgets to be attached on the lower
     * part of the grid.
     *
     * @param  UsgIconInterface
     *
     * @return $this (for fluent)
     */
    public function attachToFooter(UsgWidgetsBarInterface $bar);

    // Getters

    public function getFieldProperty($fieldName);

    /**
     * Schould check if the correct parameters has been set via fluent interface
     * and then will return the gridConfiguration according to the vendor/grid used.
     *
     * @return $this (for fluent)
     */
    public function getGridConfig();
}
