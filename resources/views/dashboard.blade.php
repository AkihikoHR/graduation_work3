<!-- resources/views/dashboard.blade.php -->

<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('ダッシュボード') }}
    </h2>
  </x-slot>
  
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-10/12 md:w-8/10 lg:w-8/12">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
  
       <table class="text-center w-full border-collapse">
            <thead>
              <tr>
                <th class="py-4 px-6 bg-stone-700 font-bold uppercase text-2xl text-white border-b border-grey-light">学習内容の振り返り</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($posts as $post)
              <tr class="hover:bg-grey-lighter">
                <td class="py-4 px-6 border-b border-grey-light flex items-center">
                
                  <div class="px-3 w-11/12">
                    <h3 class="text-left font-bold text-lg text-grey-dark">{{$post->post}}</h3>
                    <h3 class="text-left text-lg text-grey-dark">{{$post->description}}</h3>
                    <div class="flex items-center">
                        
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
                        
                        <form class="ml-5 mb-1" action="{{ route('post.show',$post->id) }}" method="GET" class="text-left">
                          @csrf
                           <button type="submit" class="ml-4 w-full bg-transparent hover:bg-orange-500 text-orange-700 font-semibold hover:text-white py-2 px-4 border border-orange-500 hover:border-transparent rounded">
                            もっと見る
                           </button>
                        </form>
                    </div>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          
             <table class="mt-28 text-center w-full border-collapse">
            <thead>
              <tr>
                <th class="py-4 px-6 bg-stone-700 font-bold text-2xl text-white border-b border-grey-light">自分がした質問一覧</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($questions as $question)
              <tr class="hover:bg-grey-lighter">
                <td class="py-4 px-6 border-b border-grey-light flex items-center">
               
                  <div class="px-3 w-11/12">
                    <h3 class="text-left font-bold text-lg text-grey-dark">{{$question->question}}</h3>
                    <h3 class="text-left text-lg text-grey-dark">{{$question->description}}</h3>
                    
                    <div class="flex items-center">
                        
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
                        
                         <form class="ml-5 mb-1" action="{{ route('question.show',$question->id) }}" method="GET" class="text-left">
                          @csrf
                           <button type="submit" class="ml-4 w-full bg-transparent hover:bg-orange-500 text-orange-700 font-semibold hover:text-white py-2 px-4 border border-orange-500 hover:border-transparent rounded">
                            もっと見る
                           </button>
                        </form>
                    </div>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
         
        </div>
      </div>
    </div>
  </div>
  
</x-app-layout>