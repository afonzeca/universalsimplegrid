<?php

/**
 * This file contains UsgIconsInterface class for Universal Simple Grid Package.
 *
 * @license    MIT LICENSE - see license.txt
 * @author     Copyright (C) 2016 Copyright Holder Angelo Fonzeca <angelo.fonzeca@gmail.com>
 */

namespace AFonzeca\UniversalSimpleGrid\Contracts;

/**
 * UsgGridSetupInterface is the contract for the class that will manage the configuration of the Grid.
 *
 * See documentation for examples.
 *
 * @author   Angelo Fonzeca <angelo.fonzeca@gmail.com>
 *
 * @version  $Revision: 0.1 $
 */
interface UsgIconsInterface
{
    /**
     * The implemented method should return html code which represents an icon "action" to be attacched to every
     * data row of the grid. The action icon will be an http image link which will call
     * a controller with userId and action (like: /user/10/edit).
     *
     * @param    string icon        bootstrap3 Glyphicon name (short form. See other functions)
     * @param    string basePath    the controller basePath to call
     * @param    string action      the action to do on icon click
     * @param    string val         the id of the record to be manipulated
     *
     * @return   string action      the action to do on icon click
     */
    public function makeHtmlForIconAction($icon, $basePath, $action, $val, $askConfirm);

    /**
     * This method should return the name of the default bootstrap icon that will be used to show a record.
     *
     * @param    string             bootstrap3 Glyphicon name. If no parameter it shoult return the default icon,
     *                              else the value must be passed in short form (without "glyphicon glyphicon-")
     *
     * @return   string             full bootstrap3 Glyphicon name. eg. "glyphicon glyphicon-remove"
     */
    public function getBsShowIcon($icon = null);

    /**
     * This method should return the name of the default bootstrap icon that will be used to delete a record.
     *
     * @param    string icon        bootstrap3 Glyphicon name. It Should return default icon if null,
     *                              else the value must be passed in short form (without "glyphicon glyphicon-")
     *
     * @return   string             full bootstrap3 Glyphicon name. eg. "glyphicon glyphicon-remove"
     */
    public function getBsRemoveIcon($icon = null);
}
