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
 * @category	FLXml
 */

class FLXml implements FLXmlInterface
{
	/**
	 * Build an RSS file
	 * 
	 * @access	public
	 * @static
	 * @param	string	$title
	 * @param	string	$description
	 * @param	string	$link
	 * @param	integer	$ttl
	 * @param	array	$values
	 * @return	string
	 */
	public static function build($title, $description, $link, $ttl, $values)
	{
		// Tue, 04 Aug 2009 12:10:47 +0000
		$date	=	date('r', time());
		
		$rss	=	'';
		
		$rss	.=	'<?xml version="1.0" encoding="ISO-8859-1" ?>' . "\n\r";
		$rss	.=	'<rss version="2.0">' . "\n\r";
		$rss	.=	'<channel>' . "\n\r";
		
		// Lets begin
		// Basic info.
		$rss	.=	'<title>' . $title . '</title>' . "\n\r";
		$rss	.=	'<description>' . $description . '</description>' . "\n\r";
		$rss	.=	'<link>' . $link . '</link>' . "\n\r";
		$rss	.=	'<title>' . $date . '</title>' . "\n\r";
		$rss	.=	'<ttl>' . $ttl . '</ttl>' . "\n\r";
		
		$rss	.=	self::rss_process($values);
		
		$rss	.=	'</channel>' . "\n\r";
		$rss	.=	'</rss>' . "\n\r";
		
		return $rss;
	}
	
	/**
	 * Processes all of the values
	 * 
	 * @access	private
	 * @static
	 * @param	array	$values
	 * @return	string
	 */
	private static function rss_process($values)
	{
		$rss	=	'';
		
		foreach ($values as $name => $value)
		{
			$rss	.=	'<' . $name . '>';
			
			if (is_array($value))
			{
				$rss	.=	"\n\r" . $this->process($value) . "\n\r";
			}
			else
			{
				$rss	.=	$value;
			}
			
			$rss	.=	'</' . $name . '>' . "\n\r";
		}
		
		return $rss;
	}
	
	/**
	 * Parses XML into an array
	 * 
	 * @access	public
	 * @static
	 * @param	string	$xml
	 * @return	array
	 */
	public static function parse($xml)
	{
		$return	=	array();
		
		// Parse XML
		
		
		return $return;
	}
}