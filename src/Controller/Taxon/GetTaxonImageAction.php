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

namespace Madcoders\SyliusTaxonGalleryPlugin\Controller\Taxon;

use Liip\ImagineBundle\Templating\Helper\FilterHelper;
use Sylius\Component\Core\Model\TaxonInterface;
use Sylius\Component\Taxonomy\Repository\TaxonRepositoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class GetTaxonImageAction
{
    private TaxonRepositoryInterface $taxonRepository;
    private FilterHelper $filterHelper;

    public function __construct(TaxonRepositoryInterface $taxonRepository, FilterHelper $filterHelper)
    {
        $this->taxonRepository = $taxonRepository;
        $this->filterHelper = $filterHelper;
    }

    public function __invoke(string $taxonCode): Response
    {
        /** @var TaxonInterface|null $taxon */
        $taxon = $this->taxonRepository->findOneBy(['code' => $taxonCode]);

        if (!$taxon instanceof TaxonInterface) {
            throw new NotFoundHttpException(sprintf('Taxon "%s" has not been found', $taxonCode));
        }

        $image = $taxon->getImages()->first();
        $filterImage = function(string $path): string {
            return $this->filterHelper->filter($path, 'taxon_small');
        };

        $data = [
            'code' => $taxon->getCode(),
            'image' => $image && ($path = $image->getPath()) ? $filterImage($path) : null,
        ];

        return new JsonResponse($data);
    }

}
