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
    CmsImage\Mapping\ImageInterface;

trait ImageManagerTrait
{
    /**
     * @var ImageInterface[]
     *
     * @Form\ComposedObject({
     *      "target_object":"CmsImage\Mapping\ImageInterface",
     *      "is_collection":true,
     *      "options":{
     *          "allow_add":false,
     *          "allow_remove":true,
     *          "count":0,
     *          "label":"Images",
     *          "name":"images",
     *          "partial":"cms-image/image/fieldset",
     *          "should_create_template":true,
     *          "text_domain":"CmsImage",
     *      }})
     * @Form\Flags({"priority":0})
     */
    protected $images = [];

    /**
     * @var array
     *
     * @Form\Type("ImageUpload")
     * @Form\Options({"target":"images"})
     * @Form\Flags({"priority":0})
     */
    protected $upload;

    /**
     * __construct
     *
     * Initializes images
     */
    public function __construct()
    {
        
    }

    /**
     * @param ImageInterface[] $images
     * @return self
     */
    public function setImages($images)
    {
        $this->clearImages();
        $this->addImages($images);

        return $this;
    }

    /**
     * @param ImageInterface[] $images
     * @return self
     */
    public function addImages($images)
    {
        foreach ($images as $image) {
            $this->addImage($image);
        }

        return $this;
    }

    /**
     * @param ImageInterface $image
     * @return self
     */
    public function addImage(ImageInterface $image)
    {
        $this->images[] = $image;
        return $this;
    }

    /**
     * @param ImageInterface[] $images
     * @return self
     */
    public function removeImages($images)
    {
        foreach ($images as $image) {
            $this->removeImage($image);
        }

        return $this;
    }

    /**
     * @param ImageInterface $image
     * @return self
     */
    public function removeImage(ImageInterface $image)
    {
        foreach ($this->images as $key => $entity) {
            if ($entity === $image) {
                unset($this->images[$key]);
                break;
            }
        }

        return $this;
    }

    /**
     * @param ImageInterface $image
     * @return bool
     */
    public function hasImage(ImageInterface $image)
    {
        foreach ($this->images as $key => $entity) {
            if ($entity === $image) {
                return true;
            }
        }

        return false;
    }

    /**
     * Removes all images
     *
     * @return self
     */
    public function clearImages()
    {
        $this->removeImages($this->images);
        return $this;
    }

    /**
     * @return ImageInterface[]
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param array $fileInfo
     * @return self
     */
    public function setUpload(array $fileInfo)
    {
        $this->upload = $fileInfo;
        return $this;
    }

    /**
     * @return array
     */
    public function getUpload()
    {
        return $this->upload;
    }
}
