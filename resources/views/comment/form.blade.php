<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('reason') }}
            {{ Form::text('reason', $comment->reason, ['class' => 'form-control' . ($errors->has('reason') ? ' is-invalid' : ''), 'placeholder' => 'Reason']) }}
            {!! $errors->first('reason', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('description') }}
            {{ Form::text('description', $comment->description, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Description']) }}
            {!! $errors->first('description', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('type') }}
            {{ Form::text('type', $comment->type, ['class' => 'form-control' . ($errors->has('type') ? ' is-invalid' : ''), 'placeholder' => 'Type']) }}
            {!! $errors->first('type', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('subscription_id') }}
            {{-- Form::text('subscription_id', $comment->subscription_id, ['class' => 'form-control' . ($errors->has('subscription_id') ? ' is-invalid' : ''), 'placeholder' => 'Subscription Id']) --}}
            <select class="form-control" wire:model="subscription_id" name="subscription_id" id="subscription_id" required>
            <option value="">Select Subscription</option>
                @foreach ($subscriptions as $subscription)
                <option value="{{ $subscription->id }}" {{ $comment->subscription_id == $subscription->id ? "selected" : "" }}>{{ $subscription->package->name }}</option>
                @endforeach
            </select>
            {!! $errors->first('subscription_id', '<div class="invalid-feedback">:message</p>') !!}
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