@extends('admin.layouts.master')

@section('title')

@endsection

@section('css')

@endsection

@section('title_page1')

@endsection

@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Contact Messages</h3>

                ```
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
                        <div class="text-tiny">Contact Messages</div>
                    </li>
                </ul>
            </div>

            <div class="wg-box">

                <div class="flex items-center justify-between gap10 flex-wrap">
                    <div class="wg-filter flex-grow">
                        <form class="form-search">
                            <fieldset class="name">
                                <input type="text" placeholder="Search here..." class="" name="name" tabindex="2" value=""
                                    aria-required="true" required="">
                            </fieldset>

                            <div class="button-submit">
                                <button class="" type="submit">
                                    <i class="icon-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="wg-table table-all-user">
                    <div class="table-responsive">

                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Comment</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($contacts as $contact)
                                    <tr>
                                        <td>{{ $contact->id }}</td>

                                        <td>
                                            {{ $contact->name }}
                                        </td>

                                        <td>
                                            {{ $contact->email }}
                                        </td>

                                        <td>
                                            {{ $contact->phone }}
                                        </td>

                                        <td>
                                            {{ $contact->comment }}
                                        </td>

                                        <td>
                                            {{ $contact->created_at->format('Y-m-d') }}
                                        </td>

                                        <td>
                                            <div class="list-icon-function">

                                                {{-- View --}} <a href="{{ route('admin.contact.show', $contact->id) }}"
                                                    class="item text-info"> <i class="icon-eye"></i> </a>

                                                {{-- Delete --}}
                                                <form action="{{ route('admin.contact.destroy', $contact->id) }}" method="POST"
                                                    onsubmit="return confirm('Are you sure you want to delete this message?')">
                                                    @csrf @method('DELETE')

                                                    <button type="submit" class="item text-danger">
                                                        <i class="icon-trash-2"></i>
                                                    </button>

                                                </form>

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>

                    </div>

                    <div class="divider"></div>

                    <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
                        {{ $contacts->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
    ```

@endsection

@section('scripts')

@endsection