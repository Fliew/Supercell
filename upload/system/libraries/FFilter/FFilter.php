<?php
/**
 * @author		Fliew
 * @link		http://fliew.com
 * 
 * @package		Supercell
 * @version		2
 * @link		http://fliew.com/supercell
 * @link		http://github.com/Fliew/Supercell
 * @since		Supercell: Monday, June 08, 2008
 * @since		Supercell 2: Thursday, March 24, 2011
 * @copyright	Copyright (C) 2010 by Fliew. All rights reserved.
 * @license		GNU Library or "Lesser" General Public License version 3.0 (LGPLv3)
 * 
 * @category	FFilter
 */

class FFilter implements FFilterInterface
{
	/**
	 * Makes sure a file is an image.
	 * 
	 * @access	public
	 * @static
	 * @param	string	$filename
	 * @param	array	$ext
	 * @return	boolean
	 */
	public static function images($filename, $ext = array())
	{
		if (!$ext)
		{
			// Default Extensions
			$ext	=	array(
				'gif',
				'jpg',
				'jpeg',
				'jpe',
				'png',
				'bmp'
			);
		}
		
		$found	=	false;
		
		foreach ($ext as $extension)
		{
			if (preg_match('/\.' . $extension . '$/si', $filename))
			{
				$found	=	true;
			}
			else
			{
				continue;
			}
		}
		
		return $found;
	}
	
	/**
	 * Custom Filter
	 * 
	 * @access	public
	 * @static
	 * @param	string	$item
	 * @param	array	$filter		Where -> start, end, both, all
	 * @return	boolean
	 */
	public static function custom($item, $filter)
	{
		$found	=	false;
		
		foreach ($filter as $what => $where)
		{
			if ($where == 'start')
			{
				if (preg_match('/^' . $what . '*/si', $item))
				{
					$found	=	true;
				}
				else
				{
					continue;
				}
			}
			
			if ($where == 'end')
			{
				if (preg_match('/' . $what . '$/si', $item))
				{
					$found	=	true;
				}
				else
				{
					continue;
				}
			}
			
			if ($where == 'both')
			{
				if (preg_match('/^' . $what . '$/si', $item))
				{
					$found	=	true;
				}
				else
				{
					continue;
				}
			}
			
			if ($where == 'all')
			{
				if (preg_match('/' . $what . '/si', $item))
				{
					$found	=	true;
				}
				else
				{
					continue;
				}
			}
		}
		
		return $found;
	}
}