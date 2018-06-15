<?php
namespace CGB\Accessmanager\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Christoph Balogh <cb@lustige-informatik.at>
 */
class PolicyTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \CGB\Accessmanager\Domain\Model\Policy
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \CGB\Accessmanager\Domain\Model\Policy();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getDomainModelObjectReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getDomainModelObject()
        );

    }

    /**
     * @test
     */
    public function setDomainModelObjectForStringSetsDomainModelObject()
    {
        $this->subject->setDomainModelObject('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'domainModelObject',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function getReaduserReturnsInitialValueForFrontendUser()
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getReaduser()
        );

    }

    /**
     * @test
     */
    public function setReaduserForObjectStorageContainingFrontendUserSetsReaduser()
    {
        $readuser = new \TYPO3\CMS\Extbase\Domain\Model\FrontendUser();
        $objectStorageHoldingExactlyOneReaduser = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneReaduser->attach($readuser);
        $this->subject->setReaduser($objectStorageHoldingExactlyOneReaduser);

        self::assertAttributeEquals(
            $objectStorageHoldingExactlyOneReaduser,
            'readuser',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function addReaduserToObjectStorageHoldingReaduser()
    {
        $readuser = new \TYPO3\CMS\Extbase\Domain\Model\FrontendUser();
        $readuserObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $readuserObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($readuser));
        $this->inject($this->subject, 'readuser', $readuserObjectStorageMock);

        $this->subject->addReaduser($readuser);
    }

    /**
     * @test
     */
    public function removeReaduserFromObjectStorageHoldingReaduser()
    {
        $readuser = new \TYPO3\CMS\Extbase\Domain\Model\FrontendUser();
        $readuserObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $readuserObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($readuser));
        $this->inject($this->subject, 'readuser', $readuserObjectStorageMock);

        $this->subject->removeReaduser($readuser);

    }

    /**
     * @test
     */
    public function getReadgroupReturnsInitialValueFor()
    {
    }

    /**
     * @test
     */
    public function setReadgroupForSetsReadgroup()
    {
    }

    /**
     * @test
     */
    public function getWriteuserReturnsInitialValueFor()
    {
    }

    /**
     * @test
     */
    public function setWriteuserForSetsWriteuser()
    {
    }

    /**
     * @test
     */
    public function getWritegroupReturnsInitialValueFor()
    {
    }

    /**
     * @test
     */
    public function setWritegroupForSetsWritegroup()
    {
    }

    /**
     * @test
     */
    public function getDeleteuserReturnsInitialValueFor()
    {
    }

    /**
     * @test
     */
    public function setDeleteuserForSetsDeleteuser()
    {
    }

    /**
     * @test
     */
    public function getDeletegroupReturnsInitialValueFor()
    {
    }

    /**
     * @test
     */
    public function setDeletegroupForSetsDeletegroup()
    {
    }
}
