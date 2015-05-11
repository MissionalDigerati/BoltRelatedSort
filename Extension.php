<?php
// Related Sort Extension for Bolt

namespace Bolt\Extension\MDBoltExtension\RelatedSort;

/**
 * Related Sort is an Extension for the Bolt CMS (@link http://bolt.cm)
 *
 * @package default
 * @author Johnathan Pulos
 **/
class Extension extends \Bolt\BaseExtension
{
    /**
     * Get the name of the extension/
     *
     * @return string
     * @author Johnathan Pulos
     **/
    public function getName()
    {
        return "Related Sort";
    }

    /**
     * initialize the extension
     *
     * @return void
     * @author Johnathan Pulos
     **/
    public function initialize()
    {
        $this->addTwigFunction('related_sort', 'twigRelatedSort');
    }

    /**
     * Takes Bolt's related array ($related) and sorts it using the value of the array key ($sortKey)
     *
     * @param array $related Bolt's related() results
     * @param string $sortKey the key to sort by
     * @param string $order which order to sort (asc, desc) default: asc
     * @return array the sorted objects
     * @access public
     * @author Johnathan Pulos
     **/
    public function twigRelatedSort($related, $sortKey, $order = 'asc')
    {
        $order = strtolower($order);
        uasort(
            $related,
            function($a, $b) use ($sortKey, $order)
            {
                $compare = strnatcmp($a[$sortKey], $b[$sortKey]);
                if ($order == 'desc') {
                    return - $compare;
                } else {
                    return $compare;
                }
            }
        );
        return $related;
    }

}
