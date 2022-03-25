<!-- resources/views/group/room.blade.php -->

<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
       @if ($group->user_id === Auth::user()->id)
           {{$group->name}}{{__('の部屋') }}<span class="text-red-600">（管理しています）</span>
       @else
           {{$group->name}}{{__('の部屋') }}
       @endif
     
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-10/12 md:w-8/10 lg:w-8/12">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
         
           <table class="text-center w-full border-collapse">
            <thead>
              <tr>
                <th class="py-4 px-6 bg-stone-700 font-bold uppercase text-2xl text-white border-b border-grey-light">今日の学びをメンバーに報告する</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($posts as $post)
              <tr class="hover:bg-grey-lighter">
                <td class="py-4 px-6 border-b border-grey-light flex items-center">
                  <div class="w-1/12">
                       <img src="{{ asset('storage/profile_icon.png') }}" alt="プロフィール画像" class="w-16">
                  </div>
                  <div class="px-3 w-11/12">
                    <h3 class="text-left font-bold text-lg text-grey-dark">{{$post->post}}</h3>
                    <h3 class="text-left text-lg text-grey-dark">{{$post->description}}</h3>
                    
                    <div class="flex items-center">
                        @if ($post->user_id === Auth::user()->id)
                         <p class="text-left text-red-600">あなたの投稿です</p>
                        @else
                         <p class="text-left text-grey-dark">投稿者：{{$post->user->name}}</p>
                        @endif
                        
                         <p class="ml-4 text-left text-grey-dark">{{$post->created_at}}</p>


                        <!-- 🔽 条件分岐でログインしているユーザが投稿したpostのみ削除ボタンが表示される -->
                        @if ($post->user_id === Auth::user()->id || $group->user_id === Auth::user()->id)
                        <!-- 削除ボタン -->
                        <form action="{{ route('post.destroy',$post->id) }}" method="POST" class="text-left">
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
     
          <div class="mt-5 bg-white max-w-7xl mx-auto sm:w-10/12 md:w-8/12 lg:w-6/12">
          @include('common.errors')
            <h1 class="text-center py-6 px-6 bg-grey-lightest font-bold uppercase text-lg text-grey-dark">今日学んだことや共有したい情報を投稿してください</h1>
            <form class="mb-6" action="{{ route('post.store') }}" method="POST">
              @csrf
              <div class="flex flex-col mb-4">
                  <label class="mb-2 uppercase font-bold text-lg text-grey-darkest" for="post">学んだテーマ／カテゴリー</label>
                  <input class="border py-2 px-3 text-grey-darkest" type="text" name="post" id="post">
              </div>
              <div class="flex flex-col mb-4">
                  <label class="mb-2 uppercase font-bold text-lg text-grey-darkest" for="description">学習内容</label>
                  <textarea class="border py-2 px-3 text-grey-darkest" rows="5" type="text" name="description" id="description"></textarea>
              </div>
              <div>
                  <input type="hidden" name="group_id" value="{{$group->id}}">
              </div>
              <button type="submit" class="w-full py-3 mt-6 font-medium tracking-widest text-white uppercase bg-blue-500 shadow-lg focus:outline-none hover:bg-blue-400 hover:shadow-none">
                  報告する
              </button>
            </form>
          </div>


          
           <table class="mt-28 text-center w-full border-collapse">
            <thead>
              <tr>
                <th class="py-4 px-6 bg-stone-700 font-bold text-2xl text-white border-b border-grey-light">メンバーに質問 or 出題する</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($questions as $question)
              <tr class="hover:bg-grey-lighter">
                <td class="py-4 px-6 border-b border-grey-light flex items-center">
                  <div class="w-1/12">
                       <img src="{{ asset('storage/profile_icon.png') }}" alt="プロフィール画像" class="w-16">
                  </div>
                  <div class="px-3 w-11/12">
                    <h3 class="text-left font-bold text-lg text-grey-dark">{{$question->question}}</h3>
                    <h3 class="text-left text-lg text-grey-dark">{{$question->description}}</h3>
                    
                    <div class="flex items-center">
                        @if ($question->user_id === Auth::user()->id)
                         <p class="text-left text-red-600">あなたの投稿です</p>
                        @else
                         <p class="text-left text-grey-dark">投稿者：{{$question->user->name}}</p>
                        @endif
                        
                           <p class="ml-4 text-left text-grey-dark">{{$question->created_at}}</p>

                        <!-- 🔽 条件分岐でログインしているユーザが投稿したpostのみ削除ボタンが表示される -->
                        @if ($question->user_id === Auth::user()->id || $group->user_id === Auth::user()->id)
                        <!-- 削除ボタン -->
                        <form action="{{ route('question.destroy',$question->id) }}" method="POST" class="text-left">
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
     
          <div class="mt-5 bg-white max-w-7xl mx-auto sm:w-10/12 md:w-8/12 lg:w-6/12">
          @include('common.errors')
              <h1 class="text-center py-6 px-6 bg-grey-lightest font-bold uppercase text-lg text-grey-dark">メンバーへの質問や出題を入力してください</h1>
              <form class="mb-6" action="{{ route('question.store') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="flex flex-col mb-4">
                      <label class="mb-2 uppercase font-bold text-lg text-grey-darkest" for="question">質問するテーマ／カテゴリー</label>
                      <input class="border py-2 px-3 text-grey-darkest" type="text" name="question" id="question">
                  </div>
                  <div class="flex flex-col mb-4">
                      <label class="mb-2 uppercase font-bold text-lg text-grey-darkest" for="description">質問内容</label>
                      <textarea class="border py-2 px-3 text-grey-darkest" rows="5" type="text" name="description" id="description"></textarea>
                  </div>
                  <div class="flex flex-col mb-4">
                      <label class="mb-2 uppercase font-bold text-lg text-grey-darkest" for="image">画像を添付する</label>
                      <input class="border py-2 px-3 text-grey-darkest" type="file" name="image" id="image">
                  </div>
                  <div>
                      <input type="hidden" name="group_id" value="{{$group->id}}">
                  </div>
                  <button type="submit" class="w-full py-3 mt-6 font-medium tracking-widest text-white uppercase bg-blue-500 shadow-lg focus:outline-none hover:bg-blue-400 hover:shadow-none">
                      質問／出題する
                  </button>
              </form>
          </div>
          
            
          <div class="my-20 border-t border-grey-light">
            <a href="{{ route('group.show',$group->id) }}" class="block text-center max-w-7xl mx-auto sm:w-10/12 md:w-8/12 lg:w-6/12 py-3 mt-6 font-medium tracking-widest text-white uppercase bg-orange-500 shadow-lg focus:outline-none hover:bg-orange-400 hover:shadow-none">
              グループの詳細
            </a>
            <a href="{{ route('group.mygroup') }}" class="block text-center max-w-7xl mx-auto sm:w-10/12 md:w-8/12 lg:w-6/12 py-3 mt-6 font-medium tracking-widest text-white uppercase bg-black shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
              Back
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
