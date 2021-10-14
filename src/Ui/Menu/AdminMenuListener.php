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

namespace Madcoders\SyliusTaxonGalleryPlugin\Ui\Menu;

use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;

class AdminMenuListener
{
    public function addAdminMenuItems(MenuBuilderEvent $event): void
    {
        $menu = $event->getMenu();

        $newMadcodersCareInstructionSubmenu = $menu
            ->addChild('madcoders-taxon-gallery')
            ->setLabel('Madcoders Taxon Gallery')
        ;

        $newMadcodersCareInstructionSubmenu
            ->addChild('madcoders-taxon-gallery-list', ['route' => 'madcoders_taxon_gallery_admin_taxon_gallery_item_index'])
            ->setLabel('Taxon Gallery Items')
            ->setLabelAttribute('icon', 'file image outline')
        ;
    }
}
