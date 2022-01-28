<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('video') }}
            {{ Form::text('video', $exerciseVideo->video, ['class' => 'form-control' . ($errors->has('video') ? ' is-invalid' : ''), 'placeholder' => 'Video']) }}
            {!! $errors->first('video', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('exercise_id') }}
            {{-- Form::text('exercise_id', $exerciseVideo->exercise_id, ['class' => 'form-control' . ($errors->has('exercise_id') ? ' is-invalid' : ''), 'placeholder' => 'Exercise Id']) --}}
            <select class="form-control" wire:model="exercise_id" name="exercise_id" id="exercise_id" required>
            <option value="">Select Exercise</option>
                @foreach ($exercises as $exercise)
                <option value="{{ $exercise->id }}" {{ $exerciseVideo->exercise_id == $exercise->id ? "selected" : "" }}>{{ $exercise->description }}</option>
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

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>