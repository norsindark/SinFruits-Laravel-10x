@extends('dashboard.layouts.master')


@section('content')

    <body class="g-sidenav-show  bg-gray-100">
        <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
            <div class="container-fluid py-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-4">

                            {{-- Notification --}}
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

                            {{-- title --}}
                            <div class="card-header pb-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6>Commnets Table
                                    </h6>
                                </div>
                            </div>


                            <div class="card-body px-0 pt-0 pb-2">
                                <div class="table-responsive p-0">
                                    @if ($comments && count($comments) > 0)
                                        <table class="table align-items-center mb-0">
                                            <thead>

                                                {{-- title menu --}}
                                                <tr>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                        ID
                                                    </th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                        User Email
                                                    </th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                        Created At
                                                    </th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                        Contents
                                                    </th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                        Status
                                                    </th>
                                                    <th
                                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Actions
                                                    </th>
                                                </tr>

                                            </thead>


                                            <tbody>
                                                @foreach ($comments as $item)
                                                    <tr>

                                                        {{-- id --}}
                                                        <td>{{ $item->id }}</td>

                                                        {{-- user email --}}
                                                        <td>{{ $item->user->email }}</td>

                                                        {{-- created at --}}
                                                        <td>{{ $item->created_at }}</td>

                                                        <td>
                                                            @if (strlen($item->comment) > 100)
                                                                <span data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="{{ $item->comment }}">
                                                                    {{ substr($item->comment, 0, 100) . '...' }}
                                                                </span>
                                                            @else
                                                                {{ $item->comment }}
                                                            @endif
                                                        </td>

                                                        {{-- status --}}
                                                        <td>{{ ['Allowed', 'Forbiddened', 'Unknown Status'][$item->status] }}
                                                        </td>

                                                        {{-- action --}}
                                                        <td class="text-center">

                                                            @if ($item->status != 1)
                                                                {{-- Remove --}}
                                                                <a href="javascript:;"
                                                                    class="btn btn-link text-danger text-gradient px-3 mb-0 confirm-action"
                                                                    data-action="Remove" data-id="{{ $item->id }}">
                                                                    <i class="far fa-trash-alt me-2"></i>Remove
                                                                </a>
                                                                {{-- form submit --}}
                                                                <form id="confirmForm{{ $item->id }}"
                                                                    action="{{ route('dashboard.comments.confirm', $item->id) }}"
                                                                    method="POST" style="display: none;">
                                                                    @csrf
                                                                    <input type="hidden" name="action"
                                                                        id="confirmAction{{ $item->id }}">
                                                                </form>
                                                            @else
                                                                <i class="fas fa-ban me-2"></i>Forbiddened
                                                            @endif


                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <p>No Report found.</p>
                                    @endif

                                    {{-- pagination --}}
                                    <div style="padding: 0px 120px;">
                                        {{ $comments->links('vendor.pagination.bootstrap-5') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                {{-- footer --}}
                @include('dashboard.layouts.footer')


            </div>
        </div>

        {{-- submit remove comment --}}
        {{-- submit form udpate status --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('.confirm-action').forEach(function(btn) {
                    btn.addEventListener('click', function(event) {
                        event.preventDefault();
                        var commentId = this.getAttribute('data-id');
                        var action = this.getAttribute('data-action');

                        if (confirm('Are you sure you want to ' + action +
                                ' for this comments?')) {
                            document.getElementById('confirmAction' + commentId).value = action;
                            document.getElementById('confirmForm' + commentId).submit();
                        }
                    });
                });
            });
        </script>

    </body>
@endsection
