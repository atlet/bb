<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\TournamentMatchesController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\TournamentMatchesController Test Case
 *
 * @link \App\Controller\TournamentMatchesController
 */
class TournamentMatchesControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.TournamentMatches',
        'app.TournamentEvents',
        'app.Competitor1s',
        'app.Competitor2s',
        'app.Winners',
        'app.Courts',
        'app.MatchGames',
    ];

    /**
     * Test index method
     *
     * @return void
     * @link \App\Controller\TournamentMatchesController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     * @link \App\Controller\TournamentMatchesController::view()
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     * @link \App\Controller\TournamentMatchesController::add()
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     * @link \App\Controller\TournamentMatchesController::edit()
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     * @link \App\Controller\TournamentMatchesController::delete()
     */
    public function testDelete(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
