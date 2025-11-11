@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Encabezado del Dashboard -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="px-4 py-6 bg-white sm:px-6">
                    <h1 class="text-3xl font-bold text-gray-900">
                        ¡Bienvenido, {{ auth()->user()->name }}!
                    </h1>
                    <p class="mt-2 text-sm text-gray-600">
                        Rol: <span class="font-semibold text-indigo-600">{{ $userRole }}</span>
                    </p>
                </div>
            </div>

            <!-- Tarjetas de Estadísticas -->
            <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2 lg:grid-cols-4">
                <!-- Total de Usuarios -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex items-center">
                            <div class="flex-1">
                                <dt class="text-sm font-medium text-gray-500 truncate">
                                    Total de Usuarios
                                </dt>
                                <dd class="mt-1 text-3xl font-semibold text-gray-900">
                                    {{ $totalUsers }}
                                </dd>
                            </div>
                            <div class="bg-indigo-100 rounded-full p-3">
                                <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292m0 0H8.646m3.354 0H16m-4-8.646a4 4 0 00-5.292 0M9.172 9.172L5.757 5.757m6.364 0l3.415 3.415m0 0L18.243 5.757"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total de Cursos -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex items-center">
                            <div class="flex-1">
                                <dt class="text-sm font-medium text-gray-500 truncate">
                                    Total de Cursos
                                </dt>
                                <dd class="mt-1 text-3xl font-semibold text-gray-900">
                                    {{ $totalCourses }}
                                </dd>
                            </div>
                            <div class="bg-green-100 rounded-full p-3">
                                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C6.5 6.253 2 10.998 2 17.25c0 5.079 3.855 9.26 8.756 9.589M12 6.253c5.5 0 10 4.745 10 10.997 0 5.079-3.855 9.26-8.756 9.589M21 16.061h-.001"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total de Secciones -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex items-center">
                            <div class="flex-1">
                                <dt class="text-sm font-medium text-gray-500 truncate">
                                    Total de Secciones
                                </dt>
                                <dd class="mt-1 text-3xl font-semibold text-gray-900">
                                    {{ $totalSections }}
                                </dd>
                            </div>
                            <div class="bg-blue-100 rounded-full p-3">
                                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Rol del Usuario -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex items-center">
                            <div class="flex-1">
                                <dt class="text-sm font-medium text-gray-500 truncate">
                                    Tu Rol
                                </dt>
                                <dd class="mt-1 text-lg font-semibold text-indigo-600">
                                    {{ $userRole }}
                                </dd>
                            </div>
                            <div class="bg-purple-100 rounded-full p-3">
                                <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sección específica por rol -->
            @if(auth()->user()->role_id === 2)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="px-4 py-6 sm:px-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">Mis Cursos</h2>
                        <p class="text-gray-600 mb-4">Tienes <span class="font-bold text-indigo-600">{{ $myCourses ?? 0 }}</span> curso(s) creado(s).</p>
                        <a href="{{ route('courses.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 transition ease-in-out duration-150">
                            Ver Mis Cursos
                        </a>
                    </div>
                </div>
            @elseif(auth()->user()->role_id === 3)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="px-4 py-6 sm:px-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">Mis Cursos Enrollados</h2>
                        <p class="text-gray-600 mb-4">Estás enrollado en <span class="font-bold text-indigo-600">{{ $enrolledCourses ?? 0 }}</span> curso(s).</p>
                        <a href="{{ route('courses.index') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 transition ease-in-out duration-150">
                            Ver Cursos Disponibles
                        </a>
                    </div>
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="px-4 py-6 sm:px-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">Panel Administrativo</h2>
                        <p class="text-gray-600 mb-6">Acceso total a la plataforma</p>
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                            <a href="{{ route('users.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                Gestionar Usuarios
                            </a>
                            <a href="{{ route('courses.index') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700">
                                Gestionar Cursos
                            </a>
                            <a href="{{ route('sections.index') }}" class="inline-flex items-center px-4 py-2 bg-purple-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-700">
                                Gestionar Secciones
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
