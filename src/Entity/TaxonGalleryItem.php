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

namespace Madcoders\SyliusTaxonGalleryPlugin\Entity;

use Doctrine\Common\Comparable;
use Sylius\Component\Core\Model\TaxonInterface;
use Sylius\Component\Resource\Model\TimestampableTrait;
use Sylius\Component\Resource\Model\ToggleableTrait;
use SplFileInfo;

class TaxonGalleryItem implements
    Comparable,
    TaxonGalleryItemInterface,
    TaxonGalleryItemImageInterface
{
    use ToggleableTrait;
    use TimestampableTrait;

    private ?int $id = null;
    private ?string $code = null;
    private ?int $position = null;
    private ?string $description = null;
    private string $imageSource = self::IMAGE_SOURCE_TAXON;
    private ?SplFileInfo $image = null;
    private ?string $imagePath = null;
    private ?TaxonInterface $menuTaxon = null;

    public function __construct()
    {
        $this->enabled = false;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): void
    {
        $this->code = $code;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(?int $position): void
    {
        $this->position = $position;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getImageSource(): string
    {
        return $this->imageSource;
    }

    public function setImageSource(string $imageSource): void
    {
        $this->imageSource = $imageSource;
    }

    public function getImage(): ?SplFileInfo
    {
        return $this->image;
    }

    public function setImage(?SplFileInfo $image): void
    {
        $this->image = $image;
    }

    public function hasImage(): bool
    {
        return null !== $this->image;
    }

    public function getImagePath(): ?string
    {
        return $this->imagePath;
    }

    public function setImagePath(?string $imagePath): void
    {
        $this->imagePath = $imagePath;
    }

    public function getMenuTaxon(): ?TaxonInterface
    {
        return $this->menuTaxon;
    }

    public function setMenuTaxon(?TaxonInterface $menuTaxon): void
    {
        $this->menuTaxon = $menuTaxon;
    }

    public function compareTo($other): int
    {
        return $this->code === $other->getCode() ? 0 : 1;
    }
}
