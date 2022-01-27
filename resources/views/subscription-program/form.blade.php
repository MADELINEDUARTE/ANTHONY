<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('subscription_id') }}
            {{-- Form::text('subscription_id', $subscriptionProgram->subscription_id, ['class' => 'form-control' . ($errors->has('subscription_id') ? ' is-invalid' : ''), 'placeholder' => 'Subscription Id']) --}}

            <select class="form-control" wire:model="subscription_id" name="subscription_id" id="subscription_id" required>
            <option value="">Select Subscription</option>
                @foreach ($subscriptions as $subscription)
                <option value="{{ $subscription->id }}" {{ $subscriptionProgram->subscription_id == $subscription->id ? "selected" : "" }}>{{ $subscription->id }}</option>
                @endforeach
            </select>

            {!! $errors->first('subscription_id', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('program_id') }}
            {{-- Form::text('program_id', $subscriptionProgram->program_id, ['class' => 'form-control' . ($errors->has('program_id') ? ' is-invalid' : ''), 'placeholder' => 'Program Id']) --}}
            <select class="form-control" wire:model="program_id" name="program_id" id="program_id" required>
            <option value="">Select Program</option>
                @foreach ($programs as $program)
                <option value="{{ $program->id }}" {{ $subscriptionProgram->program_id == $program->id ? "selected" : "" }}>{{ $program->name }}</option>
                @endforeach
            </select>
            {!! $errors->first('program_id', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('status_id') }}
            {{-- Form::text('status_id', $subscriptionProgram->status_id, ['class' => 'form-control' . ($errors->has('status_id') ? ' is-invalid' : ''), 'placeholder' => 'Status Id']) --}}
            <select class="form-control" wire:model="status_id" name="status_id" id="status_id" required>
            <option value="">Select Status</option>
                @foreach ($statuses as $status)
                <option value="{{ $status->id }}" {{ $subscriptionProgram->status_id == $status->id ? "selected" : "" }}>{{ $status->description }}</option>
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