<!-- resources/views/group/show.blade.php -->

<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('選択したグループの詳細') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          <div class="mb-6">
            <div class="flex flex-col mb-4">
              <p class="mb-2 uppercase font-bold text-lg text-grey-darkest">グループ名</p>
              <p class="py-2 px-3 text-grey-darkest" id="name">
                {{$group->name}}
              </p>
            </div>
            <div class="flex flex-col mb-4">
              <p class="mb-2 uppercase font-bold text-lg text-grey-darkest">グループの説明</p>
              <p class="py-2 px-3 text-grey-darkest whitespace-pre-wrap" id="description">{{$group->description}}</p>
            </div>
            <div class="flex flex-col mb-4">
              <p class="mb-2 uppercase font-bold text-lg text-grey-darkest">グループの募集条件</p>
              <p class="py-2 px-3 text-grey-darkest whitespace-pre-wrap" id="condition">{{$group->condition}}</p>
            </div>
            <div class="flex flex-col mb-4">
              <p class="mb-2 uppercase font-bold text-lg text-grey-darkest">グループの活動終了日</p>
              <p class="py-2 px-3 text-grey-darkest" id="end_date">
                {{$group->end_date}}
              </p>
            </div>
            <div class="flex flex-col mb-4">
              <p class="mb-2 uppercase font-bold text-lg text-grey-darkest">メンバーの数</p>
              <p class="py-2 px-3 text-grey-darkest" id="end_date">
                   {{ $group->users()->count() }}
              </p>
            </div>
            
            <form action="{{ route('join',$group) }}" method="GET" class="text-left">
               @csrf
               <button type="submit" class="w-full bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                 参加する
               </button>
            </form>
            
            <a href="{{ route('group.index') }}" class="block text-center w-full py-3 mt-6 font-medium tracking-widest text-white uppercase bg-black shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
              グループ一覧へ
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>

