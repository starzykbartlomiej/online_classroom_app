<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Course creator') }}
        </h2>
    </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                        <form method="post" action="{{ route('courses.store')}}">
                            @csrf
                            <div>
                                <x-label for="title" :value="'Title'"></x-label>
                                <x-input id="title" class="block mt-1 w-full" type="text" name="title"
                                         :value="old('title')" autofocus />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <x-button class="ml-4">
                                    {{ __('Proceed') }}
                                </x-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

</x-app-layout>
