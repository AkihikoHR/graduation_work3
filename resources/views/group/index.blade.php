<!-- resources/views/group/index.blade.php -->

<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('活動中のグループ一覧') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-10/12 md:w-8/10 lg:w-8/12">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          <table class="text-center w-full border-collapse">
            <thead>
              <tr>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-lg text-grey-dark border-b border-grey-light">全ての活動中のグループ</th>
              </tr>
            </thead>
            
            <tbody>
              @foreach ($groups as $group)
              <tr class="hover:bg-grey-lighter">
                <td class="py-4 px-6 border-b border-grey-light flex items-center">

                  <div>
                     @if ($group->user_id === Auth::user()->id)
                     <p class="text-left text-red-600">管理しています</p>
                     @else
                     
                         @if ($group->user->profile)
                         <p class="text-left text-grey-dark">管理人：{{$group->user->profile->nickname}}</p>
                         @else 
                         <p class="text-left text-grey-dark">管理人：{{$group->user->name}}</p>
                         @endif
                     
                     @endif
                     <h3 class="text-left font-bold text-lg text-grey-dark">{{$group->name}}</h3>


                  </div>
                  
                  <div class="flex">
                     <!-- グループの詳細を見るボタン -->
                      <form class="ml-5" action="{{ route('group.show',$group->id) }}" method="GET" class="text-left">
                        @csrf
                         <button type="submit" class="ml-4 w-full bg-transparent hover:bg-orange-500 text-orange-700 font-semibold hover:text-white py-2 px-4 border border-orange-500 hover:border-transparent rounded">
                         詳細を見る
                         </button>
                      </form>
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

