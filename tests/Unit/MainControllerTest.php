<?php
namespace Tests\Unit;

use Curse\App\Curse;
use Curse\Facades\CurseFacade;
use Tests\TestCase;

class MainControllerTest extends TestCase
{
    public function test()
    {
        $curse = new Curse();
        $this->assertEquals($curse->getLanguage(), 'tr');

        $curse = $curse->setLanguage('en');
        $this->assertEquals($curse->getLanguage(), 'en');

        $softFile = $curse->getSoftFile();
        $hardFile = $curse->getHardFile();


        $this->assertIsArray($softFile);
        $this->assertIsArray($hardFile);

        $curse = $curse->setLanguage('tr')->setText("Deneme Testi");

        $this->assertFalse($curse->check());

        $curse = $curse->setText("Deneamme am göt");

        $this->assertTrue($curse->check());
    }
}
