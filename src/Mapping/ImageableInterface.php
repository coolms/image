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

use CmsImage\Mapping\ImageInterface;

interface ImageableInterface
{
    /**
     * @param ImageInterface $image
     * @return self
     */
    public function setImage(ImageInterface $image);

    /**
     * @return ImageInterface
     */
    public function getImage();
}
