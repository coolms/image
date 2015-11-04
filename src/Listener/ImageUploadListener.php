<?php
/**
 * CoolMS2 Image Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/image for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsImage\Listener;

use Zend\EventManager\Event,
    Zend\EventManager\AbstractListenerAggregate,
    Zend\EventManager\EventManagerInterface,
    Zend\Http\Request as HttpRequest,
    Zend\Mvc\MvcEvent,
    CmsImage\Mapping\ImageInterface;

/**
 * Image upload listener
 *
 * @author Dmitry Popov <d.popov@altgraphic.com>
 */
class ImageUploadListener extends AbstractListenerAggregate
{
    /**
     * {@inheritDoc}
     */
    public function attach(EventManagerInterface $events)
    {
        $this->listeners[] = $events->attach(MvcEvent::EVENT_DISPATCH, [$this, 'onDispatch'], 1000);
    }

    /**
     * Event callback to be triggered on dispatch
     *
     * @param MvcEvent $e
     * @return void
     */
    public function onDispatch(MvcEvent $e)
    {
        if (!$e->getRequest() instanceof HttpRequest) {
            return;
        }

        $sem = $e->getApplication()->getEventManager()->getSharedManager();
        $sem->attach('UploadableManager', 'createFile', [$this, 'onCreateFile']);
    }

    /**
     * @param Event $params
     */
    public function onCreateFile(Event $params)
    {
        $file = $params->getParam('file');
        if (!$file instanceof ImageInterface) {
            return;
        }

        $fileInfoArray = $params->getParam('fileInfoArray');
        list($width, $height) = getimagesize($fileInfoArray['tmp_name']);

        $file->setWidth($width)->setHeight($height);
    }
}
