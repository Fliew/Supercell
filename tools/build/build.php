#!/usr/bin/env php
<?php
/**
 * @author		Fliew
 * @author		Riley Wiebe
 * @link		http://fliew.com
 * 
 * @package		Supercell
 * @version		2
 * @link		http://fliew.com/supercell
 * @link		http://github.com/Fliew/Supercell
 * @since		Supercell: Monday, June 08, 2008
 * @since		Supercell 2: Thursday, March 24, 2011
 * @copyright	Copyright (C) 2010 by Faintmedia. All rights reserved.
 * @license		GNU Library or "Lesser" General Public License version 3.0 (LGPLv3)
 * 
 * @category	Tools
 */

$source_dir = '../../upload/';
$help = <<<HELPDOC
\033[1mName\033[0m
\t{$_SERVER['argv']['0']}

\033[1mUses\033[0m
\tphp

\033[1mSynopsis\033[0m
\tphp build.php \033[4mUpdate Degree\033[0m [\033[4mDirectory\033[0m]
\tphp build.php \033[4m-v\033[0m [\033[4mDirectory\033[0m]
\tphp build.php \033[4m--help\033[0m

\033[1mOptions\033[0m
\t\033[4m-v\033[0m
\t\tCurrent Version Number

\t\033[4m--help\033[0m
\t\033[4m-h\033[0m
\t\033[4mh\033[0m
\t\033[4mhelp\033[0m
\t\tThe help documentation.

\033[1mUpdate Degrees\033[0m
\t\033[4m1\033[0m - Major Update
\t\033[4m2\033[0m - Minor Update
\t\033[4m3\033[0m - Maintenance

\033[1mDirectory\033[0m
\tThe path into the /upload directory
\t
\tDefault: \033[4m../../upload\033[0m


HELPDOC;

if ($_SERVER['argc'] > '1' && ($_SERVER['argv']['1'] == '1' || $_SERVER['argv']['1'] == '2' || $_SERVER['argv']['1'] == '3' || $_SERVER['argv']['1'] == '-v'))
{
	if ($_SERVER['argc'] > '2')
	{
		$source_dir = $_SERVER['argv']['2'];
	}
}
else
{
	// Help
	if ($_SERVER['argc'] > '1' && ($_SERVER['argv']['1'] == 'help' || $_SERVER['argv']['1'] == 'h' || $_SERVER['argv']['1'] == '--help' || $_SERVER['argv']['1'] == '-h'))
	{
		// Help
		echo $help;
	}
	else
	{
		echo "\033[1mUseage\033[0m\n\tphp build.php \033[4mupdate degree number\033[0m [\033[4mpath to upload directory\033[0m]\n\n\033[1mHelp\033[0m\n\tphp build.php --help\n\n";
	}
	
	exit;
}

// Make sure directory exists
if (is_dir($source_dir))
{
	// Begin build
	
	// Update package.
	$package = $source_dir . '/system/package.php';
	
	if (file_exists($package))
	{
		// Open file
		$handle = fopen($package, 'r');
		
		$contents = fread($handle, filesize($package));
		
		fclose($handle);
		
		// Find line
		$pattern = "/\@version\t?([0-9])+\.([0-9])+\.([0-9])+\.([0-9]+)\s+\(([a-z0-9]+)\)\s+([0-9]+)/";
		$match = preg_match($pattern, $contents, $matches);
		
		if ($_SERVER['argv']['1'] == '-v')
		{
			$version = "Version: {$matches['1']}.{$matches['2']}.{$matches['3']}\nBuild: {$matches['4']} ({$matches['5']})\nTime: {$matches['6']}\n";
			
			echo $version;
		}
		else
		{
			// Build version string
			// Update version
			$matches[$_SERVER['argv']['1']]++;
			
			// Update build
			$matches['4']++;
			
			// Time
			$time = time();
			
			// Build hash
			$hash = substr(md5($time), 0, 5);
			
			$version = "@version\t{$matches['1']}.{$matches['2']}.{$matches['3']}.{$matches['4']} ($hash) $time";
			
			// Update
			$contents = preg_replace($pattern, $version, $contents);
			
			// Open file
			$handle = fopen($package, 'w');
			
			fwrite($handle, $contents);
			
			fclose($handle);
		}
	}
}
else
{
	echo "The directory $source_dir does not exist.\n";
	exit;
}