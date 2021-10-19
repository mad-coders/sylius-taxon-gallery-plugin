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

namespace Madcoders\SyliusTaxonGalleryPlugin\Twig;

use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Component\Templating\EngineInterface;
use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AllTaxonGalleryItemsViewExtension extends AbstractExtension
{
    private RepositoryInterface $taxonGalleryItemsRepository;

    /** @var EngineInterface|Environment */
    private $templatingEngine;

    /**
     * @param EngineInterface|Environment $templatingEngine
     */
    public function __construct(
        RepositoryInterface $taxonGalleryItemsRepository,
        $templatingEngine
    )
    {
        $this->taxonGalleryItemsRepository = $taxonGalleryItemsRepository;
        $this->templatingEngine = $templatingEngine;
    }

    /**
     * {@inheritDoc}
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('show_all_active_taxon_gallery_items', [$this, 'showAll'], ['is_safe' => ['html']]),
        ];
    }

    public function showAll(string $template = null): string
    {
        if (!$template) {
            $template = '@MadcodersSyliusTaxonGalleryPlugin/Shop/TaxonGallery/View/Classic/show_all.html.twig';
        }

        $taxonGalleryItems = $this->taxonGalleryItemsRepository->findBy(['enabled' => true], [ 'position' => 'asc' ]);

        return $this->templatingEngine->render(
            $template, ['taxonGalleryItems' => $taxonGalleryItems]
        );
    }
}
