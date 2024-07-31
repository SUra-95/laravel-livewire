<div wire:key="{{ $todo->id }}"
    class="todo mb-5 card px-5 py-6 bg-white col-span-1 border-t-2 border-blue-500 hover:shadow">
    <div class="flex justify-between space-x-2">

        <div class="flex items-center">
            @if ($todo->completed)
                <input wire:click="toggle({{ $todo->id }})" class="mr-2" type="checkbox" checked>
            @else
                <input wire:click="toggle({{ $todo->id }})" class="mr-2" type="checkbox">
            @endif

            @if ($editingTodoID === $todo->id)
                <div>
                    <input wire:model="editingTodoName" type="text" placeholder="Todo.."
                        class="bg-gray-100  text-gray-900 text-sm rounded block w-full p-2.5">

                    @error('editingTodoID')
                        <span class="text-red-500 text-xs block">{{ $message }}</span>
                    @enderror
                </div>
            @else
                <h3 class="text-lg text-semibold text-gray-800">{{ $todo->name }}</h3>
            @endif
        </div>



        <div x-data="{ isOpen: false }" class="flex items-center space-x-2">
            <button wire:click="edit({{ $todo->id }})"
                class="text-sm text-teal-500 font-semibold rounded hover:text-teal-800">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                </svg>
            </button>
            <button x-on:click="isOpen = true" 
                class="text-sm text-red-500 font-semibold rounded hover:text-teal-800 mr-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                </svg>
            </button>
            <div>

                <div x-show="isOpen" class="fixed inset-0 z-40 min-h-full overflow-y-auto overflow-x-hidden transition flex items-center">
                    <!-- overlay -->
                    <div aria-hidden="true" class="fixed inset-0 w-full h-full bg-black/50 cursor-pointer">
                    </div>
                    <!-- Modal -->
                    <div class="relative w-full cursor-pointer pointer-events-none transition my-auto p-4">
                        <div
                            class="w-full py-2 bg-white cursor-default pointer-events-auto dark:bg-gray-800 relative rounded-xl mx-auto max-w-sm">
                            <button x-on:click="isOpen = false" tabindex="-1" type="button" class="absolute top-2 right-2 rtl:right-auto rtl:left-2">
                                <svg title="Close" tabindex="-1" class="h-4 w-4 cursor-pointer text-gray-400"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="sr-only">
                                    Close
                                </span>
                            </button>
                            <div class="space-y-2 p-2">
                                <div class="p-4 space-y-2 text-center dark:text-white">
                                    <h2 class="text-xl font-bold tracking-tight" id="page-action.heading">
                                        Delete Todo
                                    </h2>
    
                                    <p class="text-gray-500">
                                        Are you sure you want to delete this?
                                    </p>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <div aria-hidden="true" class="border-t dark:border-gray-700 px-2"></div>
                                <div class="px-6 py-2">
                                    <div class="grid gap-2 grid-cols-[repeat(auto-fit,minmax(0,1fr))]">
                                        <button x-on:click="isOpen = false" type="button"
                                            class="inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset dark:focus:ring-offset-0 min-h-[2.25rem] px-4 text-sm text-gray-800 bg-white border-gray-300 hover:bg-gray-50 focus:ring-primary-600 focus:text-primary-600 focus:bg-primary-50 focus:border-primary-600 dark:bg-gray-800 dark:hover:bg-gray-700 dark:border-gray-600 dark:hover:border-gray-500 dark:text-gray-200 dark:focus:text-primary-400 dark:focus:border-primary-400 dark:focus:bg-gray-800">
                                            <span class="flex items-center gap-1">
                                                <span class="">
                                                    Cancel
                                                </span>
                                            </span>
                                        </button>
                                        <button 
                                        wire:click="delete({{ $todo->id }})" 
                                        type="submit"
                                            class="inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset dark:focus:ring-offset-0 min-h-[2.25rem] px-4 text-sm text-white shadow focus:ring-white border-transparent bg-red-600 hover:bg-red-500 focus:bg-red-700 focus:ring-offset-red-700">
    
                                            <span class="flex items-center gap-1">
                                                <span class="">
                                                    Confirm
                                                </span>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <span class="text-xs text-gray-500"> {{ $todo->created_at }} </span>
    <div class="mt-3 text-xs text-gray-700">
        @if ($editingTodoID === $todo->id)
            <button wire:click="update"
                class="mt-3 px-4 py-2 bg-teal-500 text-white font-semibold rounded hover:bg-teal-600">Update</button>
            <button wire:click="cancelEdit"
                class="mt-3 px-4 py-2 bg-red-500 text-white font-semibold rounded hover:bg-red-600">Cancel</button>
        @endif

    </div>
</div>
