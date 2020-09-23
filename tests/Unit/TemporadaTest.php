<?php

namespace Tests\Unit;

use App\Episodio;
use App\Temporada;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TemporadaTest extends TestCase
{
    
    private $temporada;

    protected function setUp(): void
    {
        parent::setUp();

        $temporada = new Temporada();
        
        $episodio1 = new Episodio();
        $episodio1->assistido = true;
        $temporada->episodios->add($episodio1);

        $episodio2 = new Episodio();
        $episodio2->assistido = false;
        $temporada->episodios->add($episodio2);
        
        $episodio3 = new Episodio();
        $episodio3->assistido = true;
        $temporada->episodios->add($episodio3);

        $this->temporada = $temporada;
    }

    public function testBuscaPorEpisodiosAssistidos()
    {
        $episodiosAssistidos = $this->temporada->getEpisodiosAssistidos();

        $this->assertCount(2, $episodiosAssistidos);

        foreach ($episodiosAssistidos as $episodio) {
            $this->assertTrue($episodio->assistido);
        }
    }

    public function testeBuscaTodosOsEpisodios()
    {
        $episodios = $this->temporada->episodios;
        $this->assertCount(3, $episodios);
    }
}
