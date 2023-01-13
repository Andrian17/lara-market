@extends('template.template')
@section('content')
    <!-- Content Start -->
<div class="content">
    {{-- navbar start --}}
    @include('components.navbar')
    {{-- navbar end --}}

    @yield('main')

    {{-- footer start --}}
    @include('components.footer')
    {{-- footer end --}}


</div>
<!-- Content End -->

@endsection

