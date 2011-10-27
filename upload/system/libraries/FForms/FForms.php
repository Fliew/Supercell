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
 * @category	FForms
 */

class FForms implements FFormsInterface
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
	public static function textbox($name, $value = '', $style = array(), $password = false, $disabled = false, $tabindex = '')
	{
		// Style
		$style_display	=	'';
		
		if (!empty($style))
		{
			$key	=	array_keys($style);
			$size	=	sizeof($key);
			
			for ($i = 0; $i < $size; $i++)
			{
				$style_display	.=	$key[$i] . '="' . $style[$key[$i]] . '" ';
			}
		}
		
		// Tab index?
		if (!empty($tabindex))
		{
			$tabindex_display	=	'tabindex="' . $tabindex . '" ';
		}
		
		if ($disabled === true)
		{
			$disabled_display	=	'disabled="true"';
		}
		
		if ($password === false)
		{
			$type	=	'text';
		}
		else
		{
			$type	=	'password';
		}
		
		// Creating item.
		$item	=	'<input type="' . ((isset($type)) ? $type : '') . '" name="' . ((isset($name)) ? $name : '') . '" value="' . ((isset($value)) ? $value : '') . '" ' . ((isset($style_display)) ? $style_display : '') . ((isset($tabindex_display)) ? $tabindex_display : '') . ((isset($disabled_display)) ? $disabled_display : '') . '/>';
		
		return $item;
	}
	
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
	public static function textarea($name, $value = '', $style = array(), $disabled = false, $tabindex = '')
	{
		// Style
		$style_display	=	'';
		
		if (!empty($style))
		{
			$key	=	array_keys($style);
			$size	=	sizeof($key);
			
			for ($i = 0; $i < $size; $i++)
			{
				$style_display	.=	$key[$i] . '="' . $style[$key[$i]] . '" ';
			}
		}
		
		// Tab index?
		if (!empty($tabindex))
		{
			$tabindex_display	=	'tabindex="' . $tabindex . '" ';
		}
		
		if ($disabled === true)
		{
			$disabled_display	=	'disabled="true"';
		}
		
		// Creating item.
		$item	=	'<textarea name="' . ((isset($name)) ? $name : '') . '" ' . ((isset($style_dislay)) ? $style_display : '') . ((isset($tabindex_display)) ? $tabindex_display : '') . ((isset($disabled_display)) ? $disabled_display : '') . '>' . ((isset($value)) ? $value : '') . '</textarea>';
		
		return $item;
	}
	
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
	public static function checkbox($name, $value, $label = '', $checked = false, $style = array(), $disabled = false, $tabindex = '')
	{
		// Style
		$style_display	=	'';
		
		if (!empty($style))
		{
			$key	=	array_keys($style);
			$size	=	sizeof($key);
			
			for ($i = 0; $i < $size; $i++)
			{
				$style_display	.=	$key[$i] . '="' . $style[$key[$i]] . '" ';
			}
		}
		
		// Checked?
		if ($checked === true)
		{
			$checked_display	=	'checked="checked" ';
		}
		
		// Tab index?
		if (!empty($tabindex))
		{
			$tabindex_display	=	'tabindex="' . $tabindex . '" ';
		}
		
		if ($disabled === true)
		{
			$disabled_display	=	'disabled="true"';
		}
		
		$item	=	'<input type="checkbox" name="' . ((isset($name)) ? $name : '') . '" value="' . ((isset($value)) ? $value : '') . '" ' . ((isset($style_display)) ? $style_display : '') . ((isset($checked_display)) ? $checked_display : '') . ((isset($tabindex_display)) ? $tabindex_display : '') . ((isset($disabled_display)) ? $disabled_display : '') . '/>';
		
		if (!empty($label))
		{
			$item	.=	'<label for="' . $id . '">' . $label . '</label>';
		}
		
		return $item;
	}
	
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
	public static function radio($name, $value, $checked = false, $style = array(), $disabled = false, $tabindex = '')
	{
		// Style
		$style_display	=	'';
		
		if (!empty($style))
		{
			$key	=	array_keys($style);
			$size	=	sizeof($key);
			
			for ($i = 0; $i < $size; $i++)
			{
				$style_display	.=	$key[$i] . '="' . $style[$key[$i]] . '" ';
			}
		}
		
		// Checked?
		if ($checked === true)
		{
			$checked_display	=	'checked="checked" ';
		}
		
		// Tab index?
		if (!empty($tabindex))
		{
			$tabindex_display	=	'tabindex="' . $tabindex . '" ';
		}
		
		if ($disabled === true)
		{
			$disabled_display	=	'disabled="true"';
		}
		
		$item	=	'<input type="radio" name="' . ((isset($name)) ? $name : '') . '" value="' . ((isset($value)) ? $value : '') . '" ' . ((isset($style_display)) ? $style_display : '') . ((isset($checked_display)) ? $checked_display : '') . ((isset($tabindex_display)) ? $tabindex_display : '') . ((isset($disabled_display)) ? $disabled_display : '') . '/>';
		
		return $item;
	}
	
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
	public static function dropdown($name, $values, $selected = '', $style = array(), $multiple = false, $disable = false, $tabindex = '', $size = '')
	{
		// Style
		$style_display	=	'';
		
		if (!empty($style))
		{
			$key	=	array_keys($style);
			$size	=	sizeof($key);
			
			for ($i = 0; $i < $size; $i++)
			{
				$style_display	.=	$key[$i] . '="' . $style[$key[$i]] . '" ';
			}
		}
		
		// Multiple?
		if ($multiple === true)
		{
			$multiple_display	=	'multiple="multiple"';
		}
		
		// Tab index?
		if (!empty($tabindex))
		{
			$tabindex_display	=	'tabindex="' . $tabindex . '" ';
		}
		
		// Disabled?
		if ($disabled === true)
		{
			$disabled_display	=	'disabled="true"';
		}
		
		// Getting values
		$item	=	'<select name="' . ((isset($name)) ? $name : '') . '" ' . ((isset($style_display)) ? $style_display : '') . ((isset($multiple_display)) ? $multiple_display : '') . ((isset($disabled_display)) ? $disabled_display : '') . ((isset($tabindex_display)) ? $tabindex_display : '') .'>' . "\n";
		
		if (!empty($values))
		{
			foreach ($values as $value => $text)
			{
				// Is it a lable?
				if (preg_match('/^[\[*\]]/', $value))
				{
					$item	.=	'	<optgroup label="' . ((isset($text)) ? $text : '') . '" />' . "\n";
				}
				else
				{
					$selected_display	=	'';
					
					// Is this one selected?
					if (!empty($selected))
					{
						if ($selected == $value)
						{
							$selected_display	=	'selected="selected"';
						}
					}
					
					$item	.=	'	<option value="' . ((isset($value)) ? $value : '') . '" ' . ((isset($selected_display)) ? $selected_display : '') . ' >' . ((isset($text)) ? $text : '') . '</option>' . "\n";
				}
			}
		}
		
		$item	.=	'</select>';
		
		return $item;
	}
	
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
	public static function button($name, $value, $style = array())
	{
		// Style
		$style_display	=	'';
		
		if (!empty($style))
		{
			$key	=	array_keys($style);
			$size	=	sizeof($key);
			
			for ($i = 0; $i < $size; $i++)
			{
				$style_display	.=	$key[$i] . '="' . $style[$key[$i]] . '" ';
			}
		}
		
		$item	=	'<input type="submit" name="' . ((isset($name)) ? $name : '') . '" value="' . ((isset($value)) ? $value : '') . '" ' . ((isset($style_display)) ? $style_display : '') . '/>';
		
		return $item;
	}
	
	/**
	 * Add a hidden field
	 * 
	 * @access	public
	 * @static
	 * @param	string	$name		Name
	 * @param	string	$value		Value
	 * @return	string
	 */
	public static function hidden($name, $value)
	{
		$item	=	'<input type="hidden" name="' . ((isset($name)) ? $name : '') . '" value="' . ((isset($value)) ? $value : '') . '" />';
		
		return $item;
	}
}