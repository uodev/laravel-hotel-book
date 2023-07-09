@extends("layouts.admin.admin")
@section("content")
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>User Page</h1>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                    <tr>
                        <th scope="row">{{$user->id}}</th>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
