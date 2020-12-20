<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
               {{--  <livewire:dashboard-categories :random="rand(1,11)"></livewire:dashboard-categories>  --}}
        <livewire:category-grid></livewire:category-grid>
    </div>
</x-app-layout>
