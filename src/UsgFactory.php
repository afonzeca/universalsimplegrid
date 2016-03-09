<?php
/**
 * This file contains UsgFactory class for Universal Simple Grid Package.
 *
 * @license    MIT LICENSE - see license.txt
 * @author     Copyright (C) 2016 Copyright Holder Angelo Fonzeca <angelo.fonzeca@gmail.com>
 */

namespace AFonzeca\UniversalSimpleGrid;

/**
 * This file contains UsgFactory for making all the class of Universal Simple Grid.
 *
 * NOTE: Due to the small size of this project I made
 * this factory class as simple as possible, so it will instantiate EVERY type of
 * class for the project according to the $vendor and $type parameters passed
 * in the factory static method.
 * I know that this factory implementation doesn't respect the full factory
 * design pattern. Sorry about that.
 * Maybe in the future releases, I'll improve it.
 *
 * @license    MIT LICENSE - see license.txt
 * @author     Copyright (C) 2016 Copyright Holder Angelo Fonzeca <angelo.fonzeca@gmail.com>
 */
class UsgFactory
{
    /**
     * This method takes as input the "vendor" name
     * and then the "type" of class to be made.
     *
     * This is an easy way to instantiate all the Universal Simple Grid classes
     * for a specified vendor
     *
     * Example of parameters for the NyGrid vendor driver:
     *
     * $vendor = "NyGrid"
     * $type = "GridSetup" -> It will instantiate NyGrid/UsgGridSetupForNyGrid class
     *
     *
     * @param $vendor - the vendor name of the "driver" to be used (eh. NyGrid)
     * @param $type - the class name to be called (without prefix "Usg" and "For??Grid"
     *
     * @throws Exception - if the class or vendor doesn't exists
     *
     * @return mixed - the class of a specified vendor
     */
    public static function factory($vendor, $type)
    {
        $UsgClassName = sprintf(
            "AFonzeca\UniversalSimpleGrid\\vendor\\%s\\Usg%sFor%s",
            $vendor,
            $type,
            $vendor
        );

        if (class_exists($UsgClassName)) {
            return new $UsgClassName();
        }

        throw new \Exception("Error while creating $UsgClassName. Please,
        check the type of class ($type) or vendor($vendor).");
    }
}
