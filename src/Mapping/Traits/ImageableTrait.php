<?php
/**
 * CoolMS2 Image Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/image for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsImage\Mapping\Traits;

use CmsImage\Mapping\ImageInterface;

trait ImageableTrait
{
    /**
     * @var ImageInterface
     *
     * @Form\ComposedObject({
     *      "target_object":"CmsImage\Mapping\ImageInterface",
     *      "is_collection":false,
     *      "options":{
     *          "label":"Image",
     *          "name":"image",
     *          "text_domain":"CmsImage",
     *          "source":"upload",
     *      }})
     * @Form\Flags({"priority":0})
     */
    protected $image;

    /**
     * @param ImageInterface $image
     * @return self
     */
    public function setImage(ImageInterface $image)
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @return ImageInterface
     */
    public function getImage()
    {
        return $this->image;
    }
}
