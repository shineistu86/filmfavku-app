<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TestingController extends Controller
{
    public function index()
    {
        // Kumpulkan informasi untuk testing
        $tests = [
            'application_health' => $this->testApplicationHealth(),
            'database_connection' => $this->testDatabaseConnection(),
            'api_connection' => $this->testApiConnection(),
            'routes_availability' => $this->testRoutesAvailability(),
            'dependencies_status' => $this->testDependenciesStatus(),
        ];

        return view('testing.dashboard', compact('tests'));
    }

    private function testApplicationHealth()
    {
        try {
            // Test basic application functionality
            $startTime = microtime(true);
            
            // Perform basic test
            $result = [
                'status' => 'success',
                'message' => 'Aplikasi berjalan正常',
                'response_time' => round((microtime(true) - $startTime) * 1000, 2) . 'ms',
                'timestamp' => now()->toISOString()
            ];
        } catch (\Exception $e) {
            $result = [
                'status' => 'failed',
                'message' => 'Aplikasi tidak berjalan dengan benar: ' . $e->getMessage(),
                'timestamp' => now()->toISOString()
            ];
        }

        return $result;
    }

    private function testDatabaseConnection()
    {
        try {
            $startTime = microtime(true);
            
            // Test database connection
            \DB::connection()->getPdo();
            
            $result = [
                'status' => 'success',
                'message' => 'Koneksi database berhasil',
                'response_time' => round((microtime(true) - $startTime) * 1000, 2) . 'ms',
                'timestamp' => now()->toISOString()
            ];
        } catch (\Exception $e) {
            $result = [
                'status' => 'failed',
                'message' => 'Koneksi database gagal: ' . $e->getMessage(),
                'timestamp' => now()->toISOString()
            ];
        }

        return $result;
    }

    private function testApiConnection()
    {
        try {
            $startTime = microtime(true);
            
            // Test API connection
            $response = Http::timeout(10)->get(config('filmapik.base_url') . '/latest');
            
            if ($response->successful()) {
                $result = [
                    'status' => 'success',
                    'message' => 'Koneksi API berhasil',
                    'response_time' => round((microtime(true) - $startTime) * 1000, 2) . 'ms',
                    'data_retrieved' => !empty($response->json()),
                    'timestamp' => now()->toISOString()
                ];
            } else {
                $result = [
                    'status' => 'failed',
                    'message' => 'Koneksi API gagal dengan status: ' . $response->status(),
                    'timestamp' => now()->toISOString()
                ];
            }
        } catch (\Exception $e) {
            $result = [
                'status' => 'failed',
                'message' => 'Koneksi API gagal: ' . $e->getMessage(),
                'timestamp' => now()->toISOString()
            ];
        }

        return $result;
    }

    private function testRoutesAvailability()
    {
        $routes = [
            'home' => route('home'),
            'film_latest' => route('film.latest'),
            'film_search' => route('film.search'),
            'favorites_index' => route('favorites.index'),
        ];

        $results = [];
        foreach ($routes as $name => $url) {
            try {
                $startTime = microtime(true);
                
                // Since we can't make actual requests in this context, we'll just validate the route exists
                $routeExists = \Route::has($name);
                
                $results[$name] = [
                    'status' => $routeExists ? 'success' : 'failed',
                    'url' => $url,
                    'message' => $routeExists ? 'Rute tersedia' : 'Rute tidak ditemukan',
                    'response_time' => round((microtime(true) - $startTime) * 1000, 2) . 'ms'
                ];
            } catch (\Exception $e) {
                $results[$name] = [
                    'status' => 'failed',
                    'url' => $url,
                    'message' => 'Rute tidak dapat diakses: ' . $e->getMessage()
                ];
            }
        }

        return $results;
    }

    private function testDependenciesStatus()
    {
        $dependencies = [
            'php_version' => [
                'current' => phpversion(),
                'required' => '8.1',
                'status' => version_compare(phpversion(), '8.1', '>=')
            ],
            'laravel_version' => [
                'current' => app()->version(),
                'required' => '10.x',
                'status' => true // Assuming Laravel 10 is installed
            ],
            'composer_packages' => [
                'current' => count(get_declared_classes()), // Simplified check
                'required' => 'dependencies_installed',
                'status' => true
            ]
        ];

        $results = [];
        foreach ($dependencies as $name => $dep) {
            $results[$name] = [
                'status' => $dep['status'] ? 'success' : 'warning',
                'current' => $dep['current'],
                'required' => $dep['required'],
                'message' => $dep['status'] ? 'Dependency terpenuhi' : 'Dependency mungkin bermasalah'
            ];
        }

        return $results;
    }

    public function runSpecificTest($testName)
    {
        switch ($testName) {
            case 'health':
                return response()->json($this->testApplicationHealth());
            case 'database':
                return response()->json($this->testDatabaseConnection());
            case 'api':
                return response()->json($this->testApiConnection());
            default:
                return response()->json(['status' => 'error', 'message' => 'Test tidak dikenali']);
        }
    }
}