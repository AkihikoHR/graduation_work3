<!-- resources/views/question/show.blade.php -->

<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('質問／出題内容の詳細') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          <div class="mb-6">
            <div class="flex flex-col mb-4">
              <p class="mb-2 uppercase font-bold text-lg text-grey-darkest">質問するテーマ／カテゴリー</p>
              <p class="py-2 px-3 text-grey-darkest" id="question">
                {{$question->question}}
              </p>
            </div>
            <div class="flex flex-col mb-4">
              <p class="mb-2 uppercase font-bold text-lg text-grey-darkest">質問内容</p>
              <p class="py-2 px-3 text-grey-darkest whitespace-pre-wrap" id="description">{{$question->description}}</p>
            </div>
            <div class="flex flex-col mb-4">
              <p class="mb-2 uppercase font-bold text-lg text-grey-darkest">添付画像</p>
              <img src="../../uploads/{{ $question->image }}" class="w-full h-full">
            </div>
            <div class="flex flex-col mb-4">
              <p class="mb-2 uppercase font-bold text-lg text-grey-darkest">投稿時間</p>
              <p class="py-2 px-3 text-grey-darkest" id="end_date">
                {{$question->created_at}}
              </p>
            </div>
             <div class="flex flex-col mb-4">
              <p class="mb-2 uppercase font-bold text-lg text-grey-darkest">質問したグループ</p>
              <p class="py-2 px-3 text-grey-darkest" id="name">
                {{$group->name}}
              </p>
            </div>
            
            <a href="{{ route('group.room',$group->id) }}" class="block text-center w-full py-3 mt-6 font-medium tracking-widest text-white uppercase bg-amber-500 shadow-lg focus:outline-none hover:bg-amber-400 hover:shadow-none">
              グループの部屋に戻る
            </a>
            <a href="{{ route('dashboard') }}" class="block text-center w-full py-3 mt-6 font-medium tracking-widest text-white uppercase bg-blue-500 shadow-lg focus:outline-none hover:bg-blue-400 hover:shadow-none">
              ダッシュボードへ
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>

