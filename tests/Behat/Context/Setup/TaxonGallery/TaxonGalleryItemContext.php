<?php

/*
 * This file is part of package
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

namespace Tests\Madcoders\SyliusTaxonGalleryPlugin\Behat\Context\Setup\TaxonGallery;

use Behat\Behat\Context\Context;
use Madcoders\SyliusTaxonGalleryPlugin\Entity\TaxonGalleryItem;
use Sylius\Component\Core\Model\TaxonInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;

class TaxonGalleryItemContext implements Context
{
    private RepositoryInterface $taxonGalleryItemsRepository;

    public function __construct(
        RepositoryInterface $taxonGalleryItemsRepository
    )
    {
        $this->taxonGalleryItemsRepository = $taxonGalleryItemsRepository;
    }

    /**
     * @Given there are taxon gallery's item witch :code
     */
    public function createTaxonGalleryItemWithCode(string $code): void
    {
        $taxonGalleryItem = new TaxonGalleryItem();
        $taxonGalleryItem->setCode($code);

        $this->taxonGalleryItemsRepository->add($taxonGalleryItem);
    }

    /**
     * @Given there are taxon gallery's item witch :code and menu taxon :taxon
     */
    public function createTaxonGalleryItemWithCodeAndMenuTaxon(string $code, TaxonInterface $taxon): void
    {
        $taxonGalleryItem = new TaxonGalleryItem();
        $taxonGalleryItem->setCode($code);
        $taxonGalleryItem->setMenuTaxon($taxon);

        $this->taxonGalleryItemsRepository->add($taxonGalleryItem);
    }
}
