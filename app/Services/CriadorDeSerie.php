<?php

namespace App\Services;

use App\Serie;
use Illuminate\Support\Facades\DB;

class CriadorDeSerie
{
    /** 
     * @param string $nomeSerie
     * @param int $qtdTemporadas
     * @param int $epPorTemporada
    */
    public function criarSerie(
        string $nomeSerie,
        int $qtdTemporadas,
        int $epPorTemporada
    ): Serie {
        DB::beginTransaction();
        $serie = Serie::create(['nome' => $nomeSerie]);
        $this->criarTemporadas($qtdTemporadas, $epPorTemporada, $serie);
        DB::commit();

        return $serie;
    }

    /** 
     * @param int $qtdTemporadas
     * @param int $epPorTemporada
     * @param Serie $serie
    */
    private function criarTemporadas(int $qtdTemporadas, int $epPorTemporada, Serie $serie): void
    {
        for ($i = 1; $i <= $qtdTemporadas; $i++) {
            $temporada = $serie->temporadas()->create(['numero' => $i]);
            
            $this->criarEpisodios($epPorTemporada, $temporada);
        }
    }

    /** 
     * @param int $qtdTemporadas
     * @param \Illuminate\Database\Eloquent\Model $temporada
    */
    private function criarEpisodios (int $epPorTemporada,\Illuminate\Database\Eloquent\Model $temporada): void
    {
        for ($j = 1; $j <= $epPorTemporada; $j++) {
            $temporada->episodios()->create(['numero' => $j]);
        }
    }
}
