@extends('layouts/main')

@section('styles')
    <link rel="stylesheet" href="{{ URL::asset('css/main.css') }}"/>
    <link rel="stylesheet" href="{{ URL::asset('css/datepicker.css') }}"/>
@endsection

@section('scripts') 
    <script>
        $(document).ready(function() {
            var calendarEl = document.getElementById('calendar');
        
            var calendar = new FullCalendar.Calendar(calendarEl, {
            googleCalendarApiKey: 'AIzaSyCtkKmfQ6T0W7XevOzMxeTIuWGfuQHvL5M',
            eventSources: [
                <?php foreach($calendarList->items as $key=>$value): ?>
                    {
                        googleCalendarId: '<?php echo $calendarList->items[$key]->id; ?>',
                        backgroundColor: '<?php echo $calendarList->items[$key]->backgroundColor; ?>'
                    },
                <?php endforeach; ?>
            ],
            dayMaxEventRows: true,
            height: "auto",
            views: {
                timeGrid: {
                    dayMaxEventRows: 3
                },
                dayGridMonth: {
                    dayMaxEventRows: 3
                }
            },
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: [
                @foreach($tasks as $task)
                {
                    title : '{{ $task->title }}',
                    start : '{{ $task->start_date }}',
                    end : '{{ $task->end_date }}'
                },
                @endforeach
            ]
            });
            calendar.render();
        });
    </script>
    <script src="{{ URL::asset('js/colorPickerInit.js') }}"></script>
    <script src="{{ URL::asset('js/package.js') }}" type="module"></script>
    <script src="{{ URL::asset('js/fullCalendar.js') }}" text="text/javascript"></script>
@endsection

@section('container')
<x-flashmsg></x-flashmsg>
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <table class="table-auto">
        <tr>
            <td colspan="2">
                <div x-data="{ show: false }" x-cloak>
                    <button type="button" class="btn-primary transition duration-300 ease-in-out
                    focus:outline-none focus:shadow-outline bg-teal-400 hover:bg-teal-700
                    text-white font-normal py-2 px-4 mr-1 rounded" @click={show=true}>
                        Create New Announcement
                    </button>
                    <x-modal :title="'Create Announcement'" :width="'600px'">
                        <form class="w-full max-w-lg" method="POST" action="/calendar/store" enctype="multipart/form-data">
                            @csrf
                            <!-- Title -->
                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full px-3">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-title">
                                    Title <span class="text-red-400 float-right">* required</span>
                                    </label>
                                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 @error('title') is-invalid @enderror" id="grid-title" type="text" placeholder="Title" name="title" value="{{ old('title') }}">
                                    @error('title') <div class="text-red-500 text-xs italic">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <!-- Description -->
                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full px-3">
                                  <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-desc">
                                    Description
                                  </label>
                                  <textarea id="grid-desc" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 resize" placeholder="Description" name="desc" value={{ old('desc') }}></textarea>
                                </div>
                            </div>
                            <!-- Start Date -->
                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-start-date">
                                        Start Date <span class="text-red-400 float-right">* required</span>
                                    </label>
                                    {{-- <x-datepicker :id="'grid-start-date'" :var="'startDate'"/> --}}
                                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="date" id="grid-start-date" name="startDate" value="<?php echo date("Y-m-d"); ?>">
                                </div>
                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-start-time">
                                        Start Time
                                    </label>
                                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="time" id="grid-start-time" name="startTime" value="{{ old('startTime') }}">
                                </div>
                            </div>
                            <!-- End Date -->
                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-end-date">
                                        End Date <span class="text-red-400 float-right">* required</span>
                                    </label>
                                    {{-- <x-datepicker :id="'grid-end-date'" :var="'endDate'"/> --}}
                                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="date" id="grid-end-date" name="endDate" value="<?php echo date("Y-m-d"); ?>">
                                </div>
                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-end-time">
                                        End Time
                                    </label>
                                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="time" id="grid-end-time" name="endTime" value="{{ old('endTime') }}">
                                </div>
                            </div>
                            <!-- Meet Conference -->
                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-meet">
                                        <input type="hidden" name="addMeetCheckbox" value="0">
                                        <input class="form-checkbox h-5 w-5 text-gray-600" type="checkbox" id="grid-meet" value="1" name="addMeetCheckbox">
                                        <span class="ml-2 text-gray-700">Add Google Meet Conference</span>
                                    </label>
                                </div>
                            </div>
                            <!-- Calendar Class -->
                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full px-3">
                                  <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-calendar">
                                    Calendar <span class="text-red-400 float-right">* required</span>
                                  </label>
                                  <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded" id="grid-calendar" name="calendar">
                                    <option value="" disabled selected>Select Class Calendar</option>
                                       @foreach( $calendarList->items as $calendar)
                                            @if ($calendar->accessRole == "owner") {{--  && $calendar->id != Auth::user()->email --}}
                                                <option value="{{ $calendar->id }}">{{ $calendar->summary }}</option>
                                            @endif
                                       @endforeach
                                   </select>
                                </div>
                            </div>
                            <!-- Color -->
                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full px-3">
                                  <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-color">
                                    Color
                                  </label>
                                  <x-colorpicker/>
                                </div>
                            </div>
                            
                            <div class="px-6 py-3 border-t mt-15">
                                <div class="flex justify-end" style="margin-right: -20px">
                                    <button @click={show=false} type="button" class="transition duration-300 ease-in-out
                                    focus:outline-none focus:shadow-outline bg-gray-200 rounded px-4 py-2 mr-1">Close</Button>
                                    <button type="submit" class="transition duration-300 ease-in-out
                                    focus:outline-none focus:shadow-outline bg-teal-400 hover:bg-teal-700 text-white rounded px-4 py-2">Save</Button>
                                </div>
                            </div>
                        </form>  
                    </x-modal>
                </div>
            </td>
        </tr>
        {{-- Calendar --}}
        <tr>
            <td>
                <div id='calendar-container'>
                    <div id="calendar" class="mt-5 w-4/5"></div>
                </div>
            </td>
            <td>
                <div>
                <h2 class="text-2xl font-semibold leading-tight">Users</h2>
            </div>
            <div class="my-2 flex sm:flex-row flex-col w-full">
                <div class="flex flex-row mb-1 sm:mb-0">
                    <div class="relative">
                        <select
                            class="appearance-none h-full rounded-l border block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            <option>5</option>
                            <option>10</option>
                            <option>20</option>
                        </select>
                        <div
                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </div>
                    </div>
                    <div class="relative">
                        <select
                            class="appearance-none h-full rounded-r border-t sm:rounded-r-none sm:border-r-0 border-r border-b block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:border-l focus:border-r focus:bg-white focus:border-gray-500">
                            <option>All</option>
                            <option>Active</option>
                            <option>Inactive</option>
                        </select>
                        <div
                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="block relative">
                    <span class="h-full absolute inset-y-0 left-0 flex items-center pl-2">
                        <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-500">
                            <path
                                d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z">
                            </path>
                        </svg>
                    </span>
                    <input placeholder="Search"
                        class="appearance-none rounded-r rounded-l sm:rounded-l-none border border-gray-400 border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none" />
                </div>
            </div>
            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    User
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Rol
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Created at
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Status
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 w-10 h-10">
                                            <img class="w-full h-full rounded-full"
                                                src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2.2&w=160&h=160&q=80"
                                                alt="" />
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                Vera Carpenter
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">Admin</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        Jan 21, 2020
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <span
                                        class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                        <span aria-hidden
                                            class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                        <span class="relative">Activo</span>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 w-10 h-10">
                                            <img class="w-full h-full rounded-full"
                                                src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2.2&w=160&h=160&q=80"
                                                alt="" />
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                Blake Bowman
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">Editor</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        Jan 01, 2020
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <span
                                        class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                        <span aria-hidden
                                            class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                        <span class="relative">Activo</span>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 w-10 h-10">
                                            <img class="w-full h-full rounded-full"
                                                src="https://images.unsplash.com/photo-1540845511934-7721dd7adec3?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2.2&w=160&h=160&q=80"
                                                alt="" />
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                Dana Moore
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">Editor</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        Jan 10, 2020
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <span
                                        class="relative inline-block px-3 py-1 font-semibold text-orange-900 leading-tight">
                                        <span aria-hidden
                                            class="absolute inset-0 bg-orange-200 opacity-50 rounded-full"></span>
                                        <span class="relative">Suspended</span>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-5 py-5 bg-white text-sm">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 w-10 h-10">
                                            <img class="w-full h-full rounded-full"
                                                src="https://images.unsplash.com/photo-1522609925277-66fea332c575?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2.2&h=160&w=160&q=80"
                                                alt="" />
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                Alonzo Cox
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-5 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">Admin</p>
                                </td>
                                <td class="px-5 py-5 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">Jan 18, 2020</p>
                                </td>
                                <td class="px-5 py-5 bg-white text-sm">
                                    <span
                                        class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
                                        <span aria-hidden
                                            class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
                                        <span class="relative">Inactive</span>
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div
                        class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between          ">
                        <span class="text-xs xs:text-sm text-gray-900">
                            Showing 1 to 4 of 50 Entries
                        </span>
                        <div class="inline-flex mt-2 xs:mt-0">
                            <button
                                class="text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-l">
                                Prev
                            </button>
                            <button
                                class="text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-r">
                                Next
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            </td>
        </tr>
    </table>
</div>
@endsection