<?php
/**
 * @author      Fliew
 * @link        http://fliew.com
 * 
 * @package     Supercell
 * @version     2
 * @link        http://fliew.com/supercell
 * @link        http://github.com/Fliew/Supercell
 * @since       Supercell: Monday, June 08, 2008
 * @since       Supercell 2: Thursday, March 24, 2011
 * @copyright   Copyright (C) 2010 by Fliew. All rights reserved.
 * @license     GNU Library or "Lesser" General Public License version 3.0 (LGPLv3)
 * 
 * @category    FFilter
 */

interface FFilterInterface
{
    /**
     * Makes sure a file is an image.
     * 
     * @access  public
     * @static
     * @param   string  $filename
     * @param   array   $ext
     * @return  boolean
     */
    public static function images($filename, $ext = array());
    
    /**
     * Custom Filter
     * 
     * @access  public
     * @static
     * @param   string  $item
     * @param   array   $filter     Where -> start, end, both, all
     * @return  boolean
     */
    public static function custom($item, $filter);
}