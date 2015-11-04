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

use Zend\Form\Annotation as Form,
    CmsImage\Mapping\ImageManagerInterface;

trait ImageManageableTrait
{
    /**
     * @var ImageManagerInterface
     *
     * @Form\ComposedObject({
     *      "target_object":"CmsImage\Mapping\ImageManagerInterface",
     *      "is_collection":false,
     *      "options":{
     *          "label":"Image Manager",
     *          "name":"imageManager",
     *          "text_domain":"CmsImage"}})
     * @Form\Flags({"priority":0})
     */
    protected $imageManager;

    /**
     * @param ImageManagerInterface $manager
     * @return self
     */
    public function setImageManager(ImageManagerInterface $manager)
    {
        $this->imageManager = $manager;
        return $this;
    }

    /**
     * @return ImageManagerInterface
     */
    public function getImageManager()
    {
        return $this->imageManager;
    }
}
