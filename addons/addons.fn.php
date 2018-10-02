<?php
function format_date($date)
{
	$entry = trim($date);
	if (strstr($entry, "/"))
	{
		$date      = explode("/", $entry);
		$time      = date('H:i:s');
		$formatted = $date[ 2 ] . '-' . $date[ 1 ] . '-' . $date[ 0 ] . ' ' . $time;
	}
	return $formatted;
}
function __slug($slug)
{
	$caracteresPerigosos = array(
"Ã",		"ã",		"Õ",		"õ",		"á",		"Á",		"é",		"É",		"í",		"Í",		"ó",		"Ó",		"ú",		"Ú",		"ç",		"Ç",		"à",		"À",		"è",		"È",		"ì",		"Ì",		"ò",		"Ò",		"ù",		"Ù",		"ä",		"Ä",		"ë",		"Ë",		"ï",		"Ï",		"ö",		"Ö",		"ü",		"Ü",		"Â",		"Ê",		"Î",		"Ô",		"Û",		"â",		"ê",		"î",		"ô",		"û",		"!",		"?",		",",		"-",		"\"",		"\\",		"/",		" "
	);
	$caracteresLimpos    = array(
"A",		"a",		"O",		"o",		"a",		"A",		"e",		"E",		"i",		"I",		"o",		"O",		"u",		"U",		"c",		"C",		"a",		"A",		"e",		"E",		"i",		"I",		"o",		"O",		"u",		"U",		"a",		"A",		"e",		"E",		"i",		"I",		"o",		"O",		"u",		"U",		"A",		"E",		"I",		"O",		"U",		"a",		"e",		"i",		"o",		"u",		"-",		"-",		"-",		"-",		"-",		"-",		"-",		"-"
	);
	$slug                = str_replace($caracteresPerigosos, $caracteresLimpos, $slug);
	return $slug;
}
function __POST($post)
{
	if (is_array($post))
	{
		foreach ($post as $newPost)
		{
			$GLOBALS[ "$newPost" ] = trim($_POST[ "$newPost" ]);
		}
	}
	else
		$GLOBALS[ "$post" ] = trim($_POST[ "$post" ]);
}
function __GET($get)
{
	if (is_array($get))
	{
		foreach ($get as $newGet)
		{
			$GLOBALS[ "$newGet" ] = $_GET[ "$newGet" ];
		}
	}
	else
		$GLOBALS[ "$get" ] = $_GET[ "$get" ];
}
function __FILE($file)
{
	if (is_array($file))
	{
		foreach ($file as $newFile)
		{
			$GLOBALS[ "$newFile" ] = $_FILES[ "$newFile" ];
		}
	}
	else
	{
		$GLOBALS[ "$file" ] = $_FILES[ "$file" ];
	}
}
function __COOKIE($cookie)
{
	if (is_array($cookie))
	{
		foreach ($cookie as $newCookie)
		{
			$GLOBALS[ "$newCookie" ] = $_COOKIE[ "$newCookie" ];
		}
	}
	else
	{
		$GLOBALS[ "$cookie" ] = $_COOKIE[ "$cookie" ];
	}
}

function __SESSION($session, $value = NULL)
{
	if (!isset($_SESSION))
	{
		session_start();
	}
	$GLOBALS[ "$session" ] = $_SESSION[ "$session" ] = $value;
	
}

function redir301($newurl)
{
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: " . $newurl);
}

$requestURI = explode('/', str_replace($baseUrl, "", $_SERVER[ 'REQUEST_URI' ]));
$scriptName = explode('/', str_replace($baseUrl, "", $_SERVER[ 'SCRIPT_NAME' ]));
if ($requestURI[ 0 ] != "")
{
	array_shift($requestURI);
}

define('RURI', 'return ' . var_export($requestURI, 1) . ';');
define('SNAME', 'return ' . var_export($scriptName, 1) . ';');
$requestURI = eval(RURI);
$scriptName = eval(SNAME);


function __removeSlash()
{
	$qpos = strrpos($_SERVER[ 'REQUEST_URI' ], '?');
	if (end(eval(RURI)) != "/" && ($qpos !== false && substr($_SERVER[ 'REQUEST_URI' ], $qpos - 1, 1) == '/'))
	{
		if (strstr($_SERVER[ 'REQUEST_URI' ], '?') === false)
		{
			if (substr($_SERVER[ 'REQUEST_URI' ], -1) == "/")
			{
				redir301(rtrim($_SERVER[ 'REQUEST_URI' ], "/"));
			}
		}
		else
		{
			if ($qpos !== false && substr($_SERVER[ 'REQUEST_URI' ], $qpos - 1, 1) == '/')
			{
				$url = str_replace("?", "/?", $_SERVER[ 'REQUEST_URI' ]);
				redir301($url);
			}
		}
	}
	elseif (end(eval(RURI)) != "/" && ($qpos === false && substr($_SERVER[ 'REQUEST_URI' ], $qpos - 1, 1) == '/'))
	{
		redir301(rtrim($_SERVER[ 'REQUEST_URI' ], "/"));
	}
}




function pagination($query, $links, $pag, $max, $url)
{
	if($query[ table ] && $query[ field ])
	
	{
		$query = DB__query::__SELECT($query[ table ], $query[ field ], $query[ clause ]);
		$total  = DB__query::$num_row;
		
		$paginas = ceil($total / $max);
		if ($paginas == '0')
		{
			$paginas = '1';
		}
	
		//QUANTIDADE DE LINKS NO PAGINATOR
		if ($pag == 1)
		{
			echo "<span class=\"thisD\">« Inicio</span>";
		}
		else
		{
			echo '<a href="' . $url . 'pag=1" class="pagina">« Inicio</a>';
		}
		if ($pag > 1)
		{
			$i = $pag;
			echo '<a href="' . $url . 'pag=' . --$i . '" class="pagina">«</a>';
		}
		else
		{
			echo "<span class=\"thisD\">«</span>";
		}
		
		if ($pag > $links + 1)
		{
			echo "<span class=\"more\">...</span>";
		}
		else
		{
			echo "&nbsp;&nbsp;&nbsp;";
		}
		
		for ($i = $pag - $links; $i <= $pag - 1; $i++)
		{
			if ($i <= 0)
			{
			}
			else
			{
				echo "<a href=\"" . $url . "pag=$i\" class=\"pagina\">$i</a>";
			}
		}
		echo "<span class=\"thisA\">$pag</span>";
		
		for ($i = $pag + 1; $i <= $pag + $links; $i++)
		{
			if ($i > $paginas)
			{
			}
			else
			{
				echo "<a href=\"" . $url . "pag=$i\" class=\"pagina\">$i</a>";
			}
		}
		
		if ($pag + $links + 1 <= $paginas)
		{
			echo "<span class=\"more\">...</span>";
		}
		else
		{
			echo "&nbsp;&nbsp;&nbsp;";
		}
		
		if ($pag < $paginas)
		{
			$i = $pag;
			echo '<a href="' . $url . 'pag=' . ++$i . '" class="pagina">»</a>';
		}
		else
		{
			echo "<span class=\"thisD\">»</span>";
		}
		if (($pag == $paginas) || ($paginas == '0'))
		{
			echo "<span class=\"thisD\">Final »</span>";
		}
		else
		{
			echo '<a href="' . $url . 'pag=' . $paginas . '" class="pagina">Final »</a>';
		}
		return array("CURRENT_PAGE" => $pag, "TOTAL_PAGES" => $paginas);
	}
}

function __addSlash()
{
	$qpos = strrpos($_SERVER[ 'REQUEST_URI' ], '?');
	if (end(eval(RURI)) != "" && ($qpos !== false && substr($_SERVER[ 'REQUEST_URI' ], $qpos - 1, 1) != '/'))
	{
		if (strstr($_SERVER[ 'REQUEST_URI' ], '?') === false)
		{
			if (substr($_SERVER[ 'REQUEST_URI' ], -1) != "/")
			{
				redir301($_SERVER[ 'REQUEST_URI' ] . "/");
			}
		}
		else
		{
			if ($qpos !== false && substr($_SERVER[ 'REQUEST_URI' ], $qpos - 1, 1) != '/')
			{
				$url = str_replace("?", "/?", $_SERVER[ 'REQUEST_URI' ]);
				redir301($url);
			}
		}
	}
	elseif (end(eval(RURI)) != "" && ($qpos === false && substr($_SERVER[ 'REQUEST_URI' ], $qpos - 1, 1) != '/'))
	{
		redir301($_SERVER[ 'REQUEST_URI' ] . "/");
	}
}

?>