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

namespace Madcoders\SyliusTaxonGalleryPlugin\DependencyInjection;

use Madcoders\SyliusTaxonGalleryPlugin\Entity\TaxonGalleryItem;
use Madcoders\SyliusTaxonGalleryPlugin\Entity\TaxonGalleryItemInterface;
use Madcoders\SyliusTaxonGalleryPlugin\Form\Type\TaxonGalleryItemType;
use Sylius\Bundle\ResourceBundle\Controller\ResourceController;
use Sylius\Component\Resource\Factory\Factory;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('madcoders_taxon_gallery');
        $rootNode = $treeBuilder->getRootNode();


        $rootNode
            ->children()
                ->arrayNode('resources')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('taxon_gallery_item')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->variableNode('options')->end()
                                ->arrayNode('classes')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                    ->scalarNode('model')->defaultValue(TaxonGalleryItem::class)->cannotBeEmpty()->end()
                                    ->scalarNode('interface')->defaultValue(TaxonGalleryItemInterface::class)->cannotBeEmpty()->end()
                                    ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                    ->scalarNode('factory')->defaultValue(Factory::class)->end()
                                    ->scalarNode('repository')->cannotBeEmpty()->end()
                                    ->scalarNode('form')->defaultValue(TaxonGalleryItemType::class)->cannotBeEmpty()->end()
                                ->end()
                                ->end()
                            ->end()
                        ->end()

                    ->end()

                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
