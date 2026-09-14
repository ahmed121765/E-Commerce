@extends('admin.layouts.master')

@section('title')
    Message
@endsection

@section('css')

@endsection

@section('title_page1')

@endsection

@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">

            ```
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Message Details</h3>

                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="{{ route('home.admin') }}" class="text-tiny">
                            <div class="text-tiny">Dashboard</div>
                        </a>
                    </li>

                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>

                    <li>
                        <a href="{{ route('admin.contact.index') }}" class="text-tiny">
                            <div class="text-tiny">Messages</div>
                        </a>
                    </li>

                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>

                    <li>
                        <div class="text-tiny">Message Details</div>
                    </li>
                </ul>
            </div>

            <div class="wg-box">

                <div class="mb-20">
                    <h4>Contact Message</h4>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-bordered">

                        <tr>
                            <th width="200">ID</th>
                            <td>{{ $contact->id }}</td>
                        </tr>

                        <tr>
                            <th>Name</th>
                            <td>{{ $contact->name }}</td>
                        </tr>

                        <tr>
                            <th>Email</th>
                            <td>{{ $contact->email }}</td>
                        </tr>

                        <tr>
                            <th>Phone</th>
                            <td>{{ $contact->phone }}</td>
                        </tr>

                        <tr>
                            <th>Message</th>
                            <td style="white-space: normal;">
                                {{ $contact->comment }}
                            </td>
                        </tr>

                        <tr>
                            <th>Date</th>
                            <td>{{ $contact->created_at->format('Y-m-d H:i') }}</td>
                        </tr>

                    </table>
                </div>

                <div class="mt-20">
                    <a href="{{ route('admin.contact.index') }}" class="tf-button">
                        Back to Messages
                    </a>
                </div>

            </div>

        </div>
    </div>
    ```

@endsection

@section('scripts')

@endsection