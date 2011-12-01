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
 * @category    FCache
 */

class FCache implements FCacheInterface
{
    /**
     * @author  Riley Wiebe
     * 
     * @access  private
     * @var     string
     */
    private $filename;
    
    /**
     * @author  Riley Wiebe
     * 
     * @access  private
     * @var     string
     */
    private $path;
    
    /**
     * @author  Riley Wiebe
     * 
     * @access  private
     * @var     string
     */
    private $file;
    
    /**
     * @author  Riley Wiebe
     * 
     * @access  private
     * @var     integer
     */
    private $ttl;
    
    /**
     * @author  Riley Wiebe
     * 
     * @access  private
     * @var     boolean
     */
    private $cache;
    
    /**
     * @author  Riley Wiebe
     * 
     * @access  private
     * @var     boolean
     */
    private $started;
    
    /**
     * Begin Cache
     * 
     * @author  Riley Wiebe
     * 
     * @access  public
     * @param   string  $filename
     * @param   integer $ttl        Override Config TTL
     * @return  void
     */
    public function __construct($filename, $ttl = '')
    {
        // Init variables
        $this->filename = $filename;
        $this->path = SERVER_PATH . 'application/cache/general/';
        $this->file = $this->path . $this->filename;
        
        $config = new FConfig('cache');
        
        $this->cache = $config->setting('general_caching');
        
        if ($this->cache)
        {
            $this->start = false;
            
            // Does the path exist
            if (!is_dir($this->path))
            {
                throw new FErrors('Folder ' . $this->path . ' does not exist.');
            }
        
            $config = new FConfig('cache');
        
            $this->cache = $config->setting('general_caching');
        
            if (!empty($ttl))
            {
                $this->ttl = $ttl;
            }
            else
            {
                $this->ttl = $config->setting('general_ttl');
            }
        }
    }
    
    /**
     * Check if there is a valid cached file
     * 
     * @author  Riley Wiebe
     * 
     * @access  public
     * @return  boolean
     */
    public function is_cached()
    {
        if ($this->cache)
        {
            if (file_exists($this->file))
            {
                if ((filemtime($this->file) + $this->ttl) > time())
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }
    
    /**
     * Start caching data
     * 
     * @author  Riley Wiebe
     * 
     * @access  public
     * @return  void
     */
    public function start()
    {
        if ($this->cache)
        {
            $this->start = true;
            
            ob_start();
        }
    }
    
    /**
     * Stop caching data
     * 
     * @author  Riley Wiebe
     * 
     * @access  public
     * @return  void
     */
    public function end()
    {
        if ($this->cache)
        {
            if ($this->start)
            {
                $fp = fopen($this->file, 'w');
                
                fwrite($fp, ob_get_contents());
                
                fclose($fp);
                
                ob_end_flush();
            }
            else
            {
                throw new FErrors('Could not end a cache session that hasn\'t been started.');
            }
        }
    }
    
    /**
     * Display cached file
     * 
     * @author  Riley Wiebe
     * 
     * @access  public
     * @return  boolean
     */
    public function display()
    {
        if (file_exists($this->file))
        {
            include($this->file);
            
            return true;
        }
        else
        {
            return false;
        }
    }
    
    /**
     * Clear cached file if exists
     * 
     * @author  Riley Wiebe
     * 
     * @access  public
     * @return  boolean
     */
    public function clear()
    {
        if ($this->cache)
        {
            $file = $this->path . $this->filename;
        
            if (file_exists($file))
            {
                return unlink($file);
            }
            else
            {
                return false;
            }
        }
    }
}