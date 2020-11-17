@extends('layouts/main')

@section('header')
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            {{ 'Welcome, ' . Auth::user()->name }}
        </div>
    </header>
@endsection
    
@section('container')
    <div class="max-w-7xl mx-auto grid gap-0 grid-cols-3 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-3 mt-6">
        <div class="w-full text-center max-w-sm mx-auto rounded-md shadow-md self-center flex items-end justify-center items-center h-56 w-full bg-cover">
            <h1 class="font-sans">Manage Courses</h1>
        </div>

        <div class="w-full text-center max-w-sm mx-auto rounded-md shadow-md self-center flex items-end justify-center items-center h-56 w-full bg-cover">
            <h1 class="font-sans">Manage Class</h1>
        </div>

        <div class="w-full text-center max-w-sm mx-auto rounded-md shadow-md self-center flex items-end justify-center items-center h-56 w-full bg-cover">
            <h1 class="font-sans">Manage Calendar</h1>
        </div>
    </div>
@endsection