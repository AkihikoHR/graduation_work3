<!-- resources/views/dashboard.blade.php -->

<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('ダッシュボード') }}
    </h2>
  </x-slot>
  
   <div>
      <div class="max-w-7xl mx-auto sm:w-10/12 md:w-8/10 lg:w-8/12">
        <div class="flex items-center justify-around">
           <div class="m-10 bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
              <button onclick="location.href='time_input.php'"> 学習時間の記録 </button>
           </div>
           <div class="m-10 bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
              <button onclick="location.href='record_input.php'">成績の記録</button>
           </div>
        </div>
      </div>
   </div>
  
</x-app-layout>