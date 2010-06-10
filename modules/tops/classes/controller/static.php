<?php

class controller_static extends Controller
{
    public function action_css($key, $ext)
    {
        //if (IN_PRODUCTION && self::check(300) === FALSE) self::set(300);

        $file = Kohana::find_file('views/css', basename($key, '.css'), 'css');
        if (!$file)
            throw new Kohana_Exception("No such file or directory (:filename)", array('filename'=>"$filename.$ext"));
        header('Content-Type: text/css');
        readfile($file);
        exit();
    }
    public function action_js($keys)
    {
        //if (IN_PRODUCTION && self::check(300) === FALSE) self::set(300);
        header('Content-Type: application/x-javascript');
        foreach (explode(',', $keys) as $key)
        {
            $file = Kohana::find_file('views/js', basename($key, '.js'), 'js');
            if (!$file)
                throw new Kohana_Exception("No such file or directory (:filename)", array('filename'=>"$key.js"));
            readfile($file);
        }

    }
    
    public function action_img($filename, $ext)
    {
        //if (IN_PRODUCTION && self::check(300) === FALSE) self::set(300);
        $info = pathinfo($filename);
        $file = Kohana::find_file('views/images', basename($info['basename']), $ext);
        if (!$file)
            throw new Kohana_Exception("No such file or directory (:filename)", array('filename'=>"$filename.$ext"));

        if ($ext == 'png')
            header('Content-Type: Content-Type: image/png');
        if ($ext == 'jpg')
            header('Content-Type: Content-Type: image/jpeg');
        if ($ext == 'gif')
            header('Content-Type: Content-Type: image/gif');
        if ($ext == 'ico')
            header('Content-Type: Content-Type: image/vnd.microsoft.icon');

        header('Content-Length: ' . filesize($file));
        
        ob_clean();
        flush();
        readfile($file);

    }
	
    /**
	 * Sets the amount of time before a page expires
	 *
	 * @param  integer Seconds before the page expires 
	 * @return boolean
	 */
	public static function set($seconds = 60)
	{
		if (self::check_headers())
		{
			$now = $expires = time();

			// Set the expiration timestamp
			$expires += $seconds;

			// Send headers
			header('Last-Modified: '.gmdate('D, d M Y H:i:s T', $now));
			header('Expires: '.gmdate('D, d M Y H:i:s T', $expires));
			header('Cache-Control: max-age='.$seconds);

			return $expires;
		}

		return FALSE;
	}

	/**
	 * Checks to see if a page should be updated or send Not Modified status
	 *
	 * @param   integer  Seconds added to the modified time received to calculate what should be sent
	 * @return  bool     FALSE when the request needs to be updated
	 */
	public static function check($seconds = 60)
	{
		if ( ! empty($_SERVER['HTTP_IF_MODIFIED_SINCE']) AND self::check_headers())
		{
			if (($strpos = strpos($_SERVER['HTTP_IF_MODIFIED_SINCE'], ';')) !== FALSE)
			{
				// IE6 and perhaps other IE versions send length too, compensate here
				$mod_time = substr($_SERVER['HTTP_IF_MODIFIED_SINCE'], 0, $strpos);
			}
			else
			{
				$mod_time = $_SERVER['HTTP_IF_MODIFIED_SINCE'];
			}

			$mod_time = strtotime($mod_time);
			$mod_time_diff = $mod_time + $seconds - time();

			if ($mod_time_diff > 0)
			{
				// Re-send headers
				header('Last-Modified: '.gmdate('D, d M Y H:i:s T', $mod_time));
				header('Expires: '.gmdate('D, d M Y H:i:s T', time() + $mod_time_diff));
				header('Cache-Control: max-age='.$mod_time_diff);
				header('Status: 304 Not Modified', TRUE, 304);

                print '';

				// Exit to prevent other output
				exit;
			}
		}

		return FALSE;
	}

	/**
	 * Check headers already created to not step on download or Img_lib's feet
	 *
	 * @return boolean
	 */
	public static function check_headers()
	{
		foreach (headers_list() as $header)
		{
			if ((session_cache_limiter() == '' AND stripos($header, 'Last-Modified:') === 0)
			    OR stripos($header, 'Expires:') === 0)
			{
				return FALSE;
			}
		}

		return TRUE;
	}

}
