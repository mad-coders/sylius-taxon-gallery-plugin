<?php

declare(strict_types=1);

namespace Tests\Madcoders\SyliusTaxonGalleryPlugin\Behat\Page\Shop;

use FriendsOfBehat\PageObjectExtension\Page\SymfonyPage;

/**
 * Sylius TaxonGallery Plugin
 *
 * @copyright MADCODERS Team (www.madcoders.co)
 * @licence For the full copyright and license information, please view the LICENSE
 *
 * Architects of this package:
 * @author Leonid Moshko <l.moshko@madcoders.pl>
 * @author Piotr Lewandowski <p.lewandowski@madcoders.pl>
 */
class CreditsPage extends SymfonyPage implements CreditsPageInterface
{
    /**
     * {@inheritdoc}
     */
    public function getHeader(): string
    {
        return $this->getElement('header')->getText();
    }

    /**
     * {@inheritdoc}
     */
    public function getRouteName(): string
    {
        return 'madcoders_sylius_taxon_gallery_credits';
    }

    /**
     * {@inheritdoc}
     */
    protected function getDefinedElements(): array
    {
        return array_merge(parent::getDefinedElements(), [
            'header' => '[data-test-credits-title]',
        ]);
    }
}
