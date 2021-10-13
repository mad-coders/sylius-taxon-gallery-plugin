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

namespace Tests\Madcoders\SyliusTaxonGalleryPlugin\Behat\Context\Ui\Admin\TaxonGallery;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use Behat\Mink\Exception\ElementNotFoundException;
use FriendsOfBehat\PageObjectExtension\Page\UnexpectedPageException;
use Madcoders\SyliusTaxonGalleryPlugin\Entity\TaxonGalleryItemInterface;
use Sylius\Behat\Service\Resolver\CurrentPageResolverInterface;
use Sylius\Behat\Service\SharedStorageInterface;
use Sylius\Component\Core\Model\AdminUserInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Tests\Madcoders\SyliusTaxonGalleryPlugin\Behat\Page\Admin\TaxonGallery\Item\CreatePageInterface;
use Tests\Madcoders\SyliusTaxonGalleryPlugin\Behat\Page\Admin\TaxonGallery\Item\IndexPageInterface;
use Tests\Madcoders\SyliusTaxonGalleryPlugin\Behat\Page\Admin\TaxonGallery\Item\UpdatePageInterface;
use Webmozart\Assert\Assert;

class TaxonGalleryItemContext implements Context
{
    private IndexPageInterface $indexPage;
    private CreatePageInterface $createPage;
    private UpdatePageInterface $updatePage;
    private RepositoryInterface $taxonGalleryItemsRepository;
    private CurrentPageResolverInterface $currentPageResolver;
    private SharedStorageInterface $sharedStorage;

    public function __construct(
        IndexPageInterface $indexPage,
        CreatePageInterface $createPage,
        UpdatePageInterface $updatePage,
        RepositoryInterface $taxonGalleryItemsRepository,
        CurrentPageResolverInterface $currentPageResolver,
        SharedStorageInterface $sharedStorage
    )
    {
        $this->indexPage = $indexPage;
        $this->createPage = $createPage;
        $this->updatePage = $updatePage;
        $this->taxonGalleryItemsRepository = $taxonGalleryItemsRepository;
        $this->currentPageResolver = $currentPageResolver;
        $this->sharedStorage = $sharedStorage;
    }

    /**
     * @Given I am on taxon gallery item index page
     *
     * @throws UnexpectedPageException
     */
    public function iAmOnTaxonGalleryItemIndexPage(): void
    {
        $this->indexPage->open();
    }

    /**
     * @Given I want to create a new item for taxon gallery
     * @Given I want to add a new item for taxon gallery
     * @When I click create button
     *
     * @throws UnexpectedPageException
     */
    public function iCreateTaxonGalleryItem(): void
    {
        $this->createPage->open();
    }

    /**
     * @Given I am on taxon gallery's item edit page for code :code
     *
     * @throws UnexpectedPageException
     */
    public function iAmOnTaxonGalleryItemEditPage(string $code): void
    {
        $item = $this->findTaxonGalleryItemByCode($code);

        $this->updatePage->open(['id' => $item->getId()]);
    }

    /**
     * @When I delete the taxon gallery item with code :code
     */
    public function iDeleteTaxonGalleryItemByCode(string $code): void
    {
        $this->indexPage->deleteResourceOnPage(['code' => $code]);
    }

    /**
     * @When I browse taxon gallery items
     * @When I want to browse taxon gallery items
     */
    public function iWantToBrowseTaxonGalleryItem(): void
    {
        $this->indexPage->open();
    }

    /**
     * @When I should be redirected to taxon gallery item create page
     *
     * @throws UnexpectedPageException
     */
    public function iShouldBeOnTaxonGalleryItemCreatePage(): void
    {
        $this->createPage->verify();
    }

    /**
     * @When I fill create form with following data:
     *
     * @param TableNode $table
     *
     * @throws ElementNotFoundException
     */
    public function iFillCreateForm(TableNode $table): void
    {
        $formName = 'madcoders_taxon_gallery_item_form_type';
        $localeCode = $this->getAdminLocaleCode();
        foreach($table as $row) {
            $translationPrefix = $row['type'] === 'translations' ? 'translations_'. $localeCode . '_' : '';
            $locator = sprintf('%s_%s%s', $formName, $translationPrefix, $row['field']);

            $this->createPage->choosesFormElement($row['value'], $locator);
        }
    }

    /**
     * @When I enable it
     * @When I switch on enable toggle
     */
    public function iEnableIt(): void
    {
        $this->createPage->enable();
    }

    /**
     * @When I select :valueName for :attributeCode
     *
     * @param string $valueName
     * @param string $attributeCode
     *
     */
    public function iSelectValueAttributeCriteria(string $valueName, string $attributeCode): void
    {
        $locator = 'madcoders_taxon_gallery_item_form_type_'.$attributeCode;

        $this->createPage->selectFormElement($valueName, $locator);
    }

    /**
     * @When I specify menu taxon as :menuTaxon
     */
    public function iSpecifyMenuTaxonAs(string $menuTaxon): void
    {
        $this->createPage->specifyMenuTaxon($menuTaxon);
    }

    /**
     * @When I change its menu taxon to :menuTaxon
     */
    public function iChangeItsMenuTaxonTo(string $menuTaxon): void
    {
        $this->updatePage->changeMenuTaxon($menuTaxon);
    }

    /**
     * @When I attach the :path image
     * @When I replace taxon gallery item image with :path in :language
     */
    public function iAttachTaxonGalleryItemImage(string $path, string $language = 'en_US'): void
    {
        $currentPage = $this->resolveCurrentPage();

        $currentPage->attachFile($path, $language);
    }

    /**
     * @When I click submit button
     *
     * @throws ElementNotFoundException
     */
    public function iClickSubmitButton(): void
    {
        $this->createPage->create();
    }

    /**
     * @When I click save changes button
     */
    public function iClickSaveChangesButton(): void
    {
        $this->updatePage->saveChanges();
    }

    /**
     * @Then I should see the taxon gallery item with code :code in the list
     * @Then the taxon gallery item with code :code should appear in the registry
     * @Then the taxon gallery item with code :code should be in the registry
     */
    public function thereShouldStillBeOnlyOneTaxonGalleryItemWithCode(string $code)
    {
        $this->iWantToBrowseTaxonGalleryItem();

        Assert::true($this->indexPage->isSingleResourceOnPage(['code' => $code]));
    }

    /**
     * @Then I should see the taxon gallery item with menu taxon :menuTaxonName in the list
     * @Then the taxon gallery item with menu taxon :menuTaxonName should appear in the registry
     * @Then the taxon gallery item with menu taxon :menuTaxonName should be in the registry
     */
    public function thereShouldStillBeOnlyOneTaxonGalleryItemWithMenuTaxon(string $menuTaxonName)
    {
        $this->iWantToBrowseTaxonGalleryItem();

        Assert::true($this->indexPage->isSingleResourceOnPage(['menuTaxon' => $menuTaxonName]));
    }

    /**
     * @Then the taxon gallery item with code :code should no longer exist in the registry
     */
    public function thisTaxonGalleryItemShouldNoLongerExistInTheRegistry(string $code): void
    {
        Assert::false($this->indexPage->isSingleResourceOnPage(['code' => $code]));
    }

    private function findTaxonGalleryItemByCode(string $code): TaxonGalleryItemInterface
    {
        $item = $this->taxonGalleryItemsRepository->findOneBy(['code' => $code]);
        Assert::notNull($item);

        return $item;
    }

    private function getAdminLocaleCode(): ?string
    {
        /** @var AdminUserInterface $adminUser */
        $adminUser = $this->sharedStorage->get('administrator');

        return $adminUser->getLocaleCode();
    }

    /**
     * @return CreatePageInterface|UpdatePageInterface
     */
    private function resolveCurrentPage()
    {
        return $this->currentPageResolver->getCurrentPageWithForm([
            $this->createPage,
            $this->updatePage
        ]);
    }
}
