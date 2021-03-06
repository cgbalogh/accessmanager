<?php
namespace CGB\Accessmanager\UserFunc;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2017 Christoph Balogh <cb@lustige-informatik.at>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
* Class TcaUserFunc
*/
class TcaUserFunc {

    /**
     * 
     * @param type $PA
     * @param type $fObj
     */
    public function getDomainModelObjects($PA, $fObj) {
        if ( file_exists(PATH_site.'typo3temp/autoload/autoload_classmap.php')) {
            // for Typo3 7.6.x
            $classes = include PATH_site.'typo3temp/autoload/autoload_classmap.php';
        } elseif ( file_exists(PATH_site.'typo3conf/autoload/autoload_classmap.php')) {
            // for Typo3 8.x.x
            $classes = include PATH_site.'typo3conf/autoload/autoload_classmap.php';
        } else {
            $classes = [];
        }

        // 
        // cycle all classes and add to item list if class name containes \Domain\Model
        //
        foreach($classes as $classname => $location) {
            // if no vendor is given, all classes will be listed
            if (strpos($classname, '\\Domain\\Model\\') !== false) {
                \array_push($PA['items'], array($classname ,$classname));
            }
        }
    }

}