<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CompetitorPlayersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CompetitorPlayersTable Test Case
 */
class CompetitorPlayersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CompetitorPlayersTable
     */
    protected $CompetitorPlayers;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.CompetitorPlayers',
        'app.Competitors',
        'app.Players',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('CompetitorPlayers') ? [] : ['className' => CompetitorPlayersTable::class];
        $this->CompetitorPlayers = $this->getTableLocator()->get('CompetitorPlayers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->CompetitorPlayers);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\CompetitorPlayersTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \App\Model\Table\CompetitorPlayersTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
