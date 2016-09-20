<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AmigosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AmigosTable Test Case
 */
class AmigosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AmigosTable
     */
    public $Amigos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.amigos',
        'app.usuarios'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Amigos') ? [] : ['className' => 'App\Model\Table\AmigosTable'];
        $this->Amigos = TableRegistry::get('Amigos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Amigos);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
