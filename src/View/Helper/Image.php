<?php
/**
 * CoolMS2 Image Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/image for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsImage\View\Helper;

use Zend\View\Helper\AbstractHelper,
    CmsCommon\View\Helper\Img,
    CmsFile\View\Helper\BasePath,
    CmsImage\Mapping\ImageInterface;

/**
 * View Helper to render objects implementing ImageInterface
 *
 * @author Dmitry Popov <d.popov@altgraphic.com>
 */
class Image extends AbstractHelper
{
    /**
     * @var Img
     */
    protected $imgHelper;

    /**
     * @var string
     */
    protected $defaultImgHelper = 'img';

    /**
     * @var BasePath
     */
    protected $basePathHelper;

    /**
     * @var string
     */
    protected $defaultBasePathHelper = 'fileBasePath';

    /**
     * @param ImageInterface $image
     * @param array $attribs
     * @return self|string
     */
    public function __invoke(ImageInterface $image = null, array $attribs = [])
    {
        if (0 === func_num_args()) {
            return $this;
        }

        return $this->render($image, $attribs);
    }

    /**
     * @param ImageInterface $image
     * @param array $attribs
     * @return string
     */
    public function render(ImageInterface $image, array $attribs = [])
    {
        $requiredAttribs = [];
        if ($alt = $image->getAlt()) {
            $requiredAttribs['alt'] = $alt;
        }

        if ($width = $image->getWidth()) {
            $requiredAttribs['width'] = $width;
        }

        if ($height = $image->getHeight()) {
            $requiredAttribs['height'] = $height;
        }

        if (!array_key_exists('title', $attribs)) {
            $attribs['title'] = $image->getTitle();
        }

        if (!array_key_exists('id', $attribs)) {
            $attribs['id'] = 'cms-image-' . $image->getId();
        }

        $attribs = array_merge($image->getAttribs(), $requiredAttribs, $attribs);
        $attribs = array_merge_recursive($attribs, ['class' => 'cms-image']);

        $basePathHelper = $this->getBasePathHelper();
        $attribs['src'] = $basePathHelper($image);

        $imgHelper = $this->getImgHelper();

        return $imgHelper(null, $attribs);
    }

    /**
     * @return Img
     */
    protected function getImgHelper()
    {
        if (null === $this->imgHelper) {
            $renderer = $this->getView();
            if (method_exists($renderer, 'plugin')) {
                $this->imgHelper = $renderer->plugin($this->defaultImgHelper);
            }

            if (!$this->imgHelper instanceof Img) {
                $this->imgHelper = new Img();
                $this->imgHelper->setView($this->getView());
            }
        }

        return $this->imgHelper;
    }

    /**
     * @return BasePath
     */
    protected function getBasePathHelper()
    {
        if (null === $this->basePathHelper) {
            $renderer = $this->getView();
            if (method_exists($renderer, 'plugin')) {
                $this->basePathHelper = $renderer->plugin($this->defaultBasePathHelper);
            }

            if (!$this->basePathHelper instanceof BasePath) {
                $this->basePathHelper = new BasePath();
                $this->basePathHelper->setView($this->getView());
            }
        }

        return $this->basePathHelper;
    }
}
