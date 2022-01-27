<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('subscription_programs_id') }}
            {{-- Form::text('subscription_programs_id', $subscriptionProgramDayRoutine->subscription_programs_id, ['class' => 'form-control' . ($errors->has('subscription_programs_id') ? ' is-invalid' : ''), 'placeholder' => 'Subscription Programs Id']) --}}
            <select class="form-control" wire:model="subscription_programs_id" name="subscription_programs_id" id="subscription_programs_id" required>
            <option value="">Select Subscription Program</option>
                @foreach ($subscriptionprograms as $subscriptionprogram)
                <option value="{{ $subscriptionprogram->id }}" {{ $subscriptionProgramDayRoutine->subscription_programs_id == $subscriptionprogram->id ? "selected" : "" }}>{{ $subscriptionprogram->id }}</option>
                @endforeach
            </select>
            {!! $errors->first('subscription_programs_id', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('program_days_id') }}
            {{-- Form::text('program_days_id', $subscriptionProgramDayRoutine->program_days_id, ['class' => 'form-control' . ($errors->has('program_days_id') ? ' is-invalid' : ''), 'placeholder' => 'Program Days Id']) --}}
            <select class="form-control" wire:model="program_days_id" name="program_days_id" id="program_days_id" required>
            <option value="">Select Program Day</option>
                @foreach ($programdays as $programday)
                <option value="{{ $programday->id }}" {{ $subscriptionProgramDayRoutine->program_days_id == $programday->id ? "selected" : "" }}>{{ $programday->name }}</option>
                @endforeach
            </select>
            {!! $errors->first('program_days_id', '<div class="invalid-feedback">:message</p>') !!}
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