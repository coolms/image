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

use CmsFile\Mapping\UploadableInterface;

interface ImageManagerInterface extends UploadableInterface
{
    /**
     * @param ImageInterface[] $images
     * @return self
     */
    public function setImages($images);

    /**
     * @param ImageInterface[] $images
     * @return self
     */
    public function addImages($images);

    /**
     * @param ImageInterface $image
     * @return self
     */
    public function addImage(ImageInterface $image);

    /**
     * @param ImageInterface[] $images
     * @return self
     */
    public function removeImages($images);

    /**
     * @param ImageInterface $image
     * @return self
     */
    public function removeImage(ImageInterface $image);

    /**
     * @param ImageInterface $image
     * @return bool
     */
    public function hasImage(ImageInterface $image);

    /**
     * Removes all images
     *
     * @return self
     */
    public function clearImages();

    /**
     * @return Collection
     */
    public function getImages();
}
