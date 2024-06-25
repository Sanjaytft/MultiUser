<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>

                <div class="nav">
                    <ul class="flex">
                        <li class="mr-6">
                          <a class="text-blue-500 hover:text-blue-800" href="{{ url('roles')}}">Roles</a>
                        </li>
                        <li class="mr-6">
                          <a class="text-blue-500 hover:text-blue-800" href="{{ url('permissions')}}">Permissions</a>
                        </li>
                        <li class="mr-6">
                          <a class="text-blue-500 hover:text-blue-800" href="{{ url('users')}}">Users</a>
                        </li>
                        <li class="mr-6">
                          <a class="text-gray-400 cursor-not-allowed" href="#">Disabled</a>
                        </li>
                      </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
