<link rel="stylesheet" href="{{URL::asset('css/app.css')}}">
<style>

    .pageContainer {
        padding: 20px;
        text-align: center;
    }

    table {
        border-top: 1px solid gray;
        border-left: 1px solid gray;
        margin-top: 20px;
    }

    table thead {
        background: whitesmoke;
    }

    table td {
        border-bottom: 1px solid gray;
        border-right: 1px solid gray;
        padding: 5px 10px;
    }
</style>

<div class="pageContainer">
    <div class="container" align="center">
        <h1>用户表</h1>
        <table>
            <thead>
            <tr>
                <td>id</td>
                <td>firstname</td>
                <td>lastname</td>
                <td>email</td>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr>
                    <td> {{ $user->id }}</td>
                    <td> {{ $user->firstname }}</td>
                    <td> {{ $user->lastname }}</td>
                    <td> {{ $user->email }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    {{ $users->links() }}
</div>
