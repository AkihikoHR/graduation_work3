<!-- resources/views/answer/reply.blade.php -->

<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('質問に回答する') }}
    </h2>
  </x-slot>
  
   <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          @include('common.errors')
          <h1 class="text-center py-6 px-6 bg-grey-lightest font-bold uppercase text-lg text-grey-dark">質問・出題に対する回答を入力してください</h1>
            <form class="mb-6" action="{{ route('answer.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
              <div class="flex flex-col mb-4">
                  <label class="mb-2 uppercase font-bold text-lg text-grey-darkest" for="answer">回答内容</label>
                  <textarea class="border py-2 px-3 text-grey-darkest" rows="5" type="text" name="answer" id="answer"></textarea>
              </div>
              <div class="flex flex-col mb-4">
                  <label class="mb-2 uppercase font-bold text-lg text-grey-darkest" for="image">画像を添付する</label>
                  <input class="border py-2 px-3 text-grey-darkest" type="file" name="image" id="image">
              </div>
              <div>
                  <input type="hidden" name="question_id" value="{{$question->id}}">
              </div>
              <button type="submit" class="w-full py-3 mt-6 font-medium tracking-widest text-white uppercase bg-blue-500 shadow-lg focus:outline-none hover:bg-blue-400 hover:shadow-none">
                  回答する
              </button>
          </form>
        </div>
      </div>
    </div>
  </div>
          
</x-app-layout>

