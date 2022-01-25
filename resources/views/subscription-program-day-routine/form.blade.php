<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('subscription_programs_id') }}
            {{ Form::text('subscription_programs_id', $subscriptionProgramDayRoutine->subscription_programs_id, ['class' => 'form-control' . ($errors->has('subscription_programs_id') ? ' is-invalid' : ''), 'placeholder' => 'Subscription Programs Id']) }}
            {!! $errors->first('subscription_programs_id', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('program_days_id') }}
            {{ Form::text('program_days_id', $subscriptionProgramDayRoutine->program_days_id, ['class' => 'form-control' . ($errors->has('program_days_id') ? ' is-invalid' : ''), 'placeholder' => 'Program Days Id']) }}
            {!! $errors->first('program_days_id', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('user_id') }}
            {{ Form::text('user_id', $subscriptionProgramDayRoutine->user_id, ['class' => 'form-control' . ($errors->has('user_id') ? ' is-invalid' : ''), 'placeholder' => 'User Id']) }}
            {!! $errors->first('user_id', '<div class="invalid-feedback">:message</p>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>