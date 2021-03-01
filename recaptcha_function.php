<?php 
	function is_not_Robot($tokk) {
		$url = "https://www.google.com/recaptcha/api/siteverify";
		$data = [
			'secret' => "6Le6wtgZAAAAAFtxhSDjYoSVVQHMNGTISoS5A7fb",
			'response' => $tokk,
			'remoteip' => $_SERVER['REMOTE_ADDR']
		];

		$options = array(
		    'http' => array(
		      'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
		      'method'  => 'POST',
		      'content' => http_build_query($data)
		    )
		  );

		$context  = stream_context_create($options);
  		$response = file_get_contents($url, false, $context);

		$res = json_decode($response, true);
		if($res['success'] == true && $res['score'] > 0.5 ) {
            return true;
			// Perform you logic here for ex:- save you data to database
  			// echo '<div class="alert alert-success">
			//   		<strong>Success!</strong> Your inquiry successfully submitted.
		 	// 	  </div>';
		} 
		else {
            return false;
			// echo '<div class="alert alert-warning">
			// 		  <strong>Error!</strong> You are not a human.
			// 	  </div>';
		}
	}
	
	function ForumCodeToHtml($txt)
{
    $code = array
    (
        // FONT

        "/\[font\s*=\s*&quot;(.+)&quot;\]/isU"                        => "<span style='font-family:$1;'>",
        "/\[font\s*=\s*\"(.+)\"\]/isU"                                => "<span style='font-family:$1;'>",
        "/\[font\s*=\s*'(.+)'\]/isU"                                  => "<span style='font-family:$1;'>",
        "/\[font\s*=\s*(.+)\]/isU"                                    => "<span style='font-family:$1;'>",

        // SIZE

        "/\[size\s*=\s*&quot;(\d+)&quot;\]/isU"                       => "<span style='font-size:$1px;'>",
        "/\[size\s*=\s*\"(\d+)\"\]/isU"                               => "<span style='font-size:$1px;'>",
        "/\[size\s*=\s*'(\d+)'\]/isU"                                 => "<span style='font-size:$1px;'>",
        "/\[size\s*=\s*(\d+)\]/isU"                                   => "<span style='font-size:$1px;'>",
        "/\[size_e\s*=\s*(\d+)\]/isU"                                 => "<span style='font-size:$1&#48;px;'>",

        // FOREGROUND COLOR

        "/\[(fg|color)\s*=\s*&quot;(.+)&quot;\]/isU"                  => "<span style='color:$2;'>",
        "/\[(fg|color)\s*=\s*\"(.+)\"\]/isU"                          => "<span style='color:$2;'>",
        "/\[(fg|color)\s*=\s*'(.+)'\]/isU"                            => "<span style='color:$2;'>",
        "/\[(fg|color)\s*=\s*(.+)\]/isU"                              => "<span style='color:$2;'>",

        // BACKGROUND COLOR

        "/\[bg\s*=\s*&quot;(.+)&quot;\]/isU"                          => "<span style='background-color:$1;'>",
        "/\[bg\s*=\s*\"(.+)\"\]/isU"                                  => "<span style='background-color:$1;'>",
        "/\[bg\s*=\s*'(.+)'\]/isU"                                    => "<span style='background-color:$1;'>",
        "/\[bg\s*=\s*(.+)\]/isU"                                      => "<span style='background-color:$1;'>",

        // BAD LINKS (djteddybear.com)

        "/\[(link|url)=http:\/\/djteddybear\.com(.+)\]/isU"             => "<span style='color:#f00;'><b>Admin note: removed link to www.djteddybear.com$2</b></span>",
        "/\[(link|url)=http:\/\/www\.djteddybear\.com(.+)\]/isU"        => "<span style='color:#f00;'><b>Admin note: removed link to www.djteddybear.com$2</b></span>",

        // LINKS

        "/([^=\]'\"])(ftp|http|https):\/\/([\-A-Za-z0-9\+&@#\/\%\?\=~_\(\)\|!:,\.;\[\]]+)(\s)/isU"  => "$1<a href='$2://$3' rel='nofollow' target='_blank'>$2://$3</a>$4",
        "/^(ftp|http|https):\/\/([\-A-Za-z0-9\+&@#\/\%\?\=~_\(\)\|!:,\.;\[\]]+)(\s)/isU"            => "<a href='$1://$2' rel='nofollow' target='_blank'>$1://$2</a>$3",
        "/([^=\]'\"])(ftp|http|https):\/\/([\-A-Za-z0-9\+&@#\/\%\?\=~_\(\)\|!:,\.;\[\]]+)$/isU"     => "$1<a href='$2://$3' rel='nofollow' target='_blank'>$2://$3</a>",
        "/^(ftp|http|https):\/\/([\-A-Za-z0-9\+&@#\/\%\?\=~_\(\)\|!:,\.;\[\]]+)$/isU"               => "<a href='$1://$2' rel='nofollow' target='_blank'>$1://$2</a>",

        "/\[(link|url)=&quot;(.+)&quot;\]/isU"                  => "<a href='$2' rel='nofollow' target='_blank'>",
        "/\[(link|url)=\"(.+)\"\]/isU"                          => "<a href='$2' rel='nofollow' target='_blank'>",
        "/\[(link|url)='(.+)'\]/isU"                            => "<a href='$2' rel='nofollow' target='_blank'>",
        "/\[(link|url)=(.+)\]/isU"                              => "<a href='$2' rel='nofollow' target='_blank'>",
        "/\[(link|url)\](.+)\[\/(link|url)\]/isU"                     => "<a href='$2' rel='nofollow' target='_blank'>$2</a>",

        // BAD IMAGES (djteddybear.com)

        "/\[(img|image)=http:\/\/djteddybear\.com(.+)\]/isU"       => "<span style='color:#f00;'><b>Admin note: removed image www.djteddybear.com$2</b></span>",
        "/\[(img|image)=http:\/\/www\.djteddybear\.com(.+)\]/isU"   => "<span style='color:#f00;'><b>Admin note: removed image www.djteddybear.com$2</b></span>",

        // IMAGES

        "/\[(img|image)=&quot;(.+)&quot;\]/isU"                 => "<img class='fit' src='$2' />",
        "/\[(img|image)=\"(.+)\"\]/isU"                         => "<img class='fit' src='$2' />",
        "/\[(img|image)='(.+)'\]/isU"                           => "<img class='fit' src='$2' />",
        "/\[(img|image)=(.+)\]/isU"                             => "<img class='fit' src='$2' />",

        // FONT STYLES

        "/\[(b|i|s|u)\]/isU"                                    => "<span class='$1'>",

        // TEXT ALIGNMENT

        "/\[(l|c|r|j)\]/isU"                                    => "<div class='$1'>",

        // TEXT POSITION

        "/\[sup\]/isU"                                          => "<sup>",
        "/\[sub\]/isU"                                          => "<sub>",

        // TABLES

        "/\[(tbl|table)\]/isU"                                  => "<table class='userdata'>",
        "/\[(tr|row)\]/isU"                                     => "<tr>",
        "/\[(col|hdr|th)\]/isU"                                 => "<th>",
        "/\[(col|hdr|th)\.(\d+)\]/isU"                          => "<th colspan='$2'>",
        "/\[(col|hdr|th)\.(l|c|r|j)\]/isU"                      => "<th class='$2'>",
        "/\[(col|hdr|th)\.(\d+)\.(l|c|r|j)\]/isU"               => "<th class='$3' colspan='$2'>",
        "/\[(col|hdr|th)\.(l|c|r|j)\.(\d+)\]/isU"               => "<th class='$2' colspan='$3'>",
        "/\[(td|dat|data)\]/isU"                                => "<td>",
        "/\[(td|dat|data)\.(\d+)\]/isU"                         => "<td colspan='$2'>",
        "/\[(td|dat|data)\.(l|c|r|j)\]/isU"                     => "<td class='$2'>",
        "/\[(td|dat|data)\.(\d+)\.(l|c|r|j)\]/isU"              => "<td class='$3' colspan='$2'>",
        "/\[(td|dat|data)\.(l|c|r|j)\.(\d+)\]/isU"              => "<td class='$2' colspan='$3'>",

        // LISTS

        "/\[(ol|nlist)\]/isU"                                   => "<ol>",
        "/\[(ul|blist)\]/isU"                                   => "<ul>",
        "/\[(li|item)\]/isU"                                    => "<li>",

        // QUOTES

        "/\[q(uote)?\s*=\s*&quot;(.+)&quot;\](.+)\[\/q(uote)?\]/isU"  => "<blockquote><div class='q'>Quote: <b>$2</b></div><p class='q2'>",
        "/\[q(uote)?\s*=\s*\"(.+)\"\](.+)\[\/q(uote)?\]/isU"          => "<blockquote><div class='q'>Quote: <b>$2</b></div><p class='q2'>",
        "/\[q(uote)?\s*=\s*'(.+)'\](.+)\[\/q(uote)?\]/isU"            => "<blockquote><div class='q'>Quote: <b>$2</b></div><p class='q2'>",
        "/\[q(uote)?\s*=\s*(.+)\]/isU"                                => "<blockquote><div class='q'>Quote: <b>$2</b></div><p class='q2'>",
        "/\[q(uote)?\]/isU"                                         => "<blockquote><div class='q'>Quote:</div><p class='q2'>",

        // CODE

        "/\[code\]/isU"                                             => "<div class='code'><div><pre>",

        // SPOILER

        "/\[spoiler\](.+)\[\/spoiler\]/isU"                         => "<div><button onclick='var btn = this; var div = btn.parentNode.childNodes[1]; if (btn.innerHTML == \"Show Spoiler\") { div.style.display=\"block\"; btn.innerHTML = \"Hide Spoiler\"; } else { div.style.display=\"none\"; btn.innerHTML = \"Show Spoiler\"; }' style='padding:2px 4px;'>Show Spoiler</button><div class='spoiler'>$1</div></div>",
        "/\[spoiler=([^\]]+)\](.+)\[\/spoiler\]/isU"                => "<div><button onclick='var btn = this; var div = btn.parentNode.childNodes[1]; if (div.style.display != \"block\") { div.style.display=\"block\"; } else { div.style.display=\"none\"; }' style='padding:2px 4px;'>$1</button><div class='spoiler'>$2</div></div>",

        // YOUTUBE

        "/\[youtube\s*=\s*&quot;(.+)&quot;\]/isU"                     => "<object width='480' height='385'><param name='movie' value='https://www.youtube.com/v/$1&hl=en_US&fs=1&'></param><param name='allowFullScreen' value='true'></param><param name='allowscriptaccess' value='always'></param><embed src='https://www.youtube.com/v/$1&hl=en_US&fs=1&' type='application/x-shockwave-flash' allowscriptaccess='always' allowfullscreen='true' width='480' height='385'></embed></object>",
        "/\[youtube\s*=\s*\"(.+)\"\]/isU"                             => "<object width='480' height='385'><param name='movie' value='https://www.youtube.com/v/$1&hl=en_US&fs=1&'></param><param name='allowFullScreen' value='true'></param><param name='allowscriptaccess' value='always'></param><embed src='https://www.youtube.com/v/$1&hl=en_US&fs=1&' type='application/x-shockwave-flash' allowscriptaccess='always' allowfullscreen='true' width='480' height='385'></embed></object>",
        "/\[youtube\s*=\s*'(.+)'\]/isU"                               => "<object width='480' height='385'><param name='movie' value='https://www.youtube.com/v/$1&hl=en_US&fs=1&'></param><param name='allowFullScreen' value='true'></param><param name='allowscriptaccess' value='always'></param><embed src='https://www.youtube.com/v/$1&hl=en_US&fs=1&' type='application/x-shockwave-flash' allowscriptaccess='always' allowfullscreen='true' width='480' height='385'></embed></object>",
        "/\[youtube\s*=\s*(.+)\]/isU"                                 => "<object width='480' height='385'><param name='movie' value='https://www.youtube.com/v/$1&hl=en_US&fs=1&'></param><param name='allowFullScreen' value='true'></param><param name='allowscriptaccess' value='always'></param><embed src='https://www.youtube.com/v/$1&hl=en_US&fs=1&' type='application/x-shockwave-flash' allowscriptaccess='always' allowfullscreen='true' width='480' height='385'></embed></object>",

        // CLOSING TAGS

        "/\[\/(font|size|color|fg|bg|b|i|s|u)\]/isU"            => "</span>",
        "/\[\/(l|c|r|j)\]/isU"                                  => "</div>",
        "/\[\/(link|url)\]/isU"                                 => "</a>",
        "/\[\/sup\]/isU"                                        => "</sup>",
        "/\[\/sub\]/isU"                                        => "</sub>",
        "/\[\/(tbl|table)\]/isU"                                => "</table>",
        "/\[\/(tr|row)\]/isU"                                   => "</tr>",
        "/\[\/(th|col)\]/isU"                                   => "</th>",
        "/\[\/(td|data?)\]/isU"                                 => "</td>",
        "/\[\/(ol|nlist)\]/isU"                                 => "</ol>",
        "/\[\/(ul|blist)\]/isU"                                 => "</ul>",
        "/\[\/(li|item)\]/isU"                                  => "</li>",
        "/\[\/q(uote)?\]/isU"                                   => "</p></blockquote>",
        "/\[\/code\]/isU"                                       => "</pre></div></div>",

        // ESCAPED BRACKETS

        "/\[\[\]/isU"                                           => "[",
        "/\[\]\]/isU"                                           => "]",

        // LINE BREAKS

        "/(\[hr\])/isU"                                         => "<hr />",
        "/(\r\n|\n|\r)/isU"                                     => "<br />",

        // REMOVE EXCESSIVE LINE BREAKS

        "/<table>([\n\r\s\t]*)<br \/>/isU"                      => "<table>\n",
        "/<br \/>([\n\r\s\t]*)<tr>/isU"                         => "<tr>\n",
        "/<tr>([\n\r\s\t]*)<br \/>/isU"                         => "<tr>\n",
        "/<\/td>([\n\r\s\t]*)<br \/>/isU"                       => "</td>\n",
        "/<\/th>([\n\r\s\t]*)<br \/>/isU"                       => "</th>\n",
        "/<\/tr>([\n\r\s\t]*)<br \/>/isU"                       => "</tr>\n",
        "/<br \/>([\n\r\s\t]*)<\/table>/isU"                    => "</table>\n\n",
        "/<ol>([\n\r\s\t]*)<br \/>/isU"                         => "<ol>\n",
        "/<ul>([\n\r\s\t]*)<br \/>/isU"                         => "<ul>\n",
        "/<br \/>([\n\r\s\t]*)<li>/isU"                         => "<li>\n",
        "/<\/li>([\n\r\s\t]*)<br \/>/isU"                       => "</li>\n",
        "/<br \/>([\n\r\s\t]*)<\/ol>/isU"                       => "</ol>\n\n",
        "/<br \/>([\n\r\s\t]*)<\/ul>/isU"                       => "</ul>\n\n"
        );

return preg_replace(array_keys($code), array_values($code), $txt);
}

?>