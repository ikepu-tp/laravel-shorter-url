@extends('ShorterUrl::layouts.main')
@section('content')
  <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
    アクセス数
  </h2>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">

          <h2 class="text-2xl">リンク詳細</h2>
          <table class="table-fixed w-full mt-3">
            <tbody>
              <tr>
                <th class="border px-3 py-2">登録名</th>
                <td class="border px-3 py-2">{{ $link->name }}</td>
              </tr>
              <tr>
                <th class="border px-3 py-2">リンク</th>
                <td class="border px-3 py-2">
                  <input type="text" value="{{ route('short-url.redirect', ['link' => $link->linkId]) }}"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    readonly>
                </td>
              </tr>
              <tr>
                <th class="border px-3 py-2">リダイレクト先</th>
                <td class="border px-3 py-2">
                  <input type="text" value="{{ $link->link }}"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    readonly>
                </td>
              </tr>
            </tbody>
          </table>

          <h2 class="text-2xl mt-6">アクセス数</h2>
          <table class="table-fixed w-full mt-3">
            <tbody>
              <tr>
                <th class="border px-3 py-2">合計</th>
                <td class="border px-3 py-2">
                  {{ number_format($summary['total']) }}
                </td>
              </tr>
              <tr>
                <th class="border px-3 py-2">デバイス別</th>
                <td class="border px-3 py-2">
                  @foreach ($summary['devices'] as $device => $cnt)
                    <div class="mb-1">
                      {{ $device }}: {{ number_format($cnt) }}
                    </div>
                  @endforeach
                </td>
              </tr>
              <tr>
                <th class="border px-3 py-2">リファラ別</th>
                <td class="border px-3 py-2">
                  @foreach ($summary['referers'] as $referer => $cnt)
                    <div class="mb-1">
                      {{ $referer }}: {{ number_format($cnt) }}
                    </div>
                  @endforeach
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
