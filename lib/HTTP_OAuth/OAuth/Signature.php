<?php
/**
 * HTTP_OAuth
 *
 * Implementation of the OAuth specification
 *
 * PHP version 5.2.0+
 *
 * LICENSE: This source file is subject to the New BSD license that is
 * available through the world-wide-web at the following URI:
 * http://www.opensource.org/licenses/bsd-license.php. If you did not receive
 * a copy of the New BSD License and are unable to obtain it through the web,
 * please send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category  HTTP
 * @package   HTTP_OAuth
 * @author    Jeff Hodsdon <jeffhodsdon@gmail.com>
 * @copyright 2009 Jeff Hodsdon <jeffhodsdon@gmail.com>
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @link      http://pear.php.net/package/HTTP_OAuth
 * @link      http://github.com/jeffhodsdon/HTTP_OAuth
 */

require_once 'lib/HTTP_OAuth/OAuth.php';

/**
 * HTTP_OAuth_Signature
 *
 * Base util class for signatures, e.g. factory.
 *
 * @category  HTTP
 * @package   HTTP_OAuth
 * @author    Jeff Hodsdon <jeffhodsdon@gmail.com>
 * @copyright 2009 Jeff Hodsdon <jeffhodsdon@gmail.com>
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @link      http://pear.php.net/package/HTTP_OAuth
 * @link      http://github.com/jeffhodsdon/HTTP_OAuth
 */
abstract class HTTP_OAuth_Signature
{

    /**
     * Factory
     *
     * @param string $method Signature method
     *
     * @return HTTP_OAuth_Signature_Common Signature instance
     */
    static public function factory($method)
    {
        $method = str_replace('-', '_', $method);
        $class  = 'lib_HTTP_OAuth_OAuth_Signature_' . $method;
        $file   = str_replace('_', '/', $class) . '.php';
				$file = str_replace('HTTP/OAuth', 'HTTP_OAuth', $file);

        include_once $file;

        if (class_exists($class) === false) {
            throw new InvalidArgumentException('No such signature class');
        }

        $instance = new $class;
        if (!$instance instanceof HTTP_OAuth_Signature_Common) {
            throw new InvalidArgumentException(
                'Signature class does not extend HTTP_OAuth_Signature_Common'
            );
        }

        return $instance;
    }
}

?>
