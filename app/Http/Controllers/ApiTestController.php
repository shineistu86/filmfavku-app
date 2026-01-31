<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FilmapikApiService;

class ApiTestController extends Controller
{
    protected $filmapikApi;

    public function __construct(FilmapikApiService $filmapikApi)
    {
        $this->filmapikApi = $filmapikApi;
    }

    /**
     * Test koneksi ke API
     */
    public function testConnection()
    {
        $startTime = microtime(true);
        
        // Coba ambil film terbaru sebagai tes
        $result = $this->filmapikApi->getLatestFilms();
        
        $endTime = microtime(true);
        $executionTime = round(($endTime - $startTime) * 1000, 2); // dalam milidetik
        
        $response = [
            'status' => $result !== null ? 'success' : 'failed',
            'message' => $result !== null ? 'Koneksi API berhasil' : 'Koneksi API gagal',
            'execution_time_ms' => $executionTime,
            'timestamp' => now()->toISOString(),
            'has_data' => $result && isset($result['results']) && !empty($result['results']),
            'data_count' => $result && isset($result['results']) ? count($result['results']) : 0
        ];
        
        return response()->json($response);
    }
    
    /**
     * Test endpoint tertentu dari API
     */
    public function testEndpoint(Request $request)
    {
        $endpoint = $request->input('endpoint', 'latest');
        $params = $request->input('params', []);
        
        $startTime = microtime(true);
        
        switch($endpoint) {
            case 'latest':
                $result = $this->filmapikApi->getLatestFilms();
                break;
            case 'search':
                $query = $request->input('q', 'avenger');
                $result = $this->filmapikApi->searchFilms($query);
                break;
            case 'detail':
                $id = $request->input('id', 'tt0111161');
                $result = $this->filmapikApi->getFilmDetail($id);
                break;
            case 'country':
                $country = $request->input('search', 'usa');
                $result = $this->filmapikApi->getFilmsByCountry($country);
                break;
            case 'category':
                $category = $request->input('search', 'action');
                $result = $this->filmapikApi->getFilmsByCategory($category);
                break;
            default:
                $result = null;
        }
        
        $endTime = microtime(true);
        $executionTime = round(($endTime - $startTime) * 1000, 2);
        
        $response = [
            'status' => $result !== null ? 'success' : 'failed',
            'endpoint' => $endpoint,
            'params' => $params,
            'execution_time_ms' => $executionTime,
            'timestamp' => now()->toISOString(),
            'has_data' => $result && isset($result['results']) && !empty($result['results']),
            'data_count' => $result && isset($result['results']) ? count($result['results']) : 0,
            'sample_data' => $result && isset($result['results']) && !empty($result['results']) ? 
                             collect($result['results'])->take(3)->toArray() : null
        ];
        
        return response()->json($response);
    }
}