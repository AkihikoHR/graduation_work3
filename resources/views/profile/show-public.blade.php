<!-- resources/views/profile/show-public.blade.php -->

<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('公開プロフィール') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200 flex">
          <div class="ml-5 w-1/4">
            <img src="{{ asset('storage/profile_icon.png') }}" alt="プロフィール画像">
          </div>
          <div class="mb-6 ml-20">
            <div class="flex flex-col mb-4">
              <div class="flex">
                <p class="uppercase font-bold text-lg text-grey-darkest">ニックネーム</p>
                <p class="ml-5 px-3 text-grey-darkest" id="nickname">
                  @if($profile == null || $profile->nickname == '')未設定
                  @else {{$profile->nickname}}
                  @endif
                </p>
              </div>
            </div>
            <div class="flex flex-col mb-4">
              <div class="flex">
                <p class="uppercase font-bold text-lg text-grey-darkest">学年</p>
                <p class="ml-5 px-3 text-grey-darkest" id="grade">
                  @if($profile == null || $profile->grade == '')
                  未設定
                  @else{{$profile->grade}}
                  @endif
                </p>
              </div>
            </div>
            <div class="flex flex-col mb-4">
              <div class="flex">
                <p class="uppercase font-bold text-lg text-grey-darkest">都道府県</p>
                <p class="ml-5 px-3 text-grey-darkest" id="grade">
                  @if($profile == null || $profile->pref == '')
                  未設定
                  @else {{$profile->pref}}
                  @endif
                </p>
              </div>
            </div>
            

          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>

