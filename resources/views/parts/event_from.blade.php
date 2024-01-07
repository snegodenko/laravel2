

<form action="{{ url()->current() }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="" class="form-label">Event title</label>
        <input type="text" class="form-control" name="title" value="@isset($event->title) {{ $event->title }} @endisset">
        @error('title')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Event description</label>
        <input type="text" class="form-control" name="description" value="@isset($event->description) {{ $event->description }} @endisset">
        @error('description')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Start</label>
        <input type="date" class="form-control" name="dt_start" value="@isset($event->dt_start){{ date('d.m.Y', strtotime($event->dt_start)) }}@endisset">
        @error('dt_start')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="" class="form-label">End</label>
        <input type="date" class="form-control" name="dt_end" value="@isset($event->dt_end) {{ $event->dt_end }} @endisset">
        @error('dt_end')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    @if($users->isNotEmpty())
        <div class="mb-3">
            <label for="" class="form-label">Users</label>
            <select class="form-select" name="user_id">
                <option value="">Select user</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" <?= (isset($event->user->id) && $event->user->id == $user->id) ? 'selected' : null; ?>>{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
    @endif
    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
