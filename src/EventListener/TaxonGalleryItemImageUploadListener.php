<?php

/*
 * This file is part of package:
 * Sylius Taxon Gallery Plugin
 *
 * @copyright MADCODERS Team (www.madcoders.co)
 * @licence For the full copyright and license information, please view the LICENSE
 *
 * Architects of this package:
 * @author Leonid Moshko <l.moshko@madcoders.pl>
 * @author Piotr Lewandowski <p.lewandowski@madcoders.pl>
 */

declare(strict_types=1);

namespace Madcoders\SyliusTaxonGalleryPlugin\EventListener;

use Madcoders\SyliusTaxonGalleryPlugin\Entity\TaxonGalleryItemImageInterface;
use Madcoders\SyliusTaxonGalleryPlugin\Uploader\ImageUploaderInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

class TaxonGalleryItemImageUploadListener
{
    /** @var ImageUploaderInterface */
    private $uploader;

    public function __construct(ImageUploaderInterface $uploader)
    {
        $this->uploader = $uploader;
    }

    public function uploadImage(GenericEvent $event): void
    {
        $subject = $event->getSubject();

        if ($subject instanceof TaxonGalleryItemImageInterface) {
            if (null !== $subject->getImage()) {
                $this->uploader->upload($subject);
            }
        }
    }
}
