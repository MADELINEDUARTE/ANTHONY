<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('program_id') }}
            {{-- Form::text('program_id', $programDay->program_id, ['class' => 'form-control' . ($errors->has('program_id') ? ' is-invalid' : ''), 'placeholder' => 'Program Id']) --}}
            <select class="form-control" wire:model="program_id" name="program_id" id="program_id" required>
            <option value="">Select Program</option>
                @foreach ($programs as $program)
                <option value="{{ $program->id }}" {{ $programDay->program_id == $program->id ? "selected" : "" }}>{{ $program->name }}</option>
                @endforeach
            </select>
            {!! $errors->first('program_id', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('name') }}
            {{ Form::text('name', $programDay->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('number') }}
            {{ Form::text('number', $programDay->number, ['class' => 'form-control' . ($errors->has('number') ? ' is-invalid' : ''), 'placeholder' => 'Number']) }}
            {!! $errors->first('number', '<div class="invalid-feedback">:message</p>') !!}
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