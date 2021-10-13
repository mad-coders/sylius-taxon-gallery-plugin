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

use Gaufrette\Filesystem;
use Madcoders\SyliusTaxonGalleryPlugin\Entity\TaxonGalleryItemImageInterface;
use Madcoders\SyliusTaxonGalleryPlugin\Generator\ImagePathGenerator;
use Madcoders\SyliusTaxonGalleryPlugin\Generator\ImagePathGeneratorInterface;
use Symfony\Component\HttpFoundation\File\File;
use Webmozart\Assert\Assert;

class ImageUploader implements ImageUploaderInterface
{
    private Filesystem $filesystem;
    private ImagePathGeneratorInterface $imagePathGenerator;

    public function __construct(
        Filesystem $filesystem,
        ?imagePathGenerator $imagePathGenerator = null
    )
    {
        $this->filesystem = $filesystem;

        if ($imagePathGenerator === null) {
            @trigger_error(sprintf(
                'Not passing an $imagePathGenerator to %s constructor is deprecated since Sylius 1.6 and will be not possible in Sylius 2.0.', self::class
            ), \E_USER_DEPRECATED);
        }

        $this->imagePathGenerator = $imagePathGenerator ?? new ImagePathGenerator();
    }

    public function upload(TaxonGalleryItemImageInterface $item): void
    {
        if (!$item->hasImage()) {
            return;
        }

        $file = $item->getImage();

        /** @var File $file */
        Assert::isInstanceOf($file, File::class);

        if (null !== $item->getImagePath() && $this->has($item->getImagePath())) {
            $this->remove($item->getImagePath());
        }

        do {
            $path = $this->imagePathGenerator->generate($item);
        } while ($this->isAdBlockingProne($path) || $this->filesystem->has($path));

        $item->setImagePath($path);

        $this->filesystem->write(
            $item->getImagePath(),
            file_get_contents($item->getImage()->getPathname())
        );
    }

    public function remove(string $path): bool
    {
        if ($this->filesystem->has($path)) {
            return $this->filesystem->delete($path);
        }

        return false;
    }

    private function has(string $path): bool
    {
        return $this->filesystem->has($path);
    }

    /**
     * Will return true if the path is prone to be blocked by ad blockers
     */
    private function isAdBlockingProne(string $path): bool
    {
        return strpos($path, 'ad') !== false;
    }
}
