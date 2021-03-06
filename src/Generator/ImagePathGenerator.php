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

namespace Madcoders\SyliusTaxonGalleryPlugin\Generator;

use Madcoders\SyliusTaxonGalleryPlugin\Entity\TaxonGalleryItemImageInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

final class ImagePathGenerator implements ImagePathGeneratorInterface
{
    public function generate(TaxonGalleryItemImageInterface $item): string
    {
        /** @var UploadedFile $file */
        $file = $item->getImage();

        $hash = bin2hex(random_bytes(16));

        return $this->expandPath($hash . '.' . $file->guessExtension());
    }

    private function expandPath(string $path): string
    {
        return sprintf('%s/%s/%s', substr($path, 0, 2), substr($path, 2, 2), substr($path, 4));
    }
}
