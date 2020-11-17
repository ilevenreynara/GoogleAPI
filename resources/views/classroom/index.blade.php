@extends('layouts/main')

@section('styles')

@endsection

@section('scripts')
    
@endsection

@section('container')
<div class="container flex flex-col flex-wrap justify-center max-w-4xl m-auto my-10 fade-in px-2">
    <div class="flex flex-col p-4">
        <div x-data="{ open: false }">
          <div @click="open = !open" class="flex items-center justify-between bg-white border p-4 transition duration-500 ease-in-out hover:bg-gray-100 cursor-pointer">
            <p>Container 1</p>
            <span :class="open ? 'fa-chevron-up' : 'fa-chevron-down'" class="fas"></span>
          </div>
          <div x-show.transition.in.duration.800ms="open" class="border p-4">
            <div x-data="{ buka: false }">
                <div @click="buka = !buka" class="flex items-center justify-between bg-white border p-4 transition duration-500 ease-in-out hover:bg-gray-100 cursor-pointer">
                  <p>Sub-Container 1</p>
                  <span :class="buka ? 'fa-chevron-up' : 'fa-chevron-down'" class="fas"></span>
                </div>
                <div x-show.transition.in.duration.800ms="buka" class="border p-4">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam varius vel magna lacinia mollis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Quisque ligula neque, imperdiet nec est laoreet, pulvinar commodo odio. Vivamus eget eleifend libero. Fusce dolor nibh, porta eu gravida ut, maximus non erat.
                </div>
              </div>
          </div>
        </div>
        {{-- <div x-data="{ open: false }">
          <div @click="open = !open" class="flex items-center justify-between bg-gray-200 border p-4">
            <p>Container 2</p>
            <span :class="open ? 'fa-chevron-down' : 'fa-chevron-up'" class="fas"></span>
          </div>
            <div x-show.transition.in.duration.800ms="open" class="border p-4">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam varius vel magna lacinia mollis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Quisque ligula neque, imperdiet nec est laoreet, pulvinar commodo odio. Vivamus eget eleifend libero. Fusce dolor nibh, porta eu gravida ut, maximus non erat.
          </div>
        </div> --}}
        {{-- <div x-data="{ open: false }">
          <div @click="open = !open" class="flex items-center justify-between bg-gray-200 border p-4">
            <p>Container 3</p>
            <span :class="open ? 'fa-chevron-down' : 'fa-chevron-up'" class="fas"></span>
          </div>
          <div x-show.transition.in.duration.800ms="open" class="border p-4">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam varius vel magna lacinia mollis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Quisque ligula neque, imperdiet nec est laoreet, pulvinar commodo odio. Vivamus eget eleifend libero. Fusce dolor nibh, porta eu gravida ut, maximus non erat.
          </div>
        </div> --}}
      </div>
</div>
@endsection