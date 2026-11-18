<?php

namespace TddWizard\Fixtures\Catalog;

use Magento\Framework\Indexer\IndexerInterface;
use Magento\Framework\Indexer\IndexerRegistry;
use Magento\TestFramework\Helper\Bootstrap;
use PHPUnit\Framework\TestCase;

/**
 * @magentoDataFixtureBeforeTransaction disableReindexSchedule
 * @magentoAppIsolation enabled
 * @magentoDbIsolation enabled
 */
class IndexerErrorsTest extends TestCase
{
    /** @var bool */
    private static $indexIsScheduledOrig;

    /**
     * @deprecated the test should be removed in next release, but we should still keep the exception in case this
     *             happens again
     * @magentoDataFixture Magento/Store/_files/second_website_with_two_stores.php
     */
    public function testHelpfulErrorMessageForFulltextIndexSchedule(): void
    {
        $this->markTestSkipped('Since Magento 2.3.6 / 2.4.1 these transaction exceptions do not occur anymore');
    }

    public static function disableReindexSchedule(): void
    {
        /* @var IndexerInterface $model */
        $model = Bootstrap::getObjectManager()->get(IndexerRegistry::class)->get('catalogsearch_fulltext');
        self::$indexIsScheduledOrig = $model->isScheduled();
        $model->setScheduled(false);
    }

    public static function disableReindexScheduleRollback(): void
    {
        /* @var IndexerInterface $model */
        $model = Bootstrap::getObjectManager()->get(IndexerRegistry::class)->get('catalogsearch_fulltext');
        $model->setScheduled(self::$indexIsScheduledOrig);
    }
}
