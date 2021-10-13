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

namespace Tests\Madcoders\SyliusTaxonGalleryPlugin\Behat\Behaviour;

use Behat\Mink\Exception\ElementNotFoundException;
use Sylius\Behat\Behaviour\DocumentAccessor;

trait ChoosesFormElement
{
    use DocumentAccessor;

    public function choosesFormElement(string $name, string $element): void
    {
        $this->getDocument()->fillField($element, $name);
    }

    /**
     * @throws ElementNotFoundException
     */
    public function selectFormElement(string $name, string $element): void
    {
        $this->getDocument()->selectFieldOption($element, $name);
    }
}
