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

namespace Madcoders\SyliusTaxonGalleryPlugin\Form\Type;

use Madcoders\SyliusTaxonGalleryPlugin\Entity\TaxonGalleryItemInterface;
use Sylius\Bundle\ResourceBundle\Form\EventSubscriber\AddCodeFormSubscriber;
use Sylius\Bundle\TaxonomyBundle\Form\Type\TaxonAutocompleteChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

final class TaxonGalleryItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('enabled', CheckboxType::class, [
                'required' => false,
                'label' => 'madcoders_taxon_gallery.admin.taxon_gallery_item.form.enabled',
            ])
            ->add('position', IntegerType::class, [
                'required' => false,
                'label' => 'madcoders_taxon_gallery.admin.taxon_gallery_item.form.position',
            ])
            ->add('description', TextareaType::class, [
                'required' => false,
                'label' => 'madcoders_taxon_gallery.admin.taxon_gallery_item.form.description',
            ])
            ->add('imageSource',ChoiceType::class, [
                'required' => true,
                'choices'  => [
                    'madcoders_taxon_gallery.admin.taxon_gallery_item.form.image.use_from_taxon' => TaxonGalleryItemInterface::IMAGE_SOURCE_TAXON,
                    'madcoders_taxon_gallery.admin.taxon_gallery_item.form.image.upload_image' => TaxonGalleryItemInterface::IMAGE_SOURCE_CUSTOM,
                ],
                'label' => 'madcoders_taxon_gallery.admin.taxon_gallery_item.form.image_source',
            ])
            ->add('image', FileType::class, [
                'required' => false,
                'label' => 'madcoders_taxon_gallery.admin.taxon_gallery_item.form.mainIcon',
            ])
            ->add('menuTaxon', TaxonAutocompleteChoiceType::class, [
                'required' => true,
                'label' => 'sylius.form.channel.menu_taxon',
                'constraints' => [
                    new NotBlank([
                        'message' => 'madcoders_taxon_gallery.validator.not_blank',
                    ])
                ],
            ])

            ->addEventSubscriber(new AddCodeFormSubscriber(
                NULL,
                [
                    'constraints' => [
                        new NotBlank([
                            'message' => 'madcoders_taxon_gallery.validator.not_blank',
                        ])
                    ],
                ]
            ))
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'madcoders_taxon_gallery_item_form_type';
    }
}
