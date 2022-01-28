<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('subscription_program_day_routine_id') }}
            {{-- Form::text('subscription_program_day_routine_id', $routineLog->subscription_program_day_routine_id, ['class' => 'form-control' . ($errors->has('subscription_program_day_routine_id') ? ' is-invalid' : ''), 'placeholder' => 'Subscription Program Day Routine Id']) --}}
            <select class="form-control" wire:model="subscription_program_day_routine_id" name="subscription_program_day_routine_id" id="subscription_program_day_routine_id" required>
            <option value="">Select Subscription Program Day Routine</option>
                @foreach ($subscriptionprogramdayroutines as $subscriptionprogramdayroutine)
                <option value="{{ $subscriptionprogramdayroutine->id }}" {{ $routineLog->subscription_program_day_routine_id == $subscriptionprogramdayroutine->id ? "selected" : "" }}>{{ $subscriptionprogramdayroutine->id }}</option>
                @endforeach
            </select>
            {!! $errors->first('subscription_program_day_routine_id', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('repetitions') }}
            {{ Form::text('repetitions', $routineLog->repetitions, ['class' => 'form-control' . ($errors->has('repetitions') ? ' is-invalid' : ''), 'placeholder' => 'Repetitions']) }}
            {!! $errors->first('repetitions', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('weight') }}
            {{ Form::text('weight', $routineLog->weight, ['class' => 'form-control' . ($errors->has('weight') ? ' is-invalid' : ''), 'placeholder' => 'Weight']) }}
            {!! $errors->first('weight', '<div class="invalid-feedback">:message</p>') !!}
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