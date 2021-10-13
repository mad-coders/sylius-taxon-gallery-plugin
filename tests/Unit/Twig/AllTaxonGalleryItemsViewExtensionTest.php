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

namespace Tests\Madcoders\SyliusTaxonGalleryPlugin\Unit\Twig;

use Madcoders\SyliusTaxonGalleryPlugin\Twig\AllTaxonGalleryItemsViewExtension;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Tests\Madcoders\SyliusTaxonGalleryPlugin\Unit\AbstractUnitTestCase;
use Twig\Environment;
use Twig\Loader\ArrayLoader;

class AllTaxonGalleryItemsViewExtensionTest extends AbstractUnitTestCase
{
    private Environment $twig;

    protected function setUp(): void
    {
        $this->twig = new Environment(new ArrayLoader([
            'show_all_active_taxon_gallery_items.twig' => "{{ show_all_active_taxon_gallery_items() }}",
            'show_all_active_taxon_gallery_items_own_template.twig' => "{{ show_all_active_taxon_gallery_items('own_template.twig') }}",
            '@MadcodersSyliusTaxonGalleryPlugin/Shop/TaxonGallery/View/Classic/show_all.html.twig' => 'gallery',
            'own_template.twig' => 'own_template',
        ]));

        // given
        $taxonGalleryItemsRepository = $this->prophesize(RepositoryInterface::class);
        $extension = new AllTaxonGalleryItemsViewExtension($taxonGalleryItemsRepository->reveal(), $this->twig);

        $this->twig->setCharset('UTF-8');
        $this->twig->addExtension($extension);
    }

    /**
     * @test
     */
    function it_renders_taxon_gallery_with_default_template()
    {
        // when
        $result = $this->twig->render('show_all_active_taxon_gallery_items.twig');

        $this->assertEquals('gallery', $result);
    }

    /**
     * @test
     */
    function it_renders_taxon_gallery_with_own_template()
    {
        // when
        $result = $this->twig->render('show_all_active_taxon_gallery_items_own_template.twig');

        $this->assertEquals('own_template', $result);
    }
}
