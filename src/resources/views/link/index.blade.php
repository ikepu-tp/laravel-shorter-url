@extends('ShorterUrl::layouts.main')
@section('content')
  <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
    リンク一覧
  </h2>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">

          @if (session('message'))
            <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 mb-5 rounded relative" role="alert">
              <span class="block sm:inline">{{ session('message') }}</span>
            </div>
          @endisset

          <a href="{{ route('short-url.link.create') }}" class="underline mb-3 text-blue-500">リンクの登録</a>
          <table class="w-full mt-3">
            <thead>
              <tr>
                <th class="border px-3 py-2">登録名</th>
                <th class="border px-3 py-2">アクセス数</th>
                <th class="border px-3 py-2">
                  リンク
                </th>
                <th class="border px-3 py-2">リダイレクト先</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($links as $link)
                <tr>
                  <td class="border px-3 py-2 w-fit">
                    <a href="{{ route('short-url.link.edit', ['link' => $link->linkId]) }}"
                      class="underline mb-3 text-blue-500">{{ $link->name }}</a>
                  </td>
                  <td class="border px-3 py-2 text-center w-fit">
                    <a href="{{ route('short-url.link.access.index', ['link' => $link->linkId]) }}"
                      class="underline mb-3 text-blue-500">{{ number_format($link->accesses_count) }}</a>
                  </td>
                  <td class="border px-3 py-2 w-fit">
                    <input type="text"
                      value="{{ route('short-url.redirect', ['link' => $link->linkId, 'referer' => '']) }}"
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                      readonly>
                  </td>
                  <td class="border px-3 py-2">
                    <input type="text" value="{{ $link->link }}"
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                      readonly>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          <div>
            リンク末尾に<code class="text-red-400">?referer=[任意の文字]</code>をつければリファラ別に集計が可能です。
            <br>
            例）{{ route('short-url.redirect', ['link' => 'linkId', 'referer' => 'referer']) }}
          </div>
      </div>
    </div>
  </div>
@endsection
