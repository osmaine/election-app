<?php

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VoteListsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VoteListsTable Test Case
 */
class VoteListsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\VoteListsTable
     */
    public $VoteLists;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.VoteLists',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('VoteLists') ? [] : ['className' => VoteListsTable::class];
        $this->VoteLists = TableRegistry::getTableLocator()->get('VoteLists', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->VoteLists);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
