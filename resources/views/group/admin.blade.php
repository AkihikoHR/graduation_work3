<!-- resources/views/group/admin.blade.php -->

<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('グループ管理') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-10/12 md:w-8/10 lg:w-8/12">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          <table class="text-center w-full border-collapse">
            <thead>
              <tr>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-lg text-grey-dark border-b border-grey-light">管理しているグループ一覧</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($groups as $group)
              <tr class="hover:bg-grey-lighter">
                <td class="py-4 px-6 border-b border-grey-light flex items-center">
                  <h3 class="text-left font-bold text-lg text-grey-dark">{{$group->name}}</h3>

                  <div class="flex">
                     <!-- グループの詳細を見るボタン -->
                      <form class="ml-5" action="{{ route('group.show',$group->id) }}" method="GET" class="text-left">
                        @csrf
                         <button type="submit" class="ml-4 w-full bg-transparent hover:bg-orange-500 text-orange-700 font-semibold hover:text-white py-2 px-4 border border-orange-500 hover:border-transparent rounded">
                           @if ($group->user_id === Auth::user()->id)
                            管理画面
                           @else
                            詳細を見る
                           @endif
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

