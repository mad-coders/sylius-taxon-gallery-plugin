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

namespace Madcoders\SyliusTaxonGalleryPlugin\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20211013120039 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'MADCODERS Taxon Gallery Item';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE madcoders_taxon_gallery_item (id INT AUTO_INCREMENT NOT NULL, menu_taxon_id INT DEFAULT NULL, code VARCHAR(100) NOT NULL, enabled TINYINT(1) NOT NULL, position INT NOT NULL, description LONGTEXT DEFAULT NULL, image_source VARCHAR(255) NOT NULL, icon_path VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_6860E12877153098 (code), INDEX IDX_6860E128F242B1E6 (menu_taxon_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE madcoders_taxon_gallery_item ADD CONSTRAINT FK_6860E128F242B1E6 FOREIGN KEY (menu_taxon_id) REFERENCES sylius_taxon (id) ON DELETE SET NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE madcoders_taxon_gallery_item');
    }
}
