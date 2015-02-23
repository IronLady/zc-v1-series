<?php
/**
 * Breadcrumb Class
 *
 * @package   classes
 * @copyright Copyright 2003-2014 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license   http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 */

if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}

/**
 * Generates breadcrumb links
 *
 * @package classes
 */
class Breadcrumb
{
    /**
     * @var string
     */
    const DEFAULT_SEPARATOR = '&nbsp;&nbsp;';

    /**
     * @var array title: string => link: string
     */
    private $links = array();

    /**
     * @param array $links title: string => link: string
     */
    public function __construct(array $links = array())
    {
        foreach ($links as $title => $link) {
            $this->add($title, $link);
        }
    }

    /**
     * Add a breadcrumb link
     *
     * @param  string $title the link title
     * @param  string $link  the link href
     * @throws InvalidArgumentException when either title or link are empty
     */
    public function add($title, $link = '#')
    {
        if (empty($title) || empty($link)) {
            throw new InvalidArgumentException("Both title and link must not be empty.");
        }
        $this->links[(string) $title] = (string) $link;
    }

    /**
     * Generate an html breadcrumb string
     *
     * @param  string $separator the string that separates each crumb
     * @return string
     */
    public function trail($separator = self::DEFAULT_SEPARATOR)
    {
        $trail     = '<nav class="breadcrumb">';
        $titles    = array_keys($this->links);
        $lastTitle = end($titles);

        foreach ($this->links as $title => $link) {
            $trail .= '<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb" class="crumb">';
            $href   = $this->buildHref($title, $link);
            $label  = '<span itemprop="title" class="title">' . $title . '</span>';

            $trail .= ($title == $lastTitle)
                ? '<link itemprop="url" href="' . $href . '" class="link" />' . $label
                : '<a itemprop="url" href="' . $href . '" class="link">' . $label . '</a>';

<<<<<<< HEAD
    for ($i=0, $n=sizeof($this->_trail); $i<$n; $i++) {
//    echo 'breadcrumb ' . $i . ' of ' . $n . ': ' . $this->_trail[$i]['title'] . '<br />';
      $skip_link = false;
      if ($i==($n-1) && DISABLE_BREADCRUMB_LINKS_ON_LAST_ITEM =='true') {
        $skip_link = true;
      }
      if (isset($this->_trail[$i]['link']) && zen_not_null($this->_trail[$i]['link']) && !$skip_link ) {
        // this line simply sets the "Home" link to be the domain/url, not main_page=index?blahblah:
        if ($this->_trail[$i]['title'] == HEADER_TITLE_CATALOG) {
          $trail_string .= '  <a href="' . ($request_type != 'SSL' ? HTTP_SERVER . DIR_WS_CATALOG : HTTPS_SERVER . DIR_WS_HTTPS_CATALOG) . '">' . $this->_trail[$i]['title'] . '</a>';
        } else {
          $trail_string .= '  <span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a itemprop="url" href="' . $this->_trail[$i]['link'] . '">' . '<span itemprop="title">' . $this->_trail[$i]['title'] . '</span>' . '</a></span>';
        }
      } else {
        if ($i==($n-1)) $trail_string .= '  <span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><link itemprop="url" href="' . $this->_trail[$i]['link'] . '" />' . $this->_trail[$i]['title'] . '</span>';
      }
=======
            $trail .= '</span>' . $separator;
        }
>>>>>>> upstream/v160

        return rtrim($trail, $separator) . "</nav>\n";
    }

    /**
     * @return array title: string => link: string
     */
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * @deprecated
     * @return string
     */
    public function last()
    {
        trigger_error(__METHOD__ . ' is deprecated', E_USER_DEPRECATED);
        $titles = array_keys($this->links);
        return end($titles);
    }

<<<<<<< HEAD
  function last() {
    $trail_size = sizeof($this->_trail);
    return $this->_trail[$trail_size-1]['title'];
  }
}
=======
    /**
     * @return string
     */
    public function __toString()
    {
        return $this->trail();
    }

    /**
     * If the crumb title matches the catalog header title, use the appropriate site url
     *
     * @param  string $title the crumb title
     * @param  string $link  the default href
     * @return string
     */
    private function buildHref($title, $link)
    {
        global $request_type;
        if ($title == HEADER_TITLE_CATALOG) {
            return ($request_type == 'SSL') ? HTTPS_SERVER . DIR_WS_HTTPS_CATALOG : HTTP_SERVER . DIR_WS_CATALOG;
        }
        return $link;
    }
}
>>>>>>> upstream/v160
