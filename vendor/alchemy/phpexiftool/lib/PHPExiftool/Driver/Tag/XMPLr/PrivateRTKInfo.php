<?php

/*
 * This file is part of the PHPExifTool package.
 *
 * (c) Alchemy <support@alchemy.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PHPExiftool\Driver\Tag\XMPLr;

use JMS\Serializer\Annotation\ExclusionPolicy;
use PHPExiftool\Driver\AbstractTag;

/**
 * @ExclusionPolicy("all")
 */
class PrivateRTKInfo extends AbstractTag
{

    protected $Id = 'privateRTKInfo';

    protected $Name = 'PrivateRTKInfo';

    protected $FullName = 'XMP::Lightroom';

    protected $GroupName = 'XMP-lr';

    protected $g0 = 'XMP';

    protected $g1 = 'XMP-lr';

    protected $g2 = 'Image';

    protected $Type = 'string';

    protected $Writable = true;

    protected $Description = 'Private RTK Info';

}