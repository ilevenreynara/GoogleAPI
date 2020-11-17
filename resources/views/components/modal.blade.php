<div x-show="show" tabindex="0" class="animated fadeIn z-40 overflow-auto left-0 top-0 bottom-0 right-0 w-full h-full fixed">
    <div @click.away="show = false" class="z-50 relative p-3 mx-auto my-0 max-w-full" style="width: {{ $width }}">
        <div class="animated fadeInUp bg-white rounded shadow-lg border flex flex-col overflow-hidden">
            <button @click={show=false} class="fill-current h-6 w-6 absolute right-0 top-0 m-6 font-3xl font-bold">&times;</button>
            <div class="px-6 py-3 text-xl border-b font-bold">{{ $title }}</div>
            
            <div class="p-6 flex-grow">
                {{ $slot }}
            </div>
        </div>
    </div>
    <div class="z-40 overflow-auto left-0 top-0 bottom-0 right-0 w-full h-full fixed bg-black opacity-50"></div>
</div>