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

use Behat\Mink\Element\NodeElement;
use Behat\Mink\Exception\ElementNotFoundException;
use Sylius\Behat\Behaviour\Toggles;
use Sylius\Behat\Page\Admin\Crud\CreatePage as BaseCreatePage;
use Sylius\Behat\Service\AutocompleteHelper;
use Tests\Madcoders\SyliusTaxonGalleryPlugin\Behat\Behaviour\ChoosesFormElement;

class CreatePage extends BaseCreatePage implements CreatePageInterface
{
    use ChoosesFormElement;

    use Toggles;

    /**
     * @throws ElementNotFoundException
     */
    protected function getToggleableElement(): NodeElement
    {
        return $this->getElement('enabled');
    }

    public function attachFile(string $path, string $localeCode): void
    {
        $filesPath = $this->getParameter('files_path');
        $prefix = '#madcoders_taxon_gallery_item_form_type_image';

        $this->getDocument()->find('css', $prefix)->attachFile($filesPath . $path);
    }

    public function specifyMenuTaxon(string $menuTaxon): void
    {
        $menuTaxonElement = $this->getElement('menu_taxon')->getParent();

        AutocompleteHelper::chooseValue($this->getSession(), $menuTaxonElement, $menuTaxon);
    }

    protected function getDefinedElements(): array
    {
        return array_merge(parent::getDefinedElements(), [
            'enabled' => '#madcoders_taxon_gallery_item_form_type_enabled',
            'menu_taxon' => '#madcoders_taxon_gallery_item_form_type_menuTaxon',
        ]);
    }
}
