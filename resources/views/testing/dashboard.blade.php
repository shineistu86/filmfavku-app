@extends('layouts.app')

@section('title', 'Testing Dashboard - FilmFavku')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="display-5">Dashboard Testing Aplikasi</h1>
            <p class="lead">Monitor kesehatan dan kinerja aplikasi FilmFavku</p>
        </div>
    </div>

    <!-- Health Status Cards -->
    <div class="row mb-4">
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card text-center border-success">
                <div class="card-body">
                    <i class="fas fa-heartbeat text-success fa-2x mb-2"></i>
                    <h5 class="card-title">Aplikasi</h5>
                    <p class="card-text">
                        <span class="badge bg-{{ $tests['application_health']['status'] == 'success' ? 'success' : 'danger' }}">
                            {{ ucfirst($tests['application_health']['status']) }}
                        </span>
                    </p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card text-center border-info">
                <div class="card-body">
                    <i class="fas fa-database text-info fa-2x mb-2"></i>
                    <h5 class="card-title">Database</h5>
                    <p class="card-text">
                        <span class="badge bg-{{ $tests['database_connection']['status'] == 'success' ? 'success' : 'danger' }}">
                            {{ ucfirst($tests['database_connection']['status']) }}
                        </span>
                    </p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card text-center border-warning">
                <div class="card-body">
                    <i class="fas fa-plug text-warning fa-2x mb-2"></i>
                    <h5 class="card-title">API</h5>
                    <p class="card-text">
                        <span class="badge bg-{{ $tests['api_connection']['status'] == 'success' ? 'success' : 'danger' }}">
                            {{ ucfirst($tests['api_connection']['status']) }}
                        </span>
                    </p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card text-center border-primary">
                <div class="card-body">
                    <i class="fas fa-route text-primary fa-2x mb-2"></i>
                    <h5 class="card-title">Rute</h5>
                    <p class="card-text">
                        <span class="badge bg-success">Operasional</span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Detailed Test Results -->
    <div class="row">
        <!-- Application Health -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-heartbeat"></i> Kesehatan Aplikasi</h5>
                </div>
                <div class="card-body">
                    <p><strong>Status:</strong> 
                        <span class="badge bg-{{ $tests['application_health']['status'] == 'success' ? 'success' : 'danger' }}">
                            {{ ucfirst($tests['application_health']['status']) }}
                        </span>
                    </p>
                    <p><strong>Pesan:</strong> {{ $tests['application_health']['message'] }}</p>
                    <p><strong>Waktu Respon:</strong> {{ $tests['application_health']['response_time'] ?? 'N/A' }}</p>
                    <p><strong>Timestamp:</strong> {{ $tests['application_health']['timestamp'] }}</p>
                </div>
            </div>
        </div>

        <!-- Database Connection -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="fas fa-database"></i> Koneksi Database</h5>
                </div>
                <div class="card-body">
                    <p><strong>Status:</strong> 
                        <span class="badge bg-{{ $tests['database_connection']['status'] == 'success' ? 'success' : 'danger' }}">
                            {{ ucfirst($tests['database_connection']['status']) }}
                        </span>
                    </p>
                    <p><strong>Pesan:</strong> {{ $tests['database_connection']['message'] }}</p>
                    <p><strong>Waktu Respon:</strong> {{ $tests['database_connection']['response_time'] ?? 'N/A' }}</p>
                    <p><strong>Timestamp:</strong> {{ $tests['database_connection']['timestamp'] }}</p>
                </div>
            </div>
        </div>

        <!-- API Connection -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0"><i class="fas fa-plug"></i> Koneksi API</h5>
                </div>
                <div class="card-body">
                    <p><strong>Status:</strong> 
                        <span class="badge bg-{{ $tests['api_connection']['status'] == 'success' ? 'success' : 'danger' }}">
                            {{ ucfirst($tests['api_connection']['status']) }}
                        </span>
                    </p>
                    <p><strong>Pesan:</strong> {{ $tests['api_connection']['message'] }}</p>
                    <p><strong>Waktu Respon:</strong> {{ $tests['api_connection']['response_time'] ?? 'N/A' }}</p>
                    <p><strong>Data Diterima:</strong> 
                        <span class="badge bg-{{ $tests['api_connection']['data_retrieved'] ?? false ? 'success' : 'secondary' }}">
                            {{ ($tests['api_connection']['data_retrieved'] ?? false) ? 'Ya' : 'Tidak' }}
                        </span>
                    </p>
                    <p><strong>Timestamp:</strong> {{ $tests['api_connection']['timestamp'] }}</p>
                </div>
            </div>
        </div>

        <!-- Dependencies -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0"><i class="fas fa-cogs"></i> Dependencies</h5>
                </div>
                <div class="card-body">
                    @foreach($tests['dependencies_status'] as $name => $dep)
                    <div class="row mb-2">
                        <div class="col-6">
                            <strong>{{ ucfirst(str_replace('_', ' ', $name)) }}:</strong>
                        </div>
                        <div class="col-6">
                            <span class="badge bg-{{ $dep['status'] ? 'success' : 'warning' }}">
                                {{ $dep['current'] }}
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-bolt"></i> Aksi Cepat</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                        <a href="{{ route('api.test.connection') }}" class="btn btn-primary">
                            <i class="fas fa-sync-alt"></i> Uji Koneksi API Lagi
                        </a>
                        <a href="{{ route('home') }}" class="btn btn-outline-success">
                            <i class="fas fa-home"></i> Ke Beranda
                        </a>
                        <a href="{{ route('favorites.index') }}" class="btn btn-outline-info">
                            <i class="fas fa-star"></i> Ke Favorit
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection