<?php 
/**
 * CoolMS2 Image Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/image for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsImage\Options;

use CmsFile\Options\ModuleOptions as FileModuleOptions;

class ModuleOptions extends FileModuleOptions implements ModuleOptionsInterface
{
    /**
     * @var string
     */
    protected $uploadFileLabel = 'Upload image';

    /**
     * @var array
     */
    protected $uploadFileMimeTypes = [
        'image/gif',
        'image/jpg',
        'image/jpeg',
        'image/png',
    ];

    /**
     * @var string
     */
    protected $defaultUploadPath = '/images';

    /**
     * @var string
     */
    protected $className = 'CmsImageORM\Entity\Image';

    /**
     * @var string
     */
    protected $publicStorePath = 'public/images';
}
