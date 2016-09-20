<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CakeDefaultTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CakeDefaultTable Test Case
 */
class CakeDefaultTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CakeDefaultTable
     */
    public $CakeDefault;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.cake_default'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CakeDefault') ? [] : ['className' => 'App\Model\Table\CakeDefaultTable'];
        $this->CakeDefault = TableRegistry::get('CakeDefault', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CakeDefault);

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
