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

namespace Madcoders\SyliusTaxonGalleryPlugin\Uploader;

use Madcoders\SyliusTaxonGalleryPlugin\Entity\TaxonGalleryItemImageInterface;

interface ImageUploaderInterface
{
    public function upload(TaxonGalleryItemImageInterface $item): void;

    public function remove(string $path): bool;
}
