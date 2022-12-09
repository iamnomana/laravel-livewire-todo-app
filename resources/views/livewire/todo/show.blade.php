<x-slot name="title">Todos</x-slot>

<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('Todos') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white px-4 py-4 shadow-xl sm:rounded-lg">
            @if (session()->has('message'))
            <div class="my-3 rounded-b border-t-4 border-teal-500 bg-teal-100 px-4 py-3 text-teal-900 shadow-md"
                role="alert">
                <div class="flex">
                    <div>
                        <p class="text-sm">{{ session('message') }}</p>
                    </div>
                </div>
            </div>
            @endif

            <button class="my-3 rounded bg-blue-500 py-2 px-4 font-bold text-white hover:bg-blue-700"
                wire:click="create">Create New
                Todo
            </button>

            @if ($isOpen)
            {{-- @livewire('todo.create') --}}
            @include('livewire.todo.create')
            @endif

            <table class="w-full table-fixed">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="w-20 px-4 py-2">No.</th>
                        <th class="px-4 py-2">Todo</th>
                        <th class="w-1/3 px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($todos as $todo)
                    <tr>
                        <td class="border px-4 py-2">{{ $todo->id }}
                        </td>
                        <td class="border px-4 py-2">{{ $todo->todo }}
                        </td>
                        <td class="border px-4 py-2">
                            <button class="rounded bg-blue-500 py-2 px-4 text-white hover:bg-blue-700"
                                wire:click="edit({{ $todo->id }})">
                                <i class="la la-edit"></i>
                            </button>
                            <button class="rounded bg-red-500 py-2 px-4 text-white hover:bg-red-700"
                                wire:click="delete({{ $todo->id }})">
                                <i class="la la-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
