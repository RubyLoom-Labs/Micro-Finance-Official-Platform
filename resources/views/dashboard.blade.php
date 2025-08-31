@extends('layouts.layout')


@section('contents')
    @if (Auth::user()->user_role->dashboard == 1)
        <div id="mainContent" class="flex lg:h-full">
            test
        </div>
    @endif
@endsection
