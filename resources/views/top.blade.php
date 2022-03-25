        <x-guest-layout>
           <x-slot name="header">
             <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('TOP page') }}
             </h2>
           </x-slot>
          
 
            <div class="relative items-top justify-center min-h-screen bg-teal-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
                @if (Route::has('login'))
                    <div class="fixed top-0 right-0 px-6 py-4 sm:block">
                        @auth
                            <a href="{{ url('dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">ダッシュボード</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">ログイン</a>
    
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">ユーザー登録</a>
                            @endif
                        @endauth
                    </div>
                @endif
                
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:w-10/12 md:w-8/10 lg:w-8/12">
                      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                          <div class="text-center">
                            <h3 class="text-2xl font-bold leading-10">現在、{{$groups->count()}}組のグループが活動しています！</h3>
                            <p class="text-lg leading-10">○○は同じ目標を持った仲間と一緒に学ぶことができるコミュニティです</p>
                            <p class="text-lg leading-10">ユーザー登録して自分に合った学習グループを探してみましょう！</p>
                          </div>
  
                          <table class="mt-10 text-center w-full border-collapse">
                              <thead>
                              <tr>
                                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-lg text-grey-dark border-b border-grey-light">活動中のグループ一覧</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($groups as $group)
                              <tr class="hover:bg-grey-lighter">
                                <td class="py-4 px-6 border-b border-grey-light">
                                  <h3 class="text-left font-bold text-lg text-grey-dark">{{$group->name}}</h3>
                                </td>
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                
              </div>     
                
        </x-guest-layout>
 