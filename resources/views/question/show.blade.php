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
            @if ($question->image)
            <div class="flex flex-col mb-4">
              <p class="mb-2 uppercase font-bold text-lg text-grey-darkest">添付画像</p>
              <img src="../../uploads/{{ $question->image }}" class="w-full h-full">
            </div>
            @endif
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
            
            <a href="{{ route('answer.reply',$question->id) }}" method="GET" class="block text-center w-full py-3 mt-6 font-medium tracking-widest text-white uppercase bg-amber-500 shadow-lg focus:outline-none hover:bg-amber-400 hover:shadow-none">
              回答する
            </a>
            
            <table class="mt-24 text-center w-full border-collapse">
              <thead>
                <tr>
                  <th class="py-4 px-6 bg-stone-700 font-bold text-xl text-white border-b border-grey-light">全ての回答を見る</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($answers as $answer)
                <tr class="hover:bg-grey-lighter">
                <td class="py-4 px-6 border-b border-grey-light flex items-center">
                  <div class="w-1/12">
                       <img src="{{ asset('storage/profile_icon.png') }}" alt="プロフィール画像" class="w-16">
                  </div>
                  <div class="px-3 w-11/12">
                    <h3 class="text-left text-lg text-grey-dark">{{$answer->answer}}</h3>
                    
                    @if ($answer->image)
                    
                      <div class="flex flex-col items-center my-4">
                        <img src="../../uploads/{{ $answer->image }}" class="w-10/12 h-10/12">
                      </div>
                    @endif
                    
                    <div class="flex items-center">
                        @if ($answer->user_id === Auth::user()->id)
                         <p class="text-left text-red-600">自分の回答です</p>
                        @else
                        
                          @if ($answer->user->profile)
                           <p class="text-left text-grey-dark">投稿者：{{$answer->user->profile->nickname}}</p>
                           @else 
                           <p class="text-left text-grey-dark">投稿者：{{$answer->user->name}}</p>
                           @endif
                    
                        @endif
                        
                           <p class="ml-4 text-left text-grey-dark">{{$answer->created_at}}</p>

                        <!-- 🔽 条件分岐でログインしているユーザが投稿したpostのみ削除ボタンが表示される -->
                        @if ($answer->user_id === Auth::user()->id || $group->user_id === Auth::user()->id)
                        <!-- 削除ボタン -->
                        <form action="{{ route('answer.destroy',$answer->id) }}" method="POST" class="text-left">
                           @method('delete')
                           @csrf
                           <button type="submit" class="mr-2 ml-2 text-sm hover:bg-gray-200 hover:shadow-none text-white py-1 px-2 focus:outline-none focus:shadow-outline">
                             <svg class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="black">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                             </svg>
                           </button>
                        </form>
                        @endif
                        
                    </div>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        
            
            <a href="{{ route('group.room',$group->id) }}" class="block text-center w-full py-3 mt-12 font-medium tracking-widest text-white uppercase bg-blue-500 shadow-lg focus:outline-none hover:bg-blue-400 hover:shadow-none">
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

