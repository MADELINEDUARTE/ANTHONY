<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('title') }}
            {{ Form::text('title', $programDayRoutine->title, ['class' => 'form-control' . ($errors->has('title') ? ' is-invalid' : ''), 'placeholder' => 'Title']) }}
            {!! $errors->first('title', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('video') }}
            {{ Form::text('video', $programDayRoutine->video, ['class' => 'form-control' . ($errors->has('video') ? ' is-invalid' : ''), 'placeholder' => 'Video']) }}
            {!! $errors->first('video', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('sets') }}
            {{ Form::text('sets', $programDayRoutine->sets, ['class' => 'form-control' . ($errors->has('sets') ? ' is-invalid' : ''), 'placeholder' => 'Sets']) }}
            {!! $errors->first('sets', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('repetitions') }}
            {{ Form::text('repetitions', $programDayRoutine->repetitions, ['class' => 'form-control' . ($errors->has('repetitions') ? ' is-invalid' : ''), 'placeholder' => 'Repetitions']) }}
            {!! $errors->first('repetitions', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('program_day_id') }}
            {{-- Form::text('program_day_id', $programDayRoutine->program_day_id, ['class' => 'form-control' . ($errors->has('program_day_id') ? ' is-invalid' : ''), 'placeholder' => 'Program Day Id']) --}}
            <select class="form-control" wire:model="program_day_id" name="program_day_id" id="program_day_id" required>
            <option value="">Select Program Day</option>
                @foreach ($programdays as $programday)
                <option value="{{ $programday->id }}" {{ $programDayRoutine->program_day_id == $programday->id ? "selected" : "" }}>{{ $programday->name }}</option>
                @endforeach
            </select>
            {!! $errors->first('program_day_id', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('status_id') }}
            {{-- Form::text('status_id', $programDayRoutine->status_id, ['class' => 'form-control' . ($errors->has('status_id') ? ' is-invalid' : ''), 'placeholder' => 'Status Id']) --}}
            <select class="form-control" wire:model="status_id" name="status_id" id="status_id" required>
            <option value="">Select Status</option>
                @foreach ($statuses as $status)
                <option value="{{ $status->id }}" {{ $programDayRoutine->status_id == $status->id ? "selected" : "" }}>{{ $status->description }}</option>
                @endforeach
            </select>
            {!! $errors->first('status_id', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('user_id') }}
            {{ Auth::user()->name }}
            {{ Form::hidden('user_id', Auth::user()->id, ['class' => 'form-control' . ($errors->has('user_id') ? ' is-invalid' : ''), 'placeholder' => 'User Id']) }}
            {!! $errors->first('user_id', '<div class="invalid-feedback">:message</p>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>