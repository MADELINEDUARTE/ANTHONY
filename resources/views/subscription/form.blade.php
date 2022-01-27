<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('package_id') }}
            {{-- Form::text('package_id', $subscription->package_id, ['class' => 'form-control' . ($errors->has('package_id') ? ' is-invalid' : ''), 'placeholder' => 'Package Id']) --}}
            <select class="form-control" wire:model="package_id" name="package_id" id="package_id" required>
            <option value="">Select Package</option>
                @foreach ($packages as $package)
                <option value="{{ $package->id }}" {{ $subscription->package_id == $package->id ? "selected" : "" }}>{{ $package->name }}</option>
                @endforeach
            </select>
            {!! $errors->first('package_id', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('user_id') }}
            {{  Auth::user()->name }}
            {{ Form::hidden('user_id', Auth::user()->id, ['class' => 'form-control' . ($errors->has('user_id') ? ' is-invalid' : ''), 'placeholder' => 'User Id']) }}
            {!! $errors->first('user_id', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('status_id') }}

            <select class="form-control" wire:model="status_id" name="status_id" id="status_id" required>
            <option value="">Select Status</option>
                @foreach ($statuses as $status)
                <option value="{{ $status->id }}" {{ $subscription->status_id == $status->id ? "selected" : "" }}>{{ $status->description }}</option>
                @endforeach
            </select>

            {!! $errors->first('status_id', '<div class="invalid-feedback">:message</p>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>