<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class RickController extends Controller
{
    public function index()
    {
        try {
            $response = Http::get('https://rickandmortyapi.com/api/character');

            if ($response->successful()) {
                $characters = $response->json()['results'];
                return view('rick', ['characters' => $characters]);
            } else {
                return view('rick', ['characters' => [], 'error' => 'Erro ao buscar dados da API.']);
            }
        } catch (\Exception $e) {
            return view('rick', ['characters' => [], 'error' => 'Erro de conexão com a API.']);
        }
    }
}
