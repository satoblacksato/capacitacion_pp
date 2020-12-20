<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear/Editar Libro') }}
        </h2>
    </x-slot>

    <div class="py-12">
            <livewire:book-component :category="$category" :book="$book" :action="$action" > </livewire:book-component>
    </div>
</x-app-layout>
