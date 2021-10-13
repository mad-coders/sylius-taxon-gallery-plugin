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

use Sylius\Component\Core\Model\TaxonInterface;
use Sylius\Component\Resource\Model\CodeAwareInterface;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TimestampableInterface;
use Sylius\Component\Resource\Model\ToggleableInterface;

interface TaxonGalleryItemInterface
    extends
    CodeAwareInterface,
    ResourceInterface,
    TimestampableInterface,
    ToggleableInterface
{
    public const IMAGE_SOURCE_TAXON = 'taxon';
    public const IMAGE_SOURCE_CUSTOM = 'custom';

    public function getPosition(): ?int;

    public function setPosition(?int $position): void;

    public function getDescription(): ?string;

    public function setDescription(?string $description): void;

    public function getImageSource(): string;

    public function setImageSource(string $imageSource): void;

    public function getMenuTaxon(): ?TaxonInterface;

    public function setMenuTaxon(?TaxonInterface $menuTaxon): void;
}
