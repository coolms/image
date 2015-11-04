<?php
/**
 * CoolMS2 Image Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/image for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsImage\Mapping;

use CmsFile\Mapping\FileInterface;

interface ImageInterface extends FileInterface
{
    /**
     * @param array $attribs
     * @return self
     */
    public function setAttribs(array $attribs);
    
    /**
     * @return array
     */
    public function getAttribs();

    /**
     * @return string
     */
    public function getSrc();

    /**
     * @param string $alt
     * @return self
     */
    public function setAlt($alt);

    /**
     * @return string
     */
    public function getAlt();

    /**
     * @param number $width
     * @return self
     */
    public function setWidth($width);

    /**
     * @return number
     */
    public function getWidth();

    /**
     * @param number $height
     * @return self
     */
    public function setHeight($height);

    /**
     * @return number
     */
    public function getHeight();
}
