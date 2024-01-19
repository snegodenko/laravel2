
<form action="{{ url()->current() }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="" class="form-label">User name</label>
        <input type="text" class="form-control" name="name" value="@isset($user->name){{ $user->name }} @endisset">
        @error('name')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="" class="form-label">User email</label>
        <input type="text" class="form-control" name="email" value="@isset($user->email){{ $user->email }} @endisset">
                    @error('email')
                    <div class="text-danger">{{ $message }}</div>
    @enderror
    </div>

    @if($request->is('user/create'))
    <div class="mb-3">
        <label for="" class="form-label">Password</label>
        <input type="text" class="form-control" name="password">
        @error('password')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    @endif

    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>


@if($request->is('user/update/*'))
    <h3 class="mt-5">Update Password</h3>
    <form action="{{ route('user.update-password', ['id' => $user->id]) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="" class="form-label">Password</label>
            <input type="text" class="form-control" name="password" value="">
            @error('password')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">New Password</label>
            <input type="text" class="form-control" name="new-password" value="">
            @error('new-password')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Confirm Password</label>
            <input type="text" class="form-control" name="confirm-password" value="">
            @error('confirm-password')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>

            @if($request->session()->has('password'))
            <div class="flash text-success mb-5">
                {{ $request->session()->get('password') }}
            </div>
            @endif

    </form>
@endif
