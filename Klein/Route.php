<?php
/**
 * Klein (klein.php) - A lightning fast router for PHP
 *
 * @author      Chris O'Hara <cohara87@gmail.com>
 * @author      Trevor Suarez (Rican7) (contributor and v2 refactorer)
 * @copyright   (c) Chris O'Hara
 * @link        https://github.com/chriso/klein.php
 * @license     MIT
 */

namespace Klein;

/**
 * Route
 *
 * Class to represent a route definition
 *
 * @package     Klein
 */
class Route
{

    /**
     * Properties
     */

    /**
     * The callback method to execute when the route is matched
     *
     * Any valid "callable" type is allowed
     *
     * @link http://php.net/manual/en/language.types.callable.php
     * @var callable
     * @access protected
     */
    protected $callback;

    /**
     * The URL path to match
     *
     * Allows for regular expression matching and/or basic string matching
     *
     * Examples:
     * - '/posts'
     * - '/posts/[:post_slug]'
     * - '/posts/[i:id]'
     *
     * @var string
     * @access protected
     */
    protected $path;

    /**
     * The HTTP method to match
     *
     * May either be represented as a string or an array containing multiple methods to match
     *
     * Examples:
     * - 'POST'
     * - array('GET', 'POST')
     *
     * @var string|array
     * @access protected
     */
    protected $method;

    /**
     * Whether or not to count this route as a match when counting total matches
     *
     * @var boolean
     * @access protected
     */
    protected $count_match;


    /**
     * Methods
     */

    /**
     * Constructor
     *
     * @param callable $callback
     * @param string $path
     * @param string|array $method
     * @param boolean $count_match
     * @access public
     */
    public function __construct($callback, $path = '*', $method = null, $count_match = true)
    {
        // Initialize some properties (use our setters so we can validate param types)
        $this->setCallback($callback);
        $this->setPath($path);
        $this->setMethod($method);
        $this->setCountMatch($count_match);
    }

    /**
     * Get the callback
     *
     * @access public
     * @return callable
     */
    public function getCallback()
    {
        return $this->callback;
    }
    
    /**
     * Set the callback
     *
     * @param callable $callback
     * @access public
     * @return Route
     */
    public function setCallback($callback)
    {
        $this->callback = $callback;

        return $this;
    }

    /**
     * Get the path
     *
     * @access public
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }
    
    /**
     * Set the path
     *
     * @param string $path
     * @access public
     * @return Route
     */
    public function setPath($path)
    {
        $this->path = (string) $path;

        return $this;
    }

    /**
     * Get the method
     *
     * @access public
     * @return string|array
     */
    public function getMethod()
    {
        return $this->method;
    }
    
    /**
     * Set the method
     *
     * @param string|array $method
     * @access public
     * @return Route
     */
    public function setMethod($method)
    {
        $this->method = $method;

        return $this;
    }

    /**
     * Get the count_match
     *
     * @access public
     * @return boolean
     */
    public function getCountMatch()
    {
        return $this->count_match;
    }
    
    /**
     * Set the count_match
     *
     * @param boolean $count_match
     * @access public
     * @return Route
     */
    public function setCountMatch($count_match)
    {
        $this->count_match = (boolean) $count_match;

        return $this;
    }


    /**
     * Magic "__invoke" method
     *
     * Allows the ability to arbitrarily call this instance like a function
     *
     * @param mixed $args Generic arguments, magically accepted
     * @access public
     * @return mixed
     */
    public function __invoke($args = null)
    {
        $args = func_get_args();

        return call_user_func_array(
            $this->callback,
            $args
        );
    }
}
