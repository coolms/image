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

interface SizeInterface
{
    /**
     * @param number $width
     */
    public function setWidth($width);

    /**
     * @return number
     */
    public function getWidth();

    /**
     * @param number $height
     */
    public function setHeight($height);

    /**
     * @return number
     */
    public function getHeight();

    /**
     * @param number $side
     */
    public function setSide($side);

    /**
     * @return number
     */
    public function getSide();
}
