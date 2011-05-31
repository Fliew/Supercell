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
 * @category	FLForms
 */

interface FLFormsInterface
{
	/**
	 * Creates a textbox
	 * 
	 * @access	public
	 * @static
	 * @param	string	$name			Textbox Name
	 * @param	string	$value			Value
	 * @param	array	$style			CSS Class or ID
	 * @param	boolean	$password		Password Field
	 * @param	boolean	$disabled		Item Disabled
	 * @param	integer	$tabindex		Tab Index Value
	 * @return	string					The Created Textbox
	 */
	public static function textbox($name, $value = '', $style = array(), $password = false, $disabled = false, $tabindex = '');
	
	/**
	 * Creates a textarea
	 * 
	 * @access	public
	 * @static
	 * @param	string	$name			Textarea Name
	 * @param	string	$value			Value
	 * @param	array	$style			CSS Class or ID
	 * @param	boolean	$disabled		Item Disabled
	 * @param	integer	$tabindex		Tab Index Value
	 * @return	string					The Created Textarea
	 */
	public static function textarea($name, $value = '', $style = array(), $disabled = false, $tabindex = '');
	
	/**
	 * Creates a checkbox
	 * 
	 * @access	public
	 * @static
	 * @param	string	$name			Checkbox Name
	 * @param	string	$value			Value
	 * @param	string	$label			Label
	 * @param	boolean	$checked		Selected
	 * @param	array	$style			CSS Class or ID
	 * @param	boolean	$disabled		Item Disabled
	 * @param	integer	$tabindex		Tab Index Value
	 * @return	string					The Created Checkbox
	 */
	public static function checkbox($name, $value, $label = '', $checked = false, $style = array(), $disabled = false, $tabindex = '');
	
	/**
	 * Creates a radio button
	 * 
	 * @access	public
	 * @static
	 * @param	string	$name			Group Name
	 * @param	string	$value			Value
	 * @param	boolean	$checked		Checked
	 * @param	array	$style			CSS Class or ID
	 * @param	boolean	disabled		Item Disabled
	 * @param	integer	$tabindex		Tab Index Value
	 * @return	string					The Created Textbox
	 */
	public static function radio($name, $value, $checked = false, $style = array(), $disabled = false, $tabindex = '');
	
	/**
	 * Create a drop down menu
	 * 
	 * @access	public
	 * @static
	 * @param	string	$name			Drop Down Name
	 * @param	array	$values			Items and Values
	 * @param	string	$selected		Selected Item
	 * @param	array	$style			CSS Class or ID
	 * @param	boolean	$multiple		Multiple Items
	 * @param	boolean	$disable		Disabled Item
	 * @param	integer	$tabindex		Tab Index
	 * @param	mixed	$size			Interger or empty
	 * @return	string					The Created Drop Down
	 */
	public static function dropdown($name, $values, $selected = '', $style = array(), $multiple = false, $disable = false, $tabindex = '', $size = '');
	
	/**
	 * Create a button
	 * 
	 * @access	public
	 * @static
	 * @param	string	$name		Name
	 * @param	string	$value		Button Label
	 * @param	array	$style		Style
	 * @return	string
	 */
	public static function button($name, $value, $style = array());
	
	/**
	 * Add a hidden field
	 * 
	 * @access	public
	 * @static
	 * @param	string	$name		Name
	 * @param	string	$value		Value
	 * @return	string
	 */
	public static function hidden($name, $value);
}