<?php

declare(strict_types=1);

namespace Library\Circulation\Tests\UseCase\CirculationMaterialReturn\Application;

use Library\Circulation\Common\Infrastructure\Date\DateTimeBuilder;
use Library\Circulation\Tests\Common\TestData\BookMother;
use Library\Circulation\Tests\Common\TestData\PatronMother;
use Library\Circulation\Tests\KernelTestCase;
use Library\Circulation\UseCase\CirculationMaterialReturn\Application\CirculationMaterialReturnCommand;
use Library\Circulation\UseCase\CirculationMaterialReturn\Application\CirculationMaterialReturnHandler;

class CirculationMaterialReturnHandlerTest extends KernelTestCase
{
    /**
     * @var \Library\Circulation\UseCase\CirculationMaterialReturn\Application\CirculationMaterialReturnHandler
     */
    private CirculationMaterialReturnHandler $sut;

    /**
     * @test
     * @small
     */
    public function return_material(): void
    {
        ($this->sut)(
            new CirculationMaterialReturnCommand(
                BookMother::default(),
                PatronMother::default(),
                DateTimeBuilder::fromString('2020-01-02')
            )
        );
    }

    protected function setUp(): void
    {
        $this->sut = $this->resolve(CirculationMaterialReturnHandler::class);
    }
}
