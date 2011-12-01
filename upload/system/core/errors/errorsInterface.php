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
 * @copyright   Copyright (C) 2010 by Faintmedia. All rights reserved.
 * @license     GNU Library or "Lesser" General Public License version 3.0 (LGPLv3)
 * 
 * @category    core
 */

interface FErrorsInterface
{
    /**
     * Exceptions extension
     * 
     * @author  Riley Wiebe
     * 
     * @access  public
     * @return  void
     */
    public function __construct($message, $code = 0, Exception $previous = null);
    
    /**
     * Handle the errors
     * 
     * @author  Riley Wiebe
     * 
     * @access  public
     * @return  void
     */
    public function handle();
}