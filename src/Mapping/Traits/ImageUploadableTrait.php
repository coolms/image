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

trait ImageUploadableTrait
{
    use ImageableTrait;

    /**
     * @var array
     *
     * @Form\Type("ImageUpload")
     * @Form\Required(true)
     * @Form\Attributes({"multiple":false})
     * @Form\Flags({"priority":0})
     */
    protected $upload;

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
