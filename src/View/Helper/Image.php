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

use InvalidArgumentException,
    Zend\View\Helper\AbstractHtmlElement,
    CmsCommon\Persistence\MapperInterface,
    CmsCommon\Persistence\MapperProviderTrait,
    CmsCommon\View\Helper\Img,
    CmsFile\View\Helper\BasePath,
    CmsImage\Mapping\ImageInterface;
use CmsCommon\View\Helper\HtmlContainer;

/**
 * View Helper to render objects implementing ImageInterface
 *
 * @author Dmitry Popov <d.popov@altgraphic.com>
 */
class Image extends HtmlContainer
{
    use MapperProviderTrait;

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
     * __construct
     *
     * @param MapperInterface $mapper
     */
    public function __construct(MapperInterface $mapper)
    {
        $this->setMapper($mapper);
    }

    /**
     * @param mixed $imageOrId
     * @param array $attribs
     * @return self|string
     */
    public function __invoke($imageOrId = null, array $attribs = [])
    {
        if (0 === func_num_args()) {
            return $this;
        }

        return $this->render($imageOrId, $attribs);
    }

    /**
     * @param mixed $imageOrId
     * @param array $attribs
     * @throws InvalidArgumentException
     * @return string
     */
    public function render($imageOrId, array $attribs = [])
    {
        if (is_scalar($imageOrId)) {
            $imageOrId = $this->getMapper()->find($imageOrId);
        }

        if (!$imageOrId instanceof ImageInterface) {
            throw new InvalidArgumentException(
                'Argument #1 is expected to be a valid id or an instance of %s; %s given',
                ImageInterface::class,
                is_object($imageOrId) ? get_class($imageOrId) : gettype($imageOrId)
            );
        }

        $requiredAttribs = [];
        if ($alt = $imageOrId->getAlt()) {
            $requiredAttribs['alt'] = $alt;
        }

        if ($width = $imageOrId->getWidth()) {
            $requiredAttribs['width'] = $width;
        }

        if ($height = $imageOrId->getHeight()) {
            $requiredAttribs['height'] = $height;
        }

        if (!array_key_exists('title', $attribs)) {
            $attribs['title'] = $imageOrId->getTitle();
        }

        if (!array_key_exists('id', $attribs)) {
            $attribs['id'] = 'cms-image-' . $imageOrId->getId();
        }

        $attribs = array_merge($imageOrId->getAttribs(), $requiredAttribs, $attribs);
        $attribs = array_merge_recursive($attribs, ['class' => 'cms-image']);

        $basePathHelper = $this->getBasePathHelper();
        $attribs['src'] = $basePathHelper($imageOrId);

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
