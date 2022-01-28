<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('description') }}
            {{ Form::text('description', $exerciseLog->description, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Description']) }}
            {!! $errors->first('description', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('start') }}
            {{ Form::date('start', $exerciseLog->start, ['class' => 'form-control' . ($errors->has('start') ? ' is-invalid' : ''), 'placeholder' => 'Start']) }}
            {!! $errors->first('start', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('finish') }}
            {{ Form::date('finish', $exerciseLog->finish, ['class' => 'form-control' . ($errors->has('finish') ? ' is-invalid' : ''), 'placeholder' => 'Finish']) }}
            {!! $errors->first('finish', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('exercise_id') }}
            {{-- Form::text('exercise_id', $exerciseLog->exercise_id, ['class' => 'form-control' . ($errors->has('exercise_id') ? ' is-invalid' : ''), 'placeholder' => 'Exercise Id']) --}}
            <select class="form-control" wire:model="exercise_id" name="exercise_id" id="exercise_id" required>
            <option value="">Select Exercise</option>
                @foreach ($exercises as $exercise)
                <option value="{{ $exercise->id }}" {{ $exerciseLog->exercise_id == $exercise->id ? "selected" : "" }}>{{ $exercise->description }}</option>
                @endforeach
            </select>
            {!! $errors->first('exercise_id', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
        {{ Form::label('user_id') }}
            {{ Auth::user()->name }}
            {{ Form::hidden('user_id', Auth::user()->id, ['class' => 'form-control' . ($errors->has('user_id') ? ' is-invalid' : ''), 'placeholder' => 'User Id']) }}
            {!! $errors->first('user_id', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('status_id') }}
            {{-- Form::text('status_id', $exerciseLog->status_id, ['class' => 'form-control' . ($errors->has('status_id') ? ' is-invalid' : ''), 'placeholder' => 'Status Id']) --}}
            <select class="form-control" wire:model="status_id" name="status_id" id="status_id" required>
            <option value="">Select Status</option>
                @foreach ($statuses as $status)
                <option value="{{ $status->id }}" {{ $exerciseLog->status_id == $status->id ? "selected" : "" }}>{{ $status->description }}</option>
                @endforeach
            </select>
            {!! $errors->first('status_id', '<div class="invalid-feedback">:message</p>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>