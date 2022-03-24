<!-- resources/views/group/show-joined.blade.php -->

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
            <table class="text-center w-full border-collapse">
              <thead>
                <tr>
                  <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-lg text-grey-dark border-b border-grey-light">
                    グループメンバー（{{ $group->users()->count() }}人）
                  </th>
                </tr>
              </thead>
              <tbody>
                @foreach ($members as $member)
                <tr class="hover:bg-grey-lighter">
                  <td class="py-4 px-6 border-b border-grey-light flex items-center">
                    
                    <div class="ml-2 w-16">
                       <img src="{{ asset('storage/profile_icon.png') }}" alt="プロフィール画像">
                    </div>
                    
                    <div>
                      @if ($member->profile)
                        <h3 class="ml-5 text-left text-lg text-grey-dark">{{$member->profile->nickname}}</p>
                      @else 
                        <h3 class="ml-5 text-left text-lg text-grey-dark">{{$member->name}}</p>
                      @endif
                    </div>

                    @if ($member->id !== Auth::user()->id)
                    <div class="flex">
                      <!-- プロフィールボタン -->
                       <form action="{{ route('profile.show', $member->id) }}" method="GET" class="text-left">
                          @csrf
                          <button type="submit" class="ml-5 w-full bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                               プロフィール
                          </button>
                        </form>
                    @endif
                    @if ($group->user_id === Auth::user()->id && $member->id !== Auth::user()->id)
                       <!-- 退会させるボタン -->
                       <form action="{{ route('bye',$group) }}" method="POST" class="text-left">
                          @csrf
                          <input type="hidden" name="member" value="{{$member->id}}">
                          <button type="submit" class="ml-10 w-full bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded">
                               退会させる
                          </button>
                        </form>
                    </div>
                    @endif
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            
             @if ($group->user_id === Auth::user()->id)
                <!-- 管理者のみ更新ボタン -->
                <div class="mt-5 flex justify-evenly">
                  <form action="{{ route('group.edit',$group->id) }}" method="GET" class="text-left">
                    @csrf
                    <button type="submit" class="my-5 w-full bg-transparent hover:bg-orange-500 text-orange-700 font-semibold hover:text-white py-2 px-4 border border-orange-500 hover:border-transparent rounded">
                         グループの情報を更新する
                    </button>
                  </form>
                  <!-- 管理者のみ削除ボタン -->
                   <form action="{{ route('group.destroy',$group->id) }}" method="POST" class="text-left">
                    @method('delete')
                    @csrf
                    <button type="submit" class="my-5 w-full bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded">
                         グループを削除する
                    </button>
                  </form>
                </div>
              @else
                <div class="flex justify-evenly">
                  <!-- 参加者のみ退会ボタン -->
                   <form action="{{ route('exit',$group) }}" method="GET" class="text-left">
                    @method('delete')
                    @csrf
                    <button type="submit" class="my-5 w-full bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded">
                         グループを抜ける
                    </button>
                  </form>
                </div>
              @endif
            
            
            <p class="mt-10 w-full text-center bg-blue-500 text-white font-semibold py-2 px-4 border border-blue-500 rounded">
                参加しています
            </p>
            
            <a href="{{ route('group.index') }}" class="block text-center w-full py-3 mt-6 font-medium tracking-widest text-white uppercase bg-black shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
              グループ一覧へ
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>

