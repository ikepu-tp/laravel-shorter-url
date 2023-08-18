@extends('ShorterUrl::layouts.main')
@section('content')
  <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
    リンク{{ $edit ? '変更' : '登録' }}
  </h2>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100 max-w-md">
          <form
            action="{{ $edit ? route('short-url.link.update', ['link' => $link['linkId']]) : route('short-url.link.store') }}"
            method="post">
            @csrf
            @if ($edit)
              @method('PUT')
            @endif
            <div class="mb-2">
              <label for="_link-linkId" class="block text-gray-700 text-sm font-bold mb-2">LinkId*</label>
              <div>10文字以内で入力してください。<br />※アルファベットと数字のみ使えます。</div>
              <div class="mt-1">
                {{ route('short-url.redirect') }}/
                <input type="text" name="linkId" id="_link-linkId" placeholder="linkId" required
                  value="{{ old('linkId', $link['linkId']) }}" maxlength="10"
                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <x-input-error class="mt-2" :messages="$errors->get('linkId')" />
              </div>
            </div>
            <div class="mb-2">
              <label for="_link-name" class="block text-gray-700 text-sm font-bold mb-2">登録名*</label>
              <input type="text" name="name" id="_link-name" placeholder="登録名" required
                value="{{ old('name', $link['name']) }}" maxlength="30"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
              <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>
            <div class="mb-4">
              <label for="_link" class="block text-gray-700 text-sm font-bold mb-2">リダイレクト先URL*</label>
              <input type="url" name="link" id="_link" placeholder="リダイレクト先URL" required
                value="{{ old('link', $link['link']) }}"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
              <x-input-error class="mt-2" :messages="$errors->get('link')" />
            </div>
            <button type="submit"
              class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
              {{ $edit ? '変更' : '登録' }}
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
