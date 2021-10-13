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

namespace Tests\Madcoders\SyliusTaxonGalleryPlugin\Behat\Page\Admin\TaxonGallery\Item;

use Behat\Mink\Exception\ElementNotFoundException;
use Sylius\Behat\Page\Admin\Crud\CreatePageInterface as BaseCreatePageInterface;

interface CreatePageInterface  extends BaseCreatePageInterface
{
    /**
     * @throws ElementNotFoundException
     */
    public function choosesFormElement(string $name, string $element): void;

    public function selectFormElement(string $name, string $element): void;

    public function enable(): void;

    public function disable(): void;

    public function attachFile(string $path, string $localeCode): void;

    public function specifyMenuTaxon(string $menuTaxon): void;
}
